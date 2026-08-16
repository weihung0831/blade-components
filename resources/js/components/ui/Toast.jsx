import { useEffect } from 'react';

const variants = {
    success: { chip: 'bg-jade-500/15 text-jade-400', mark: 'M2.5 6.5 5 9l4.5-6' },
    danger: { chip: 'bg-red-500/15 text-red-400', mark: 'm3.5 3.5 5 5M8.5 3.5l-5 5' },
    warning: { chip: 'bg-amber-400/15 text-amber-400', mark: 'M6 2.8v3.9M6 9.2v.2' },
    neutral: { chip: 'bg-white/10 text-zinc-300', mark: 'M6 5.4v3.8M6 3v.2' },
};

const positions = {
    'bottom-right': 'right-5 bottom-5 translate-y-2 data-[open]:translate-y-0',
    'bottom-left': 'left-5 bottom-5 translate-y-2 data-[open]:translate-y-0',
    'top-right': 'top-5 right-5 -translate-y-2 data-[open]:translate-y-0',
    'top-center': 'top-5 left-1/2 -translate-x-1/2 -translate-y-2 data-[open]:translate-y-0',
};

export function UiToast({
    open = false,
    onClose,
    variant = 'success',
    title,
    description = null,
    duration = 4000,
    position = 'bottom-right',
    action = null,
    className = '',
    ...props
}) {
    const style = variants[variant] ?? variants.success;

    useEffect(() => {
        if (!open || duration <= 0) {
            return;
        }

        const timer = setTimeout(() => onClose?.(), duration);

        return () => clearTimeout(timer);
    }, [open, duration, onClose]);

    return (
        <div
            role="status"
            data-open={open ? '' : undefined}
            className={`pointer-events-none fixed z-50 flex w-80 items-start gap-3 rounded-xl border border-white/10 bg-ink-800 p-3.5 opacity-0 shadow-lg shadow-black/40 transition-[opacity,translate] duration-300 ease-snap data-[open]:pointer-events-auto data-[open]:opacity-100 ${positions[position] ?? positions['bottom-right']} ${className}`.trim()}
            {...props}
        >
            <span className={`grid size-5 shrink-0 place-items-center rounded-full ${style.chip}`}>
                <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d={style.mark} stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round" /></svg>
            </span>
            <div className="min-w-0 flex-1">
                <p className="text-sm font-medium text-zinc-200">{title}</p>
                {description && <p className="mt-0.5 text-xs/5 text-zinc-500">{description}</p>}
                {action && <div className="mt-2">{action}</div>}
            </div>
            <button
                type="button"
                aria-label="Dismiss"
                className="grid size-5 shrink-0 place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                onClick={() => onClose?.()}
            >
                <svg className="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" /></svg>
            </button>
        </div>
    );
}
