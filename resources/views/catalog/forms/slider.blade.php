<x-layout title="Slider — BLADE-COMPONENTS">
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
                    A native range input restyled — jade fill, cream thumb, live value readout. A few lines of script inside the component keep the fill in sync.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.slider label="Volume" :value="40" />
            BLADE;

            $stepsCode = <<<'BLADE'
            <x-ui.slider label="Opacity" :step="10" :value="70" />
            BLADE;

            $disabledCode = <<<'BLADE'
            <x-ui.slider label="Brightness" :value="25" disabled />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiSlider label="Volume" v-model="volume" />
            VUE;

            $stepsVueCode = <<<'VUE'
            <UiSlider label="Opacity" :step="10" v-model="opacity" />
            VUE;

            $disabledVueCode = <<<'VUE'
            <UiSlider label="Brightness" :value="25" disabled />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiSlider label="Volume" value={40} onChange={setVolume} />
            REACT;

            $stepsReactCode = <<<'REACT'
            <UiSlider label="Opacity" step={10} value={70} />
            REACT;

            $disabledReactCode = <<<'REACT'
            <UiSlider label="Brightness" value={25} disabled />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Drag the thumb — the jade fill and the mono readout track the value live."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.slider label="Volume" :value="40" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Steps"
                description="min, max, and step map straight onto the native attributes."
                :code="$stepsCode" :vue-code="$stepsVueCode" :react-code="$stepsReactCode">
                <x-ui.slider label="Opacity" :step="10" :value="70" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Disabled"
                description="The disabled prop dims the track and drops pointer events."
                :code="$disabledCode" :vue-code="$disabledVueCode" :react-code="$disabledReactCode">
                <x-ui.slider label="Brightness" :value="25" disabled />
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="slider" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
