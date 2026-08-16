<x-layout title="Rating — BLADE-COMPONENTS">
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
                    Stars over a hidden radio group. Hover previews, click selects, the form receives a plain number — all without JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.rating name="stars" :value="3" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiRating v-model="stars" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiRating value={3} onChange={setStars} />
            REACT;

            $readonlyCode = <<<'BLADE'
            <x-ui.rating readonly :value="4" />
            <x-ui.rating readonly :max="5" :value="2" />
            BLADE;

            $readonlyVueCode = <<<'VUE'
            <UiRating readonly :model-value="4" />
            <UiRating readonly :max="5" :model-value="2" />
            VUE;

            $readonlyReactCode = <<<'REACT'
            <UiRating readonly value={4} />
            <UiRating readonly max={5} value={2} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Interactive"
                description="Hover to preview, click to pick. Each star is a radio input, so the value posts under name."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.rating name="stars" :value="3" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Read-only"
                description="The readonly prop renders static stars plus the numeric score — for review lists and summaries."
                :code="$readonlyCode" :vue-code="$readonlyVueCode" :react-code="$readonlyReactCode">
                <div class="flex flex-col items-start gap-3">
                    <x-ui.rating readonly :value="4" />
                    <x-ui.rating readonly :max="5" :value="2" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="rating" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
