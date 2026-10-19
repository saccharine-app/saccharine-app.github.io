@php
    // Structured navigation tree easily expanded to support multiple packages
    $package = $package ?? 'bpmn';
    $currentPath = rtrim($page->getPath(), '/');

    $navSections = [
        'bpmn' => [
            'Getting Started' => [
                ['title' => 'Introduction & Stack', 'path' => '/bpmn/docs/introduction'],
                ['title' => 'Quickstart Guide', 'path' => '/bpmn/docs/quickstart'],
            ],
            'Engine Mechanics' => [
                ['title' => 'Core Concepts & Replay', 'path' => '/bpmn/docs/core-concepts'],
            ],
            'UI & Modeler' => [
                ['title' => 'Modeler & Filament', 'path' => '/bpmn/docs/modeler-and-filament'],
            ],
            'Community & RFC' => [
                ['title' => 'Roadmap & RFC', 'path' => '/bpmn/docs/roadmap-rfc'],
            ],
        ],
    ];

    $sections = $navSections[$package] ?? [];
@endphp

<aside class="w-full lg:w-64 shrink-0">
    <div class="sticky top-20 py-8 lg:pr-6 space-y-8">
        <div class="flex items-center justify-between pb-4 border-b border-slate-200">
            <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500">Package</span>
            <span class="text-xs font-mono px-2 py-0.5 rounded bg-indigo-50 text-indigo-700 font-semibold border border-indigo-100">
                saccharine/{{ $package }}
            </span>
        </div>

        @foreach($sections as $sectionTitle => $items)
            <div class="space-y-2">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 font-mono">
                    {{ $sectionTitle }}
                </h4>
                <ul class="space-y-1 text-sm">
                    @foreach($items as $item)
                        @php
                            $isActive = $currentPath === rtrim($item['path'], '/');
                        @endphp
                        <li>
                            <a href="{{ $item['path'] }}" class="block px-3 py-1.5 rounded-md transition text-xs font-medium {{ $isActive ? 'bg-indigo-50 text-indigo-700 font-semibold border-l-2 border-indigo-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach

        <div class="pt-4 border-t border-slate-200 text-xs text-slate-500 space-y-2">
            <div class="font-semibold text-slate-700">Need help or found a bug?</div>
            <a href="https://github.com/saccharine-app/bpmn/issues" target="_blank" rel="noopener" class="text-indigo-600 hover:underline flex items-center gap-1">
                Open an Issue on GitHub &rarr;
            </a>
        </div>
    </div>
</aside>