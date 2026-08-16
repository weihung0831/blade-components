@props([
    'label' => 'Show code',
    'closeLabel' => 'Hide code',
    'hint' => null,
])

<details {{ $attributes->class('group/disclosure') }}>
    <summary class="flex cursor-pointer list-none items-center gap-2.5 px-3 py-2.5 text-zinc-500 transition-colors duration-150 outline-none hover:text-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden">
        <svg class="size-3.5 shrink-0 transition-transform duration-150 ease-snap group-open/disclosure:rotate-90" viewBox="0 0 16 16" fill="none"><path d="m6 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>

        @isset($summary)
            {{ $summary }}
        @else
            <span class="font-mono text-xs group-open/disclosure:hidden">{{ $label }}</span>
            <span class="hidden font-mono text-xs group-open/disclosure:inline">{{ $closeLabel }}</span>

            @if ($hint)
                <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700 group-open/disclosure:hidden">{{ $hint }}</span>
            @endif
        @endisset
    </summary>

    <div class="border-t border-white/5">{{ $slot }}</div>
</details>
