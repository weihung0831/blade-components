@props([
    'active' => 'Overview',
])

@php
    $tabs = [
        ['label' => 'Overview', 'screen' => 'overview'],
        ['label' => 'Specs', 'screen' => 'specs'],
        ['label' => 'Reviews', 'screen' => 'reviews'],
        ['label' => 'Configure', 'screen' => 'configure'],
    ];

    $nav = ['Grinders', 'Brewers', 'Filters', 'Journal'];

    $footer = [
        ['label' => 'Shop', 'items' => ['Grinders', 'Brewers', 'Filters', 'Spare parts']],
        ['label' => 'Support', 'items' => ['Shipping', 'Returns', 'Warranty claim', 'Service log']],
        ['label' => 'Company', 'items' => ['Workshop', 'Stockists', 'Journal', 'Contact']],
    ];
@endphp

<div {{ $attributes->class('group/shell flex h-full w-full flex-col overflow-hidden bg-ink-950') }} data-finish="graphite">
    <div class="relative flex min-h-0 flex-1">
        <div data-ui-scroll-region class="flex min-w-0 flex-1 flex-col overflow-y-auto">
            <div class="flex h-8 shrink-0 items-center justify-center gap-2 bg-jade-500/10 px-5 text-center font-mono text-[10px] text-jade-300">
                <span>Free express shipping over $600</span>
                <span class="text-jade-500/40">·</span>
                <span class="hidden sm:inline">ships from the Taichung workshop within one business day</span>
            </div>

            <header class="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-4 border-b border-white/5 bg-ink-950/85 px-5 backdrop-blur sm:px-8">
                <a href="{{ route('templates.screen', ['product', 'overview']) }}" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M7 4h10l-1.5 5.5a4.5 4.5 0 0 1-7 0L7 4Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="M12 13v7M8.5 20h7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <span class="text-sm font-medium tracking-tight text-cream">NOMAD Supply</span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <span class="rounded-md bg-jade-500/12 px-2.5 py-1 text-[13px] text-jade-300">Grinders</span>
                    @foreach (array_slice($nav, 1) as $item)
                        <a href="#" class="rounded-md px-2.5 py-1 text-[13px] text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">{{ $item }}</a>
                    @endforeach
                </nav>

                <div class="ml-auto flex shrink-0 items-center gap-2">
                    <button type="button" aria-label="Search"
                        class="grid size-9 place-items-center rounded-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        <svg class="size-4" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    </button>

                    <a href="#" aria-label="Cart, 2 items"
                        class="relative grid size-9 place-items-center rounded-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M2.5 3h1.8l1.3 7.5h6.6l1.3-5.5H5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="6.5" cy="13" r="1" fill="currentColor"/><circle cx="11.5" cy="13" r="1" fill="currentColor"/></svg>
                        <span class="absolute top-1 right-1 grid size-4 place-items-center rounded-full bg-jade-500 font-mono text-[9px] font-bold text-ink-950">2</span>
                    </a>

                    <x-ui.dropdown variant="ghost" align="right" class="md:hidden [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
                        Menu

                        <x-slot:menu>
                            <a href="{{ route('templates.screen', ['product', 'overview']) }}" target="_top" class="text-jade-300!">Grinders</a>

                            @foreach (array_slice($nav, 1) as $item)
                                <a href="#">{{ $item }}</a>
                            @endforeach

                            <hr>

                            <a href="#">Cart · 2 items</a>
                        </x-slot>
                    </x-ui.dropdown>
                </div>
            </header>

            <div class="sticky top-14 z-20 border-b border-white/5 bg-ink-950/85 backdrop-blur">
                <div class="mx-auto flex w-full max-w-6xl flex-wrap items-center gap-x-5 gap-y-2 px-5 py-2.5 sm:px-8">
                    <nav class="flex flex-wrap items-center gap-1 text-sm">
                        @foreach ($tabs as $tab)
                            <a href="{{ route('templates.screen', ['product', $tab['screen']]) }}" target="_top"
                                @if ($tab['label'] === $active) aria-current="page" @endif
                                @class([
                                    'rounded-lg px-3 py-1.5 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                    'bg-white/8 text-cream' => $tab['label'] === $active,
                                    'text-zinc-500 hover:bg-white/5 hover:text-cream' => $tab['label'] !== $active,
                                ])>{{ $tab['label'] }}</a>
                        @endforeach
                    </nav>

                    <div class="ml-auto flex items-center gap-4">
                        <x-templates.product.finish-picker class="hidden sm:flex" />

                        <span class="hidden font-mono text-[13px] text-cream lg:block">
                            <span class="group-data-[finish=jade]/shell:hidden">$1,180</span>
                            <span class="hidden group-data-[finish=jade]/shell:inline">$1,300</span>
                        </span>

                        <x-ui.button size="sm" :href="route('templates.screen', ['product', 'configure'])" target="_top">Add to cart</x-ui.button>
                    </div>
                </div>
            </div>

            <main class="mx-auto w-full max-w-6xl grow px-5 py-8 sm:px-8">{{ $slot }}</main>

            <footer class="border-t border-white/5 bg-ink-900/50">
                <div class="mx-auto w-full max-w-6xl px-5 py-10 sm:px-8">
                    <div class="flex flex-wrap justify-between gap-x-10 gap-y-8">
                        <div class="max-w-xs">
                            <div class="flex items-center gap-2">
                                <svg class="size-5 text-jade-400" viewBox="0 0 24 24" fill="none">
                                    <path d="M7 4h10l-1.5 5.5a4.5 4.5 0 0 1-7 0L7 4Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                                    <path d="M12 13v7M8.5 20h7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                                </svg>
                                <span class="text-[13px] font-medium text-cream">NOMAD Supply</span>
                            </div>
                            <p class="mt-3 text-[13px]/6 text-zinc-600">Grinders and brewers built in Taichung since 2016. Every unit is dialled in by hand before it ships.</p>
                        </div>

                        @foreach ($footer as $column)
                            <div>
                                <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $column['label'] }}</p>
                                <ul class="mt-3 flex flex-col gap-2">
                                    @foreach ($column['items'] as $item)
                                        <li><a href="#" class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">{{ $item }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 flex flex-wrap items-center gap-x-4 gap-y-2 border-t border-white/5 pt-5 font-mono text-[10px] text-zinc-600">
                        <span>© 2026 NOMAD Supply Co.</span>
                        <span class="inline-flex items-center gap-1.5">
                            <span class="size-1.5 rounded-full bg-jade-400"></span>
                            30-day returns, shipping paid both ways
                        </span>
                        <a href="{{ route('templates.screen', ['pricing', 'plans']) }}" target="_top"
                            class="ml-auto transition-colors duration-150 hover:text-jade-400">storefront running on wharf · ap-1</a>
                    </div>
                </div>
            </footer>
        </div>

        <x-ui.scroll-top anchor="container" variant="progress" :threshold="300" />
    </div>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-finish-set]');

            if (button) {
                button.closest('[data-finish]').dataset.finish = button.dataset.finishSet;
            }
        });
    </script>
@endonce
