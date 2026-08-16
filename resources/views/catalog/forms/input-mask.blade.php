<x-layout title="Input mask — BLADE-COMPONENTS">
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
                    Formats as you type against a mask pattern — # takes a digit, a takes a letter, anything else is a literal the script inserts for you.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $phoneCode = <<<'BLADE'
            <x-ui.input-mask label="Phone" mask="(###) ###-####" />
            BLADE;

            $dateCode = <<<'BLADE'
            <x-ui.input-mask label="Expiry" mask="##/##" placeholder="MM/YY" />
            BLADE;

            $serialCode = <<<'BLADE'
            <x-ui.input-mask label="License key" mask="aa##-####-####" />
            BLADE;

            $phoneVueCode = <<<'VUE'
            <UiInputMask label="Phone" mask="(###) ###-####" v-model="phone" />
            VUE;

            $dateVueCode = <<<'VUE'
            <UiInputMask label="Expiry" mask="##/##" placeholder="MM/YY" v-model="expiry" />
            VUE;

            $serialVueCode = <<<'VUE'
            <UiInputMask label="License key" mask="aa##-####-####" v-model="license" />
            VUE;

            $phoneReactCode = <<<'REACT'
            <UiInputMask label="Phone" mask="(###) ###-####" onChange={setPhone} />
            REACT;

            $dateReactCode = <<<'REACT'
            <UiInputMask label="Expiry" mask="##/##" placeholder="MM/YY" onChange={setExpiry} />
            REACT;

            $serialReactCode = <<<'REACT'
            <UiInputMask label="License key" mask="aa##-####-####" onChange={setLicense} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Phone"
                description="Type digits — the parentheses, space, and dash appear on their own."
                :code="$phoneCode" :vue-code="$phoneVueCode" :react-code="$phoneReactCode">
                <x-ui.input-mask label="Phone" mask="(###) ###-####" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Date"
                description="Pass a placeholder when the mask itself is a poor hint."
                :code="$dateCode" :vue-code="$dateVueCode" :react-code="$dateReactCode">
                <x-ui.input-mask label="Expiry" mask="##/##" placeholder="MM/YY" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Mixed tokens"
                description="Combine a and # — non-matching characters are simply dropped."
                :code="$serialCode" :vue-code="$serialVueCode" :react-code="$serialReactCode">
                <x-ui.input-mask label="License key" mask="aa##-####-####" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="input-mask" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
