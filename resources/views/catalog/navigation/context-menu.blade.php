<x-layout title="Context menu — BLADE-COMPONENTS">
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
                    Right-click anything wrapped in it and the menu opens at the pointer, flipping back inside the viewport near an edge. Click elsewhere, scroll, or hit Escape and it's gone.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.context-menu :items="[
                ['label' => 'Open in new tab', 'shortcut' => '⌘↵'],
                ['label' => 'Copy link', 'shortcut' => '⌘C'],
                ['label' => 'Rename'],
                ['separator' => true],
                ['label' => 'Move to trash', 'danger' => true],
            ]">
                <div class="grid h-32 w-72 place-items-center rounded-xl border border-dashed border-white/15 bg-ink-950 text-sm text-zinc-500">
                    Right-click inside this card
                </div>
            </x-ui.context-menu>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiContextMenu
                :items="[
                    { label: 'Open in new tab', shortcut: '⌘↵' },
                    { label: 'Copy link', shortcut: '⌘C' },
                    { label: 'Rename' },
                    { separator: true },
                    { label: 'Move to trash', danger: true },
                ]"
            >
                <div class="grid h-32 w-72 place-items-center rounded-xl border border-dashed border-white/15 bg-ink-950 text-sm text-zinc-500">
                    Right-click inside this card
                </div>
            </UiContextMenu>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiContextMenu
                items={[
                    { label: 'Open in new tab', shortcut: '⌘↵' },
                    { label: 'Copy link', shortcut: '⌘C' },
                    { label: 'Rename' },
                    { separator: true },
                    { label: 'Move to trash', danger: true },
                ]}
            >
                <div className="grid h-32 w-72 place-items-center rounded-xl border border-dashed border-white/15 bg-ink-950 text-sm text-zinc-500">
                    Right-click inside this card
                </div>
            </UiContextMenu>
            REACT;

            $rowsCode = <<<'BLADE'
            <x-ui.context-menu class="w-80" :items="[
                ['label' => 'View logs'],
                ['label' => 'Promote to production'],
                ['separator' => true],
                ['label' => 'Roll back', 'danger' => true],
            ]">
                <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/10 bg-ink-950 text-xs">
                    <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-4f2a1c</span><span class="text-jade-400">live</span></p>
                    <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-9b03e7</span><span class="text-zinc-600">queued</span></p>
                    <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-1d77aa</span><span class="text-red-400">failed</span></p>
                </div>
            </x-ui.context-menu>
            BLADE;

            $rowsVueCode = <<<'VUE'
            <UiContextMenu
                class="w-80"
                :items="[
                    { label: 'View logs' },
                    { label: 'Promote to production' },
                    { separator: true },
                    { label: 'Roll back', danger: true },
                ]"
            >
                <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/10 bg-ink-950 text-xs">
                    <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-4f2a1c</span><span class="text-jade-400">live</span></p>
                    <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-9b03e7</span><span class="text-zinc-600">queued</span></p>
                    <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-1d77aa</span><span class="text-red-400">failed</span></p>
                </div>
            </UiContextMenu>
            VUE;

            $rowsReactCode = <<<'REACT'
            <UiContextMenu
                className="w-80"
                items={[
                    { label: 'View logs' },
                    { label: 'Promote to production' },
                    { separator: true },
                    { label: 'Roll back', danger: true },
                ]}
            >
                <div className="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/10 bg-ink-950 text-xs">
                    <p className="flex items-center justify-between px-4 py-2.5"><span className="font-mono text-zinc-300">deploy-4f2a1c</span><span className="text-jade-400">live</span></p>
                    <p className="flex items-center justify-between px-4 py-2.5"><span className="font-mono text-zinc-300">deploy-9b03e7</span><span className="text-zinc-600">queued</span></p>
                    <p className="flex items-center justify-between px-4 py-2.5"><span className="font-mono text-zinc-300">deploy-1d77aa</span><span className="text-red-400">failed</span></p>
                </div>
            </UiContextMenu>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Whatever you put in the slot becomes the target. Items follow the same shape as the other menus — shortcut, separator, danger."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.context-menu :items="[
                    ['label' => 'Open in new tab', 'shortcut' => '⌘↵'],
                    ['label' => 'Copy link', 'shortcut' => '⌘C'],
                    ['label' => 'Rename'],
                    ['separator' => true],
                    ['label' => 'Move to trash', 'danger' => true],
                ]">
                    <div class="grid h-32 w-72 place-items-center rounded-xl border border-dashed border-white/15 bg-ink-950 text-sm text-zinc-500">
                        Right-click inside this card
                    </div>
                </x-ui.context-menu>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Over a list"
                description="Wrapping a table or list gives every row the same actions. Wrap each row instead when the menu should differ per record."
                :code="$rowsCode" :vue-code="$rowsVueCode" :react-code="$rowsReactCode">
                <x-ui.context-menu class="w-80" :items="[
                    ['label' => 'View logs'],
                    ['label' => 'Promote to production'],
                    ['separator' => true],
                    ['label' => 'Roll back', 'danger' => true],
                ]">
                    <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/10 bg-ink-950 text-xs">
                        <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-4f2a1c</span><span class="text-jade-400">live</span></p>
                        <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-9b03e7</span><span class="text-zinc-600">queued</span></p>
                        <p class="flex items-center justify-between px-4 py-2.5"><span class="font-mono text-zinc-300">deploy-1d77aa</span><span class="text-red-400">failed</span></p>
                    </div>
                </x-ui.context-menu>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="context-menu" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
