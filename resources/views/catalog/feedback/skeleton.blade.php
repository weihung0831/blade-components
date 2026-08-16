<x-layout title="Skeleton — BLADE-COMPONENTS">
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
                    A gray stand-in that holds the layout while data loads. One primitive, three shapes — compose them into whatever the real content will be.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $shapesCode = <<<'BLADE'
            <x-ui.skeleton variant="circle" class="size-10" />
            <x-ui.skeleton class="w-48" />
            <x-ui.skeleton variant="rect" class="h-16 w-48" />
            BLADE;

            $shapesVueCode = <<<'VUE'
            <UiSkeleton variant="circle" class="size-10" />
            <UiSkeleton class="w-48" />
            <UiSkeleton variant="rect" class="h-16 w-48" />
            VUE;

            $shapesReactCode = <<<'REACT'
            <UiSkeleton variant="circle" className="size-10" />
            <UiSkeleton className="w-48" />
            <UiSkeleton variant="rect" className="h-16 w-48" />
            REACT;

            $cardCode = <<<'BLADE'
            <div class="w-80 rounded-xl border border-white/10 bg-ink-900 p-4">
                <div class="flex items-center gap-3">
                    <x-ui.skeleton variant="circle" class="size-9 shrink-0" />
                    <div class="flex-1">
                        <x-ui.skeleton class="w-3/4" />
                        <x-ui.skeleton class="mt-2 w-1/2" />
                    </div>
                </div>
                <x-ui.skeleton variant="rect" class="mt-4 h-24" />
                <div class="mt-4 flex gap-2">
                    <x-ui.skeleton variant="rect" class="h-8 w-20" />
                    <x-ui.skeleton variant="rect" class="h-8 w-20" />
                </div>
            </div>
            BLADE;

            $cardVueCode = <<<'VUE'
            <div class="w-80 rounded-xl border border-white/10 bg-ink-900 p-4">
                <div class="flex items-center gap-3">
                    <UiSkeleton variant="circle" class="size-9 shrink-0" />
                    <div class="flex-1">
                        <UiSkeleton class="w-3/4" />
                        <UiSkeleton class="mt-2 w-1/2" />
                    </div>
                </div>
                <UiSkeleton variant="rect" class="mt-4 h-24" />
                <div class="mt-4 flex gap-2">
                    <UiSkeleton variant="rect" class="h-8 w-20" />
                    <UiSkeleton variant="rect" class="h-8 w-20" />
                </div>
            </div>
            VUE;

            $cardReactCode = <<<'REACT'
            <div className="w-80 rounded-xl border border-white/10 bg-ink-900 p-4">
                <div className="flex items-center gap-3">
                    <UiSkeleton variant="circle" className="size-9 shrink-0" />
                    <div className="flex-1">
                        <UiSkeleton className="w-3/4" />
                        <UiSkeleton className="mt-2 w-1/2" />
                    </div>
                </div>
                <UiSkeleton variant="rect" className="mt-4 h-24" />
                <div className="mt-4 flex gap-2">
                    <UiSkeleton variant="rect" className="h-8 w-20" />
                    <UiSkeleton variant="rect" className="h-8 w-20" />
                </div>
            </div>
            REACT;

            $waveCode = <<<'BLADE'
            <x-ui.skeleton animation="wave" variant="rect" class="h-16 w-80" />
            <x-ui.skeleton animation="wave" class="w-80" />
            <x-ui.skeleton animation="wave" class="w-56" />
            BLADE;

            $waveVueCode = <<<'VUE'
            <UiSkeleton animation="wave" variant="rect" class="h-16 w-80" />
            <UiSkeleton animation="wave" class="w-80" />
            <UiSkeleton animation="wave" class="w-56" />
            VUE;

            $waveReactCode = <<<'REACT'
            <UiSkeleton animation="wave" variant="rect" className="h-16 w-80" />
            <UiSkeleton animation="wave" className="w-80" />
            <UiSkeleton animation="wave" className="w-56" />
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Shapes"
                description="Text is the default and sets its own height; circle and rect take theirs from your classes."
                :code="$shapesCode" :vue-code="$shapesVueCode" :react-code="$shapesReactCode">
                <div class="flex items-center gap-6">
                    <x-ui.skeleton variant="circle" class="size-10" />
                    <x-ui.skeleton class="w-48" />
                    <x-ui.skeleton variant="rect" class="h-16 w-48" />
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="Card placeholder"
                description="Mirror the finished layout so nothing jumps when the data lands."
                :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                <div class="w-80 rounded-xl border border-white/10 bg-ink-900 p-4">
                    <div class="flex items-center gap-3">
                        <x-ui.skeleton variant="circle" class="size-9 shrink-0" />
                        <div class="flex-1">
                            <x-ui.skeleton class="w-3/4" />
                            <x-ui.skeleton class="mt-2 w-1/2" />
                        </div>
                    </div>
                    <x-ui.skeleton variant="rect" class="mt-4 h-24" />
                    <div class="mt-4 flex gap-2">
                        <x-ui.skeleton variant="rect" class="h-8 w-20" />
                        <x-ui.skeleton variant="rect" class="h-8 w-20" />
                    </div>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="Wave"
                description="A highlight sweeps left to right instead of pulsing. Set animation to none for a static block."
                :code="$waveCode" :vue-code="$waveVueCode" :react-code="$waveReactCode">
                <div class="flex flex-col gap-3">
                    <x-ui.skeleton animation="wave" variant="rect" class="h-16 w-80" />
                    <x-ui.skeleton animation="wave" class="w-80" />
                    <x-ui.skeleton animation="wave" class="w-56" />
                </div>
            </x-demo>

            <x-install class="rise" style="animation-delay: 300ms" slug="skeleton" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
