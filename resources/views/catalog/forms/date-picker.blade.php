<x-layout title="Date picker — BLADE-COMPONENTS">
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
                    A calendar in a fully styled panel — no native popup. The grid, month paging, and min/max bounds are a small script that ships inside the component; the value posts as YYYY-MM-DD through a hidden input.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicsCode = <<<'BLADE'
            <x-ui.date-picker label="Launch date" name="launch_date"
                value="2026-08-15" />
            BLADE;

            $rangeCode = <<<'BLADE'
            <x-ui.date-picker label="From" name="from"
                value="2026-08-01" max="2026-08-31" />
            <x-ui.date-picker label="To" name="to"
                value="2026-08-31" min="2026-08-01" />
            BLADE;

            $basicsVueCode = <<<'VUE'
            <UiDatePicker v-model="launchDate" label="Launch date" />
            VUE;

            $rangeVueCode = <<<'VUE'
            <UiDatePicker v-model="from" label="From" max="2026-08-31" />
            <UiDatePicker v-model="to" label="To" min="2026-08-01" />
            VUE;

            $basicsReactCode = <<<'REACT'
            <UiDatePicker label="Launch date" defaultValue="2026-08-15" />
            REACT;

            $rangeReactCode = <<<'REACT'
            <UiDatePicker label="From" defaultValue="2026-08-01" max="2026-08-31" />
            <UiDatePicker label="To" defaultValue="2026-08-31" min="2026-08-01" />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basics"
                description="Open the field for the calendar. Arrows page through months, Today jumps back, Clear empties the value."
                :code="$basicsCode" :vue-code="$basicsVueCode" :react-code="$basicsReactCode">
                <div class="flex min-h-[26rem] w-full justify-center">
                    <x-ui.date-picker label="Launch date" name="launch_date" value="2026-08-15" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Range with min and max"
                description="Two fields with min and max make a simple range — out-of-bounds days render dimmed and refuse the click."
                :code="$rangeCode" :vue-code="$rangeVueCode" :react-code="$rangeReactCode">
                <div class="flex min-h-[26rem] w-full flex-wrap items-start justify-center gap-3">
                    <x-ui.date-picker label="From" name="from" value="2026-08-01" max="2026-08-31" />
                    <x-ui.date-picker label="To" name="to" value="2026-08-31" min="2026-08-01" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="date-picker" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
