@props([
    'variant' => 'primary',
    'disabled' => false,
])

@php
    $variants = [
        'primary' => [
            'group' => 'bg-jade-500 text-ink-950',
            'button' => 'hover:bg-jade-400',
            'caret' => 'border-l border-ink-950/15 hover:bg-jade-400',
        ],
        'secondary' => [
            'group' => 'border border-white/10 text-zinc-300',
            'button' => 'hover:bg-white/5 hover:text-cream',
            'caret' => 'border-l border-white/10 hover:bg-white/5 hover:text-cream',
        ],
    ];

    $styles = $variants[$variant] ?? $variants['primary'];
    $buttonBase = 'outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70';
@endphp

<div {{ $attributes->class(['inline-flex overflow-hidden rounded-lg', $styles['group'], 'pointer-events-none opacity-40' => $disabled])->merge(['role' => 'group']) }}>
    <button type="button" @disabled($disabled) class="{{ $buttonBase }} h-10 px-5 text-sm font-medium {{ $styles['button'] }}">{{ $slot }}</button>
    <button type="button" @disabled($disabled) aria-label="More options" class="{{ $buttonBase }} grid h-10 w-9 place-items-center {{ $styles['caret'] }}">
        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
</div>
