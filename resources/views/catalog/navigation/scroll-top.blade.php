<x-layout title="Scroll top — BLADE-COMPONENTS">
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
                    Appears once you're far enough down and takes you back in one click. It watches the window by default, or any scrollable box you tag as a region — which is what both demos below do.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $log = [
                ['time' => '09:41:02', 'text' => 'build started — commit 4f2a1c'],
                ['time' => '09:41:07', 'text' => 'installing dependencies'],
                ['time' => '09:41:26', 'text' => 'compiled assets in 12.4s'],
                ['time' => '09:41:31', 'text' => 'running migrations'],
                ['time' => '09:41:33', 'text' => 'cache warmed'],
                ['time' => '09:41:40', 'text' => 'health check passed'],
                ['time' => '09:41:44', 'text' => 'routing 10% of traffic'],
                ['time' => '09:41:58', 'text' => 'routing 50% of traffic'],
                ['time' => '09:42:11', 'text' => 'routing 100% of traffic'],
                ['time' => '09:42:12', 'text' => 'deploy live'],
            ];

            $basicCode = <<<'BLADE'
            <div class="relative w-80">
                <div data-ui-scroll-region class="h-64 overflow-y-auto rounded-xl border border-white/10 bg-ink-950">
                    {{-- long content --}}
                </div>

                <x-ui.scroll-top anchor="container" :threshold="80" />
            </div>
            BLADE;

            $basicVueCode = <<<'VUE'
            <div class="relative w-80">
                <div data-ui-scroll-region class="h-64 overflow-y-auto rounded-xl border border-white/10 bg-ink-950">
                    <!-- long content -->
                </div>

                <UiScrollTop anchor="container" :threshold="80" />
            </div>
            VUE;

            $basicReactCode = <<<'REACT'
            <div className="relative w-80">
                <div data-ui-scroll-region className="h-64 overflow-y-auto rounded-xl border border-white/10 bg-ink-950">
                    {/* long content */}
                </div>

                <UiScrollTop anchor="container" threshold={80} />
            </div>
            REACT;

            $progressCode = <<<'BLADE'
            <x-ui.scroll-top variant="progress" anchor="container" :threshold="80" />
            BLADE;

            $progressVueCode = <<<'VUE'
            <UiScrollTop variant="progress" anchor="container" :threshold="80" />
            VUE;

            $progressReactCode = <<<'REACT'
            <UiScrollTop variant="progress" anchor="container" threshold={80} />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Scroll the panel. anchor=container pins the button inside the nearest positioned parent instead of the viewport; drop both that and the region attribute for a normal page-level button."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <div class="relative w-80">
                    <div data-ui-scroll-region class="h-64 overflow-y-auto rounded-xl border border-white/10 bg-ink-950">
                        <div class="divide-y divide-white/5 font-mono text-[11px]">
                            @foreach (array_merge($log, $log) as $line)
                                <p class="flex gap-3 px-4 py-2.5"><span class="text-zinc-600">{{ $line['time'] }}</span><span class="text-zinc-400">{{ $line['text'] }}</span></p>
                            @endforeach
                        </div>
                    </div>

                    <x-ui.scroll-top anchor="container" :threshold="80" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Progress ring"
                description="variant=progress wraps the button in a conic-gradient ring that fills as you read — a reading indicator and a shortcut in one 44px target."
                :code="$progressCode" :vue-code="$progressVueCode" :react-code="$progressReactCode">
                <div class="relative w-80">
                    <div data-ui-scroll-region class="h-64 overflow-y-auto rounded-xl border border-white/10 bg-ink-950">
                        <div class="flex flex-col gap-4 p-5 text-sm/6 text-zinc-400">
                            <p>Every workspace starts on the Starter plan with two environments and a shared build queue.</p>
                            <p>Scale adds concurrent builds, protected branches, and audit logs kept for a year.</p>
                            <p>Usage is metered per build minute. Seats are billed monthly and prorated when someone joins mid-cycle.</p>
                            <p>Overages never block a deploy — we bill them at the end of the period and flag them on the invoice.</p>
                            <p>Enterprise adds SSO enforcement, a private build pool, and a support channel with an hour response.</p>
                            <p>Cancelling drops you to Starter at the end of the period. Nothing is deleted for 30 days.</p>
                        </div>
                    </div>

                    <x-ui.scroll-top variant="progress" anchor="container" :threshold="80" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="scroll-top" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
