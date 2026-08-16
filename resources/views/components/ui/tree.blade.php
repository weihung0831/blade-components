@props([
    'nodes' => [],
    'depth' => 0,
])

<div {{ $attributes->class(['flex flex-col text-[13px]' => $depth === 0]) }}>
    @foreach ($nodes as $node)
        @if (! empty($node['children']))
            <details @if (! empty($node['open'])) open @endif class="[&[open]>summary>svg]:rotate-90">
                <summary class="flex cursor-pointer list-none items-center gap-1.5 rounded-md px-2 py-1 text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream [&::-webkit-details-marker]:hidden">
                    <svg class="size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    {{ $node['label'] }}
                </summary>
                <div class="ml-3.5 border-l border-white/10 pl-1.5">
                    <x-ui.tree :nodes="$node['children']" :depth="$depth + 1" />
                </div>
            </details>
        @else
            <div @class([
                'flex items-center gap-1.5 rounded-md px-2 py-1 pl-6.5 transition-colors duration-150',
                'text-jade-300' => ! empty($node['active']),
                'text-zinc-400 hover:bg-white/5 hover:text-cream' => empty($node['active']),
            ])>
                {{ $node['label'] }}
            </div>
        @endif
    @endforeach
</div>
