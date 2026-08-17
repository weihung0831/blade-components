@props([
    'name',
    'count' => 0,
    'lead' => null,
    'health' => null,
    'note' => null,
    'active' => false,
])

<button type="button"
    data-topic-card="{{ Illuminate\Support\Str::lower($name) }}"
    @if ($active) data-active @endif
    {{ $attributes->class([
        'group/topic flex flex-col rounded-xl border border-white/8 bg-ink-900 px-4 py-3.5 text-left outline-none',
        'transition-colors duration-150 hover:border-white/15 focus-visible:ring-2 focus-visible:ring-jade-500/70',
        'data-active:border-jade-500/60 data-active:bg-jade-500/8',
    ]) }}>

    <span class="flex items-baseline gap-2">
        <span class="text-[13px] font-medium text-zinc-300 group-data-active/topic:text-cream">{{ $name }}</span>
        <span class="ml-auto font-mono text-[11px] text-zinc-700 group-data-active/topic:text-jade-400">{{ sprintf('%02d', $count) }}</span>
    </span>

    @if ($lead)
        <span class="mt-1.5 line-clamp-2 text-[12px]/5 text-zinc-600">Most opened: {{ $lead }}</span>
    @endif

    <span class="mt-3 flex items-center gap-2">
        <span class="block h-0.5 flex-1 overflow-hidden rounded-full bg-white/8">
            <span class="block h-full rounded-full {{ ($health ?? 100) >= 80 ? 'bg-jade-500/60' : 'bg-amber-400/60' }}" style="width: {{ $health ?? 0 }}%"></span>
        </span>
        <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ $note ?? $health.'% helpful' }}</span>
    </span>
</button>
