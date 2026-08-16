import { useState } from 'react';

const control =
    'grid size-6 cursor-pointer place-items-center rounded-md border border-white/10 text-zinc-400 transition-colors duration-150 hover:border-white/25 hover:text-cream';

export function UiOrderList({ items = [], selected = 0, extremes = false, className = '', ...props }) {
    const [list, setList] = useState(items);
    const [current, setCurrent] = useState(selected);

    const moveTo = (target) => {
        const index = Math.max(0, Math.min(list.length - 1, target));
        const next = [...list];
        const [item] = next.splice(current, 1);

        next.splice(index, 0, item);
        setList(next);
        setCurrent(index);
    };

    const rootClasses = ['flex items-center gap-2 text-[13px]', className].filter(Boolean).join(' ');

    return (
        <div className={rootClasses} {...props}>
            <div className="w-40 rounded-lg border border-white/10 bg-ink-950 p-1">
                {list.map((item, index) => (
                    <button
                        key={item}
                        type="button"
                        onClick={() => setCurrent(index)}
                        className={`block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left transition-colors duration-150 ${index === current ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:text-cream'}`}
                    >
                        {item}
                    </button>
                ))}
            </div>
            <div className="flex flex-col gap-1.5">
                {extremes && (
                    <button type="button" onClick={() => moveTo(0)} className={control}>
                        <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M3 6 6 3l3 3M3 9.5 6 6.5l3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    </button>
                )}
                <button type="button" onClick={() => moveTo(current - 1)} className={control}>
                    <svg className="size-3 -rotate-90" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </button>
                <button type="button" onClick={() => moveTo(current + 1)} className={control}>
                    <svg className="size-3 rotate-90" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </button>
                {extremes && (
                    <button type="button" onClick={() => moveTo(list.length - 1)} className={control}>
                        <svg className="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M3 6 6 3l3 3M3 9.5 6 6.5l3 3" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    </button>
                )}
            </div>
        </div>
    );
}
