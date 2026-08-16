<x-layout title="Scroll area — BLADE-COMPONENTS">
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
                    Native scrolling with a slim jade scrollbar instead of the browser default. It's all CSS — no fake scroll math, no wheel hijacking, and keyboard scrolling keeps working.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.scroll-area class="h-52 w-80 rounded-xl border border-white/10 bg-ink-800">
                <div class="divide-y divide-white/5 text-xs">
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Invited dana@acme.dev</span><span class="text-zinc-600">2m</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Rotated production API key</span><span class="text-zinc-600">1h</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Upgraded to Pro</span><span class="text-zinc-600">3h</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Enabled SSO enforcement</span><span class="text-zinc-600">1d</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Added billing contact</span><span class="text-zinc-600">2d</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Created staging workspace</span><span class="text-zinc-600">4d</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Verified custom domain</span><span class="text-zinc-600">5d</span></p>
                </div>
            </x-ui.scroll-area>
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiScrollArea class="h-52 w-80 rounded-xl border border-white/10 bg-ink-800">
                <div class="divide-y divide-white/5 text-xs">
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Invited dana@acme.dev</span><span class="text-zinc-600">2m</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Rotated production API key</span><span class="text-zinc-600">1h</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Upgraded to Pro</span><span class="text-zinc-600">3h</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Enabled SSO enforcement</span><span class="text-zinc-600">1d</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Added billing contact</span><span class="text-zinc-600">2d</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Created staging workspace</span><span class="text-zinc-600">4d</span></p>
                    <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Verified custom domain</span><span class="text-zinc-600">5d</span></p>
                </div>
            </UiScrollArea>
            VUE;

            $basicReactCode = <<<'REACT'
            <UiScrollArea className="h-52 w-80 rounded-xl border border-white/10 bg-ink-800">
                <div className="divide-y divide-white/5 text-xs">
                    <p className="flex justify-between px-4 py-2.5"><span className="text-zinc-300">Invited dana@acme.dev</span><span className="text-zinc-600">2m</span></p>
                    <p className="flex justify-between px-4 py-2.5"><span className="text-zinc-300">Rotated production API key</span><span className="text-zinc-600">1h</span></p>
                    <p className="flex justify-between px-4 py-2.5"><span className="text-zinc-300">Upgraded to Pro</span><span className="text-zinc-600">3h</span></p>
                    <p className="flex justify-between px-4 py-2.5"><span className="text-zinc-300">Enabled SSO enforcement</span><span className="text-zinc-600">1d</span></p>
                    <p className="flex justify-between px-4 py-2.5"><span className="text-zinc-300">Added billing contact</span><span className="text-zinc-600">2d</span></p>
                    <p className="flex justify-between px-4 py-2.5"><span className="text-zinc-300">Created staging workspace</span><span className="text-zinc-600">4d</span></p>
                    <p className="flex justify-between px-4 py-2.5"><span className="text-zinc-300">Verified custom domain</span><span className="text-zinc-600">5d</span></p>
                </div>
            </UiScrollArea>
            REACT;

            $horizontalCode = <<<'BLADE'
            <x-ui.scroll-area orientation="horizontal" class="w-96 rounded-xl border border-white/10 bg-ink-800">
                <div class="flex w-max gap-3 p-3">
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Stripe</p><p class="mt-1 text-[11px] text-jade-400">Connected</p></div>
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Slack</p><p class="mt-1 text-[11px] text-jade-400">Connected</p></div>
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">GitHub</p><p class="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Linear</p><p class="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                </div>
            </x-ui.scroll-area>
            BLADE;

            $horizontalVueCode = <<<'VUE'
            <UiScrollArea orientation="horizontal" class="w-96 rounded-xl border border-white/10 bg-ink-800">
                <div class="flex w-max gap-3 p-3">
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Stripe</p><p class="mt-1 text-[11px] text-jade-400">Connected</p></div>
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Slack</p><p class="mt-1 text-[11px] text-jade-400">Connected</p></div>
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">GitHub</p><p class="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                    <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Linear</p><p class="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                </div>
            </UiScrollArea>
            VUE;

            $horizontalReactCode = <<<'REACT'
            <UiScrollArea orientation="horizontal" className="w-96 rounded-xl border border-white/10 bg-ink-800">
                <div className="flex w-max gap-3 p-3">
                    <div className="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p className="text-xs font-medium text-cream">Stripe</p><p className="mt-1 text-[11px] text-jade-400">Connected</p></div>
                    <div className="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p className="text-xs font-medium text-cream">Slack</p><p className="mt-1 text-[11px] text-jade-400">Connected</p></div>
                    <div className="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p className="text-xs font-medium text-cream">GitHub</p><p className="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                    <div className="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p className="text-xs font-medium text-cream">Linear</p><p className="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                </div>
            </UiScrollArea>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Vertical"
                description="Cap the height and the content scrolls under a 1.5-unit thumb. Frame and background come from your own classes."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.scroll-area class="h-52 w-80 rounded-xl border border-white/10 bg-ink-800">
                    <div class="divide-y divide-white/5 text-xs">
                        <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Invited dana@acme.dev</span><span class="text-zinc-600">2m</span></p>
                        <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Rotated production API key</span><span class="text-zinc-600">1h</span></p>
                        <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Upgraded to Pro</span><span class="text-zinc-600">3h</span></p>
                        <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Enabled SSO enforcement</span><span class="text-zinc-600">1d</span></p>
                        <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Added billing contact</span><span class="text-zinc-600">2d</span></p>
                        <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Created staging workspace</span><span class="text-zinc-600">4d</span></p>
                        <p class="flex justify-between px-4 py-2.5"><span class="text-zinc-300">Verified custom domain</span><span class="text-zinc-600">5d</span></p>
                    </div>
                </x-ui.scroll-area>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Horizontal"
                description="Switch the orientation for rows that overflow sideways — the inner w-max wrapper keeps items from wrapping."
                :code="$horizontalCode" :vue-code="$horizontalVueCode" :react-code="$horizontalReactCode">
                <x-ui.scroll-area orientation="horizontal" class="w-96 rounded-xl border border-white/10 bg-ink-800">
                    <div class="flex w-max gap-3 p-3">
                        <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Stripe</p><p class="mt-1 text-[11px] text-jade-400">Connected</p></div>
                        <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Slack</p><p class="mt-1 text-[11px] text-jade-400">Connected</p></div>
                        <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">GitHub</p><p class="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                        <div class="w-40 shrink-0 rounded-lg border border-white/10 bg-ink-950 p-3"><p class="text-xs font-medium text-cream">Linear</p><p class="mt-1 text-[11px] text-zinc-600">Not connected</p></div>
                    </div>
                </x-ui.scroll-area>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="scroll-area" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
