import { useEffect, useRef, useState } from 'react';

const arrow =
    'absolute top-1/2 grid size-8 -translate-y-1/2 cursor-pointer place-items-center rounded-full border border-white/10 bg-ink-950/70 text-cream backdrop-blur-sm transition-colors duration-150 outline-none hover:bg-ink-950 focus-visible:ring-2 focus-visible:ring-jade-500/70';

export function UiCarousel({
    items = [],
    active = 0,
    onActiveChange,
    autoplay = 0,
    loop = true,
    arrows = true,
    indicators = true,
    ratio = 'aspect-video',
    className = '',
    ...props
}) {
    const [current, setCurrent] = useState(active);
    const paused = useRef(false);

    const go = (index) => {
        const next = loop
            ? (index + items.length) % items.length
            : Math.min(items.length - 1, Math.max(0, index));

        setCurrent(next);
        onActiveChange?.(next);
    };

    useEffect(() => {
        if (autoplay <= 0) {
            return;
        }

        const timer = setInterval(() => {
            if (!paused.current && !document.hidden) {
                go(current + 1);
            }
        }, autoplay);

        return () => clearInterval(timer);
    }, [autoplay, current, items.length]);

    return (
        <div
            role="region"
            aria-roledescription="carousel"
            className={className}
            onPointerEnter={() => (paused.current = true)}
            onPointerLeave={() => (paused.current = false)}
            onFocus={() => (paused.current = true)}
            onBlur={() => (paused.current = false)}
            {...props}
        >
            <div className="relative overflow-hidden rounded-xl border border-white/10 bg-ink-900">
                <div className="flex transition-transform duration-500 ease-snap" style={{ transform: `translateX(-${current * 100}%)` }}>
                    {items.map((item, index) => (
                        <figure key={item.src} className={`relative w-full shrink-0 ${ratio}`} inert={index !== current ? '' : undefined}>
                            <img src={item.src} alt={item.alt ?? ''} className="size-full object-cover" />
                            {item.caption && (
                                <figcaption className="absolute inset-x-0 bottom-0 bg-linear-to-t from-ink-950 via-ink-950/70 to-transparent px-4 pt-10 pb-4">
                                    <p className="text-sm font-medium text-cream">{item.caption}</p>
                                    {item.meta && <p className="mt-0.5 font-mono text-[11px] text-zinc-400">{item.meta}</p>}
                                </figcaption>
                            )}
                        </figure>
                    ))}
                </div>

                {arrows && (
                    <>
                        <button type="button" aria-label="Previous slide" className={`left-3 ${arrow}`} onClick={() => go(current - 1)}>
                            <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
                        </button>
                        <button type="button" aria-label="Next slide" className={`right-3 ${arrow}`} onClick={() => go(current + 1)}>
                            <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
                        </button>
                    </>
                )}
            </div>

            {indicators && (
                <div className="mt-3 flex justify-center gap-1.5">
                    {items.map((item, index) => (
                        <button
                            key={item.src}
                            type="button"
                            aria-label={`Slide ${index + 1}`}
                            data-active={index === current ? '' : undefined}
                            className="h-1 w-1 cursor-pointer rounded-full bg-white/15 transition-[width,background-color] duration-300 ease-snap outline-none hover:bg-white/30 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:w-4 data-active:bg-jade-500"
                            onClick={() => go(index)}
                        />
                    ))}
                </div>
            )}
        </div>
    );
}
