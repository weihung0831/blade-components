<x-layout>
    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute -top-40 left-1/2 h-105 w-200 -translate-x-1/2 rounded-full bg-jade-500/10 blur-[120px]"></div>

        <div class="mx-auto grid max-w-6xl items-center gap-14 px-6 py-20 lg:grid-cols-[1.1fr_1fr] lg:py-28">
            <div>
                <p class="rise inline-flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 py-1 pr-3 pl-1.5 font-mono text-xs text-zinc-400">
                    <span class="rounded-full bg-jade-500/15 px-2 py-0.5 text-jade-400">New</span>
                    83 components across 8 categories
                </p>

                <h1 class="rise mt-6 text-4xl font-semibold tracking-tight text-cream sm:text-5xl lg:text-[3.4rem]/[1.1]" style="animation-delay: 60ms">
                    Blade components,<br>
                    <span class="text-jade-500">sharpened</span> for Laravel.
                </h1>

                <p class="rise mt-5 max-w-md text-base/7 text-zinc-400" style="animation-delay: 120ms">
                    A hand-crafted set of Tailwind-powered Blade components. No build step, no JS framework — copy, paste, ship.
                </p>

                <div class="rise mt-8 flex flex-wrap items-center gap-3" style="animation-delay: 180ms">
                    <a href="{{ route('components') }}"
                        class="inline-flex h-10 items-center rounded-lg bg-jade-500 px-5 text-sm font-medium text-ink-950 transition-[transform,background-color] duration-150 ease-snap hover:bg-jade-400 active:scale-[0.97]">
                        Browse components
                    </a>
                    <a href="https://github.com/weihung0831/blade-components" target="_blank" rel="noopener"
                        class="inline-flex h-10 items-center rounded-lg border border-white/10 px-5 text-sm font-medium text-zinc-300 transition-[transform,border-color] duration-150 ease-snap hover:border-white/25 active:scale-[0.97]">
                        View on GitHub
                    </a>
                </div>

                <p class="rise mt-6 font-mono text-[13px] text-zinc-600" style="animation-delay: 240ms">
                    <span class="text-jade-600">$</span> composer require blade-components
                </p>
            </div>

            {{-- Code window --}}
            <div class="rise" style="animation-delay: 160ms">
                <div class="overflow-hidden rounded-xl border border-white/10 bg-ink-900 shadow-2xl shadow-black/50">
                    <div class="flex items-center gap-1.5 border-b border-white/5 px-4 py-3">
                        <span class="size-2.5 rounded-full bg-[#ff5f57]"></span>
                        <span class="size-2.5 rounded-full bg-[#febc2e]"></span>
                        <span class="size-2.5 rounded-full bg-[#28c840]"></span>
                        <span class="ml-3 font-mono text-xs text-zinc-500">dashboard.blade.php</span>
                    </div>
                    <pre class="overflow-x-auto p-4 font-mono text-[13px]/6"><code><span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">1</span><span class="text-zinc-600">&lt;</span><span class="text-jade-400">x-ui.card</span> <span class="text-zinc-500">class</span><span class="text-zinc-600">=</span><span class="text-zinc-200">"max-w-sm"</span><span class="text-zinc-600">&gt;</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">2</span>    <span class="text-zinc-600">&lt;</span><span class="text-jade-400">x-ui.badge</span><span class="text-zinc-600">&gt;</span><span class="text-zinc-300">Pro</span><span class="text-zinc-600">&lt;/</span><span class="text-jade-400">x-ui.badge</span><span class="text-zinc-600">&gt;</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">3</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">4</span>    <span class="text-zinc-600">&lt;</span><span class="text-jade-400">h2</span><span class="text-zinc-600">&gt;</span><span class="text-zinc-300">Usage this month</span><span class="text-zinc-600">&lt;/</span><span class="text-jade-400">h2</span><span class="text-zinc-600">&gt;</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">5</span>    <span class="text-zinc-600">&lt;</span><span class="text-jade-400">x-ui.progress</span> <span class="text-zinc-500">:value</span><span class="text-zinc-600">=</span><span class="text-zinc-200">"66"</span> <span class="text-zinc-600">/&gt;</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">6</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">7</span>    <span class="text-zinc-600">&lt;</span><span class="text-jade-400">x-ui.button</span> <span class="text-zinc-500">href</span><span class="text-zinc-600">=</span><span class="text-zinc-200">"/billing"</span><span class="text-zinc-600">&gt;</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">8</span>        <span class="text-zinc-300">Upgrade plan</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">9</span>    <span class="text-zinc-600">&lt;/</span><span class="text-jade-400">x-ui.button</span><span class="text-zinc-600">&gt;</span>
<span class="mr-4 inline-block w-5 text-right text-zinc-700 select-none">10</span><span class="text-zinc-600">&lt;/</span><span class="text-jade-400">x-ui.card</span><span class="text-zinc-600">&gt;</span></code></pre>
                </div>
            </div>
        </div>
    </section>
</x-layout>
