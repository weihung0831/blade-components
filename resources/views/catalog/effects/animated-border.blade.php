<x-layout title="Animated border — BLADE-COMPONENTS">
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
                    A conic gradient spinning behind an opaque inner panel — the border is just the one pixel of padding the panel does not cover. Nothing is masked or clipped, so it stays sharp at any radius.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $cardCode = <<<'BLADE'
            <x-ui.animated-border class="w-full max-w-xs">
                <div class="p-5">
                    <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Scale</p>
                    <h3 class="mt-1.5 text-lg font-semibold tracking-tight text-cream">$79 / month</h3>
                    <p class="mt-2 text-sm/6 text-zinc-500">Unlimited seats, 50M events, priority queue.</p>
                </div>
            </x-ui.animated-border>
            BLADE;

            $cardVueCode = <<<'VUE'
            <UiAnimatedBorder class="w-full max-w-xs">
                <div class="p-5">
                    <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Scale</p>
                    <h3 class="mt-1.5 text-lg font-semibold tracking-tight text-cream">$79 / month</h3>
                    <p class="mt-2 text-sm/6 text-zinc-500">Unlimited seats, 50M events, priority queue.</p>
                </div>
            </UiAnimatedBorder>
            VUE;

            $cardReactCode = <<<'REACT'
            <UiAnimatedBorder className="w-full max-w-xs">
                <div className="p-5">
                    <p className="font-mono text-xs tracking-wider text-jade-400 uppercase">Scale</p>
                    <h3 className="mt-1.5 text-lg font-semibold tracking-tight text-cream">$79 / month</h3>
                    <p className="mt-2 text-sm/6 text-zinc-500">Unlimited seats, 50M events, priority queue.</p>
                </div>
            </UiAnimatedBorder>
            REACT;

            $buttonCode = <<<'BLADE'
            <x-ui.animated-border tone="split" :duration="3" radius="rounded-full">
                <button type="button" class="cursor-pointer rounded-full px-5 py-2 text-sm font-medium text-cream transition-colors duration-150 hover:bg-white/5">
                    Start a trial
                </button>
            </x-ui.animated-border>
            BLADE;

            $buttonVueCode = <<<'VUE'
            <UiAnimatedBorder tone="split" :duration="3" radius="rounded-full">
                <button type="button" class="cursor-pointer rounded-full px-5 py-2 text-sm font-medium text-cream transition-colors duration-150 hover:bg-white/5">
                    Start a trial
                </button>
            </UiAnimatedBorder>
            VUE;

            $buttonReactCode = <<<'REACT'
            <UiAnimatedBorder tone="split" duration={3} radius="rounded-full">
                <button type="button" className="cursor-pointer rounded-full px-5 py-2 text-sm font-medium text-cream transition-colors duration-150 hover:bg-white/5">
                    Start a trial
                </button>
            </UiAnimatedBorder>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Card"
                description="The inner panel inherits the outer radius, so swapping rounded-xl for anything else needs no second value. Duration is seconds per revolution."
                :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                <x-ui.animated-border class="w-full max-w-xs">
                    <div class="p-5">
                        <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Scale</p>
                        <h3 class="mt-1.5 text-lg font-semibold tracking-tight text-cream">$79 / month</h3>
                        <p class="mt-2 text-sm/6 text-zinc-500">Unlimited seats, 50M events, priority queue.</p>
                    </div>
                </x-ui.animated-border>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Around a control"
                description="Wrap a button and the split tone puts two lights on opposite sides of the ring. The wrapper is a plain div, so the button keeps its own focus ring and click target."
                :code="$buttonCode" :vue-code="$buttonVueCode" :react-code="$buttonReactCode">
                <x-ui.animated-border tone="split" :duration="3" radius="rounded-full">
                    <button type="button" class="cursor-pointer rounded-full px-5 py-2 text-sm font-medium text-cream transition-colors duration-150 hover:bg-white/5">
                        Start a trial
                    </button>
                </x-ui.animated-border>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="animated-border" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
