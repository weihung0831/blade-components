<x-layout title="Panel — BLADE-COMPONENTS">
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
                    A titled container with optional header actions and a footer row. The toggleable version collapses on a native details element, so the Blade build ships zero JavaScript.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.panel heading="Usage this cycle" class="w-80">
                <x-slot:actions>
                    <span class="font-mono text-xs text-zinc-500">Pro plan</span>
                </x-slot>
                18,204 of 50,000 requests used. Overage pricing kicks in past the quota — nothing stops working.
                <x-slot:footer>
                    <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">View full report</a>
                </x-slot>
            </x-ui.panel>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiPanel heading="Usage this cycle" class="w-80">
                <template #actions>
                    <span class="font-mono text-xs text-zinc-500">Pro plan</span>
                </template>
                18,204 of 50,000 requests used. Overage pricing kicks in past the quota — nothing stops working.
                <template #footer>
                    <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">View full report</a>
                </template>
            </UiPanel>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiPanel
                heading="Usage this cycle"
                className="w-80"
                actions={<span className="font-mono text-xs text-zinc-500">Pro plan</span>}
                footer={<a href="#" className="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">View full report</a>}
            >
                18,204 of 50,000 requests used. Overage pricing kicks in past the quota — nothing stops working.
            </UiPanel>
            REACT;

            $toggleableCode = <<<'BLADE'
            <x-ui.panel heading="Webhook settings" :toggleable="true" class="w-80">
                Events are signed with your endpoint secret and retried for 72 hours with exponential backoff.
            </x-ui.panel>
            BLADE;

            $toggleableVueCode = <<<'VUE'
            <UiPanel heading="Webhook settings" toggleable class="w-80">
                Events are signed with your endpoint secret and retried for 72 hours with exponential backoff.
            </UiPanel>
            VUE;

            $toggleableReactCode = <<<'REACT'
            <UiPanel heading="Webhook settings" toggleable className="w-80">
                Events are signed with your endpoint secret and retried for 72 hours with exponential backoff.
            </UiPanel>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="A heading prop, the body slot, and optional actions and footer slots for the header's right side and a ruled bottom row."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.panel heading="Usage this cycle" class="w-80">
                    <x-slot:actions>
                        <span class="font-mono text-xs text-zinc-500">Pro plan</span>
                    </x-slot>
                    18,204 of 50,000 requests used. Overage pricing kicks in past the quota — nothing stops working.
                    <x-slot:footer>
                        <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">View full report</a>
                    </x-slot>
                </x-ui.panel>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Toggleable"
                description="The header becomes the trigger and the body animates closed. Pass open as false to start collapsed."
                :code="$toggleableCode" :vue-code="$toggleableVueCode" :react-code="$toggleableReactCode">
                <x-ui.panel heading="Webhook settings" :toggleable="true" class="w-80">
                    Events are signed with your endpoint secret and retried for 72 hours with exponential backoff.
                </x-ui.panel>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="panel" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
