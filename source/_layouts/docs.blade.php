@extends('_layouts.main')

@section('content')
<div class="container mx-auto px-6 max-w-6xl">
    <div class="flex flex-col lg:flex-row min-h-[calc(100vh-140px)]">
        <!-- Dynamic Sidebar -->
        
        @include('_partials.docs-sidebar', ['package' => $page->package ?? 'bpmn'])

        <!-- Main Documentation Content Panel -->
        <article class="flex-1 py-8 lg:pl-10 lg:border-l border-slate-200 min-w-0">
            <!-- Breadcrumbs -->
            <nav class="flex items-center space-x-2 text-xs font-mono text-slate-400 mb-6">
                <a href="/bpmn" class="hover:text-slate-600">bpmn</a>
                <span>/</span>
                <span class="text-slate-500">docs</span>
                <span>/</span>
                <span class="text-indigo-600 font-semibold">{{ $page->sectionTitle ?? 'Guide' }}</span>
            </nav>

            <!-- Prose Markdown Container -->
            <div class="prose prose-slate max-w-none prose-headings:font-bold prose-headings:tracking-tight prose-a:text-indigo-600 hover:prose-a:text-indigo-500 prose-pre:bg-slate-900 prose-pre:border prose-pre:border-slate-800 prose-code:font-mono prose-code:text-indigo-600 prose-code:before:content-none prose-code:after:content-none">
                @yield('docs_content')
            </div>

            <!-- Dynamic Sequential Next / Prev Pagination -->
            @php
                $prev = $page->getPrevious();
                $next = $page->getNext();
            @endphp
            <div class="mt-16 pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-mono">
                @if($prev)
                    <a href="{{ $prev->getPath() }}" class="flex items-center gap-2 text-slate-600 hover:text-indigo-600 p-2 rounded hover:bg-slate-50 transition w-full sm:w-auto">
                        <span>&larr;</span>
                        <div class="text-left">
                            <span class="text-[10px] text-slate-400 block uppercase">Previous</span>
                            <span class="font-bold font-sans">{{ $prev->title }}</span>
                        </div>
                    </a>
                @else
                    <div></div>
                @endif

                @if($next)
                    <a href="{{ $next->getPath() }}" class="flex items-center justify-end gap-2 text-slate-600 hover:text-indigo-600 p-2 rounded hover:bg-slate-50 transition w-full sm:w-auto text-right">
                        <div>
                            <span class="text-[10px] text-slate-400 block uppercase">Next</span>
                            <span class="font-bold font-sans">{{ $next->title }}</span>
                        </div>
                        <span>&rarr;</span>
                    </a>
                @endif
            </div>
        </article>
    </div>
</div>

<script type="module">
    if (document.querySelector('.mermaid')) {
        import('https://cdn.jsdelivr.net/npm/mermaid@12/dist/mermaid.esm.min.mjs')
            .then(({ default: mermaid }) => {
                mermaid.initialize({
                    startOnLoad: false,
                    theme: 'neutral', // Matches Tailwind's slate palette cleanly
                });
                mermaid.run({ querySelector: '.mermaid' });
            });
    }
</script>
@endsection
