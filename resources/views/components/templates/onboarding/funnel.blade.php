@props([
    'stage',
    'step',
    'reached',
    'of',
    'minutes' => null,
    'claimed' => null,
    'lost' => 0,
    'note' => null,
    'worst' => false,
])

@php
    $ratio = $of > 0 ? round($reached / $of * 100, 1) : 0;
    $over = $claimed !== null && $minutes !== null && $minutes > $claimed;
    $timing = $minutes === null
        ? null
        : $minutes.' min in practice'.($claimed !== null ? ', '.$claimed.' on the label' : '');
@endphp

<div data-funnel="{{ $stage }}" {{ $attributes->class('px-3.5 py-3') }}>
    <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1">
        <p @class([
            'min-w-0 flex-1 truncate text-[13px]',
            'text-amber-300' => $worst,
            'text-cream' => ! $worst,
        ])>{{ $step }}</p>

        <p data-funnel-reached class="shrink-0 font-mono text-[11px] text-zinc-400">{{ number_format($reached) }}</p>
        <p data-funnel-ratio class="w-12 shrink-0 text-right font-mono text-[11px] text-zinc-600">{{ $ratio }}%</p>
    </div>

    <div class="mt-2 flex items-center gap-2">
        <span class="h-1.5 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6">
            <span data-funnel-bar @class([
                'block h-full rounded-full transition-[width] duration-300',
                'bg-amber-400/70' => $worst,
                'bg-jade-500' => ! $worst,
            ]) style="width: {{ $ratio }}%"></span>
        </span>

        <span data-funnel-lost @class(['shrink-0 font-mono text-[10px] text-zinc-700', 'hidden' => $lost === 0])>{{ number_format($lost) }} stopped here</span>
    </div>

    <div class="mt-1.5 flex flex-wrap items-baseline gap-x-4 gap-y-1">
        @if ($timing)
            <p @class([
                'shrink-0 font-mono text-[10px]',
                'text-amber-300/80' => $over,
                'text-zinc-600' => ! $over,
            ])>{{ $timing }}</p>
        @endif

        @if ($note)
            <p class="min-w-0 flex-1 text-[11px]/5 text-zinc-600">{{ $note }}</p>
        @endif
    </div>
</div>
