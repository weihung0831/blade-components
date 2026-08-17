@props([
    'number',
    'title',
    'says',
    'means' => null,
    'favours' => 'both',
    'bites' => false,
    'href' => null,
])

@php
    $label = ['us' => 'ours', 'you' => 'yours', 'both' => 'even'][$favours] ?? 'even';
@endphp

<a href="{{ $href ?? route('templates.screen', ['terms', 'document']).'#clause-'.$number }}" target="_top"
    data-gist
    data-favours="{{ $favours }}"
    @if ($bites) data-bites @endif
    {{ $attributes->class([
        'group/gist flex gap-3 px-3 py-3 outline-none sm:gap-5',
        'transition-colors duration-150 hover:bg-white/3 focus-visible:ring-2 focus-visible:ring-jade-500/70',
    ]) }}>

    <span class="w-6 shrink-0 font-mono text-[11px] text-zinc-700">{{ $number }}</span>

    <span class="min-w-0 flex-1">
        <span class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
            <span class="text-[13px] text-zinc-300 group-hover/gist:text-cream">{{ $title }}</span>
            @if ($bites)
                <span class="font-mono text-[10px] text-amber-300/80">catches people out</span>
            @endif
        </span>

        <span class="mt-1 block text-[12px]/5 text-zinc-500">{{ $says }}</span>

        @if ($means)
            <span class="mt-1.5 block text-[11px]/5 text-zinc-600">{{ $means }}</span>
        @endif
    </span>

    <span class="flex w-20 shrink-0 flex-col items-end gap-1.5 pt-1">
        <span class="flex w-14 gap-px">
            <span @class([
                'h-1 flex-1 rounded-l-full',
                'bg-amber-400/70' => $favours === 'us',
                'bg-white/15' => $favours === 'both',
                'bg-white/8' => $favours === 'you',
            ])></span>
            <span @class([
                'h-1 flex-1 rounded-r-full',
                'bg-jade-500' => $favours === 'you',
                'bg-white/15' => $favours === 'both',
                'bg-white/8' => $favours === 'us',
            ])></span>
        </span>
        <span @class([
            'font-mono text-[10px]',
            'text-amber-300/80' => $favours === 'us',
            'text-jade-400/90' => $favours === 'you',
            'text-zinc-700' => $favours === 'both',
        ])>{{ $label }}</span>
    </span>
</a>
