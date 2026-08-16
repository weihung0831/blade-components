import { useEffect, useMemo, useRef, useState } from 'react';

export function UiNumberTicker({
    value = 0,
    from = 0,
    decimals = 0,
    duration = 1600,
    prefix = null,
    suffix = null,
    locale = 'en-US',
    className = '',
    ...props
}) {
    const root = useRef(null);
    const [current, setCurrent] = useState(value);

    const format = useMemo(
        () => new Intl.NumberFormat(locale, { minimumFractionDigits: decimals, maximumFractionDigits: decimals }),
        [locale, decimals],
    );

    useEffect(() => {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }

        const observer = new IntersectionObserver(
            ([entry]) => {
                if (!entry.isIntersecting) {
                    return;
                }

                observer.disconnect();

                let began = null;

                const frame = (now) => {
                    began ??= now;

                    const progress = Math.min(1, (now - began) / duration);
                    const eased = 1 - Math.pow(1 - progress, 3);

                    setCurrent(from + (value - from) * eased);

                    if (progress < 1) {
                        requestAnimationFrame(frame);
                    }
                };

                requestAnimationFrame(frame);
            },
            { threshold: 0.5 },
        );

        observer.observe(root.current);

        return () => observer.disconnect();
    }, [value, from, duration]);

    return (
        <span ref={root} className={`inline-flex items-baseline tabular-nums ${className}`} {...props}>
            {prefix && <span className="text-jade-400">{prefix}</span>}
            <span>{format.format(current)}</span>
            {suffix && <span className="text-zinc-500">{suffix}</span>}
        </span>
    );
}
