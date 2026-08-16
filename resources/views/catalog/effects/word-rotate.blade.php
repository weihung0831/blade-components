<x-layout title="Word rotate — BLADE-COMPONENTS">
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
                    One word swapped for the next, sliding up into a clipped box. Where the typewriter spells things out, this one just cuts — better when the surrounding sentence has to stay readable.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $headlineWords = ['faster', 'safer', 'together'];
            $roleWords = ['billing', 'provisioning', 'metering', 'invoicing'];

            $headlineCode = <<<'BLADE'
            <p class="text-2xl font-semibold tracking-tight text-cream">
                Ship <x-ui.word-rotate class="text-jade-400" :words="['faster', 'safer', 'together']" />
            </p>
            BLADE;

            $headlineVueCode = <<<'VUE'
            <p class="text-2xl font-semibold tracking-tight text-cream">
                Ship <UiWordRotate class="text-jade-400" :words="['faster', 'safer', 'together']" />
            </p>
            VUE;

            $headlineReactCode = <<<'REACT'
            <p className="text-2xl font-semibold tracking-tight text-cream">
                Ship <UiWordRotate className="text-jade-400" words={['faster', 'safer', 'together']} />
            </p>
            REACT;

            $pillCode = <<<'BLADE'
            <div class="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 py-1.5 pr-4 pl-3">
                <span class="size-1.5 rounded-full bg-jade-500"></span>
                <span class="font-mono text-xs text-zinc-500">Now handling</span>
                <x-ui.word-rotate class="font-mono text-xs text-cream" :interval="1500" :duration="280"
                    :words="['billing', 'provisioning', 'metering', 'invoicing']" />
            </div>
            BLADE;

            $pillVueCode = <<<'VUE'
            <div class="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 py-1.5 pr-4 pl-3">
                <span class="size-1.5 rounded-full bg-jade-500"></span>
                <span class="font-mono text-xs text-zinc-500">Now handling</span>
                <UiWordRotate
                    class="font-mono text-xs text-cream"
                    :interval="1500"
                    :duration="280"
                    :words="['billing', 'provisioning', 'metering', 'invoicing']"
                />
            </div>
            VUE;

            $pillReactCode = <<<'REACT'
            <div className="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 py-1.5 pr-4 pl-3">
                <span className="size-1.5 rounded-full bg-jade-500" />
                <span className="font-mono text-xs text-zinc-500">Now handling</span>
                <UiWordRotate
                    className="font-mono text-xs text-cream"
                    interval={1500}
                    duration={280}
                    words={['billing', 'provisioning', 'metering', 'invoicing']}
                />
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="In a headline"
                description="The box is an inline grid, so it takes the width of whatever word is showing and the line reflows around it. Colour it separately from the sentence and the swap reads as deliberate."
                :code="$headlineCode" :vue-code="$headlineVueCode" :react-code="$headlineReactCode">
                <p class="text-2xl font-semibold tracking-tight text-cream">
                    Ship <x-ui.word-rotate class="text-jade-400" :words="$headlineWords" />
                </p>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Status pill"
                description="Short interval, short duration — at this size the motion should be over before it draws attention. The first word is in the HTML, so the pill is never blank."
                :code="$pillCode" :vue-code="$pillVueCode" :react-code="$pillReactCode">
                <div class="flex items-center gap-2 rounded-full border border-white/10 bg-ink-900 py-1.5 pr-4 pl-3">
                    <span class="size-1.5 rounded-full bg-jade-500"></span>
                    <span class="font-mono text-xs text-zinc-500">Now handling</span>
                    <x-ui.word-rotate class="font-mono text-xs text-cream" :interval="1500" :duration="280" :words="$roleWords" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="word-rotate" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
