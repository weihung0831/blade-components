<x-layout title="Gallery — BLADE-COMPONENTS">
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
                    Thumbnails plus a lightbox built on the native dialog — Escape closes it, the backdrop closes it, and the arrow keys walk the set. Same items array either way; the variant decides the layout.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $assets = [
                ['src' => '/img/media/placeholder-01.svg', 'alt' => 'Cover one', 'caption' => 'cover-01.png', 'meta' => '2400 × 1600 · 412 KB'],
                ['src' => '/img/media/placeholder-02.svg', 'alt' => 'Cover two', 'caption' => 'cover-02.png', 'meta' => '2400 × 1600 · 288 KB'],
                ['src' => '/img/media/placeholder-03.svg', 'alt' => 'Cover three', 'caption' => 'cover-03.png', 'meta' => '2400 × 1600 · 355 KB'],
                ['src' => '/img/media/placeholder-04.svg', 'alt' => 'Cover four', 'caption' => 'cover-04.png', 'meta' => '2400 × 1600 · 194 KB'],
                ['src' => '/img/media/placeholder-05.svg', 'alt' => 'Cover five', 'caption' => 'cover-05.png', 'meta' => '2400 × 1600 · 226 KB'],
                ['src' => '/img/media/placeholder-06.svg', 'alt' => 'Cover six', 'caption' => 'cover-06.png', 'meta' => '2400 × 1600 · 173 KB'],
            ];

            $shots = [
                ['src' => '/img/media/placeholder-01.svg', 'alt' => 'Overview screen', 'caption' => 'Overview', 'meta' => 'Shipped 4 Aug'],
                ['src' => '/img/media/placeholder-02.svg', 'alt' => 'Latency screen', 'caption' => 'Latency', 'meta' => 'Shipped 4 Aug'],
                ['src' => '/img/media/placeholder-03.svg', 'alt' => 'Regions screen', 'caption' => 'Regions', 'meta' => 'Shipped 11 Aug'],
                ['src' => '/img/media/placeholder-04.svg', 'alt' => 'Retention screen', 'caption' => 'Retention', 'meta' => 'Shipped 11 Aug'],
            ];

            $gridCode = <<<'BLADE'
            <x-ui.gallery class="w-full max-w-lg" :columns="3" :items="[
                ['src' => '/img/media/placeholder-01.svg', 'alt' => 'Cover one', 'caption' => 'cover-01.png', 'meta' => '2400 × 1600 · 412 KB'],
                ['src' => '/img/media/placeholder-02.svg', 'alt' => 'Cover two', 'caption' => 'cover-02.png', 'meta' => '2400 × 1600 · 288 KB'],
                ['src' => '/img/media/placeholder-03.svg', 'alt' => 'Cover three', 'caption' => 'cover-03.png', 'meta' => '2400 × 1600 · 355 KB'],
                ['src' => '/img/media/placeholder-04.svg', 'alt' => 'Cover four', 'caption' => 'cover-04.png', 'meta' => '2400 × 1600 · 194 KB'],
                ['src' => '/img/media/placeholder-05.svg', 'alt' => 'Cover five', 'caption' => 'cover-05.png', 'meta' => '2400 × 1600 · 226 KB'],
                ['src' => '/img/media/placeholder-06.svg', 'alt' => 'Cover six', 'caption' => 'cover-06.png', 'meta' => '2400 × 1600 · 173 KB'],
            ]" />
            BLADE;

            $gridVueCode = <<<'VUE'
            <UiGallery
                class="w-full max-w-lg"
                :columns="3"
                :items="[
                    { src: '/img/media/placeholder-01.svg', alt: 'Cover one', caption: 'cover-01.png', meta: '2400 × 1600 · 412 KB' },
                    { src: '/img/media/placeholder-02.svg', alt: 'Cover two', caption: 'cover-02.png', meta: '2400 × 1600 · 288 KB' },
                    { src: '/img/media/placeholder-03.svg', alt: 'Cover three', caption: 'cover-03.png', meta: '2400 × 1600 · 355 KB' },
                    { src: '/img/media/placeholder-04.svg', alt: 'Cover four', caption: 'cover-04.png', meta: '2400 × 1600 · 194 KB' },
                    { src: '/img/media/placeholder-05.svg', alt: 'Cover five', caption: 'cover-05.png', meta: '2400 × 1600 · 226 KB' },
                    { src: '/img/media/placeholder-06.svg', alt: 'Cover six', caption: 'cover-06.png', meta: '2400 × 1600 · 173 KB' },
                ]"
            />
            VUE;

            $gridReactCode = <<<'REACT'
            <UiGallery
                className="w-full max-w-lg"
                columns={3}
                items={[
                    { src: '/img/media/placeholder-01.svg', alt: 'Cover one', caption: 'cover-01.png', meta: '2400 × 1600 · 412 KB' },
                    { src: '/img/media/placeholder-02.svg', alt: 'Cover two', caption: 'cover-02.png', meta: '2400 × 1600 · 288 KB' },
                    { src: '/img/media/placeholder-03.svg', alt: 'Cover three', caption: 'cover-03.png', meta: '2400 × 1600 · 355 KB' },
                    { src: '/img/media/placeholder-04.svg', alt: 'Cover four', caption: 'cover-04.png', meta: '2400 × 1600 · 194 KB' },
                    { src: '/img/media/placeholder-05.svg', alt: 'Cover five', caption: 'cover-05.png', meta: '2400 × 1600 · 226 KB' },
                    { src: '/img/media/placeholder-06.svg', alt: 'Cover six', caption: 'cover-06.png', meta: '2400 × 1600 · 173 KB' },
                ]}
            />
            REACT;

            $filmstripCode = <<<'BLADE'
            <x-ui.gallery variant="filmstrip" class="w-full max-w-md" :items="[
                ['src' => '/img/media/placeholder-01.svg', 'alt' => 'Overview screen', 'caption' => 'Overview', 'meta' => 'Shipped 4 Aug'],
                ['src' => '/img/media/placeholder-02.svg', 'alt' => 'Latency screen', 'caption' => 'Latency', 'meta' => 'Shipped 4 Aug'],
                ['src' => '/img/media/placeholder-03.svg', 'alt' => 'Regions screen', 'caption' => 'Regions', 'meta' => 'Shipped 11 Aug'],
                ['src' => '/img/media/placeholder-04.svg', 'alt' => 'Retention screen', 'caption' => 'Retention', 'meta' => 'Shipped 11 Aug'],
            ]" />
            BLADE;

            $filmstripVueCode = <<<'VUE'
            <UiGallery
                variant="filmstrip"
                class="w-full max-w-md"
                :items="[
                    { src: '/img/media/placeholder-01.svg', alt: 'Overview screen', caption: 'Overview', meta: 'Shipped 4 Aug' },
                    { src: '/img/media/placeholder-02.svg', alt: 'Latency screen', caption: 'Latency', meta: 'Shipped 4 Aug' },
                    { src: '/img/media/placeholder-03.svg', alt: 'Regions screen', caption: 'Regions', meta: 'Shipped 11 Aug' },
                    { src: '/img/media/placeholder-04.svg', alt: 'Retention screen', caption: 'Retention', meta: 'Shipped 11 Aug' },
                ]"
            />
            VUE;

            $filmstripReactCode = <<<'REACT'
            <UiGallery
                variant="filmstrip"
                className="w-full max-w-md"
                items={[
                    { src: '/img/media/placeholder-01.svg', alt: 'Overview screen', caption: 'Overview', meta: 'Shipped 4 Aug' },
                    { src: '/img/media/placeholder-02.svg', alt: 'Latency screen', caption: 'Latency', meta: 'Shipped 4 Aug' },
                    { src: '/img/media/placeholder-03.svg', alt: 'Regions screen', caption: 'Regions', meta: 'Shipped 11 Aug' },
                    { src: '/img/media/placeholder-04.svg', alt: 'Retention screen', caption: 'Retention', meta: 'Shipped 11 Aug' },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Grid" padding="p-8"
                description="Square tiles for an asset library. The caption slides up on hover; clicking a tile opens the lightbox at that image and the meta line carries whatever the file knows about itself."
                :code="$gridCode" :vue-code="$gridVueCode" :react-code="$gridReactCode">
                <x-ui.gallery class="w-full max-w-lg" :columns="3" :items="$assets" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Filmstrip" padding="p-8"
                description="A lead image over a thumbnail strip. Thumbs swap the lead in place instead of opening the lightbox — clicking the lead is what zooms."
                :code="$filmstripCode" :vue-code="$filmstripVueCode" :react-code="$filmstripReactCode">
                <x-ui.gallery variant="filmstrip" class="w-full max-w-md" :items="$shots" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="gallery" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
