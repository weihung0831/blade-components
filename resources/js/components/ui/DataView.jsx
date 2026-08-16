import { useState } from 'react';

export function UiDataView({ items = [], view = 'list', className = '', ...props }) {
    const [current, setCurrent] = useState(view);

    const wrapperClasses = ['w-full', className].filter(Boolean).join(' ');

    const buttonClasses = (value) =>
        [
            'grid cursor-pointer place-items-center rounded-md px-2 py-1 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
            current === value ? 'bg-white/10 text-cream' : 'text-zinc-500 hover:text-zinc-300',
        ].join(' ');

    return (
        <div className={wrapperClasses} {...props}>
            <div className="mb-3 flex justify-end">
                <div className="inline-flex rounded-lg border border-white/10 bg-ink-950 p-0.5">
                    <button type="button" onClick={() => setCurrent('list')} className={buttonClasses('list')}>
                        <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M2.5 4h11M2.5 8h11M2.5 12h11" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round"/></svg>
                    </button>
                    <button type="button" onClick={() => setCurrent('grid')} className={buttonClasses('grid')}>
                        <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><rect x="2.5" y="2.5" width="4.5" height="4.5" rx="1" stroke="currentColor" strokeWidth="1.5"/><rect x="9" y="2.5" width="4.5" height="4.5" rx="1" stroke="currentColor" strokeWidth="1.5"/><rect x="2.5" y="9" width="4.5" height="4.5" rx="1" stroke="currentColor" strokeWidth="1.5"/><rect x="9" y="9" width="4.5" height="4.5" rx="1" stroke="currentColor" strokeWidth="1.5"/></svg>
                    </button>
                </div>
            </div>
            <div className={current === 'grid' ? 'grid grid-cols-2 gap-2' : 'flex flex-col gap-2'}>
                {items.map((item) => (
                    <div key={item.title} className="flex items-center gap-3 rounded-lg border border-white/10 bg-ink-800 p-3">
                        <span className={`grid size-10 shrink-0 place-items-center rounded-md font-mono text-[11px] ${item.accent ? 'bg-jade-500/15 text-jade-400' : 'bg-white/5 text-zinc-400'}`}>
                            {item.badge}
                        </span>
                        <div className="min-w-0 flex-1">
                            <p className="truncate text-[13px] font-medium text-zinc-200">{item.title}</p>
                            <p className="truncate text-xs text-zinc-500">{item.subtitle}</p>
                        </div>
                        <span className={`font-mono text-xs ${item.accent ? 'text-jade-400' : 'text-zinc-400'}`}>{item.meta}</span>
                    </div>
                ))}
            </div>
        </div>
    );
}
