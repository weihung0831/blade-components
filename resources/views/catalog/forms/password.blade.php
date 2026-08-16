<x-layout title="Password — BLADE-COMPONENTS">
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
                    A password field with a reveal toggle and an optional strength meter. A few lines of vanilla JS ship inside the component file.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicsCode = <<<'BLADE'
            <x-ui.password label="Password" />
            BLADE;

            $meterCode = <<<'BLADE'
            <x-ui.password label="New password" :meter="true" />
            BLADE;

            $basicsVueCode = <<<'VUE'
            <UiPassword v-model="password" label="Password" />
            VUE;

            $meterVueCode = <<<'VUE'
            <UiPassword v-model="password" label="New password" meter />
            VUE;

            $basicsReactCode = <<<'REACT'
            <UiPassword label="Password" />
            REACT;

            $meterReactCode = <<<'REACT'
            <UiPassword label="New password" meter />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basics"
                description="Click the eye to reveal what you typed. The toggle swaps the input type, nothing else."
                :code="$basicsCode" :vue-code="$basicsVueCode" :react-code="$basicsReactCode">
                <x-ui.password label="Password" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Strength meter"
                description="The meter prop adds four bars scored on length, mixed case, digits, and symbols. Type to see it move."
                :code="$meterCode" :vue-code="$meterVueCode" :react-code="$meterReactCode">
                <x-ui.password label="New password" :meter="true" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="password" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
