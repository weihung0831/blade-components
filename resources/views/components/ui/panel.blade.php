@props(['heading', 'toggleable' => false, 'open' => true])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-white/10 bg-ink-800']) }}>
    @if ($toggleable)
        <details class="peer group/panel" @if ($open) open @endif>
            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-4 py-3 text-sm font-medium text-zinc-200 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden">
                {{ $heading }}
                <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-200 ease-snap group-open/panel:rotate-180 group-open/panel:text-jade-400" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </summary>
        </details>
        <div class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-200 ease-snap peer-open:grid-rows-[1fr]">
            <div class="overflow-hidden">
                <div class="border-t border-white/5 p-4 text-sm/6 text-zinc-500">{{ $slot }}</div>
            </div>
        </div>
    @else
        <div class="flex items-center justify-between gap-4 border-b border-white/5 px-4 py-3">
            <p class="text-sm font-medium text-zinc-200">{{ $heading }}</p>
            @isset($actions)
                <div class="flex items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
        <div class="p-4 text-sm/6 text-zinc-500">{{ $slot }}</div>
        @isset($footer)
            <div class="border-t border-white/5 px-4 py-3">{{ $footer }}</div>
        @endisset
    @endif
</div>
