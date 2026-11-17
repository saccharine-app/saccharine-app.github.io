---
title: Engineering Blog
description: Release notes, architectural deep dives, and updates for the Saccharine Laravel ecosystem.
pagination:
    collection: posts
    perPage: 10
---
@extends('_layouts.main')

@section('content')
<div class="container mx-auto px-6 py-16 max-w-4xl">
    <div class="mb-12 border-b border-slate-200 pb-8">
        <span class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-600">
            Updates & Architecture Notes
        </span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">
            Blog
        </h1>
        <p class="text-slate-600 text-base mt-2 max-w-2xl">
            Incremental releases, BPMN engine internals, and design notes for modular Laravel packages.
        </p>
    </div>

    <div class="space-y-6">
        @forelse ($pagination->items as $post)
            @include('_partials.post-preview', ['post' => $post])
        @empty
            <p class="text-sm text-slate-500">No posts published yet.</p>
        @endforelse
    </div>

    @if ($pagination->pages->count() > 1)
        <nav class="mt-12 pt-6 border-t border-slate-200 flex items-center justify-between text-xs font-mono">
            @if ($previous = $pagination->previous)
                <a href="{{ $previous }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold transition">
                    &larr; Newer Posts
                </a>
            @else
                <div></div>
            @endif

            <span class="text-slate-400">
                Page {{ $pagination->currentPage }} of {{ $pagination->pages->count() }}
            </span>

            @if ($next = $pagination->next)
                <a href="{{ $next }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-semibold transition">
                    Older Posts &rarr;
                </a>
            @else
                <div></div>
            @endif
        </nav>
    @endif
</div>
@endsection