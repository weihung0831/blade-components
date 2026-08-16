<x-layout title="Popover — BLADE-COMPONENTS">
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
                    An anchored panel for any content — richer than a tooltip, lighter than a modal. Details-based, so it opens on click and closes on an outside click with zero JavaScript. Style the trigger slot yourself; the summary supplies click and focus behavior.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.popover>
                <x-slot:trigger>
                    <span class="inline-flex h-10 items-center rounded-lg border border-white/10 px-4 text-sm font-medium text-zinc-300 transition-colors duration-150 hover:border-white/25">On-call: Kim</span>
                </x-slot>
                <div class="flex items-center gap-3">
                    <span class="grid size-9 place-items-center rounded-full bg-jade-500/15 text-sm font-semibold text-jade-400">K</span>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-zinc-200">Kim Nakamura</p>
                        <p class="text-xs text-zinc-500">kim@acme.io · Platform team</p>
                    </div>
                </div>
                <p class="mt-3 text-xs/5 text-zinc-500">On call until Monday 09:00 UTC. Escalations page them directly.</p>
            </x-ui.popover>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiPopover>
                <template #trigger>
                    <span class="inline-flex h-10 items-center rounded-lg border border-white/10 px-4 text-sm font-medium text-zinc-300 transition-colors duration-150 hover:border-white/25">On-call: Kim</span>
                </template>
                <div class="flex items-center gap-3">
                    <span class="grid size-9 place-items-center rounded-full bg-jade-500/15 text-sm font-semibold text-jade-400">K</span>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-zinc-200">Kim Nakamura</p>
                        <p class="text-xs text-zinc-500">kim@acme.io · Platform team</p>
                    </div>
                </div>
                <p class="mt-3 text-xs/5 text-zinc-500">On call until Monday 09:00 UTC. Escalations page them directly.</p>
            </UiPopover>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiPopover
                trigger={
                    <span className="inline-flex h-10 items-center rounded-lg border border-white/10 px-4 text-sm font-medium text-zinc-300 transition-colors duration-150 hover:border-white/25">On-call: Kim</span>
                }
            >
                <div className="flex items-center gap-3">
                    <span className="grid size-9 place-items-center rounded-full bg-jade-500/15 text-sm font-semibold text-jade-400">K</span>
                    <div className="min-w-0">
                        <p className="text-sm font-medium text-zinc-200">Kim Nakamura</p>
                        <p className="text-xs text-zinc-500">kim@acme.io · Platform team</p>
                    </div>
                </div>
                <p className="mt-3 text-xs/5 text-zinc-500">On call until Monday 09:00 UTC. Escalations page them directly.</p>
            </UiPopover>
            REACT;

            $positionCode = <<<'BLADE'
            <x-ui.popover position="top">...</x-ui.popover>
            <x-ui.popover position="bottom">...</x-ui.popover>
            <x-ui.popover position="bottom-end">...</x-ui.popover>
            BLADE;

            $positionVueCode = <<<'VUE'
            <UiPopover position="top">...</UiPopover>
            <UiPopover position="bottom">...</UiPopover>
            <UiPopover position="bottom-end">...</UiPopover>
            VUE;

            $positionReactCode = <<<'REACT'
            <UiPopover position="top">...</UiPopover>
            <UiPopover position="bottom">...</UiPopover>
            <UiPopover position="bottom-end">...</UiPopover>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic" padding="px-10 pt-10 pb-44"
                description="The trigger slot takes any markup; the default slot is the panel. Here, a member card behind an on-call chip."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.popover>
                    <x-slot:trigger>
                        <span class="inline-flex h-10 items-center rounded-lg border border-white/10 px-4 text-sm font-medium text-zinc-300 transition-colors duration-150 hover:border-white/25">On-call: Kim</span>
                    </x-slot>
                    <div class="flex items-center gap-3">
                        <span class="grid size-9 place-items-center rounded-full bg-jade-500/15 text-sm font-semibold text-jade-400">K</span>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-zinc-200">Kim Nakamura</p>
                            <p class="text-xs text-zinc-500">kim@acme.io · Platform team</p>
                        </div>
                    </div>
                    <p class="mt-3 text-xs/5 text-zinc-500">On call until Monday 09:00 UTC. Escalations page them directly.</p>
                </x-ui.popover>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Positions" padding="px-10 pt-28 pb-24"
                description="Four anchors: bottom, bottom-end, top, and top-end, all relative to the trigger."
                :code="$positionCode" :vue-code="$positionVueCode" :react-code="$positionReactCode">
                <x-ui.popover position="top">
                    <x-slot:trigger>
                        <span class="inline-flex h-8 items-center rounded-lg px-3 text-[13px] font-medium text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">Top</span>
                    </x-slot>
                    <p class="text-xs/5 text-zinc-400">Opens above the trigger.</p>
                </x-ui.popover>
                <x-ui.popover position="bottom">
                    <x-slot:trigger>
                        <span class="inline-flex h-8 items-center rounded-lg px-3 text-[13px] font-medium text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">Bottom</span>
                    </x-slot>
                    <p class="text-xs/5 text-zinc-400">Opens below, aligned to the left edge.</p>
                </x-ui.popover>
                <x-ui.popover position="bottom-end">
                    <x-slot:trigger>
                        <span class="inline-flex h-8 items-center rounded-lg px-3 text-[13px] font-medium text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">Bottom end</span>
                    </x-slot>
                    <p class="text-xs/5 text-zinc-400">Opens below, aligned to the right edge.</p>
                </x-ui.popover>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="popover" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
