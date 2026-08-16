const compactDots = {
    done: 'bg-jade-500',
    current: 'border border-jade-500 bg-ink-950',
    upcoming: 'border border-white/15 bg-ink-950',
};

export function UiTimeline({ items = [], variant = 'default', className = '', ...props }) {
    const wrapperClasses = ['flex flex-col', className].filter(Boolean).join(' ');

    return (
        <div className={wrapperClasses} {...props}>
            {items.map((item, index) => {
                const state = item.state ?? 'done';
                const last = index === items.length - 1;

                return (
                    <div key={item.title} className="flex gap-3.5">
                        <div className="flex flex-col items-center">
                            {variant === 'compact' ? (
                                <span className={`mt-1 size-2.5 shrink-0 rounded-full ${compactDots[state]}`} />
                            ) : state === 'done' ? (
                                <span className="grid size-4 shrink-0 place-items-center rounded-full bg-jade-500">
                                    <svg className="size-2.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
                                </span>
                            ) : state === 'current' ? (
                                <span className="size-4 shrink-0 rounded-full border-2 border-jade-500 bg-ink-950" />
                            ) : (
                                <span className="size-4 shrink-0 rounded-full border-2 border-white/15 bg-ink-950" />
                            )}
                            {!last && <span className="w-px flex-1 bg-white/15" />}
                        </div>
                        {variant === 'compact' ? (
                            <div className={`flex min-w-0 flex-1 items-baseline justify-between gap-4 ${last ? '' : 'pb-4'}`}>
                                <p className={`truncate text-[13px] ${state === 'upcoming' ? 'text-zinc-500' : 'text-zinc-200'}`}>{item.title}</p>
                                {item.time && <span className="shrink-0 font-mono text-[11px] text-zinc-600">{item.time}</span>}
                            </div>
                        ) : (
                            <div className={`min-w-0 ${last ? '' : 'pb-6'}`}>
                                <p className={`text-sm ${state === 'upcoming' ? 'text-zinc-500' : 'text-zinc-200'}`}>{item.title}</p>
                                {item.description && <p className="mt-0.5 text-xs/5 text-zinc-500">{item.description}</p>}
                                {item.time && <p className="mt-1 font-mono text-[11px] text-zinc-600">{item.time}</p>}
                            </div>
                        )}
                    </div>
                );
            })}
        </div>
    );
}
