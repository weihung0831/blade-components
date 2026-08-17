@props([
    'name',
    'lead' => null,
    'person' => null,
    'reply' => null,
    'window' => null,
    'open' => false,
    'bring' => [],
    'active' => false,
    'href' => null,
])

<a href="{{ $href ?? route('templates.screen', ['contact', 'write']) }}" target="_top"
    @if ($active) data-active @endif
    {{ $attributes->class([
        'group/route flex flex-col rounded-xl border border-white/8 bg-ink-900 p-4 outline-none',
        'transition-colors duration-150 hover:border-white/15 focus-visible:ring-2 focus-visible:ring-jade-500/70',
        'data-active:border-jade-500/60 data-active:bg-jade-500/8',
    ]) }}>

    <span class="flex items-baseline gap-2">
        <span class="text-[13px] font-medium text-zinc-300 group-hover/route:text-cream group-data-active/route:text-cream">{{ $name }}</span>

        <span class="ml-auto flex shrink-0 items-center gap-1.5">
            <span @class(['size-1.5 rounded-full', 'bg-jade-400' => $open, 'bg-amber-400/70' => ! $open])></span>
            <span @class(['font-mono text-[10px]', 'text-jade-400/90' => $open, 'text-zinc-700' => ! $open])>{{ $open ? 'reading now' : 'asleep' }}</span>
        </span>
    </span>

    @if ($lead)
        <span class="mt-1.5 text-[12px]/5 text-zinc-500">{{ $lead }}</span>
    @endif

    <span class="mt-3.5 flex items-end gap-3 border-t border-white/5 pt-3">
        <span class="flex flex-col">
            <span class="font-mono text-base text-cream">{{ $reply }}</span>
            <span class="mt-0.5 font-mono text-[10px] text-zinc-700">median first reply</span>
        </span>

        <span class="ml-auto flex flex-col text-right">
            @if ($person)
                <span class="text-[12px] text-zinc-400">{{ $person }}</span>
            @endif
            @if ($window)
                <span class="mt-0.5 font-mono text-[10px] text-zinc-700">{{ $window }}</span>
            @endif
        </span>
    </span>

    @if ($bring !== [])
        <span class="mt-3 flex flex-wrap items-center gap-1.5">
            <span class="font-mono text-[10px] text-zinc-700">have ready</span>
            @foreach ($bring as $item)
                <span class="rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500">{{ $item }}</span>
            @endforeach
        </span>
    @endif
</a>
