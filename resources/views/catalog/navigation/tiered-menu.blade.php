<x-layout title="Tiered menu — BLADE-COMPONENTS">
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
                    Nest an items key inside an item and it becomes a submenu that flies out on hover. The component renders itself for each level, so the depth is whatever your array says it is.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.tiered-menu :items="[
                ['label' => 'New file', 'shortcut' => '⌘N'],
                ['label' => 'Export', 'items' => [
                    ['label' => 'PDF'],
                    ['label' => 'PNG'],
                    ['label' => 'CSV'],
                ]],
                ['label' => 'Settings', 'href' => '#'],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiTieredMenu
                :items="[
                    { label: 'New file', shortcut: '⌘N' },
                    { label: 'Export', items: [
                        { label: 'PDF' },
                        { label: 'PNG' },
                        { label: 'CSV' },
                    ] },
                    { label: 'Settings', href: '#' },
                ]"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiTieredMenu
                items={[
                    { label: 'New file', shortcut: '⌘N' },
                    { label: 'Export', items: [
                        { label: 'PDF' },
                        { label: 'PNG' },
                        { label: 'CSV' },
                    ] },
                    { label: 'Settings', href: '#' },
                ]}
            />
            REACT;

            $deepCode = <<<'BLADE'
            <x-ui.tiered-menu :items="[
                ['label' => 'Deploy', 'items' => [
                    ['label' => 'Production', 'items' => [
                        ['label' => 'Rebuild and deploy'],
                        ['label' => 'Deploy from cache'],
                        ['separator' => true],
                        ['label' => 'Roll back', 'danger' => true],
                    ]],
                    ['label' => 'Staging'],
                ]],
                ['label' => 'Logs', 'shortcut' => '⌘L'],
                ['separator' => true],
                ['label' => 'Delete environment', 'danger' => true],
            ]" />
            BLADE;

            $deepVueCode = <<<'VUE'
            <UiTieredMenu
                :items="[
                    { label: 'Deploy', items: [
                        { label: 'Production', items: [
                            { label: 'Rebuild and deploy' },
                            { label: 'Deploy from cache' },
                            { separator: true },
                            { label: 'Roll back', danger: true },
                        ] },
                        { label: 'Staging' },
                    ] },
                    { label: 'Logs', shortcut: '⌘L' },
                    { separator: true },
                    { label: 'Delete environment', danger: true },
                ]"
            />
            VUE;

            $deepReactCode = <<<'REACT'
            <UiTieredMenu
                items={[
                    { label: 'Deploy', items: [
                        { label: 'Production', items: [
                            { label: 'Rebuild and deploy' },
                            { label: 'Deploy from cache' },
                            { separator: true },
                            { label: 'Roll back', danger: true },
                        ] },
                        { label: 'Staging' },
                    ] },
                    { label: 'Logs', shortcut: '⌘L' },
                    { separator: true },
                    { label: 'Delete environment', danger: true },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="One level down" padding="px-10 pt-10 pb-24"
                description="Hover Export. Items with children show a chevron instead of a shortcut, and the submenu opens beside the row rather than under it."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.tiered-menu :items="[
                    ['label' => 'New file', 'shortcut' => '⌘N'],
                    ['label' => 'Export', 'items' => [
                        ['label' => 'PDF'],
                        ['label' => 'PNG'],
                        ['label' => 'CSV'],
                    ]],
                    ['label' => 'Settings', 'href' => '#'],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Three levels, separators, danger" padding="px-10 pt-10 pb-32"
                description="Deploy opens Production, which opens the rollback list. Keyboard users get the same path — focus inside a branch keeps it open."
                :code="$deepCode" :vue-code="$deepVueCode" :react-code="$deepReactCode">
                <div class="mr-auto">
                    <x-ui.tiered-menu :items="[
                        ['label' => 'Deploy', 'items' => [
                            ['label' => 'Production', 'items' => [
                                ['label' => 'Rebuild and deploy'],
                                ['label' => 'Deploy from cache'],
                                ['separator' => true],
                                ['label' => 'Roll back', 'danger' => true],
                            ]],
                            ['label' => 'Staging'],
                        ]],
                        ['label' => 'Logs', 'shortcut' => '⌘L'],
                        ['separator' => true],
                        ['label' => 'Delete environment', 'danger' => true],
                    ]" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="tiered-menu" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
