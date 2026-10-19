---
title: Saccharine BPMN - Visual Workflow Engine for Laravel
packageName: BPMN
githubUrl: https://github.com/saccharine-app/bpmn
packagistUrl: https://packagist.org/packages/saccharine/bpmn
demoUrl: https://demo.saccharine.app
---
@extends('_layouts.main')

@section('content')
    <!-- Developer Hero Section -->
    <header class="bg-slate-900 text-white border-b border-slate-800 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-900/30 via-slate-900/0 to-slate-900/0"></div>
        <div class="container mx-auto px-6 py-20 relative max-w-5xl">
            <div class="flex flex-wrap items-center gap-3 mb-6">
                <span class="px-3 py-1 bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 text-xs font-mono font-bold rounded-full uppercase">
                    v0.5.0-alpha
                </span>
                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-mono font-medium rounded-full">
                    PHP 8.3+
                </span>
                <span class="px-3 py-1 bg-slate-800 text-slate-300 border border-slate-700 text-xs font-mono rounded-full">
                    MIT Licensed
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                Native BPMN 2.0 orchestration <br class="hidden md:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-indigo-200">powered by your Laravel queues.</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mb-10 leading-relaxed font-normal">
                Visual process modeling via <code>bpmn-js</code> meets durable queue execution via <code>durable-workflow</code>. Model complex flows in browser, pause for human input, and handle parallel branching without Camunda or external Java runtimes.
            </p>

            <!-- Quick Action Bar -->
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center bg-slate-950 border border-slate-800 rounded-lg px-4 py-2.5 font-mono text-sm text-slate-300 shadow-inner">
                    <span class="text-indigo-400 mr-2 select-none">$</span>
                    <span>composer require saccharine/bpmn</span>
                </div>
                <a href="{{ $page->githubUrl }}" target="_blank" rel="noopener" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm rounded-lg transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                    <span>View on GitHub</span>
                </a>
                <a href="{{ $page->packagistUrl }}" target="_blank" rel="noopener" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 font-semibold text-sm rounded-lg transition-colors">
                    Packagist
                </a>
            </div>
        </div>
    </header>

    <!-- 50-Second Video Showcase -->
    <section class="py-16 bg-slate-950 border-b border-slate-800">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="mb-8">
                <span class="text-xs font-mono font-semibold uppercase tracking-wider text-indigo-400">Walkthrough</span>
                <h2 class="text-2xl md:text-3xl font-bold text-white mt-2">End-to-end execution in under a minute</h2>
                <p class="text-sm text-slate-400 mt-1">Design visual inputs $\rightarrow$ trigger on Eloquent creation $\rightarrow$ pause for approval $\rightarrow$ send mail.</p>
            </div>

            <!-- Video Player Shell -->
            <div class="rounded-xl overflow-hidden border border-slate-800 bg-slate-900 shadow-2xl relative">
                <video class="w-full h-auto block" controls autoplay loop muted playsinline poster="/assets/bpmn-js-screenshot.png">
                    <source src="https://github.com/user-attachments/assets/4b4f7225-0dec-4d8d-819e-0c8678654207" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Micro-tour steps -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 font-mono text-xs">
                <div class="p-3 bg-slate-900/60 border border-slate-800 rounded-lg">
                    <div class="text-indigo-400 font-bold mb-1">01. Model</div>
                    <div class="text-slate-400">Map inputs via visual element templates.</div>
                </div>
                <div class="p-3 bg-slate-900/60 border border-slate-800 rounded-lg">
                    <div class="text-indigo-400 font-bold mb-1">02. Trigger</div>
                    <div class="text-slate-400">Intercepts Eloquent lifecycle events.</div>
                </div>
                <div class="p-3 bg-slate-900/60 border border-slate-800 rounded-lg">
                    <div class="text-indigo-400 font-bold mb-1">03. Pause</div>
                    <div class="text-slate-400">State hibernates durably at User Task.</div>
                </div>
                <div class="p-3 bg-slate-900/60 border border-slate-800 rounded-lg">
                    <div class="text-indigo-400 font-bold mb-1">04. Resume</div>
                    <div class="text-slate-400">Token advances; delivers real email.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quickstart / Fast Test Drive -->
    <section class="py-16 bg-white border-b border-slate-100">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="mb-10">
                <span class="text-xs font-mono font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded">Quickstart</span>
                <h2 class="text-3xl font-bold text-slate-900 mt-3">Ready to tinker? 60-second setup</h2>
                <p class="text-slate-600 text-sm mt-1">Spin up the complete Order Processing demo workflow with seed diagrams and scaffolding.</p>
            </div>

            <div class="bg-slate-900 rounded-xl p-6 text-slate-200 font-mono text-xs md:text-sm border border-slate-800 shadow-lg space-y-4">
                <div>
                    <span class="text-slate-500 select-none"># 1. Install via composer and scaffold database + assets</span>
                    <div class="text-emerald-400 mt-1">composer require saccharine/bpmn</div>
                    <div class="text-emerald-400">php artisan bpmn:install</div>
                </div>

                <div>
                    <span class="text-slate-500 select-none"># 2. Seed pre-built demo workflows (Exclusive Gateways, User Tasks, Notifications)</span>
                    <div class="text-emerald-400 mt-1">php artisan bpmn:demo</div>
                </div>

                <div>
                    <span class="text-slate-500 select-none"># 3. Start worker and trigger an Eloquent order event</span>
                    <div class="text-emerald-400 mt-1">php artisan queue:work</div>
                    <div class="text-emerald-400">php artisan bpmn:test-order --amount=250</div>
                </div>
            </div>

            <p class="text-xs text-slate-500 mt-4">
                Open <code>/bpmn/workflows/definitions</code> in your browser to inspect and modify diagrams.
            </p>
        </div>
    </section>

    <!-- Code Mechanics Section -->
    <section class="py-16 bg-slate-50 border-b border-slate-200">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">How your app integrates with the engine</h2>
                <p class="text-slate-600 text-sm">Decoupled by design: generic BPMN canvas nodes map to concrete Laravel classes.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 font-mono text-xs">
                <!-- Activity Snippet -->
                <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                            <span class="font-bold text-slate-800">1. Service Task Activity</span>
                            <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded">App\Workflows\Activities</span>
                        </div>
                        <pre class="text-slate-700 leading-relaxed overflow-x-auto"><code>class SendNotificationActivity extends Activity
{
    public function execute(array $userData): array
    {
        Mail::to($userData['customer_email'])
            ->send(new OrderMailable($userData));

        return ['notified' => true];
    }
}</code></pre>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 text-slate-500 text-[11px] font-sans">
                        Receives immutable state payload, executes side-effects, and returns mutated data.
                    </div>
                </div>

                <!-- Model Trigger Snippet -->
                <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                            <span class="font-bold text-slate-800">2. Event-Driven Triggers</span>
                            <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded">Models\Order</span>
                        </div>
                        <pre class="text-slate-700 leading-relaxed overflow-x-auto"><code>use TriggersBpmnWorkflows;

// Automatically maps created, updated, 
// and deleted lifecycle events into
// idempotent BPMN Start Events.
Order::create([
    'total' => 250.00,
    'status' => 'pending'
]);</code></pre>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 text-slate-500 text-[11px] font-sans">
                        Uses business keys to guarantee that a specific record event never triggers duplicates.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Architecture & Feature Highlights -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-left mb-12">
                <span class="text-xs font-mono font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded">Architecture</span>
                <h2 class="text-3xl font-bold text-slate-900 mt-3">Under the Hood</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 mb-2 text-sm">Deterministic State Machine</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Generator-based execution with `durable-workflow` ensures that if workers restart mid-stream, processes recover seamlessly from their exact node.
                    </p>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 mb-2 text-sm">XML Graph Decomposition</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Strict XPath parsing breaks BPMN 2.0 XML into relational graph tables (`workflow_nodes`, `edges`), allowing fast indexed DB lookups rather than on-the-fly parsing.
                    </p>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 mb-2 text-sm">Parallel AND Coroutines</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Handles parallel gateway forks by spawning isolated child coroutine stubs and pausing the parent at a promise barrier until all concurrent paths join.
                    </p>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 mb-2 text-sm">Filament-First, Fallback Blade</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Runs either as a standalone UI or auto-detects Filament panels, dynamically adapting URLs and back-navigation without code changes.
                    </p>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 mb-2 text-sm">Sandboxed Expressions</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Exclusive Gateway decisions evaluate conditions against execution payloads safely via Symfony Expression Language without eval() risks.
                    </p>
                </div>

                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50/50">
                    <h3 class="font-bold text-slate-900 mb-2 text-sm">Live Token Cockpit</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Telemetry polling paired with `bpmn-js` `NavigatedViewer` highlights historical paths in blue, pulses active tokens in green, and enables one-click task resumes.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_cta')
    <div class="container mx-auto px-6 py-12 text-center max-w-4xl">
        <h3 class="text-2xl font-bold mb-3">Join the RFC & Community Discussion</h3>
        <p class="text-slate-400 max-w-xl mx-auto mb-6 text-sm">
            Check the roadmap on GitHub, explore open issues, or submit PRs for new BPMN 2.0 node handlers.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ $page->githubUrl }}" target="_blank" rel="noopener" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm rounded-lg transition-colors">
                Contribute on GitHub
            </a>
            <a href="https://github.com/saccharine-app/bpmn/blob/main/docs/usage-guide.md" target="_blank" rel="noopener" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-sm rounded-lg border border-slate-700 transition-colors">
                Read the Docs
            </a>
        </div>
    </div>
@endsection