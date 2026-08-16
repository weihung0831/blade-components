@props([
    'sections' => [],
    'variant' => 'full',
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

    $rail = $variant === 'rail';
@endphp

<aside {{ $attributes->merge(['class' => 'flex flex-col rounded-xl border border-white/10 bg-ink-800 p-2 '.($rail ? 'w-16 items-center' : 'w-60')]) }}>
    @isset($brand)
        <div @class(['mb-2 flex items-center gap-2.5 px-1.5 py-1', 'justify-center' => $rail])>{{ $brand }}</div>
    @endisset

    <nav class="flex w-full flex-col gap-0.5">
        @foreach ($sections as $section)
            @if (isset($section['label']) && ! $rail)
                <p @class(['px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase', 'pt-3' => ! $loop->first])>{{ $section['label'] }}</p>
            @elseif ($rail && ! $loop->first)
                <hr class="my-2 w-full border-white/8">
            @endif

            @foreach ($section['items'] ?? [] as $entry)
                @php
                    $active = $entry['active'] ?? false;
                    $tone = $active
                        ? 'bg-jade-500/15 text-jade-300'
                        : 'text-zinc-400 hover:bg-white/5 hover:text-cream';
                @endphp
                <a href="{{ $entry['href'] ?? '#' }}" title="{{ $entry['label'] }}"
                    @isset($entry['target']) target="{{ $entry['target'] }}" @endisset
                    @if ($active) aria-current="page" @endif
                    class="relative flex items-center rounded-lg text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 {{ $rail ? 'justify-center p-2.5' : 'gap-2.5 px-2.5 py-2' }} {{ $tone }}">
                    <svg class="size-4 shrink-0" viewBox="0 0 16 16" fill="none"><path d="{{ $icons[$entry['icon'] ?? 'dot'] ?? $icons['dot'] }}" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>

                    @unless ($rail)
                        <span class="truncate">{{ $entry['label'] }}</span>
                    @endunless

                    @isset($entry['badge'])
                        @if ($rail)
                            <span class="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
                        @else
                            <span class="ml-auto rounded-full bg-jade-500 px-1.5 font-mono text-[10px] text-ink-950">{{ $entry['badge'] }}</span>
                        @endif
                    @endisset
                </a>
            @endforeach
        @endforeach
    </nav>

    @isset($footer)
        <div @class(['mt-auto w-full border-t border-white/5 pt-2', 'flex justify-center' => $rail])>{{ $footer }}</div>
    @endisset
</aside>
