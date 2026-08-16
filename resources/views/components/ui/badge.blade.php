@props([
    'variant' => 'solid',
    'color' => 'jade',
])

@php
    $solids = [
        'jade' => 'bg-jade-500/15 font-medium text-jade-400',
        'zinc' => 'bg-white/10 font-medium text-zinc-300',
        'red' => 'bg-red-400/15 font-medium text-red-400',
        'amber' => 'bg-amber-400/15 font-medium text-amber-400',
    ];

    $dots = [
        'jade' => 'bg-jade-500',
        'zinc' => 'bg-zinc-500',
        'red' => 'bg-red-400',
        'amber' => 'bg-amber-400',
    ];

    $classes = in_array($variant, ['outline', 'dot'], true)
        ? 'border border-white/10 text-zinc-400'
        : ($solids[$color] ?? $solids['jade']);
@endphp

<span {{ $attributes->class('inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs '.$classes) }}>
    @if ($variant === 'dot')
        <span class="size-1.5 rounded-full {{ $dots[$color] ?? $dots['jade'] }}"></span>
    @endif
    {{ $slot }}
</span>
