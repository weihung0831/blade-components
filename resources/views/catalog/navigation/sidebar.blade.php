<x-layout title="Sidebar — BLADE-COMPONENTS">
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
                    The console's left edge: grouped links, an active row, and counts where they earn their place. Icons ship with the component — name one per item and skip the SVG wrangling.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.sidebar :sections="[
                ['label' => 'Workspace', 'items' => [
                    ['label' => 'Dashboard', 'icon' => 'grid', 'href' => '#', 'active' => true],
                    ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
                    ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 3],
                    ['label' => 'Usage', 'icon' => 'chart', 'href' => '#'],
                ]],
                ['label' => 'Account', 'items' => [
                    ['label' => 'Members', 'icon' => 'users', 'href' => '#'],
                    ['label' => 'Billing', 'icon' => 'billing', 'href' => '#'],
                    ['label' => 'Settings', 'icon' => 'settings', 'href' => '#'],
                ]],
            ]">
                <x-slot:brand>
                    <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                    <span class="text-sm font-medium text-cream">acme</span>
                </x-slot>
                <x-slot:footer>
                    <div class="flex items-center gap-2.5 px-1.5 py-1">
                        <span class="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                        <div class="min-w-0">
                            <p class="truncate text-xs text-zinc-300">Wei Hung</p>
                            <p class="truncate font-mono text-[10px] text-zinc-600">Owner</p>
                        </div>
                    </div>
                </x-slot>
            </x-ui.sidebar>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiSidebar :sections="sections">
                <template #brand>
                    <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                    <span class="text-sm font-medium text-cream">acme</span>
                </template>
                <template #footer>
                    <div class="flex items-center gap-2.5 px-1.5 py-1">
                        <span class="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                        <div class="min-w-0">
                            <p class="truncate text-xs text-zinc-300">Wei Hung</p>
                            <p class="truncate font-mono text-[10px] text-zinc-600">Owner</p>
                        </div>
                    </div>
                </template>
            </UiSidebar>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiSidebar
                sections={sections}
                brand={
                    <>
                        <span className="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                        <span className="text-sm font-medium text-cream">acme</span>
                    </>
                }
                footer={
                    <div className="flex items-center gap-2.5 px-1.5 py-1">
                        <span className="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                        <div className="min-w-0">
                            <p className="truncate text-xs text-zinc-300">Wei Hung</p>
                            <p className="truncate font-mono text-[10px] text-zinc-600">Owner</p>
                        </div>
                    </div>
                }
            />
            REACT;

            $railCode = <<<'BLADE'
            <x-ui.sidebar variant="rail" :sections="[
                ['items' => [
                    ['label' => 'Dashboard', 'icon' => 'grid', 'href' => '#', 'active' => true],
                    ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
                    ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 3],
                ]],
                ['items' => [
                    ['label' => 'Logs', 'icon' => 'logs', 'href' => '#'],
                    ['label' => 'API keys', 'icon' => 'lock', 'href' => '#'],
                    ['label' => 'Docs', 'icon' => 'docs', 'href' => '#'],
                ]],
            ]">
                <x-slot:brand>
                    <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                </x-slot>
                <x-slot:footer>
                    <span class="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                </x-slot>
            </x-ui.sidebar>
            BLADE;

            $railVueCode = <<<'VUE'
            <UiSidebar variant="rail" :sections="sections">
                <template #brand>
                    <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                </template>
                <template #footer>
                    <span class="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                </template>
            </UiSidebar>
            VUE;

            $railReactCode = <<<'REACT'
            <UiSidebar
                variant="rail"
                sections={sections}
                brand={<span className="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>}
                footer={<span className="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Grouped navigation"
                description="Sections carry an optional label; items take an icon name, an href, and a badge. Mark one active and it picks up the jade wash plus aria-current."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.sidebar :sections="[
                    ['label' => 'Workspace', 'items' => [
                        ['label' => 'Dashboard', 'icon' => 'grid', 'href' => '#', 'active' => true],
                        ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
                        ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 3],
                        ['label' => 'Usage', 'icon' => 'chart', 'href' => '#'],
                    ]],
                    ['label' => 'Account', 'items' => [
                        ['label' => 'Members', 'icon' => 'users', 'href' => '#'],
                        ['label' => 'Billing', 'icon' => 'billing', 'href' => '#'],
                        ['label' => 'Settings', 'icon' => 'settings', 'href' => '#'],
                    ]],
                ]">
                    <x-slot:brand>
                        <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                        <span class="text-sm font-medium text-cream">acme</span>
                    </x-slot>
                    <x-slot:footer>
                        <div class="flex items-center gap-2.5 px-1.5 py-1">
                            <span class="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                            <div class="min-w-0">
                                <p class="truncate text-xs text-zinc-300">Wei Hung</p>
                                <p class="truncate font-mono text-[10px] text-zinc-600">Owner</p>
                            </div>
                        </div>
                    </x-slot>
                </x-ui.sidebar>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Icon rail"
                description="variant=rail drops to 64px and keeps only the icons — labels move into the title attribute, and a badge shrinks to a dot. Sections become hairlines."
                :code="$railCode" :vue-code="$railVueCode" :react-code="$railReactCode">
                <x-ui.sidebar variant="rail" :sections="[
                    ['items' => [
                        ['label' => 'Dashboard', 'icon' => 'grid', 'href' => '#', 'active' => true],
                        ['label' => 'Deploys', 'icon' => 'deploy', 'href' => '#'],
                        ['label' => 'Alerts', 'icon' => 'bell', 'href' => '#', 'badge' => 3],
                    ]],
                    ['items' => [
                        ['label' => 'Logs', 'icon' => 'logs', 'href' => '#'],
                        ['label' => 'API keys', 'icon' => 'lock', 'href' => '#'],
                        ['label' => 'Docs', 'icon' => 'docs', 'href' => '#'],
                    ]],
                ]">
                    <x-slot:brand>
                        <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                    </x-slot>
                    <x-slot:footer>
                        <span class="grid size-7 place-items-center rounded-full bg-ink-950 text-[10px] font-semibold text-zinc-400">WH</span>
                    </x-slot>
                </x-ui.sidebar>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="sidebar" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
