---
title: Core Concepts & Replay Safety
sectionTitle: Core Concepts
package: bpmn
prevUrl: /bpmn/docs/quickstart
prevTitle: Quickstart Guide
nextUrl: /bpmn/docs/modeler-and-filament
nextTitle: Modeler & Filament
---
@extends('_layouts.docs')

@section('docs_content')
    <h1>Core Concepts & Execution Mechanics</h1>
    <p class="lead text-lg text-slate-600">
        <code>saccharine/bpmn</code> translates BPMN 2.0 visual graph specifications into durable PHP coroutines. Learn how tasks execute, how state persists, and how deterministic replay guarantees stability across queue restarts.
    </p>

    <hr>

    <h2>1. Service Tasks (Automated Work)</h2>
    <p>
        A <strong>Service Task</strong> represents automated work performed by code without manual intervention. When a workflow token arrives at a Service Task, the engine delegates execution to a registered Activity class.
    </p>

    <h3>Defining an Activity Class</h3>
    <p>
        Activities inherit from the package base class and implement a clean, isolated <code>execute()</code> method:
    </p>

    <pre><code class="language-php">&lt;?php

namespace App\Workflows\Activities;

use Saccharine\Bpmn\Activities\Activity;
use Illuminate\Support\Facades\Http;

class VerifyFraudScoreActivity extends Activity
{
    /**
     * Executes the task.
     * Receives the current process state ($userData).
     * Returns an array of state mutations to merge back into the instance.
     */
    public function execute(array $userData): array
    {
        $response = Http::post('https://fraud-service.internal/check', [
            'email' => $userData['customer_email'],
            'amount' => $userData['order_total'],
        ]);

        return [
            'fraud_score' => $response->json('score'),
            'fraud_verified_at' => now()->toISOString(),
        ];
    }
}</code></pre>

    <h3>Decoupled Configuration Mapping</h3>
    <p>
        In <code>config/saccharine-bpmn.php</code>, tasks declared on the visual canvas are mapped to PHP classes using task IDs or element templates:
    </p>

    <pre><code class="language-php">'activities' => [
    'verify-fraud' => \App\Workflows\Activities\VerifyFraudScoreActivity::class,
    'send-notification' => \App\Workflows\Activities\SendNotificationActivity::class,
],</code></pre>

    <p>
        When the activity finishes, its returned array merges deterministically back into the process <code>$userData</code> payload.
    </p>

    <h2>2. User Tasks (Human-in-the-Loop Hibernation)</h2>
    <p>
        Unlike script-based jobs that must execute to completion within standard worker timeouts, real-world business processes often pause for human intervention (approvals, form entries, or signatures).
    </p>

    <h3>How Hibernation Works</h3>
    <p>When an execution token arrives at a <code>userTask</code> node:</p>
    <ol>
        <li>The engine yields an awaitable signal inbox method: <code>#[SignalMethod] submitUserTask($taskId, $payload)</code>.</li>
        <li>The coroutine suspends execution immediately.</li>
        <li>The queue worker commits the current execution pointer to <code>workflow_tokens</code> and frees itself to pick up other application jobs.</li>
        <li><strong>No worker processes, CPU cycles, or threads are held in memory while awaiting user action.</strong></li>
    </ol>

    <div class="my-6 p-4 rounded-xl bg-slate-900 text-slate-300 font-mono text-xs border border-slate-800 leading-relaxed overflow-x-auto">
        <pre>
        [Token Enters User Task]
               │
               ▼
        Yields Awaitable Signal ──► Database Checkpoint Saved ──► Queue Worker Released
                                                                        │
                                                                        ▼
                                                               (Hours or Days Later)
                                                                        │
                                                                        ▼
        Queue Worker Resumes ◄── Workflow Stub Woken Up ◄── Signal Received via HTTP/UI
        </pre>
    </div>

    <h3>Resuming via Signal</h3>
    <p>When an authorized user submits their review in the host application, dispatch a signal:</p>

    <pre><code class="language-php">use Saccharine\Bpmn\Facades\Bpmn;

Bpmn::signalInstance($workflowInstanceId, 'submitUserTask', [
    'task_id' => 'manager_approval_node',
    'approved' => true,
    'reviewed_by' => auth()->id(),
]);</code></pre>

    <p>
        The durable engine locates the hibernated instance, verifies the inbox signal, and dispatches a queue job to advance the token down outgoing sequence flows.
    </p>

    <h2>3. Gateways & Sandboxed Expressions</h2>

    <h3>Exclusive Gateways (XOR)</h3>
    <p>
        Exclusive Gateways evaluate conditions on outgoing sequence flows and select exactly one path.
    </p>
    <p>
        To prevent code injection and avoid raw PHP <code>eval()</code>, conditions are parsed safely through <strong>Symfony ExpressionLanguage</strong> with the instance payload injected into scope:
    </p>

    <pre><code class="language-xml">&lt;!-- Example compiled sequence flow condition --&gt;
&lt;bpmn:sequenceFlow id="Flow_1" sourceRef="Gateway_XOR" targetRef="Task_Approval"&gt;
  &lt;bpmn:conditionExpression xsi:type="bpmn:tFormalExpression"&gt;
    order_total &gt;= 1000 and customer_tier in ['vip', 'enterprise']
  &lt;/bpmn:conditionExpression&gt;
&lt;/bpmn:sequenceFlow&gt;</code></pre>

    <p>
        If no condition evaluates to <code>true</code>, the engine routes through the designated <code>default</code> sequence flow.
    </p>

    <h3>Parallel Gateways (AND Splits & Joins)</h3>
    <p>When a process branches across a Parallel Gateway:</p>
    <ol>
        <li>The engine creates isolated child coroutine stubs for each outgoing branch.</li>
        <li>Active tokens are tracked independently across concurrent branches in <code>workflow_tokens</code>.</li>
        <li>At the converging join gateway, the engine executes a barrier join:
            <pre><code class="language-php">yield all($parallelBranchStubs);</code></pre>
        </li>
        <li>Only when <strong>all</strong> parallel branches have finished does the parent workflow resume and proceed to downstream nodes.</li>
    </ol>

    <h2>4. Replay Safety & Determinism</h2>
    <p>
        Durable coroutines operate on an <strong>event-sourcing model</strong>. When a suspended workflow wakes after an inbox signal or worker restart, the coroutine function replays from the beginning, checking off previously recorded events against its history log.
    </p>

    <h3>Protecting Side-Effects via <code>WorkflowStub::sideEffect()</code></h3>
    <p>
        If an activity writes directly to an external API or database during execution, a coroutine replay could inadvertently execute those operations multiple times:
    </p>

    <pre><code class="language-php">// ❌ DANGEROUS: Re-executes multiple times during coroutine replays!
DB::table('orders')->where('id', $orderId)->update(['status' => 'processing']);

// ✅ SAFE: Wrapped in sideEffect to run once and cache during replays
WorkflowStub::sideEffect(function () use ($nodeId, $userData) {
    WorkflowHistory::create([
        'workflow_instance_id' => $this->instanceId,
        'node_id' => $nodeId,
        'payload_snapshot' => $userData,
    ]);
});</code></pre>

    <p>
        During the initial run, the closure executes and caches its return value. During subsequent replays, the engine skips closure execution and returns the cached result directly.
    </p>

    <h2>5. Lifecycle Controls: Suspend, Resume, and Halt</h2>
    <p>Workflows support administrative lifecycle commands via #[SignalMethod] handlers:</p>
    <ul>
        <li><strong>Suspend:</strong> Pauses execution at the next node barrier. The workflow yields <code>await(fn () =&gt; !$this-&gt;isSuspended)</code>.</li>
        <li><strong>Resume:</strong> Clears the suspension flag and wakes queue workers to process pending steps.</li>
        <li><strong>Halt:</strong> Aborts the workflow instance permanently, writes a cancellation audit record, and terminates all active tokens.</li>
    </ul>
@endsection