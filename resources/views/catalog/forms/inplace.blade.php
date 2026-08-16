<x-layout title="Inplace — BLADE-COMPONENTS">
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
                    Text that turns into an input when clicked. Enter or blur saves, Escape puts the old value back.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicsCode = <<<'BLADE'
            <x-ui.inplace value="Untitled project" name="title" />
            BLADE;

            $monoCode = <<<'BLADE'
            <x-ui.inplace value="blade-components v0.1.0" :mono="true" />
            BLADE;

            $basicsVueCode = <<<'VUE'
            <UiInplace v-model="title" />
            VUE;

            $monoVueCode = <<<'VUE'
            <UiInplace v-model="release" mono />
            VUE;

            $basicsReactCode = <<<'REACT'
            <UiInplace defaultValue="Untitled project" onChange={setTitle} />
            REACT;

            $monoReactCode = <<<'REACT'
            <UiInplace defaultValue="blade-components v0.1.0" mono />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basics"
                description="Click the dashed text to edit it in place. An empty submit keeps the previous value."
                :code="$basicsCode" :vue-code="$basicsVueCode" :react-code="$basicsReactCode">
                <x-ui.inplace value="Untitled project" name="title" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Monospace"
                description="The mono prop sets the value in the code font — for versions, IDs, and other machine-flavored strings."
                :code="$monoCode" :vue-code="$monoVueCode" :react-code="$monoReactCode">
                <x-ui.inplace value="blade-components v0.1.0" :mono="true" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="inplace" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
