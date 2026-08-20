<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saccharine {{ $page->packageName ?? 'Platform' }} | {{ $page->title ?? 'Modular Open-Source Operations' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom gentle gradient animation for the hero background */
        .bg-animated-gradient {
            background: linear-gradient(-45deg, #eff6ff, #e0e7ff, #f3e8ff, #f8fafc);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
    </style>
</head>
<body class="font-sans text-slate-800 antialiased bg-white">

    <!-- Navigation -->
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="h-8 w-8 rounded-lg bg-indigo-600 flex items-center justify-center font-bold text-white shadow-sm">S</div>
            <div class="text-xl font-extrabold text-indigo-600 tracking-tighter">
                Saccharine<span class="text-slate-800 font-medium">{{ $page->packageName ?? 'Hub' }}</span>
            </div>
        </div>
        <div class="flex space-x-6 text-sm font-medium">
            <a href="https://saccharine.app" class="text-slate-500 hover:text-indigo-600 transition">Saccharine Hub</a>
            <a href="{{ $page->githubUrl ?? 'https://github.com/saccharine-app' }}" class="text-slate-500 hover:text-indigo-600 transition">GitHub &rarr;</a>
        </div>
    </nav>

    <!-- Dynamic Content Injected Here -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12">
        <div class="container mx-auto px-6 text-center flex flex-col items-center">
            <!-- Footer logo and CTA omitted for brevity, identical to your source -->
            <a href="{{ $page->githubUrl ?? 'https://github.com/saccharine-app' }}" class="inline-block bg-white text-slate-900 font-bold py-3 px-8 rounded-lg hover:bg-slate-100 transition shadow-sm text-sm">
                View Repository & Documentation
            </a>
            <div class="mt-12 text-xs text-slate-600 border-t border-slate-800 pt-8 w-full max-w-4xl flex flex-col md:flex-row justify-between items-center gap-4">
                <span>&copy; <span id="year"></span> Saccharine Project. MIT Licensed.</span>
                <div class="flex gap-6">
                    @if($page->packagistUrl)
                        <a href="{{ $page->packagistUrl }}" class="hover:text-slate-400 transition">Packagist</a>
                    @endif
                    @if($page->demoUrl)
                        <a href="{{ $page->demoUrl }}" class="hover:text-slate-400 transition">Live Demo</a>
                    @endif
                </div>
            </div>
        </div>
    </footer>
    <script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html>