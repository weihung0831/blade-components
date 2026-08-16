<x-layout title="Marquee — BLADE-COMPONENTS">
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
                    Your slot rendered twice on one track that slides exactly half its width, which is what makes the seam invisible. The duplicate is aria-hidden, so nothing gets read out twice.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $logos = ['Laravel', 'Livewire', 'Tailwind', 'Vite', 'Pest', 'Inertia'];

            $quotes = [
                ['body' => 'Cut our onboarding from a week to an afternoon.', 'name' => 'Ana R.', 'role' => 'Head of Platform'],
                ['body' => 'The usage dashboard paid for the plan on day one.', 'name' => 'Dan K.', 'role' => 'CTO, Fieldwire'],
                ['body' => 'We moved four regions over without a support ticket.', 'name' => 'Mei L.', 'role' => 'SRE Lead'],
            ];

            $logoCode = <<<'BLADE'
            <x-ui.marquee :speed="18" class="w-full max-w-md">
                @foreach (['Laravel', 'Livewire', 'Tailwind', 'Vite', 'Pest', 'Inertia'] as $logo)
                    <span class="rounded-full border border-white/10 px-3.5 py-1.5 font-mono text-xs whitespace-nowrap text-zinc-400">
                        {{ $logo }}
                    </span>
                @endforeach
            </x-ui.marquee>
            BLADE;

            $logoVueCode = <<<'VUE'
            <UiMarquee :speed="18" class="w-full max-w-md">
                <span
                    v-for="logo in ['Laravel', 'Livewire', 'Tailwind', 'Vite', 'Pest', 'Inertia']"
                    :key="logo"
                    class="rounded-full border border-white/10 px-3.5 py-1.5 font-mono text-xs whitespace-nowrap text-zinc-400"
                >
                    {{ logo }}
                </span>
            </UiMarquee>
            VUE;

            $logoReactCode = <<<'REACT'
            <UiMarquee speed={18} className="w-full max-w-md">
                {['Laravel', 'Livewire', 'Tailwind', 'Vite', 'Pest', 'Inertia'].map((logo) => (
                    <span
                        key={logo}
                        className="rounded-full border border-white/10 px-3.5 py-1.5 font-mono text-xs whitespace-nowrap text-zinc-400"
                    >
                        {logo}
                    </span>
                ))}
            </UiMarquee>
            REACT;

            $quoteCode = <<<'BLADE'
            <x-ui.marquee vertical :speed="16" reverse class="h-56 w-full max-w-sm">
                @foreach ($quotes as $quote)
                    <figure class="w-full rounded-xl border border-white/10 bg-ink-900 p-4">
                        <blockquote class="text-sm/6 text-zinc-300">{{ $quote['body'] }}</blockquote>
                        <figcaption class="mt-3 font-mono text-[11px] text-zinc-500">
                            {{ $quote['name'] }} — {{ $quote['role'] }}
                        </figcaption>
                    </figure>
                @endforeach
            </x-ui.marquee>
            BLADE;

            $quoteVueCode = <<<'VUE'
            <UiMarquee vertical :speed="16" reverse class="h-56 w-full max-w-sm">
                <figure v-for="quote in quotes" :key="quote.name" class="w-full rounded-xl border border-white/10 bg-ink-900 p-4">
                    <blockquote class="text-sm/6 text-zinc-300">{{ quote.body }}</blockquote>
                    <figcaption class="mt-3 font-mono text-[11px] text-zinc-500">{{ quote.name }} — {{ quote.role }}</figcaption>
                </figure>
            </UiMarquee>
            VUE;

            $quoteReactCode = <<<'REACT'
            <UiMarquee vertical speed={16} reverse className="h-56 w-full max-w-sm">
                {quotes.map((quote) => (
                    <figure key={quote.name} className="w-full rounded-xl border border-white/10 bg-ink-900 p-4">
                        <blockquote className="text-sm/6 text-zinc-300">{quote.body}</blockquote>
                        <figcaption className="mt-3 font-mono text-[11px] text-zinc-500">
                            {quote.name} — {quote.role}
                        </figcaption>
                    </figure>
                ))}
            </UiMarquee>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Logo row"
                description="Speed is seconds per full loop, so a longer list needs a longer duration to keep the same apparent pace. Hovering parks it; the edges fade out through a mask instead of a gradient overlay, so it works on any background."
                :code="$logoCode" :vue-code="$logoVueCode" :react-code="$logoReactCode">
                <x-ui.marquee :speed="18" class="w-full max-w-md">
                    @foreach ($logos as $logo)
                        <span class="rounded-full border border-white/10 px-3.5 py-1.5 font-mono text-xs whitespace-nowrap text-zinc-400">{{ $logo }}</span>
                    @endforeach
                </x-ui.marquee>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Vertical testimonials"
                description="Vertical needs a height on the wrapper — that is the window it scrolls through. Reverse flips the direction without a second set of keyframes."
                :code="$quoteCode" :vue-code="$quoteVueCode" :react-code="$quoteReactCode" padding="p-6">
                <x-ui.marquee vertical :speed="16" reverse class="h-56 w-full max-w-sm">
                    @foreach ($quotes as $quote)
                        <figure class="w-full rounded-xl border border-white/10 bg-ink-900 p-4">
                            <blockquote class="text-sm/6 text-zinc-300">{{ $quote['body'] }}</blockquote>
                            <figcaption class="mt-3 font-mono text-[11px] text-zinc-500">{{ $quote['name'] }} — {{ $quote['role'] }}</figcaption>
                        </figure>
                    @endforeach
                </x-ui.marquee>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="marquee" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
