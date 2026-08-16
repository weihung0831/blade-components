<x-layout title="Spinner — BLADE-COMPONENTS">
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
                    The universal "working on it". A ring or a trio of bouncing dots, three sizes, and a label prop that doubles as the accessible name.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $sizesCode = <<<'BLADE'
            <x-ui.spinner size="sm" />
            <x-ui.spinner />
            <x-ui.spinner size="lg" />
            <x-ui.spinner size="lg" color="zinc" />
            BLADE;

            $sizesVueCode = <<<'VUE'
            <UiSpinner size="sm" />
            <UiSpinner />
            <UiSpinner size="lg" />
            <UiSpinner size="lg" color="zinc" />
            VUE;

            $sizesReactCode = <<<'REACT'
            <UiSpinner size="sm" />
            <UiSpinner />
            <UiSpinner size="lg" />
            <UiSpinner size="lg" color="zinc" />
            REACT;

            $dotsCode = <<<'BLADE'
            <x-ui.spinner variant="dots" size="sm" />
            <x-ui.spinner variant="dots" />
            <x-ui.spinner variant="dots" size="lg" color="cream" />
            BLADE;

            $dotsVueCode = <<<'VUE'
            <UiSpinner variant="dots" size="sm" />
            <UiSpinner variant="dots" />
            <UiSpinner variant="dots" size="lg" color="cream" />
            VUE;

            $dotsReactCode = <<<'REACT'
            <UiSpinner variant="dots" size="sm" />
            <UiSpinner variant="dots" />
            <UiSpinner variant="dots" size="lg" color="cream" />
            REACT;

            $labelCode = <<<'BLADE'
            <x-ui.spinner label="Provisioning workspace…" />

            <x-ui.button disabled>
                <x-ui.spinner size="sm" color="cream" class="mr-2" />
                Deploying
            </x-ui.button>
            BLADE;

            $labelVueCode = <<<'VUE'
            <UiSpinner label="Provisioning workspace…" />

            <UiButton disabled>
                <UiSpinner size="sm" color="cream" class="mr-2" />
                Deploying
            </UiButton>
            VUE;

            $labelReactCode = <<<'REACT'
            <UiSpinner label="Provisioning workspace…" />

            <UiButton disabled>
                <UiSpinner size="sm" color="cream" className="mr-2" />
                Deploying
            </UiButton>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Sizes and colors"
                description="Three sizes on the ring, with jade, zinc, cream, and red color options."
                :code="$sizesCode" :vue-code="$sizesVueCode" :react-code="$sizesReactCode">
                <x-ui.spinner size="sm" />
                <x-ui.spinner />
                <x-ui.spinner size="lg" />
                <x-ui.spinner size="lg" color="zinc" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Dots"
                description="A softer read for chat-style waits and inline placeholders."
                :code="$dotsCode" :vue-code="$dotsVueCode" :react-code="$dotsReactCode">
                <x-ui.spinner variant="dots" size="sm" />
                <x-ui.spinner variant="dots" />
                <x-ui.spinner variant="dots" size="lg" color="cream" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="With label"
                description="A visible label sits beside the spinner; without one, a screen-reader-only 'Loading' fills in. Drop a small spinner inside a disabled button while a mutation runs."
                :code="$labelCode" :vue-code="$labelVueCode" :react-code="$labelReactCode">
                <x-ui.spinner label="Provisioning workspace…" />
                <x-ui.button disabled>
                    <x-ui.spinner size="sm" color="cream" class="mr-2" />
                    Deploying
                </x-ui.button>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="spinner" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
