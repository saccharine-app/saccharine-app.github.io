---
title: Dynamic Catalog & CPQ Engine
packageName: CPQ
githubUrl: https://github.com/saccharine-app/cpq-catalog
packagistUrl: https://packagist.org/packages/saccharine/cpq-catalog
demoUrl: https://demo.saccharine.app
---
@extends('_layouts.main')

@section('content')
    <!-- Hero Section -->
    <header class="bg-animated-gradient border-b border-slate-100">
        <div class="container mx-auto px-6 py-24 text-center max-w-4xl">
            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                Complex pricing rules without <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-orange-400">spaghetti logic.</span>
            </h1>
            <p class="text-xl text-slate-600 mb-10 leading-relaxed">
                A highly robust, domain-agnostic Configure-Price-Quote (CPQ) system for Laravel. It sits cleanly inside your application, acting as a headless engine that separates strict financial realities from flexible frontend interfaces.
            </p>
        </div>
    </header>

    <!-- The "How It Works" Section -->
    <section class="py-20 bg-white space-y-6">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">How It Works</h2>
                <div class="w-24 h-1 bg-amber-500 mx-auto rounded"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-amber-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">1. Build the Catalog</h3>
                    <p class="text-slate-600">Establish master accounting SKUs and create localized presentation aliases. Schedule future price changes without breaking historical data.</p>
                </div>
                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-amber-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">2. Configure Quotes</h3>
                    <p class="text-slate-600">Staff use a reactive, multi-tab frontend interface to build quotes dynamically. Totals are calculated instantly in the browser memory.</p>
                </div>
                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6 shadow-sm border border-amber-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">3. Lock & Manifest</h3>
                    <p class="text-slate-600">Finalized quotes compile into a strict JSON dictionary. The core application handles operational fulfillment without untangling messy category trees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Abstract Visual Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="relative bg-white p-8 md:p-12 rounded-2xl shadow-xl border border-slate-200 max-w-lg mx-auto">
                <div class="absolute -inset-1 bg-gradient-to-r from-amber-500 to-orange-300 rounded-2xl blur opacity-10"></div>
                
                <div class="relative flex flex-col items-center">
                    <!-- Master Catalog SKU -->
                    <div class="w-full flex justify-between items-center bg-slate-50 border border-slate-200 rounded-lg p-3.5 shadow-sm relative z-10">
                        <div class="text-xs font-bold text-slate-700">Master Catalog Item: <span class="font-mono text-amber-600 ml-1">SRV-01</span></div>
                        <div class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Global Base</div>
                    </div>
                    
                    <div class="flex justify-center"><div class="w-0.5 h-6 bg-slate-300"></div></div>
                    
                    <!-- Context Polymorphism Split -->
                    <div class="w-full flex gap-4 relative z-10">
                        <div class="w-1/2 border border-slate-200 rounded-lg p-3 bg-white text-center shadow-sm border-t-[3px] border-t-amber-400">
                            <div class="text-[10px] text-slate-400 font-bold uppercase mb-1">Local Context A</div>
                            <div class="text-sm font-semibold text-slate-800">$1,200.00</div>
                        </div>
                        <div class="w-1/2 border border-slate-200 rounded-lg p-3 bg-white text-center shadow-sm border-t-[3px] border-t-amber-400 opacity-60">
                            <div class="text-[10px] text-slate-400 font-bold uppercase mb-1">Local Context B</div>
                            <div class="text-sm font-semibold text-slate-800">$1,350.00</div>
                        </div>
                    </div>
                    
                    <div class="flex justify-center px-[25%]"><div class="w-0.5 h-6 bg-slate-300"></div></div>
                    
                    <!-- Output Manifest -->
                    <div class="w-full bg-slate-900 rounded-lg p-4 text-left font-mono text-[11px] text-emerald-400 shadow-inner relative z-10">
                        <span class="text-slate-400">{</span><br>
                        &nbsp;&nbsp;<span class="text-sky-300">"quote_id"</span>: <span class="text-amber-300">"qt_9a8b"</span>,<br>
                        &nbsp;&nbsp;<span class="text-sky-300">"line_items"</span>: [<span class="text-amber-300">"SRV-01"</span>],<br>
                        &nbsp;&nbsp;<span class="text-sky-300">"total_cents"</span>: <span class="text-purple-300">120000</span><br>
                        <span class="text-slate-400">}</span>
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
                <span class="text-xs font-semibold uppercase tracking-wider text-amber-600 bg-amber-100 px-3 py-1 rounded-full">Under the Hood</span>
                <h2 class="text-3xl font-bold text-slate-900 mt-4 mb-4">Architecture & Engineering</h2>
                <p class="text-slate-600 max-w-2xl">
                    Engineered to sit cleanly within a modular monolith, separating real-time configurator performance from durable relational database storage.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Tech Card 1 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Temporal Versioning</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Pricing uses effective and end dates rather than cron-job overwrites. This guarantees point-in-time historical accuracy and allows future price scheduling without overwriting today's ledger.
                    </p>
                </div>
                <!-- Tech Card 2 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Polymorphic Contexts</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Uses UUID morphs so any host application model (such as a physical Location or a specific User) can own a local catalog offering or be bound to a draft quote.
                    </p>
                </div>
                <!-- Tech Card 3 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Headless Core via Action Classes</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Business logic is completely decoupled from HTTP requests. The package utilizes reusable Action classes like <code>CompileQuoteManifestAction</code> to ensure core operations are accessible via CLI, Queues, or Controllers.
                    </p>
                </div>
                <!-- Tech Card 4 -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-900 mb-2">Reactive Vue 3 Frontend</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        The frontend utilizes native Fetch APIs and Vue 3's Composition API, allowing the interface to be seamlessly mounted inside a Livewire-driven Filament admin page using scaffolded Blade templates.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_cta')
    <div class="h-10 w-10 rounded-lg bg-amber-500 flex items-center justify-center font-bold text-white shadow-lg shadow-amber-500/30 mb-6">
        S
    </div>
    <h3 class="text-xl font-bold mb-4">Ready to stabilize your pricing logic?</h3>
    <p class="text-slate-400 max-w-2xl mx-auto mb-8 text-sm leading-relaxed">
        Publish the API endpoints, scaffold the UI directly into your host application, and run your catalogs headlessly today.
    </p>
@endsection