<x-layout title="Button — BLADE-COMPONENTS">
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
                    Renders a button or a link with identical styling. Four visual variants, three sizes, press feedback baked in.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.button>Deploy</x-ui.button>
            <x-ui.button variant="secondary">Preview</x-ui.button>
            <x-ui.button variant="ghost">Dismiss</x-ui.button>
            <x-ui.button variant="danger">Delete</x-ui.button>
            BLADE;

            $sizesCode = <<<'BLADE'
            <x-ui.button size="sm">Small</x-ui.button>
            <x-ui.button>Medium</x-ui.button>
            <x-ui.button size="lg">Large</x-ui.button>
            BLADE;

            $linkCode = <<<'BLADE'
            <x-ui.button href="/billing" variant="secondary">
                Upgrade plan
            </x-ui.button>
            BLADE;

            $disabledCode = <<<'BLADE'
            <x-ui.button disabled>Deploy</x-ui.button>
            <x-ui.button variant="secondary" disabled>Preview</x-ui.button>
            BLADE;

            $variantsVueCode = <<<'VUE'
            <UiButton>Deploy</UiButton>
            <UiButton variant="secondary">Preview</UiButton>
            <UiButton variant="ghost">Dismiss</UiButton>
            <UiButton variant="danger">Delete</UiButton>
            VUE;

            $sizesVueCode = <<<'VUE'
            <UiButton size="sm">Small</UiButton>
            <UiButton>Medium</UiButton>
            <UiButton size="lg">Large</UiButton>
            VUE;

            $linkVueCode = <<<'VUE'
            <UiButton href="/billing" variant="secondary">
                Upgrade plan
            </UiButton>
            VUE;

            $disabledVueCode = <<<'VUE'
            <UiButton disabled>Deploy</UiButton>
            <UiButton variant="secondary" disabled>Preview</UiButton>
            VUE;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Pick with the variant prop. Primary is the default."
                :code="$variantsCode" :vue-code="$variantsVueCode">
                <x-ui.button>Deploy</x-ui.button>
                <x-ui.button variant="secondary">Preview</x-ui.button>
                <x-ui.button variant="ghost">Dismiss</x-ui.button>
                <x-ui.button variant="danger">Delete</x-ui.button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Sizes"
                description="Three sizes via the size prop. Default is md."
                :code="$sizesCode" :vue-code="$sizesVueCode">
                <x-ui.button size="sm">Small</x-ui.button>
                <x-ui.button>Medium</x-ui.button>
                <x-ui.button size="lg">Large</x-ui.button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="As a link"
                description="Pass href and it renders an anchor with the same look."
                :code="$linkCode" :vue-code="$linkVueCode">
                <x-ui.button href="#" variant="secondary">Upgrade plan</x-ui.button>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Disabled"
                description="Standard disabled attribute. Pointer events are dropped and opacity lowered."
                :code="$disabledCode" :vue-code="$disabledVueCode">
                <x-ui.button disabled>Deploy</x-ui.button>
                <x-ui.button variant="secondary" disabled>Preview</x-ui.button>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="button" :vue="true" />

        </div>
    </div>
</x-layout>
