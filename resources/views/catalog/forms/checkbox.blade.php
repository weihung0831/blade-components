<x-layout title="Checkbox — BLADE-COMPONENTS">
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
                    A native checkbox restyled with pure CSS. Label, description, and a card variant — no JavaScript anywhere.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.checkbox label="Unit tests" checked />
            <x-ui.checkbox label="Static analysis" />
            <x-ui.checkbox label="Browser tests" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiCheckbox v-model="unit" label="Unit tests" />
            <UiCheckbox v-model="static" label="Static analysis" />
            <UiCheckbox v-model="browser" label="Browser tests" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiCheckbox label="Unit tests" defaultChecked />
            <UiCheckbox label="Static analysis" />
            <UiCheckbox label="Browser tests" />
            REACT;

            $descriptionCode = <<<'BLADE'
            <x-ui.checkbox
                label="Weekly digest"
                description="A summary of deploys and incidents, every Monday."
                checked
            />
            BLADE;

            $descriptionVueCode = <<<'VUE'
            <UiCheckbox
                v-model="digest"
                label="Weekly digest"
                description="A summary of deploys and incidents, every Monday."
            />
            VUE;

            $descriptionReactCode = <<<'REACT'
            <UiCheckbox
                label="Weekly digest"
                description="A summary of deploys and incidents, every Monday."
                defaultChecked
            />
            REACT;

            $cardCode = <<<'BLADE'
            <x-ui.checkbox
                variant="card"
                label="Autoscaling"
                description="Add replicas when CPU stays above 80%."
                checked
            />
            <x-ui.checkbox
                variant="card"
                label="Zero-downtime deploys"
                description="Swap traffic only after health checks pass."
            />
            BLADE;

            $cardVueCode = <<<'VUE'
            <UiCheckbox
                v-model="autoscaling"
                variant="card"
                label="Autoscaling"
                description="Add replicas when CPU stays above 80%."
            />
            VUE;

            $cardReactCode = <<<'REACT'
            <UiCheckbox
                variant="card"
                label="Autoscaling"
                description="Add replicas when CPU stays above 80%."
                defaultChecked
            />
            REACT;

            $disabledCode = <<<'BLADE'
            <x-ui.checkbox label="Locked by plan" disabled />
            <x-ui.checkbox label="Included in plan" checked disabled />
            BLADE;

            $disabledVueCode = <<<'VUE'
            <UiCheckbox label="Locked by plan" disabled />
            <UiCheckbox :model-value="true" label="Included in plan" disabled />
            VUE;

            $disabledReactCode = <<<'REACT'
            <UiCheckbox label="Locked by plan" disabled />
            <UiCheckbox label="Included in plan" defaultChecked disabled />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="A real input styled with appearance-none — clicks, keyboard, and forms all work natively."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex flex-col items-start gap-3">
                    <x-ui.checkbox label="Unit tests" checked />
                    <x-ui.checkbox label="Static analysis" />
                    <x-ui.checkbox label="Browser tests" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="With description"
                description="Pass description for a second line of muted help text."
                :code="$descriptionCode" :vue-code="$descriptionVueCode" :react-code="$descriptionReactCode">
                <x-ui.checkbox label="Weekly digest" description="A summary of deploys and incidents, every Monday." checked />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Card"
                description="The card variant wraps the whole row in a clickable bordered panel that lights up when checked."
                :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                <div class="flex w-full max-w-sm flex-col gap-3">
                    <x-ui.checkbox variant="card" label="Autoscaling" description="Add replicas when CPU stays above 80%." checked />
                    <x-ui.checkbox variant="card" label="Zero-downtime deploys" description="Swap traffic only after health checks pass." />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Disabled"
                description="Standard disabled attribute. The whole row dims and stops accepting clicks."
                :code="$disabledCode" :vue-code="$disabledVueCode" :react-code="$disabledReactCode">
                <div class="flex flex-col items-start gap-3">
                    <x-ui.checkbox label="Locked by plan" disabled />
                    <x-ui.checkbox label="Included in plan" checked disabled />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="checkbox" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
