<x-layout title="Animated background — BLADE-COMPONENTS">
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
                    Motion behind your content, not in front of it. Everything decorative sits on a negative z-index and ignores the pointer, so links and buttons in the slot behave normally.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $auroraCode = <<<'BLADE'
            <x-ui.animated-background class="w-full max-w-md rounded-xl border border-white/10 p-10">
                <h3 class="text-xl font-semibold tracking-tight text-cream">Usage that scales with you</h3>
                <p class="mt-2 text-sm/6 text-zinc-400">Per-seat billing, metered overages, one invoice.</p>
            </x-ui.animated-background>
            BLADE;

            $auroraVueCode = <<<'VUE'
            <UiAnimatedBackground class="w-full max-w-md rounded-xl border border-white/10 p-10">
                <h3 class="text-xl font-semibold tracking-tight text-cream">Usage that scales with you</h3>
                <p class="mt-2 text-sm/6 text-zinc-400">Per-seat billing, metered overages, one invoice.</p>
            </UiAnimatedBackground>
            VUE;

            $auroraReactCode = <<<'REACT'
            <UiAnimatedBackground className="w-full max-w-md rounded-xl border border-white/10 p-10">
                <h3 className="text-xl font-semibold tracking-tight text-cream">Usage that scales with you</h3>
                <p className="mt-2 text-sm/6 text-zinc-400">Per-seat billing, metered overages, one invoice.</p>
            </UiAnimatedBackground>
            REACT;

            $gridCode = <<<'BLADE'
            <x-ui.animated-background variant="grid" :speed="6" class="w-full max-w-md rounded-xl border border-white/10 p-10">
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Enterprise</p>
                <h3 class="mt-1.5 text-xl font-semibold tracking-tight text-cream">Bring your own region</h3>
            </x-ui.animated-background>
            BLADE;

            $gridVueCode = <<<'VUE'
            <UiAnimatedBackground variant="grid" :speed="6" class="w-full max-w-md rounded-xl border border-white/10 p-10">
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Enterprise</p>
                <h3 class="mt-1.5 text-xl font-semibold tracking-tight text-cream">Bring your own region</h3>
            </UiAnimatedBackground>
            VUE;

            $gridReactCode = <<<'REACT'
            <UiAnimatedBackground variant="grid" speed={6} className="w-full max-w-md rounded-xl border border-white/10 p-10">
                <p className="font-mono text-xs tracking-wider text-jade-400 uppercase">Enterprise</p>
                <h3 className="mt-1.5 text-xl font-semibold tracking-tight text-cream">Bring your own region</h3>
            </UiAnimatedBackground>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Aurora"
                description="Two blurred blobs drift on opposite alternating cycles, so they never line up the same way twice. Raise speed to slow it down — it is the duration in seconds, not a rate."
                :code="$auroraCode" :vue-code="$auroraVueCode" :react-code="$auroraReactCode">
                <x-ui.animated-background class="w-full max-w-md rounded-xl border border-white/10 p-10">
                    <h3 class="text-xl font-semibold tracking-tight text-cream">Usage that scales with you</h3>
                    <p class="mt-2 text-sm/6 text-zinc-400">Per-seat billing, metered overages, one invoice.</p>
                </x-ui.animated-background>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Grid"
                description="A 40px lattice scrolling one full cell per cycle, which is what makes the loop invisible. The jade wash on top keeps the lines from reading as a spreadsheet."
                :code="$gridCode" :vue-code="$gridVueCode" :react-code="$gridReactCode">
                <x-ui.animated-background variant="grid" :speed="6" class="w-full max-w-md rounded-xl border border-white/10 p-10">
                    <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Enterprise</p>
                    <h3 class="mt-1.5 text-xl font-semibold tracking-tight text-cream">Bring your own region</h3>
                </x-ui.animated-background>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="animated-background" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
