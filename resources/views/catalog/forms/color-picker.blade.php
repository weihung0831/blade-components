<x-layout title="Color picker — BLADE-COMPONENTS">
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
                    The native color input dressed up as a swatch with a live hex readout. Optional preset swatches sit above it.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicsCode = <<<'BLADE'
            <x-ui.color-picker label="Accent" name="accent" />
            BLADE;

            $swatchesCode = <<<'BLADE'
            <x-ui.color-picker label="Brand color" name="brand"
                :swatches="['#4ea396', '#6abcae', '#8ed3c6', '#fefbee', '#52525c']" />
            BLADE;

            $basicsVueCode = <<<'VUE'
            <UiColorPicker v-model="accent" label="Accent" />
            VUE;

            $swatchesVueCode = <<<'VUE'
            <UiColorPicker
                v-model="brand"
                label="Brand color"
                :swatches="['#4ea396', '#6abcae', '#8ed3c6', '#fefbee', '#52525c']"
            />
            VUE;

            $basicsReactCode = <<<'REACT'
            <UiColorPicker label="Accent" onChange={setAccent} />
            REACT;

            $swatchesReactCode = <<<'REACT'
            <UiColorPicker
                label="Brand color"
                swatches={['#4ea396', '#6abcae', '#8ed3c6', '#fefbee', '#52525c']}
                onChange={setBrand}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basics"
                description="Click the swatch to open your platform's color panel. The hex value updates as you pick."
                :code="$basicsCode" :vue-code="$basicsVueCode" :react-code="$basicsReactCode">
                <x-ui.color-picker label="Accent" name="accent" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Preset swatches"
                description="Pass a swatches array for one-click presets. Picking one syncs the input and the readout."
                :code="$swatchesCode" :vue-code="$swatchesVueCode" :react-code="$swatchesReactCode">
                <x-ui.color-picker label="Brand color" name="brand" :swatches="['#4ea396', '#6abcae', '#8ed3c6', '#fefbee', '#52525c']" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="color-picker" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
