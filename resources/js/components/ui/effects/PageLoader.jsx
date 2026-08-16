import { useEffect, useState } from 'react';

const keyframes = '@keyframes ui-page-loader-slide { from { transform: translateX(-100%); } to { transform: translateX(350%); } }';

export function UiPageLoader({
    variant = 'overlay',
    label = 'Loading',
    fixed = false,
    autoHide = false,
    active = true,
    className = '',
    ...props
}) {
    const [loaded, setLoaded] = useState(false);

    useEffect(() => {
        if (document.readyState === 'complete') {
            setLoaded(true);

            return;
        }

        const onLoad = () => setLoaded(true);

        window.addEventListener('load', onLoad, { once: true });

        return () => window.removeEventListener('load', onLoad);
    }, []);

    const visible = active && !(autoHide && loaded);

    const classes = [
        fixed ? 'fixed' : 'absolute',
        'inset-0 z-50 overflow-hidden transition-opacity duration-300',
        variant === 'overlay' ? 'grid place-items-center bg-ink-950/85 backdrop-blur-sm' : 'pointer-events-none h-0.5',
        visible ? '' : 'pointer-events-none opacity-0',
        className,
    ]
        .filter(Boolean)
        .join(' ');

    return (
        <div role="status" aria-live="polite" className={classes} {...props}>
            <style>{keyframes}</style>

            <span className="absolute top-0 left-0 h-0.5 w-2/5 rounded-full bg-jade-500 animate-[ui-page-loader-slide_1.6s_ease-in-out_infinite]" />

            {variant === 'overlay' ? (
                <div className="flex flex-col items-center gap-3">
                    <svg className="size-6 animate-spin text-jade-500" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <circle cx="8" cy="8" r="6.5" stroke="currentColor" strokeWidth="2" className="opacity-20" />
                        <path d="M14.5 8A6.5 6.5 0 0 0 8 1.5" stroke="currentColor" strokeWidth="2" strokeLinecap="round" />
                    </svg>
                    <span className="font-mono text-xs tracking-wider text-zinc-500 uppercase">{label}</span>
                </div>
            ) : (
                <span className="sr-only">{label}</span>
            )}
        </div>
    );
}
