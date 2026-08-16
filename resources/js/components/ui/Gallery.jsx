import { useEffect, useRef, useState } from 'react';

const grids = {
    2: 'grid-cols-2',
    3: 'grid-cols-3',
    4: 'grid-cols-2 sm:grid-cols-4',
};

const step =
    'grid size-8 cursor-pointer place-items-center rounded-full border border-white/10 bg-ink-950/70 text-cream backdrop-blur-sm transition-colors duration-150 outline-none hover:bg-ink-950 focus-visible:ring-2 focus-visible:ring-jade-500/70';

export function UiGallery({ items = [], variant = 'grid', columns = 3, active = 0, onActiveChange, className = '', ...props }) {
    const dialog = useRef(null);
    const [current, setCurrent] = useState(active);
    const [open, setOpen] = useState(false);

    const item = items[current] ?? {};

    const go = (index) => {
        const next = (index + items.length) % items.length;

        setCurrent(next);
        onActiveChange?.(next);
    };

    const pick = (index) => {
        go(index);

        if (variant !== 'filmstrip') {
            setOpen(true);
        }
    };

    useEffect(() => {
        if (open) {
            dialog.current.showModal();
        } else {
            dialog.current.close();
        }
    }, [open]);

    useEffect(() => {
        const onKeydown = (event) => {
            if (!open || (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight')) {
                return;
            }

            event.preventDefault();
            go(current + (event.key === 'ArrowRight' ? 1 : -1));
        };

        document.addEventListener('keydown', onKeydown);

        return () => document.removeEventListener('keydown', onKeydown);
    });

    return (
        <div className={className} {...props}>
            {variant === 'filmstrip' ? (
                <>
                    <figure className="relative overflow-hidden rounded-xl border border-white/10 bg-ink-900">
                        <button
                            type="button"
                            aria-label="Open full size"
                            className="block aspect-video w-full cursor-zoom-in outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 focus-visible:ring-inset"
                            onClick={() => setOpen(true)}
                        >
                            <img src={item.src} alt={item.alt ?? ''} className="size-full object-cover" />
                        </button>
                        <figcaption className="pointer-events-none absolute inset-x-0 bottom-0 bg-linear-to-t from-ink-950 via-ink-950/70 to-transparent px-4 pt-10 pb-3">
                            <p className="text-sm font-medium text-cream">{item.caption}</p>
                            <p className="mt-0.5 font-mono text-[11px] text-zinc-400">{item.meta}</p>
                        </figcaption>
                    </figure>

                    <div className="mt-2 grid grid-cols-4 gap-1.5">
                        {items.map((thumb, index) => (
                            <button
                                key={thumb.src}
                                type="button"
                                aria-label={thumb.caption ?? `Image ${index + 1}`}
                                data-active={index === current ? '' : undefined}
                                className="aspect-[4/3] cursor-pointer overflow-hidden rounded-md border border-white/10 opacity-50 transition-[opacity,border-color] duration-200 outline-none hover:opacity-90 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:border-jade-500 data-active:opacity-100"
                                onClick={() => pick(index)}
                            >
                                <img src={thumb.src} alt="" loading="lazy" className="size-full object-cover" />
                            </button>
                        ))}
                    </div>
                </>
            ) : (
                <div className={`grid gap-2 ${grids[columns] ?? grids[3]}`}>
                    {items.map((tile, index) => (
                        <button
                            key={tile.src}
                            type="button"
                            aria-label={tile.caption ?? `Image ${index + 1}`}
                            className="group relative aspect-square cursor-zoom-in overflow-hidden rounded-lg border border-white/10 bg-ink-900 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            onClick={() => pick(index)}
                        >
                            <img src={tile.src} alt={tile.alt ?? ''} loading="lazy" className="size-full object-cover transition-transform duration-500 ease-snap group-hover:scale-105" />
                            {tile.caption && (
                                <span className="absolute inset-x-0 bottom-0 translate-y-full bg-linear-to-t from-ink-950 to-transparent px-3 pt-8 pb-2.5 text-left text-xs font-medium text-cream transition-transform duration-300 ease-snap group-hover:translate-y-0 group-focus-visible:translate-y-0">
                                    {tile.caption}
                                </span>
                            )}
                        </button>
                    ))}
                </div>
            )}

            <dialog
                ref={dialog}
                onClose={() => setOpen(false)}
                onClick={(event) => event.target === dialog.current && setOpen(false)}
                className="m-auto w-[calc(100%-2.5rem)] max-w-3xl scale-95 overflow-hidden rounded-2xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-300 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/80 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-300 open:backdrop:opacity-100 starting:open:backdrop:opacity-0"
            >
                <div className="relative">
                    <img src={item.src} alt={item.alt ?? ''} className="aspect-video w-full bg-ink-950 object-contain" />
                    <button type="button" aria-label="Previous image" className={`absolute top-1/2 left-3 -translate-y-1/2 ${step}`} onClick={() => go(current - 1)}>
                        <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
                    </button>
                    <button type="button" aria-label="Next image" className={`absolute top-1/2 right-3 -translate-y-1/2 ${step}`} onClick={() => go(current + 1)}>
                        <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
                    </button>
                </div>
                <div className="flex items-center justify-between gap-4 border-t border-white/5 px-4 py-3">
                    <div className="min-w-0">
                        <p className="truncate text-sm font-medium text-cream">{item.caption}</p>
                        <p className="mt-0.5 truncate font-mono text-[11px] text-zinc-500">{item.meta}</p>
                    </div>
                    <div className="flex shrink-0 items-center gap-3">
                        <span className="font-mono text-xs text-zinc-600">{current + 1} / {items.length}</span>
                        <button
                            type="button"
                            aria-label="Close"
                            className="grid size-6 cursor-pointer place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            onClick={() => setOpen(false)}
                        >
                            <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" /></svg>
                        </button>
                    </div>
                </div>
            </dialog>
        </div>
    );
}
