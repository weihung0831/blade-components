@props([
    'stars',
    'count',
    'percent',
    'active' => false,
])

<button type="button" data-review-filter="{{ $stars }}" @if ($active) data-active @endif
    {{ $attributes->class('group/bar flex w-full items-center gap-3 rounded-lg px-2 py-1.5 text-left transition-colors duration-150 outline-none hover:bg-white/4 focus-visible:ring-2 focus-visible:ring-jade-500/70') }}>
    <span class="w-8 shrink-0 font-mono text-[11px] text-zinc-500 group-data-[active]/bar:text-jade-300">{{ $stars }} ★</span>

    <span class="h-1.5 flex-1 overflow-hidden rounded-full bg-ink-800">
        <span class="block h-full rounded-full bg-zinc-600 transition-colors duration-150 group-hover/bar:bg-zinc-500 group-data-[active]/bar:bg-jade-500" style="width: {{ $percent }}%"></span>
    </span>

    <span class="w-10 shrink-0 text-right font-mono text-[11px] text-zinc-600">{{ $count }}</span>
</button>
