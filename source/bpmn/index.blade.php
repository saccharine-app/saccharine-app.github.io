---
title: Saccharine BPMN - Visual Workflows for Laravel
description: Native BPMN 2.0 graph orchestration running over Laravel background queues without external Java runtimes.
---
@extends('_layouts.main')

@section('content')
    <!-- Hero Section -->
    <header class="bg-animated-gradient border-b border-slate-100">
        <div class="container mx-auto px-6 py-20 text-center max-w-4xl">
            <div class="flex items-center justify-center gap-2 mb-6">
                <span class="px-3 py-1 bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-mono font-bold rounded-full uppercase tracking-wider">
                    v0.5.0-alpha
                </span>
                <span class="px-3 py-1 bg-slate-100 border border-slate-200 text-slate-600 text-xs font-mono rounded-full">
                    PHP 8.3 / 8.4
                </span>
                <span class="px-3 py-1 bg-slate-100 border border-slate-200 text-slate-600 text-xs font-mono rounded-full">
                    Laravel 12 & 13
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6 tracking-tight">
                Executable BPMN workflows. <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-indigo-400">
                    Native to Laravel.
                </span>
            </h1>

            <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed max-w-3xl mx-auto">
                Model complex multi-step processes in your browser with Camunda's <code>bpmn-js</code>, and execute them durably using standard Laravel queues and <code>durable-workflow</code>.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-sm font-semibold">
                <a href="/bpmn/docs/introduction" class="w-full sm:w-auto px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg transition shadow-md shadow-indigo-600/20 flex items-center justify-center gap-2">
                    <span>Read Documentation</span>
                    <span>&rarr;</span>
                </a>
                <a href="https://demo.saccharine.app" target="_blank" rel="noopener" class="w-full sm:w-auto px-6 py-3.5 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-lg transition shadow-sm flex items-center justify-center gap-2">
                    <span>Launch Live Sandbox</span>
                    <span class="text-slate-400">&nearr;</span>
                </a>
            </div>

            <!-- Install command snippet -->
            <div class="mt-8 max-w-md mx-auto">
                <div class="bg-slate-900 text-slate-300 font-mono text-xs px-4 py-3 rounded-lg border border-slate-800 flex justify-between items-center shadow-inner">
                    <span>composer require saccharine/bpmn</span>
                    <span class="text-slate-500 text-[10px]">MIT</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Standing on the Shoulders of Giants (Attribution Strip) -->
    <section class="py-16 bg-white border-b border-slate-200">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-mono font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded">Integration Architecture</span>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mt-3">An integration bridge on proven foundations</h2>
                <p class="text-slate-600 text-sm mt-2">
                    <code>saccharine/bpmn</code> is not built from scratch in isolation. It unites industry-standard tools into a cohesive, native Laravel package.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Tool 1: bpmn-js -->
                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 flex flex-col justify-between">
                    <div>
                        <div class="font-bold text-slate-900 text-sm mb-1">bpmn-js (Camunda)</div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Powers the embeddable visual SVG modeler, custom palettes, and live execution telemetry tracking.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/80 text-[11px] font-mono text-indigo-600">
                        Camunda / bpmn.io
                    </div>
                </div>

                <!-- Tool 2: durable-workflow -->
                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 flex flex-col justify-between">
                    <div>
                        <div class="font-bold text-slate-900 text-sm mb-1">durable-workflow</div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Deterministic coroutines, database snapshots, and inbox signals for human-in-the-loop tasks.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/80 text-[11px] font-mono text-indigo-600">
                        durable-workflow.com
                    </div>
                </div>

                <!-- Tool 3: Symfony ExpressionLanguage -->
                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 flex flex-col justify-between">
                    <div>
                        <div class="font-bold text-slate-900 text-sm mb-1">Symfony Expression</div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Evaluates Exclusive Gateway routing rules safely against payload state without PHP <code>eval()</code>.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/80 text-[11px] font-mono text-indigo-600">
                        symfony.com
                    </div>
                </div>

                <!-- Tool 4: Laravel Queues -->
                <div class="p-5 rounded-xl border border-slate-200 bg-slate-50 flex flex-col justify-between">
                    <div>
                        <div class="font-bold text-slate-900 text-sm mb-1">Native Laravel</div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Runs entirely on your existing queues (Redis/SQS/DB) and standard Eloquent relational migrations.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/80 text-[11px] font-mono text-indigo-600">
                        laravel.com
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- The 3 Pillars Section -->
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-slate-900">Stop translating whiteboards into spaghetti code</h2>
                <p class="text-slate-600 text-sm mt-2">
                    When the diagram is the software, changes to routing, delays, and approvals are visible, auditable, and self-documenting.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold mb-4 border border-indigo-100">
                        1
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Visual Process Modeling</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Design and edit workflows directly in your browser or Filament panel. Custom palettes ensure users only model nodes supported by the queue engine.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold mb-4 border border-indigo-100">
                        2
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Zero-Worker Blocking</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        User tasks and timers hibernate safely in relational tables. Queue workers are released instantly and only resume when approvals or timers fire.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold mb-4 border border-indigo-100">
                        3
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Live Token Cockpit</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Inspect active instances with real-time SVG overlays. Completed steps turn blue, active waiting tasks pulse green, and one-click actions resume workflows.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Walkthrough CTA -->
    <section class="py-16 bg-slate-900 text-white">
        <div class="container mx-auto px-6 max-w-5xl flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
                <span class="text-xs font-mono uppercase tracking-wider text-indigo-400">Ready to explore?</span>
                <h2 class="text-2xl font-bold mt-1">Get started with our 5-minute quickstart guide</h2>
                <p class="text-slate-400 text-sm mt-1">
                    Install the package, seed the test fulfillment workflow, and run your first process.
                </p>
            </div>
            <a href="/bpmn/docs/quickstart" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-semibold text-sm transition whitespace-nowrap">
                Start Quickstart &rarr;
            </a>
        </div>
    </section>
@endsection