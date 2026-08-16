<x-layout title="Toggle button — BLADE-COMPONENTS">
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
                    A checkbox or radio wearing a button. Checked state gets the jade treatment; swap the type prop to make a group exclusive.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.toggle-button checked>Bookmarked</x-ui.toggle-button>
            <x-ui.toggle-button>Watch</x-ui.toggle-button>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiToggleButton v-model="bookmarked">Bookmarked</UiToggleButton>
            <UiToggleButton v-model="watching">Watch</UiToggleButton>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiToggleButton defaultChecked>Bookmarked</UiToggleButton>
            <UiToggleButton>Watch</UiToggleButton>
            REACT;

            $groupCode = <<<'BLADE'
            <x-ui.toggle-button type="radio" name="interval" value="day" checked>Day</x-ui.toggle-button>
            <x-ui.toggle-button type="radio" name="interval" value="week">Week</x-ui.toggle-button>
            <x-ui.toggle-button type="radio" name="interval" value="month">Month</x-ui.toggle-button>
            BLADE;

            $groupVueCode = <<<'VUE'
            <UiToggleButton v-model="interval" type="radio" value="day">Day</UiToggleButton>
            <UiToggleButton v-model="interval" type="radio" value="week">Week</UiToggleButton>
            <UiToggleButton v-model="interval" type="radio" value="month">Month</UiToggleButton>
            VUE;

            $groupReactCode = <<<'REACT'
            <UiToggleButton type="radio" name="interval" value="day" defaultChecked>Day</UiToggleButton>
            <UiToggleButton type="radio" name="interval" value="week">Week</UiToggleButton>
            <UiToggleButton type="radio" name="interval" value="month">Month</UiToggleButton>
            REACT;

            $sizesCode = <<<'BLADE'
            <x-ui.toggle-button size="sm" checked>Starred</x-ui.toggle-button>
            <x-ui.toggle-button checked>Starred</x-ui.toggle-button>
            BLADE;

            $sizesJsCode = <<<'JS'
            <UiToggleButton size="sm" defaultChecked>Starred</UiToggleButton>
            <UiToggleButton defaultChecked>Starred</UiToggleButton>
            JS;

            $disabledCode = <<<'BLADE'
            <x-ui.toggle-button disabled>Archive</x-ui.toggle-button>
            <x-ui.toggle-button checked disabled>Pinned</x-ui.toggle-button>
            BLADE;

            $disabledJsCode = <<<'JS'
            <UiToggleButton disabled>Archive</UiToggleButton>
            <UiToggleButton defaultChecked disabled>Pinned</UiToggleButton>
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Each button toggles independently — it's a hidden checkbox, so it posts with the form."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.toggle-button checked>Bookmarked</x-ui.toggle-button>
                <x-ui.toggle-button>Watch</x-ui.toggle-button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Exclusive group"
                description="Set type=radio and share a name — the browser keeps exactly one pressed."
                :code="$groupCode" :vue-code="$groupVueCode" :react-code="$groupReactCode">
                <x-ui.toggle-button type="radio" name="interval" value="day" checked>Day</x-ui.toggle-button>
                <x-ui.toggle-button type="radio" name="interval" value="week">Week</x-ui.toggle-button>
                <x-ui.toggle-button type="radio" name="interval" value="month">Month</x-ui.toggle-button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Sizes"
                description="Two sizes via the size prop, matching the button scale."
                :code="$sizesCode" :vue-code="$sizesJsCode" :react-code="$sizesJsCode">
                <x-ui.toggle-button size="sm" checked>Starred</x-ui.toggle-button>
                <x-ui.toggle-button checked>Starred</x-ui.toggle-button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Disabled"
                description="Standard disabled attribute — pressed or not, the button dims and ignores clicks."
                :code="$disabledCode" :vue-code="$disabledJsCode" :react-code="$disabledJsCode">
                <x-ui.toggle-button disabled>Archive</x-ui.toggle-button>
                <x-ui.toggle-button checked disabled>Pinned</x-ui.toggle-button>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="toggle-button" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
