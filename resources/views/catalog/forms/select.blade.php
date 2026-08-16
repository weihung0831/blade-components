<x-layout title="Select — BLADE-COMPONENTS">
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
                    A select with a fully styled options panel — no native popup. A details element opens it; a few inline lines echo your pick and keep the form value in a radio group.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $regions = ['Taipei (TPE)', 'Tokyo (NRT)', 'Singapore (SIN)'];
            $plans = ['Pro plan', 'Team plan'];

            $variantsCode = <<<'BLADE'
            <x-ui.select name="region" placeholder="Choose a region"
                :options="['Taipei (TPE)', 'Tokyo (NRT)', 'Singapore (SIN)']" />

            <x-ui.select variant="filled" name="region" :options="…" />
            <x-ui.select variant="invalid" name="region" :options="…" />
            BLADE;

            $variantsVueCode = <<<'VUE'
            <UiSelect v-model="region" placeholder="Choose a region"
                :options="['Taipei (TPE)', 'Tokyo (NRT)', 'Singapore (SIN)']" />

            <UiSelect variant="filled" v-model="region" :options="…" />
            <UiSelect variant="invalid" v-model="region" :options="…" />
            VUE;

            $variantsReactCode = <<<'REACT'
            <UiSelect value={region} onChange={setRegion} placeholder="Choose a region"
                options={['Taipei (TPE)', 'Tokyo (NRT)', 'Singapore (SIN)']} />

            <UiSelect variant="filled" value={region} onChange={setRegion} options={…} />
            <UiSelect variant="invalid" value={region} onChange={setRegion} options={…} />
            REACT;

            $sizesCode = <<<'BLADE'
            <x-ui.select size="sm" :options="…" />
            <x-ui.select :options="…" />
            BLADE;

            $sizesJsCode = <<<'JS'
            <UiSelect size="sm" options={…} />
            <UiSelect options={…} />
            JS;

            $disabledCode = <<<'BLADE'
            <x-ui.select disabled value="Taipei (TPE)" :options="…" />
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiSelect disabled value="Taipei (TPE)" options={…} />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Outline is the default. Filled sits on a solid surface, invalid flags a validation error. Open one — the panel is the same ink surface as every other menu on this site."
                :code="$variantsCode" :vue-code="$variantsVueCode" :react-code="$variantsReactCode">
                <div class="flex min-h-52 w-full flex-wrap items-start justify-center gap-3">
                    <div class="w-44">
                        <x-ui.select name="region-outline" placeholder="Choose a region" :options="$regions" />
                    </div>
                    <div class="w-44">
                        <x-ui.select variant="filled" name="region-filled" placeholder="Choose a region" :options="$regions" />
                    </div>
                    <div class="w-44">
                        <x-ui.select variant="invalid" name="region-invalid" placeholder="Choose a region" :options="$regions" />
                    </div>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Sizes"
                description="Two heights via the size prop. Default is md."
                :code="$sizesCode" :vue-code="$sizesJsCode" :react-code="$sizesJsCode">
                <div class="flex min-h-36 w-full flex-wrap items-start justify-center gap-3">
                    <div class="w-40">
                        <x-ui.select size="sm" name="plan-sm" placeholder="Pick a plan" :options="$plans" />
                    </div>
                    <div class="w-40">
                        <x-ui.select name="plan-md" placeholder="Pick a plan" :options="$plans" />
                    </div>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Disabled"
                description="The disabled prop dims the control and drops pointer events."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <div class="w-44">
                    <x-ui.select disabled name="region-disabled" value="Taipei (TPE)" :options="$regions" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="select" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
