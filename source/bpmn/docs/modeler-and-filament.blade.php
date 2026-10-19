---
title: Modeler & Filament Integration
sectionTitle: UI & Modeler
package: bpmn
prevUrl: /bpmn/docs/core-concepts
prevTitle: Core Concepts & Replay
nextUrl: /bpmn/docs/roadmap-rfc
nextTitle: Roadmap & RFC
---
@extends('_layouts.docs')

@section('docs_content')
    <h1>Modeler & Filament Integration</h1>
    <p class="lead text-lg text-slate-600">
        <code>saccharine/bpmn</code> provides visual tooling for both authoring workflows and monitoring active tokens in real time. It operates as a standalone web interface or embeds seamlessly into <strong>Filament v5</strong> panels.
    </p>

    <hr>

    <h2>1. The Visual Modeler (<code>bpmn-js</code>)</h2>
    <p>
        The package embeds Camunda's open-source <code>bpmn-js</code> web modeler directly inside a responsive Blade view.
    </p>

    <h3>Custom Palette & Context Pad</h3>
    <p>
        The standard BPMN 2.0 specification contains over 80 node types, many of which (such as manual message choreographies or complex transaction boundaries) are unnecessary for typical queue automation.
    </p>
    <p>
        To prevent users from drafting diagrams that the backend engine cannot execute, the modeler includes custom JavaScript providers:
    </p>
    <ul>
        <li>
            <strong><code>CustomPaletteProvider.js</code>:</strong> Replaces the default left toolbar with a curated palette containing only supported shapes:
            <ul>
                <li>Start Events & End Events</li>
                <li>Service Tasks (Automated activities)</li>
                <li>User Tasks (Human approval and form nodes)</li>
                <li>Exclusive Gateways (XOR conditional splits)</li>
                <li>Parallel Gateways (AND concurrent splits and joins)</li>
                <li>Call Activities & Sub-Processes</li>
            </ul>
        </li>
        <li>
            <strong><code>CustomContextPadProvider.js</code>:</strong> Restricts the context menu when clicking on existing shapes, ensuring sequence flows connect only to supported node types.
        </li>
    </ul>

    <h2>2. Element Templates</h2>
    <p>
        Rather than requiring users to manually input raw XML properties, the modeler supports Camunda-compatible <strong>Element Templates</strong> via <code>@bpmn-io/element-template-chooser</code>.
    </p>
    <p>
        Element Templates transform the right-hand properties panel into structured form inputs tailored to your application's specific domain activities.
    </p>

    <h3>Example Template: <code>send-notification.json</code></h3>

    <pre><code class="language-json">{
  "$schema": "https://unpkg.com/@bpmn-io/element-templates@0.8.0/resources/element-template.json",
  "name": "Send Notification Activity",
  "id": "saccharine.activity.send-notification",
  "appliesTo": ["bpmn:ServiceTask"],
  "properties": [
    {
      "label": "Delivery Channel",
      "type": "Dropdown",
      "value": "mail",
      "choices": [
        {"name": "Email Mailable", "value": "mail"},
        {"name": "Slack Webhook", "value": "slack"},
        {"name": "System Audit Log", "value": "log"}
      ],
      "binding": {
        "type": "camunda:property",
        "name": "channel"
      }
    },
    {
      "label": "Recipient Template",
      "type": "String",
      "value": "@{{ customer_email }}",
      "binding": {
        "type": "camunda:inputParameter",
        "name": "recipient"
      }
    }
  ]
}</code></pre>

    <p>
        When saved, these values are written to the BPMN 2.0 XML and compiled into the <code>input_parameters</code> JSON column on the <code>workflow_nodes</code> database table.
    </p>

    <h2>3. Real-Time Telemetry & Token Cockpit</h2>
    <p>
        The package includes an interactive execution viewer built with <code>bpmn-js/lib/NavigatedViewer</code> and paired with real-time polling endpoints (<code>/tokens</code> and <code>/telemetry</code>).
    </p>

    <div class="my-6 p-4 rounded-xl bg-slate-900 text-slate-300 font-mono text-xs border border-slate-800 leading-relaxed overflow-x-auto">
        <pre>
        ┌─────────────────────────────────────────────────────────────┐
        │                   Live Telemetry Canvas                     │
        │                                                             │
        │  ┌──────────┐       ┌──────────────┐       ┌─────────────┐  │
        │  │  Start   ├──────►│ Check Credit ├──────►│ User Review │  │
        │  └──────────┘       └──────────────┘       └──────┬──────┘  │
        │   (Completed)         (Completed)                 │         │
        │   Solid Blue          Solid Blue            Pulse Green     │
        │                                            (Active Token)   │
        └─────────────────────────────────────────────────────────────┘
        </pre>
    </div>

    <h3>Dynamic Token Styling</h3>
    <p>Nodes on the canvas reflect live database execution states:</p>
    <ul>
        <li><strong>Completed Nodes (<code>.bpmn-history-completed</code>):</strong> Displayed with solid blue outlines and backgrounds, indicating that the token passed through the node successfully.</li>
        <li><strong>Active Waiting Nodes (<code>.bpmn-active-token</code>):</strong> Highlighted with an emerald green border and a pulsing CSS indicator, showing that a coroutine is currently hibernated at this step.</li>
        <li><strong>Failed / Halted Nodes (<code>.bpmn-failed-token</code>):</strong> Rendered in red, showing where an unhandled exception occurred or where an administrative halt stopped the process.</li>
    </ul>

    <h3>Interactive In-Page Signals</h3>
    <p>
        Clicking an active User Task node on the canvas opens a modal displaying current <code>$userData</code> and available action buttons (such as <strong>Approve</strong>, <strong>Reject</strong>, or <strong>Request Changes</strong>). Submitting the modal immediately sends the required inbox signal to resume background queue processing.
    </p>

    <h2>4. Filament v5 Admin Integration</h2>
    <p>
        If your application uses Filament, <code>saccharine/bpmn</code> integrates into your admin panel via <code>BpmnFilamentPlugin</code>.
    </p>

    <h3>Registering the Plugin</h3>
    <p>Register the plugin in your Filament panel provider (<code>app/Providers/Filament/AdminPanelProvider.php</code>):</p>

    <pre><code class="language-php">use Saccharine\Bpmn\Filament\BpmnFilamentPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        ->plugin(BpmnFilamentPlugin::make());
}</code></pre>

    <h3>Included Resources</h3>
    <ul>
        <li>
            <strong><code>WorkflowDefinitionResource</code>:</strong> Manage workflow keys, versions, and deployment states. Includes a fullscreen modal canvas for updating and compiling diagrams.
        </li>
        <li>
            <strong><code>WorkflowInstanceResource</code>:</strong> Inspect active, completed, suspended, and failed workflows. Includes the live SVG token cockpit and header actions to Suspend, Resume, or Halt running instances.
        </li>
        <li>
            <strong>Authorization with Filament Shield:</strong> All package resources enforce standard Laravel policies and register permissions automatically (e.g., <code>view_any_workflow</code>, <code>suspend_instance</code>).
        </li>
    </ul>

    <h3>Zero Asset Pollution</h3>
    <p>
        Package stylesheets and modeler JavaScript bundles are injected exclusively on package routes using Filament's <code>PanelsRenderHook</code> (<code>HEAD_END</code> and <code>BODY_END</code>). Global panel load times and unrelated resources remain completely unaffected.
    </p>
@endsection