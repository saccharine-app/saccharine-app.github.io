---
title: Roadmap & Community RFC
description: We are gathering real-world architectural feedback, testing engine assumptions across enterprise use cases, and inviting contributions from the Laravel community.
sectionTitle: Community & RFC
package: bpmn
prevUrl: /bpmn/docs/modeler-and-filament
prevTitle: Modeler & Filament
nextUrl: null
nextTitle: null
---
@extends('_layouts.docs')

@section('docs_content')
    <h1>Roadmap & Request for Comments (RFC)</h1>
    <p class="lead text-lg text-slate-600">
        <code>saccharine/bpmn</code> is currently in active development under <strong><code>v0.5.0-alpha</code></strong>. We are gathering real-world architectural feedback, testing engine assumptions across enterprise use cases, and inviting contributions from the Laravel community.
    </p>

    <hr>

    <h2>Current Status: What Works Today</h2>
    <p>
        The core execution loop and relational compilation layers are stable and tested under PHP 8.3/8.4 and Laravel 12/13 via Pest:
    </p>

    <ul>
        <li><strong>Strict XPath XML Parsing:</strong> Validates and converts BPMN 2.0 XML into relational graph tables (<code>workflow_definitions</code>, <code>versions</code>, <code>nodes</code>, <code>edges</code>).</li>
        <li><strong>Durable Coroutine Execution:</strong> Deterministic replay safety and database state snapshots powered by <code>durable-workflow</code>.</li>
        <li><strong>Service Task Delegation:</strong> Asynchronous delegation to registered activity classes with automatic payload mutation merging.</li>
        <li><strong>User Task Hibernation:</strong> Suspends processes cleanly without blocking queue workers; wakes when inbox signals are dispatched.</li>
        <li><strong>Exclusive Gateways (XOR):</strong> Safe expression evaluation via Symfony ExpressionLanguage without raw PHP <code>eval()</code>.</li>
        <li><strong>Parallel Gateways (AND):</strong> Spawns concurrent branch coroutines and resolves synchronization join barriers via <code>yield all()</code>.</li>
        <li><strong>Sub-Processes & Call Activities:</strong> Scoped execution of modular sub-graphs with <code>parent_element_id</code> isolation.</li>
        <li><strong>Visual Modeler:</strong> Embedded <code>bpmn-js</code> canvas with custom restricted palettes and element templates.</li>
        <li><strong>Live Token Cockpit:</strong> Interactive SVG telemetry overlay with real-time status polling.</li>
        <li><strong>Filament v5 Plugin:</strong> Pre-built admin resources, policies, and Filament Shield permission integration.</li>
    </ul>

    <h2>Known Boundaries & Limitations</h2>
    <p>
        As an early alpha, several advanced BPMN 2.0 specifications are not yet supported:
    </p>

    <ol>
        <li>
            <strong>Complex / Inclusive Gateways (OR Splits):</strong><br>
            Only Exclusive Gateways (XOR) and Parallel Gateways (AND) are currently supported. Multi-condition inclusive path evaluation (OR) is under active research.
        </li>
        <li>
            <strong>Intermediate In-Flight Catch Events:</strong><br>
            Message and signal start events are supported, but intermediate in-flight message catch events are currently routed through User Task signals rather than dedicated event nodes.
        </li>
        <li>
            <strong>In-Flight Schema Migration:</strong><br>
            When a new version of a workflow diagram is published, active running instances remain pinned to the specific version (<code>workflow_version_id</code>) they began on. Dynamic token migration across schema versions is not yet implemented.
        </li>
        <li>
            <strong>Compensation & Transaction Boundaries:</strong><br>
            Automated business rollbacks (Saga compensation events) must currently be handled manually within activity classes rather than declared via visual BPMN compensation boundaries.
        </li>
    </ol>

    <h2>Upcoming Milestones: The Path to Beta & v1.0</h2>

    <h3>Milestone 1: Timer Intermediate Events & Durations</h3>
    <ul>
        <li>Add support for standalone Timer Catch Events and Boundary Interrupting Timers.</li>
        <li>Enable ISO 8601 duration syntax (e.g., <code>P1D</code>, <code>PT2H</code>) using the engine's <code>awaitWithTimeout()</code> coroutine helper to trigger automated fallback paths if tasks stall.</li>
    </ul>

    <h3>Milestone 2: Declarative Data Input/Output Mapping</h3>
    <ul>
        <li>Add declarative input/output data transformers directly to the visual canvas properties panel.</li>
        <li>Allow developers to scope and reshape <code>$userData</code> keys entering and exiting a Service Task without writing custom data-mapping boilerplate in PHP.</li>
    </ul>

    <h3>Milestone 3: Dynamic Simulation & Token Replay</h3>
    <ul>
        <li>Introduce an interactive "dry run" simulator in the visual modeler.</li>
        <li>Allow developers to test gateway conditions and inspect hypothetical execution paths in the browser using mock JSON payloads before deploying workflows.</li>
    </ul>

    <h2>How to Contribute & Join the RFC</h2>
    <p>We welcome RFC discussion, bug reports, and pull requests.</p>

    <h3>Areas Where We Need Feedback</h3>
    <ul>
        <li><strong>Gateway Evaluation Ergonomics:</strong> Does Symfony ExpressionLanguage meet your routing criteria, or do you require custom business rule engine bindings?</li>
        <li><strong>Edge-Case Exception Handling:</strong> How do your queue workers prefer to handle third-party API downtimes—infinite queue retries or visual error boundary branches?</li>
        <li><strong>Filament Experience:</strong> How can the workflow cockpit and token inspector better serve daily operational triage?</li>
    </ul>

    <h3>Discussion & Community Links</h3>
    <ul>
        <li><strong>GitHub Repository:</strong> <a href="https://github.com/saccharine-app/bpmn" target="_blank" rel="noopener">github.com/saccharine-app/bpmn</a></li>
        <li><strong>Open RFC Discussions:</strong> <a href="https://github.com/saccharine-app/bpmn/discussions" target="_blank" rel="noopener">github.com/saccharine-app/bpmn/discussions</a></li>
        <li><strong>Issue Tracker:</strong> <a href="https://github.com/saccharine-app/bpmn/issues" target="_blank" rel="noopener">github.com/saccharine-app/bpmn/issues</a></li>
        <li><strong>License:</strong> Permissive open source under the <a href="https://opensource.org/licenses/MIT" target="_blank" rel="noopener">MIT License</a>.</li>
    </ul>
@endsection