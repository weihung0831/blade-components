<x-layout title="Input — BLADE-COMPONENTS">
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
                    A labeled text field with hint, error, and success states baked in. A native input under the hood — zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.input label="Email" type="email"
                placeholder="you@example.com"
                hint="We only use this for billing." />
            BLADE;

            $basicJsCode = <<<'JS'
            <UiInput label="Email" type="email"
                placeholder="you@example.com"
                hint="We only use this for billing." />
            JS;

            $statesCode = <<<'BLADE'
            <x-ui.input label="Workspace URL" value="my site"
                error="Lowercase letters and dashes only." />
            <x-ui.input label="API key" value="sk-9f2e-71ab"
                state="success" />
            BLADE;

            $statesJsCode = <<<'JS'
            <UiInput label="Workspace URL" value="my site"
                error="Lowercase letters and dashes only." />
            <UiInput label="API key" value="sk-9f2e-71ab"
                state="success" />
            JS;

            $sizesCode = <<<'BLADE'
            <x-ui.input size="sm" placeholder="Small" />
            <x-ui.input placeholder="Medium" />
            <x-ui.input size="lg" placeholder="Large" />
            BLADE;

            $sizesJsCode = <<<'JS'
            <UiInput size="sm" placeholder="Small" />
            <UiInput placeholder="Medium" />
            <UiInput size="lg" placeholder="Large" />
            JS;

            $disabledCode = <<<'BLADE'
            <x-ui.input label="Plan" value="Pro (annual)" disabled />
            <x-ui.input label="Region" value="ap-northeast-1" readonly />
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiInput label="Plan" value="Pro (annual)" disabled />
            <UiInput label="Region" value="ap-northeast-1" readOnly />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Label, placeholder, and an optional hint below the field."
                :code="$basicCode" :vue-code="$basicJsCode" :react-code="$basicJsCode">
                <div class="w-72">
                    <x-ui.input label="Email" type="email" placeholder="you@example.com" hint="We only use this for billing." />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="States"
                description="Pass error to flag the field — it overrides the hint and sets aria-invalid. Use state for success."
                :code="$statesCode" :vue-code="$statesJsCode" :react-code="$statesJsCode">
                <div class="w-72 self-start">
                    <x-ui.input label="Workspace URL" value="my site" error="Lowercase letters and dashes only." />
                </div>
                <div class="w-72 self-start">
                    <x-ui.input label="API key" value="sk-9f2e-71ab" state="success" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Sizes"
                description="Three sizes via the size prop. Default is md."
                :code="$sizesCode" :vue-code="$sizesJsCode" :react-code="$sizesJsCode">
                <div class="w-56"><x-ui.input size="sm" placeholder="Small" /></div>
                <div class="w-56"><x-ui.input placeholder="Medium" /></div>
                <div class="w-56"><x-ui.input size="lg" placeholder="Large" /></div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Disabled and readonly"
                description="Standard HTML attributes pass straight through to the input."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <div class="w-64"><x-ui.input label="Plan" value="Pro (annual)" disabled /></div>
                <div class="w-64"><x-ui.input label="Region" value="ap-northeast-1" readonly /></div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="input" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
