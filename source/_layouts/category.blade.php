@extends('_layouts.main')

@section('content')
<div class="container mx-auto px-6 py-16 max-w-4xl">
    <div class="mb-10">
        <span class="text-xs font-mono uppercase text-indigo-600">Category Archive</span>
        <h1 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $page->title }}</h1>
        <p class="text-slate-600 text-sm mt-2">{{ $page->description }}</p>
        
        @if(trim($__env->yieldContent('category_content')))
            <div class="prose mt-6">
                @yield('category_content')
            </div>
        @endif
    </div>

    <div class="space-y-6">
        @forelse($page->posts($posts) as $post)
            @include('_partials.post-preview', ['post' => $post])
        @empty
            <p class="text-sm text-slate-500">No articles found in this category.</p>
        @endforelse
    </div>
</div>
@endsection
