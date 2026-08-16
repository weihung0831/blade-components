@props(['items' => [], 'variant' => 'outline'])

@php
    $variants = [
        'outline' => 'divide-y divide-white/5 rounded-xl border border-white/10 bg-ink-800',
        'flush' => 'divide-y divide-white/5',
    ];
@endphp

<div {{ $attributes->merge(['class' => $variants[$variant] ?? $variants['outline']]) }}>
    @foreach ($items as $item)
        <div>
            <details class="peer group/item" @if ($item['open'] ?? false) open @endif>
                <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-4 py-3 text-sm text-zinc-300 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden">
                    {{ $item['title'] }}
                    <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-200 ease-snap group-open/item:rotate-180 group-open/item:text-jade-400" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </summary>
            </details>
            <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-200 ease-snap peer-open:grid-rows-[1fr]">
                <div class="overflow-hidden">
                    <p class="px-4 pb-3.5 text-sm/6 text-zinc-500">{{ $item['content'] }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
