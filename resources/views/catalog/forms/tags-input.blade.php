<x-layout title="Tags input — BLADE-COMPONENTS">
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
                    Type, hit Enter or comma, get a chip. A hidden input keeps the comma-joined list so plain form submits still work.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicsCode = <<<'BLADE'
            <x-ui.tags-input label="Topics" name="topics" />
            BLADE;

            $seededCode = <<<'BLADE'
            <x-ui.tags-input label="Stack" name="stack"
                :tags="['laravel', 'blade', 'tailwind']" />
            BLADE;

            $basicsVueCode = <<<'VUE'
            <UiTagsInput v-model="topics" label="Topics" />
            VUE;

            $seededVueCode = <<<'VUE'
            <UiTagsInput v-model="stack" label="Stack" />
            VUE;

            $basicsReactCode = <<<'REACT'
            <UiTagsInput label="Topics" onChange={setTopics} />
            REACT;

            $seededReactCode = <<<'REACT'
            <UiTagsInput
                label="Stack"
                defaultTags={['laravel', 'blade', 'tailwind']}
                onChange={setStack}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Basics"
                description="Enter or comma adds a tag, Backspace on an empty field removes the last one, and every chip has its own remove button."
                :code="$basicsCode" :vue-code="$basicsVueCode" :react-code="$basicsReactCode">
                <x-ui.tags-input label="Topics" name="topics" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Seeded tags"
                description="Pass an array to start with chips already in place — handy for edit forms."
                :code="$seededCode" :vue-code="$seededVueCode" :react-code="$seededReactCode">
                <x-ui.tags-input label="Stack" name="stack" :tags="['laravel', 'blade', 'tailwind']" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="tags-input" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
