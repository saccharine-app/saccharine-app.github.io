---
title: Operational Triage & Dispatch
packageName: Solutions
githubUrl: https://github.com/saccharine-app
demoUrl: https://demo.saccharine.app
---
@extends('_layouts.main')

@section('content')
    <!-- Business Hero -->
    <header class="bg-animated-gradient border-b border-slate-100">
        <div class="container mx-auto px-6 py-24 text-center max-w-4xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-semibold rounded-full mb-6 uppercase tracking-wider">
                Operational Command Center
            </span>
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                Never lose an active case <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">in the cracks.</span>
            </h1>
            <p class="text-xl text-slate-600 mb-10 leading-relaxed max-w-3xl mx-auto">
                Real-time dispatch, task tracking, and compliance monitoring designed for teams handling hundreds of simultaneous cases without missing a step.
            </p>
            <div class="flex justify-center gap-4 text-sm font-semibold">
                <a href="https://demo.saccharine.app" target="_blank" rel="noopener" class="px-6 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg transition shadow-md shadow-emerald-600/20">
                    Launch Interactive Demo &rarr;
                </a>
                <a href="#how-it-works" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition">
                    How Triage Works
                </a>
            </div>
        </div>
    </header>

    <!-- Operational Relief Pillars -->
    <section id="how-it-works" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-3">Designed for daily operations, not just monthly charts</h2>
                <p class="text-slate-600 text-sm max-w-2xl mx-auto">
                    Most CRM dashboards are built for retrospective analytics. Saccharine gives your staff a real-time dispatch board that flags bottlenecks before they become emergencies.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Column 1 -->
                <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-xl mb-4 border border-emerald-100">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Instant Bottleneck Triage</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Group active files dynamically by missing requirements—such as unsigned compliance waivers, pending dispatch schedules, or manager approvals.
                    </p>
                </div>

                <!-- Column 2 -->
                <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-xl mb-4 border border-emerald-100">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Manager-Configured Rules</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        When a regulatory authority changes requirements, managers can create a new tracking widget in 30 seconds without submitting an IT ticket or deploying code.
                    </p>
                </div>

                <!-- Column 3 -->
                <div class="p-6 rounded-xl border border-slate-200 bg-slate-50/50">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-xl mb-4 border border-emerald-100">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Zero-Latency In-Memory Speed</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Filtering and column sorting occur instantly in the browser memory. The system can support dozens of active dispatchers without grinding the database to a halt.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visual Dashboard Mockup -->
    <section class="py-16 bg-slate-50 border-y border-slate-200">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">
                <!-- Mock Dashboard Header -->
                <div class="bg-slate-900 text-white px-6 py-4 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="h-3 w-3 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="font-bold text-sm tracking-wide">Live Operations Board</span>
                        <span class="text-xs text-slate-400 font-mono">148 Active Files</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="bg-slate-800 text-slate-300 px-3 py-1.5 rounded border border-slate-700">Filter: Branch All</span>
                        <span class="bg-emerald-600 text-white font-semibold px-3 py-1.5 rounded">+ Add Custom Widget</span>
                    </div>
                </div>

                <!-- Mock Board Columns -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-slate-100/60">
                    <!-- Widget 1: Compliance Hold -->
                    <div class="bg-white border-t-4 border-t-amber-500 border border-slate-200 rounded-xl p-4 shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-sm text-slate-900">Compliance Hold (Missing Forms)</h4>
                            <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold rounded-full">3</span>
                        </div>
                        <div class="space-y-2 text-xs">
                            <div class="p-2.5 bg-slate-50 rounded border border-slate-200 flex justify-between items-center">
                                <div>
                                    <div class="font-semibold text-slate-800">CASE-1048</div>
                                    <div class="text-slate-500">Missing Cremation Authorization</div>
                                </div>
                                <span class="text-[10px] bg-rose-100 text-rose-700 px-2 py-0.5 rounded font-bold">Urgent</span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded border border-slate-200 flex justify-between items-center">
                                <div>
                                    <div class="font-semibold text-slate-800">CASE-1052</div>
                                    <div class="text-slate-500">Awaiting Coroner Clearance</div>
                                </div>
                                <span class="text-[10px] bg-amber-100 text-amber-700 px-2 py-0.5 rounded font-bold">2h</span>
                            </div>
                        </div>
                    </div>

                    <!-- Widget 2: Inbound Dispatch -->
                    <div class="bg-white border-t-4 border-t-indigo-600 border border-slate-200 rounded-xl p-4 shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-sm text-slate-900">Inbound Transfers</h4>
                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 border border-indigo-200 text-xs font-bold rounded-full">4</span>
                        </div>
                        <div class="space-y-2 text-xs">
                            <div class="p-2.5 bg-slate-50 rounded border border-slate-200 flex justify-between items-center">
                                <div>
                                    <div class="font-semibold text-slate-800">CASE-1056</div>
                                    <div class="text-slate-500">Hospital Transfer • Unit 3</div>
                                </div>
                                <span class="text-[10px] bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded font-bold">En Route</span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded border border-slate-200 flex justify-between items-center">
                                <div>
                                    <div class="font-semibold text-slate-800">CASE-1057</div>
                                    <div class="text-slate-500">Residential Transfer • Unit 1</div>
                                </div>
                                <span class="text-[10px] bg-slate-200 text-slate-700 px-2 py-0.5 rounded font-bold">Pending</span>
                            </div>
                        </div>
                    </div>

                    <!-- Widget 3: Document Signature Pending -->
                    <div class="bg-white border-t-4 border-t-sky-500 border border-slate-200 rounded-xl p-4 shadow-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-sm text-slate-900">Ready for E-Signature</h4>
                            <span class="px-2 py-0.5 bg-sky-50 text-sky-700 border border-sky-200 text-xs font-bold rounded-full">2</span>
                        </div>
                        <div class="space-y-2 text-xs">
                            <div class="p-2.5 bg-slate-50 rounded border border-slate-200 flex justify-between items-center">
                                <div>
                                    <div class="font-semibold text-slate-800">CASE-1049</div>
                                    <div class="text-slate-500">Contract Envelope Dispatched</div>
                                </div>
                                <span class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded font-bold">Sent</span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded border border-slate-200 flex justify-between items-center">
                                <div>
                                    <div class="font-semibold text-slate-800">CASE-1055</div>
                                    <div class="text-slate-500">Contract Staged for Review</div>
                                </div>
                                <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded font-bold">Review</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technical Architecture Transition Anchor -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="p-8 bg-slate-50 border border-slate-200 rounded-2xl flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <span class="text-xs font-mono font-semibold uppercase tracking-wider text-indigo-600">Engineering Implementation</span>
                    <h3 class="text-xl font-bold text-slate-900 mt-1">Want to see how this is implemented in code?</h3>
                    <p class="text-sm text-slate-600 mt-1">
                        Inspect the underlying Vue 3 + Pinia component, JSON rule engine schemas, and scoped Filament render hooks.
                    </p>
                </div>
                <a href="/packages" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm rounded-lg transition whitespace-nowrap">
                    View Package Specs &rarr;
                </a>
            </div>
        </div>
    </section>
@endsection