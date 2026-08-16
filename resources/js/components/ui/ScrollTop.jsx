import { useEffect, useRef, useState } from 'react';

const anchors = {
    viewport: 'fixed right-6 bottom-6',
    container: 'absolute right-4 bottom-4',
};

const variants = {
    solid: 'bg-jade-500 text-ink-950 shadow-lg shadow-jade-500/25 hover:bg-jade-400',
    progress: 'border border-white/10 bg-ink-900 text-cream shadow-lg shadow-black/40 hover:border-white/25',
};

const findRegion = (button) =>
    button.parentElement.querySelector('[data-ui-scroll-region]') ?? button.closest('[data-ui-scroll-region]');

export function UiScrollTop({ threshold = 400, variant = 'solid', anchor = 'viewport', className = '', ...props }) {
    const button = useRef(null);
    const [visible, setVisible] = useState(false);
    const [progress, setProgress] = useState(0);

    useEffect(() => {
        const update = () => {
            const region = findRegion(button.current);
            const top = region ? region.scrollTop : window.scrollY;
            const max = region
                ? region.scrollHeight - region.clientHeight
                : document.documentElement.scrollHeight - window.innerHeight;

            setVisible(top > threshold);
            setProgress(max > 0 ? Math.round((top / max) * 100) : 0);
        };

        document.addEventListener('scroll', update, { capture: true, passive: true });
        update();

        return () => document.removeEventListener('scroll', update, { capture: true });
    }, [threshold]);

    const toTop = () => {
        const region = findRegion(button.current);
        const behavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';

        (region ?? window).scrollTo({ top: 0, behavior });
    };

    return (
        <button
            ref={button}
            type="button"
            aria-label="Back to top"
            data-visible={visible ? '' : undefined}
            onClick={toTop}
            className={`invisible z-30 grid size-11 translate-y-2 cursor-pointer place-items-center rounded-full opacity-0 transition-[opacity,translate,visibility,background-color,border-color] duration-200 ease-snap outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 data-visible:visible data-visible:translate-y-0 data-visible:opacity-100 ${anchors[anchor] ?? anchors.viewport} ${variants[variant] ?? variants.solid} ${className}`.trim()}
            {...props}
        >
            {variant === 'progress' && (
                <span
                    aria-hidden="true"
                    className="absolute inset-0 rounded-full"
                    style={{
                        background: `conic-gradient(var(--color-jade-500) calc(${progress} * 1%), color-mix(in oklab, var(--color-white) 12%, transparent) 0)`,
                        WebkitMask: 'radial-gradient(closest-side, transparent 78%, black 80%)',
                        mask: 'radial-gradient(closest-side, transparent 78%, black 80%)',
                    }}
                />
            )}
            <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M8 12.5v-9M4 7l4-3.5L12 7" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" /></svg>
        </button>
    );
}
