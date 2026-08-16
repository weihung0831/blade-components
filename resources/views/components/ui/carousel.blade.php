@props([
    'items' => [],
    'active' => 0,
    'autoplay' => 0,
    'loop' => true,
    'arrows' => true,
    'indicators' => true,
    'ratio' => 'aspect-video',
])

@php
    $current = max(0, min((int) $active, count($items) - 1));

    $arrow = 'absolute top-1/2 grid size-8 -translate-y-1/2 cursor-pointer place-items-center rounded-full border border-white/10 bg-ink-950/70 text-cream backdrop-blur-sm transition-colors duration-150 outline-none hover:bg-ink-950 focus-visible:ring-2 focus-visible:ring-jade-500/70';
@endphp

<div data-ui-carousel data-index="{{ $current }}" data-loop="{{ $loop ? 'true' : 'false' }}" data-autoplay="{{ (int) $autoplay }}"
    role="region" aria-roledescription="carousel" {{ $attributes }}>
    <div class="relative overflow-hidden rounded-xl border border-white/10 bg-ink-900">
        <div data-ui-carousel-track class="flex transition-transform duration-500 ease-snap" style="transform: translateX(-{{ $current * 100 }}%)">
            @foreach ($items as $index => $item)
                <figure class="relative w-full shrink-0 {{ $ratio }}" @if ($index !== $current) inert @endif>
                    <img src="{{ $item['src'] }}" alt="{{ $item['alt'] ?? '' }}" class="size-full object-cover" @if ($index !== $current) loading="lazy" @endif>
                    @isset($item['caption'])
                        <figcaption class="absolute inset-x-0 bottom-0 bg-linear-to-t from-ink-950 via-ink-950/70 to-transparent px-4 pt-10 pb-4">
                            <p class="text-sm font-medium text-cream">{{ $item['caption'] }}</p>
                            @isset($item['meta'])
                                <p class="mt-0.5 font-mono text-[11px] text-zinc-400">{{ $item['meta'] }}</p>
                            @endisset
                        </figcaption>
                    @endisset
                </figure>
            @endforeach
        </div>

        @if ($arrows)
            <button type="button" data-ui-carousel-prev aria-label="Previous slide" class="left-3 {{ $arrow }}">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" data-ui-carousel-next aria-label="Next slide" class="right-3 {{ $arrow }}">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        @endif
    </div>

    @if ($indicators)
        <div class="mt-3 flex justify-center gap-1.5">
            @foreach ($items as $index => $item)
                <button type="button" data-ui-carousel-dot="{{ $index }}" aria-label="Slide {{ $index + 1 }}"
                    @if ($index === $current) data-active @endif
                    class="h-1 w-1 cursor-pointer rounded-full bg-white/15 transition-[width,background-color] duration-300 ease-snap outline-none hover:bg-white/30 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:w-4 data-active:bg-jade-500"></button>
            @endforeach
        </div>
    @endif
</div>

@once
    <script>
        (() => {
            const slide = (root, index) => {
                const track = root.querySelector('[data-ui-carousel-track]');
                const slides = [...track.children];
                const next = root.dataset.loop === 'true'
                    ? (index + slides.length) % slides.length
                    : Math.min(slides.length - 1, Math.max(0, index));

                root.dataset.index = next;
                track.style.transform = `translateX(-${next * 100}%)`;
                slides.forEach((figure, position) => figure.toggleAttribute('inert', position !== next));
                root.querySelectorAll('[data-ui-carousel-dot]').forEach((dot, position) => dot.toggleAttribute('data-active', position === next));
            };

            document.addEventListener('click', (event) => {
                const control = event.target.closest('[data-ui-carousel-prev], [data-ui-carousel-next], [data-ui-carousel-dot]');

                if (!control) {
                    return;
                }

                const root = control.closest('[data-ui-carousel]');
                const index = Number(root.dataset.index);
                const dot = control.dataset.uiCarouselDot;

                slide(root, dot !== undefined ? Number(dot) : index + (control.hasAttribute('data-ui-carousel-next') ? 1 : -1));
            });

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('[data-ui-carousel]').forEach((root) => {
                    const delay = Number(root.dataset.autoplay);

                    if (delay > 0) {
                        setInterval(() => {
                            if (!root.matches(':hover') && !root.contains(document.activeElement) && !document.hidden) {
                                slide(root, Number(root.dataset.index) + 1);
                            }
                        }, delay);
                    }
                });
            });
        })();
    </script>
@endonce
