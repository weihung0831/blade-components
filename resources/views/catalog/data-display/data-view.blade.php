<x-layout title="Data view — BLADE-COMPONENTS">
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
                    The same item cards as a list or a two-column grid. In Blade the toggle is a pair of radio inputs and a has() selector — no JavaScript at all.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.data-view
                :items="[
                    ['badge' => 'UI', 'title' => 'Starter kit', 'subtitle' => 'Blade + Tailwind', 'meta' => 'Free', 'accent' => true],
                    ['badge' => 'PRO', 'title' => 'Dashboard kit', 'subtitle' => '24 screens', 'meta' => '$49'],
                    ['badge' => 'API', 'title' => 'Webhook pack', 'subtitle' => '12 endpoints', 'meta' => '$19'],
                    ['badge' => 'DB', 'title' => 'Schema kit', 'subtitle' => '8 blueprints', 'meta' => '$29'],
                ]"
            />
            BLADE;

            $basicVueCode = <<<'VUE'
            const kits = [
                { badge: 'UI', title: 'Starter kit', subtitle: 'Blade + Tailwind', meta: 'Free', accent: true },
                { badge: 'PRO', title: 'Dashboard kit', subtitle: '24 screens', meta: '$49' },
                { badge: 'API', title: 'Webhook pack', subtitle: '12 endpoints', meta: '$19' },
                { badge: 'DB', title: 'Schema kit', subtitle: '8 blueprints', meta: '$29' },
            ];

            <UiDataView :items="kits" />
            VUE;

            $basicReactCode = <<<'REACT'
            const kits = [
                { badge: 'UI', title: 'Starter kit', subtitle: 'Blade + Tailwind', meta: 'Free', accent: true },
                { badge: 'PRO', title: 'Dashboard kit', subtitle: '24 screens', meta: '$49' },
                { badge: 'API', title: 'Webhook pack', subtitle: '12 endpoints', meta: '$19' },
                { badge: 'DB', title: 'Schema kit', subtitle: '8 blueprints', meta: '$29' },
            ];

            <UiDataView items={kits} />
            REACT;

            $gridCode = <<<'BLADE'
            <x-ui.data-view
                view="grid"
                :items="[
                    ['badge' => 'SL', 'title' => 'Slack', 'subtitle' => 'Alerts + digests', 'meta' => 'Installed', 'accent' => true],
                    ['badge' => 'GH', 'title' => 'GitHub', 'subtitle' => 'Deploy on merge', 'meta' => 'Installed', 'accent' => true],
                    ['badge' => 'ST', 'title' => 'Stripe', 'subtitle' => 'Usage billing', 'meta' => 'Add'],
                    ['badge' => 'LN', 'title' => 'Linear', 'subtitle' => 'Incident issues', 'meta' => 'Add'],
                ]"
            />
            BLADE;

            $gridVueCode = <<<'VUE'
            const integrations = [
                { badge: 'SL', title: 'Slack', subtitle: 'Alerts + digests', meta: 'Installed', accent: true },
                { badge: 'GH', title: 'GitHub', subtitle: 'Deploy on merge', meta: 'Installed', accent: true },
                { badge: 'ST', title: 'Stripe', subtitle: 'Usage billing', meta: 'Add' },
                { badge: 'LN', title: 'Linear', subtitle: 'Incident issues', meta: 'Add' },
            ];

            <UiDataView view="grid" :items="integrations" />
            VUE;

            $gridReactCode = <<<'REACT'
            const integrations = [
                { badge: 'SL', title: 'Slack', subtitle: 'Alerts + digests', meta: 'Installed', accent: true },
                { badge: 'GH', title: 'GitHub', subtitle: 'Deploy on merge', meta: 'Installed', accent: true },
                { badge: 'ST', title: 'Stripe', subtitle: 'Usage billing', meta: 'Add' },
                { badge: 'LN', title: 'Linear', subtitle: 'Incident issues', meta: 'Add' },
            ];

            <UiDataView view="grid" items={integrations} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="List with toggle"
                description="Each item takes a badge, title, subtitle, and meta. Flip the segmented control to rearrange the cards into a grid."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="w-full max-w-md">
                    <x-ui.data-view
                        :items="[
                            ['badge' => 'UI', 'title' => 'Starter kit', 'subtitle' => 'Blade + Tailwind', 'meta' => 'Free', 'accent' => true],
                            ['badge' => 'PRO', 'title' => 'Dashboard kit', 'subtitle' => '24 screens', 'meta' => '$49'],
                            ['badge' => 'API', 'title' => 'Webhook pack', 'subtitle' => '12 endpoints', 'meta' => '$19'],
                            ['badge' => 'DB', 'title' => 'Schema kit', 'subtitle' => '8 blueprints', 'meta' => '$29'],
                        ]"
                    />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Grid first"
                description="Pass view=grid to start in grid mode. Items marked accent pick up the jade tile and meta color."
                :code="$gridCode" :vue-code="$gridVueCode" :react-code="$gridReactCode">
                <div class="w-full max-w-md">
                    <x-ui.data-view
                        view="grid"
                        :items="[
                            ['badge' => 'SL', 'title' => 'Slack', 'subtitle' => 'Alerts + digests', 'meta' => 'Installed', 'accent' => true],
                            ['badge' => 'GH', 'title' => 'GitHub', 'subtitle' => 'Deploy on merge', 'meta' => 'Installed', 'accent' => true],
                            ['badge' => 'ST', 'title' => 'Stripe', 'subtitle' => 'Usage billing', 'meta' => 'Add'],
                            ['badge' => 'LN', 'title' => 'Linear', 'subtitle' => 'Incident issues', 'meta' => 'Add'],
                        ]"
                    />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="data-view" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
