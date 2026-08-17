@props([
    'term',
    'hits',
    'peak' => 100,
    'results' => 0,
    'read' => null,
    'state' => 'answered',
])

@php
    $states = [
        'answered' => ['bar' => 'bg-jade-500/50', 'tone' => 'text-zinc-600', 'dot' => 'bg-white/10'],
        'thin' => ['bar' => 'bg-amber-400/50', 'tone' => 'text-amber-300', 'dot' => 'bg-amber-400'],
        'missing' => ['bar' => 'bg-red-400/50', 'tone' => 'text-red-300', 'dot' => 'bg-red-400'],
    ];

    $style = $states[$state] ?? $states['answered'];

    $width = max(4, round($hits / max($peak, 1) * 100));
@endphp

<div {{ $attributes->class('flex items-center gap-3 border-b border-white/5 py-2.5 pr-3 pl-4') }}>
    <span aria-hidden="true" class="size-1.5 shrink-0 rounded-full {{ $style['dot'] }}"></span>

    <span class="w-52 shrink-0 truncate font-mono text-[12px] text-zinc-300">{{ $term }}</span>

    <span class="hidden h-1 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6 sm:block">
        <span class="block h-full rounded-full {{ $style['bar'] }}" style="width: {{ $width }}%"></span>
    </span>

    <span class="ml-auto flex shrink-0 items-baseline gap-4 whitespace-nowrap">
        <span class="hidden w-10 text-right font-mono text-[10px] text-zinc-700 md:block">{{ $read !== null ? $read.'%' : '—' }}</span>
        <span class="w-16 text-right font-mono text-[10px] {{ $style['tone'] }}">{{ $results }} {{ Illuminate\Support\Str::plural('answer', $results) }}</span>
        <span class="w-10 text-right font-mono text-[12px] text-zinc-400">{{ $hits }}</span>
    </span>
</div>
