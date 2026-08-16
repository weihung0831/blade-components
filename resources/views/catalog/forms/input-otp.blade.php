<x-layout title="Input OTP — BLADE-COMPONENTS">
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
                    One cell per digit. Typing advances, backspace walks back, and pasting a whole code fills every cell — handled by a short script inside the component.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.input-otp label="Verification code" />
            BLADE;

            $lengthCode = <<<'BLADE'
            <x-ui.input-otp label="PIN" :length="4" />
            BLADE;

            $maskedCode = <<<'BLADE'
            <x-ui.input-otp label="PIN" :length="4" masked />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiInputOtp label="Verification code" v-model="code" />
            VUE;

            $lengthVueCode = <<<'VUE'
            <UiInputOtp label="PIN" :length="4" v-model="pin" />
            VUE;

            $maskedVueCode = <<<'VUE'
            <UiInputOtp label="PIN" :length="4" masked v-model="pin" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiInputOtp label="Verification code" onChange={setCode} />
            REACT;

            $lengthReactCode = <<<'REACT'
            <UiInputOtp label="PIN" length={4} onChange={setPin} />
            REACT;

            $maskedReactCode = <<<'REACT'
            <UiInputOtp label="PIN" length={4} masked onChange={setPin} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Six digits by default. Try pasting a code — it spreads across the cells."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.input-otp label="Verification code" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Length"
                description="The length prop renders any number of cells."
                :code="$lengthCode" :vue-code="$lengthVueCode" :react-code="$lengthReactCode">
                <x-ui.input-otp label="PIN" :length="4" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Masked"
                description="The masked prop swaps the cells to password inputs for codes worth hiding."
                :code="$maskedCode" :vue-code="$maskedVueCode" :react-code="$maskedReactCode">
                <x-ui.input-otp label="PIN" :length="4" masked />
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="input-otp" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
