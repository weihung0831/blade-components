import { useLayoutEffect, useRef, useState } from 'react';

const clipper = (element) => {
    let parent = element.parentElement;

    while (parent && parent !== document.body) {
        if (/(auto|scroll|hidden)/.test(getComputedStyle(parent).overflowY)) {
            return parent;
        }

        parent = parent.parentElement;
    }

    return null;
};

const triggers = {
    outline: 'border border-white/10 bg-ink-950 hover:border-white/25',
    filled: 'border border-transparent bg-ink-800 hover:bg-white/5',
    invalid: 'border border-red-400/60 bg-ink-950',
};

const openBorders = {
    outline: 'border-jade-500',
    filled: 'border-jade-500',
    invalid: 'border-red-400',
};

const sizes = {
    sm: 'h-8 px-2.5 text-xs',
    md: 'h-10 px-3 text-sm',
};

export function UiSelect({
    options = [],
    value = null,
    onChange = () => {},
    placeholder = 'Select…',
    variant = 'outline',
    size = 'md',
    disabled = false,
    className = '',
    ...props
}) {
    const [open, setOpen] = useState(false);
    const [dropUp, setDropUp] = useState(false);
    const root = useRef(null);
    const menu = useRef(null);

    useLayoutEffect(() => {
        if (!open) {
            setDropUp(false);

            return;
        }

        const box = clipper(root.current);
        const bounds = box ? box.getBoundingClientRect() : { top: 0, bottom: window.innerHeight };
        const trigger = root.current.getBoundingClientRect();
        const needed = menu.current.offsetHeight + 8;

        setDropUp(bounds.bottom - trigger.bottom < needed && trigger.top - bounds.top > needed);
    }, [open]);

    const select = (option) => {
        onChange(option);
        setOpen(false);
    };

    const triggerClasses = [
        'flex w-full cursor-pointer items-center justify-between gap-6 rounded-lg transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
        triggers[variant] ?? triggers.outline,
        sizes[size] ?? sizes.md,
        open && (openBorders[variant] ?? openBorders.outline),
    ]
        .filter(Boolean)
        .join(' ');

    const rootClasses = ['relative block', disabled && 'pointer-events-none opacity-40', className].filter(Boolean).join(' ');

    return (
        <div ref={root} className={rootClasses} {...props}>
            <button type="button" disabled={disabled} onClick={() => setOpen(!open)} className={triggerClasses}>
                <span className={`truncate ${value !== null ? 'text-zinc-300' : 'text-zinc-600'}`}>{value ?? placeholder}</span>
                <svg className={`size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap ${open ? 'rotate-180' : ''}`} viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
            </button>
            {open && (
                <>
                    <div className="fixed inset-0 z-10" onClick={() => setOpen(false)} />
                    <div
                        ref={menu}
                        className={`absolute left-0 z-20 w-full min-w-max rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40 ${dropUp ? 'bottom-full mb-2' : 'top-full mt-2'}`}
                    >
                        {options.map((option) => (
                            <button
                                key={option}
                                type="button"
                                onClick={() => select(option)}
                                className={`flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm transition-colors duration-150 ${value === option ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'}`}
                            >
                                {option}
                                {value === option && (
                                    <svg className="size-3 shrink-0" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                )}
                            </button>
                        ))}
                    </div>
                </>
            )}
        </div>
    );
}
