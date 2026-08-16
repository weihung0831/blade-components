import { useState } from 'react';

export function UiFieldset({ legend, toggleable = false, open = true, className = '', children, ...props }) {
    const [expanded, setExpanded] = useState(open);

    if (toggleable) {
        const classes = ['rounded-xl border border-white/10 px-4 pt-1.5 pb-1.5', className].filter(Boolean).join(' ');

        return (
            <fieldset className={classes} {...props}>
                <legend className="px-2">
                    <button
                        type="button"
                        onClick={() => setExpanded((value) => !value)}
                        className="flex cursor-pointer items-center gap-2 rounded text-sm font-medium text-zinc-200 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >
                        {legend}
                        <svg
                            className={`size-3.5 transition-transform duration-200 ease-snap ${expanded ? 'rotate-180 text-jade-400' : 'text-zinc-500'}`}
                            viewBox="0 0 16 16"
                            fill="none"
                        ><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    </button>
                </legend>
                <div className={`grid transition-[grid-template-rows] duration-200 ease-snap ${expanded ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'}`}>
                    <div className="overflow-hidden">
                        <div className="pt-1 pb-2.5">{children}</div>
                    </div>
                </div>
            </fieldset>
        );
    }

    const classes = ['rounded-xl border border-white/10 px-4 pt-1.5 pb-4', className].filter(Boolean).join(' ');

    return (
        <fieldset className={classes} {...props}>
            <legend className="px-2 text-sm font-medium text-zinc-200">{legend}</legend>
            <div className="pt-1">{children}</div>
        </fieldset>
    );
}
