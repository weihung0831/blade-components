<x-layout title="Button group — BLADE-COMPONENTS">
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
                    One bordered shell that styles the plain buttons you drop inside. Mark the current segment with data-active.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.button-group>
                <button data-active>Day</button>
                <button>Week</button>
                <button>Month</button>
            </x-ui.button-group>

            <x-ui.button-group>
                <button aria-label="Align left"><svg>…</svg></button>
                <button data-active aria-label="Align center"><svg>…</svg></button>
                <button aria-label="Align right"><svg>…</svg></button>
            </x-ui.button-group>
            BLADE;

            $variantsJsCode = <<<'JS'
            <UiButtonGroup>
                <button data-active>Day</button>
                <button>Week</button>
                <button>Month</button>
            </UiButtonGroup>

            <UiButtonGroup>
                <button aria-label="Align left"><svg>…</svg></button>
                <button data-active aria-label="Align center"><svg>…</svg></button>
                <button aria-label="Align right"><svg>…</svg></button>
            </UiButtonGroup>
            JS;

            $disabledCode = <<<'BLADE'
            <x-ui.button-group>
                <button data-active>Day</button>
                <button disabled>Week</button>
                <button>Month</button>
            </x-ui.button-group>
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiButtonGroup>
                <button data-active>Day</button>
                <button disabled>Week</button>
                <button>Month</button>
            </UiButtonGroup>
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Text segments or icon buttons — the group borders, divides, and sizes plain buttons for you."
                :code="$variantsCode" :vue-code="$variantsJsCode" :react-code="$variantsJsCode">
                <x-ui.button-group>
                    <button data-active>Day</button>
                    <button>Week</button>
                    <button>Month</button>
                </x-ui.button-group>
                <x-ui.button-group>
                    <button aria-label="Align left"><svg viewBox="0 0 16 16" fill="none"><path d="M3 4.5h10M3 8h7M3 11.5h9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg></button>
                    <button data-active aria-label="Align center"><svg viewBox="0 0 16 16" fill="none"><path d="M3 4.5h10M4.5 8h7M3.5 11.5h9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg></button>
                    <button aria-label="Align right"><svg viewBox="0 0 16 16" fill="none"><path d="M3 4.5h10M6 8h7M4 11.5h9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg></button>
                </x-ui.button-group>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Disabled"
                description="Disable individual segments with the standard attribute."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <x-ui.button-group>
                    <button data-active>Day</button>
                    <button disabled>Week</button>
                    <button>Month</button>
                </x-ui.button-group>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="button-group" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
