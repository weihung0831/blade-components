@props([
    'version',
    'date',
    'state' => 'retired',
    'lead' => null,
    'touched' => [],
    'consent' => false,
    'active' => false,
])

@php
    $pill = [
        'force' => ['label' => 'in force', 'class' => 'border-jade-500/40 bg-jade-500/10 text-jade-300'],
        'pending' => ['label' => 'waiting', 'class' => 'border-amber-400/30 bg-amber-400/8 text-amber-300/90'],
        'retired' => ['label' => 'retired', 'class' => 'border-white/10 text-zinc-600'],
    ][$state] ?? ['label' => $state, 'class' => 'border-white/10 text-zinc-600'];
@endphp

<button type="button"
    data-revision="{{ $version }}"
    @if ($active) data-active @endif
    {{ $attributes->class([
        'group/rev flex w-full flex-col rounded-xl border bg-ink-900 p-3.5 text-left outline-none',
        'border-white/8 transition-colors duration-150 hover:border-white/15 focus-visible:ring-2 focus-visible:ring-jade-500/70',
        'data-active:border-jade-500/60 data-active:bg-jade-500/8',
    ]) }}>

    <span class="flex items-baseline gap-2.5">
        <span class="font-mono text-base text-cream">{{ $version }}</span>
        <span class="rounded border px-1.5 py-0.5 font-mono text-[10px] {{ $pill['class'] }}">{{ $pill['label'] }}</span>
        <span class="ml-auto font-mono text-[10px] text-zinc-700">{{ $date }}</span>
    </span>

    @if ($lead)
        <span class="mt-2 text-[12px]/5 text-zinc-500">{{ $lead }}</span>
    @endif

    <span class="mt-2.5 flex flex-wrap items-center gap-1.5">
        @if ($touched !== [])
            <span class="font-mono text-[10px] text-zinc-700">touched</span>
            @foreach ($touched as $number)
                <span class="rounded border border-white/10 px-1 py-0.5 font-mono text-[10px] text-zinc-500">{{ $number }}</span>
            @endforeach
        @endif

        <span @class([
            'ml-auto font-mono text-[10px]',
            'text-amber-300/80' => $consent,
            'text-zinc-700' => ! $consent,
        ])>{{ $consent ? 'needed a yes from you' : 'notice only' }}</span>
    </span>
</button>
