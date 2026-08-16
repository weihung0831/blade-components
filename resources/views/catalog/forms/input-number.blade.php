<x-layout title="Input number — BLADE-COMPONENTS">
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
                    A number input with stepper buttons on both ends. Buttons clamp to min and max and disable themselves at the bounds.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.input-number label="Seats" :value="3" />
            BLADE;

            $boundsCode = <<<'BLADE'
            <x-ui.input-number label="Replicas" :min="1" :max="8" :value="8" />
            BLADE;

            $decimalCode = <<<'BLADE'
            <x-ui.input-number label="Rate limit" :step="0.5" :value="2.5" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiInputNumber label="Seats" v-model="seats" />
            VUE;

            $boundsVueCode = <<<'VUE'
            <UiInputNumber label="Replicas" :min="1" :max="8" v-model="replicas" />
            VUE;

            $decimalVueCode = <<<'VUE'
            <UiInputNumber label="Rate limit" :step="0.5" v-model="rate" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiInputNumber label="Seats" value={3} onChange={setSeats} />
            REACT;

            $boundsReactCode = <<<'REACT'
            <UiInputNumber label="Replicas" min={1} max={8} value={8} />
            REACT;

            $decimalReactCode = <<<'REACT'
            <UiInputNumber label="Rate limit" step={0.5} value={2.5} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Click the steppers or type straight into the field — it stays a native number input."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.input-number label="Seats" :value="3" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Min and max"
                description="At either bound the matching stepper disables itself. This one starts at its max."
                :code="$boundsCode" :vue-code="$boundsVueCode" :react-code="$boundsReactCode">
                <x-ui.input-number label="Replicas" :min="1" :max="8" :value="8" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Decimal steps"
                description="Any step works, including decimals — values are rounded to dodge float drift."
                :code="$decimalCode" :vue-code="$decimalVueCode" :react-code="$decimalReactCode">
                <x-ui.input-number label="Rate limit" :step="0.5" :value="2.5" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="input-number" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
