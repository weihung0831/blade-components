import { useCallback, useEffect, useRef } from 'react';

const itemClasses =
    'flex w-full items-center justify-between gap-8 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';

const tone = (entry) =>
    entry.danger ? 'text-red-400 hover:bg-red-500/10' : 'text-zinc-300 hover:bg-white/5 hover:text-cream';

export function UiContextMenu({ items = [], className = '', children, ...props }) {
    const panel = useRef(null);

    const close = useCallback(() => {
        if (panel.current?.matches(':popover-open')) {
            panel.current.hidePopover();
        }
    }, []);

    useEffect(() => {
        document.addEventListener('scroll', close, { capture: true, passive: true });

        return () => document.removeEventListener('scroll', close, { capture: true });
    }, [close]);

    const show = (event) => {
        event.preventDefault();
        close();
        panel.current.showPopover();

        const { width, height } = panel.current.getBoundingClientRect();

        panel.current.style.left = Math.min(event.clientX, window.innerWidth - width - 8) + 'px';
        panel.current.style.top = Math.min(event.clientY, window.innerHeight - height - 8) + 'px';
    };

    return (
        <div className={className} onContextMenu={show} {...props}>
            {children}

            <div
                ref={panel}
                role="menu"
                popover="auto"
                onClick={close}
                className="fixed inset-auto m-0 scale-95 rounded-lg border border-white/10 bg-ink-900 p-1 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-150 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0"
            >
                {items.map((entry, index) =>
                    entry.separator ? (
                        <hr key={index} className="my-1 border-white/5" />
                    ) : (
                        <button key={index} type="button" role="menuitem" className={`${itemClasses} ${tone(entry)}`}>
                            <span>{entry.label}</span>
                            {entry.shortcut && <span className="font-mono text-[11px] text-zinc-600">{entry.shortcut}</span>}
                        </button>
                    ),
                )}
            </div>
        </div>
    );
}
