<x-layout title="Pagination — BLADE-COMPONENTS">
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
                    Give it a page count and the current page; it works out the window, the ellipses, and which arrows are dead ends. Every page is a real link, so it survives with JavaScript off and search engines can crawl it.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $basicCode = <<<'BLADE'
            <x-ui.pagination :pages="8" :current="2" url="?page=:page" />
            BLADE;

            $basicVueCode = <<<'VUE'
            <UiPagination :pages="8" :current="2" url="?page=:page" />
            VUE;

            $basicReactCode = <<<'REACT'
            <UiPagination pages={8} current={2} url="?page=:page" />
            REACT;

            $simpleCode = <<<'BLADE'
            <x-ui.pagination variant="simple" :pages="24" :current="7" url="?page=:page" />

            <x-ui.pagination :pages="20" :current="11" :siblings="2" url="?page=:page" />
            BLADE;

            $simpleVueCode = <<<'VUE'
            <UiPagination variant="simple" :pages="24" :current="7" url="?page=:page" />

            <UiPagination :pages="20" :current="11" :siblings="2" url="?page=:page" />
            VUE;

            $simpleReactCode = <<<'REACT'
            <UiPagination variant="simple" pages={24} current={7} url="?page=:page" />

            <UiPagination pages={20} current={11} siblings={2} url="?page=:page" />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Numbered"
                description="The :page token in url is swapped for the real number. First and last are always shown, the rest collapse behind an ellipsis."
                :code="$basicCode" :vue-code="$basicVueCode" :react-code="$basicReactCode">
                <x-ui.pagination :pages="8" :current="2" url="?page=:page" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Compact and wider windows" padding="px-10 py-12"
                description="variant=simple drops the numbers for a page counter — the right call on mobile or over a long table. Raise siblings to keep more neighbours in view."
                :code="$simpleCode" :vue-code="$simpleVueCode" :react-code="$simpleReactCode">
                <div class="flex flex-col items-center gap-6">
                    <x-ui.pagination variant="simple" :pages="24" :current="7" url="?page=:page" />
                    <x-ui.pagination :pages="20" :current="11" :siblings="2" url="?page=:page" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="pagination" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
