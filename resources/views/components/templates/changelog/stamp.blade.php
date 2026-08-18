@props([
    'version',
    'date',
    'state' => 'live',
    'lines' => null,
    'note' => null,
    'lived' => null,
])

@php
    $states = [
        'live' => ['label' => 'live', 'dot' => 'bg-jade-500', 'text' => 'text-zinc-600'],
        'pulled' => ['label' => 'taken back out', 'dot' => 'bg-red-400', 'text' => 'text-red-400'],
        'superseded' => ['label' => 'replaced by a later one', 'dot' => 'bg-white/25', 'text' => 'text-zinc-700'],
        'rolling' => ['label' => 'still rolling out', 'dot' => 'bg-amber-400', 'text' => 'text-amber-300'],
    ];

    $mark = $states[$state] ?? $states['live'];
@endphp

<div data-stamp="{{ $version }}" data-state="{{ $state }}" {{ $attributes->class('flex flex-wrap items-baseline gap-x-3 gap-y-1.5') }}>
    <h3 @class([
        'font-mono text-[15px] tracking-tight',
        'text-red-400 line-through decoration-red-400/40' => $state === 'pulled',
        'text-cream' => $state !== 'pulled',
    ])>{{ $version }}</h3>

    <span class="font-mono text-[11px] text-zinc-600">{{ $date }}</span>

    <span class="flex shrink-0 items-center gap-1.5 font-mono text-[10px] {{ $mark['text'] }}">
        <span class="size-1.5 rounded-full {{ $mark['dot'] }}"></span>
        {{ $mark['label'] }}
    </span>

    @if ($lived)
        <span class="font-mono text-[10px] text-zinc-700">{{ $lived }}</span>
    @endif

    @if ($lines !== null)
        <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ $lines }} {{ $lines === 1 ? 'line' : 'lines' }}</span>
    @endif

    @if ($note)
        <p class="w-full text-[11px]/5 {{ $state === 'pulled' ? 'text-red-400/80' : 'text-zinc-600' }}">{{ $note }}</p>
    @endif
</div>
