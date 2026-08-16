<x-layout title="Carousel — BLADE-COMPONENTS">
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
                    One slide at a time, driven by a translated track. Slides come from an array, so the dots and the arrow bounds stay in sync without you counting anything.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $tourSlides = [
                ['src' => '/img/media/placeholder-01.svg', 'alt' => 'Usage overview', 'caption' => 'Usage overview', 'meta' => 'Step 1 of 3'],
                ['src' => '/img/media/placeholder-02.svg', 'alt' => 'Region routing', 'caption' => 'Region routing', 'meta' => 'Step 2 of 3'],
                ['src' => '/img/media/placeholder-03.svg', 'alt' => 'Team seats', 'caption' => 'Team seats', 'meta' => 'Step 3 of 3'],
            ];

            $releaseSlides = [
                ['src' => '/img/media/placeholder-04.svg', 'alt' => 'Latency budget', 'caption' => 'Latency budget'],
                ['src' => '/img/media/placeholder-05.svg', 'alt' => 'Retention cohorts', 'caption' => 'Retention cohorts'],
                ['src' => '/img/media/placeholder-06.svg', 'alt' => 'Billing preview', 'caption' => 'Billing preview'],
            ];

            $tourCode = <<<'BLADE'
            <x-ui.carousel class="w-full max-w-md" :items="[
                ['src' => '/img/media/placeholder-01.svg', 'alt' => 'Usage overview', 'caption' => 'Usage overview', 'meta' => 'Step 1 of 3'],
                ['src' => '/img/media/placeholder-02.svg', 'alt' => 'Region routing', 'caption' => 'Region routing', 'meta' => 'Step 2 of 3'],
                ['src' => '/img/media/placeholder-03.svg', 'alt' => 'Team seats', 'caption' => 'Team seats', 'meta' => 'Step 3 of 3'],
            ]" />
            BLADE;

            $tourVueCode = <<<'VUE'
            <UiCarousel
                class="w-full max-w-md"
                :items="[
                    { src: '/img/media/placeholder-01.svg', alt: 'Usage overview', caption: 'Usage overview', meta: 'Step 1 of 3' },
                    { src: '/img/media/placeholder-02.svg', alt: 'Region routing', caption: 'Region routing', meta: 'Step 2 of 3' },
                    { src: '/img/media/placeholder-03.svg', alt: 'Team seats', caption: 'Team seats', meta: 'Step 3 of 3' },
                ]"
            />
            VUE;

            $tourReactCode = <<<'REACT'
            <UiCarousel
                className="w-full max-w-md"
                items={[
                    { src: '/img/media/placeholder-01.svg', alt: 'Usage overview', caption: 'Usage overview', meta: 'Step 1 of 3' },
                    { src: '/img/media/placeholder-02.svg', alt: 'Region routing', caption: 'Region routing', meta: 'Step 2 of 3' },
                    { src: '/img/media/placeholder-03.svg', alt: 'Team seats', caption: 'Team seats', meta: 'Step 3 of 3' },
                ]}
            />
            REACT;

            $releaseCode = <<<'BLADE'
            <x-ui.carousel class="w-full max-w-md" :autoplay="4000" :arrows="false" :items="[
                ['src' => '/img/media/placeholder-04.svg', 'alt' => 'Latency budget', 'caption' => 'Latency budget'],
                ['src' => '/img/media/placeholder-05.svg', 'alt' => 'Retention cohorts', 'caption' => 'Retention cohorts'],
                ['src' => '/img/media/placeholder-06.svg', 'alt' => 'Billing preview', 'caption' => 'Billing preview'],
            ]" />
            BLADE;

            $releaseVueCode = <<<'VUE'
            <UiCarousel
                class="w-full max-w-md"
                :autoplay="4000"
                :arrows="false"
                :items="[
                    { src: '/img/media/placeholder-04.svg', alt: 'Latency budget', caption: 'Latency budget' },
                    { src: '/img/media/placeholder-05.svg', alt: 'Retention cohorts', caption: 'Retention cohorts' },
                    { src: '/img/media/placeholder-06.svg', alt: 'Billing preview', caption: 'Billing preview' },
                ]"
            />
            VUE;

            $releaseReactCode = <<<'REACT'
            <UiCarousel
                className="w-full max-w-md"
                autoplay={4000}
                arrows={false}
                items={[
                    { src: '/img/media/placeholder-04.svg', alt: 'Latency budget', caption: 'Latency budget' },
                    { src: '/img/media/placeholder-05.svg', alt: 'Retention cohorts', caption: 'Retention cohorts' },
                    { src: '/img/media/placeholder-06.svg', alt: 'Billing preview', caption: 'Billing preview' },
                ]}
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Arrows and dots"
                description="A caption key paints the gradient strip over the image, meta adds the mono line under it. Off-screen slides are inert, so tabbing never lands somewhere invisible."
                :code="$tourCode" :vue-code="$tourVueCode" :react-code="$tourReactCode">
                <x-ui.carousel class="w-full max-w-md" :items="$tourSlides" />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Autoplay"
                description="Pass a delay in milliseconds and it advances on its own — pausing while the pointer is over it, while focus is inside it, and while the tab sits in the background."
                :code="$releaseCode" :vue-code="$releaseVueCode" :react-code="$releaseReactCode">
                <x-ui.carousel class="w-full max-w-md" :autoplay="4000" :arrows="false" :items="$releaseSlides" />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="carousel" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
