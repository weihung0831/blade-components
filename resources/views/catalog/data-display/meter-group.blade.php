<x-layout title="Meter group — BLADE-COMPONENTS">
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
                    A stacked bar and legend rendered from one segments array. Add a label and total to turn it into a quota readout.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.meter-group class="w-72" :segments="[
                ['label' => 'Production', 'value' => 62, 'color' => 'jade'],
                ['label' => 'Staging', 'value' => 23, 'color' => 'mint'],
                ['label' => 'Preview', 'value' => 9, 'color' => 'zinc'],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiMeterGroup class="w-72" :segments="[
                { label: 'Production', value: 62, color: 'jade' },
                { label: 'Staging', value: 23, color: 'mint' },
                { label: 'Preview', value: 9, color: 'zinc' },
            ]" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiMeterGroup className="w-72" segments={[
                { label: 'Production', value: 62, color: 'jade' },
                { label: 'Staging', value: 23, color: 'mint' },
                { label: 'Preview', value: 9, color: 'zinc' },
            ]} />
            REACT;

            $quotaCode = <<<'BLADE'
            <x-ui.meter-group
                class="w-72"
                label="Storage"
                total="14.2 GB of 20 GB"
                :max="20"
                unit="GB"
                :segments="[
                    ['label' => 'Databases', 'value' => 8.4, 'color' => 'jade'],
                    ['label' => 'Backups', 'value' => 4.1, 'color' => 'mint'],
                    ['label' => 'Logs', 'value' => 1.7, 'color' => 'zinc'],
                ]"
            />
            BLADE;

            $quotaVueCode = <<<'VUE'
            <UiMeterGroup
                class="w-72"
                label="Storage"
                total="14.2 GB of 20 GB"
                :max="20"
                unit="GB"
                :segments="[
                    { label: 'Databases', value: 8.4, color: 'jade' },
                    { label: 'Backups', value: 4.1, color: 'mint' },
                    { label: 'Logs', value: 1.7, color: 'zinc' },
                ]"
            />
            VUE;

            $quotaReactCode = <<<'REACT'
            <UiMeterGroup
                className="w-72"
                label="Storage"
                total="14.2 GB of 20 GB"
                max={20}
                unit="GB"
                segments={[
                    { label: 'Databases', value: 8.4, color: 'jade' },
                    { label: 'Backups', value: 4.1, color: 'mint' },
                    { label: 'Logs', value: 1.7, color: 'zinc' },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Each segment carries a label, a value, and a color. Bar widths and the legend both come from the same array."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.meter-group class="w-72" :segments="[
                    ['label' => 'Production', 'value' => 62, 'color' => 'jade'],
                    ['label' => 'Staging', 'value' => 23, 'color' => 'mint'],
                    ['label' => 'Preview', 'value' => 9, 'color' => 'zinc'],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Quota"
                description="Set max and unit for real units instead of percentages, plus a label and total for the header row."
                :code="$quotaCode" :vue-code="$quotaVueCode" :react-code="$quotaReactCode">
                <x-ui.meter-group
                    class="w-72"
                    label="Storage"
                    total="14.2 GB of 20 GB"
                    :max="20"
                    unit="GB"
                    :segments="[
                        ['label' => 'Databases', 'value' => 8.4, 'color' => 'jade'],
                        ['label' => 'Backups', 'value' => 4.1, 'color' => 'mint'],
                        ['label' => 'Logs', 'value' => 1.7, 'color' => 'zinc'],
                    ]"
                />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="meter-group" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
