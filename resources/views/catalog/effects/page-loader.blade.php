<x-layout title="Page loader — BLADE-COMPONENTS">
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
                    Covers whatever it is nested in. Add <span class="font-mono text-xs text-zinc-400">fixed</span> and it covers the viewport instead, which is the version you want during a first paint or a route change.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $overlayCode = <<<'BLADE'
            <div class="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900">
                <x-ui.page-loader label="Provisioning tenant" />
            </div>
            BLADE;

            $overlayVueCode = <<<'VUE'
            <div class="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900">
                <UiPageLoader label="Provisioning tenant" />
            </div>
            VUE;

            $overlayReactCode = <<<'REACT'
            <div className="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900">
                <UiPageLoader label="Provisioning tenant" />
            </div>
            REACT;

            $barCode = <<<'BLADE'
            <div class="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900 p-6">
                <x-ui.page-loader variant="bar" label="Syncing usage" />
                <div class="mt-4 flex flex-col gap-2.5">
                    <span class="block h-2.5 w-2/3 rounded bg-white/8"></span>
                    <span class="block h-2.5 w-full rounded bg-white/8"></span>
                    <span class="block h-2.5 w-4/5 rounded bg-white/8"></span>
                </div>
            </div>
            BLADE;

            $barVueCode = <<<'VUE'
            <div class="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900 p-6">
                <UiPageLoader variant="bar" label="Syncing usage" />
                <div class="mt-4 flex flex-col gap-2.5">
                    <span class="block h-2.5 w-2/3 rounded bg-white/8"></span>
                    <span class="block h-2.5 w-full rounded bg-white/8"></span>
                    <span class="block h-2.5 w-4/5 rounded bg-white/8"></span>
                </div>
            </div>
            VUE;

            $barReactCode = <<<'REACT'
            <div className="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900 p-6">
                <UiPageLoader variant="bar" label="Syncing usage" />
                <div className="mt-4 flex flex-col gap-2.5">
                    <span className="block h-2.5 w-2/3 rounded bg-white/8" />
                    <span className="block h-2.5 w-full rounded bg-white/8" />
                    <span className="block h-2.5 w-4/5 rounded bg-white/8" />
                </div>
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Overlay"
                description="Spinner, label, and a bar riding the top edge. The label goes into an aria-live region, so a screen reader hears what is being waited on instead of just 'loading'."
                :code="$overlayCode" :vue-code="$overlayVueCode" :react-code="$overlayReactCode">
                <div class="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900">
                    <x-ui.page-loader label="Provisioning tenant" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Bar only"
                description="The bar without the scrim, for when the page is usable while the data lands. Pass auto-hide and it fades out and removes itself on window load."
                :code="$barCode" :vue-code="$barVueCode" :react-code="$barReactCode">
                <div class="relative h-52 w-full max-w-md overflow-hidden rounded-xl border border-white/10 bg-ink-900 p-6">
                    <x-ui.page-loader variant="bar" label="Syncing usage" />
                    <div class="mt-4 flex flex-col gap-2.5">
                        <span class="block h-2.5 w-2/3 rounded bg-white/8"></span>
                        <span class="block h-2.5 w-full rounded bg-white/8"></span>
                        <span class="block h-2.5 w-4/5 rounded bg-white/8"></span>
                    </div>
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="page-loader" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
