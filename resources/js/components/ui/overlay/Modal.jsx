import { useEffect, useRef } from 'react';

const sizes = {
    sm: 'max-w-sm',
    md: 'max-w-md',
    lg: 'max-w-xl',
};

export function UiModal({
    open = false,
    onClose,
    title,
    description = null,
    size = 'md',
    footer = null,
    className = '',
    children,
    ...props
}) {
    const ref = useRef(null);

    useEffect(() => {
        if (open) {
            ref.current.showModal();
        } else {
            ref.current.close();
        }
    }, [open]);

    useEffect(() => {
        const dialog = ref.current;
        const handleClose = () => onClose?.();

        dialog.addEventListener('close', handleClose);

        return () => dialog.removeEventListener('close', handleClose);
    }, [onClose]);

    return (
        <dialog
            ref={ref}
            className={`m-auto w-[calc(100%-2.5rem)] scale-95 rounded-2xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-300 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/70 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-300 open:backdrop:opacity-100 starting:open:backdrop:opacity-0 ${sizes[size] ?? sizes.md} ${className}`.trim()}
            onClick={(event) => event.target === ref.current && ref.current.close()}
            {...props}
        >
            <div className="p-5">
                <div className="flex items-start justify-between gap-4">
                    <div className="min-w-0">
                        <h2 className="text-base font-semibold tracking-tight text-cream">{title}</h2>
                        {description && <p className="mt-1 text-sm/6 text-zinc-500">{description}</p>}
                    </div>
                    <button
                        type="button"
                        aria-label="Close"
                        className="grid size-6 shrink-0 place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        onClick={() => ref.current.close()}
                    >
                        <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" /></svg>
                    </button>
                </div>
                {children && <div className="mt-4 text-sm/6 text-zinc-400">{children}</div>}
            </div>
            {footer && <div className="flex justify-end gap-2 border-t border-white/5 px-5 py-4">{footer}</div>}
        </dialog>
    );
}
