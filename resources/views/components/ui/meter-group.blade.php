@props([
    'segments' => [],
    'label' => null,
    'total' => null,
    'max' => 100,
    'unit' => '%',
    'animate' => false,
    'duration' => 900,
    'delay' => 0,
    'stagger' => 90,
])

@php
    $colors = [
        'jade' => 'bg-jade-500',
        'mint' => 'bg-jade-300',
        'zinc' => 'bg-zinc-500',
    ];

    $timing = fn (int $step): string => 'animation-delay: '.((int) $delay + $step * (int) $stagger).'ms; --ui-meter-duration: '.(int) $duration.'ms';
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if ($label !== null || $total !== null)
        <div class="mb-2.5 flex items-baseline justify-between gap-4">
            @if ($label !== null)
                <p class="text-sm font-medium text-cream">{{ $label }}</p>
            @endif
            @if ($total !== null)
                <p class="font-mono text-xs text-zinc-500">{{ $total }}</p>
            @endif
        </div>
    @endif
    <div @class([
        'flex h-2 overflow-hidden rounded-full bg-ink-800',
        'origin-left animate-[ui-meter-grow_var(--ui-meter-duration)_var(--ease-snap)_both]' => $animate,
    ]) @if ($animate) style="{{ $timing(0) }}" @endif>
        @foreach ($segments as $segment)
            <span class="{{ $colors[$segment['color'] ?? 'jade'] ?? $colors['jade'] }}" style="width: {{ round($segment['value'] / $max * 100, 2) }}%"></span>
        @endforeach
    </div>
    <div class="mt-3 flex flex-col gap-1.5 text-xs">
        @foreach ($segments as $segment)
            <span @class([
                'flex items-center gap-2 text-zinc-400',
                'animate-[ui-meter-fade_var(--ui-meter-duration)_var(--ease-snap)_both]' => $animate,
            ]) @if ($animate) style="{{ $timing($loop->iteration) }}" @endif>
                <span class="size-2 shrink-0 rounded-full {{ $colors[$segment['color'] ?? 'jade'] ?? $colors['jade'] }}"></span>
                {{ $segment['label'] }}
                <span class="ml-auto font-mono text-zinc-500">{{ $segment['value'] }}{{ $unit === '%' ? '%' : ' '.$unit }}</span>
            </span>
        @endforeach
    </div>
</div>

@once
    <style>
        @keyframes ui-meter-grow {
            from {
                transform: scaleX(0);
            }
        }

        @keyframes ui-meter-fade {
            from {
                opacity: 0;
                translate: 0 4px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-meter-grow'],
            [class*='ui-meter-fade'] {
                animation: none;
            }
        }
    </style>
@endonce
