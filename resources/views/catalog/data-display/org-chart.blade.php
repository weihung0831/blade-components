<x-layout title="Org chart — BLADE-COMPONENTS">
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
                    A hierarchy drawn from nested data. Connector lines come from borders and pseudo-elements, so there is no canvas, no SVG layout, no JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicNode = [
                'label' => 'CTO',
                'children' => [
                    ['label' => 'Platform', 'children' => [
                        ['label' => 'SRE'],
                        ['label' => 'Core API'],
                    ]],
                    ['label' => 'Product', 'children' => [
                        ['label' => 'Billing'],
                    ]],
                ],
            ];

            $metaNode = [
                'label' => 'Mara Chen',
                'meta' => 'CEO',
                'children' => [
                    ['label' => 'Priya Nair', 'meta' => 'VP Engineering', 'tone' => 'jade', 'children' => [
                        ['label' => 'Sam Ortiz', 'meta' => 'Platform lead'],
                        ['label' => 'Ada Boone', 'meta' => 'Product lead'],
                    ]],
                    ['label' => 'Leo Marsh', 'meta' => 'VP Sales'],
                ],
            ];

            $basicCode = <<<'BLADE'
            <x-ui.org-chart :node="[
                'label' => 'CTO',
                'children' => [
                    ['label' => 'Platform', 'children' => [
                        ['label' => 'SRE'],
                        ['label' => 'Core API'],
                    ]],
                    ['label' => 'Product'],
                ],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiOrgChart :node="{
                label: 'CTO',
                children: [
                    { label: 'Platform', children: [
                        { label: 'SRE' },
                        { label: 'Core API' },
                    ] },
                    { label: 'Product' },
                ],
            }" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiOrgChart node={{
                label: 'CTO',
                children: [
                    { label: 'Platform', children: [
                        { label: 'SRE' },
                        { label: 'Core API' },
                    ] },
                    { label: 'Product' },
                ],
            }} />
            REACT;

            $metaCode = <<<'BLADE'
            <x-ui.org-chart :node="[
                'label' => 'Mara Chen',
                'meta' => 'CEO',
                'children' => [
                    ['label' => 'Priya Nair', 'meta' => 'VP Engineering', 'tone' => 'jade', 'children' => [
                        ['label' => 'Sam Ortiz', 'meta' => 'Platform lead'],
                        ['label' => 'Ada Boone', 'meta' => 'Product lead'],
                    ]],
                    ['label' => 'Leo Marsh', 'meta' => 'VP Sales'],
                ],
            ]" />
            BLADE;

            $metaVueCode = <<<'VUE'
            <UiOrgChart :node="{
                label: 'Mara Chen',
                meta: 'CEO',
                children: [
                    { label: 'Priya Nair', meta: 'VP Engineering', tone: 'jade', children: [
                        { label: 'Sam Ortiz', meta: 'Platform lead' },
                        { label: 'Ada Boone', meta: 'Product lead' },
                    ] },
                    { label: 'Leo Marsh', meta: 'VP Sales' },
                ],
            }" />
            VUE;

            $metaReactCode = <<<'REACT'
            <UiOrgChart node={{
                label: 'Mara Chen',
                meta: 'CEO',
                children: [
                    { label: 'Priya Nair', meta: 'VP Engineering', tone: 'jade', children: [
                        { label: 'Sam Ortiz', meta: 'Platform lead' },
                        { label: 'Ada Boone', meta: 'Product lead' },
                    ] },
                    { label: 'Leo Marsh', meta: 'VP Sales' },
                ],
            }} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="One nested node prop. The root gets the jade accent; every level below connects through hairline borders."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.org-chart :node="$basicNode" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Roles and highlights"
                description="Add meta for a second line per box, and tone: jade to call out a branch — say, the team that owns the current escalation."
                :code="$metaCode" :vue-code="$metaVueCode" :react-code="$metaReactCode">
                <x-ui.org-chart :node="$metaNode" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="org-chart" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
