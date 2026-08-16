@props([
    'value' => 0,
    'max' => 100,
    'label' => null,
    'indeterminate' => false,
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'h-1',
        'md' => 'h-1.5',
        'lg' => 'h-2.5',
    ];

    $percent = $max > 0 ? min(100, max(0, ($value / $max) * 100)) : 0;
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if ($label)
        <div class="mb-2 flex items-baseline justify-between gap-4">
            <span class="text-xs text-zinc-500">{{ $label }}</span>
            @unless ($indeterminate)
                <span class="font-mono text-xs text-jade-400">{{ round($percent) }}%</span>
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
            <div class="h-full rounded-full bg-jade-500 transition-[width] duration-500 ease-snap" style="width: {{ $percent }}%"></div>
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
    </style>
@endonce
