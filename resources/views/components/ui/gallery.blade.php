@props([
    'items' => [],
    'variant' => 'grid',
    'columns' => 3,
    'active' => 0,
])

@php
    $current = max(0, min((int) $active, count($items) - 1));
    $lead = $items[$current] ?? null;

    $grids = [
        2 => 'grid-cols-2',
        3 => 'grid-cols-3',
        4 => 'grid-cols-2 sm:grid-cols-4',
    ];

    $step = 'grid size-8 cursor-pointer place-items-center rounded-full border border-white/10 bg-ink-950/70 text-cream backdrop-blur-sm transition-colors duration-150 outline-none hover:bg-ink-950 focus-visible:ring-2 focus-visible:ring-jade-500/70';
@endphp

<div data-ui-gallery data-index="{{ $current }}" data-variant="{{ $variant }}" {{ $attributes }}>
    @if ($variant === 'filmstrip')
        <figure class="relative overflow-hidden rounded-xl border border-white/10 bg-ink-900">
            <button type="button" data-ui-gallery-zoom aria-label="Open full size" class="block aspect-video w-full cursor-zoom-in outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 focus-visible:ring-inset">
                <img data-ui-gallery-frame src="{{ $lead['src'] ?? '' }}" alt="{{ $lead['alt'] ?? '' }}" class="size-full object-cover">
            </button>
            <figcaption class="pointer-events-none absolute inset-x-0 bottom-0 bg-linear-to-t from-ink-950 via-ink-950/70 to-transparent px-4 pt-10 pb-3">
                <p data-ui-gallery-title class="text-sm font-medium text-cream">{{ $lead['caption'] ?? '' }}</p>
                <p data-ui-gallery-meta class="mt-0.5 font-mono text-[11px] text-zinc-400">{{ $lead['meta'] ?? '' }}</p>
            </figcaption>
        </figure>

        <div class="mt-2 grid grid-cols-4 gap-1.5">
            @foreach ($items as $index => $item)
                <button type="button" data-ui-gallery-item
                    data-src="{{ $item['src'] }}" data-alt="{{ $item['alt'] ?? '' }}"
                    data-caption="{{ $item['caption'] ?? '' }}" data-meta="{{ $item['meta'] ?? '' }}"
                    aria-label="{{ $item['caption'] ?? 'Image '.($index + 1) }}"
                    @if ($index === $current) data-active @endif
                    class="aspect-[4/3] cursor-pointer overflow-hidden rounded-md border border-white/10 opacity-50 transition-[opacity,border-color] duration-200 outline-none hover:opacity-90 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:border-jade-500 data-active:opacity-100">
                    <img src="{{ $item['src'] }}" alt="" loading="lazy" class="size-full object-cover">
                </button>
            @endforeach
        </div>
    @else
        <div class="grid gap-2 {{ $grids[(int) $columns] ?? $grids[3] }}">
            @foreach ($items as $index => $item)
                <button type="button" data-ui-gallery-item
                    data-src="{{ $item['src'] }}" data-alt="{{ $item['alt'] ?? '' }}"
                    data-caption="{{ $item['caption'] ?? '' }}" data-meta="{{ $item['meta'] ?? '' }}"
                    aria-label="{{ $item['caption'] ?? 'Image '.($index + 1) }}"
                    class="group relative aspect-square cursor-zoom-in overflow-hidden rounded-lg border border-white/10 bg-ink-900 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    <img src="{{ $item['src'] }}" alt="{{ $item['alt'] ?? '' }}" loading="lazy" class="size-full object-cover transition-transform duration-500 ease-snap group-hover:scale-105">
                    @isset($item['caption'])
                        <span class="absolute inset-x-0 bottom-0 translate-y-full bg-linear-to-t from-ink-950 to-transparent px-3 pt-8 pb-2.5 text-left text-xs font-medium text-cream transition-transform duration-300 ease-snap group-hover:translate-y-0 group-focus-visible:translate-y-0">
                            {{ $item['caption'] }}
                        </span>
                    @endisset
                </button>
            @endforeach
        </div>
    @endif

    <dialog data-ui-gallery-lightbox class="m-auto w-[calc(100%-2.5rem)] max-w-3xl scale-95 overflow-hidden rounded-2xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-300 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/80 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-300 open:backdrop:opacity-100 starting:open:backdrop:opacity-0">
        <div class="relative">
            <img data-ui-gallery-frame src="{{ $lead['src'] ?? '' }}" alt="{{ $lead['alt'] ?? '' }}" class="aspect-video w-full bg-ink-950 object-contain">
            <button type="button" data-ui-gallery-prev aria-label="Previous image" class="absolute top-1/2 left-3 -translate-y-1/2 {{ $step }}">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" data-ui-gallery-next aria-label="Next image" class="absolute top-1/2 right-3 -translate-y-1/2 {{ $step }}">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
        <div class="flex items-center justify-between gap-4 border-t border-white/5 px-4 py-3">
            <div class="min-w-0">
                <p data-ui-gallery-title class="truncate text-sm font-medium text-cream">{{ $lead['caption'] ?? '' }}</p>
                <p data-ui-gallery-meta class="mt-0.5 truncate font-mono text-[11px] text-zinc-500">{{ $lead['meta'] ?? '' }}</p>
            </div>
            <div class="flex shrink-0 items-center gap-3">
                <span data-ui-gallery-count class="font-mono text-xs text-zinc-600">{{ $current + 1 }} / {{ count($items) }}</span>
                <button type="button" data-ui-gallery-close aria-label="Close" class="grid size-6 cursor-pointer place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                </button>
            </div>
        </div>
    </dialog>
</div>

@once
    <script>
        (() => {
            const paint = (root, index) => {
                const tiles = [...root.querySelectorAll('[data-ui-gallery-item]')];
                const next = (index + tiles.length) % tiles.length;
                const data = tiles[next].dataset;

                root.dataset.index = next;
                tiles.forEach((tile, position) => tile.toggleAttribute('data-active', position === next));

                root.querySelectorAll('[data-ui-gallery-frame]').forEach((image) => {
                    image.src = data.src;
                    image.alt = data.alt;
                });

                root.querySelectorAll('[data-ui-gallery-title]').forEach((node) => (node.textContent = data.caption));
                root.querySelectorAll('[data-ui-gallery-meta]').forEach((node) => (node.textContent = data.meta));
                root.querySelectorAll('[data-ui-gallery-count]').forEach((node) => (node.textContent = `${next + 1} / ${tiles.length}`));
            };

            const zoom = (root) => root.querySelector('[data-ui-gallery-lightbox]').showModal();

            document.addEventListener('click', (event) => {
                const tile = event.target.closest('[data-ui-gallery-item]');

                if (tile) {
                    const root = tile.closest('[data-ui-gallery]');

                    paint(root, [...root.querySelectorAll('[data-ui-gallery-item]')].indexOf(tile));

                    return root.dataset.variant === 'filmstrip' || zoom(root);
                }

                const arrow = event.target.closest('[data-ui-gallery-prev], [data-ui-gallery-next]');

                if (arrow) {
                    const root = arrow.closest('[data-ui-gallery]');

                    return paint(root, Number(root.dataset.index) + (arrow.hasAttribute('data-ui-gallery-next') ? 1 : -1));
                }

                const trigger = event.target.closest('[data-ui-gallery-zoom]');

                if (trigger) {
                    return zoom(trigger.closest('[data-ui-gallery]'));
                }

                const close = event.target.closest('[data-ui-gallery-close]');

                if (close) {
                    return close.closest('dialog').close();
                }

                if (event.target.matches('[data-ui-gallery-lightbox]')) {
                    event.target.close();
                }
            });

            document.addEventListener('keydown', (event) => {
                const lightbox = document.querySelector('[data-ui-gallery-lightbox][open]');

                if (!lightbox || (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight')) {
                    return;
                }

                const root = lightbox.closest('[data-ui-gallery]');

                paint(root, Number(root.dataset.index) + (event.key === 'ArrowRight' ? 1 : -1));
            });
        })();
    </script>
@endonce
