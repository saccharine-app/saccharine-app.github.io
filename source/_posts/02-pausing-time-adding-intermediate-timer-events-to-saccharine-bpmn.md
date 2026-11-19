---
title: "Pausing Time: Adding Intermediate Timer Events to Saccharine BPMN"
description: "The conceptual importance and technical hurdles of adding timed delays to a process engine."
date: 2026-11-19
categories: [bpmn, engineering]
tags: [bpmn, durable-workflow]
cover_image: /assets/images/posts/pausing-time-adding-intermediate-timer-events-to-saccharine-bpmn.jpg
---

## Pausing Time: Adding Intermediate Timer Events to Saccharine BPMN

Intermediate Timer Catch Events are a feature I had wanted to add to Saccharine BPMN for a while, but I deliberately held off until the `durable-workflow` v2 upgrade was out of the way. Implementing a new timed wait state on top of v1's generator coroutines right before tearing them out for PHP Fibers would have just created more code to rewrite. Once the v2 refactor settled and the test suite was green, adding intermediate timers turned out to be surprisingly small in terms of code (five focused changes across the parser, engine, and modeler) yet it closes a major conceptual gap in what a process diagram can express. 

### 1. Delays vs. Deadlines in BPMN

At a glance, it is easy to lump all BPMN timers together, because in the XML they all share a `<bpmn:timerEventDefinition>`. In practice, though, BPMN treats a timer not as a standalone node type, but as a behavior modifier whose meaning changes completely depending on where it sits in the diagram.

Before this change, Saccharine BPMN already supported **Boundary Timer Events** on `UserTask` nodes. In `UserTaskHandler`, an attached timer acts as an SLA deadline: the handler pulls the ISO 8601 duration (such as `PT2H` or `PT24H`) and passes it into `awaitWithTimeoutPromise()`. If a human approves or rejects the task in time, the token continues down the normal sequence flow; if the deadline expires first, the engine injects `_timer_expired = true` into `$userData` and diverts execution down the escalation path.

**Intermediate Timer Catch Events** (`<bpmn:intermediateCatchEvent>`) solve the opposite problem. Instead of interrupting a task when someone is too slow, an intermediate timer represents an *intentional delay* built into the happy path; a fixed waiting period (such as 1 hour, 24 hours, or 2 days) between steps (`Start -> Timer Catch Event -> Service Task -> End`). A third BPMN flavor, **Timer Start Events** (cron-style recurring schedules), belongs outside `BpmnInterpreterWorkflow` altogether in a scheduled console command and remains unimplemented for now.

| Timer Flavor | BPMN Element | Process Role | Engine Status & Mechanism |
| ------ | ------ | ------ | ------ |
| Boundary Timer | `<bpmn:boundaryEvent>` on `userTask` | Interrupting SLA deadline; escalates when a human misses a window | Implemented; `awaitWithTimeoutPromise()` inside `UserTaskHandler` |
| Intermediate Catch Timer | `<bpmn:intermediateCatchEvent>` | Intentional mid-process pause before advancing to the next node | Implemented; `timerPromise()` wrapping `Workflow\V2\timer()` |
| Timer Start Event | `<bpmn:startEvent>` | Recurring schedule launching new instances | Not yet implemented; belongs in an external scheduled command |

The real significance of supporting both deadlines and delays natively in the engine is how they sleep. In a conventional Laravel app, modeling a 24-hour wait usually means either tying up a worker or writing database status flags and polling them with a cron job every few minutes. Under `durable-workflow` v2, hitting a timer inside a Fiber flushes the state checkpoint to the database, ends the worker's current execution cycle, and releases all memory. Thousands of instances can sit mid-process in a `PT24H` or `P1D` wait without holding queue connections or worker threads open; when the scheduled wake-up fires, the worker replays cached history for earlier steps and picks up right after the timer. With the Fiber runtime already handling suspension and replay, wiring this behavior into the BPMN engine required surprisingly little scaffolding.

### 2. Five Small Pieces on Top of v2 Fibers

Because the v2 refactor had already flattened node handlers into synchronous methods returning `[?string $nextNodeId, array $userData]` and isolated static engine calls behind wrapper methods on `BpmnInterpreterWorkflow`, adding intermediate timer support did not require touching the core execution loop or adding a single database migration. `process_nodes` already carried `event_definition_type` and `implementation` columns for boundary timers, so intermediate catch timers slotted straight into the same schema.

The implementation spanned five compact changes across the stack:

1. XML Parsing ( `src/Services/BpmnParserService.php` ): I added `'intermediateCatchEvent'` to the `$nodeTypes` array in `parseAndStore()`. Inside the node loop, when the parser sees a child, it sets `$eventDefType = 'timer'` and extracts `<bpmn:timeDuration>` (falling back to `'PT1H'` if missing) into `implementation`.
2. Mockable Fiber Suspension ( `src/Workflows/BpmnInterpreterWorkflow.php` ): Just like `makeActivity()` and `awaitWithTimeoutPromise()`, I added a small `timerPromise(string $duration): void` helper wrapping `Workflow\V2\timer($duration)` so isolated node tests can intercept the call without hitting global coroutine state.
3. The Node Handler ( `src/Handlers/Nodes/Events/IntermediateCatchEventHandler.php` ): A new handler implementing `BpmnNodeHandlerInterface` checks for `event_definition_type === 'timer'`, logs step telemetry, calls `$workflow->timerPromise($duration)`, and returns the next sequential node alongside the untouched `$userData` payload.
4. Factory Registration ( `src/Handlers/NodeHandlerFactory.php` ): Mapped `'intermediateCatchEvent'` to `IntermediateCatchEventHandler::class`.
5. Visual Modeler Support ( `resources/js/engineCapabilities.js` ): Added `'bpmn:IntermediateCatchEvent'` to `DEFAULT_SUPPORTED_ELEMENTS` so the filtered palette and replace menu let diagram authors drop and configure timer catch events directly on the canvas.

The handler itself shows how clean node additions became once generator `yield` chains were gone, and why guarding on `event_definition_type === 'timer'` keeps the door open for `<bpmn:messageEventDefinition>` catch events later on:

```php
public function handle(
    BpmnInterpreterWorkflow $workflow,
    ProcessNode $node,
    ProcessVersion $version,
    array $userData,
    ?int $instanceId
): array {
    if ($node->event_definition_type === 'timer') {
        $duration = $node->implementation ?? 'PT1H';
        $workflow->timerPromise($duration);
    }

    $nextNodeId = $workflow->getNextSequentialNode($version, $node->bpmn_element_id);
    return [$nextNodeId, $userData];
}
```

Wrapping `Workflow\V2\timer()` inside `timerPromise()` also solved the main practical question for the test suite: how to verify timed waits reliably without making Pest sit idle for an hour. 

### 3. Testing Timed Execution Without Waiting

Following the same test structure as the other nodes, `tests/Feature/Nodes/Events/TimerIntermediateEventTest.php` exercises the feature at three layers:

* XML Extraction: Feeds `<intermediateCatchEvent>` containing `<bpmn:timerEventDefinition><bpmn:timeDuration>PT1H</bpmn:timeDuration></bpmn:timerEventDefinition>` into `BpmnParserService` and asserts that `event_definition_type` is stored as `'timer'` with `'PT1H'` in implementation.
* Isolated Handler Logic: Uses a Mockery partial mock of `BpmnInterpreterWorkflow` to intercept `timerPromise()` and verify that `IntermediateCatchEventHandler` routes to the next node without altering `$userData`.
* End-to-End Durable Execution: Runs a full `Start -> Timer Catch Event -> Service Task -> End` process through the durable queue worker using a zero-second `PT0S` duration in Pest so the sleep-and-resume cycle executes without stalling the test suite.

Because zero-second tests only prove the plumbing, I also ran integration checks against real durations, confirming that processes slept and resumed cleanly after waits of 1 minute, 1 hour, and 1 day.

Shipping this also forced a quick cleanup of the project roadmap. Auditing `05_architecture_roadmap.md` against the codebase reminded me that both Boundary Timers and Intermediate Timer Catch Events had already moved from "planned" to working features. With time-based delays and deadlines checked off in v0.6.0-alpha, the remaining gap in Milestone 1 narrows cleanly to Intermediate and Boundary Message Catch Events: correlating external webhooks and domain events via business keys to wake hibernated Fibers mid-process.