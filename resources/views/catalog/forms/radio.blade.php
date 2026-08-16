<x-layout title="Radio — BLADE-COMPONENTS">
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
                    A native radio with a custom dot, sharing one name per group. Same card variant as the checkbox for picker-style choices.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.radio name="rendering" value="static" label="Static site" checked />
            <x-ui.radio name="rendering" value="ssr" label="Server rendered" />
            <x-ui.radio name="rendering" value="hybrid" label="Hybrid" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiRadio v-model="rendering" value="static" label="Static site" />
            <UiRadio v-model="rendering" value="ssr" label="Server rendered" />
            <UiRadio v-model="rendering" value="hybrid" label="Hybrid" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiRadio name="rendering" value="static" label="Static site" defaultChecked />
            <UiRadio name="rendering" value="ssr" label="Server rendered" />
            <UiRadio name="rendering" value="hybrid" label="Hybrid" />
            REACT;

            $cardCode = <<<'BLADE'
            <x-ui.radio
                variant="card"
                name="plan"
                value="starter"
                label="Starter"
                description="1 project, community support."
            />
            <x-ui.radio
                variant="card"
                name="plan"
                value="pro"
                label="Pro"
                description="Unlimited projects, priority support."
                checked
            />
            BLADE;

            $cardVueCode = <<<'VUE'
            <UiRadio
                v-model="plan"
                variant="card"
                value="starter"
                label="Starter"
                description="1 project, community support."
            />
            <UiRadio
                v-model="plan"
                variant="card"
                value="pro"
                label="Pro"
                description="Unlimited projects, priority support."
            />
            VUE;

            $cardReactCode = <<<'REACT'
            <UiRadio
                variant="card"
                name="plan"
                value="starter"
                label="Starter"
                description="1 project, community support."
            />
            <UiRadio
                variant="card"
                name="plan"
                value="pro"
                label="Pro"
                description="Unlimited projects, priority support."
                defaultChecked
            />
            REACT;

            $disabledCode = <<<'BLADE'
            <x-ui.radio name="tier" value="free" label="Free" checked disabled />
            <x-ui.radio name="tier" value="enterprise" label="Enterprise" disabled />
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiRadio name="tier" value="free" label="Free" defaultChecked disabled />
            <UiRadio name="tier" value="enterprise" label="Enterprise" disabled />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Group"
                description="Give every option the same name and the browser enforces single choice, arrow keys included."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex flex-col items-start gap-3">
                    <x-ui.radio name="rendering" value="static" label="Static site" checked />
                    <x-ui.radio name="rendering" value="ssr" label="Server rendered" />
                    <x-ui.radio name="rendering" value="hybrid" label="Hybrid" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Card group"
                description="The card variant turns a radio group into a plan picker — the selected panel gets the jade treatment."
                :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                <div class="flex w-full max-w-sm flex-col gap-3">
                    <x-ui.radio variant="card" name="plan" value="starter" label="Starter" description="1 project, community support." />
                    <x-ui.radio variant="card" name="plan" value="pro" label="Pro" description="Unlimited projects, priority support." checked />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Disabled"
                description="Disable single options or the whole group — the row dims and ignores clicks."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <div class="flex flex-col items-start gap-3">
                    <x-ui.radio name="tier" value="free" label="Free" checked disabled />
                    <x-ui.radio name="tier" value="enterprise" label="Enterprise" disabled />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="radio" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
