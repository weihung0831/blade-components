@props([
    'label',
    'span',
    'unit' => 'days',
    'elapsed' => 0,
    'then',
    'pinned' => false,
])

@php
    $ratio = $span > 0 ? min(100, round($elapsed / $span * 100, 2)) : 0;
@endphp

<div {{ $attributes->class('rounded-xl border border-white/8 bg-ink-900 p-3.5') }}>
    <div class="flex items-baseline gap-3">
        <p class="min-w-0 flex-1 truncate text-[13px] text-cream">{{ $label }}</p>
        <p @class([
            'shrink-0 font-mono text-[11px]',
            'text-amber-300/80' => $pinned,
            'text-zinc-400' => ! $pinned,
        ])>{{ $span }} {{ $unit }}</p>
    </div>

    <div class="mt-2.5 h-1.5 overflow-hidden rounded-full bg-white/8">
        <div @class([
            'h-full rounded-full',
            'bg-amber-400/60' => $pinned,
            'bg-jade-500' => ! $pinned,
        ]) style="width: {{ $ratio }}%"></div>
    </div>

    <div class="mt-2 flex items-baseline justify-between gap-3">
        <p class="shrink-0 font-mono text-[10px] whitespace-nowrap text-zinc-700">{{ $elapsed }} {{ $unit }} in</p>
        <p class="min-w-0 truncate text-right text-[11px] text-zinc-500">{{ $then }}</p>
    </div>
</div>
