<x-layout title="Breadcrumb — BLADE-COMPONENTS">
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
                    The trail back up the hierarchy. Pass an array, get a semantic ol with the last crumb marked as the current page. Drop the href on a crumb and it renders as plain text — useful for a collapsed middle.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.breadcrumb :items="[
                ['label' => 'Workspaces', 'href' => '#'],
                ['label' => 'acme-production', 'href' => '#'],
                ['label' => 'Environments', 'href' => '#'],
                ['label' => 'Staging'],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiBreadcrumb
                :items="[
                    { label: 'Workspaces', href: '#' },
                    { label: 'acme-production', href: '#' },
                    { label: 'Environments', href: '#' },
                    { label: 'Staging' },
                ]"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiBreadcrumb
                items={[
                    { label: 'Workspaces', href: '#' },
                    { label: 'acme-production', href: '#' },
                    { label: 'Environments', href: '#' },
                    { label: 'Staging' },
                ]}
            />
            REACT;

            $collapsedCode = <<<'BLADE'
            <x-ui.breadcrumb separator="slash" home="#" :items="[
                ['label' => 'Billing', 'href' => '#'],
                ['label' => '…'],
                ['label' => 'Invoice INV-2049'],
            ]" />
            BLADE;

            $collapsedVueCode = <<<'VUE'
            <UiBreadcrumb
                separator="slash"
                home="#"
                :items="[
                    { label: 'Billing', href: '#' },
                    { label: '…' },
                    { label: 'Invoice INV-2049' },
                ]"
            />
            VUE;

            $collapsedReactCode = <<<'REACT'
            <UiBreadcrumb
                separator="slash"
                home="#"
                items={[
                    { label: 'Billing', href: '#' },
                    { label: '…' },
                    { label: 'Invoice INV-2049' },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Chevrons by default. Every crumb but the last is a link; the last one carries aria-current=page."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.breadcrumb :items="[
                    ['label' => 'Workspaces', 'href' => '#'],
                    ['label' => 'acme-production', 'href' => '#'],
                    ['label' => 'Environments', 'href' => '#'],
                    ['label' => 'Staging'],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Home icon and a collapsed trail"
                description="A home url prepends the icon link. separator=slash swaps the chevrons for hairline slashes, and a crumb with no href stands in for the levels you folded away."
                :code="$collapsedCode" :vue-code="$collapsedVueCode" :react-code="$collapsedReactCode">
                <x-ui.breadcrumb separator="slash" home="#" :items="[
                    ['label' => 'Billing', 'href' => '#'],
                    ['label' => '…'],
                    ['label' => 'Invoice INV-2049'],
                ]" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="breadcrumb" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
