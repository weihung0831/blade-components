import { useState } from 'react';

const variants = {
    outline: 'divide-y divide-white/5 rounded-xl border border-white/10 bg-ink-800',
    flush: 'divide-y divide-white/5',
};

export function UiAccordion({ items = [], variant = 'outline', className = '', ...props }) {
    const [open, setOpen] = useState(() => items.map((item) => Boolean(item.open)));

    const toggle = (index) => setOpen((state) => state.map((value, i) => (i === index ? !value : value)));

    const classes = [variants[variant] ?? variants.outline, className].filter(Boolean).join(' ');

    return (
        <div className={classes} {...props}>
            {items.map((item, index) => (
                <div key={index}>
                    <button
                        type="button"
                        onClick={() => toggle(index)}
                        className="flex w-full cursor-pointer items-center justify-between gap-4 px-4 py-3 text-left text-sm text-zinc-300 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >
                        {item.title}
                        <svg
                            className={`size-3.5 shrink-0 transition-transform duration-200 ease-snap ${open[index] ? 'rotate-180 text-jade-400' : 'text-zinc-500'}`}
                            viewBox="0 0 16 16"
                            fill="none"
                        ><path d="m4 6 4 4 4-4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    </button>
                    <div className={`grid transition-[grid-template-rows] duration-200 ease-snap ${open[index] ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'}`}>
                        <div className="overflow-hidden">
                            <p className="px-4 pb-3.5 text-sm/6 text-zinc-500">{item.content}</p>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
}
