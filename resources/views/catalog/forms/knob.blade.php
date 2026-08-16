<x-layout title="Knob — BLADE-COMPONENTS">
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
                    A rotary control drawn with a conic gradient. Drag vertically, scroll, or press the arrow keys — the behavior is a small script that ships inside the component.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.knob label="Volume" :value="65" />
            BLADE;

            $sizesCode = <<<'BLADE'
            <x-ui.knob size="sm" :value="30" />
            <x-ui.knob :value="55" />
            <x-ui.knob size="lg" :value="80" />
            BLADE;

            $readonlyCode = <<<'BLADE'
            <x-ui.knob label="CPU" :value="42" readonly />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiKnob label="Volume" v-model="volume" />
            VUE;

            $sizesVueCode = <<<'VUE'
            <UiKnob size="sm" :value="30" />
            <UiKnob :value="55" />
            <UiKnob size="lg" :value="80" />
            VUE;

            $readonlyVueCode = <<<'VUE'
            <UiKnob label="CPU" :value="42" readonly />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiKnob label="Volume" value={65} onChange={setVolume} />
            REACT;

            $sizesReactCode = <<<'REACT'
            <UiKnob size="sm" value={30} />
            <UiKnob value={55} />
            <UiKnob size="lg" value={80} />
            REACT;

            $readonlyReactCode = <<<'REACT'
            <UiKnob label="CPU" value={42} readonly />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Drag up or down on the dial, scroll over it, or focus it and use the arrow keys."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.knob label="Volume" :value="65" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Sizes"
                description="Three sizes via the size prop. Default is md."
                :code="$sizesCode" :vue-code="$sizesVueCode" :react-code="$sizesReactCode">
                <x-ui.knob size="sm" :value="30" />
                <x-ui.knob :value="55" />
                <x-ui.knob size="lg" :value="80" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Read only"
                description="The readonly prop turns the dial into a gauge — no cursor, no focus, no input."
                :code="$readonlyCode" :vue-code="$readonlyVueCode" :react-code="$readonlyReactCode">
                <x-ui.knob label="CPU" :value="42" readonly />
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="knob" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
