@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/analytics/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/analytics/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/analytics/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $demoCohort = [
        ['label' => 'w/c 21 Jul', 'size' => '18,240', 'values' => [100, 47, 33, 28, 25, 23]],
        ['label' => 'w/c 28 Jul', 'size' => '19,106', 'values' => [100, 49, 35, 30, 27, null]],
        ['label' => 'w/c 4 Aug', 'size' => '20,884', 'values' => [100, 52, 38, 32, null, null]],
        ['label' => 'w/c 11 Aug', 'size' => '23,691', 'values' => [100, 56, 41, null, null, null]],
    ];

    $demoSeries = [
        [
            'label' => 'checkout_started',
            'area' => true,
            'points' => [
                '7d' => [54, 63, 58, 71, 41, 36, 67],
                '28d' => [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74],
                '90d' => [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76],
            ],
        ],
        [
            'label' => 'order_paid',
            'muted' => true,
            'dashed' => true,
            'points' => [
                '7d' => [23, 27, 25, 31, 17, 14, 29],
                '28d' => [16, 19, 18, 22, 20, 24, 21, 27, 25, 29, 27, 31, 30, 35, 33],
                '90d' => [9, 12, 11, 15, 13, 17, 19, 17, 22, 25, 27, 31, 34],
            ],
        ],
    ];

    $demoAxis = [
        '7d' => ['11 Aug', '12', '13', '14', '15', '16', '17'],
        '28d' => ['21 Jul', '28 Jul', '4 Aug', '11 Aug', '17 Aug'],
        '90d' => ['20 May', 'Jun', 'Jul', 'Aug'],
    ];

    $demoScale = [
        '7d' => ['6k', '4k', '2k', '0'],
        '28d' => ['6k', '4k', '2k', '0'],
        '90d' => ['9k', '6k', '3k', '0'],
    ];

    $rangeCode = <<<'BLADE'
    <div class="group/shell" data-range="28d">
        <button type="button" data-range-set="7d"
            class="rounded-md px-2 py-1 text-zinc-500 group-data-[range=7d]/shell:bg-jade-500/15 group-data-[range=7d]/shell:text-jade-300">7d</button>
        <button type="button" data-range-set="28d"
            class="rounded-md px-2 py-1 text-zinc-500 group-data-[range=28d]/shell:bg-jade-500/15 group-data-[range=28d]/shell:text-jade-300">28d</button>

        <p class="text-2xl font-semibold text-cream">
            <span class="hidden group-data-[range=7d]/shell:inline">31,904</span>
            <span class="hidden group-data-[range=28d]/shell:inline">128,410</span>
        </p>
    </div>

    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-range-set]');

            if (button) {
                button.closest('[data-range]').dataset.range = button.dataset.rangeSet;
            }
        });
    </script>
    BLADE;

    $rangeVueCode = <<<'VUE'
    <script setup>
    import { ref } from 'vue';

    const range = ref('28d');
    </script>

    <template>
        <div class="group/shell" :data-range="range">
            <button v-for="option in ['7d', '28d', '90d']" :key="option" type="button" @click="range = option"
                class="rounded-md px-2 py-1 transition-colors duration-150"
                :class="range === option ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-500 hover:text-cream'">{{ option }}</button>

            <p class="text-2xl font-semibold text-cream">
                <span class="hidden group-data-[range=7d]/shell:inline">31,904</span>
                <span class="hidden group-data-[range=28d]/shell:inline">128,410</span>
            </p>
        </div>
    </template>
    VUE;

    $rangeReactCode = <<<'REACT'
    const [range, setRange] = useState('28d');

    return (
        <div className="group/shell" data-range={range}>
            {['7d', '28d', '90d'].map((option) => (
                <button key={option} type="button" onClick={() => setRange(option)}
                    className={`rounded-md px-2 py-1 transition-colors duration-150 ${range === option ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-500 hover:text-cream'}`}>
                    {option}
                </button>
            ))}

            <p className="text-2xl font-semibold text-cream">
                <span className="hidden group-data-[range=7d]/shell:inline">31,904</span>
                <span className="hidden group-data-[range=28d]/shell:inline">128,410</span>
            </p>
        </div>
    );
    REACT;

    $metricCode = <<<'BLADE'
    <x-templates.analytics.metric label="Checkouts started"
        :values="['7d' => '31,904', '28d' => '128,410', '90d' => '402,180']"
        :deltas="['7d' => '+12.4% vs prior 7d', '28d' => '+18.9% vs prior 28d', '90d' => '+41.2% vs prior 90d']"
        :spark="[
            '7d' => [54, 63, 58, 71, 41, 36, 67],
            '28d' => [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74],
            '90d' => [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76],
        ]" />
    BLADE;

    $metricVueCode = <<<'VUE'
    <AnalyticsMetric
        label="Checkouts started"
        :values="{ '7d': '31,904', '28d': '128,410', '90d': '402,180' }"
        :deltas="{ '7d': '+12.4% vs prior 7d', '28d': '+18.9% vs prior 28d', '90d': '+41.2% vs prior 90d' }"
        :spark="{
            '7d': [54, 63, 58, 71, 41, 36, 67],
            '28d': [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74],
            '90d': [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76],
        }"
    />
    VUE;

    $metricReactCode = <<<'REACT'
    <AnalyticsMetric
        label="Checkouts started"
        values={{ '7d': '31,904', '28d': '128,410', '90d': '402,180' }}
        deltas={{ '7d': '+12.4% vs prior 7d', '28d': '+18.9% vs prior 28d', '90d': '+41.2% vs prior 90d' }}
        spark={{
            '7d': [54, 63, 58, 71, 41, 36, 67],
            '28d': [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74],
            '90d': [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76],
        }}
    />
    REACT;

    $seriesCode = <<<'BLADE'
    <x-templates.analytics.series height="h-56"
        :series="[
            ['label' => 'checkout_started', 'area' => true, 'points' => ['28d' => [38, 44, 41, 52, 47, 55, 49, 61]]],
            ['label' => 'order_paid', 'muted' => true, 'dashed' => true, 'points' => ['28d' => [16, 19, 18, 22, 20, 24, 21, 27]]],
        ]"
        :axis="['28d' => ['21 Jul', '28 Jul', '4 Aug', '11 Aug', '17 Aug']]"
        :scale="['28d' => ['6k', '4k', '2k', '0']]" />
    BLADE;

    $seriesVueCode = <<<'VUE'
    <AnalyticsSeries
        height="h-56"
        :series="[
            { label: 'checkout_started', area: true, points: { '28d': [38, 44, 41, 52, 47, 55, 49, 61] } },
            { label: 'order_paid', muted: true, dashed: true, points: { '28d': [16, 19, 18, 22, 20, 24, 21, 27] } },
        ]"
        :axis="{ '28d': ['21 Jul', '28 Jul', '4 Aug', '11 Aug', '17 Aug'] }"
        :scale="{ '28d': ['6k', '4k', '2k', '0'] }"
    />
    VUE;

    $seriesReactCode = <<<'REACT'
    <AnalyticsSeries
        height="h-56"
        series={[
            { label: 'checkout_started', area: true, points: { '28d': [38, 44, 41, 52, 47, 55, 49, 61] } },
            { label: 'order_paid', muted: true, dashed: true, points: { '28d': [16, 19, 18, 22, 20, 24, 21, 27] } },
        ]}
        axis={{ '28d': ['21 Jul', '28 Jul', '4 Aug', '11 Aug', '17 Aug'] }}
        scale={{ '28d': ['6k', '4k', '2k', '0'] }}
    />
    REACT;

    $cohortCode = <<<'BLADE'
    <x-templates.analytics.cohort
        :columns="['d0', 'd1', 'd7', 'd14', 'd21', 'd28']"
        :rows="[
            ['label' => 'w/c 21 Jul', 'size' => '18,240', 'values' => [100, 47, 33, 28, 25, 23]],
            ['label' => 'w/c 28 Jul', 'size' => '19,106', 'values' => [100, 49, 35, 30, 27, null]],
        ]" />
    BLADE;

    $cohortVueCode = <<<'VUE'
    <AnalyticsCohort
        :columns="['d0', 'd1', 'd7', 'd14', 'd21', 'd28']"
        :rows="[
            { label: 'w/c 21 Jul', size: '18,240', values: [100, 47, 33, 28, 25, 23] },
            { label: 'w/c 28 Jul', size: '19,106', values: [100, 49, 35, 30, 27, null] },
        ]"
    />
    VUE;

    $cohortReactCode = <<<'REACT'
    <AnalyticsCohort
        columns={['d0', 'd1', 'd7', 'd14', 'd21', 'd28']}
        rows={[
            { label: 'w/c 21 Jul', size: '18,240', values: [100, 47, 33, 28, 25, 23] },
            { label: 'w/c 28 Jul', size: '19,106', values: [100, 49, 35, 30, 27, null] },
        ]}
    />
    REACT;

    $tokenCode = <<<'BLADE'
    <x-templates.analytics.token type="event" label="checkout_started" :removable="false" />
    <x-templates.analytics.token type="where" label="plan" value="is any of Scale, Launch, Enterprise" />
    <x-templates.analytics.token type="by" label="plan" />
    BLADE;

    $tokenVueCode = <<<'VUE'
    <AnalyticsToken type="event" label="checkout_started" :removable="false" />
    <AnalyticsToken type="where" label="plan" value="is any of Scale, Launch, Enterprise" />
    <AnalyticsToken type="by" label="plan" />
    VUE;

    $tokenReactCode = <<<'REACT'
    <AnalyticsToken type="event" label="checkout_started" removable={false} />
    <AnalyticsToken type="where" label="plan" value="is any of Scale, Launch, Enterprise" />
    <AnalyticsToken type="by" label="plan" />
    REACT;
@endphp

<x-layout title="Analytics template — BLADE-COMPONENTS">
    <div class="mx-auto max-w-6xl px-6 py-16 pb-28">

        <a href="{{ route('templates') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Templates
        </a>

        <div class="rise mt-5 flex flex-wrap items-end justify-between gap-4" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Template</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $template['name'] }}</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    <span class="text-zinc-300">Lens</span> is the product analytics side of wharf: events, not page views.
                    Four screens for the four questions anyone actually opens an analytics tool to ask — what happened, where it stopped, who came back, and what is happening now.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $template['pages']) }} screens</span>
        </div>

        <nav class="rise sticky top-14 z-30 -mx-6 mt-8 border-y border-white/5 bg-ink-950/85 px-6 py-2.5 backdrop-blur" style="animation-delay: 120ms">
            <ul class="flex flex-wrap items-center gap-1 text-sm">
                @foreach ($screens as $screen)
                    <li>
                        <a href="#{{ $screen['slug'] }}" data-spy-link
                            class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">{{ $screen['name'] }}</a>
                    </li>
                @endforeach
                <li class="ml-auto flex items-center gap-1">
                    <a href="#blocks" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Blocks</a>
                    <a href="#install" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Installation</a>
                </li>
            </ul>
        </nav>

        <section class="mt-10">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Screens</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Live, not screenshots. Flip 7d / 28d / 90d in any of them and the charts, tables, cohort grouping, and the SQL all follow.</p>

            <div class="mt-6 flex flex-col gap-10">
                @foreach ($screens as $screen)
                    <x-screen-preview
                        :id="$screen['slug']"
                        data-spy-section
                        class="scroll-mt-32"
                        :title="$screen['name']"
                        :description="$screen['description']"
                        :href="route('templates.screen', [$template['slug'], $screen['slug']])"
                        :panels="$sourcesFor($screen['slug'])">
                        <x-dynamic-component :component="'templates.'.$template['slug'].'.'.$screen['slug']" />
                    </x-screen-preview>
                @endforeach
            </div>
        </section>

        <section id="blocks" data-spy-section class="mt-16 scroll-mt-32">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Blocks</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Five parts, and the four screens are assembled from them. The range lives on the shell, so anything inside it reads the same switch.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Range switch" padding="p-8"
                    description="One data attribute on the shell. Every value, axis label, and chart path inside reads it through a named group, so nothing is recomputed in JavaScript and the markup stays legible."
                    :code="$rangeCode" :vue-code="$rangeVueCode" :react-code="$rangeReactCode">
                    <div class="group/shell flex w-full max-w-sm flex-col items-center gap-6" data-range="28d">
                        <div class="inline-flex items-center rounded-lg border border-white/10 bg-ink-950 p-0.5 font-mono text-[11px]">
                            <button type="button" data-range-set="7d"
                                class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 group-data-[range=7d]/shell:bg-jade-500/15 group-data-[range=7d]/shell:text-jade-300 hover:text-cream">7d</button>
                            <button type="button" data-range-set="28d"
                                class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 group-data-[range=28d]/shell:bg-jade-500/15 group-data-[range=28d]/shell:text-jade-300 hover:text-cream">28d</button>
                            <button type="button" data-range-set="90d"
                                class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 group-data-[range=90d]/shell:bg-jade-500/15 group-data-[range=90d]/shell:text-jade-300 hover:text-cream">90d</button>
                        </div>

                        <div class="w-full max-w-[15rem]">
                            <x-templates.analytics.metric label="Checkouts started"
                                :values="['7d' => '31,904', '28d' => '128,410', '90d' => '402,180']"
                                :deltas="['7d' => '+12.4% vs prior 7d', '28d' => '+18.9% vs prior 28d', '90d' => '+41.2% vs prior 90d']"
                                :spark="[
                                    '7d' => [54, 63, 58, 71, 41, 36, 67],
                                    '28d' => [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74],
                                    '90d' => [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76],
                                ]" />
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Metric tile" padding="p-8"
                    description="A label, one value per range, the delta that goes with it, and a sparkline drawn from the same numbers. Values are strings — the tile never formats anything, so 4m 06s sits where 128,410 does."
                    :code="$metricCode" :vue-code="$metricVueCode" :react-code="$metricReactCode">
                    <div class="group/shell w-full max-w-xs" data-range="28d">
                        <x-templates.analytics.metric label="Checkouts started"
                            :values="['7d' => '31,904', '28d' => '128,410', '90d' => '402,180']"
                            :deltas="['7d' => '+12.4% vs prior 7d', '28d' => '+18.9% vs prior 28d', '90d' => '+41.2% vs prior 90d']"
                            :spark="[
                                '7d' => [54, 63, 58, 71, 41, 36, 67],
                                '28d' => [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74],
                                '90d' => [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76],
                            ]" />
                    </div>
                </x-demo>

                <x-demo title="Query token" padding="p-8"
                    description="The query is a row of these, not a modal. The prefix says what kind of clause it is, the value reads as English, and the whole thing is one span with a button in it."
                    :code="$tokenCode" :vue-code="$tokenVueCode" :react-code="$tokenReactCode">
                    <div class="flex flex-wrap items-center justify-center gap-2">
                        <x-templates.analytics.token type="event" label="checkout_started" :removable="false" />
                        <x-templates.analytics.token type="where" label="plan" value="is any of Scale, Launch, Enterprise" />
                        <x-templates.analytics.token type="by" label="plan" />
                    </div>
                </x-demo>

                <x-demo title="Series chart" padding="p-8"
                    description="Plain SVG on a 0–100 viewBox, one path per line per range. Strokes keep their width through the stretch because of vector-effect, and the grid is four divs behind it."
                    :code="$seriesCode" :vue-code="$seriesVueCode" :react-code="$seriesReactCode">
                    <div class="group/shell w-full rounded-xl border border-white/8 bg-ink-800 p-5" data-range="28d">
                        <x-templates.analytics.series :series="$demoSeries" :axis="$demoAxis" :scale="$demoScale" height="h-48" />
                    </div>
                </x-demo>

                <x-demo title="Cohort grid" padding="p-8"
                    description="Retention as a heat map: the cell paints one jade layer at an opacity taken from the value, and the label flips to dark once the cell is bright enough to need it. A null is a cell that has not happened yet."
                    :code="$cohortCode" :vue-code="$cohortVueCode" :react-code="$cohortReactCode">
                    <div class="w-full rounded-xl border border-white/8 bg-ink-800 p-5">
                        <x-templates.analytics.cohort :columns="['d0', 'd1', 'd7', 'd14', 'd21', 'd28']" :rows="$demoCohort" />
                    </div>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[['slug' => 'shell', 'name' => 'Lens shell'], ['slug' => 'metric', 'name' => 'Metric tile'], ['slug' => 'series', 'name' => 'Series chart'], ['slug' => 'cohort', 'name' => 'Cohort grid'], ['slug' => 'token', 'name' => 'Query token']]"
            description="Every screen carries its own source under its preview. These five are what all four share — the shell owns the range, so paste it first."
            :components="['button', 'select', 'card', 'avatar', 'dropdown', 'scroll-top']" />
    </div>
</x-layout>
