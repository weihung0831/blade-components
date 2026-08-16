<x-layout title="Cascade select — BLADE-COMPONENTS">
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
                    Grouped options in flyout panels. Native details elements handle the opening; a few inline lines echo your pick into the trigger.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.cascade-select
                name="country"
                placeholder="Choose a country"
                :options="[
                    'Europe' => ['Germany', 'France', 'Portugal'],
                    'Asia' => ['Japan', 'Taiwan', 'Singapore'],
                    'Americas' => ['Brazil', 'Canada'],
                ]"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiCascadeSelect
                v-model="country"
                placeholder="Choose a country"
                :options="{
                    Europe: ['Germany', 'France', 'Portugal'],
                    Asia: ['Japan', 'Taiwan', 'Singapore'],
                    Americas: ['Brazil', 'Canada'],
                }"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiCascadeSelect
                placeholder="Choose a country"
                onChange={(country) => setCountry(country)}
                options={{
                    Europe: ['Germany', 'France', 'Portugal'],
                    Asia: ['Japan', 'Taiwan', 'Singapore'],
                    Americas: ['Brazil', 'Canada'],
                }}
            />
            REACT;

            $disabledCode = <<<'BLADE'
            <x-ui.cascade-select disabled value="Taiwan" :options="[…]" />
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiCascadeSelect disabled placeholder="Taiwan" options={…} />
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Open the trigger, hover a group, pick a leaf. The submenu flies out from the side and only one group stays open at a time."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex h-72 w-64 items-start justify-center pt-2">
                    <x-ui.cascade-select class="w-52" name="country" placeholder="Choose a country" :options="[
                        'Europe' => ['Germany', 'France', 'Portugal'],
                        'Asia' => ['Japan', 'Taiwan', 'Singapore'],
                        'Americas' => ['Brazil', 'Canada'],
                    ]" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Disabled"
                description="The disabled prop dims the control and drops pointer events."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <x-ui.cascade-select class="w-52" disabled name="country-disabled" value="Taiwan" :options="[
                    'Asia' => ['Japan', 'Taiwan', 'Singapore'],
                ]" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="cascade-select" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
