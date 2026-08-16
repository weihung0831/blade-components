<x-layout title="Animated bar chart — BLADE-COMPONENTS">
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
                    The horizontal cut, for when the labels are words rather than dates. Bars grow from the left edge and each value sits at the end of its own bar, so nothing is left to a legend.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $plans = [
                ['label' => 'Free', 'value' => 812],
                ['label' => 'Starter', 'value' => 431],
                ['label' => 'Scale', 'value' => 268, 'highlight' => true],
                ['label' => 'Enterprise', 'value' => 74],
            ];

            $endpoints = [
                ['label' => '/invoices', 'value' => 92],
                ['label' => '/usage', 'value' => 68],
                ['label' => '/seats', 'value' => 47],
                ['label' => '/webhooks', 'value' => 23],
            ];

            $planCode = <<<'BLADE'
            <x-ui.animated-bar-chart class="max-w-sm" label-width="w-20" :items="[
                ['label' => 'Free', 'value' => 812],
                ['label' => 'Starter', 'value' => 431],
                ['label' => 'Scale', 'value' => 268, 'highlight' => true],
                ['label' => 'Enterprise', 'value' => 74],
            ]" />
            BLADE;

            $planVueCode = <<<'VUE'
            <UiAnimatedBarChart
                class="max-w-sm"
                label-width="w-20"
                :items="[
                    { label: 'Free', value: 812 },
                    { label: 'Starter', value: 431 },
                    { label: 'Scale', value: 268, highlight: true },
                    { label: 'Enterprise', value: 74 },
                ]"
            />
            VUE;

            $planReactCode = <<<'REACT'
            <UiAnimatedBarChart
                className="max-w-sm"
                labelWidth="w-20"
                items={[
                    { label: 'Free', value: 812 },
                    { label: 'Starter', value: 431 },
                    { label: 'Scale', value: 268, highlight: true },
                    { label: 'Enterprise', value: 74 },
                ]}
            />
            REACT;

            $endpointCode = <<<'BLADE'
            <x-ui.animated-bar-chart class="max-w-sm" label-width="w-24" :max="100" :duration="1400" :stagger="180" :items="$endpoints" />
            BLADE;

            $endpointVueCode = <<<'VUE'
            <UiAnimatedBarChart class="max-w-sm" label-width="w-24" :max="100" :duration="1400" :stagger="180" :items="endpoints" />
            VUE;

            $endpointReactCode = <<<'REACT'
            <UiAnimatedBarChart className="max-w-sm" labelWidth="w-24" max={100} duration={1400} stagger={180} items={endpoints} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Plan mix"
                description="Long labels need room — label-width takes any Tailwind width and keeps the bars aligned on one axis."
                :code="$planCode" :vue-code="$planVueCode" :react-code="$planReactCode">
                <x-ui.animated-bar-chart class="max-w-sm" label-width="w-20" :items="$plans" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Slower reveal"
                description="A fixed max of 100 turns the values into percentages of the track. Stretch duration and stagger when the chart is the thing you want people to watch."
                :code="$endpointCode" :vue-code="$endpointVueCode" :react-code="$endpointReactCode">
                <x-ui.animated-bar-chart class="max-w-sm" label-width="w-24" :max="100" :duration="1400" :stagger="180" :items="$endpoints" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="animated-bar-chart" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
