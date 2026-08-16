<x-layout title="Menubar — BLADE-COMPONENTS">
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
                    The desktop-app bar for a dense console. Each menu is a details element sharing one name, so opening one closes the last — that exclusivity is browser behaviour, not a script.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.menubar class="w-full max-w-lg" :menus="[
                ['label' => 'File', 'items' => [
                    ['label' => 'New environment', 'shortcut' => '⌘N'],
                    ['label' => 'Import config', 'shortcut' => '⌘O'],
                    ['separator' => true],
                    ['label' => 'Export as JSON'],
                ]],
                ['label' => 'Edit', 'items' => [
                    ['label' => 'Undo', 'shortcut' => '⌘Z'],
                    ['label' => 'Redo', 'shortcut' => '⇧⌘Z'],
                ]],
                ['label' => 'View', 'items' => [
                    ['label' => 'Logs', 'href' => '#'],
                    ['label' => 'Metrics', 'href' => '#'],
                ]],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiMenubar
                class="w-full max-w-lg"
                :menus="[
                    { label: 'File', items: [
                        { label: 'New environment', shortcut: '⌘N' },
                        { label: 'Import config', shortcut: '⌘O' },
                        { separator: true },
                        { label: 'Export as JSON' },
                    ] },
                    { label: 'Edit', items: [
                        { label: 'Undo', shortcut: '⌘Z' },
                        { label: 'Redo', shortcut: '⇧⌘Z' },
                    ] },
                    { label: 'View', items: [
                        { label: 'Logs', href: '#' },
                        { label: 'Metrics', href: '#' },
                    ] },
                ]"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiMenubar
                className="w-full max-w-lg"
                menus={[
                    { label: 'File', items: [
                        { label: 'New environment', shortcut: '⌘N' },
                        { label: 'Import config', shortcut: '⌘O' },
                        { separator: true },
                        { label: 'Export as JSON' },
                    ] },
                    { label: 'Edit', items: [
                        { label: 'Undo', shortcut: '⌘Z' },
                        { label: 'Redo', shortcut: '⇧⌘Z' },
                    ] },
                    { label: 'View', items: [
                        { label: 'Logs', href: '#' },
                        { label: 'Metrics', href: '#' },
                    ] },
                ]}
            />
            REACT;

            $brandCode = <<<'BLADE'
            <x-ui.menubar class="w-full max-w-lg" :menus="[
                ['label' => 'Workspace', 'items' => [
                    ['label' => 'Switch workspace', 'shortcut' => '⌘K'],
                    ['label' => 'Members', 'href' => '#'],
                    ['separator' => true],
                    ['label' => 'Leave workspace', 'danger' => true],
                ]],
                ['label' => 'Billing', 'items' => [
                    ['label' => 'Plan and usage', 'href' => '#'],
                    ['label' => 'Invoices', 'href' => '#'],
                ]],
            ]">
                <x-slot:brand>
                    <span class="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>
                </x-slot>
                <x-slot:end>
                    <span class="font-mono text-[11px] text-zinc-600">Scale</span>
                    <span class="grid size-6 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                </x-slot>
            </x-ui.menubar>
            BLADE;

            $brandVueCode = <<<'VUE'
            <UiMenubar class="w-full max-w-lg" :menus="menus">
                <template #brand>
                    <span class="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>
                </template>
                <template #end>
                    <span class="font-mono text-[11px] text-zinc-600">Scale</span>
                    <span class="grid size-6 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                </template>
            </UiMenubar>
            VUE;

            $brandReactCode = <<<'REACT'
            <UiMenubar
                className="w-full max-w-lg"
                menus={menus}
                brand={<span className="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>}
                end={
                    <>
                        <span className="font-mono text-[11px] text-zinc-600">Scale</span>
                        <span className="grid size-6 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                    </>
                }
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic" padding="px-10 pt-10 pb-56"
                description="Menus and their items are plain arrays. A separator key draws a divider; an href turns the item into a link instead of a button."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.menubar class="w-full max-w-lg" :menus="[
                    ['label' => 'File', 'items' => [
                        ['label' => 'New environment', 'shortcut' => '⌘N'],
                        ['label' => 'Import config', 'shortcut' => '⌘O'],
                        ['separator' => true],
                        ['label' => 'Export as JSON'],
                    ]],
                    ['label' => 'Edit', 'items' => [
                        ['label' => 'Undo', 'shortcut' => '⌘Z'],
                        ['label' => 'Redo', 'shortcut' => '⇧⌘Z'],
                    ]],
                    ['label' => 'View', 'items' => [
                        ['label' => 'Logs', 'href' => '#'],
                        ['label' => 'Metrics', 'href' => '#'],
                    ]],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Brand, trailing slot, danger item" padding="px-10 pt-10 pb-56"
                description="The brand slot sits before the menus, end pins content to the right — a plan badge and an avatar, say. Flag an item with danger and it turns red."
                :code="$brandCode" :vue-code="$brandVueCode" :react-code="$brandReactCode">
                <x-ui.menubar class="w-full max-w-lg" :menus="[
                    ['label' => 'Workspace', 'items' => [
                        ['label' => 'Switch workspace', 'shortcut' => '⌘K'],
                        ['label' => 'Members', 'href' => '#'],
                        ['separator' => true],
                        ['label' => 'Leave workspace', 'danger' => true],
                    ]],
                    ['label' => 'Billing', 'items' => [
                        ['label' => 'Plan and usage', 'href' => '#'],
                        ['label' => 'Invoices', 'href' => '#'],
                    ]],
                ]">
                    <x-slot:brand>
                        <span class="grid size-6 place-items-center rounded bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>
                    </x-slot>
                    <x-slot:end>
                        <span class="font-mono text-[11px] text-zinc-600">Scale</span>
                        <span class="grid size-6 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                    </x-slot>
                </x-ui.menubar>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="menubar" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
