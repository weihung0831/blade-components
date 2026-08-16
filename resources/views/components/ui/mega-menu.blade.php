@props(['menus' => []])

@php
    $grids = [1 => 'sm:grid-cols-1', 2 => 'sm:grid-cols-2', 3 => 'sm:grid-cols-3', 4 => 'sm:grid-cols-4'];
@endphp

<div {{ $attributes->merge(['class' => 'relative flex items-center gap-1 rounded-xl border border-white/10 bg-ink-800 px-2 py-1.5']) }}>
    @isset($brand)
        <div class="mr-1 flex items-center">{{ $brand }}</div>
    @endisset

    @foreach ($menus as $menu)
        @php
            $columns = $menu['columns'] ?? [];
            $span = min(4, count($columns) + (isset($menu['feature']) ? 1 : 0));
        @endphp
        <details class="group/mega static sm:relative" name="ui-mega-menu">
            <summary class="flex cursor-pointer list-none items-center gap-1.5 rounded-md px-2.5 py-1 text-sm text-zinc-400 transition-colors duration-150 outline-none select-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/mega:bg-white/8 group-open/mega:text-cream group-open/mega:before:fixed group-open/mega:before:inset-0 group-open/mega:before:cursor-default group-open/mega:before:content-['']">
                {{ $menu['label'] }}
                <svg class="size-3 text-zinc-600 transition-transform duration-150 ease-snap group-open/mega:rotate-180" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </summary>

            <div class="absolute top-full left-0 z-10 mt-1.5 w-full rounded-xl border border-white/10 bg-ink-900 p-5 shadow-xl shadow-black/50 sm:w-max sm:max-w-[min(42rem,90vw)]">
                <div class="grid gap-6 {{ $grids[$span] ?? 'sm:grid-cols-3' }}">
                    @foreach ($columns as $column)
                        <div class="sm:w-48">
                            <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">{{ $column['title'] }}</p>
                            <div class="mt-2.5 flex flex-col gap-0.5">
                                @foreach ($column['items'] ?? [] as $entry)
                                    <a href="{{ $entry['href'] ?? '#' }}" class="-mx-2 rounded-md px-2 py-1.5 transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                        <span class="block text-sm text-zinc-200">{{ $entry['label'] }}</span>
                                        @isset($entry['description'])
                                            <span class="mt-0.5 block text-xs/5 text-zinc-500">{{ $entry['description'] }}</span>
                                        @endisset
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @isset($menu['feature'])
                        <div class="flex flex-col justify-between rounded-lg border border-jade-500/25 bg-jade-500/8 p-4 sm:w-48">
                            <div>
                                <p class="text-sm font-medium text-cream">{{ $menu['feature']['title'] }}</p>
                                <p class="mt-1 text-xs/5 text-zinc-400">{{ $menu['feature']['description'] }}</p>
                            </div>
                            <a href="{{ $menu['feature']['href'] ?? '#' }}" class="mt-4 inline-flex items-center gap-1.5 rounded text-xs font-medium text-jade-400 transition-colors duration-150 outline-none hover:text-jade-300 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                {{ $menu['feature']['action'] }}
                                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6h7m-3-3 3 3-3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    @endisset
                </div>
            </div>
        </details>
    @endforeach

    @isset($end)
        <div class="ml-auto flex items-center gap-2 pl-2">{{ $end }}</div>
    @endisset
</div>
