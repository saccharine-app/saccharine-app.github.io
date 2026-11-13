<article class="p-6 bg-white border border-slate-200 rounded-xl hover:border-indigo-300 transition shadow-sm">
    <div class="flex flex-wrap items-center gap-3 text-xs font-mono text-slate-400">
        <time datetime="{{ date('Y-m-d', $post->date) }}">
            {{ date('M j, Y', $post->date) }}
        </time>
        @if ($post->categories)
            <span>&bull;</span>
            <div class="flex flex-wrap gap-1.5">
                @foreach ($post->categories as $category)
                    <a href="/blog/categories/{{ $category }}" class="text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded hover:bg-indigo-100 transition">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <h2 class="text-xl font-bold text-slate-900 mt-2">
        <a href="{{ $post->getUrl() }}" class="hover:text-indigo-600 transition">
            {{ $post->title }}
        </a>
    </h2>

    @if ($post->description)
        <p class="text-sm text-slate-600 mt-2 leading-relaxed">
            {{ $post->description }}
        </p>
    @endif
</article>