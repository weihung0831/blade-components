<x-layout title="Tooltip — BLADE-COMPONENTS">
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
                    A short hint that appears on hover or keyboard focus. Pure CSS — wrap any element and pass the text. Keep it to a label or a shortcut; anything longer belongs in a popover.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.tooltip text="Copy webhook URL">
                <x-ui.icon-button aria-label="Copy webhook URL">
                    <svg class="size-4" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.5"/><path d="M10.5 5.5v-2A1.5 1.5 0 0 0 9 2H4a1.5 1.5 0 0 0-1.5 1.5v5A1.5 1.5 0 0 0 4 10h1.5" stroke="currentColor" stroke-width="1.5"/></svg>
                </x-ui.icon-button>
            </x-ui.tooltip>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiTooltip text="Copy webhook URL">
                <UiIconButton aria-label="Copy webhook URL">
                    <svg class="size-4" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.5"/><path d="M10.5 5.5v-2A1.5 1.5 0 0 0 9 2H4a1.5 1.5 0 0 0-1.5 1.5v5A1.5 1.5 0 0 0 4 10h1.5" stroke="currentColor" stroke-width="1.5"/></svg>
                </UiIconButton>
            </UiTooltip>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiTooltip text="Copy webhook URL">
                <UiIconButton aria-label="Copy webhook URL">
                    <svg className="size-4" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="8" height="8" rx="1.5" stroke="currentColor" strokeWidth="1.5"/><path d="M10.5 5.5v-2A1.5 1.5 0 0 0 9 2H4a1.5 1.5 0 0 0-1.5 1.5v5A1.5 1.5 0 0 0 4 10h1.5" stroke="currentColor" strokeWidth="1.5"/></svg>
                </UiIconButton>
            </UiTooltip>
            REACT;

            $positionCode = <<<'BLADE'
            <x-ui.tooltip text="Pinned on top" position="top">
                <x-ui.button variant="secondary" size="sm">Top</x-ui.button>
            </x-ui.tooltip>
            <x-ui.tooltip text="Pinned on the right" position="right">
                <x-ui.button variant="secondary" size="sm">Right</x-ui.button>
            </x-ui.tooltip>
            <x-ui.tooltip text="Pinned below" position="bottom">
                <x-ui.button variant="secondary" size="sm">Bottom</x-ui.button>
            </x-ui.tooltip>
            <x-ui.tooltip text="Pinned on the left" position="left">
                <x-ui.button variant="secondary" size="sm">Left</x-ui.button>
            </x-ui.tooltip>
            BLADE;

            $positionVueCode = <<<'VUE'
            <UiTooltip text="Pinned on top" position="top"><UiButton variant="secondary" size="sm">Top</UiButton></UiTooltip>
            <UiTooltip text="Pinned on the right" position="right"><UiButton variant="secondary" size="sm">Right</UiButton></UiTooltip>
            <UiTooltip text="Pinned below" position="bottom"><UiButton variant="secondary" size="sm">Bottom</UiButton></UiTooltip>
            <UiTooltip text="Pinned on the left" position="left"><UiButton variant="secondary" size="sm">Left</UiButton></UiTooltip>
            VUE;

            $positionReactCode = <<<'REACT'
            <UiTooltip text="Pinned on top" position="top"><UiButton variant="secondary" size="sm">Top</UiButton></UiTooltip>
            <UiTooltip text="Pinned on the right" position="right"><UiButton variant="secondary" size="sm">Right</UiButton></UiTooltip>
            <UiTooltip text="Pinned below" position="bottom"><UiButton variant="secondary" size="sm">Bottom</UiButton></UiTooltip>
            <UiTooltip text="Pinned on the left" position="left"><UiButton variant="secondary" size="sm">Left</UiButton></UiTooltip>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Hover or tab to the trigger. Icon-only buttons are the classic case — the tooltip spells out what the icon means."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.tooltip text="Copy webhook URL">
                    <x-ui.icon-button aria-label="Copy webhook URL">
                        <svg class="size-4" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.5"/><path d="M10.5 5.5v-2A1.5 1.5 0 0 0 9 2H4a1.5 1.5 0 0 0-1.5 1.5v5A1.5 1.5 0 0 0 4 10h1.5" stroke="currentColor" stroke-width="1.5"/></svg>
                    </x-ui.icon-button>
                </x-ui.tooltip>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Positions"
                description="Four sides, each with a matching arrow and a one-pixel slide toward the trigger."
                :code="$positionCode" :vue-code="$positionVueCode" :react-code="$positionReactCode">
                <x-ui.tooltip text="Pinned on top" position="top">
                    <x-ui.button variant="secondary" size="sm">Top</x-ui.button>
                </x-ui.tooltip>
                <x-ui.tooltip text="Pinned on the right" position="right">
                    <x-ui.button variant="secondary" size="sm">Right</x-ui.button>
                </x-ui.tooltip>
                <x-ui.tooltip text="Pinned below" position="bottom">
                    <x-ui.button variant="secondary" size="sm">Bottom</x-ui.button>
                </x-ui.tooltip>
                <x-ui.tooltip text="Pinned on the left" position="left">
                    <x-ui.button variant="secondary" size="sm">Left</x-ui.button>
                </x-ui.tooltip>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="tooltip" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
