<x-layout title="Number ticker — BLADE-COMPONENTS">
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
                    Counts up once, when it scrolls into view, and never again. The final number is what renders on the server — so with JavaScript off, or reduced motion on, the figure is still correct.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $singleCode = <<<'BLADE'
            <x-ui.number-ticker :value="128400" prefix="$" suffix="k MRR"
                class="text-4xl font-semibold tracking-tight text-cream" />
            BLADE;

            $singleVueCode = <<<'VUE'
            <UiNumberTicker
                :value="128400"
                prefix="$"
                suffix="k MRR"
                class="text-4xl font-semibold tracking-tight text-cream"
            />
            VUE;

            $singleReactCode = <<<'REACT'
            <UiNumberTicker
                value={128400}
                prefix="$"
                suffix="k MRR"
                className="text-4xl font-semibold tracking-tight text-cream"
            />
            REACT;

            $statsCode = <<<'BLADE'
            <div class="grid w-full max-w-lg grid-cols-3 divide-x divide-white/8 rounded-xl border border-white/10 bg-ink-900">
                <div class="px-5 py-4">
                    <x-ui.number-ticker :value="1284" class="text-2xl font-semibold tracking-tight text-cream" />
                    <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Tenants</p>
                </div>
                <div class="px-5 py-4">
                    <x-ui.number-ticker :value="99.98" :decimals="2" suffix="%" :duration="2200"
                        class="text-2xl font-semibold tracking-tight text-cream" />
                    <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Uptime</p>
                </div>
                <div class="px-5 py-4">
                    <x-ui.number-ticker :value="42" suffix="ms" class="text-2xl font-semibold tracking-tight text-cream" />
                    <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">p95</p>
                </div>
            </div>
            BLADE;

            $statsVueCode = <<<'VUE'
            <div class="grid w-full max-w-lg grid-cols-3 divide-x divide-white/8 rounded-xl border border-white/10 bg-ink-900">
                <div class="px-5 py-4">
                    <UiNumberTicker :value="1284" class="text-2xl font-semibold tracking-tight text-cream" />
                    <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Tenants</p>
                </div>
                <div class="px-5 py-4">
                    <UiNumberTicker :value="99.98" :decimals="2" suffix="%" :duration="2200"
                        class="text-2xl font-semibold tracking-tight text-cream" />
                    <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Uptime</p>
                </div>
                <div class="px-5 py-4">
                    <UiNumberTicker :value="42" suffix="ms" class="text-2xl font-semibold tracking-tight text-cream" />
                    <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">p95</p>
                </div>
            </div>
            VUE;

            $statsReactCode = <<<'REACT'
            <div className="grid w-full max-w-lg grid-cols-3 divide-x divide-white/8 rounded-xl border border-white/10 bg-ink-900">
                <div className="px-5 py-4">
                    <UiNumberTicker value={1284} className="text-2xl font-semibold tracking-tight text-cream" />
                    <p className="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Tenants</p>
                </div>
                <div className="px-5 py-4">
                    <UiNumberTicker value={99.98} decimals={2} suffix="%" duration={2200}
                        className="text-2xl font-semibold tracking-tight text-cream" />
                    <p className="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Uptime</p>
                </div>
                <div className="px-5 py-4">
                    <UiNumberTicker value={42} suffix="ms" className="text-2xl font-semibold tracking-tight text-cream" />
                    <p className="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">p95</p>
                </div>
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Single figure"
                description="Eased out, so it sprints early and settles slowly instead of stopping dead. Prefix picks up the jade accent, suffix stays muted."
                :code="$singleCode" :vue-code="$singleVueCode" :react-code="$singleReactCode">
                <x-ui.number-ticker :value="128400" prefix="$" suffix="k MRR" class="text-4xl font-semibold tracking-tight text-cream" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Stat row"
                description="Decimals keeps the digit count fixed the whole way up, so 99.98% never jitters between two and three characters. Tabular figures hold the column width."
                :code="$statsCode" :vue-code="$statsVueCode" :react-code="$statsReactCode">
                <div class="grid w-full max-w-lg grid-cols-3 divide-x divide-white/8 rounded-xl border border-white/10 bg-ink-900">
                    <div class="px-5 py-4">
                        <x-ui.number-ticker :value="1284" class="text-2xl font-semibold tracking-tight text-cream" />
                        <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Tenants</p>
                    </div>
                    <div class="px-5 py-4">
                        <x-ui.number-ticker :value="99.98" :decimals="2" suffix="%" :duration="2200" class="text-2xl font-semibold tracking-tight text-cream" />
                        <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">Uptime</p>
                    </div>
                    <div class="px-5 py-4">
                        <x-ui.number-ticker :value="42" suffix="ms" class="text-2xl font-semibold tracking-tight text-cream" />
                        <p class="mt-1 font-mono text-[11px] tracking-wider text-zinc-500 uppercase">p95</p>
                    </div>
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="number-ticker" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
