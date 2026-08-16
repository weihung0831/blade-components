<x-layout title="Badge — BLADE-COMPONENTS">
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
                    A status label in one span. Solid tint, quiet outline, or a colored dot for anything that has a state.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.badge>Stable</x-ui.badge>
            <x-ui.badge variant="outline">Beta</x-ui.badge>
            <x-ui.badge variant="dot">Live</x-ui.badge>
            BLADE;

            $variantsVueCode = <<<'VUE'
            <UiBadge>Stable</UiBadge>
            <UiBadge variant="outline">Beta</UiBadge>
            <UiBadge variant="dot">Live</UiBadge>
            VUE;

            $variantsReactCode = <<<'REACT'
            <UiBadge>Stable</UiBadge>
            <UiBadge variant="outline">Beta</UiBadge>
            <UiBadge variant="dot">Live</UiBadge>
            REACT;

            $colorsCode = <<<'BLADE'
            <x-ui.badge color="jade">Paid</x-ui.badge>
            <x-ui.badge color="zinc">Draft</x-ui.badge>
            <x-ui.badge color="amber">Pending</x-ui.badge>
            <x-ui.badge color="red">Overdue</x-ui.badge>
            BLADE;

            $colorsVueCode = <<<'VUE'
            <UiBadge color="jade">Paid</UiBadge>
            <UiBadge color="zinc">Draft</UiBadge>
            <UiBadge color="amber">Pending</UiBadge>
            <UiBadge color="red">Overdue</UiBadge>
            VUE;

            $colorsReactCode = <<<'REACT'
            <UiBadge color="jade">Paid</UiBadge>
            <UiBadge color="zinc">Draft</UiBadge>
            <UiBadge color="amber">Pending</UiBadge>
            <UiBadge color="red">Overdue</UiBadge>
            REACT;

            $dotCode = <<<'BLADE'
            <x-ui.badge variant="dot" color="jade">Operational</x-ui.badge>
            <x-ui.badge variant="dot" color="amber">Degraded</x-ui.badge>
            <x-ui.badge variant="dot" color="red">Outage</x-ui.badge>
            <x-ui.badge variant="dot" color="zinc">Paused</x-ui.badge>
            BLADE;

            $dotVueCode = <<<'VUE'
            <UiBadge variant="dot" color="jade">Operational</UiBadge>
            <UiBadge variant="dot" color="amber">Degraded</UiBadge>
            <UiBadge variant="dot" color="red">Outage</UiBadge>
            <UiBadge variant="dot" color="zinc">Paused</UiBadge>
            VUE;

            $dotReactCode = <<<'REACT'
            <UiBadge variant="dot" color="jade">Operational</UiBadge>
            <UiBadge variant="dot" color="amber">Degraded</UiBadge>
            <UiBadge variant="dot" color="red">Outage</UiBadge>
            <UiBadge variant="dot" color="zinc">Paused</UiBadge>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Solid for the state you want noticed, outline for the quiet ones, dot for things that are running."
                :code="$variantsCode" :vue-code="$variantsVueCode" :react-code="$variantsReactCode">
                <x-ui.badge>Stable</x-ui.badge>
                <x-ui.badge variant="outline">Beta</x-ui.badge>
                <x-ui.badge variant="dot">Live</x-ui.badge>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Colors"
                description="Four tints on the solid variant — enough to cover an invoice lifecycle without inventing new colors."
                :code="$colorsCode" :vue-code="$colorsVueCode" :react-code="$colorsReactCode">
                <x-ui.badge color="jade">Paid</x-ui.badge>
                <x-ui.badge color="zinc">Draft</x-ui.badge>
                <x-ui.badge color="amber">Pending</x-ui.badge>
                <x-ui.badge color="red">Overdue</x-ui.badge>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Status dot"
                description="On the dot variant, color moves to the dot and the text stays neutral — reads like a status page."
                :code="$dotCode" :vue-code="$dotVueCode" :react-code="$dotReactCode">
                <x-ui.badge variant="dot" color="jade">Operational</x-ui.badge>
                <x-ui.badge variant="dot" color="amber">Degraded</x-ui.badge>
                <x-ui.badge variant="dot" color="red">Outage</x-ui.badge>
                <x-ui.badge variant="dot" color="zinc">Paused</x-ui.badge>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="badge" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
