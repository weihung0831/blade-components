import { useEffect, useRef } from 'react';

const sides = {
    right: 'ml-auto border-l translate-x-6 open:translate-x-0 starting:open:translate-x-6',
    left: 'mr-auto border-r -translate-x-6 open:translate-x-0 starting:open:-translate-x-6',
};

export function UiDrawer({
    open = false,
    onClose,
    title,
    side = 'right',
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
            className={`m-0 h-dvh max-h-none w-full max-w-sm border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,translate,display,overlay] transition-discrete duration-300 ease-snap outline-none open:opacity-100 starting:open:opacity-0 backdrop:bg-ink-950/70 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-300 open:backdrop:opacity-100 starting:open:backdrop:opacity-0 ${sides[side] ?? sides.right} ${className}`.trim()}
            onClick={(event) => event.target === ref.current && ref.current.close()}
            {...props}
        >
            <div className="flex h-full flex-col">
                <div className="flex items-center justify-between border-b border-white/5 px-5 py-4">
                    <h2 className="text-base font-semibold tracking-tight text-cream">{title}</h2>
                    <button
                        type="button"
                        aria-label="Close"
                        className="grid size-6 shrink-0 place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        onClick={() => ref.current.close()}
                    >
                        <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" /></svg>
                    </button>
                </div>
                <div className="flex-1 overflow-y-auto p-5 text-sm/6 text-zinc-400">{children}</div>
                {footer && <div className="flex justify-end gap-2 border-t border-white/5 px-5 py-4">{footer}</div>}
            </div>
        </dialog>
    );
}
