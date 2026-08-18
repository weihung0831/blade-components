@props([
    'label',
    'note' => null,
    'href' => null,
    'meta' => null,
    'kbd' => null,
    'tone' => 'quiet',
])

@php
    $classes = [
        'quiet' => 'border-white/8 bg-ink-950 text-zinc-300 hover:border-white/20 hover:text-cream',
        'primary' => 'border-jade-500/40 bg-jade-500/8 text-cream hover:border-jade-500/70',
        'dead' => 'border-white/6 bg-ink-950 text-zinc-600',
    ];

    $tag = $href === null ? 'div' : 'a';
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" target="_top" @endif
    {{ $attributes->class(['group flex items-center gap-3 rounded-xl border px-3.5 py-3 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70', $classes[$tone] ?? $classes['quiet']]) }}>

    <span class="min-w-0 flex-1">
        <span class="flex flex-wrap items-baseline gap-x-2">
            <span class="text-[13px]/5">{{ $label }}</span>

            @if ($kbd)
                <span class="rounded border border-white/10 px-1 font-mono text-[10px] text-zinc-600">{{ $kbd }}</span>
            @endif
        </span>

        @if ($note)
            <span class="mt-1 block text-[11px]/5 text-zinc-500">{{ $note }}</span>
        @endif
    </span>

    @if ($meta)
        <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ $meta }}</span>
    @endif

    @if ($href)
        <svg class="size-3.5 shrink-0 text-zinc-700 transition-transform duration-150 group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M6 3.5 10.5 8 6 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @endif
</{{ $tag }}>
