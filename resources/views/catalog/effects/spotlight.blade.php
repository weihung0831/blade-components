<x-layout title="Spotlight — BLADE-COMPONENTS">
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
                    A radial wash that follows the cursor, fading in only while the pointer is inside the panel. One delegated listener handles every spotlight on the page, and it writes two custom properties — no per-frame class work.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $pointerCode = <<<'BLADE'
            <x-ui.spotlight class="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Observability</p>
                <h3 class="mt-1.5 text-lg font-semibold tracking-tight text-cream">Traces on every request</h3>
                <p class="mt-2 text-sm/6 text-zinc-500">Sampled at the edge, retained for 30 days on every plan.</p>
            </x-ui.spotlight>
            BLADE;

            $pointerVueCode = <<<'VUE'
            <UiSpotlight class="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Observability</p>
                <h3 class="mt-1.5 text-lg font-semibold tracking-tight text-cream">Traces on every request</h3>
                <p class="mt-2 text-sm/6 text-zinc-500">Sampled at the edge, retained for 30 days on every plan.</p>
            </UiSpotlight>
            VUE;

            $pointerReactCode = <<<'REACT'
            <UiSpotlight className="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                <p className="font-mono text-xs tracking-wider text-jade-400 uppercase">Observability</p>
                <h3 className="mt-1.5 text-lg font-semibold tracking-tight text-cream">Traces on every request</h3>
                <p className="mt-2 text-sm/6 text-zinc-500">Sampled at the edge, retained for 30 days on every plan.</p>
            </UiSpotlight>
            REACT;

            $sweepCode = <<<'BLADE'
            <x-ui.spotlight mode="sweep" tone="jade" :size="320" class="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                <p class="text-sm/6 text-zinc-400">Nothing to click here — the light moves on its own, which is what you want above the fold on a touch device.</p>
            </x-ui.spotlight>
            BLADE;

            $sweepVueCode = <<<'VUE'
            <UiSpotlight mode="sweep" tone="jade" :size="320" class="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                <p class="text-sm/6 text-zinc-400">Nothing to click here — the light moves on its own, which is what you want above the fold on a touch device.</p>
            </UiSpotlight>
            VUE;

            $sweepReactCode = <<<'REACT'
            <UiSpotlight mode="sweep" tone="jade" size={320} className="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                <p className="text-sm/6 text-zinc-400">Nothing to click here — the light moves on its own, which is what you want above the fold on a touch device.</p>
            </UiSpotlight>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Follows the pointer"
                description="Size is the radius of the wash in pixels — bigger reads as a soft ambient light, smaller as a torch. Move the cursor across the card."
                :code="$pointerCode" :vue-code="$pointerVueCode" :react-code="$pointerReactCode">
                <x-ui.spotlight class="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                    <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Observability</p>
                    <h3 class="mt-1.5 text-lg font-semibold tracking-tight text-cream">Traces on every request</h3>
                    <p class="mt-2 text-sm/6 text-zinc-500">Sampled at the edge, retained for 30 days on every plan.</p>
                </x-ui.spotlight>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Sweep"
                description="No pointer, no listener — a blurred disc crossing back and forth on a five second cycle. Reduced motion parks it where it stands."
                :code="$sweepCode" :vue-code="$sweepVueCode" :react-code="$sweepReactCode">
                <x-ui.spotlight mode="sweep" tone="jade" :size="320" class="w-full max-w-sm rounded-xl border border-white/10 bg-ink-900 p-6">
                    <p class="text-sm/6 text-zinc-400">Nothing to click here — the light moves on its own, which is what you want above the fold on a touch device.</p>
                </x-ui.spotlight>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="spotlight" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
