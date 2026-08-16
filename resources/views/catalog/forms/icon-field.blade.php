<x-layout title="Icon field — BLADE-COMPONENTS">
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
                    Wraps a plain input with icons — source order decides the side. Clicking anywhere focuses the field. Zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $leadingCode = <<<'BLADE'
            <x-ui.icon-field>
                <svg viewBox="0 0 16 16" fill="none"><rect x="2" y="3.5" width="12" height="9" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="m2.5 5 5.5 4 5.5-4" stroke="currentColor" stroke-width="1.3"/></svg>
                <input type="email" placeholder="you@example.com">
            </x-ui.icon-field>
            BLADE;

            $leadingVueCode = <<<'VUE'
            <UiIconField>
                <svg viewBox="0 0 16 16" fill="none"><rect x="2" y="3.5" width="12" height="9" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="m2.5 5 5.5 4 5.5-4" stroke="currentColor" stroke-width="1.3"/></svg>
                <input type="email" placeholder="you@example.com" />
            </UiIconField>
            VUE;

            $leadingReactCode = <<<'REACT'
            <UiIconField>
                <svg viewBox="0 0 16 16" fill="none"><rect x="2" y="3.5" width="12" height="9" rx="1.5" stroke="currentColor" strokeWidth="1.3"/><path d="m2.5 5 5.5 4 5.5-4" stroke="currentColor" strokeWidth="1.3"/></svg>
                <input type="email" placeholder="you@example.com" />
            </UiIconField>
            REACT;

            $trailingCode = <<<'BLADE'
            <x-ui.icon-field>
                <input placeholder="Filter events…">
                <svg viewBox="0 0 16 16" fill="none"><path d="M2.5 3.5h11l-4.2 5v4l-2.6 1.5v-5.5l-4.2-5Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
            </x-ui.icon-field>
            BLADE;

            $trailingVueCode = <<<'VUE'
            <UiIconField>
                <input placeholder="Filter events…" />
                <svg viewBox="0 0 16 16" fill="none"><path d="M2.5 3.5h11l-4.2 5v4l-2.6 1.5v-5.5l-4.2-5Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
            </UiIconField>
            VUE;

            $trailingReactCode = <<<'REACT'
            <UiIconField>
                <input placeholder="Filter events…" />
                <svg viewBox="0 0 16 16" fill="none"><path d="M2.5 3.5h11l-4.2 5v4l-2.6 1.5v-5.5l-4.2-5Z" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/></svg>
            </UiIconField>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Leading icon"
                description="Put the svg before the input. Icons are sized and tinted for you."
                :code="$leadingCode" :vue-code="$leadingVueCode" :react-code="$leadingReactCode">
                <x-ui.icon-field class="w-72">
                    <svg viewBox="0 0 16 16" fill="none"><rect x="2" y="3.5" width="12" height="9" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="m2.5 5 5.5 4 5.5-4" stroke="currentColor" stroke-width="1.3"/></svg>
                    <input type="email" placeholder="you@example.com">
                </x-ui.icon-field>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Trailing icon"
                description="Put the svg after the input instead — or use both sides at once."
                :code="$trailingCode" :vue-code="$trailingVueCode" :react-code="$trailingReactCode">
                <x-ui.icon-field class="w-72">
                    <input placeholder="Filter events…">
                    <svg viewBox="0 0 16 16" fill="none"><path d="M2.5 3.5h11l-4.2 5v4l-2.6 1.5v-5.5l-4.2-5Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </x-ui.icon-field>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="icon-field" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
