@props([
    'label',
    'span',
    'unit' => 'days',
    'used' => 0,
    'then',
    'closed' => false,
])

@php
    $ratio = $span > 0 ? min(100, round($used / $span * 100, 2)) : 0;
    $left = max(0, $span - $used);
@endphp

<div {{ $attributes->class('rounded-xl border border-white/8 bg-ink-900 p-3.5') }}>
    <div class="flex items-baseline gap-3">
        <p class="min-w-0 flex-1 truncate text-[13px] text-cream">{{ $label }}</p>
        <p @class([
            'shrink-0 font-mono text-[11px]',
            'text-amber-300/80' => $closed,
            'text-jade-400' => ! $closed,
        ])>{{ $closed ? 'shut' : $left.' '.$unit.' left' }}</p>
    </div>

    <div class="mt-2.5 h-1.5 overflow-hidden rounded-full bg-white/8">
        <div @class([
            'h-full rounded-full',
            'bg-amber-400/60' => $closed,
            'bg-jade-500' => ! $closed,
        ]) style="width: {{ $ratio }}%"></div>
    </div>

    <div class="mt-2 flex items-baseline justify-between gap-3">
        <p class="shrink-0 font-mono text-[10px] whitespace-nowrap text-zinc-700">{{ $used }} of {{ $span }} {{ $unit }}</p>
        <p class="min-w-0 truncate text-right text-[11px] text-zinc-500">{{ $then }}</p>
    </div>
</div>
