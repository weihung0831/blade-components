import { useState } from 'react';

const panelClasses = 'rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40';

export function UiCascadeSelect({
    options = {},
    placeholder = 'Select…',
    disabled = false,
    onChange = null,
    className = '',
    ...props
}) {
    const [value, setValue] = useState(null);
    const [open, setOpen] = useState(false);
    const [openBranch, setOpenBranch] = useState(null);

    const close = () => {
        setOpen(false);
        setOpenBranch(null);
    };

    const select = (item) => {
        setValue(item);
        onChange?.(item);
        close();
    };

    const rootClasses = ['relative inline-block', disabled ? 'pointer-events-none opacity-40' : '', className]
        .filter(Boolean)
        .join(' ');

    return (
        <div className={rootClasses} {...props}>
            <button
                type="button"
                disabled={disabled}
                onClick={() => (open ? close() : setOpen(true))}
                className={`flex h-10 w-full cursor-pointer items-center justify-between gap-6 rounded-lg border bg-ink-950 px-3 text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${open ? 'border-jade-500' : 'border-white/10 hover:border-white/25'}`}
            >
                <span className={value !== null ? 'text-zinc-300' : 'text-zinc-600'}>{value ?? placeholder}</span>
                <svg className={`size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap ${open ? 'rotate-180' : ''}`} viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
            </button>
            {open && (
                <>
                    <div className="fixed inset-0 z-10" onClick={close}></div>
                    <div className={`absolute top-full left-0 z-20 mt-2 min-w-44 ${panelClasses}`}>
                        {Object.entries(options).map(([group, items]) => (
                            <div key={group} className="relative">
                                <button
                                    type="button"
                                    onClick={() => setOpenBranch(openBranch === group ? null : group)}
                                    className={`flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm transition-colors duration-150 ${openBranch === group ? 'bg-white/5 text-cream' : 'text-zinc-300 hover:bg-white/5 hover:text-cream'}`}
                                >
                                    {group}
                                    <svg className="size-3 shrink-0 text-zinc-500" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                </button>
                                {openBranch === group && (
                                    <div className={`absolute top-0 left-full z-30 ml-1 min-w-36 ${panelClasses}`}>
                                        {items.map((item) => (
                                            <button
                                                key={item}
                                                type="button"
                                                onClick={() => select(item)}
                                                className={`flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm transition-colors duration-150 ${value === item ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'}`}
                                            >
                                                {item}
                                                {value === item && (
                                                    <svg className="size-3 shrink-0" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                                )}
                                            </button>
                                        ))}
                                    </div>
                                )}
                            </div>
                        ))}
                    </div>
                </>
            )}
        </div>
    );
}
