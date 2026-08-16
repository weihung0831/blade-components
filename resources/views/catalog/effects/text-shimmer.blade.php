<x-layout title="Text shimmer — BLADE-COMPONENTS">
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
                    A gradient twice the width of the text, clipped to the glyphs and slid across. No JavaScript, no per-letter markup — the text stays one selectable, copyable string.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $headlineCode = <<<'BLADE'
            <x-ui.text-shimmer class="text-2xl font-semibold tracking-tight">
                Ship faster with Blade
            </x-ui.text-shimmer>
            BLADE;

            $headlineVueCode = <<<'VUE'
            <UiTextShimmer class="text-2xl font-semibold tracking-tight">
                Ship faster with Blade
            </UiTextShimmer>
            VUE;

            $headlineReactCode = <<<'REACT'
            <UiTextShimmer className="text-2xl font-semibold tracking-tight">
                Ship faster with Blade
            </UiTextShimmer>
            REACT;

            $statusCode = <<<'BLADE'
            <div class="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 px-3.5 py-1.5">
                <span class="size-1.5 rounded-full bg-jade-500"></span>
                <x-ui.text-shimmer tone="jade" :duration="1.8" class="font-mono text-xs tracking-wider uppercase">
                    Migrating 4 of 12 tenants
                </x-ui.text-shimmer>
            </div>
            BLADE;

            $statusVueCode = <<<'VUE'
            <div class="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 px-3.5 py-1.5">
                <span class="size-1.5 rounded-full bg-jade-500"></span>
                <UiTextShimmer tone="jade" :duration="1.8" class="font-mono text-xs tracking-wider uppercase">
                    Migrating 4 of 12 tenants
                </UiTextShimmer>
            </div>
            VUE;

            $statusReactCode = <<<'REACT'
            <div className="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 px-3.5 py-1.5">
                <span className="size-1.5 rounded-full bg-jade-500" />
                <UiTextShimmer tone="jade" duration={1.8} className="font-mono text-xs tracking-wider uppercase">
                    Migrating 4 of 12 tenants
                </UiTextShimmer>
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Headline"
                description="Duration is in seconds and takes a fraction. Keep it slow on long strings, otherwise the highlight outruns the eye."
                :code="$headlineCode" :vue-code="$headlineVueCode" :react-code="$headlineReactCode">
                <x-ui.text-shimmer class="text-2xl font-semibold tracking-tight">Ship faster with Blade</x-ui.text-shimmer>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Working status"
                description="The jade tone plus a quicker sweep says something is still running — a pill that reads as busy without spending a spinner on it."
                :code="$statusCode" :vue-code="$statusVueCode" :react-code="$statusReactCode">
                <div class="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 px-3.5 py-1.5">
                    <span class="size-1.5 rounded-full bg-jade-500"></span>
                    <x-ui.text-shimmer tone="jade" :duration="1.8" class="font-mono text-xs tracking-wider uppercase">
                        Migrating 4 of 12 tenants
                    </x-ui.text-shimmer>
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="text-shimmer" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
