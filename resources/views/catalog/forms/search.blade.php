<x-layout title="Search — BLADE-COMPONENTS">
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
                    A ready-made search field with a magnifier and an optional shortcut hint. Built on a native search input — zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $shortcutCode = <<<'BLADE'
            <x-ui.search placeholder="Search components…" shortcut="⌘ K" />
            BLADE;

            $shortcutJsCode = <<<'JS'
            <UiSearch placeholder="Search components…" shortcut="⌘ K" />
            JS;

            $plainCode = <<<'BLADE'
            <x-ui.search size="sm" placeholder="Filter members…" />
            BLADE;

            $plainJsCode = <<<'JS'
            <UiSearch size="sm" placeholder="Filter members…" />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="With a shortcut hint"
                description="Pass shortcut as space-separated keys — each renders as its own keycap. Wire the actual binding to your command menu."
                :code="$shortcutCode" :vue-code="$shortcutJsCode" :react-code="$shortcutJsCode">
                <x-ui.search class="w-80" placeholder="Search components…" shortcut="⌘ K" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Plain and small"
                description="Skip the shortcut for inline filtering. size sm fits table toolbars."
                :code="$plainCode" :vue-code="$plainJsCode" :react-code="$plainJsCode">
                <x-ui.search size="sm" class="w-64" placeholder="Filter members…" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="search" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
