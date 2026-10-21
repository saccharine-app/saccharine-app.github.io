---
title: Saccharine - Composable Operational Modules for Laravel
description: Open-source, domain-agnostic Laravel packages for durable workflows, dynamic quoting, document pipelines, and operational triage.
---
@extends('_layouts.main')

@section('content')
    <!-- Hero / Ecosystem Vision -->
    <header class="bg-animated-gradient border-b border-slate-100">
        <div class="container mx-auto px-6 py-20 md:py-24 text-center max-w-4xl">
            <div class="flex items-center justify-center gap-2 mb-6">
                <span class="px-3.5 py-1 bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-mono font-bold rounded-full uppercase tracking-wider">
                    Open Source Laravel Ecosystem
                </span>
                <span class="px-3 py-1 bg-slate-100 border border-slate-200 text-slate-600 text-xs font-mono rounded-full hidden sm:inline-block">
                    PHP 8.3+ & Laravel 12/13
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6 tracking-tight">
                Composable modules for <br class="hidden sm:inline">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-indigo-400">
                    complex operational software.
                </span>
            </h1>

            <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                Saccharine is an evolving collection of headless, domain-agnostic Laravel packages built to solve high-stakes operational problems—from executable workflows to temporal pricing and document ledgers.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-sm font-semibold">
                <a href="/bpmn" class="w-full sm:w-auto px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg transition shadow-md shadow-indigo-600/20 flex items-center justify-center gap-2">
                    <span>Explore BPMN Workflows</span>
                    <span>&rarr;</span>
                </a>
                <a href="https://github.com/saccharine-app" target="_blank" rel="noopener" class="w-full sm:w-auto px-6 py-3.5 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-lg transition shadow-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 fill-current text-slate-500" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                    <span>GitHub Organization</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Core Philosophy: Modularity & Pragmatism -->
    <section class="py-16 bg-white border-b border-slate-200">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm mb-3">
                        &infin;
                    </div>
                    <h3 class="font-bold text-slate-900 text-base">Domain-Agnostic Core</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        No hardcoded industry terminology. Every component is modeled around clean, generic enterprise primitives like dossiers, temporal ledgers, and token graphs.
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm mb-3">
                        &boxplus;
                    </div>
                    <h3 class="font-bold text-slate-900 text-base">Headless & Embeddable</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Use them in background queue workers, JSON APIs, or traditional Blade views. Opt-in Filament v5 plugins provide admin interfaces only when you want them.
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm mb-3">
                        &check;
                    </div>
                    <h3 class="font-bold text-slate-900 text-base">Tested in Isolation</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Each package is developed as a decoupled library with Pest and Orchestra Testbench, ensuring reliable behavior before touching your production app.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Primary Spotlight: saccharine/bpmn (Current Focus) -->
    <section class="py-20 bg-slate-50 border-b border-slate-200">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="flex items-center gap-2 mb-3">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-700">
                    Active Development & RFC
                </span>
            </div>
            
            <div class="bg-white rounded-2xl border border-slate-200 p-8 md:p-10 shadow-sm relative overflow-hidden">
                <div class="max-w-2xl space-y-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-xs font-mono font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded border border-indigo-100">
                            saccharine/bpmn
                        </span>
                        <span class="text-xs font-mono text-slate-400">v0.5.0-alpha</span>
                        <span class="text-xs font-mono text-slate-400">&bull;</span>
                        <span class="text-xs font-mono text-slate-500">Laravel 12 & 13</span>
                    </div>

                    <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Native BPMN 2.0 process orchestration for Laravel.
                    </h2>

                    <p class="text-slate-600 text-sm leading-relaxed">
                        Our primary active effort brings the open visual standard of BPMN 2.0 directly to PHP and Laravel queues. By bridging Camunda’s <code>bpmn-js</code> visual canvas with <code>durable-workflow</code> coroutines, your flowchart becomes durable, executable code without external Java engines.
                    </p>

                    <div class="grid sm:grid-cols-2 gap-3 pt-2 text-xs text-slate-700">
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">&check;</span>
                            <span>Relational graph parsing via XPath</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">&check;</span>
                            <span>Safe Symfony ExpressionLanguage</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">&check;</span>
                            <span>Human User Tasks with signal hibernation</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">&check;</span>
                            <span>Real-time SVG live token cockpit</span>
                        </div>
                    </div>

                    <div class="pt-6 flex flex-wrap items-center gap-4">
                        <a href="/bpmn" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-lg transition shadow-sm flex items-center gap-1.5">
                            <span>Explore BPMN Overview</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="/bpmn/docs/introduction" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-lg transition">
                            Documentation
                        </a>
                        <a href="/bpmn/docs/roadmap-rfc" class="px-4 py-2.5 text-xs text-slate-500 hover:text-slate-900 font-medium">
                            Join the RFC Discussion &rarr;
                        </a>
                    </div>
                </div>

                <!-- Code / Terminal Decoration -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs font-mono text-slate-500">
                    <div class="bg-slate-900 text-slate-300 px-3.5 py-2 rounded-lg border border-slate-800 flex items-center justify-between w-full sm:w-auto">
                        <span>composer require saccharine/bpmn</span>
                    </div>
                    <span class="text-[11px] text-slate-400">Open source under the MIT License</span>
                </div>
            </div>
        </div>
    </section>

    <!-- On the Horizon / Incubation Teasers -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="max-w-2xl mb-12">
                <span class="text-xs font-mono font-semibold uppercase tracking-wider text-slate-400">
                    Ecosystem Roadmap
                </span>
                <h2 class="text-2xl font-bold text-slate-900 mt-2">Modules in incubation</h2>
                <p class="text-slate-600 text-sm mt-1">
                    While BPMN is our primary active milestone, companion packages for common enterprise operational requirements are in active prototyping.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Companion 1: CPQ -->
                <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200/60">
                                saccharine/cpq
                            </span>
                            <span class="text-[10px] font-mono text-slate-400 uppercase">Prototype</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-2">Dynamic Quoting & Catalog</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Headless Configure-Price-Quote engine separating master accounting SKUs from local catalog offerings, backed by point-in-time temporal pricing ledgers.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 text-[11px] font-mono text-slate-400">
                        Status: Internal alpha
                    </div>
                </div>

                <!-- Companion 2: Documents -->
                <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono font-semibold text-sky-700 bg-sky-50 px-2 py-0.5 rounded border border-sky-200/60">
                                saccharine/documents
                            </span>
                            <span class="text-[10px] font-mono text-slate-400 uppercase">Prototype</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-2">Document Generation & Ledgers</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Stateless rendering pipeline (Gotenberg, Pdftk) coupled with an immutable audit ledger for storing, versioning, and e-signing compliance artifacts.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 text-[11px] font-mono text-slate-400">
                        Status: Internal alpha
                    </div>
                </div>

                <!-- Companion 3: Dashboard / Triage -->
                <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200/60">
                                saccharine/dashboard
                            </span>
                            <span class="text-[10px] font-mono text-slate-400 uppercase">Prototype</span>
                        </div>
                        <h3 class="font-bold text-slate-900 text-sm mb-2">Real-Time Operational Triage</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            High-density assembly-line triage board bundled as a zero-publish IIFE library with in-memory Pinia rule evaluations and Filament panel hooks.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 text-[11px] font-mono text-slate-400">
                        Status: Internal alpha
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Open Source Community Callout -->
    <section class="py-16 bg-slate-900 text-white">
        <div class="container mx-auto px-6 max-w-5xl flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-xl">
                <span class="text-xs font-mono uppercase tracking-wider text-indigo-400">Join the discussion</span>
                <h2 class="text-2xl font-bold mt-1">Help shape our open-source workflow architecture</h2>
                <p class="text-slate-400 text-sm mt-1 leading-relaxed">
                    We are validating our coroutine engine against real-world domain use cases. Check out the roadmap, review current limitations, and share your perspective.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="/bpmn/docs/roadmap-rfc" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-semibold text-xs transition">
                    View Roadmap & RFC &rarr;
                </a>
                <a href="https://github.com/saccharine-app" target="_blank" rel="noopener" class="px-5 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 rounded-lg font-semibold text-xs transition">
                    GitHub Org
                </a>
            </div>
        </div>
    </section>
@endsection