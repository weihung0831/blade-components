@props([
    'type' => 'where',
    'label',
    'value' => null,
    'removable' => true,
])

<span {{ $attributes->class('group/token inline-flex items-center gap-2 rounded-lg border border-white/10 bg-ink-900 py-1 pr-1 pl-2.5 text-[13px] transition-colors duration-150 hover:border-white/20') }}>
    <span @class([
        'font-mono text-[10px] tracking-wider uppercase',
        'text-jade-400' => $type === 'event',
        'text-zinc-600' => $type !== 'event',
    ])>{{ $type }}</span>

    <span class="text-zinc-200">{{ $label }}</span>

    @if ($value)
        <span class="font-mono text-[11px] text-zinc-500">{{ $value }}</span>
    @endif

    @if ($removable)
        <button type="button" aria-label="Remove {{ $label }}"
            class="grid size-5 shrink-0 place-items-center rounded-md text-zinc-700 transition-colors duration-150 outline-none hover:bg-white/8 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M3 3l6 6M9 3l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
    @endif
</span>
