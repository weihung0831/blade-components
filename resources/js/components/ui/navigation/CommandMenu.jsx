import { useEffect, useMemo, useRef, useState } from 'react';

export function UiCommandMenu({
    open = false,
    onClose,
    onSelect,
    placeholder = 'Search commands…',
    groups = [],
    className = '',
    ...props
}) {
    const dialog = useRef(null);
    const [query, setQuery] = useState('');
    const [active, setActive] = useState(0);

    const matches = useMemo(() => {
        const needle = query.trim().toLowerCase();

        return groups
            .map((group) => ({
                ...group,
                items: (group.items ?? []).filter((item) => needle === '' || item.label.toLowerCase().includes(needle)),
            }))
            .filter((group) => group.items.length > 0);
    }, [groups, query]);

    const flat = useMemo(() => matches.flatMap((group) => group.items), [matches]);

    useEffect(() => {
        if (open) {
            setQuery('');
            setActive(0);
            dialog.current.showModal();
        } else {
            dialog.current.close();
        }
    }, [open]);

    const select = (item) => {
        if (!item) {
            return;
        }

        onSelect?.(item);
        onClose?.();
    };

    useEffect(() => {
        const onKeydown = (event) => {
            if (!open) {
                return;
            }

            if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
                event.preventDefault();
                setActive((index) => (index + (event.key === 'ArrowDown' ? 1 : flat.length - 1)) % flat.length);
            }

            if (event.key === 'Enter') {
                event.preventDefault();
                select(flat[active]);
            }
        };

        document.addEventListener('keydown', onKeydown);

        return () => document.removeEventListener('keydown', onKeydown);
    });

    return (
        <dialog
            ref={dialog}
            onClose={() => onClose?.()}
            onClick={(event) => event.target === dialog.current && onClose?.()}
            className={`mx-auto mt-[12vh] mb-0 w-[calc(100%-2.5rem)] max-w-lg scale-95 overflow-hidden rounded-xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-200 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/70 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-200 open:backdrop:opacity-100 starting:open:backdrop:opacity-0 ${className}`.trim()}
            {...props}
        >
            <div className="flex items-center gap-2.5 border-b border-white/5 px-4 py-3">
                <svg className="size-4 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" strokeWidth="1.4" /><path d="m10.5 10.5 3 3" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" /></svg>
                <input
                    autoFocus
                    type="text"
                    autoComplete="off"
                    value={query}
                    placeholder={placeholder}
                    onChange={(event) => {
                        setQuery(event.target.value);
                        setActive(0);
                    }}
                    className="w-full bg-transparent text-sm text-cream outline-none placeholder:text-zinc-600"
                />
                <span className="shrink-0 rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">ESC</span>
            </div>

            <div className="max-h-72 overflow-y-auto p-1.5">
                {matches.map((group) => (
                    <div key={group.label}>
                        {group.label && <p className="px-2.5 pt-2 pb-1 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{group.label}</p>}
                        {group.items.map((item) => (
                            <button
                                key={item.label}
                                type="button"
                                data-active={flat[active] === item ? '' : undefined}
                                className="flex w-full items-center justify-between gap-4 rounded-md px-2.5 py-2 text-left text-sm text-zinc-300 outline-none data-active:bg-white/5 data-active:text-cream"
                                onClick={() => select(item)}
                                onMouseMove={() => setActive(flat.indexOf(item))}
                            >
                                <span>{item.label}</span>
                                {item.shortcut && <span className="shrink-0 font-mono text-[11px] text-zinc-600">{item.shortcut}</span>}
                            </button>
                        ))}
                    </div>
                ))}

                {flat.length === 0 && <p className="px-2.5 py-8 text-center text-sm text-zinc-600">Nothing matches that.</p>}
            </div>

            <div className="flex items-center gap-4 border-t border-white/5 px-4 py-2.5 font-mono text-[10px] text-zinc-600">
                <span>↑↓ move</span>
                <span>↵ run</span>
            </div>
        </dialog>
    );
}

export function useCommandShortcut(key = 'k', onOpen) {
    useEffect(() => {
        const onKeydown = (event) => {
            if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === key) {
                event.preventDefault();
                onOpen();
            }
        };

        document.addEventListener('keydown', onKeydown);

        return () => document.removeEventListener('keydown', onKeydown);
    }, [key, onOpen]);
}
