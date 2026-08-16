<x-layout title="Mega menu — BLADE-COMPONENTS">
    <div class="mx-auto max-w-4xl px-6 py-16 pb-28">

        <a href="{{ route('components') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Components
        </a>

        <div class="rise mt-5 flex items-end justify-between" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">{{ $category }}</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $item['name'] }}</h1>
                <p class="mt-2 max-w-lg text-sm/6 text-zinc-500">
                    A marketing nav that opens into columns instead of a single list. Each menu holds titled groups of links, and an optional feature card for the plan you actually want people to click.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.mega-menu class="w-full max-w-lg" :menus="[
                ['label' => 'Product', 'columns' => [
                    ['title' => 'Build', 'items' => [
                        ['label' => 'Components', 'description' => '68 pieces, copy and paste', 'href' => '#'],
                        ['label' => 'Templates', 'description' => 'Whole pages, wired up', 'href' => '#'],
                    ]],
                    ['title' => 'Ship', 'items' => [
                        ['label' => 'Environments', 'description' => 'Preview every branch', 'href' => '#'],
                        ['label' => 'Rollbacks', 'description' => 'One click, no downtime', 'href' => '#'],
                    ]],
                ]],
                ['label' => 'Pricing', 'columns' => [
                    ['title' => 'Plans', 'items' => [
                        ['label' => 'Starter', 'href' => '#'],
                        ['label' => 'Scale', 'href' => '#'],
                        ['label' => 'Enterprise', 'href' => '#'],
                    ]],
                ]],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiMegaMenu class="w-full max-w-lg" :menus="menus" />

            const menus = [
                { label: 'Product', columns: [
                    { title: 'Build', items: [
                        { label: 'Components', description: '68 pieces, copy and paste', href: '#' },
                        { label: 'Templates', description: 'Whole pages, wired up', href: '#' },
                    ] },
                    { title: 'Ship', items: [
                        { label: 'Environments', description: 'Preview every branch', href: '#' },
                        { label: 'Rollbacks', description: 'One click, no downtime', href: '#' },
                    ] },
                ] },
                { label: 'Pricing', columns: [
                    { title: 'Plans', items: [
                        { label: 'Starter', href: '#' },
                        { label: 'Scale', href: '#' },
                        { label: 'Enterprise', href: '#' },
                    ] },
                ] },
            ];
            VUE;

            $basicReactCode = <<<'REACT'
            <UiMegaMenu className="w-full max-w-lg" menus={menus} />

            const menus = [
                { label: 'Product', columns: [
                    { title: 'Build', items: [
                        { label: 'Components', description: '68 pieces, copy and paste', href: '#' },
                        { label: 'Templates', description: 'Whole pages, wired up', href: '#' },
                    ] },
                    { title: 'Ship', items: [
                        { label: 'Environments', description: 'Preview every branch', href: '#' },
                        { label: 'Rollbacks', description: 'One click, no downtime', href: '#' },
                    ] },
                ] },
                { label: 'Pricing', columns: [
                    { title: 'Plans', items: [
                        { label: 'Starter', href: '#' },
                        { label: 'Scale', href: '#' },
                        { label: 'Enterprise', href: '#' },
                    ] },
                ] },
            ];
            REACT;

            $featureCode = <<<'BLADE'
            <x-ui.mega-menu class="w-full max-w-lg" :menus="[
                ['label' => 'Developers', 'columns' => [
                    ['title' => 'Reference', 'items' => [
                        ['label' => 'API docs', 'href' => '#'],
                        ['label' => 'CLI', 'href' => '#'],
                        ['label' => 'Webhooks', 'href' => '#'],
                    ]],
                ], 'feature' => [
                    'title' => 'Changelog',
                    'description' => 'Edge functions shipped last week — cold starts down to 12ms.',
                    'action' => 'Read the notes',
                    'href' => '#',
                ]],
            ]">
                <x-slot:brand>
                    <span class="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>
                </x-slot>
                <x-slot:end>
                    <a href="#" class="rounded-md bg-jade-500 px-3 py-1 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Start free</a>
                </x-slot>
            </x-ui.mega-menu>
            BLADE;

            $featureVueCode = <<<'VUE'
            <UiMegaMenu class="w-full max-w-lg" :menus="menus">
                <template #brand>
                    <span class="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>
                </template>
                <template #end>
                    <a href="#" class="rounded-md bg-jade-500 px-3 py-1 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Start free</a>
                </template>
            </UiMegaMenu>
            VUE;

            $featureReactCode = <<<'REACT'
            <UiMegaMenu
                className="w-full max-w-lg"
                menus={menus}
                brand={<span className="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>}
                end={<a href="#" className="rounded-md bg-jade-500 px-3 py-1 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Start free</a>}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Columns" padding="px-10 pt-10 pb-72"
                description="Columns come from the menu's columns array; the panel's grid tracks their count. A description under a link is optional — leave it out for a plain list."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.mega-menu class="w-full max-w-lg" :menus="[
                    ['label' => 'Product', 'columns' => [
                        ['title' => 'Build', 'items' => [
                            ['label' => 'Components', 'description' => '68 pieces, copy and paste', 'href' => '#'],
                            ['label' => 'Templates', 'description' => 'Whole pages, wired up', 'href' => '#'],
                        ]],
                        ['title' => 'Ship', 'items' => [
                            ['label' => 'Environments', 'description' => 'Preview every branch', 'href' => '#'],
                            ['label' => 'Rollbacks', 'description' => 'One click, no downtime', 'href' => '#'],
                        ]],
                    ]],
                    ['label' => 'Pricing', 'columns' => [
                        ['title' => 'Plans', 'items' => [
                            ['label' => 'Starter', 'href' => '#'],
                            ['label' => 'Scale', 'href' => '#'],
                            ['label' => 'Enterprise', 'href' => '#'],
                        ]],
                    ]],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Feature card and a call to action" padding="px-10 pt-10 pb-72"
                description="A feature key adds the jade panel on the right — changelog, a webinar, whatever needs the pull. brand and end round the bar out into a full marketing header."
                :code="$featureCode" :vue-code="$featureVueCode" :react-code="$featureReactCode">
                <x-ui.mega-menu class="w-full max-w-lg" :menus="[
                    ['label' => 'Developers', 'columns' => [
                        ['title' => 'Reference', 'items' => [
                            ['label' => 'API docs', 'href' => '#'],
                            ['label' => 'CLI', 'href' => '#'],
                            ['label' => 'Webhooks', 'href' => '#'],
                        ]],
                    ], 'feature' => [
                        'title' => 'Changelog',
                        'description' => 'Edge functions shipped last week — cold starts down to 12ms.',
                        'action' => 'Read the notes',
                        'href' => '#',
                    ]],
                ]">
                    <x-slot:brand>
                        <span class="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>
                    </x-slot>
                    <x-slot:end>
                        <a href="#" class="rounded-md bg-jade-500 px-3 py-1 text-xs font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Start free</a>
                    </x-slot>
                </x-ui.mega-menu>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="mega-menu" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
