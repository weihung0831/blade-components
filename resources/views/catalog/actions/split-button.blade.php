<x-layout title="Split button — BLADE-COMPONENTS">
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
                    A primary action with a menu trigger attached to its side. Wire the caret to your own dropdown.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.split-button>Deploy</x-ui.split-button>
            <x-ui.split-button variant="secondary">Export</x-ui.split-button>
            BLADE;

            $variantsJsCode = <<<'JS'
            <UiSplitButton>Deploy</UiSplitButton>
            <UiSplitButton variant="secondary">Export</UiSplitButton>
            JS;

            $disabledCode = <<<'BLADE'
            <x-ui.split-button disabled>Deploy</x-ui.split-button>
            <x-ui.split-button variant="secondary" disabled>Export</x-ui.split-button>
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiSplitButton disabled>Deploy</UiSplitButton>
            <UiSplitButton variant="secondary" disabled>Export</UiSplitButton>
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Primary and secondary, matching Button. The caret is a separate focusable button."
                :code="$variantsCode" :vue-code="$variantsJsCode" :react-code="$variantsJsCode">
                <x-ui.split-button>Deploy</x-ui.split-button>
                <x-ui.split-button variant="secondary">Export</x-ui.split-button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Disabled"
                description="The disabled prop dims the whole control and disables both halves."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <x-ui.split-button disabled>Deploy</x-ui.split-button>
                <x-ui.split-button variant="secondary" disabled>Export</x-ui.split-button>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="split-button" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
