<!DOCTYPE html>
<html lang="en" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title ? $page->title . ' | Saccharine' : 'Saccharine - Modular Operational Infrastructure for Laravel' }}</title>
    <meta name="description" content="{{ $page->description ?? 'Open-source, domain-agnostic Laravel packages for workflows, quoting, and paperwork.' }}">
    <meta property="og:title" content="{{ $page->title ? $page->title . ' | Saccharine' : 'Saccharine - Modular Operational Infrastructure for Laravel' }}">
    <meta property="og:description" content="{{ $page->description ?? 'Open-source, domain-agnostic Laravel packages for workflows, quoting, and paperwork.' }}">
    <meta property="og:image" content="https://saccharine.app/assets/images/og-preview.png">
    <meta property="og:url" content="https://saccharine.app{{ $page->getPath() }}">
    <meta name="twitter:card" content="summary_large_image">
    {{-- Enables hot reload during 'npm run dev' --}}
    @viteRefresh()

    {{-- Resolves compiled CSS and JS via Jigsaw's helper --}}
    <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}">
    <!--<script defer src="{{ vite('source/_assets/js/main.js') }}"></script>-->
    <style>
        .bg-animated-gradient {
            background: linear-gradient(-45deg, #eff6ff, #e0e7ff, #f3e8ff, #f8fafc);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="font-sans text-slate-800 antialiased bg-white flex flex-col min-h-full">
    <!-- Top Global Navigation Bar -->
    <header class="border-b border-slate-200/80 bg-white/90 backdrop-blur sticky top-0 z-40">
        <nav class="container mx-auto px-6 py-3.5 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="/" class="flex items-center space-x-2.5 group">
                    <div class="h-8 w-8 rounded-lg bg-indigo-600 group-hover:bg-indigo-500 transition flex items-center justify-center font-bold text-white shadow-sm">
                        S
                    </div>
                    <span class="text-lg font-extrabold text-slate-900 tracking-tight">Saccharine</span>
                </a>

                <div class="hidden md:flex items-center space-x-1 pl-4 border-l border-slate-200 text-sm font-medium">
                    <a href="/bpmn" class="px-3 py-1.5 rounded-md transition {{ str_starts_with($page->getPath(), '/bpmn') && !str_starts_with($page->getPath(), '/bpmn/docs') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:text-slate-900' }}">
                        BPMN Workflow
                    </a>
                    <a href="/bpmn/docs/introduction" class="px-3 py-1.5 rounded-md transition {{ str_starts_with($page->getPath(), '/bpmn/docs') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:text-slate-900' }}">
                        Documentation
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4 text-sm font-medium">
                <a href="https://demo.saccharine.app" target="_blank" rel="noopener" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 transition text-xs font-semibold">
                    <span>Live Sandbox</span>
                    <span class="text-slate-400">&nearr;</span>
                </a>
                <a href="https://github.com/saccharine-app/bpmn" target="_blank" rel="noopener" class="text-slate-500 hover:text-slate-900 transition flex items-center gap-1 text-xs">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                    <span>GitHub</span>
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content Injection -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Universal Footer -->
    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800 text-sm">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <div class="flex items-center space-x-2">
                        <div class="h-6 w-6 rounded bg-indigo-600 flex items-center justify-center font-bold text-white text-xs">S</div>
                        <span class="font-bold text-slate-200">Saccharine Open Source</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        Domain-agnostic operational primitives and workflow orchestration for Laravel.
                    </p>
                </div>
                <div class="flex items-center space-x-6 text-xs text-slate-400">
                    <a href="/bpmn" class="hover:text-white transition">BPMN Workflow</a>
                    <a href="/bpmn/docs/introduction" class="hover:text-white transition">Docs</a>
                    <a href="https://github.com/saccharine-app/bpmn" class="hover:text-white transition" target="_blank" rel="noopener">GitHub</a>
                    <a href="https://opensource.org/licenses/MIT" class="hover:text-white transition" target="_blank" rel="noopener">MIT License</a>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-slate-800/80 text-center md:text-left text-xs text-slate-500">
                &copy; {{ date('Y') }} Saccharine. BPMN 2.0 is an OMG standard. Web canvas powered by bpmn-js (Camunda). Durable execution powered by durable-workflow.
            </div>
        </div>
    </footer>
</body>
</html>