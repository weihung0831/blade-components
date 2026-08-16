@props(['menus' => []])

@php
    $itemClasses = 'flex w-full items-center justify-between gap-8 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';
@endphp

<div role="menubar" {{ $attributes->merge(['class' => 'flex items-center gap-1 rounded-xl border border-white/10 bg-ink-800 px-2 py-1.5']) }}>
    @isset($brand)
        <div class="mr-1 flex items-center">{{ $brand }}</div>
    @endisset

    @foreach ($menus as $menu)
        <details class="group/menu relative" name="ui-menubar">
            <summary class="cursor-pointer list-none rounded-md px-2.5 py-1 text-sm text-zinc-400 transition-colors duration-150 outline-none select-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/menu:bg-white/8 group-open/menu:text-cream group-open/menu:before:fixed group-open/menu:before:inset-0 group-open/menu:before:cursor-default group-open/menu:before:content-['']">
                {{ $menu['label'] }}
            </summary>
            <div role="menu" class="absolute top-full left-0 z-10 mt-1.5 min-w-52 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
                @foreach ($menu['items'] ?? [] as $entry)
                    @if ($entry['separator'] ?? false)
                        <hr class="my-1 border-white/5">
                    @else
                        @php
                            $tone = ($entry['danger'] ?? false)
                                ? 'text-red-400 hover:bg-red-500/10'
                                : 'text-zinc-300 hover:bg-white/5 hover:text-cream';
                        @endphp
                        @if (isset($entry['href']))
                            <a href="{{ $entry['href'] }}" role="menuitem" class="{{ $itemClasses }} {{ $tone }}">
                                <span>{{ $entry['label'] }}</span>
                                @isset($entry['shortcut'])
                                    <span class="font-mono text-[11px] text-zinc-600">{{ $entry['shortcut'] }}</span>
                                @endisset
                            </a>
                        @else
                            <button type="button" role="menuitem" class="{{ $itemClasses }} {{ $tone }}">
                                <span>{{ $entry['label'] }}</span>
                                @isset($entry['shortcut'])
                                    <span class="font-mono text-[11px] text-zinc-600">{{ $entry['shortcut'] }}</span>
                                @endisset
                            </button>
                        @endif
                    @endif
                @endforeach
            </div>
        </details>
    @endforeach

    @isset($end)
        <div class="ml-auto flex items-center gap-2 pl-2">{{ $end }}</div>
    @endisset
</div>
