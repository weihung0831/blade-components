@props([
    'thing',
    'announced',
    'shipped' => null,
    'slip' => null,
    'state' => 'shipped',
    'version' => null,
    'note' => null,
])

@php
    $states = [
        'shipped' => ['label' => 'shipped', 'text' => 'text-cream', 'bar' => 'bg-jade-500'],
        'late' => ['label' => 'shipped late', 'text' => 'text-cream', 'bar' => 'bg-amber-400/70'],
        'dropped' => ['label' => 'dropped', 'text' => 'text-zinc-500 line-through decoration-white/20', 'bar' => 'bg-white/10'],
        'open' => ['label' => 'still open', 'text' => 'text-zinc-300', 'bar' => 'bg-white/20'],
    ];

    $mark = $states[$state] ?? $states['shipped'];
    $width = $slip === null ? 4 : min(100, max(4, round($slip / 40 * 100)));
@endphp

<div data-promise="{{ $state }}" {{ $attributes->class('px-3.5 py-3') }}>
    <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
        <p class="min-w-0 flex-1 text-[13px] {{ $mark['text'] }}">{{ $thing }}</p>

        @if ($version)
            <span class="shrink-0 font-mono text-[10px] text-zinc-600">{{ $version }}</span>
        @endif

        <span @class([
            'w-24 shrink-0 text-right font-mono text-[10px]',
            'text-amber-300/80' => $state === 'late',
            'text-zinc-700' => $state !== 'late',
        ])>{{ $mark['label'] }}</span>
    </div>

    <div class="mt-2 flex items-center gap-2">
        <span class="w-20 shrink-0 font-mono text-[10px] text-zinc-700">{{ $announced }}</span>

        <span class="h-1.5 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6">
            <span class="block h-full rounded-full transition-[width] duration-300 {{ $mark['bar'] }}" style="width: {{ $width }}%"></span>
        </span>

        <span @class([
            'w-20 shrink-0 text-right font-mono text-[10px]',
            'text-zinc-500' => $shipped !== null,
            'text-zinc-700' => $shipped === null,
        ])>{{ $shipped ?? 'never' }}</span>
    </div>

    @if ($slip !== null || $note)
        <div class="mt-1.5 flex flex-wrap items-baseline gap-x-3 gap-y-1">
            @if ($slip !== null)
                <p @class([
                    'shrink-0 font-mono text-[10px]',
                    'text-amber-300/80' => $slip > 12,
                    'text-zinc-600' => $slip <= 12,
                ])>{{ $slip }} weeks between the two</p>
            @endif

            @if ($note)
                <p class="min-w-0 flex-1 text-[11px]/5 text-zinc-600">{{ $note }}</p>
            @endif
        </div>
    @endif
</div>
