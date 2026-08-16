<x-layout title="Animated column chart — BLADE-COMPONENTS">
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
                    Columns scaled from a shared ceiling, growing in sequence. Heights are plain percentages in the markup, so the chart is already correct before a single frame runs — the animation only decides how it arrives.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $quarters = [
                ['label' => 'Q1', 'value' => 42],
                ['label' => 'Q2', 'value' => 61],
                ['label' => 'Q3', 'value' => 78, 'highlight' => true],
                ['label' => 'Q4', 'value' => 55],
            ];

            $signups = [
                ['label' => 'Mon', 'value' => 18],
                ['label' => 'Tue', 'value' => 32],
                ['label' => 'Wed', 'value' => 27],
                ['label' => 'Thu', 'value' => 44],
                ['label' => 'Fri', 'value' => 39],
                ['label' => 'Sat', 'value' => 12],
                ['label' => 'Sun', 'value' => 9],
            ];

            $quarterCode = <<<'BLADE'
            <x-ui.animated-column-chart class="max-w-sm" :items="[
                ['label' => 'Q1', 'value' => 42],
                ['label' => 'Q2', 'value' => 61],
                ['label' => 'Q3', 'value' => 78, 'highlight' => true],
                ['label' => 'Q4', 'value' => 55],
            ]" />
            BLADE;

            $quarterVueCode = <<<'VUE'
            <UiAnimatedColumnChart
                class="max-w-sm"
                :items="[
                    { label: 'Q1', value: 42 },
                    { label: 'Q2', value: 61 },
                    { label: 'Q3', value: 78, highlight: true },
                    { label: 'Q4', value: 55 },
                ]"
            />
            VUE;

            $quarterReactCode = <<<'REACT'
            <UiAnimatedColumnChart
                className="max-w-sm"
                items={[
                    { label: 'Q1', value: 42 },
                    { label: 'Q2', value: 61 },
                    { label: 'Q3', value: 78, highlight: true },
                    { label: 'Q4', value: 55 },
                ]}
            />
            REACT;

            $weekCode = <<<'BLADE'
            <x-ui.animated-column-chart class="max-w-md" height="h-28" :values="false" :max="50" :stagger="70" :items="$signups" />
            BLADE;

            $weekVueCode = <<<'VUE'
            <UiAnimatedColumnChart class="max-w-md" height="h-28" :values="false" :max="50" :stagger="70" :items="signups" />
            VUE;

            $weekReactCode = <<<'REACT'
            <UiAnimatedColumnChart className="max-w-md" height="h-28" values={false} max={50} stagger={70} items={signups} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Quarters"
                description="Mark one entry with highlight and it gets the solid fill while the rest stay dimmed — enough to point at a number without a legend. Values ride just above each column."
                :code="$quarterCode" :vue-code="$quarterVueCode" :react-code="$quarterReactCode">
                <x-ui.animated-column-chart class="max-w-sm" :items="$quarters" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Fixed ceiling"
                description="Pass max and the columns are measured against your scale instead of their own tallest bar, which is what you want when two charts sit side by side. Tighter stagger keeps a seven-day series from dragging."
                :code="$weekCode" :vue-code="$weekVueCode" :react-code="$weekReactCode">
                <x-ui.animated-column-chart class="max-w-md" height="h-28" :values="false" :max="50" :stagger="70" :items="$signups" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="animated-column-chart" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
