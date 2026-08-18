@props([
    'label',
    'value' => 0,
    'max' => 100,
    'display' => null,
    'note' => null,
    'tone' => 'quiet',
    'marker' => null,
])

@php
    $tones = [
        'quiet' => 'bg-white/15',
        'ours' => 'bg-jade-500',
        'warn' => 'bg-amber-400/70',
        'bad' => 'bg-red-400/60',
    ];

    $width = $max > 0 ? min(100, round($value / $max * 100, 1)) : 0;
    $fill = $tones[$tone] ?? $tones['quiet'];
@endphp

<div {{ $attributes->class('flex flex-col gap-1.5') }}>
    <div class="flex items-baseline gap-3">
        <span @class(['min-w-0 flex-1 truncate text-[12px]', 'text-cream' => $tone === 'ours', 'text-zinc-400' => $tone !== 'ours'])>{{ $label }}</span>
        <span data-bar-display class="shrink-0 font-mono text-[11px] tabular-nums text-zinc-500">{{ $display ?? $value }}</span>
    </div>

    <div class="relative h-1.5 overflow-hidden rounded-full bg-white/6">
        <div data-bar-fill class="h-full rounded-full transition-[width] duration-300 ease-snap {{ $fill }}" style="width: {{ $width }}%"></div>

        @if ($marker !== null)
            <span class="absolute inset-y-0 w-px bg-cream/40" style="left: {{ min(100, round($marker / max($max, 1) * 100, 1)) }}%"></span>
        @endif
    </div>

    @if ($note)
        <p class="text-[11px]/5 text-zinc-600">{{ $note }}</p>
    @endif
</div>
