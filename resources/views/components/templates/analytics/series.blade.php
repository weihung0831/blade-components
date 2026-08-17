@props([
    'series' => [],
    'axis' => [],
    'scale' => [],
    'height' => 'h-64',
])

@php
    $ranges = ['7d', '28d', '90d'];

    $show = [
        '7d' => 'hidden group-data-[range=7d]/shell:block',
        '28d' => 'hidden group-data-[range=28d]/shell:block',
        '90d' => 'hidden group-data-[range=90d]/shell:block',
    ];

    $flex = [
        '7d' => 'hidden group-data-[range=7d]/shell:flex',
        '28d' => 'hidden group-data-[range=28d]/shell:flex',
        '90d' => 'hidden group-data-[range=90d]/shell:flex',
    ];

    $path = function (array $points, bool $close = false): string {
        $count = count($points);

        if ($count < 2) {
            return '';
        }

        $steps = array_map(
            fn (float|int $point, int $index): string => round($index / ($count - 1) * 100, 2).' '.round(100 - $point, 2),
            $points,
            array_keys($points),
        );

        $line = 'M'.implode(' L', $steps);

        return $close ? $line.' L100 100 L0 100 Z' : $line;
    };
@endphp

<div {{ $attributes }}>
    <div class="flex gap-3">
        <div class="flex w-9 shrink-0 flex-col justify-between py-px text-right font-mono text-[10px] text-zinc-700">
            @foreach ($ranges as $range)
                @isset($scale[$range])
                    <div class="{{ $flex[$range] }} h-full flex-col justify-between">
                        @foreach ($scale[$range] as $tick)
                            <span>{{ $tick }}</span>
                        @endforeach
                    </div>
                @endisset
            @endforeach
        </div>

        <div class="relative min-w-0 flex-1 {{ $height }}">
            <div aria-hidden="true" class="absolute inset-0 flex flex-col justify-between">
                @for ($i = 0; $i < 4; $i++)
                    <span class="h-px w-full bg-white/6"></span>
                @endfor
            </div>

            <svg class="relative h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
                @foreach ($series as $line)
                    @foreach ($ranges as $range)
                        @isset($line['points'][$range])
                            @if ($line['area'] ?? false)
                                <path d="{{ $path($line['points'][$range], true) }}" class="{{ $show[$range] }} text-jade-500" fill="currentColor" opacity="0.1"/>
                            @endif

                            <path d="{{ $path($line['points'][$range]) }}"
                                @class([$show[$range], 'text-jade-500' => ! ($line['muted'] ?? false), 'text-zinc-500' => $line['muted'] ?? false])
                                stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"
                                vector-effect="non-scaling-stroke"
                                @if ($line['dashed'] ?? false) stroke-dasharray="4 3" @endif />
                        @endisset
                    @endforeach
                @endforeach
            </svg>
        </div>
    </div>

    <div class="mt-2 flex gap-3">
        <span class="w-9 shrink-0"></span>
        <div class="min-w-0 flex-1">
            @foreach ($ranges as $range)
                @isset($axis[$range])
                    <div class="{{ $flex[$range] }} justify-between font-mono text-[10px] text-zinc-700">
                        @foreach ($axis[$range] as $tick)
                            <span>{{ $tick }}</span>
                        @endforeach
                    </div>
                @endisset
            @endforeach
        </div>
    </div>

    @if ($series !== [])
        <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 font-mono text-[11px] text-zinc-500">
            @foreach ($series as $line)
                <span class="inline-flex items-center gap-2">
                    <span @class([
                        'h-0.5 w-4 rounded-full',
                        'bg-jade-500' => ! ($line['muted'] ?? false),
                        'bg-zinc-500' => $line['muted'] ?? false,
                    ])></span>
                    {{ $line['label'] }}
                </span>
            @endforeach
        </div>
    @endif
</div>
