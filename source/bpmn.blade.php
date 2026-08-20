---
title: Visual Workflow Automation
packageName: BPMN
githubUrl: https://github.com/saccharine-app/bpmn-engine
packagistUrl: https://packagist.org/packages/saccharine/bpmn-engine
demoUrl: https://demo.saccharine.app
---
@extends('_layouts.main')

@section('content')
    <!-- Hero Section -->
    <header class="bg-animated-gradient border-b border-slate-100">
        <div class="container mx-auto px-6 py-24 text-center max-w-4xl">
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                What if your business flowchart <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-indigo-400">was the actual software?</span>
            </h1>
            <p class="text-xl text-slate-600 mb-10 leading-relaxed">
                Usually, stakeholders draw how a company should run on a whiteboard, and developers spend months trying to code it. We built a tool that skips the translation: <strong>draw the map, and the software runs it automatically.</strong>
            </p>
        </div>
    </header>

    <!-- The "How It Works" Section -->
    <section class="py-20 bg-white space-y-6">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">How It Works</h2>
                <div class="w-24 h-1 bg-indigo-500 mx-auto rounded"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-indigo-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">1. Draw the Process</h3>
                    <p class="text-slate-600">Use our visual, drag-and-drop web canvas to map out a business process. Connect tasks, set routing rules, and define the finish line.</p>
                </div>
                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-indigo-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">2. The Engine Takes Over</h3>
                    <p class="text-slate-600">The software reads your drawing like a set of instructions. It silently moves behind the scenes, following the exact paths and logic you designed.</p>
                </div>
                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-indigo-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">3. Work Gets Done</h3>
                    <p class="text-slate-600">It halts for human approvals, calculates complex pricing via the CPQ module, or outputs signed PDFs, automating operational overhead.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Abstract Visual Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="relative bg-white p-8 md:p-12 rounded-2xl shadow-xl border border-slate-200 max-w-lg mx-auto">
                <!-- Soft background glow -->
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-indigo-300 rounded-2xl blur opacity-10"></div>
                
                <div class="relative space-y-0">
                    <!-- Start Event -->
                    <div class="flex justify-center"><div class="w-10 h-10 rounded-full border-[3px] border-emerald-400 bg-emerald-50"></div></div>
                    <div class="flex justify-center"><div class="w-0.5 h-6 bg-slate-300"></div></div>
                    
                    <!-- Automated Task -->
                    <div class="bg-indigo-50 border border-indigo-200 text-indigo-800 text-center py-3 rounded-lg font-semibold text-sm shadow-sm relative z-10">
                        Automated Task: Check Order Value
                    </div>
                    <div class="flex justify-center"><div class="w-0.5 h-6 bg-slate-300"></div></div>
                    
                    <!-- Gateway Diamond -->
                    <div class="flex justify-center relative z-20">
                        <div class="w-8 h-8 bg-amber-50 border-[3px] border-amber-400 transform rotate-45"></div>
                    </div>
                    
                    <!-- Branching Connector Lines -->
                    <div class="flex justify-center px-[25%] mt-[-16px]">
                        <div class="w-1/2 border-t-2 border-l-2 border-slate-300 rounded-tl-xl h-8 translate-x-[1px]"></div>
                        <div class="w-1/2 border-t-2 border-r-2 border-slate-300 rounded-tr-xl h-8 -translate-x-[1px]"></div>
                    </div>
                    
                    <!-- Outcomes -->
                    <div class="flex justify-between gap-6 mt-[-10px]">
                        <div class="w-1/2 flex flex-col items-center">
                            <span class="text-[10px] text-slate-500 font-bold mb-2 bg-white px-2 relative z-10">Order &lt; $1k</span>
                            <div class="bg-slate-50 border border-slate-200 text-slate-700 text-center w-full py-2.5 rounded-lg font-semibold text-xs shadow-sm">Send Email</div>
                        </div>
                        <div class="w-1/2 flex flex-col items-center">
                            <span class="text-[10px] text-slate-500 font-bold mb-2 bg-white px-2 relative z-10">Order &gt; $1k</span>
                            <div class="bg-indigo-600 border border-indigo-700 text-white text-center w-full py-2.5 rounded-lg font-semibold text-xs shadow-sm flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Await Approval
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <hr class="border-slate-100" />

    <!-- Technical Architecture Section -->
    <section class="py-20 bg-slate-50">
       <div class="container mx-auto px-6 max-w-5xl">
            <div class="mb-12">
                <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">Under the Hood</span>
                <h2 class="text-3xl font-bold text-slate-900 mt-4 mb-4">Architecture & Engineering</h2>
                <p class="text-slate-600 max-w-2xl">
                    Built natively for modern PHP, this package delivers enterprise-grade workflow orchestration without the heavy infrastructure, Java dependencies, or licensing costs of tools like Camunda.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Tech Card 1 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Decoupled Orchestration</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        The engine strictly isolates orchestration from your host application's domain logic. A published configuration file acts as a registry, mapping generic BPMN task keys to specific Action or Trigger classes within your app.
                    </p>
                </div>
                <!-- Tech Card 2 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Native Queue Execution</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Integrates the <code>durable-workflow</code> package to execute graphs across standard background queues. This ensures crash recovery, automated retries, and the ability to hibernate processes for human-in-the-loop tasks via Signals.
                    </p>
                </div>
                <!-- Tech Card 3 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Vite-Bundled Visual Modeler</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        The open-source <code>bpmn-js</code> library is bundled via Vite and embedded directly into Blade views. Custom JavaScript providers restrict the drawing palette to supported elements, ensuring non-technical users only draw executable paths.
                    </p>
                </div>
                <!-- Tech Card 4 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Developer Experience (DX)</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Easily developed locally using multi-environment Docker Compose workflows. Comprehensive automated test coverage is powered by Pest, utilizing in-memory SQLite to test complex graph navigation and routing deterministically.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_cta')
    <div class="h-10 w-10 rounded-lg bg-indigo-600 flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/30 mb-6">
        S
    </div>
    <h3 class="text-xl font-bold mb-4">Ready to start orchestrating?</h3>
    <p class="text-slate-400 max-w-2xl mx-auto mb-8 text-sm leading-relaxed">
        Install the package via Composer, publish the generic UI scaffolding, and drop it into your existing Laravel or Filament application today. 
    </p>
@endsection