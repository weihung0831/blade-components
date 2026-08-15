<x-layout title="Link — BLADE-COMPONENTS">
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
                    Anchor styling in three variants, plus an external form that appends an icon and opens a new tab.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $variantsCode = <<<'BLADE'
            <x-ui.link href="/docs">Read the docs</x-ui.link>
            <x-ui.link href="/changelog" variant="muted">View changelog</x-ui.link>
            <x-ui.link href="/pricing" variant="underline">See pricing</x-ui.link>
            BLADE;

            $variantsJsCode = <<<'JS'
            <UiLink href="/docs">Read the docs</UiLink>
            <UiLink href="/changelog" variant="muted">View changelog</UiLink>
            <UiLink href="/pricing" variant="underline">See pricing</UiLink>
            JS;

            $externalCode = <<<'BLADE'
            <x-ui.link href="https://github.com/weihung0831/blade-components" external>
                View source
            </x-ui.link>
            BLADE;

            $externalJsCode = <<<'JS'
            <UiLink href="https://github.com/weihung0831/blade-components" external>
                View source
            </UiLink>
            JS;

            $inlineCode = <<<'BLADE'
            <p class="text-sm text-zinc-400">
                Read the <x-ui.link href="/docs">documentation</x-ui.link> before you start.
            </p>
            BLADE;

            $inlineJsCode = <<<'JS'
            <p class="text-sm text-zinc-400">
                Read the <UiLink href="/docs">documentation</UiLink> before you start.
            </p>
            JS;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Variants"
                description="Jade for primary navigation, muted for quiet footers, underline for links inside prose."
                :code="$variantsCode" :vue-code="$variantsJsCode" :react-code="$variantsJsCode">
                <x-ui.link href="#">Read the docs</x-ui.link>
                <x-ui.link href="#" variant="muted">View changelog</x-ui.link>
                <x-ui.link href="#" variant="underline">See pricing</x-ui.link>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="External"
                description="The external prop opens a new tab with rel=noopener and appends an icon."
                :code="$externalCode" :vue-code="$externalJsCode" :react-code="$externalJsCode">
                <x-ui.link href="https://github.com/weihung0831/blade-components" external>View source</x-ui.link>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Inline"
                description="Sits on the baseline inside body text without disturbing line height."
                :code="$inlineCode" :vue-code="$inlineJsCode" :react-code="$inlineJsCode">
                <p class="text-sm text-zinc-400">
                    Read the <x-ui.link href="#">documentation</x-ui.link> before you start.
                </p>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="link" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
