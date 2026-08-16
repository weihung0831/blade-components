@props([
    'pages' => 1,
    'current' => 1,
    'url' => '#',
    'variant' => 'numbered',
    'siblings' => 1,
])

@php
    $href = fn (int $page): string => str_replace(':page', (string) $page, $url);

    $numbers = [];
    $previous = 0;

    foreach (range(1, $pages) as $page) {
        if ($page !== 1 && $page !== $pages && abs($page - $current) > $siblings) {
            continue;
        }

        if ($previous !== 0 && $page - $previous > 1) {
            $numbers[] = null;
        }

        $numbers[] = $page;
        $previous = $page;
    }

    $arrow = 'grid size-9 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70';
    $disabled = 'grid size-9 place-items-center rounded-lg border border-white/5 text-zinc-700';
@endphp

<nav aria-label="Pagination" {{ $attributes->merge(['class' => 'flex items-center gap-1.5']) }}>
    @if ($current > 1)
        <a href="{{ $href($current - 1) }}" rel="prev" aria-label="Previous page" class="{{ $arrow }}">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    @else
        <span aria-disabled="true" class="{{ $disabled }}">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
    @endif

    @if ($variant === 'simple')
        <span class="px-3 font-mono text-xs text-zinc-500">Page <span class="text-cream">{{ $current }}</span> of {{ $pages }}</span>
    @else
        @foreach ($numbers as $page)
            @if ($page === null)
                <span aria-hidden="true" class="grid size-9 place-items-center text-zinc-600">…</span>
            @elseif ($page === $current)
                <span aria-current="page" class="grid size-9 place-items-center rounded-lg bg-jade-500 text-sm font-medium text-ink-950">{{ $page }}</span>
            @else
                <a href="{{ $href($page) }}" class="grid size-9 place-items-center rounded-lg border border-white/10 text-sm text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">{{ $page }}</a>
            @endif
        @endforeach
    @endif

    @if ($current < $pages)
        <a href="{{ $href($current + 1) }}" rel="next" aria-label="Next page" class="{{ $arrow }}">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    @else
        <span aria-disabled="true" class="{{ $disabled }}">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
    @endif
</nav>
