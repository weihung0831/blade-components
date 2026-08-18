@props([
    'address',
    'was' => null,
    'happened' => null,
    'now' => null,
    'href' => null,
    'when' => null,
    'hits' => null,
])

<div data-moved data-terms="{{ Illuminate\Support\Str::lower(($was ?? '').' '.$address.' '.($now ?? '')) }}"
    {{ $attributes->class('px-3.5 py-3') }}>

    <div class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
        <span class="font-mono text-[11px] text-zinc-600 line-through decoration-white/20">{{ $address }}</span>

        @if ($when)
            <span class="font-mono text-[10px] text-zinc-700">{{ $when }}</span>
        @endif

        @if ($hits)
            <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ $hits }}</span>
        @endif
    </div>

    @if ($was)
        <p class="mt-1.5 text-[13px]/5 text-cream">{{ $was }}</p>
    @endif

    @if ($happened)
        <p class="mt-1 text-[11px]/5 text-zinc-500">{{ $happened }}</p>
    @endif

    @if ($now)
        <div class="mt-2 flex items-baseline gap-1.5">
            <svg class="size-3 shrink-0 translate-y-0.5 text-jade-500/70" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M7 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>

            @if ($href)
                <a href="{{ $href }}" target="_top" class="text-[12px]/5 text-jade-300 transition-colors duration-150 hover:text-jade-400">{{ $now }}</a>
            @else
                <span class="text-[12px]/5 text-zinc-400">{{ $now }}</span>
            @endif
        </div>
    @endif
</div>
