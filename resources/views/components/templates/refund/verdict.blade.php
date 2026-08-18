@props([
    'when',
    'asked',
    'said',
    'record',
    'outcome' => 'refused',
])

@php
    $outcomes = [
        'refused' => ['label' => 'refused', 'class' => 'text-amber-300/80', 'dot' => 'bg-amber-400/80'],
        'paid' => ['label' => 'paid anyway', 'class' => 'text-jade-400/90', 'dot' => 'bg-jade-500'],
        'wrong' => ['label' => 'we were wrong', 'class' => 'text-jade-300', 'dot' => 'bg-jade-400'],
    ];

    $tag = $outcomes[$outcome] ?? $outcomes['refused'];
@endphp

<li data-verdict
    data-outcome="{{ $outcome }}"
    {{ $attributes->class([
        'flex gap-3 px-3.5 py-3',
        'bg-jade-500/5' => $outcome === 'wrong',
    ]) }}>

    <span class="mt-1.5 size-1.5 shrink-0 rounded-full {{ $tag['dot'] }}"></span>

    <span class="min-w-0 flex-1">
        <span class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
            <span class="text-[13px] text-zinc-300">{{ $asked }}</span>
            <span class="font-mono text-[10px] {{ $tag['class'] }}">{{ $tag['label'] }}</span>
        </span>
        <span class="mt-1 block text-[12px]/5 text-zinc-500">{{ $said }}</span>
    </span>

    <span class="flex w-24 shrink-0 flex-col items-end gap-1 sm:w-32">
        <span class="font-mono text-[10px] text-zinc-500">{{ $when }}</span>
        <span class="font-mono text-[10px] text-zinc-700">{{ $record }}</span>
    </span>
</li>
