<x-layout title="Card — BLADE-COMPONENTS">
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
                    A bordered panel with optional header and footer rows. Outline, elevated, and an interactive look that lifts on hover.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.card class="w-64">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-cream">Production</p>
                    <span class="flex items-center gap-1.5 text-xs text-jade-400">
                        <span class="size-1.5 rounded-full bg-jade-500"></span>Live
                    </span>
                </div>
                <p class="mt-1.5 text-xs text-zinc-500">Deployed 2 minutes ago</p>
            </x-ui.card>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiCard class="w-64">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-cream">Production</p>
                    <span class="flex items-center gap-1.5 text-xs text-jade-400">
                        <span class="size-1.5 rounded-full bg-jade-500"></span>Live
                    </span>
                </div>
                <p class="mt-1.5 text-xs text-zinc-500">Deployed 2 minutes ago</p>
            </UiCard>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiCard className="w-64">
                <div className="flex items-center justify-between">
                    <p className="text-sm font-medium text-cream">Production</p>
                    <span className="flex items-center gap-1.5 text-xs text-jade-400">
                        <span className="size-1.5 rounded-full bg-jade-500" />Live
                    </span>
                </div>
                <p className="mt-1.5 text-xs text-zinc-500">Deployed 2 minutes ago</p>
            </UiCard>
            REACT;

            $slotsCode = <<<'BLADE'
            <x-ui.card class="w-72">
                <x-slot:header>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-cream">API usage</p>
                        <span class="font-mono text-xs text-zinc-500">Pro plan</span>
                    </div>
                </x-slot>
                <p class="text-sm/6 text-zinc-400">18,204 of 50,000 requests used this cycle. Resets on the 1st.</p>
                <x-slot:footer>
                    <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Upgrade plan</a>
                </x-slot>
            </x-ui.card>
            BLADE;

            $slotsVueCode = <<<'VUE'
            <UiCard class="w-72">
                <template #header>
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-cream">API usage</p>
                        <span class="font-mono text-xs text-zinc-500">Pro plan</span>
                    </div>
                </template>
                <p class="text-sm/6 text-zinc-400">18,204 of 50,000 requests used this cycle. Resets on the 1st.</p>
                <template #footer>
                    <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Upgrade plan</a>
                </template>
            </UiCard>
            VUE;

            $slotsReactCode = <<<'REACT'
            <UiCard
                className="w-72"
                header={
                    <div className="flex items-center justify-between">
                        <p className="text-sm font-medium text-cream">API usage</p>
                        <span className="font-mono text-xs text-zinc-500">Pro plan</span>
                    </div>
                }
                footer={<a href="#" className="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Upgrade plan</a>}
            >
                <p className="text-sm/6 text-zinc-400">18,204 of 50,000 requests used this cycle. Resets on the 1st.</p>
            </UiCard>
            REACT;

            $elevatedCode = <<<'BLADE'
            <x-ui.card variant="elevated" class="w-64">
                <p class="text-sm font-medium text-cream">Invoice #2041</p>
                <p class="mt-1.5 text-xs text-zinc-500">$249.00 · paid March 1</p>
            </x-ui.card>
            BLADE;

            $elevatedVueCode = <<<'VUE'
            <UiCard variant="elevated" class="w-64">
                <p class="text-sm font-medium text-cream">Invoice #2041</p>
                <p class="mt-1.5 text-xs text-zinc-500">$249.00 · paid March 1</p>
            </UiCard>
            VUE;

            $elevatedReactCode = <<<'REACT'
            <UiCard variant="elevated" className="w-64">
                <p className="text-sm font-medium text-cream">Invoice #2041</p>
                <p className="mt-1.5 text-xs text-zinc-500">$249.00 · paid March 1</p>
            </UiCard>
            REACT;

            $interactiveCode = <<<'BLADE'
            <x-ui.card variant="interactive" class="w-56">
                <p class="text-sm font-medium text-cream">acme-api</p>
                <p class="mt-1.5 text-xs text-zinc-500">12 deploys this week</p>
            </x-ui.card>
            <x-ui.card variant="interactive" class="w-56">
                <p class="text-sm font-medium text-cream">acme-docs</p>
                <p class="mt-1.5 text-xs text-zinc-500">3 deploys this week</p>
            </x-ui.card>
            BLADE;

            $interactiveVueCode = <<<'VUE'
            <UiCard variant="interactive" class="w-56">
                <p class="text-sm font-medium text-cream">acme-api</p>
                <p class="mt-1.5 text-xs text-zinc-500">12 deploys this week</p>
            </UiCard>
            VUE;

            $interactiveReactCode = <<<'REACT'
            <UiCard variant="interactive" className="w-56">
                <p className="text-sm font-medium text-cream">acme-api</p>
                <p className="mt-1.5 text-xs text-zinc-500">12 deploys this week</p>
            </UiCard>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="The default outline card — a bordered ink panel around whatever the slot holds."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.card class="w-64">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-cream">Production</p>
                        <span class="flex items-center gap-1.5 text-xs text-jade-400">
                            <span class="size-1.5 rounded-full bg-jade-500"></span>Live
                        </span>
                    </div>
                    <p class="mt-1.5 text-xs text-zinc-500">Deployed 2 minutes ago</p>
                </x-ui.card>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Header and footer"
                description="Named slots add ruled header and footer rows with their own padding."
                :code="$slotsCode" :vue-code="$slotsVueCode" :react-code="$slotsReactCode">
                <x-ui.card class="w-72">
                    <x-slot:header>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-cream">API usage</p>
                            <span class="font-mono text-xs text-zinc-500">Pro plan</span>
                        </div>
                    </x-slot>
                    <p class="text-sm/6 text-zinc-400">18,204 of 50,000 requests used this cycle. Resets on the 1st.</p>
                    <x-slot:footer>
                        <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Upgrade plan</a>
                    </x-slot>
                </x-ui.card>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Elevated"
                description="A softer border and a deep shadow, for cards that sit above other content."
                :code="$elevatedCode" :vue-code="$elevatedVueCode" :react-code="$elevatedReactCode">
                <x-ui.card variant="elevated" class="w-64">
                    <p class="text-sm font-medium text-cream">Invoice #2041</p>
                    <p class="mt-1.5 text-xs text-zinc-500">$249.00 · paid March 1</p>
                </x-ui.card>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Interactive"
                description="Lifts and brightens on hover. Wrap it in a link when the whole card is the target."
                :code="$interactiveCode" :vue-code="$interactiveVueCode" :react-code="$interactiveReactCode">
                <x-ui.card variant="interactive" class="w-56">
                    <p class="text-sm font-medium text-cream">acme-api</p>
                    <p class="mt-1.5 text-xs text-zinc-500">12 deploys this week</p>
                </x-ui.card>
                <x-ui.card variant="interactive" class="w-56">
                    <p class="text-sm font-medium text-cream">acme-docs</p>
                    <p class="mt-1.5 text-xs text-zinc-500">3 deploys this week</p>
                </x-ui.card>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="card" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
