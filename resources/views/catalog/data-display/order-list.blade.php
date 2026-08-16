<x-layout title="Order list — BLADE-COMPONENTS">
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
                    A reorderable list. Click a row to select it, then nudge it up and down — the Blade version moves DOM nodes with one tiny delegated script.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.order-list :items="[
                'Hero section',
                'Features',
                'Pricing',
                'FAQ',
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiOrderList :items="[
                'Hero section',
                'Features',
                'Pricing',
                'FAQ',
            ]" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiOrderList items={[
                'Hero section',
                'Features',
                'Pricing',
                'FAQ',
            ]} />
            REACT;

            $extremesCode = <<<'BLADE'
            <x-ui.order-list extremes :selected="1" :items="[
                'Build',
                'Test',
                'Migrate',
                'Release',
                'Notify',
            ]" />
            BLADE;

            $extremesVueCode = <<<'VUE'
            <UiOrderList extremes :selected="1" :items="[
                'Build',
                'Test',
                'Migrate',
                'Release',
                'Notify',
            ]" />
            VUE;

            $extremesReactCode = <<<'REACT'
            <UiOrderList extremes selected={1} items={[
                'Build',
                'Test',
                'Migrate',
                'Release',
                'Notify',
            ]} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Up and Down swap the selected row with its neighbor. Handy for anything the customer sorts themselves, like landing page sections."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.order-list :items="['Hero section', 'Features', 'Pricing', 'FAQ']" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Top and bottom"
                description="The extremes prop adds jump-to-top and jump-to-bottom controls for longer lists like pipeline stages."
                :code="$extremesCode" :vue-code="$extremesVueCode" :react-code="$extremesReactCode">
                <x-ui.order-list extremes :selected="1" :items="['Build', 'Test', 'Migrate', 'Release', 'Notify']" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="order-list" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
