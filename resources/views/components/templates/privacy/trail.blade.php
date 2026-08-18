@props([
    'who',
    'role',
    'when',
    'why',
    'record',
    'flagged' => false,
])

<li data-trail
    @if ($flagged) data-flagged @endif
    {{ $attributes->class([
        'flex gap-3 px-3.5 py-3',
        'bg-amber-400/5' => $flagged,
    ]) }}>

    <span @class([
        'mt-1.5 size-1.5 shrink-0 rounded-full',
        'bg-amber-400/80' => $flagged,
        'bg-zinc-700' => ! $flagged,
    ])></span>

    <span class="min-w-0 flex-1">
        <span class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
            <span class="text-[13px] text-zinc-300">{{ $who }}</span>
            <span class="font-mono text-[10px] text-zinc-600">{{ $role }}</span>
        </span>
        <span class="mt-1 block text-[12px]/5 text-zinc-500">{{ $why }}</span>
    </span>

    <span class="flex w-32 shrink-0 flex-col items-end gap-1 sm:w-40">
        <span class="font-mono text-[10px] text-zinc-500">{{ $when }}</span>
        <span class="font-mono text-[10px] text-zinc-700">{{ $record }}</span>
    </span>
</li>
