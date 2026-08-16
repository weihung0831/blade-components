<x-layout title="Tree — BLADE-COMPONENTS">
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
                    Nested data rendered as a collapsible tree. Branches are native details elements, so the Blade version needs no JavaScript at all.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicNodes = [
                ['label' => 'Production', 'open' => true, 'children' => [
                    ['label' => 'web-01'],
                    ['label' => 'web-02'],
                    ['label' => 'worker-01'],
                ]],
                ['label' => 'Staging', 'children' => [
                    ['label' => 'web-01'],
                ]],
                ['label' => 'Preview', 'children' => [
                    ['label' => 'pr-482'],
                    ['label' => 'pr-497'],
                ]],
            ];

            $activeNodes = [
                ['label' => 'Acme Corp', 'open' => true, 'children' => [
                    ['label' => 'Billing', 'open' => true, 'children' => [
                        ['label' => 'Invoices', 'active' => true],
                        ['label' => 'Payment methods'],
                    ]],
                    ['label' => 'Members'],
                    ['label' => 'API tokens'],
                ]],
            ];

            $basicCode = <<<'BLADE'
            <x-ui.tree :nodes="[
                ['label' => 'Production', 'open' => true, 'children' => [
                    ['label' => 'web-01'],
                    ['label' => 'web-02'],
                    ['label' => 'worker-01'],
                ]],
                ['label' => 'Staging', 'children' => [
                    ['label' => 'web-01'],
                ]],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiTree :nodes="[
                { label: 'Production', open: true, children: [
                    { label: 'web-01' },
                    { label: 'web-02' },
                    { label: 'worker-01' },
                ] },
                { label: 'Staging', children: [
                    { label: 'web-01' },
                ] },
            ]" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiTree nodes={[
                { label: 'Production', open: true, children: [
                    { label: 'web-01' },
                    { label: 'web-02' },
                    { label: 'worker-01' },
                ] },
                { label: 'Staging', children: [
                    { label: 'web-01' },
                ] },
            ]} />
            REACT;

            $activeCode = <<<'BLADE'
            <x-ui.tree :nodes="[
                ['label' => 'Acme Corp', 'open' => true, 'children' => [
                    ['label' => 'Billing', 'open' => true, 'children' => [
                        ['label' => 'Invoices', 'active' => true],
                        ['label' => 'Payment methods'],
                    ]],
                    ['label' => 'Members'],
                ]],
            ]" />
            BLADE;

            $activeVueCode = <<<'VUE'
            <UiTree :nodes="[
                { label: 'Acme Corp', open: true, children: [
                    { label: 'Billing', open: true, children: [
                        { label: 'Invoices', active: true },
                        { label: 'Payment methods' },
                    ] },
                    { label: 'Members' },
                ] },
            ]" />
            VUE;

            $activeReactCode = <<<'REACT'
            <UiTree nodes={[
                { label: 'Acme Corp', open: true, children: [
                    { label: 'Billing', open: true, children: [
                        { label: 'Invoices', active: true },
                        { label: 'Payment methods' },
                    ] },
                    { label: 'Members' },
                ] },
            ]} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Pass nodes as a nested array. Any node with children becomes a branch; open: true expands it on load."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.tree class="w-48" :nodes="$basicNodes" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Active leaf"
                description="Mark a leaf with active: true to highlight the current selection, the way a settings sidebar would."
                :code="$activeCode" :vue-code="$activeVueCode" :react-code="$activeReactCode">
                <x-ui.tree class="w-48" :nodes="$activeNodes" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="tree" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
