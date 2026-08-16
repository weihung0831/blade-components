<x-layout title="Switch — BLADE-COMPONENTS">
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
                    A checkbox dressed as a toggle. The knob slides on the CSS translate property, the input keeps every native behavior.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.switch label="Notifications" checked />
            <x-ui.switch label="Maintenance mode" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiSwitch v-model="notifications" label="Notifications" />
            <UiSwitch v-model="maintenance" label="Maintenance mode" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiSwitch label="Notifications" defaultChecked />
            <UiSwitch label="Maintenance mode" />
            REACT;

            $sizesCode = <<<'BLADE'
            <x-ui.switch size="sm" label="Compact rows" checked />
            <x-ui.switch label="Auto refresh" checked />
            BLADE;

            $sizesVueCode = <<<'VUE'
            <UiSwitch v-model="compact" size="sm" label="Compact rows" />
            <UiSwitch v-model="refresh" label="Auto refresh" />
            VUE;

            $sizesReactCode = <<<'REACT'
            <UiSwitch size="sm" label="Compact rows" defaultChecked />
            <UiSwitch label="Auto refresh" defaultChecked />
            REACT;

            $disabledCode = <<<'BLADE'
            <x-ui.switch label="SSO enforcement" disabled />
            <x-ui.switch label="Audit log" checked disabled />
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiSwitch label="SSO enforcement" disabled />
            <UiSwitch label="Audit log" defaultChecked disabled />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Click the label or the track — it's one input under the hood, announced as a switch."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex flex-col items-start gap-4">
                    <x-ui.switch label="Notifications" checked />
                    <x-ui.switch label="Maintenance mode" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Sizes"
                description="Two sizes via the size prop. Default is md."
                :code="$sizesCode" :vue-code="$sizesVueCode" :react-code="$sizesReactCode">
                <div class="flex flex-col items-start gap-4">
                    <x-ui.switch size="sm" label="Compact rows" checked />
                    <x-ui.switch label="Auto refresh" checked />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Disabled"
                description="Standard disabled attribute — track, knob, and label all dim together."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <div class="flex flex-col items-start gap-4">
                    <x-ui.switch label="SSO enforcement" disabled />
                    <x-ui.switch label="Audit log" checked disabled />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="switch" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
