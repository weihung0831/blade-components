<x-layout title="Flip card — BLADE-COMPONENTS">
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
                    Two faces stacked in 3D, one turned away. Both are absolutely positioned, so give the card a height — that box is what the flip happens inside.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $hoverCode = <<<'BLADE'
            <x-ui.flip-card class="h-44 w-72">
                <x-slot:front>
                    <div class="grid h-full place-items-center rounded-xl border border-white/10 bg-ink-800">
                        <span class="font-mono text-xs tracking-wider text-zinc-400 uppercase">Starter</span>
                    </div>
                </x-slot>

                <x-slot:back>
                    <div class="grid h-full place-items-center rounded-xl border border-jade-500/40 bg-jade-500/10">
                        <span class="font-mono text-xs tracking-wider text-jade-300 uppercase">$19 / seat</span>
                    </div>
                </x-slot>
            </x-ui.flip-card>
            BLADE;

            $hoverVueCode = <<<'VUE'
            <UiFlipCard class="h-44 w-72">
                <template #front>
                    <div class="grid h-full place-items-center rounded-xl border border-white/10 bg-ink-800">
                        <span class="font-mono text-xs tracking-wider text-zinc-400 uppercase">Starter</span>
                    </div>
                </template>

                <template #back>
                    <div class="grid h-full place-items-center rounded-xl border border-jade-500/40 bg-jade-500/10">
                        <span class="font-mono text-xs tracking-wider text-jade-300 uppercase">$19 / seat</span>
                    </div>
                </template>
            </UiFlipCard>
            VUE;

            $hoverReactCode = <<<'REACT'
            <UiFlipCard
                className="h-44 w-72"
                front={
                    <div className="grid h-full place-items-center rounded-xl border border-white/10 bg-ink-800">
                        <span className="font-mono text-xs tracking-wider text-zinc-400 uppercase">Starter</span>
                    </div>
                }
                back={
                    <div className="grid h-full place-items-center rounded-xl border border-jade-500/40 bg-jade-500/10">
                        <span className="font-mono text-xs tracking-wider text-jade-300 uppercase">$19 / seat</span>
                    </div>
                }
            />
            REACT;

            $clickCode = <<<'BLADE'
            <x-ui.flip-card trigger="click" axis="x" class="h-44 w-72">
                <x-slot:front>
                    <div class="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-800 p-5">
                        <span class="font-mono text-xs tracking-wider text-zinc-500 uppercase">Region</span>
                        <p class="text-lg font-semibold tracking-tight text-cream">eu-central-1</p>
                        <span class="font-mono text-[11px] text-zinc-600">Tap for details</span>
                    </div>
                </x-slot>

                <x-slot:back>
                    <div class="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-900 p-5">
                        <span class="font-mono text-xs tracking-wider text-jade-400 uppercase">Details</span>
                        <dl class="flex flex-col gap-1 font-mono text-[11px] text-zinc-400">
                            <div class="flex justify-between"><dt>p95</dt><dd class="text-cream">38 ms</dd></div>
                            <div class="flex justify-between"><dt>Tenants</dt><dd class="text-cream">412</dd></div>
                        </dl>
                        <span class="font-mono text-[11px] text-zinc-600">Tap to go back</span>
                    </div>
                </x-slot>
            </x-ui.flip-card>
            BLADE;

            $clickVueCode = <<<'VUE'
            <UiFlipCard trigger="click" axis="x" class="h-44 w-72">
                <template #front>
                    <div class="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-800 p-5">
                        <span class="font-mono text-xs tracking-wider text-zinc-500 uppercase">Region</span>
                        <p class="text-lg font-semibold tracking-tight text-cream">eu-central-1</p>
                        <span class="font-mono text-[11px] text-zinc-600">Tap for details</span>
                    </div>
                </template>

                <template #back>
                    <div class="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-900 p-5">
                        <span class="font-mono text-xs tracking-wider text-jade-400 uppercase">Details</span>
                        <dl class="flex flex-col gap-1 font-mono text-[11px] text-zinc-400">
                            <div class="flex justify-between"><dt>p95</dt><dd class="text-cream">38 ms</dd></div>
                            <div class="flex justify-between"><dt>Tenants</dt><dd class="text-cream">412</dd></div>
                        </dl>
                        <span class="font-mono text-[11px] text-zinc-600">Tap to go back</span>
                    </div>
                </template>
            </UiFlipCard>
            VUE;

            $clickReactCode = <<<'REACT'
            <UiFlipCard
                trigger="click"
                axis="x"
                className="h-44 w-72"
                front={
                    <div className="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-800 p-5">
                        <span className="font-mono text-xs tracking-wider text-zinc-500 uppercase">Region</span>
                        <p className="text-lg font-semibold tracking-tight text-cream">eu-central-1</p>
                        <span className="font-mono text-[11px] text-zinc-600">Tap for details</span>
                    </div>
                }
                back={
                    <div className="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-900 p-5">
                        <span className="font-mono text-xs tracking-wider text-jade-400 uppercase">Details</span>
                        <dl className="flex flex-col gap-1 font-mono text-[11px] text-zinc-400">
                            <div className="flex justify-between"><dt>p95</dt><dd className="text-cream">38 ms</dd></div>
                            <div className="flex justify-between"><dt>Tenants</dt><dd className="text-cream">412</dd></div>
                        </dl>
                        <span className="font-mono text-[11px] text-zinc-600">Tap to go back</span>
                    </div>
                }
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="On hover"
                description="Cheapest version — no state, no script, just a group-hover rotation on the inner layer."
                :code="$hoverCode" :vue-code="$hoverVueCode" :react-code="$hoverReactCode">
                <x-ui.flip-card class="h-44 w-72">
                    <x-slot:front>
                        <div class="grid h-full place-items-center rounded-xl border border-white/10 bg-ink-800">
                            <span class="font-mono text-xs tracking-wider text-zinc-400 uppercase">Starter</span>
                        </div>
                    </x-slot>

                    <x-slot:back>
                        <div class="grid h-full place-items-center rounded-xl border border-jade-500/40 bg-jade-500/10">
                            <span class="font-mono text-xs tracking-wider text-jade-300 uppercase">$19 / seat</span>
                        </div>
                    </x-slot>
                </x-ui.flip-card>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="On click, on the X axis"
                description="Set trigger to click and the card renders as a real button carrying aria-pressed, so it works from the keyboard and from touch — which hover never does."
                :code="$clickCode" :vue-code="$clickVueCode" :react-code="$clickReactCode">
                <x-ui.flip-card trigger="click" axis="x" class="h-44 w-72">
                    <x-slot:front>
                        <div class="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-800 p-5">
                            <span class="font-mono text-xs tracking-wider text-zinc-500 uppercase">Region</span>
                            <p class="text-lg font-semibold tracking-tight text-cream">eu-central-1</p>
                            <span class="font-mono text-[11px] text-zinc-600">Tap for details</span>
                        </div>
                    </x-slot>

                    <x-slot:back>
                        <div class="flex h-full flex-col justify-between rounded-xl border border-white/10 bg-ink-900 p-5">
                            <span class="font-mono text-xs tracking-wider text-jade-400 uppercase">Details</span>
                            <dl class="flex flex-col gap-1 font-mono text-[11px] text-zinc-400">
                                <div class="flex justify-between"><dt>p95</dt><dd class="text-cream">38 ms</dd></div>
                                <div class="flex justify-between"><dt>Tenants</dt><dd class="text-cream">412</dd></div>
                            </dl>
                            <span class="font-mono text-[11px] text-zinc-600">Tap to go back</span>
                        </div>
                    </x-slot>
                </x-ui.flip-card>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="flip-card" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
