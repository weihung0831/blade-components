@props([
    'name',
    'tagline',
    'monthly',
    'annual' => null,
    'period' => '/ mo',
    'annualNote' => null,
    'unit' => null,
    'cta' => 'Start a trial',
    'ctaVariant' => 'secondary',
    'badge' => null,
    'features' => [],
    'meta' => null,
    'featured' => false,
])

<article @class([
    'relative flex flex-col rounded-2xl border p-6',
    'border-jade-500/40 bg-jade-500/6 shadow-xl shadow-jade-950/20' => $featured,
    'border-white/8 bg-ink-900' => ! $featured,
])>
    @if ($badge)
        <span @class([
            'absolute -top-2.5 right-6 rounded-full px-2.5 py-0.5 font-mono text-[10px] tracking-wider uppercase',
            'bg-jade-500 text-ink-950' => $featured,
            'border border-white/10 bg-ink-950 text-zinc-500' => ! $featured,
        ])>{{ $badge }}</span>
    @endif

    <h3 @class(['text-lg font-semibold tracking-tight', $featured ? 'text-jade-300' : 'text-cream'])>{{ $name }}</h3>
    <p class="mt-1.5 min-h-12 text-[13px]/6 text-zinc-500">{{ $tagline }}</p>

    <div class="mt-6 flex items-baseline gap-1.5">
        <span class="text-3xl font-semibold tracking-tight text-cream">
            <span @class(['group-data-[cycle=annual]/shell:hidden' => $annual !== null])>{{ $monthly }}</span>
            @if ($annual !== null)
                <span class="hidden group-data-[cycle=annual]/shell:inline">{{ $annual }}</span>
            @endif
        </span>
        @if ($period)
            <span class="font-mono text-xs text-zinc-600">{{ $period }}</span>
        @endif
    </div>

    <p class="mt-2 min-h-8 font-mono text-[11px]/5 text-zinc-600">
        @if ($unit)
            <span class="block text-zinc-500">{{ $unit }}</span>
        @endif
        @if ($annualNote)
            <span class="hidden group-data-[cycle=annual]/shell:block">{{ $annualNote }}</span>
        @endif
    </p>

    <x-ui.button :variant="$ctaVariant" class="mt-5 w-full">{{ $cta }}</x-ui.button>

    <x-ui.separator class="my-6" />

    <ul class="flex flex-col gap-2.5">
        @foreach ($features as $feature)
            <li class="flex items-start gap-2.5">
                <svg @class(['mt-1 size-3 shrink-0', $featured ? 'text-jade-400' : 'text-zinc-600']) viewBox="0 0 12 12" fill="none">
                    <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-[13px]/5 text-zinc-400">{{ $feature['label'] }}@isset($feature['meta'])<span class="ml-1 font-mono text-[11px] text-zinc-600">{{ $feature['meta'] }}</span>@endisset</span>
            </li>
        @endforeach
    </ul>

    @if ($meta)
        <div class="grow"></div>
        <p class="mt-6 border-t border-white/5 pt-4 font-mono text-[10px]/5 text-zinc-600">{{ $meta }}</p>
    @endif
</article>
