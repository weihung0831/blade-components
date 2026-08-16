<x-layout title="Separator — BLADE-COMPONENTS">
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
                    A hairline that divides. Horizontal, vertical, or with a small mono label in the middle.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <p>Usage this month</p>
            <x-ui.separator class="my-3" />
            <p>12,400 of 50,000 requests</p>
            BLADE;

            $basicVueCode = <<<'VUE'
            <p>Usage this month</p>
            <UiSeparator class="my-3" />
            <p>12,400 of 50,000 requests</p>
            VUE;

            $basicReactCode = <<<'REACT'
            <p>Usage this month</p>
            <UiSeparator className="my-3" />
            <p>12,400 of 50,000 requests</p>
            REACT;

            $labelCode = <<<'BLADE'
            <p>Sign in with GitHub</p>
            <x-ui.separator label="or" class="my-3" />
            <p>Continue with email</p>
            BLADE;

            $labelVueCode = <<<'VUE'
            <p>Sign in with GitHub</p>
            <UiSeparator label="or" class="my-3" />
            <p>Continue with email</p>
            VUE;

            $labelReactCode = <<<'REACT'
            <p>Sign in with GitHub</p>
            <UiSeparator label="or" className="my-3" />
            <p>Continue with email</p>
            REACT;

            $verticalCode = <<<'BLADE'
            <div class="flex items-center gap-3 text-sm text-zinc-400">
                <span>Production</span>
                <x-ui.separator vertical />
                <span>main</span>
                <x-ui.separator vertical />
                <span>deploy #418</span>
            </div>
            BLADE;

            $verticalVueCode = <<<'VUE'
            <div class="flex items-center gap-3 text-sm text-zinc-400">
                <span>Production</span>
                <UiSeparator vertical />
                <span>main</span>
                <UiSeparator vertical />
                <span>deploy #418</span>
            </div>
            VUE;

            $verticalReactCode = <<<'REACT'
            <div className="flex items-center gap-3 text-sm text-zinc-400">
                <span>Production</span>
                <UiSeparator vertical />
                <span>main</span>
                <UiSeparator vertical />
                <span>deploy #418</span>
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="A one-pixel line at 10% white. Spacing comes from the class you pass, not the component."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="w-56 text-xs text-zinc-400">
                    <p>Usage this month</p>
                    <x-ui.separator class="my-3" />
                    <p>12,400 of 50,000 requests</p>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="With label"
                description="Pass label and the line splits around a small uppercase word — the classic auth-form divider."
                :code="$labelCode" :vue-code="$labelVueCode" :react-code="$labelReactCode">
                <div class="w-56 text-xs text-zinc-400">
                    <p>Sign in with GitHub</p>
                    <x-ui.separator label="or" class="my-3" />
                    <p>Continue with email</p>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Vertical"
                description="vertical stretches the rule to the height of its flex row. Handy for metadata strips."
                :code="$verticalCode" :vue-code="$verticalVueCode" :react-code="$verticalReactCode">
                <div class="flex items-center gap-3 text-sm text-zinc-400">
                    <span>Production</span>
                    <x-ui.separator vertical />
                    <span>main</span>
                    <x-ui.separator vertical />
                    <span>deploy #418</span>
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="separator" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
