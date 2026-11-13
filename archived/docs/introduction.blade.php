---
title: Introduction & Architecture
description: Saccharine BPMN turns standardized visual process diagrams into executable, queue-driven workflows inside your Laravel application.
sectionTitle: Introduction
package: bpmn
prevUrl: null
prevTitle: null
nextUrl: /bpmn/docs/quickstart
nextTitle: Quickstart Guide
---
@extends('_layouts.docs')

@section('docs_content')
    <h1>Introduction: Native BPMN 2.0 for Laravel</h1>
    <p class="lead text-lg text-slate-600">
        <code>saccharine/bpmn</code> turns standardized visual process diagrams into executable, queue-driven workflows inside your Laravel application.
    </p>

    <hr>

    <h2>What is BPMN 2.0?</h2>
    <p>
        Business Process Model and Notation (BPMN 2.0) is an open, vendor-neutral standard maintained by the Object Management Group (OMG). It establishes a standardized visual syntax—flowcharts composed of events, activities, gateways, and sequence flows—designed to bridge the communication gap between business analysts and software developers.
    </p>
    <p>
        In traditional applications, workflows drawn on whiteboards inevitably diverge from code. Business rules end up scattered across nested controller conditions, queued jobs, cron schedules, and event listeners. 
    </p>
    <p>
        <strong>With this package, the visual diagram is the executable source of truth.</strong> The XML graph drawn in your browser is compiled directly into database records and executed by your existing Laravel queue workers.
    </p>

    <h2>The Integration Bridge</h2>
    <p>
        <code>saccharine/bpmn</code> is not an engine built from scratch in isolation. It serves as an <strong>integration bridge</strong> uniting battle-tested open-source technologies:
    </p>

    <div>
        <img alt="Diagram showing pipeline from bpmn-js -> saccharine/bpmn -> durable-workflow -> Laravel Queue Workers" src="/assets/images/saccharine-bpmn-integration-architecture.jpg">
    </div>

    <!--<pre><code class="language-plaintext">
┌────────────────────────────────────────────────────────┐
│       bpmn-js (Camunda) - Visual Modeler & SVG         │
└───────────────────────────┬────────────────────────────┘
                            │ BPMN 2.0 XML
                            ▼
┌────────────────────────────────────────────────────────┐
│      saccharine/bpmn - XPath Parser & Graph Schema     │
└───────────────────────────┬────────────────────────────┘
                            │ Coroutine Promises
                            ▼
┌────────────────────────────────────────────────────────┐
│  durable-workflow - Deterministic State & Inboxes      │
└───────────────────────────┬────────────────────────────┘
                            │ Scheduled Jobs
                            ▼
┌────────────────────────────────────────────────────────┐
│    Laravel Queue Workers (Redis / SQS / Database)      │
└────────────────────────────────────────────────────────┘
</code></pre>-->

    <ul>
        <li>
            <strong>Visual Canvas via <a href="https://bpmn.io/toolkit/bpmn-js/" target="_blank" rel="noopener">bpmn-js</a> (Camunda):</strong> 
            Embeds a zero-dependency SVG modeler and execution viewer in your web browser or Filament admin panel.
        </li>
        <li>
            <strong>Durable Coroutines via <a href="https://durable-workflow.com" target="_blank" rel="noopener">durable-workflow</a>:</strong> 
            Provides deterministic coroutine persistence. Workflows pause, hibernate to the database, and resume without holding queue worker threads or memory.
        </li>
        <li>
            <strong>Sandboxed Decisions via <a href="https://symfony.com/doc/current/components/expression_language.html" target="_blank" rel="noopener">Symfony ExpressionLanguage</a>:</strong> 
            Evaluates conditional branching on Exclusive Gateways safely against execution payloads without raw PHP <code>eval()</code>.
        </li>
        <li>
            <strong>Native Laravel Infrastructure:</strong> 
            Runs on your existing database connections and queue workers without requiring dedicated Java servers or external daemons.
        </li>
    </ul>

    <h2>Architectural Principles</h2>

    <h3>1. Blueprint vs. Runtime Separation</h3>
    <p>
        The engine maintains a strict architectural boundary between workflow blueprints and runtime state:
    </p>
    <ul>
        <li>
            <strong>Blueprints (Compiled Definitions):</strong> When a BPMN diagram is saved, the engine's XPath compiler parses the XML and writes the graph structure into relational tables (<code>workflow_definitions</code>, <code>workflow_versions</code>, <code>workflow_nodes</code>, and <code>workflow_edges</code>). At runtime, token routing executes indexed SQL queries rather than re-parsing raw XML strings.
        </li>
        <li>
            <strong>Runtime State (Tokens & Audit Logs):</strong> Running workflow instances track active execution pointers inside <code>workflow_tokens</code>, while <code>workflow_histories</code> records an immutable audit log of completed steps and data snapshots.
        </li>
    </ul>

    <h3>2. Zero Worker Blocking</h3>
    <p>
        Long-running processes (such as awaiting a manager's approval or waiting 48 hours for a customer response) <strong>never block a queue worker</strong>. 
    </p>
    <p>
        When a workflow reaches a User Task or Timer, the coroutine yields execution, records its state snapshot into the relational database, and releases the queue worker immediately. When the required event or approval signal occurs, the workflow is pushed back onto the queue to continue from that exact step.
    </p>
@endsection