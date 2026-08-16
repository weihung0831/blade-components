import { useState } from 'react';

export function UiPanel({ heading, toggleable = false, open = true, actions = null, footer = null, className = '', children, ...props }) {
    const [expanded, setExpanded] = useState(open);

    const classes = ['overflow-hidden rounded-xl border border-white/10 bg-ink-800', className].filter(Boolean).join(' ');

    if (toggleable) {
        return (
            <div className={classes} {...props}>
                <button
                    type="button"
                    onClick={() => setExpanded((value) => !value)}
                    className="flex w-full cursor-pointer items-center justify-between gap-4 px-4 py-3 text-left text-sm font-medium text-zinc-200 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    {heading}
                    <svg
                        className={`size-3.5 shrink-0 transition-transform duration-200 ease-snap ${expanded ? 'rotate-180 text-jade-400' : 'text-zinc-500'}`}
                        viewBox="0 0 16 16"
                        fill="none"
                    ><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </button>
                <div className={`grid transition-[grid-template-rows] duration-200 ease-snap ${expanded ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'}`}>
                    <div className="overflow-hidden">
                        <div className="border-t border-white/5 p-4 text-sm/6 text-zinc-500">{children}</div>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className={classes} {...props}>
            <div className="flex items-center justify-between gap-4 border-b border-white/5 px-4 py-3">
                <p className="text-sm font-medium text-zinc-200">{heading}</p>
                {actions && <div className="flex items-center gap-2">{actions}</div>}
            </div>
            <div className="p-4 text-sm/6 text-zinc-500">{children}</div>
            {footer && <div className="border-t border-white/5 px-4 py-3">{footer}</div>}
        </div>
    );
}
