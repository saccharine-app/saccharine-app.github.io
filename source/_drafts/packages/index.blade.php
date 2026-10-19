---
title: Modular Laravel Packages
packageName: Developer Packages
githubUrl: https://github.com/saccharine-app
demoUrl: https://demo.saccharine.app
---
@extends('_layouts.main')

@section('content')
    <!-- Header -->
    <header class="bg-slate-900 text-white border-b border-slate-800">
        <div class="container mx-auto px-6 py-20 max-w-5xl">
            <div class="flex items-center gap-2 mb-4">
                <span class="px-3 py-1 bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 text-xs font-mono font-semibold rounded-full uppercase">
                    Developer Hub
                </span>
                <span class="text-xs text-slate-400 font-mono">PHP 8.3+ • Laravel 11+ • MIT Licensed</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                Headless engines for modular monoliths.
            </h1>
            <p class="text-lg text-slate-300 max-w-3xl leading-relaxed">
                Adopt the complete integrated suite or install individual packages directly into your host Laravel application. Designed to be completely headless with zero vendor lock-in.
            </p>
        </div>
    </header>

    <!-- Package Grid -->
    <section class="py-16 bg-slate-50">
        <div class="container mx-auto px-6 max-w-5xl space-y-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Available Packages</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Tested in isolation with Orchestra Testbench and Pest.</p>
                </div>
            </div>

            <!-- Package 1: BPMN -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:border-indigo-300 transition flex flex-col md:flex-row justify-between gap-6">
                <div class="max-w-2xl space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-mono font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded">
                            saccharine/bpmn
                        </span>
                        <span class="text-xs text-slate-400 font-mono">v0.5.0-alpha</span>
                    </div>
                    <a href="/packages/bpmn" class="block group">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition">BPMN Workflow Execution Engine</h3>
                    </a>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        PHP-native BPMN 2.0 graph execution over standard Laravel queues via <code>durable-workflow</code>. Includes an embedded <code>bpmn-js</code> visual canvas, Expression Language gateways, and signal hibernation for human approvals.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2 text-[11px] font-mono text-slate-500">
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Queued State Engine</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Exclusive/Parallel Gateways</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Filament Shield Ready</span>
                    </div>
                </div>
                <div class="flex md:flex-col justify-between items-end gap-4 min-w-[200px]">
                    <div class="bg-slate-900 text-slate-200 px-3 py-2 rounded font-mono text-xs w-full text-center">
                        composer require saccharine/bpmn
                    </div>
                    <div class="flex items-center gap-3 w-full justify-end">
                        <a href="/packages/bpmn" class="px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold text-xs rounded-lg transition">
                            Package Specs &rarr;
                        </a>
                        <a href="https://github.com/saccharine-app/bpmn" target="_blank" rel="noopener" class="text-slate-400 hover:text-slate-700 text-xs">
                            GitHub
                        </a>
                    </div>
                </div>
            </div>

            <!-- Package 2: CPQ Catalog -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:border-amber-300 transition flex flex-col md:flex-row justify-between gap-6">
                <div class="max-w-2xl space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-mono font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded">
                            saccharine/cpq-contracts
                        </span>
                        <span class="text-xs text-slate-400 font-mono">v0.4.0-alpha</span>
                    </div>
                    <a href="/solutions/cpq" class="block group">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-600 transition">Dynamic Catalog & CPQ Engine</h3>
                    </a>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Headless Configure-Price-Quote system. Separates global accounting SKUs from local catalog offerings, uses temporal effective dating for historic auditability, and exports flattened manifests for $O(1)$ client lookup.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2 text-[11px] font-mono text-slate-500">
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Temporal Pricing Ledger</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Polymorphic Contexts</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Embedded Vue Configurator</span>
                    </div>
                </div>
                <div class="flex md:flex-col justify-between items-end gap-4 min-w-[200px]">
                    <div class="bg-slate-900 text-slate-200 px-3 py-2 rounded font-mono text-xs w-full text-center">
                        composer require saccharine/cpq-contracts
                    </div>
                    <div class="flex items-center gap-3 w-full justify-end">
                        <a href="/solutions/cpq" class="px-4 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold text-xs rounded-lg transition">
                            Architecture &rarr;
                        </a>
                        <a href="https://github.com/saccharine-app/cpq-contracts" target="_blank" rel="noopener" class="text-slate-400 hover:text-slate-700 text-xs">
                            GitHub
                        </a>
                    </div>
                </div>
            </div>

            <!-- Package 3: Document Generator -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:border-sky-300 transition flex flex-col md:flex-row justify-between gap-6">
                <div class="max-w-2xl space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-mono font-bold text-sky-600 bg-sky-50 px-2.5 py-1 rounded">
                            saccharine/documents
                        </span>
                        <span class="text-xs text-slate-400 font-mono">v0.3.0-alpha</span>
                    </div>
                    <a href="/solutions/documents" class="block group">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-sky-600 transition">Document Generation & Envelope Ledger</h3>
                    </a>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Stateless hydration pipeline paired with an immutable database ledger. Transforms complex Eloquent records via DTO mappers into PDFs using Gotenberg or Pdftk fillable PDF drivers.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2 text-[11px] font-mono text-slate-500">
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Blade/Markdown/TipTap/PDFtk</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Polymorphic Attachments</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">E-Signature Envelopes</span>
                    </div>
                </div>
                <div class="flex md:flex-col justify-between items-end gap-4 min-w-[200px]">
                    <div class="bg-slate-900 text-slate-200 px-3 py-2 rounded font-mono text-xs w-full text-center">
                        composer require saccharine/documents
                    </div>
                    <div class="flex items-center gap-3 w-full justify-end">
                        <a href="/solutions/documents" class="px-4 py-2 bg-sky-50 hover:bg-sky-100 text-sky-700 font-semibold text-xs rounded-lg transition">
                            Architecture &rarr;
                        </a>
                        <a href="https://github.com/saccharine-app/documents" target="_blank" rel="noopener" class="text-slate-400 hover:text-slate-700 text-xs">
                            GitHub
                        </a>
                    </div>
                </div>
            </div>

            <!-- Package 4: Dashboard Engine -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:border-emerald-300 transition flex flex-col md:flex-row justify-between gap-6">
                <div class="max-w-2xl space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-mono font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded">
                            saccharine/dashboard
                        </span>
                        <span class="text-xs text-slate-400 font-mono">v0.1.0-alpha</span>
                    </div>
                    <a href="/solutions/operations" class="block group">
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-emerald-600 transition">Operational Triage Dashboard</h3>
                    </a>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        In-memory reactive triage board bundled as a self-contained IIFE library. Eliminates recurring database polling by filtering case datasets client-side via Pinia and dynamically configured JSON rule cards.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2 text-[11px] font-mono text-slate-500">
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Vue 3 + Pinia IIFE Bundle</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">In-Memory Rule Evaluator</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded">Filament Scoped Hooks</span>
                    </div>
                </div>
                <div class="flex md:flex-col justify-between items-end gap-4 min-w-[200px]">
                    <div class="bg-slate-900 text-slate-200 px-3 py-2 rounded font-mono text-xs w-full text-center">
                        composer require saccharine/dashboard
                    </div>
                    <div class="flex items-center gap-3 w-full justify-end">
                        <a href="/solutions/operations" class="px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold text-xs rounded-lg transition">
                            Operational View &rarr;
                        </a>
                        <a href="https://github.com/saccharine-app" target="_blank" rel="noopener" class="text-slate-400 hover:text-slate-700 text-xs">
                            GitHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testing & Integration Callout -->
    <section class="py-16 bg-white border-t border-slate-200">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="text-xs font-mono font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded">Testing Strategy</span>
                    <h2 class="text-2xl font-bold text-slate-900 mt-3 mb-4">Tested in isolation. Reliable in production.</h2>
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Every package in the Saccharine ecosystem is developed and tested independently using <strong>Orchestra Testbench</strong> and <strong>Pest</strong>. You never need a full-blown host application just to verify workflow state transitions or pricing manifests.
                    </p>
                    <ul class="text-xs text-slate-600 space-y-2">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Fast, in-memory SQLite database execution
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Composer path symlinking for local monorepo workspaces
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span> Pre-compiled JavaScript bundles with zero node dependency on the host
                        </li>
                    </ul>
                </div>
                <div class="bg-slate-900 rounded-xl p-5 text-slate-200 font-mono text-xs border border-slate-800 shadow-md">
                    <div class="text-slate-500 pb-2 border-b border-slate-800 mb-3">Orchestra Testbench execution</div>
                    <div class="text-slate-400">$ ./vendor/bin/pest</div>
                    <div class="text-emerald-400 mt-2">PASS Tests\Feature\BpmnExecutionTest</div>
                    <div class="text-slate-300">  ✓ it handles exclusive gateway expressions</div>
                    <div class="text-slate-300">  ✓ it hibernates state durably at user tasks</div>
                    <div class="text-slate-300">  ✓ it resumes execution upon receiving signal</div>
                    <div class="text-emerald-400 mt-2">PASS Tests\Feature\CatalogPricingTest</div>
                    <div class="text-slate-300">  ✓ it resolves point-in-time temporal price</div>
                    <div class="text-slate-300">  ✓ it compiles normalized quote manifest</div>
                    <div class="text-slate-500 mt-3 pt-2 border-t border-slate-800">
                        Tests: 18 passed (42 assertions)
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection