<x-layout title="Kbd — BLADE-COMPONENTS">
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
                    A keycap that looks pressable — a real kbd element with a heavier bottom border. Compose several for shortcuts.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.kbd>⌘</x-ui.kbd>
            <x-ui.kbd>K</x-ui.kbd>
            <x-ui.kbd>Esc</x-ui.kbd>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiKbd>⌘</UiKbd>
            <UiKbd>K</UiKbd>
            <UiKbd>Esc</UiKbd>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiKbd>⌘</UiKbd>
            <UiKbd>K</UiKbd>
            <UiKbd>Esc</UiKbd>
            REACT;

            $comboCode = <<<'BLADE'
            <div class="flex items-center gap-2 text-xs text-zinc-500">
                Search
                <span class="flex gap-1">
                    <x-ui.kbd>⌘</x-ui.kbd>
                    <x-ui.kbd>K</x-ui.kbd>
                </span>
            </div>
            BLADE;

            $comboVueCode = <<<'VUE'
            <div class="flex items-center gap-2 text-xs text-zinc-500">
                Search
                <span class="flex gap-1">
                    <UiKbd>⌘</UiKbd>
                    <UiKbd>K</UiKbd>
                </span>
            </div>
            VUE;

            $comboReactCode = <<<'REACT'
            <div className="flex items-center gap-2 text-xs text-zinc-500">
                Search
                <span className="flex gap-1">
                    <UiKbd>⌘</UiKbd>
                    <UiKbd>K</UiKbd>
                </span>
            </div>
            REACT;

            $listCode = <<<'BLADE'
            <div class="flex w-full max-w-xs flex-col gap-2.5 text-xs text-zinc-400">
                <div class="flex items-center justify-between">
                    Command palette
                    <span class="flex gap-1"><x-ui.kbd size="sm">⌘</x-ui.kbd><x-ui.kbd size="sm">K</x-ui.kbd></span>
                </div>
                <div class="flex items-center justify-between">
                    New deploy
                    <span class="flex gap-1"><x-ui.kbd size="sm">⇧</x-ui.kbd><x-ui.kbd size="sm">D</x-ui.kbd></span>
                </div>
                <div class="flex items-center justify-between">
                    Toggle logs
                    <x-ui.kbd size="sm">L</x-ui.kbd>
                </div>
            </div>
            BLADE;

            $listVueCode = <<<'VUE'
            <div class="flex w-full max-w-xs flex-col gap-2.5 text-xs text-zinc-400">
                <div class="flex items-center justify-between">
                    Command palette
                    <span class="flex gap-1"><UiKbd size="sm">⌘</UiKbd><UiKbd size="sm">K</UiKbd></span>
                </div>
                <div class="flex items-center justify-between">
                    New deploy
                    <span class="flex gap-1"><UiKbd size="sm">⇧</UiKbd><UiKbd size="sm">D</UiKbd></span>
                </div>
                <div class="flex items-center justify-between">
                    Toggle logs
                    <UiKbd size="sm">L</UiKbd>
                </div>
            </div>
            VUE;

            $listReactCode = <<<'REACT'
            <div className="flex w-full max-w-xs flex-col gap-2.5 text-xs text-zinc-400">
                <div className="flex items-center justify-between">
                    Command palette
                    <span className="flex gap-1"><UiKbd size="sm">⌘</UiKbd><UiKbd size="sm">K</UiKbd></span>
                </div>
                <div className="flex items-center justify-between">
                    New deploy
                    <span className="flex gap-1"><UiKbd size="sm">⇧</UiKbd><UiKbd size="sm">D</UiKbd></span>
                </div>
                <div className="flex items-center justify-between">
                    Toggle logs
                    <UiKbd size="sm">L</UiKbd>
                </div>
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Single keys. The content is a slot, so glyphs and words both fit."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.kbd>⌘</x-ui.kbd>
                <x-ui.kbd>K</x-ui.kbd>
                <x-ui.kbd>Esc</x-ui.kbd>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Combination"
                description="Put keys in a tight flex row next to the action they trigger."
                :code="$comboCode" :vue-code="$comboVueCode" :react-code="$comboReactCode">
                <div class="flex items-center gap-2 text-xs text-zinc-500">
                    Search
                    <span class="flex gap-1">
                        <x-ui.kbd>⌘</x-ui.kbd>
                        <x-ui.kbd>K</x-ui.kbd>
                    </span>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Shortcut list"
                description="The sm size sits comfortably in a help panel that lists every shortcut."
                :code="$listCode" :vue-code="$listVueCode" :react-code="$listReactCode">
                <div class="flex w-full max-w-xs flex-col gap-2.5 text-xs text-zinc-400">
                    <div class="flex items-center justify-between">
                        Command palette
                        <span class="flex gap-1"><x-ui.kbd size="sm">⌘</x-ui.kbd><x-ui.kbd size="sm">K</x-ui.kbd></span>
                    </div>
                    <div class="flex items-center justify-between">
                        New deploy
                        <span class="flex gap-1"><x-ui.kbd size="sm">⇧</x-ui.kbd><x-ui.kbd size="sm">D</x-ui.kbd></span>
                    </div>
                    <div class="flex items-center justify-between">
                        Toggle logs
                        <x-ui.kbd size="sm">L</x-ui.kbd>
                    </div>
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="kbd" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
