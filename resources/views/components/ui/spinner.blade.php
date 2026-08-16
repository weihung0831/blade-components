@props([
    'variant' => 'ring',
    'size' => 'md',
    'color' => 'jade',
    'label' => null,
])

@php
    $rings = [
        'sm' => 'size-4',
        'md' => 'size-5',
        'lg' => 'size-8',
    ];

    $dots = [
        'sm' => 'size-1',
        'md' => 'size-1.5',
        'lg' => 'size-2.5',
    ];

    $colors = [
        'jade' => 'text-jade-500',
        'zinc' => 'text-zinc-400',
        'cream' => 'text-cream',
        'red' => 'text-red-400',
    ];
@endphp

<span role="status" {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5 '.($colors[$color] ?? $colors['jade'])]) }}>
    @if ($variant === 'dots')
        <span class="flex items-center gap-1">
            <span class="animate-bounce rounded-full bg-current [animation-delay:-320ms] {{ $dots[$size] ?? $dots['md'] }}"></span>
            <span class="animate-bounce rounded-full bg-current [animation-delay:-160ms] {{ $dots[$size] ?? $dots['md'] }}"></span>
            <span class="animate-bounce rounded-full bg-current {{ $dots[$size] ?? $dots['md'] }}"></span>
        </span>
    @else
        <svg class="animate-spin {{ $rings[$size] ?? $rings['md'] }}" viewBox="0 0 16 16" fill="none">
            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="2" class="opacity-20" />
            <path d="M14.5 8A6.5 6.5 0 0 0 8 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
    @endif
    @if ($label)
        <span class="text-sm text-zinc-400">{{ $label }}</span>
    @else
        <span class="sr-only">Loading</span>
    @endif
</span>
