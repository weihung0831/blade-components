@props([
    'label',
    'values' => [],
    'deltas' => [],
    'trends' => [],
    'spark' => [],
    'hint' => null,
])

@php
    $ranges = ['7d', '28d', '90d'];

    $show = [
        '7d' => 'hidden group-data-[range=7d]/shell:block',
        '28d' => 'hidden group-data-[range=28d]/shell:block',
        '90d' => 'hidden group-data-[range=90d]/shell:block',
    ];

    $line = function (array $points): string {
        $count = count($points);

        if ($count < 2) {
            return '';
        }

        $low = min($points);
        $span = max($points) - $low ?: 1;

        return implode(' ', array_map(
            fn (float|int $point, int $index): string => round($index / ($count - 1) * 100, 2).','.round(26 - (($point - $low) / $span) * 22, 2),
            $points,
            array_keys($points),
        ));
    };
@endphp

<div {{ $attributes->class('flex flex-col rounded-xl border border-white/10 bg-ink-800 p-4') }}>
    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $label }}</p>

    <div class="mt-2.5 flex items-end justify-between gap-3">
        <div>
            @foreach ($ranges as $range)
                <div class="{{ $show[$range] }}">
                    <p class="text-2xl font-semibold tracking-tight text-cream">{{ $values[$range] ?? '—' }}</p>
                    @isset($deltas[$range])
                        <p @class([
                            'mt-1 font-mono text-[11px]',
                            'text-jade-400' => ($trends[$range] ?? 'up') === 'up',
                            'text-red-400' => ($trends[$range] ?? 'up') === 'down',
                            'text-zinc-600' => ($trends[$range] ?? 'up') === 'flat',
                        ])>{{ $deltas[$range] }}</p>
                    @endisset
                </div>
            @endforeach
        </div>

        @if ($spark !== [])
            <svg class="h-7 w-20 shrink-0 text-jade-500" viewBox="0 0 100 28" preserveAspectRatio="none" fill="none" aria-hidden="true">
                @foreach ($ranges as $range)
                    @isset($spark[$range])
                        <polyline points="{{ $line($spark[$range]) }}" class="{{ $show[$range] }}"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke"/>
                    @endisset
                @endforeach
            </svg>
        @endif
    </div>

    @if ($hint)
        <p class="mt-3 font-mono text-[10px] text-zinc-700">{{ $hint }}</p>
    @endif
</div>
