@props(['items' => []])

@php
    $itemClasses = 'flex w-full items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';
@endphp

<ul role="menu" {{ $attributes->merge(['class' => 'min-w-52 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40']) }}>
    @foreach ($items as $entry)
        @if ($entry['separator'] ?? false)
            <li><hr class="my-1 border-white/5"></li>
        @else
            @php
                $children = $entry['items'] ?? [];
                $tone = ($entry['danger'] ?? false)
                    ? 'text-red-400 hover:bg-red-500/10 [&:has(+ul:hover)]:bg-red-500/10'
                    : 'text-zinc-300 hover:bg-white/5 hover:text-cream [&:has(+ul:hover)]:bg-white/5 [&:has(+ul:hover)]:text-cream';
            @endphp
            <li class="group/tier relative" role="none">
                @if (isset($entry['href']) && $children === [])
                    <a href="{{ $entry['href'] }}" role="menuitem" class="{{ $itemClasses }} {{ $tone }}">
                        <span>{{ $entry['label'] }}</span>
                        @isset($entry['shortcut'])
                            <span class="font-mono text-[11px] text-zinc-600">{{ $entry['shortcut'] }}</span>
                        @endisset
                    </a>
                @else
                    <button type="button" role="menuitem" @if ($children !== []) aria-haspopup="true" @endif class="{{ $itemClasses }} {{ $tone }}">
                        <span>{{ $entry['label'] }}</span>
                        @if ($children !== [])
                            <svg class="size-3 text-zinc-500" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @elseif (isset($entry['shortcut']))
                            <span class="font-mono text-[11px] text-zinc-600">{{ $entry['shortcut'] }}</span>
                        @endif
                    </button>
                @endif

                @if ($children !== [])
                    <x-ui.tiered-menu :items="$children"
                        class="invisible absolute top-0 left-full z-10 ml-1 -translate-x-1 opacity-0 transition-[opacity,translate,visibility] duration-150 ease-snap group-hover/tier:visible group-hover/tier:translate-x-0 group-hover/tier:opacity-100 group-focus-within/tier:visible group-focus-within/tier:translate-x-0 group-focus-within/tier:opacity-100" />
                @endif
            </li>
        @endif
    @endforeach
</ul>
