@props([
    'duration' => 4,
    'tone' => 'jade',
    'radius' => 'rounded-xl',
    'thickness' => 'p-px',
])

@php
    $tones = [
        'jade' => 'from-jade-400 via-transparent to-transparent',
        'cream' => 'from-cream via-transparent to-transparent',
        'split' => 'from-jade-400 via-transparent to-cream',
    ];
@endphp

<div {{ $attributes->class(['relative overflow-hidden bg-white/10', $radius, $thickness]) }}
    style="--ui-border-speed: {{ max(1, (int) $duration) }}s">
    <span aria-hidden="true" @class([
        'absolute top-1/2 left-1/2 aspect-square w-[150%] -translate-x-1/2 -translate-y-1/2 bg-conic animate-[ui-animated-border-spin_var(--ui-border-speed)_linear_infinite]',
        $tones[$tone] ?? $tones['jade'],
    ])></span>

    <div class="relative h-full rounded-[inherit] bg-ink-900">
        {{ $slot }}
    </div>
</div>

@once
    <style>
        @keyframes ui-animated-border-spin {
            to {
                transform: translate(-50%, -50%) rotate(1turn);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-animated-border-'] {
                animation: none;
            }
        }
    </style>
@endonce
