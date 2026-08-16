@props([
    'items' => [],
    'max' => null,
    'height' => 'h-40',
    'values' => true,
    'duration' => 900,
    'stagger' => 120,
])

@php
    $ceiling = $max ?? max(1, ...array_map(fn (array $item): float => (float) $item['value'], $items ?: [['value' => 1]]));
@endphp

<div {{ $attributes->class(['w-full']) }}>
    <div class="flex items-end gap-2 {{ $height }}">
        @foreach ($items as $index => $item)
            @php
                $percent = $ceiling > 0 ? min(100, max(0, ((float) $item['value'] / $ceiling) * 100)) : 0;
                $delay = $index * (int) $stagger;
            @endphp
            <div class="relative flex h-full flex-1 items-end">
                <span @class([
                    'w-full origin-bottom rounded-t-sm animate-[ui-column-chart-grow_var(--ui-chart-duration)_var(--ease-snap)_both]',
                    'bg-jade-500' => $item['highlight'] ?? false,
                    'bg-jade-500/30' => ! ($item['highlight'] ?? false),
                ]) style="height: {{ $percent }}%; animation-delay: {{ $delay }}ms; --ui-chart-duration: {{ (int) $duration }}ms"></span>

                @if ($values)
                    <span class="absolute inset-x-0 text-center font-mono text-[10px] text-zinc-500 animate-[ui-column-chart-fade_var(--ui-chart-duration)_var(--ease-snap)_both]"
                        style="bottom: calc({{ $percent }}% + 6px); animation-delay: {{ $delay }}ms; --ui-chart-duration: {{ (int) $duration }}ms">{{ $item['value'] }}</span>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-1.5 h-px bg-white/10"></div>

    <div class="mt-1.5 flex gap-2">
        @foreach ($items as $item)
            <span class="flex-1 text-center font-mono text-[10px] text-zinc-600">{{ $item['label'] ?? '' }}</span>
        @endforeach
    </div>
</div>

@once
    <style>
        @keyframes ui-column-chart-grow {
            from {
                transform: scaleY(0);
            }
        }

        @keyframes ui-column-chart-fade {
            from {
                opacity: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-column-chart-'] {
                animation: none;
            }
        }
    </style>
@endonce
