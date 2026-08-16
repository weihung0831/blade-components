<x-layout title="Terminal — BLADE-COMPONENTS">
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
                    A terminal window in pure markup — title bar, prompt lines, and a blinking cursor. Nothing to hydrate.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $windowCode = <<<'BLADE'
            <x-ui.terminal
                class="w-80"
                title="deploy — production"
                :lines="[
                    ['type' => 'command', 'text' => 'php artisan migrate --force'],
                    ['type' => 'output', 'text' => 'Running migrations on production…'],
                    ['type' => 'success', 'text' => 'DONE in 1.2s'],
                ]"
                cursor
            />
            BLADE;

            $windowVueCode = <<<'VUE'
            <UiTerminal
                class="w-80"
                title="deploy — production"
                :lines="[
                    { type: 'command', text: 'php artisan migrate --force' },
                    { type: 'output', text: 'Running migrations on production…' },
                    { type: 'success', text: 'DONE in 1.2s' },
                ]"
                cursor
            />
            VUE;

            $windowReactCode = <<<'REACT'
            <UiTerminal
                className="w-80"
                title="deploy — production"
                lines={[
                    { type: 'command', text: 'php artisan migrate --force' },
                    { type: 'output', text: 'Running migrations on production…' },
                    { type: 'success', text: 'DONE in 1.2s' },
                ]}
                cursor
            />
            REACT;

            $plainCode = <<<'BLADE'
            <x-ui.terminal
                class="w-80"
                variant="plain"
                :lines="[
                    ['type' => 'command', 'text' => 'npm run build'],
                    ['type' => 'output', 'text' => 'vite v6.0.3 building for production…'],
                    ['type' => 'success', 'text' => '412 modules transformed'],
                ]"
            />
            BLADE;

            $plainVueCode = <<<'VUE'
            <UiTerminal
                class="w-80"
                variant="plain"
                :lines="[
                    { type: 'command', text: 'npm run build' },
                    { type: 'output', text: 'vite v6.0.3 building for production…' },
                    { type: 'success', text: '412 modules transformed' },
                ]"
            />
            VUE;

            $plainReactCode = <<<'REACT'
            <UiTerminal
                className="w-80"
                variant="plain"
                lines={[
                    { type: 'command', text: 'npm run build' },
                    { type: 'output', text: 'vite v6.0.3 building for production…' },
                    { type: 'success', text: '412 modules transformed' },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Window"
                description="The window variant adds a title bar with traffic-light dots. The cursor flag appends a blinking prompt."
                :code="$windowCode" :vue-code="$windowVueCode" :react-code="$windowReactCode">
                <x-ui.terminal
                    class="w-80"
                    title="deploy — production"
                    :lines="[
                        ['type' => 'command', 'text' => 'php artisan migrate --force'],
                        ['type' => 'output', 'text' => 'Running migrations on production…'],
                        ['type' => 'success', 'text' => 'DONE in 1.2s'],
                    ]"
                    cursor
                />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Plain"
                description="No chrome, just the prompt lines — for a command block inside docs or a setup step."
                :code="$plainCode" :vue-code="$plainVueCode" :react-code="$plainReactCode">
                <x-ui.terminal
                    class="w-80"
                    variant="plain"
                    :lines="[
                        ['type' => 'command', 'text' => 'npm run build'],
                        ['type' => 'output', 'text' => 'vite v6.0.3 building for production…'],
                        ['type' => 'success', 'text' => '412 modules transformed'],
                    ]"
                />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="terminal" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
