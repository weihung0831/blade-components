<x-layout title="Speed dial — BLADE-COMPONENTS">
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
                    A floating action button that fans shortcut actions out on hover or keyboard focus. No JavaScript involved.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.speed-dial label="Quick actions">
                <x-ui.icon-button aria-label="Edit">…</x-ui.icon-button>
                <x-ui.icon-button aria-label="Copy">…</x-ui.icon-button>
                <x-ui.icon-button variant="danger" aria-label="Delete">…</x-ui.icon-button>
            </x-ui.speed-dial>
            BLADE;

            $variantsJsCode = <<<'JS'
            <UiSpeedDial label="Quick actions">
                <UiIconButton aria-label="Edit">…</UiIconButton>
                <UiIconButton aria-label="Copy">…</UiIconButton>
                <UiIconButton variant="danger" aria-label="Delete">…</UiIconButton>
            </UiSpeedDial>
            JS;

            $directionCode = <<<'BLADE'
            <x-ui.speed-dial direction="right" label="Quick actions">
                <x-ui.icon-button aria-label="Edit">…</x-ui.icon-button>
                <x-ui.icon-button aria-label="Copy">…</x-ui.icon-button>
            </x-ui.speed-dial>
            BLADE;

            $directionJsCode = <<<'JS'
            <UiSpeedDial direction="right" label="Quick actions">
                <UiIconButton aria-label="Edit">…</UiIconButton>
                <UiIconButton aria-label="Copy">…</UiIconButton>
            </UiSpeedDial>
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Hover or focus the dial and the actions rise out above it. Fill the slot with icon buttons."
                :code="$variantsCode" :vue-code="$variantsJsCode" :react-code="$variantsJsCode">
                <x-ui.speed-dial label="Quick actions">
                    <x-ui.icon-button aria-label="Edit">
                        <svg viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                    </x-ui.icon-button>
                    <x-ui.icon-button aria-label="Copy">
                        <svg viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 5.5V4a1.5 1.5 0 0 0-1.5-1.5H4A1.5 1.5 0 0 0 2.5 4v5A1.5 1.5 0 0 0 4 10.5h1.5" stroke="currentColor" stroke-width="1.3"/></svg>
                    </x-ui.icon-button>
                    <x-ui.icon-button variant="danger" aria-label="Delete">
                        <svg viewBox="0 0 16 16" fill="none"><path d="M3 4.5h10M6.5 4V3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1M5 4.5l.5 8a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1l.5-8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                    </x-ui.icon-button>
                </x-ui.speed-dial>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Direction"
                description="Point the fan to the right for toolbars and bottom bars."
                :code="$directionCode" :vue-code="$directionJsCode" :react-code="$directionJsCode">
                <x-ui.speed-dial direction="right" label="Quick actions">
                    <x-ui.icon-button aria-label="Edit">
                        <svg viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                    </x-ui.icon-button>
                    <x-ui.icon-button aria-label="Copy">
                        <svg viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 5.5V4a1.5 1.5 0 0 0-1.5-1.5H4A1.5 1.5 0 0 0 2.5 4v5A1.5 1.5 0 0 0 4 10.5h1.5" stroke="currentColor" stroke-width="1.3"/></svg>
                    </x-ui.icon-button>
                </x-ui.speed-dial>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="speed-dial" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
