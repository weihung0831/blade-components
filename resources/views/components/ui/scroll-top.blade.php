@props([
    'threshold' => 400,
    'variant' => 'solid',
    'anchor' => 'viewport',
])

@php
    $anchors = [
        'viewport' => 'fixed right-6 bottom-6',
        'container' => 'absolute right-4 bottom-4',
    ];

    $variants = [
        'solid' => 'bg-jade-500 text-ink-950 shadow-lg shadow-jade-500/25 hover:bg-jade-400',
        'progress' => 'border border-white/10 bg-ink-900 text-cream shadow-lg shadow-black/40 hover:border-white/25',
    ];
@endphp

<button type="button" data-ui-scroll-top data-threshold="{{ $threshold }}" aria-label="Back to top"
    {{ $attributes->merge(['class' => 'invisible z-30 grid size-11 translate-y-2 cursor-pointer place-items-center rounded-full opacity-0 transition-[opacity,translate,visibility,background-color,border-color] duration-200 ease-snap outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 data-visible:visible data-visible:translate-y-0 data-visible:opacity-100 '.($anchors[$anchor] ?? $anchors['viewport']).' '.($variants[$variant] ?? $variants['solid'])]) }}>
    @if ($variant === 'progress')
        <span aria-hidden="true" class="absolute inset-0 rounded-full"
            style="background: conic-gradient(var(--color-jade-500) calc(var(--ui-progress, 0) * 1%), color-mix(in oklab, var(--color-white) 12%, transparent) 0); -webkit-mask: radial-gradient(closest-side, transparent 78%, black 80%); mask: radial-gradient(closest-side, transparent 78%, black 80%);"></span>
    @endif
    <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M8 12.5v-9M4 7l4-3.5L12 7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
</button>

@once
    <script>
        const scrollTopRegion = (button) =>
            button.parentElement.querySelector('[data-ui-scroll-region]') ?? button.closest('[data-ui-scroll-region]');

        const updateScrollTops = () => {
            document.querySelectorAll('[data-ui-scroll-top]').forEach((button) => {
                const region = scrollTopRegion(button);
                const top = region ? region.scrollTop : window.scrollY;
                const max = region
                    ? region.scrollHeight - region.clientHeight
                    : document.documentElement.scrollHeight - window.innerHeight;

                button.toggleAttribute('data-visible', top > Number(button.dataset.threshold || 400));
                button.style.setProperty('--ui-progress', max > 0 ? Math.round((top / max) * 100) : 0);
            });
        };

        document.addEventListener('scroll', updateScrollTops, { capture: true, passive: true });
        document.addEventListener('DOMContentLoaded', updateScrollTops);

        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-ui-scroll-top]');

            if (!button) {
                return;
            }

            const region = scrollTopRegion(button);
            const behavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';

            (region ?? window).scrollTo({ top: 0, behavior });
        });

        updateScrollTops();
    </script>
@endonce
