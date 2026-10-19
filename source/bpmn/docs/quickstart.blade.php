---
title: Quickstart Guide
sectionTitle: Quickstart
package: bpmn
prevUrl: /bpmn/docs/introduction
prevTitle: Introduction & Stack
nextUrl: /bpmn/docs/core-concepts
nextTitle: Core Concepts & Replay
---
@extends('_layouts.docs')

@section('docs_content')
    <h1>Quickstart Guide</h1>
    <p class="lead text-lg text-slate-600">
        Get up and running with <code>saccharine/bpmn</code> in under five minutes. This guide covers package installation, running migrations, and triggering the pre-packaged demo workflow.
    </p>

    <hr>

    <h2>Requirements</h2>
    <ul>
        <li><strong>PHP:</strong> 8.3 or 8.4</li>
        <li><strong>Laravel Framework:</strong> 11.0 or 12.0+</li>
        <li><strong>Database:</strong> MySQL 8+, MariaDB 10.3+, PostgreSQL 13+, or SQLite 3.35+</li>
        <li><strong>Queue Driver:</strong> Redis, Database, or SQS (Sync queues can be used for local testing, but persistent background workers are recommended for durable workflows)</li>
    </ul>

    <h2>1. Installation</h2>
    <p>Install the package into your Laravel application via Composer:</p>

    <pre><code class="language-bash">composer require saccharine/bpmn</code></pre>

    <p>Run the interactive package installer command:</p>

    <pre><code class="language-bash">php artisan bpmn:install</code></pre>

    <p>This automated command handles initial setup:</p>
    <ol>
        <li>Publishes the configuration file to <code>config/saccharine-bpmn.php</code>.</li>
        <li>Publishes migration files for workflow blueprints, runtime tokens, and history ledgers.</li>
        <li>Runs the migrations to establish database tables.</li>
        <li>Publishes pre-compiled assets for the embedded <code>bpmn-js</code> visual canvas and live cockpit.</li>
    </ol>

    <h2>2. Seed the Demo Workflow</h2>
    <p>
        The package includes an end-to-end order processing scenario with Exclusive Gateways, User Task approval pauses, and automated notification activities:
    </p>

    <pre><code class="language-bash">php artisan bpmn:demo</code></pre>

    <p>The demo command configures:</p>
    <ul>
        <li>An <strong>Order Fulfillment</strong> BPMN 2.0 XML graph compiled into relational definition tables.</li>
        <li>A sample domain activity class: <code>App\Workflows\Activities\SendNotificationActivity</code>.</li>
        <li>Pre-mapped test payloads with sample order values and customer contact data.</li>
    </ul>

    <h2>3. Running the Engine</h2>
    <p>Open two separate terminal windows in your project directory:</p>

    <h3>Terminal A: Start Queue Workers</h3>
    <p>Start your standard Laravel queue worker to process workflow steps:</p>

    <pre><code class="language-bash">php artisan queue:work</code></pre>

    <h3>Terminal B: Dispatch a Workflow Instance</h3>
    <p>Trigger the demo process using the test CLI command:</p>

    <pre><code class="language-bash"># Triggers an order requiring human approval (total >= 1000)
php artisan bpmn:test-order --amount=1500 --customer="alex@example.com"</code></pre>

    <p>Your terminal will output the execution lifecycle:</p>

    <div class="my-4 p-4 rounded-xl bg-slate-900 text-slate-300 font-mono text-xs border border-slate-800 space-y-1">
        <div class="text-slate-400">[BPMN] Workflow instance dispatched: wf_inst_01j98k2...</div>
        <div class="text-slate-400">[BPMN] Start Event: Process initiated.</div>
        <div class="text-emerald-400">[BPMN] Exclusive Gateway: Evaluated (amount >= 1000 -&gt; true).</div>
        <div class="text-amber-400">[BPMN] User Task reached: 'Manager Approval Required'.</div>
        <div class="text-indigo-400">[BPMN] Coroutine hibernated safely in relational database. Worker released.</div>
    </div>

    <h2>4. Inspecting the Visual Cockpit</h2>
    <p>Navigate to the standalone workflow definitions dashboard in your browser:</p>

    <pre><code class="language-text">http://your-app.test/bpmn/workflows/definitions</code></pre>

    <div class="my-4 p-4 rounded-lg bg-indigo-50 border border-indigo-200 text-xs text-indigo-900">
        <strong>Note for Filament users:</strong> If you have Filament v5 installed, the package auto-detects the panel and mounts under <code>/admin/bpmn/workflows</code> instead.
    </div>

    <p>From the dashboard:</p>
    <ol>
        <li>Click <strong>Order Fulfillment Workflow</strong>.</li>
        <li>Inspect the visual diagram powered by <code>bpmn-js</code>.</li>
        <li>Click the active running instance to open the <strong>Live Token Cockpit</strong>:
            <ul>
                <li>Completed nodes are styled in solid slate blue.</li>
                <li>The waiting User Task node pulses in vivid green.</li>
            </ul>
        </li>
        <li>Click the pulsing node to open the approval modal, then select <strong>Approve</strong>.</li>
        <li>Watch your queue worker wake the coroutine, advance the token past the join, trigger <code>SendNotificationActivity</code>, and complete the process at the End Event.</li>
    </ol>

    <h2>Artisan Scaffolding Helpers</h2>
    <p>Generate workflow components directly from the CLI:</p>

    <pre><code class="language-bash"># Create a new custom Service Task Activity
php artisan bpmn:make-activity ProcessPaymentActivity

# Create a Message/Event Trigger listener
php artisan bpmn:make-trigger OrderPaidTrigger

# Create a Camunda-compatible Element Template JSON definition
php artisan bpmn:make-template payment-service</code></pre>
@endsection