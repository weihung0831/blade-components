@props([
    'label',
    'value' => null,
    'placeholder' => null,
    'why' => null,
    'hint' => null,
    'prefix' => null,
    'suffix' => null,
    'locked' => false,
    'optional' => false,
])

<label {{ $attributes->class('block') }}>
    <span class="flex items-baseline gap-2">
        <span class="text-[12px] text-zinc-300">{{ $label }}</span>
        @if ($optional)
            <span class="font-mono text-[10px] text-zinc-700">optional</span>
        @endif
        @if ($locked)
            <span class="ml-auto font-mono text-[10px] text-amber-300/70">set for good</span>
        @endif
    </span>

    <span @class([
        'mt-1.5 flex items-center gap-0 overflow-hidden rounded-lg border transition-colors duration-150',
        'border-white/8 bg-ink-950/60' => $locked,
        'border-white/10 bg-ink-950 focus-within:border-jade-500/60' => ! $locked,
    ])>
        @if ($prefix)
            <span class="shrink-0 border-r border-white/8 px-2.5 py-2 font-mono text-[11px] text-zinc-600">{{ $prefix }}</span>
        @endif

        @if ($locked)
            <span class="min-w-0 flex-1 truncate px-3 py-2 font-mono text-[12px] text-zinc-500">{{ $value }}</span>
        @else
            <input type="text" value="{{ $value }}" placeholder="{{ $placeholder }}"
                class="min-w-0 flex-1 bg-transparent px-3 py-2 text-[13px] text-cream placeholder:text-zinc-700 focus:outline-none" />
        @endif

        @if ($suffix)
            <span class="shrink-0 border-l border-white/8 px-2.5 py-2 font-mono text-[11px] text-zinc-600">{{ $suffix }}</span>
        @endif
    </span>

    @if ($why)
        <span class="mt-1.5 block text-[11px]/5 text-zinc-600">{{ $why }}</span>
    @endif

    @if ($hint)
        <span class="mt-1 block font-mono text-[10px] text-jade-400/80">{{ $hint }}</span>
    @endif
</label>
