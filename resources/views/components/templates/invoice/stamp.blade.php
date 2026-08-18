@props([
    'label',
    'tone' => 'issued',
    'note' => null,
    'tilt' => 'left',
])

@php
    $tones = [
        'issued' => 'border-zinc-600 text-zinc-500',
        'paid' => 'border-jade-500/70 text-jade-300',
        'overdue' => 'border-red-400/70 text-red-400',
        'draft' => 'border-amber-400/60 text-amber-300',
        'void' => 'border-white/15 text-zinc-700',
    ];

    $tilts = [
        'left' => '-rotate-6',
        'right' => 'rotate-3',
        'none' => 'rotate-0',
    ];
@endphp

<span {{ $attributes->class(['inline-flex flex-col items-center gap-1 rounded-lg border-2 border-dashed px-3 py-1.5 select-none', $tones[$tone] ?? $tones['issued'], $tilts[$tilt] ?? $tilts['left']]) }}>
    <span class="font-mono text-[13px] font-bold tracking-[0.18em] uppercase">{{ $label }}</span>

    @if ($note)
        <span class="font-mono text-[9px] tracking-wider opacity-80">{{ $note }}</span>
    @endif
</span>
