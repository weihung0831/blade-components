@props([
    'items' => [],
    'orientation' => 'horizontal',
])

@php
    $icons = [
        'grid' => 'M2.5 2.5h4.2v4.2H2.5zM9.3 2.5h4.2v4.2H9.3zM2.5 9.3h4.2v4.2H2.5zM9.3 9.3h4.2v4.2H9.3z',
        'deploy' => 'M8 13V3m0 0L4.5 6.5M8 3l3.5 3.5',
        'bell' => 'M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11',
        'billing' => 'M2.5 4.5h11v7h-11zM2.5 7.5h11',
        'users' => 'M6 7.5a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Zm-3.5 5.4c0-1.9 1.6-3.1 3.5-3.1s3.5 1.2 3.5 3.1m1.6-9.2a2.25 2.25 0 0 1 0 4.4m1.4 4.8c0-1.6-.9-2.5-2.3-2.9',
        'settings' => 'M2.5 5.5h11M2.5 10.5h11M6 3.5v4M10.5 8.5v4',
        'logs' => 'M3.5 5 6 7.5 3.5 10M8 11h4.5',
        'lock' => 'M5 7.5V6a3 3 0 0 1 6 0v1.5M4 7.5h8v5H4z',
        'docs' => 'M8 5v8m-5-9.5h3.5A1.5 1.5 0 0 1 8 5v8a1.5 1.5 0 0 0-1.5-1.5H3v-8Zm10 0H9.5A1.5 1.5 0 0 0 8 5v8a1.5 1.5 0 0 1 1.5-1.5H13v-8Z',
        'chart' => 'M3 13V8m3.5 5V4m3.5 9v-6m3.5 6V6',
        'dot' => 'M8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5Z',
    ];

    $layouts = [
        'horizontal' => [
            'root' => 'inline-flex items-end gap-2',
            'tile' => 'origin-bottom group-hover/dock:-translate-y-3 group-hover/dock:scale-125',
            'tip' => 'bottom-full left-1/2 mb-6 -translate-x-1/2',
        ],
        'vertical' => [
            'root' => 'inline-flex flex-col items-end gap-2',
            'tile' => 'origin-right group-hover/dock:-translate-x-3 group-hover/dock:scale-125',
            'tip' => 'top-1/2 right-full mr-6 -translate-y-1/2',
        ],
    ];

    $layout = $layouts[$orientation] ?? $layouts['horizontal'];
@endphp

<nav {{ $attributes->merge(['class' => $layout['root'].' rounded-2xl border border-white/10 bg-ink-800/70 p-2 backdrop-blur']) }}>
    @foreach ($items as $entry)
        @php
            $active = $entry['active'] ?? false;
        @endphp
        <a href="{{ $entry['href'] ?? '#' }}" aria-label="{{ $entry['label'] }}" @if ($active) aria-current="page" @endif
            class="group/dock relative grid size-11 shrink-0 place-items-center rounded-xl outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70">
            <span class="relative grid size-11 place-items-center rounded-xl transition-transform duration-200 ease-snap {{ $layout['tile'] }} {{ $active ? 'bg-jade-500 text-ink-950' : 'bg-ink-950 text-zinc-400 group-hover/dock:text-cream' }}">
                <svg class="size-5" viewBox="0 0 16 16" fill="none"><path d="{{ $icons[$entry['icon'] ?? 'dot'] ?? $icons['dot'] }}" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>

                @isset($entry['badge'])
                    <span class="absolute -top-1 -right-1 grid min-w-4 place-items-center rounded-full bg-red-400 px-1 font-mono text-[9px] text-ink-950">{{ $entry['badge'] }}</span>
                @endisset
            </span>

            <span aria-hidden="true" class="pointer-events-none absolute z-10 rounded-md border border-white/10 bg-ink-900 px-2 py-1 text-xs whitespace-nowrap text-zinc-300 opacity-0 shadow-lg shadow-black/40 transition-opacity duration-150 group-hover/dock:opacity-100 group-focus-visible/dock:opacity-100 {{ $layout['tip'] }}">
                {{ $entry['label'] }}
            </span>
        </a>
    @endforeach
</nav>
