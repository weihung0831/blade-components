<x-layout title="Image compare — BLADE-COMPONENTS">
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
                    Two images stacked, the top one clipped to a CSS variable. Drag anywhere in the frame to move the seam, or focus the handle and nudge it with the arrow keys.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $horizontalCode = <<<'BLADE'
            <x-ui.image-compare
                class="w-full max-w-lg"
                before="/img/media/placeholder-before.svg"
                after="/img/media/placeholder-after.svg"
                before-alt="Screen before the change"
                after-alt="Screen after the change"
                before-label="v1.9"
                after-label="v2.4"
            />
            BLADE;

            $horizontalVueCode = <<<'VUE'
            <UiImageCompare
                class="w-full max-w-lg"
                before="/img/media/placeholder-before.svg"
                after="/img/media/placeholder-after.svg"
                before-alt="Screen before the change"
                after-alt="Screen after the change"
                before-label="v1.9"
                after-label="v2.4"
            />
            VUE;

            $horizontalReactCode = <<<'REACT'
            <UiImageCompare
                className="w-full max-w-lg"
                before="/img/media/placeholder-before.svg"
                after="/img/media/placeholder-after.svg"
                beforeAlt="Screen before the change"
                afterAlt="Screen after the change"
                beforeLabel="v1.9"
                afterLabel="v2.4"
            />
            REACT;

            $verticalCode = <<<'BLADE'
            <x-ui.image-compare
                orientation="vertical"
                :position="38"
                class="w-full max-w-sm"
                ratio="aspect-[4/3]"
                before="/img/media/placeholder-before.svg"
                after="/img/media/placeholder-after.svg"
                before-label="Raw"
                after-label="Graded"
            />
            BLADE;

            $verticalVueCode = <<<'VUE'
            <UiImageCompare
                orientation="vertical"
                :position="38"
                class="w-full max-w-sm"
                ratio="aspect-[4/3]"
                before="/img/media/placeholder-before.svg"
                after="/img/media/placeholder-after.svg"
                before-label="Raw"
                after-label="Graded"
            />
            VUE;

            $verticalReactCode = <<<'REACT'
            <UiImageCompare
                orientation="vertical"
                position={38}
                className="w-full max-w-sm"
                ratio="aspect-[4/3]"
                before="/img/media/placeholder-before.svg"
                after="/img/media/placeholder-after.svg"
                beforeLabel="Raw"
                afterLabel="Graded"
            />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Before and after" padding="p-8"
                description="The labels sit in opposite corners so the seam never covers them. Position takes a percentage if you want the frame to open somewhere other than the middle."
                :code="$horizontalCode" :vue-code="$horizontalVueCode" :react-code="$horizontalReactCode">
                <x-ui.image-compare
                    class="w-full max-w-lg"
                    before="/img/media/placeholder-before.svg"
                    after="/img/media/placeholder-after.svg"
                    before-alt="Screen before the change"
                    after-alt="Screen after the change"
                    before-label="v1.9"
                    after-label="v2.4"
                />
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Vertical" padding="p-8"
                description="Flip the orientation and the seam runs across instead of down. Ratio takes any aspect utility, so the frame can match the source instead of the other way round."
                :code="$verticalCode" :vue-code="$verticalVueCode" :react-code="$verticalReactCode">
                <x-ui.image-compare
                    orientation="vertical"
                    :position="38"
                    class="w-full max-w-sm"
                    ratio="aspect-[4/3]"
                    before="/img/media/placeholder-before.svg"
                    after="/img/media/placeholder-after.svg"
                    before-label="Raw"
                    after-label="Graded"
                />
            </x-demo>

            <x-install class="rise" style="animation-delay: 240ms" slug="image-compare" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
