---
title: "Upgrading Saccharine BPMN to durable-workflow v2"
description: "A deep dive into how PHP Fibers eliminate generator promise chains while preserving deterministic replay."
date: 2026-11-17
categories: [bpmn, engineering]
tags: [bpmn, durable-workflow]
cover_image: /assets/images/upgrading-saccharine-bpmn-to-durable-workflow-v2.jpg
---

## **Upgrading Saccharine BPMN to `durable-workflow` v2**

What started as a routine dependency bump on `durable-workflow/workflow` turned into a full-scale architectural refactoring: roughly 900 edits across more than 100 files, a migration from PHP generators to native Fibers, and an entire day spent wrangling Xdebug through WSL and Docker. Looking back, though, the upgrade forced me to clean up domain boundaries I had been blurring from day one and proved that the BPMN engine's error handling actually works outside of an in-memory test suite.

Here is why I decided to tackle the `durable-workflow` v2.0 upgrade now rather than later, and what broke along the way.

### **1. Why Upgrade Now (and Why Stay Embedded for Now)**

The initial impetus was simple: `durable-workflow/workflow` v1.0 is no longer supported. I was already at a point where I wanted to add more BPMN elements, like Intermediate Timer Catch Events, and continuing to build new node handlers, signal patterns, and tests on top of a deprecated v1.0 foundation only guaranteed a much more painful migration down the road.

Version 2.0 also changes how `durable-workflow` thinks about architecture. The intended model in v2 is to run the orchestrator as a separate service (either self-hosted or cloud-managed) with the Laravel application talking to it through an SDK. That has a couple of appealing properties. If the host app only interacts through an SDK instead of owning the entire runtime, you can move between self-hosted and cloud-managed deployments without rewriting application logic. Because I am already running Docker with separate FrankenPHP containers for the web app and `artisan queue:work`, standing up a self-hosted orchestrator container wouldn't be much of a stretch. Also worth noting, v2 is polyglot and supports running queues from PHP, Python, and Rust, which opens up the long-term idea of a PHP app delegating heavy BPMN service tasks to a Rust or Python worker, or even turning the BPMN engine itself into something cross-language, since the compiled graph tables are just relational data.

That polyglot angle is pretty pie-in-the-sky while the package is still in alpha, though, and v2 still ships a Laravel-embedded mode (treated mostly as a compatibility path). Before committing to service mode, I had to weigh what switching immediately would actually cost.

| Consideration | Embedded Mode (v2) | Service Mode + SDK (v2) |
| :--- | :--- | :--- |
| External infrastructure | Self-contained Laravel package; zero external services | Requires a running `durable-workflow/server` container |
| Adoption friction | Low; standard composer require and migrations | High; host apps must provision an orchestration service |
| Deployment topology | Runs via standard artisan queue:work | Multi-container setup (app, server, worker daemon) |
| Test environment | Runs in milliseconds on SQLite via Orchestra Testbench | Requires an SDK test harness or mocked remote client |
| Polyglot workers | Bound to PHP queue workers | Supports PHP, Python, and Rust task queues |

Staying in embedded mode for now won out easily. Requiring every Laravel developer who wants to try a visual BPMN package to spin up a standalone orchestration server would shrink the audience before the core BPMN features are even finished. Keeping embedded mode let me get onto a supported v2 codebase right away, keep all of the existing Testbench tests fast on SQLite, and defer any SDK adapter layer until the engine's own execution semantics are locked down.

### **2. Disentangling Processes from Workflows (~900 Edits Later)**

I created a new branch, bumped `durable-workflow/workflow` to v2.0 in embedded mode, and ran the test suite to see what would break first. The answer was immediate: SQL errors from colliding table names.

In v1, I hadn't thought carefully enough about naming my own database tables `workflow_definitions`, `workflow_versions`, `workflow_nodes`, `workflow_edges`, `workflow_instances`, `workflow_tokens`, and `workflow_triggers_log`. In v2, `durable-workflow` introduced its own `workflow_instances` table, which collided directly with mine. Even without the SQL error, the naming was muddying the data model: BPMN is a business-process domain layer sitting  *on top*  of `durable-workflow`'s lower-level coroutine engine.

To clean that up, I renamed the package's tables and Eloquent models from `Workflow*` to `Process*` (`ProcessDefinition`, `ProcessVersion`, `ProcessNode`, `ProcessEdge`, `ProcessInstance`, `ProcessToken`, and `process_triggers_log`). The catch was that I couldn't just run a blind search-and-replace across the repository. Plenty of symbols, like `BpmnInterpreterWorkflow` itself and the `durable_workflow_id` foreign key, legitimately refer to the underlying coroutine layer. I had to go through and distinguish "process" (the BPMN graph and runtime state) from "workflow" (the durable execution primitive) across code, migrations, comments, and docs, ending up with around 900 edits across more than 100 files before the test suite came back clean.

One naming headache lingered even after that pass: `ProcessHistory` and `process_histories`. It is standard in Laravel to pair a singular model with a plural table, but "history" is an amorphous mass noun. What does one singular "history" even mean? A history book? The entire biography of a record? Pluralizing it into `process_histories` felt just as awkward, even though I originally liked how terse it was compared to a longer compound name. Before wrapping up the refactor, I weighed the alternatives:

* **`ProcessStep`**  **(**  **`process_steps`**  **):**  Terse and countable, but too easily confused with design-time nodes on a diagram ("step 1, step 2").
* **`ProcessTransition`**  **(**  **`process_transitions`**  **):**  Accurate in state-machine theory, yet a bit loaded; it implies the act of changing state rather than a completed item on an itinerary.
* **`ProcessHistoryEvent`**  **(**  **`process_history_events`**  **):**  Longer, and BPMN already uses the word "event" for triggers like Start and Boundary Events, which initially made me hesitate.

In the end, `ProcessHistoryEvent` won out. Anchoring "event" with `history_` disambiguates it from BPMN diagram events, `process_history_events` pluralizes cleanly, and it mirrors `durable-workflow` v2's own `workflow_history_events` tablem making it obvious that one tracks high-level BPMN node completions while the other tracks low-level coroutine replay events.

### **3. When the Worker Crashed at Byte Zero**

Having the Pest suite pass on in-memory SQLite was one thing; running a real process inside the Saccharine Docker stack with FrankenPHP and PostgreSQL was another.

The first snag was purely operational. Because I booted the FrankenPHP queue worker container before running migrations on a fresh database, `queue:work` immediately crashed looking for Laravel's cache table while polling `illuminate:queue:restart`:

```text
SQLSTATE[42P01]: Undefined table: 7 ERROR: relation "cache" does not exist
LINE 1: select * from "cache" where "key" in ($1)
```

Even after running `php artisan migrate`, the worker container still needed an explicit restart, something I will need to keep in mind for VPS deploy scripts.

Once the worker was actually running, triggering a process created a ProcessInstance record, yet it reported no active token and never advanced. Checking the Docker logs showed `BpmnInterpreterWorkflow` failing in 55ms, followed by `WorkflowSignal` failing in 18ms when I tried to halt it. Worse, the Laravel log was empty, and trying to query `Workflow\Models\Workflow` in Tinker threw a class-not-found error because v2 had overhauled its internal models.

Pulling the raw exception directly out of failed_jobs finally pointed to the culprit:

```text
ErrorException: unserialize(): Error at offset 0 of 472 bytes in /var/www/html/vendor/durable-workflow/workflow/src/Serializers/AbstractSerializer.php:70
##2 /var/www/html/vendor/durable-workflow/workflow/src/Serializers/AbstractSerializer.php(70): unserialize('wwHioz3/VYAiNw4...')
```

Normally an `unserialize()` error on ciphertext points to mismatched `APP_KEY` values between containers or stale database rows left over from an older version. Both my app and worker containers build from the same FrankenPHP Dockerfile and share the exact same `APP_KEY`, and truncating the old tables didn't change anything. Publishing the new v2 `config/workflow.php` file gave the real explanation away in its comments:

```php
// Payload codec diagnostic input. Final v2 always uses "avro" as the
// default codec for new typed binary payloads with cross-language type
// fidelity (int stays int, float stays float).
'serializer' => Env::dw('DW_SERIALIZER', 'WORKFLOW_SERIALIZER', 'avro'),
```

In v2, Avro binary encoding is the mandatory default codec for new runs. When the process was dispatched, the v2 engine serialized its payload using Avro. Because `BpmnInterpreterWorkflow` still extended the legacy `Workflow\Workflow` compatibility alias instead of `Workflow\V2\Workflow`, the worker treated it as a v1 workflow on pickup and fed raw Avro bytes straight into PHP's native `unserialize()`.

### **4. From Yielding Generators to Native PHP Fibers**

Switching imports to the WorkflowV2 namespace immediately revealed that v2 wasn't just a namespace shuffle: the whole execution model had changed from PHP Generators to native PHP 8.1+ Fibers. Half-migrated files clashed in subtle ways during the transition: `makeScopedChildWorkflow()` and `ParallelGatewayHandler` still had lingering `Workflow\ChildWorkflowStub::make(...)` calls alongside new `Workflow\V2\child()` imports, and `BpmnServiceProvider` still carried a `config('workflow.v1_enabled')` guard.

In v1, every durable boundary required `yield` or `yield from` so the engine could drive a `Generator` state machine from the outside. In v2, the workflow entry point shifts from `execute()` to `handle()`, manual stub classes like `Workflow\V2\ChildWorkflowStub` are gone, and suspension happens inside functional primitives (`Workflow\V2\activity()`, `child()`, `await()`, `awaitWithTimeout()`, `timer()`, `sideEffect()`, and `all()`). Because Fibers can suspend from anywhere in the call stack without bubbling promises back up through every caller, `BpmnNodeHandlerInterface::handle()` no longer needed to return `Generator`.

Removing `yield` did make me wonder if I was giving up replay checkpoints, since `yield` had previously marked the exact pause points the engine replayed against. In practice, checkpoints simply moved inside the v2 helper functions: on replay, `handle()` re-runs from the top, and whenever it reaches `activity()`, `child()`, or `sideEffect()`, the runtime returns the cached event-log result instead of suspending again.

There was an immediate payoff in the test suite, too. Under v1, isolated node handler tests like `ServiceTaskTest`, `CallActivityTest`, `SubProcessTest`, `ExclusiveGatewayTest`, and `TimerBoundaryEventTest` had to manually pump generators with `$generator->current()`, `$generator->send()`, and `$generator->getReturn()`. Once handlers became synchronous-looking methods returning `[?string $nextNodeId, array $userData]`, I could mock wrapper methods on `BpmnInterpreterWorkflow` (`makeActivity`, `makeChildWorkflow`, `makeScopedChildWorkflow`, `awaitWithTimeoutPromise`) and assert directly on the returned array.

### **5. Rethinking Signals, Mailboxes, and Updates**

The trickiest conceptual shift in v2 was how external inputs reach a running process. In v1, #`BpmnInterpreterWorkflow` used `#SignalMethod` attributes and `$this->inbox` to receive human task submissions and operator interventions (`suspendWorkflow`, `resumeWorkflow`, `haltWorkflow`). When `BpmnInterventionTest` started failing on `expect($workflow->running())->toBeFalse()`, even after `#Signal('haltWorkflow')` appeared to be accepted, I realized I didn't actually understand how v2 signals worked.

Looking at v2's `functions.php` and migration guide cleared up the confusion, though it initially felt like a step backward:

* **v1**  **`#SignalMethod`**  **behaved like an interrupt:**  An external caller could invoke a method on the workflow at any time and mutate class properties, regardless of what step the workflow was currently executing.
* **v2 named signals behave like a mailbox:**  `#SignalMethod` is gone, `await()` accepts a single signal name or callable, and `$workflow->signal(...)` simply records an event that the Fiber only reads when execution reaches a matching `await('signal-name')`.

To me, that sounded less like responding to an asynchronous signal and more like polling for input in a game loop. If a process is parked at a userTask awaiting `'submitUserTask'`, or blocked inside a long-running `activity()`, how is an operator supposed to suspend or halt it?

I explored a few alternatives before landing on the pattern that actually fit:

1. **Racing with**  **`Workflow\V2\select()`**  **:**  Racing the current node handler against await('suspend') and await('halt') looks neat on paper, but non-winning branches in `select()` stay open. If an activity wins the race, you accumulate orphaned signal listeners on every node in a loop; if halt wins, the background activity keeps running unless manually cancelled.
2. **Memos (**  **`upsertMemo`**  **):**  An AI coding agent I asked to inspect `durable-workflow`'s source suggested storing suspension flags in workflow memos and checking them around activity boundaries. Checking functions.php ruled that out immediately: the documentation explicitly warns that: "Memos are eventually consistent describe/list metadata, not replay authority and not a safe place for workflow-branching truth."
3. **Update Methods (**  **`#UpdateMethod`**  **via**  **`submitUpdate()`**  **):**  In v2, updates allow callers to mutate workflow state synchronously and deterministically. Unlike `#SignalMethod` in v1, they fit neatly with cooperative Fiber waits without relying on un-awaited signal mailboxes.

That made `#UpdateMethod` the right tool for all four interactive operations (`submitUserTask`, `suspendProcess`, `resumeProcess`, and `haltProcess`) invoked via `$workflow->submitUpdate(...)` across controllers, CLI commands, and Filament actions. `UserTaskHandler` blocks on a closure checking `$workflow->hasUnreadInbox() || $workflow->isSuspended() || $workflow->isHalted()`, while the interpreter loop intercepts `$this->isSuspended` with `await(fn () => !$this->isSuspended || $this->isHalted)` and handles `$this->isHalted` by setting `$userData['_system_status'] = 'halted'`, cleaning up active tokens, and breaking out cleanly. (While `durable-workflow` v2 also provides `$workflow->cancel()` at activity boundaries, standardizing on `submitUpdate()` kept user tasks and operator interventions on one consistent, BPMN-aware state model.)

### **6. Deferred Closures in Parallel Gateways**

After refactoring the loop, handlers, and tests to `Workflow\V2`, 60 out of 68 tests passed—leaving `ParallelGatewayTest` as the main holdout. Both child branches and their service tasks started, never reached the join, and ended with a failed workflow status. Because Pest runs in memory without writing standard Laravel log files, the failure gave almost no diagnostic output on its own.

Querying v2's internal tables directly inside the failing test (`workflow_failures`, `workflow_runs`, and `workflow_history_events`) alongside piping `Log::listen()` to `STDERR` surfaced the issue. In v1, `ParallelGatewayHandler` built an array of `ChildWorkflowStub::make(...)` objects and `yield`ed them into `all()`. In v2, calling `child()` inside a foreach loop suspends the parent Fiber immediately on the very first branch before the second branch is even scheduled.

Wrapping each branch in a deferred closure fixed it cleanly:

```php
$parallelTasks = [];
foreach ($outgoingEdges as $edge) {
    $targetId = $edge->target_node_id;
    $parallelTasks[] = fn () => $workflow->makeChildWorkflow(
        $version->id,
        $userData,
        $targetId,
        $instanceId
    );
}

$branchResults = all($parallelTasks);
```

Because `all()` handles Closure entries through `WorkflowFiberContext::whileInactive()`, both branches schedule concurrently before suspending on the join barrier. With that change, the entire Pest suite turned green.

### **7. Xdebug, a One-Line Bug, and an Accidental Error Boundary Test**

Even with every automated test passing, running a real workflow in Docker with queue:work still stalled right after the Start Event (`Start_OrderPlaced`). A ProcessToken row was created, the instance showed as running, and nothing else happened.

I spent an entire day getting Xdebug working through WSL and Docker just so I could step into `BpmnInterpreterWorkflow::handle()`. Stepping through showed `StartEventHandler` finding the outgoing edge and returning the next node ID, followed by execution entering `WorkflowExecution::startCallback()`, calling `WorkflowFiberContext::leave()`, and exiting. Checking `workflow_history_events` exposed what actually happened, and it was a stupid oversight.

Inside `BpmnInterpreterWorkflow::handle()`, every other `sideEffect` call had been updated to the v2 `sideEffect()` function, except for one leftover `WorkflowStub::sideEffect(...)` inside the `if ($instanceId !== null)` block that records history entries (ProcessHistory, later renamed ProcessHistoryEvent). Two blind spots in the test suite had kept that fatal call hidden:

* **Isolated node tests**  mock `BpmnInterpreterWorkflow` and never run the outer while loop in `handle()`.
* **Integration tests**  like BpmnInterpreterTest started workflows with only two arguments, leaving `$instanceId = null` and skipping the history-recording block altogether.

Fixing that single line unblocked the engine through the Exclusive Gateway (`Gateway_VIP`) and onto the `Task_ManualReview` User Task. Updating `ProcessInstanceController::submitUserTask()` to use `submitUpdate()` instead of the old signal call let the user task submit and resume the Fiber.

Then the next Service Task (`SendNotificationActivity`) crashed; this time because an earlier docker compose restart of just the app container hadn't brought Mailpit back up, causing a mail transport exception. Rather than just restarting Mailpit and declaring victory, I took advantage of the broken container to test something I had only ever verified in Pest mocks: a live Error Boundary Event. I attached an Error Boundary Event to the notification Service Task in the diagram, routed it to a "Manager Intervention Needed" User Task leading to an End Event, and left Mailpit stopped. Sure enough, when the notification task threw its exception, the worker caught it, routed the token down the boundary path, paused at the intervention task for manual approval, and finished cleanly.

Getting Xdebug running in containers was miserable, and chasing down a half-migrated `sideEffect()` call was humbling, but hitting a real infrastructure failure in the middle of the upgrade ended up proving the core thesis of the package: when a dependency goes down, the diagram routes around the failure and puts a human in the loop without losing state.
