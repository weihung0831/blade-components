@props([
    'items' => [],
    'separator' => 'chevron',
    'home' => null,
])

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'flex']) }}>
    <ol class="flex flex-wrap items-center gap-2 text-sm">
        @if ($home)
            <li>
                <a href="{{ $home }}" aria-label="Home" class="grid size-5 place-items-center rounded text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M2.5 7 8 2.5 13.5 7v6a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V7Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </a>
            </li>
        @endif

        @foreach ($items as $item)
            <li class="flex items-center gap-2">
                @if ($home || ! $loop->first)
                    <span aria-hidden="true" class="text-zinc-700 select-none">
                        @if ($separator === 'slash')
                            <span class="text-xs">/</span>
                        @else
                            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @endif
                    </span>
                @endif

                @if ($loop->last)
                    <span aria-current="page" class="font-medium text-cream">{{ $item['label'] }}</span>
                @elseif (isset($item['href']))
                    <a href="{{ $item['href'] }}" class="rounded text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">{{ $item['label'] }}</a>
                @else
                    <span class="text-zinc-600">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
