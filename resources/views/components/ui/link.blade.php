@props([
    'variant' => 'default',
    'external' => false,
])

@php
    $base = 'inline-flex items-center gap-1 font-medium underline-offset-4 outline-none transition-colors duration-150 hover:underline focus-visible:rounded-sm focus-visible:ring-2 focus-visible:ring-jade-500/70';

    $variants = [
        'default' => 'text-jade-400 hover:text-jade-300',
        'muted' => 'text-zinc-400 hover:text-cream',
        'underline' => 'text-cream underline decoration-jade-500/60 hover:decoration-jade-400',
    ];

    $linkAttributes = ['class' => $base.' '.($variants[$variant] ?? $variants['default'])];

    if ($external) {
        $linkAttributes += ['target' => '_blank', 'rel' => 'noopener'];
    }
@endphp

<a {{ $attributes->merge($linkAttributes) }}>
    {{ $slot }}
    @if ($external)
        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M6.5 3H13v6.5M13 3 6.75 9.25M11 9.5V12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h2.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @endif
</a>
