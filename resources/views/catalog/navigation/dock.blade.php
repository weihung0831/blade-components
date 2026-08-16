<x-layout title="Dock — BLADE-COMPONENTS">
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
                    A floating shortcut bar. The tile under the cursor lifts, grows, and names itself; the rest hold their place — plain CSS hover, no pointer tracking and no JavaScript at all.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.dock :items="[
                ['label' => 'Dashboard', 'icon' => 'grid', 'href' => '#', 'active' => true],
                ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
                ['label' => 'Logs', 'icon' => 'logs', 'href' => '#'],
                ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 2],
                ['label' => 'Settings', 'icon' => 'settings', 'href' => '#'],
            ]" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiDock
                :items="[
                    { label: 'Dashboard', icon: 'grid', href: '#', active: true },
                    { label: 'Deploys', icon: 'deploy', href: '#' },
                    { label: 'Logs', icon: 'logs', href: '#' },
                    { label: 'Alerts', icon: 'bell', href: '#', badge: 2 },
                    { label: 'Settings', icon: 'settings', href: '#' },
                ]"
            />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiDock
                items={[
                    { label: 'Dashboard', icon: 'grid', href: '#', active: true },
                    { label: 'Deploys', icon: 'deploy', href: '#' },
                    { label: 'Logs', icon: 'logs', href: '#' },
                    { label: 'Alerts', icon: 'bell', href: '#', badge: 2 },
                    { label: 'Settings', icon: 'settings', href: '#' },
                ]}
            />
            REACT;

            $verticalCode = <<<'BLADE'
            <x-ui.dock orientation="vertical" :items="[
                ['label' => 'Usage', 'icon' => 'chart', 'href' => '#'],
                ['label' => 'Members', 'icon' => 'users', 'href' => '#'],
                ['label' => 'API keys', 'icon' => 'lock', 'href' => '#', 'active' => true],
                ['label' => 'Docs', 'icon' => 'docs', 'href' => '#'],
            ]" />
            BLADE;

            $verticalVueCode = <<<'VUE'
            <UiDock
                orientation="vertical"
                :items="[
                    { label: 'Usage', icon: 'chart', href: '#' },
                    { label: 'Members', icon: 'users', href: '#' },
                    { label: 'API keys', icon: 'lock', href: '#', active: true },
                    { label: 'Docs', icon: 'docs', href: '#' },
                ]"
            />
            VUE;

            $verticalReactCode = <<<'REACT'
            <UiDock
                orientation="vertical"
                items={[
                    { label: 'Usage', icon: 'chart', href: '#' },
                    { label: 'Members', icon: 'users', href: '#' },
                    { label: 'API keys', icon: 'lock', href: '#', active: true },
                    { label: 'Docs', icon: 'docs', href: '#' },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic" padding="px-10 pt-20 pb-10"
                description="Icon names come from the same set the sidebar uses. The active item takes the jade tile, a badge pins a count to the corner, and the label rides above on hover — the tile scales, the label does not."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.dock :items="[
                    ['label' => 'Dashboard', 'icon' => 'grid', 'href' => '#', 'active' => true],
                    ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
                    ['label' => 'Logs', 'icon' => 'logs', 'href' => '#'],
                    ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 2],
                    ['label' => 'Settings', 'icon' => 'settings', 'href' => '#'],
                ]" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Vertical" padding="px-24 py-12"
                description="Turn it on its side for a screen edge. The hovered tile pushes left instead of lifting, and its label moves to the side to follow."
                :code="$verticalCode" :vue-code="$verticalVueCode" :react-code="$verticalReactCode">
                <x-ui.dock orientation="vertical" :items="[
                    ['label' => 'Usage', 'icon' => 'chart', 'href' => '#'],
                    ['label' => 'Members', 'icon' => 'users', 'href' => '#'],
                    ['label' => 'API keys', 'icon' => 'lock', 'href' => '#', 'active' => true],
                    ['label' => 'Docs', 'icon' => 'docs', 'href' => '#'],
                ]" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="dock" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
