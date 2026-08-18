@props([
    'label',
    'count' => 0,
    'amount',
    'value' => 0,
    'max' => 100,
    'tone' => 'quiet',
    'note' => null,
    'active' => false,
])

@php
    $tones = [
        'quiet' => ['fill' => 'bg-white/20', 'text' => 'text-zinc-400'],
        'ok' => ['fill' => 'bg-jade-500', 'text' => 'text-jade-300'],
        'warn' => ['fill' => 'bg-amber-400/70', 'text' => 'text-amber-300'],
        'bad' => ['fill' => 'bg-red-400/70', 'text' => 'text-red-400'],
    ];

    $skin = $tones[$tone] ?? $tones['quiet'];
    $width = $max > 0 ? min(100, round($value / $max * 100, 1)) : 0;
@endphp

<div {{ $attributes->class(['flex flex-col gap-2 rounded-xl border p-3.5 text-left transition-colors duration-150', $active ? 'border-jade-500/50 bg-jade-500/6' : 'border-white/8 bg-ink-950 hover:border-white/20']) }}>
    <div class="flex items-baseline justify-between gap-3">
        <span class="text-[12px] text-zinc-400">{{ $label }}</span>
        <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ $count }} inv</span>
    </div>

    <span class="font-mono text-[15px] tabular-nums {{ $skin['text'] }}">{{ $amount }}</span>

    <span class="block h-1.5 overflow-hidden rounded-full bg-white/6">
        <span class="block h-full rounded-full transition-[width] duration-300 ease-snap {{ $skin['fill'] }}" style="width: {{ $width }}%"></span>
    </span>

    @if ($note)
        <span class="text-[11px]/4 text-zinc-600">{{ $note }}</span>
    @endif
</div>
