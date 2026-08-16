@props([
    'value' => 0,
    'max' => 100,
    'label' => null,
    'indeterminate' => false,
    'size' => 'md',
    'animate' => false,
    'duration' => 900,
    'delay' => 0,
])

@php
    $sizes = [
        'sm' => 'h-1',
        'md' => 'h-1.5',
        'lg' => 'h-2.5',
    ];

    $percent = $max > 0 ? min(100, max(0, ($value / $max) * 100)) : 0;

    $fill = $animate
        ? 'origin-left animate-[ui-progress-grow_var(--ui-progress-duration)_var(--ease-snap)_both]'
        : 'transition-[width] duration-500 ease-snap';

    $fillStyle = 'width: '.$percent.'%'.($animate ? '; animation-delay: '.(int) $delay.'ms; --ui-progress-duration: '.(int) $duration.'ms' : '');
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if ($label)
        <div class="mb-2 flex items-baseline justify-between gap-4">
            <span class="text-xs text-zinc-500">{{ $label }}</span>
            @unless ($indeterminate)
                <span @class(['font-mono text-xs text-jade-400', 'animate-[ui-progress-fade_var(--ui-progress-duration)_var(--ease-snap)_both]' => $animate])
                    @if ($animate) style="animation-delay: {{ (int) $delay }}ms; --ui-progress-duration: {{ (int) $duration }}ms" @endif>{{ round($percent) }}%</span>
            @endunless
        </div>
    @endif
    <div role="progressbar" aria-valuemin="0" aria-valuemax="{{ $max }}"
        @unless ($indeterminate) aria-valuenow="{{ $value }}" @endunless
        @if ($label) aria-label="{{ $label }}" @endif
        class="overflow-hidden rounded-full bg-ink-800 {{ $sizes[$size] ?? $sizes['md'] }}">
        @if ($indeterminate)
            <div class="h-full w-1/3 rounded-full bg-jade-500 animate-[ui-progress-slide_1.4s_ease-in-out_infinite]"></div>
        @else
            <div class="h-full rounded-full bg-jade-500 {{ $fill }}" style="{{ $fillStyle }}"></div>
        @endif
    </div>
</div>

@once
    <style>
        @keyframes ui-progress-slide {
            from {
                translate: -150% 0;
            }

            to {
                translate: 400% 0;
            }
        }

        @keyframes ui-progress-grow {
            from {
                transform: scaleX(0);
            }
        }

        @keyframes ui-progress-fade {
            from {
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-progress-grow'],
            [class*='ui-progress-fade'] {
                animation: none;
            }
        }
    </style>
@endonce
