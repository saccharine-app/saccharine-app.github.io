---
title: Quickstart Guide
description: Get up and running with Saccharine BPMN in under five minutes.
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
        <li><strong>Laravel Framework:</strong> 12.0 || 13.0</li>
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
        <li>An <strong>Order Processing</strong> BPMN 2.0 XML graph compiled into relational definition tables.</li>
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
php artisan bpmn:test-order --amount=1500 --name="Demo Customer" --email="demo@example.com"</code></pre>

    <p>Your terminal will output the execution lifecycle:</p>

    @php
    $terminalOutput = implode("\n", [
        "\e[34m[BPMN:ENGINE]\e[0m [#1] (Start_OrderPlaced) Process started from node [Start_OrderPlaced].",
        "\e[33m[BPMN:GATEWAY]\e[0m [#1] (Gateway_VIP) Evaluated conditions. Routing token -> [Task_ManualReview].",
        "\e[35m[BPMN:HIBERNATE]\e[0m [#1] (Task_ManualReview) User Task [Manager Review] reached. Workflow hibernating in database awaiting signal.",
    ]);
@endphp

<pre><code class="language-ansi">{!! $terminalOutput !!}</code></pre>

    <h2>4. Inspecting the Visual Cockpit</h2>
    <p>Navigate to the standalone workflow instances dashboard in your browser:</p>

    <pre><code class="language-text">http://your-app.test/bpmn/workflows/instances</code></pre>

    <div class="my-4 p-4 rounded-lg bg-indigo-50 border border-indigo-200 text-xs text-indigo-900">
        <strong>Note for Filament users:</strong> If you have Filament v5 installed, the package auto-detects the panel and mounts under <code>/admin/bpmn/instances</code> instead.
    </div>

    <p>From the dashboard:</p>
    <ol>
        <li>For the running instance of <strong>Demo: Order Processing</strong> click <strong>Live Cockpit</strong>.</li>
            <ul>
                <li>Completed nodes are styled in solid slate blue.</li>
                <li>The waiting User Task node pulses in vivid green.</li>
            </ul>
        </li>
        <li>Click the pulsing node to open the approval modal, then select <strong>Submit & Resume</strong>.</li>
        <li>Watch your queue worker wake the coroutine, advance the token past the join, trigger <code>SendNotificationActivity</code>, and complete the process at the End Event.</li>
    </ol>

    <div>
        <img alt="Screenshot of the live telemetry dashboard" src="/assets/images/saccharine-bpmn-live-telemetry.png">
    </div>

    <h2>Artisan Scaffolding Helpers</h2>
    <p>Generate workflow components directly from the CLI:</p>

    <pre><code class="language-bash"># Create a new custom Service Task Activity
php artisan bpmn:make-activity ProcessPaymentActivity

# Create a Message/Event Trigger listener
php artisan bpmn:make-trigger OrderPaidTrigger

# Create a Camunda-compatible Element Template JSON definition
php artisan bpmn:make-template payment-service</code></pre>
@endsection