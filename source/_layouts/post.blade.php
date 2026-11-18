@extends('_layouts.main')

@section('content')
<div class="container mx-auto px-6 py-16 max-w-4xl">
    <!-- Top Back Link / Breadcrumb -->
    <nav class="flex items-center space-x-2 text-xs font-mono text-slate-400 mb-8">
        <a href="/blog" class="hover:text-indigo-600 transition flex items-center gap-1.5">
            <span>&larr;</span>
            <span>Back to Blog</span>
        </a>
    </nav>

    <article>
        <!-- Post Header -->
        <header class="mb-10 pb-8 border-b border-slate-200">
            <!-- Date, Author & Categories -->
            <div class="flex flex-wrap items-center gap-3 text-xs font-mono text-slate-500 mb-4">
                @if ($page->date)
                    <time datetime="{{ date('Y-m-d', $page->date) }}">
                        {{ date('F j, Y', $page->date) }}
                    </time>
                @endif

                @if ($page->author)
                    <span class="text-slate-300">&bull;</span>
                    <span class="text-slate-600">{{ $page->author }}</span>
                @endif

                @if ($page->categories)
                    <span class="text-slate-300">&bull;</span>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($page->categories as $category)
                            <a href="/blog/categories/{{ $category }}"
                               class="text-indigo-700 bg-indigo-50 border border-indigo-200/70 px-2.5 py-0.5 rounded-full font-semibold hover:bg-indigo-100 transition">
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Title & Description -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                {{ $page->title }}
            </h1>

            @if ($page->description)
                <p class="text-slate-600 text-base md:text-lg mt-3 leading-relaxed">
                    {{ $page->description }}
                </p>
            @endif

            <!-- Optional Cover Image -->
            @if ($page->cover_image)
                <div class="mt-8 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shadow-sm">
                    <img src="{{ $page->cover_image }}"
                         alt="{{ $page->title }}"
                         class="w-full h-auto block">
                </div>
            @endif
        </header>

        <!-- Post Body (Full-width prose matching docs.blade.php) -->
        @if (trim($__env->yieldContent('post_content')))
            <div class="prose prose-slate max-w-none
                        prose-headings:font-bold prose-headings:tracking-tight
                        prose-a:text-indigo-600 hover:prose-a:text-indigo-500
                        prose-pre:bg-slate-900 prose-pre:border prose-pre:border-slate-800
                        prose-code:font-mono prose-code:text-indigo-600 prose-code:before:content-none prose-code:after:content-none">
                @yield('post_content')
            </div>
        @endif

        <!-- Tags Footer -->
        @if ($page->tags)
            <div class="mt-12 pt-6 border-t border-slate-200 flex flex-wrap items-center gap-2">
                <span class="text-xs font-mono font-semibold uppercase tracking-wider text-slate-400 mr-1">
                    Tags:
                </span>
                @foreach ($page->tags as $tag)
                    <a href="/blog/tags/{{ $tag }}"
                       class="text-xs font-mono text-slate-600 bg-slate-100 hover:bg-indigo-50 hover:text-indigo-700 border border-slate-200/80 hover:border-indigo-200 px-2.5 py-1 rounded-md transition">
                        #{{ $tag }}
                    </a>
                @endforeach
            </div>
        @endif
    </article>

    <!-- Sequential Next / Previous Post Navigation -->
    @php
        $newer = $page->getPrevious(); // Index - 1 (more recent in a -date sort)
        $older = $page->getNext();     // Index + 1 (further back in a -date sort)
    @endphp
    @if ($newer || $older)
        <nav class="mt-12 pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-mono">
            @if ($newer)
                <a href="{{ $newer->getPath() }}"
                   class="flex items-center gap-2.5 text-slate-600 hover:text-indigo-600 p-3 rounded-lg border border-transparent hover:border-slate-200 hover:bg-slate-50 transition w-full sm:w-auto">
                    <span>&larr;</span>
                    <div class="text-left">
                        <span class="text-[10px] text-slate-400 block uppercase">Newer Post</span>
                        <span class="font-bold font-sans text-sm text-slate-800">{{ $newer->title }}</span>
                    </div>
                </a>
            @else
                <div></div>
            @endif

            @if ($older)
                <a href="{{ $older->getPath() }}"
                   class="flex items-center justify-end gap-2.5 text-slate-600 hover:text-indigo-600 p-3 rounded-lg border border-transparent hover:border-slate-200 hover:bg-slate-50 transition w-full sm:w-auto text-right">
                    <div>
                        <span class="text-[10px] text-slate-400 block uppercase">Older Post</span>
                        <span class="font-bold font-sans text-sm text-slate-800">{{ $older->title }}</span>
                    </div>
                    <span>&rarr;</span>
                </a>
            @endif
        </nav>
    @endif
</div>
@endsection