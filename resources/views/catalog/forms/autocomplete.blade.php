<x-layout title="Autocomplete — BLADE-COMPONENTS">
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
                    Type-ahead suggestions in a fully styled panel — no native popup. A small inline script filters the list as you type.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.autocomplete
                name="package"
                placeholder="Search packages…"
                :options="['Laravel', 'Larastan', 'Laracon', 'Livewire', 'Lumen']"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiAutocomplete
                v-model="package"
                placeholder="Search packages…"
                :options="['Laravel', 'Larastan', 'Laracon', 'Livewire', 'Lumen']"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiAutocomplete
                value={pkg}
                onChange={setPkg}
                placeholder="Search packages…"
                options={['Laravel', 'Larastan', 'Laracon', 'Livewire', 'Lumen']}
            />
            REACT;

            $filledCode = <<<'BLADE'
            <x-ui.autocomplete
                variant="filled"
                placeholder="Assign to…"
                :options="['Ava Chen', 'Noah Lin', 'Mia Wang']"
            />
            BLADE;

            $filledVueCode = <<<'VUE'
            <UiAutocomplete
                variant="filled"
                placeholder="Assign to…"
                :options="['Ava Chen', 'Noah Lin', 'Mia Wang']"
            />
            VUE;

            $filledReactCode = <<<'REACT'
            <UiAutocomplete
                variant="filled"
                placeholder="Assign to…"
                options={['Ava Chen', 'Noah Lin', 'Mia Wang']}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Focus the field to see every option; keep typing and the panel narrows to matches. Click one to fill the input."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="flex min-h-64 w-full justify-center">
                    <div class="w-56">
                        <x-ui.autocomplete name="package" placeholder="Search packages…"
                            :options="['Laravel', 'Larastan', 'Laracon', 'Livewire', 'Lumen']" />
                    </div>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Filled"
                description="The filled variant trades the border for a solid surface."
                :code="$filledCode" :vue-code="$filledVueCode" :react-code="$filledReactCode">
                <div class="flex min-h-48 w-full justify-center">
                    <div class="w-56">
                        <x-ui.autocomplete variant="filled" name="assignee" placeholder="Assign to…"
                            :options="['Ava Chen', 'Noah Lin', 'Mia Wang']" />
                    </div>
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="autocomplete" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
