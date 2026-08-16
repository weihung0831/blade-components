@props([
    'duration' => 2.5,
    'tone' => 'cream',
])

@php
    $tones = [
        'cream' => 'from-zinc-600 via-cream to-zinc-600',
        'jade' => 'from-jade-600 via-jade-300 to-jade-600',
        'muted' => 'from-zinc-700 via-zinc-400 to-zinc-700',
    ];
@endphp

<span {{ $attributes->class([
    'bg-linear-to-r bg-[length:200%_100%] bg-clip-text text-transparent animate-[ui-text-shimmer_var(--ui-shimmer-duration)_linear_infinite]',
    $tones[$tone] ?? $tones['cream'],
]) }} style="--ui-shimmer-duration: {{ (float) $duration }}s">{{ $slot }}</span>

@once
    <style>
        @keyframes ui-text-shimmer {
            from {
                background-position: 200% 0;
            }

            to {
                background-position: -200% 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-text-shimmer'] {
                animation: none;
                background-position: 50% 0;
            }
        }
    </style>
@endonce
