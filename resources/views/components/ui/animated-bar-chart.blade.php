@props([
    'items' => [],
    'max' => null,
    'values' => true,
    'duration' => 900,
    'stagger' => 120,
    'labelWidth' => 'w-16',
])

@php
    $ceiling = $max ?? max(1, ...array_map(fn (array $item): float => (float) $item['value'], $items ?: [['value' => 1]]));
@endphp

<div {{ $attributes->class(['flex w-full flex-col gap-2.5']) }}>
    @foreach ($items as $index => $item)
        @php
            $percent = $ceiling > 0 ? min(100, max(0, ((float) $item['value'] / $ceiling) * 100)) : 0;
            $delay = $index * (int) $stagger;
        @endphp
        <div class="flex items-center gap-3">
            <span class="shrink-0 text-right font-mono text-[10px] text-zinc-600 {{ $labelWidth }}">{{ $item['label'] ?? '' }}</span>

            <div class="relative h-2.5 flex-1">
                <span @class([
                    'block h-full origin-left rounded-r-sm animate-[ui-bar-chart-grow_var(--ui-chart-duration)_var(--ease-snap)_both]',
                    'bg-jade-500' => $item['highlight'] ?? false,
                    'bg-jade-500/30' => ! ($item['highlight'] ?? false),
                ]) style="width: {{ $percent }}%; animation-delay: {{ $delay }}ms; --ui-chart-duration: {{ (int) $duration }}ms"></span>

                @if ($values)
                    <span class="absolute top-1/2 -translate-y-1/2 pl-2 font-mono text-[10px] text-zinc-500 animate-[ui-bar-chart-fade_var(--ui-chart-duration)_var(--ease-snap)_both]"
                        style="left: {{ $percent }}%; animation-delay: {{ $delay }}ms; --ui-chart-duration: {{ (int) $duration }}ms">{{ $item['value'] }}</span>
                @endif
            </div>
        </div>
    @endforeach
</div>

@once
    <style>
        @keyframes ui-bar-chart-grow {
            from {
                transform: scaleX(0);
            }
        }

        @keyframes ui-bar-chart-fade {
            from {
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-bar-chart-'] {
                animation: none;
            }
        }
    </style>
@endonce
