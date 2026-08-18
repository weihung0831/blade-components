@props([
    'rows' => [],
    'total',
    'totalLabel' => 'Total due',
    'note' => null,
    'words' => null,
    'tone' => 'quiet',
])

@php
    $tones = [
        'quiet' => 'text-cream',
        'due' => 'text-jade-300',
        'overdue' => 'text-red-400',
    ];
@endphp

<div {{ $attributes->class('flex flex-col gap-3') }}>
    <dl class="flex flex-col gap-2">
        @foreach ($rows as $row)
            <div class="flex items-baseline justify-between gap-6">
                <dt class="text-[12px] {{ ($row['strong'] ?? false) ? 'text-zinc-300' : 'text-zinc-500' }}">
                    {{ $row['label'] }}
                    @isset($row['note'])
                        <span class="ml-1.5 font-mono text-[10px] text-zinc-700">{{ $row['note'] }}</span>
                    @endisset
                </dt>
                <dd class="shrink-0 font-mono text-[12px] tabular-nums {{ ($row['strong'] ?? false) ? 'text-cream' : 'text-zinc-400' }}">{{ $row['value'] }}</dd>
            </div>
        @endforeach
    </dl>

    <div class="flex items-baseline justify-between gap-6 border-t border-white/10 pt-3">
        <span class="text-[13px] text-zinc-300">{{ $totalLabel }}</span>
        <span data-invoice-total class="shrink-0 font-mono text-lg font-semibold tracking-tight tabular-nums {{ $tones[$tone] ?? $tones['quiet'] }}">{{ $total }}</span>
    </div>

    @if ($words)
        <p class="text-[11px]/5 text-zinc-600">{{ $words }}</p>
    @endif

    @if ($note)
        <p class="border-t border-white/6 pt-2.5 font-mono text-[10px] text-zinc-700">{{ $note }}</p>
    @endif
</div>
