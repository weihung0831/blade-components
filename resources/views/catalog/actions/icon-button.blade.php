<x-layout title="Icon button — BLADE-COMPONENTS">
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
                    A square button that holds a single icon. Same variants and link behavior as Button — always give it an aria-label, since there is no text.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.icon-button variant="primary" aria-label="Add item">
                <svg>…</svg>
            </x-ui.icon-button>
            <x-ui.icon-button aria-label="Copy">
                <svg>…</svg>
            </x-ui.icon-button>
            <x-ui.icon-button aria-label="Edit">
                <svg>…</svg>
            </x-ui.icon-button>
            <x-ui.icon-button variant="danger" aria-label="Delete">
                <svg>…</svg>
            </x-ui.icon-button>
            BLADE;

            $sizesCode = <<<'BLADE'
            <x-ui.icon-button size="sm" aria-label="Edit">…</x-ui.icon-button>
            <x-ui.icon-button aria-label="Edit">…</x-ui.icon-button>
            <x-ui.icon-button size="lg" aria-label="Edit">…</x-ui.icon-button>
            BLADE;

            $linkCode = <<<'BLADE'
            <x-ui.icon-button href="https://github.com/weihung0831" aria-label="GitHub">
                <svg>…</svg>
            </x-ui.icon-button>
            BLADE;

            $disabledCode = <<<'BLADE'
            <x-ui.icon-button variant="primary" disabled aria-label="Add item">…</x-ui.icon-button>
            <x-ui.icon-button disabled aria-label="Copy">…</x-ui.icon-button>
            BLADE;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Secondary is the default — icon buttons usually live in toolbars. The icon comes in through the slot and is sized for you."
                :code="$variantsCode">
                <x-ui.icon-button variant="primary" aria-label="Add item">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </x-ui.icon-button>
                <x-ui.icon-button aria-label="Copy">
                    <svg viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 5.5V4a1.5 1.5 0 0 0-1.5-1.5H4A1.5 1.5 0 0 0 2.5 4v5A1.5 1.5 0 0 0 4 10.5h1.5" stroke="currentColor" stroke-width="1.3"/></svg>
                </x-ui.icon-button>
                <x-ui.icon-button aria-label="Edit">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </x-ui.icon-button>
                <x-ui.icon-button variant="danger" aria-label="Delete">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M3 4.5h10M6.5 4V3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1M5 4.5l.5 8a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1l.5-8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                </x-ui.icon-button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Sizes"
                description="Three sizes via the size prop. The slotted icon scales with the button."
                :code="$sizesCode">
                <x-ui.icon-button size="sm" aria-label="Edit">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </x-ui.icon-button>
                <x-ui.icon-button aria-label="Edit">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </x-ui.icon-button>
                <x-ui.icon-button size="lg" aria-label="Edit">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </x-ui.icon-button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="As a link"
                description="Pass href and it renders an anchor — handy for social and repo links."
                :code="$linkCode">
                <x-ui.icon-button href="https://github.com/weihung0831/blade-components" target="_blank" rel="noopener" aria-label="GitHub">
                    <svg viewBox="0 0 16 16" fill="currentColor"><path d="M8 1.5a6.5 6.5 0 0 0-2.06 12.67c.33.06.45-.14.45-.31l-.01-1.2c-1.81.4-2.19-.77-2.19-.77-.3-.75-.72-.95-.72-.95-.6-.4.04-.4.04-.4.65.05 1 .68 1 .68.58 1 1.53.7 1.9.54.06-.42.23-.71.41-.87-1.44-.17-2.96-.72-2.96-3.21 0-.71.25-1.29.67-1.75-.07-.16-.29-.83.06-1.72 0 0 .55-.18 1.79.67a6.2 6.2 0 0 1 3.26 0c1.24-.85 1.79-.67 1.79-.67.35.89.13 1.56.06 1.72.42.46.67 1.04.67 1.75 0 2.5-1.52 3.04-2.97 3.2.23.2.44.6.44 1.21l-.01 1.79c0 .17.12.38.45.31A6.5 6.5 0 0 0 8 1.5Z"/></svg>
                </x-ui.icon-button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Disabled"
                description="Standard disabled attribute, same treatment as Button."
                :code="$disabledCode">
                <x-ui.icon-button variant="primary" disabled aria-label="Add item">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </x-ui.icon-button>
                <x-ui.icon-button disabled aria-label="Copy">
                    <svg viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 5.5V4a1.5 1.5 0 0 0-1.5-1.5H4A1.5 1.5 0 0 0 2.5 4v5A1.5 1.5 0 0 0 4 10.5h1.5" stroke="currentColor" stroke-width="1.3"/></svg>
                </x-ui.icon-button>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="icon-button" />

        </div>
    </div>
</x-layout>
