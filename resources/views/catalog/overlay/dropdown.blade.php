<x-layout title="Dropdown — BLADE-COMPONENTS">
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
                    A button that opens an anchored action menu. Plain HTML details under the hood, so it needs no JavaScript and closes on an outside click. Drop bare links, buttons, and hr dividers into the menu slot — the component styles them.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.dropdown>
                Actions
                <x-slot:menu>
                    <button type="button">Rename</button>
                    <button type="button">Duplicate</button>
                    <button type="button">Move to folder</button>
                </x-slot>
            </x-ui.dropdown>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiDropdown>
                Actions
                <template #menu>
                    <button type="button">Rename</button>
                    <button type="button">Duplicate</button>
                    <button type="button">Move to folder</button>
                </template>
            </UiDropdown>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiDropdown
                menu={
                    <>
                        <button type="button">Rename</button>
                        <button type="button">Duplicate</button>
                        <button type="button">Move to folder</button>
                    </>
                }
            >
                Actions
            </UiDropdown>
            REACT;

            $groupedCode = <<<'BLADE'
            <x-ui.dropdown variant="ghost" align="right">
                Project
                <x-slot:menu>
                    <a href="#">
                        <svg class="size-3.5 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M8 3v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        New environment
                    </a>
                    <a href="#">
                        <svg class="size-3.5 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M13 6.5v5A1.5 1.5 0 0 1 11.5 13h-7A1.5 1.5 0 0 1 3 11.5v-7A1.5 1.5 0 0 1 4.5 3h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M9.5 6.5 13 3m0 0h-3m3 0v3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Open dashboard
                    </a>
                    <hr>
                    <button type="button" class="!text-red-400">
                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 4.5h9m-7 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25v.75m1.5 0v7.75c0 .69-.56 1.25-1.25 1.25h-5.5c-.69 0-1.25-.56-1.25-1.25V4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        Delete project
                    </button>
                </x-slot>
            </x-ui.dropdown>
            BLADE;

            $groupedVueCode = <<<'VUE'
            <UiDropdown variant="ghost" align="right">
                Project
                <template #menu>
                    <a href="#">New environment</a>
                    <a href="#">Open dashboard</a>
                    <hr />
                    <button type="button" class="!text-red-400">Delete project</button>
                </template>
            </UiDropdown>
            VUE;

            $groupedReactCode = <<<'REACT'
            <UiDropdown
                variant="ghost"
                align="right"
                menu={
                    <>
                        <a href="#">New environment</a>
                        <a href="#">Open dashboard</a>
                        <hr />
                        <button type="button" className="!text-red-400">Delete project</button>
                    </>
                }
            >
                Project
            </UiDropdown>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic" padding="px-10 pt-10 pb-40"
                description="The default slot is the trigger label. Bare buttons and links in the menu slot pick up their styling automatically."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.dropdown>
                    Actions
                    <x-slot:menu>
                        <button type="button">Rename</button>
                        <button type="button">Duplicate</button>
                        <button type="button">Move to folder</button>
                    </x-slot>
                </x-ui.dropdown>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Icons, dividers, and a danger item" padding="px-10 pt-10 pb-48"
                description="Items are flex containers, so an inline icon just works. An hr draws a divider; !text-red-400 flags the destructive one. align=right anchors the menu to the trigger's right edge."
                :code="$groupedCode" :vue-code="$groupedVueCode" :react-code="$groupedReactCode">
                <x-ui.dropdown variant="ghost" align="right">
                    Project
                    <x-slot:menu>
                        <a href="#">
                            <svg class="size-3.5 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M8 3v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            New environment
                        </a>
                        <a href="#">
                            <svg class="size-3.5 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M13 6.5v5A1.5 1.5 0 0 1 11.5 13h-7A1.5 1.5 0 0 1 3 11.5v-7A1.5 1.5 0 0 1 4.5 3h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M9.5 6.5 13 3m0 0h-3m3 0v3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Open dashboard
                        </a>
                        <hr>
                        <button type="button" class="!text-red-400">
                            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 4.5h9m-7 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25v.75m1.5 0v7.75c0 .69-.56 1.25-1.25 1.25h-5.5c-.69 0-1.25-.56-1.25-1.25V4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            Delete project
                        </button>
                    </x-slot>
                </x-ui.dropdown>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="dropdown" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
