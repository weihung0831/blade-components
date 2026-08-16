@props([
    'initials' => null,
    'src' => null,
    'alt' => '',
    'size' => 'md',
    'color' => 'ink',
    'status' => null,
])

@php
    $sizes = [
        'sm' => 'size-7 text-[10px]',
        'md' => 'size-9 text-xs',
        'lg' => 'size-12 text-sm',
    ];

    $colors = [
        'jade' => 'bg-jade-500 font-semibold text-ink-950',
        'ink' => 'bg-ink-800 font-semibold text-zinc-300',
        'ghost' => 'bg-ink-950 font-mono text-zinc-500',
    ];

    $statuses = [
        'online' => 'bg-jade-500',
        'away' => 'bg-amber-400',
        'busy' => 'bg-red-400',
        'offline' => 'bg-zinc-600',
    ];

    $dotSizes = [
        'sm' => 'size-2',
        'md' => 'size-2.5',
        'lg' => 'size-3',
    ];
@endphp

<span {{ $attributes->class('relative inline-grid shrink-0 place-items-center rounded-full select-none '.($sizes[$size] ?? $sizes['md']).' '.($colors[$color] ?? $colors['ink'])) }}>
    @if ($src !== null)
        <img src="{{ $src }}" alt="{{ $alt }}" class="size-full rounded-full object-cover">
    @else
        {{ $initials }}
    @endif
    @if ($status !== null)
        <span class="absolute right-0 bottom-0 rounded-full ring-2 ring-ink-900 {{ ($dotSizes[$size] ?? $dotSizes['md']).' '.($statuses[$status] ?? $statuses['online']) }}"></span>
    @endif
</span>
