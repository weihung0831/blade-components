<x-layout title="Typewriter — BLADE-COMPONENTS">
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
                    Types a list of phrases, deletes each one, moves to the next. The first word ships in the HTML, so there is no empty flash before the script wakes up — and if the visitor asked for reduced motion, that first word is simply where it stops.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $headlineWords = ['ships on Friday', 'scales to seats', 'bills itself'];
            $terminalWords = ['php artisan tenant:provision', 'php artisan queue:work --queue=billing', 'php artisan schedule:run'];

            $headlineCode = <<<'BLADE'
            <p class="text-2xl font-semibold tracking-tight text-cream">
                Software that
                <x-ui.typewriter class="text-jade-400" :words="['ships on Friday', 'scales to seats', 'bills itself']" />
            </p>
            BLADE;

            $headlineVueCode = <<<'VUE'
            <p class="text-2xl font-semibold tracking-tight text-cream">
                Software that
                <UiTypewriter class="text-jade-400" :words="['ships on Friday', 'scales to seats', 'bills itself']" />
            </p>
            VUE;

            $headlineReactCode = <<<'REACT'
            <p className="text-2xl font-semibold tracking-tight text-cream">
                Software that
                <UiTypewriter className="text-jade-400" words={['ships on Friday', 'scales to seats', 'bills itself']} />
            </p>
            REACT;

            $terminalCode = <<<'BLADE'
            <div class="w-full max-w-md rounded-xl border border-white/10 bg-ink-950 p-4 font-mono text-sm">
                <span class="text-jade-400">$&nbsp;</span>
                <x-ui.typewriter class="text-cream" :speed="45" :pause="2200" :words="[
                    'php artisan tenant:provision',
                    'php artisan queue:work --queue=billing',
                    'php artisan schedule:run',
                ]" />
            </div>
            BLADE;

            $terminalVueCode = <<<'VUE'
            <div class="w-full max-w-md rounded-xl border border-white/10 bg-ink-950 p-4 font-mono text-sm">
                <span class="text-jade-400">$&nbsp;</span>
                <UiTypewriter
                    class="text-cream"
                    :speed="45"
                    :pause="2200"
                    :words="[
                        'php artisan tenant:provision',
                        'php artisan queue:work --queue=billing',
                        'php artisan schedule:run',
                    ]"
                />
            </div>
            VUE;

            $terminalReactCode = <<<'REACT'
            <div className="w-full max-w-md rounded-xl border border-white/10 bg-ink-950 p-4 font-mono text-sm">
                <span className="text-jade-400">$&nbsp;</span>
                <UiTypewriter
                    className="text-cream"
                    speed={45}
                    pause={2200}
                    words={[
                        'php artisan tenant:provision',
                        'php artisan queue:work --queue=billing',
                        'php artisan schedule:run',
                    ]}
                />
            </div>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Headline"
                description="Deleting runs at half the typing speed, which is roughly how a person backspaces. Pause is how long a finished phrase sits before it starts erasing."
                :code="$headlineCode" :vue-code="$headlineVueCode" :react-code="$headlineReactCode">
                <p class="text-2xl font-semibold tracking-tight text-cream">
                    Software that
                    <x-ui.typewriter class="text-jade-400" :words="$headlineWords" />
                </p>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Terminal"
                description="Faster keystrokes and a longer hold reads like someone actually running commands. The cursor is decorative and hidden from screen readers — pass cursor as false to drop it."
                :code="$terminalCode" :vue-code="$terminalVueCode" :react-code="$terminalReactCode">
                <div class="w-full max-w-md rounded-xl border border-white/10 bg-ink-950 p-4 font-mono text-sm">
                    <span class="text-jade-400">$&nbsp;</span>
                    <x-ui.typewriter class="text-cream" :speed="45" :pause="2200" :words="$terminalWords" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="typewriter" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
