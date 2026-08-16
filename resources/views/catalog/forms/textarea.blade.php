<x-layout title="Textarea — BLADE-COMPONENTS">
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
                    A multi-line field that shares the input's look, label, and error handling. Optional auto-growing height — all CSS.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.textarea label="Release notes" rows="3"
                placeholder="What changed in this deploy?" />
            BLADE;

            $basicJsCode = <<<'JS'
            <UiTextarea label="Release notes" rows="3"
                placeholder="What changed in this deploy?" />
            JS;

            $invalidCode = <<<'BLADE'
            <x-ui.textarea label="Cancellation reason" rows="3"
                error="Tell us a little more — 20 characters minimum." />
            BLADE;

            $invalidJsCode = <<<'JS'
            <UiTextarea label="Cancellation reason" rows="3"
                error="Tell us a little more — 20 characters minimum." />
            JS;

            $autoResizeCode = <<<'BLADE'
            <x-ui.textarea label="Notes" :auto-resize="true" rows="2"
                placeholder="Type — the field grows with you." />
            BLADE;

            $autoResizeVueCode = <<<'VUE'
            <UiTextarea label="Notes" auto-resize rows="2"
                placeholder="Type — the field grows with you." />
            VUE;

            $autoResizeReactCode = <<<'REACT'
            <UiTextarea label="Notes" autoResize rows="2"
                placeholder="Type — the field grows with you." />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basic"
                description="Same props as the input: label, hint, error. Rows and any other attribute pass through."
                :code="$basicCode" :vue-code="$basicJsCode" :react-code="$basicJsCode">
                <div class="w-80">
                    <x-ui.textarea label="Release notes" rows="3" placeholder="What changed in this deploy?" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Invalid"
                description="Pass error to flag the field and show the message below it."
                :code="$invalidCode" :vue-code="$invalidJsCode" :react-code="$invalidJsCode">
                <div class="w-80">
                    <x-ui.textarea label="Cancellation reason" rows="3" error="Tell us a little more — 20 characters minimum." />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Auto-grow"
                description="auto-resize swaps the manual resize handle for field-sizing: content — the field tracks its text."
                :code="$autoResizeCode" :vue-code="$autoResizeVueCode" :react-code="$autoResizeReactCode">
                <div class="w-80">
                    <x-ui.textarea label="Notes" :auto-resize="true" rows="2" placeholder="Type — the field grows with you." />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="textarea" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
