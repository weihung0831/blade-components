@props([
    'zone' => 'Taipei',
    'time' => '04:12',
    'cursor' => 4.2,
    'state' => 'shut',
    'days' => 'Mon–Fri',
    'windows' => [[9.5, 18.5]],
    'note' => null,
])

@php
    $pill = match ($state) {
        'open' => ['dot' => 'bg-jade-400', 'text' => 'text-jade-300', 'edge' => 'border-jade-500/30 bg-jade-500/8', 'word' => 'The bench is open'],
        'soon' => ['dot' => 'bg-jade-400/60', 'text' => 'text-jade-300/90', 'edge' => 'border-jade-500/25 bg-jade-500/5', 'word' => 'Opening shortly'],
        default => ['dot' => 'bg-amber-400', 'text' => 'text-amber-300/90', 'edge' => 'border-amber-400/25 bg-amber-400/8', 'word' => 'Nobody is at the bench'],
    };

    $band = $state === 'open' ? 'bg-jade-500/55' : 'bg-white/14';
@endphp

<div {{ $attributes->class('flex flex-wrap items-center gap-x-5 gap-y-3') }}>

    <span class="flex shrink-0 items-center gap-2 rounded-lg border px-2.5 py-1.5 {{ $pill['edge'] }}">
        <span class="size-1.5 rounded-full {{ $pill['dot'] }}"></span>
        <span class="text-[12px] {{ $pill['text'] }}">{{ $pill['word'] }}</span>
        <span class="font-mono text-[11px] text-zinc-600">{{ $time }} {{ $zone }}</span>
    </span>

    <div class="min-w-[14rem] flex-1">
        <div class="relative h-1.5 rounded-full bg-white/6">
            @foreach ($windows as [$from, $to])
                <span class="absolute inset-y-0 rounded-full {{ $band }}"
                    style="left: {{ round($from / 24 * 100, 3) }}%; width: {{ round(($to - $from) / 24 * 100, 3) }}%"></span>
            @endforeach

            <span class="absolute -top-1.5 -bottom-1.5 w-px bg-cream" style="left: {{ round($cursor / 24 * 100, 3) }}%">
                <span class="absolute -top-1 -left-[1.5px] size-1 rounded-full bg-cream"></span>
            </span>
        </div>

        <div class="relative mt-1.5 h-3">
            @foreach ([0 => '00', 6 => '06', 12 => '12', 18 => '18'] as $hour => $label)
                <span class="absolute font-mono text-[9px] text-zinc-700" style="left: {{ round($hour / 24 * 100, 3) }}%">{{ $label }}</span>
            @endforeach
            <span class="absolute right-0 font-mono text-[9px] text-zinc-700">24</span>
        </div>
    </div>

    <span class="shrink-0 font-mono text-[11px] text-zinc-600">{{ $note ?? $days }}</span>
</div>
