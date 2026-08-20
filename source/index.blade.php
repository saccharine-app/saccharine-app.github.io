---
demoUrl: https://demo.saccharine.app
---
@extends('_layouts.main')

@section('content')
    <!-- Hero Section -->
    <header class="bg-animated-gradient border-b border-slate-100">
        <div class="container mx-auto px-6 py-24 text-center max-w-4xl">
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                Enterprise operations without monolithic vendor lock-in.
            </h1>
            <p class="text-xl text-slate-600 mb-10 leading-relaxed">
                Saccharine is an open-source suite of independent, modular engines designed to automate complex workflows, manage dynamic pricing, and generate compliant documentation.
            </p>
        </div>
    </header>

    <!-- The Value Pillars -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-5 bg-white border border-slate-200 rounded-xl space-y-2">
                    <h3 class="font-bold text-slate-900 text-base">Own Your Code & Data</h3>
                    <p class="text-sm text-slate-600">Free from proprietary subscription walls and vendor lock-in. Run it on your terms with standard open-source licenses.</p>
                </div>
                <div class="p-5 bg-white border border-slate-200 rounded-xl space-y-2">
                    <h3 class="font-bold text-slate-900 text-base">Modular by Design</h3>
                    <p class="text-sm text-slate-600">Adopt the entire integrated suite or use standalone packages inside existing Laravel applications.</p>
                </div>
                <div class="p-5 bg-white border border-slate-200 rounded-xl space-y-2">
                    <h3 class="font-bold text-slate-900 text-base">Audit-Proof Accuracy</h3>
                    <p class="text-sm text-slate-600">Built-in point-in-time pricing and historical document versioning protect operational integrity.</p>
                </div>
            </div>
        </div>
    </section>

    <hr class="border-slate-100" />

    <!-- Technical Architecture Section -->
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6 max-w-5xl space-y-6">
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Core Operational Modules</h2>
                    <p class="text-sm text-slate-500">Explore each package or drill down into its technical implementation.</p>
                </div>
            </div>

            <!-- BPMN Engine Card -->
            <div class="p-6 bg-white border border-slate-200 rounded-xl space-y-4 hover:border-slate-700 transition">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Workflow Orchestration</span>
                        <h3 class="text-xl font-bold text-slate-900">BPMN Process Engine</h3>
                    </div>
                    <span class="inline-flex items-center text-xs text-emerald-400 font-mono bg-emerald-500/10 px-2.5 py-1 rounded border border-emerald-500/20 w-fit">
                        saccharine/bpmn-engine
                    </span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Turns standard visual flowcharts (BPMN 2.0) into durable background tasks. Handles automated actions, human approvals, timeouts, and error escalations without relying on third-party SaaS workflow engines.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-4 text-sm font-medium border-t border-slate-200/80">
                    <a href="https://github.com/saccharine-app/bpmn-engine" class="text-indigo-600 hover:text-indigo-300">GitHub Repository &rarr;</a>
                    <a href="https://packagist.org/packages/saccharine/bpmn-engine" class="text-slate-400 hover:text-slate-200">Packagist</a>
                </div>
            </div>

            <!-- CPQ Engine Card -->
            <div class="p-6 bg-white border border-slate-200 rounded-xl space-y-4 hover:border-slate-700 transition">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-semibold text-amber-400 uppercase tracking-wider">Pricing & Configuration</span>
                        <h3 class="text-xl font-bold text-slate-900">Dynamic Catalog & CPQ Engine</h3>
                    </div>
                    <span class="inline-flex items-center text-xs text-emerald-400 font-mono bg-emerald-500/10 px-2.5 py-1 rounded border border-emerald-500/20 w-fit">
                        saccharine/cpq-contracts
                    </span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Headless Configure-Price-Quote system for complex products and services. Features point-in-time temporal pricing, multi-location catalog aliasing, and an instant reactive frontend configurator.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-4 text-sm font-medium border-t border-slate-200/80">
                    <a href="https://github.com/saccharine-app/cpq-contracts" class="text-indigo-600 hover:text-indigo-300">GitHub Repository &rarr;</a>
                    <!-- <a href="https://packagist.org/packages/saccharine/cpq-contracts" class="text-slate-400 hover:text-slate-200">Packagist</a> -->
                </div>
            </div>
            
            <!-- Document Manager Card -->
            <div class="p-6 bg-white border border-slate-200 rounded-xl space-y-4 hover:border-slate-700 transition">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-semibold text-sky-400 uppercase tracking-wider">Compliance & Paperwork</span>
                        <h3 class="text-xl font-bold text-slate-900">Document Generation & Envelope Ledger</h3>
                    </div>
                    <span class="inline-flex items-center text-xs text-emerald-400 font-mono bg-emerald-500/10 px-2.5 py-1 rounded border border-emerald-500/20 w-fit">
                        saccharine/documents
                    </span>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Converts dynamic application data into compliant PDFs (via Blade, Markdown, or fillable PDF templates). Tracks document versions over time and manages e-signature envelope lifecycles.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-4 text-sm font-medium border-t border-slate-200/80">
                    <a href="https://github.com/saccharine-app/documents" class="text-indigo-600 hover:text-indigo-300">GitHub Repository &rarr;</a>
                    <!-- <a href="https://packagist.org/packages/saccharine/documents" class="text-slate-400 hover:text-slate-200">Packagist</a> -->
                </div>
            </div>
            
            <hr class="border-slate-200" />

            <!-- Architecture Summary Callout -->
            <div class="bg-white p-6 rounded-xl border border-slate-200 space-y-3">
                <h3 class="font-semibold text-slate-900 text-base">The Modular Monolith Advantage</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Rather than forcing businesses into a rigid, all-or-nothing software suite, Saccharine components operate independently while fitting together cleanly. This reduces key person risk, invites open-source collaboration, and provides total control over business logic and data.
                </p>
            </div>
        </div>
    </section>
@endsection