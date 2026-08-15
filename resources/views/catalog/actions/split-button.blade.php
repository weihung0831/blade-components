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
                    A primary action with a dropdown of secondary actions attached. The menu is a native details element — no JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.split-button>
                Deploy
                <x-slot:menu>
                    <button>Deploy with cache</button>
                    <button>Rollback</button>
                </x-slot:menu>
            </x-ui.split-button>

            <x-ui.split-button variant="secondary">
                Export
                <x-slot:menu>
                    <button>Export as CSV</button>
                    <button>Export as JSON</button>
                </x-slot:menu>
            </x-ui.split-button>
            BLADE;

            $variantsVueCode = <<<'VUE'
            <UiSplitButton>
                Deploy
                <template #menu>
                    <button>Deploy with cache</button>
                    <button>Rollback</button>
                </template>
            </UiSplitButton>
            VUE;

            $variantsReactCode = <<<'REACT'
            <UiSplitButton
                menu={
                    <>
                        <button>Deploy with cache</button>
                        <button>Rollback</button>
                    </>
                }
            >
                Deploy
            </UiSplitButton>
            REACT;

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
                description="Click the caret to open the attached menu — plain buttons or links inside get styled for you. Click it again to close."
                :code="$variantsCode" :vue-code="$variantsVueCode" :react-code="$variantsReactCode">
                <x-ui.split-button>
                    Deploy
                    <x-slot:menu>
                        <button>Deploy with cache</button>
                        <button>Rollback</button>
                    </x-slot:menu>
                </x-ui.split-button>
                <x-ui.split-button variant="secondary">
                    Export
                    <x-slot:menu>
                        <button>Export as CSV</button>
                        <button>Export as JSON</button>
                    </x-slot:menu>
                </x-ui.split-button>
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
