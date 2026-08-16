const icons = {
    grid: 'M2.5 2.5h4.2v4.2H2.5zM9.3 2.5h4.2v4.2H9.3zM2.5 9.3h4.2v4.2H2.5zM9.3 9.3h4.2v4.2H9.3z',
    deploy: 'M8 13V3m0 0L4.5 6.5M8 3l3.5 3.5',
    bell: 'M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11',
    billing: 'M2.5 4.5h11v7h-11zM2.5 7.5h11',
    users: 'M6 7.5a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Zm-3.5 5.4c0-1.9 1.6-3.1 3.5-3.1s3.5 1.2 3.5 3.1m1.6-9.2a2.25 2.25 0 0 1 0 4.4m1.4 4.8c0-1.6-.9-2.5-2.3-2.9',
    settings: 'M2.5 5.5h11M2.5 10.5h11M6 3.5v4M10.5 8.5v4',
    logs: 'M3.5 5 6 7.5 3.5 10M8 11h4.5',
    lock: 'M5 7.5V6a3 3 0 0 1 6 0v1.5M4 7.5h8v5H4z',
    docs: 'M8 5v8m-5-9.5h3.5A1.5 1.5 0 0 1 8 5v8a1.5 1.5 0 0 0-1.5-1.5H3v-8Zm10 0H9.5A1.5 1.5 0 0 0 8 5v8a1.5 1.5 0 0 1 1.5-1.5H13v-8Z',
    chart: 'M3 13V8m3.5 5V4m3.5 9v-6m3.5 6V6',
    dot: 'M8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5Z',
};

const tone = (entry) =>
    entry.active ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream';

export function UiSidebar({ sections = [], variant = 'full', brand = null, footer = null, className = '', ...props }) {
    const rail = variant === 'rail';

    return (
        <aside className={`flex flex-col rounded-xl border border-white/10 bg-ink-800 p-2 ${rail ? 'w-16 items-center' : 'w-60'} ${className}`.trim()} {...props}>
            {brand && <div className={`mb-2 flex items-center gap-2.5 px-1.5 py-1 ${rail ? 'justify-center' : ''}`}>{brand}</div>}

            <nav className="flex w-full flex-col gap-0.5">
                {sections.map((section, index) => (
                    <div key={section.label ?? index} className="flex flex-col gap-0.5">
                        {section.label && !rail && (
                            <p className={`px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase ${index > 0 ? 'pt-3' : ''}`}>
                                {section.label}
                            </p>
                        )}
                        {rail && index > 0 && <hr className="my-2 w-full border-white/8" />}

                        {(section.items ?? []).map((entry) => (
                            <a
                                key={entry.label}
                                href={entry.href ?? '#'}
                                title={entry.label}
                                aria-current={entry.active ? 'page' : undefined}
                                className={`relative flex items-center rounded-lg text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${rail ? 'justify-center p-2.5' : 'gap-2.5 px-2.5 py-2'} ${tone(entry)}`}
                            >
                                <svg className="size-4 shrink-0" viewBox="0 0 16 16" fill="none"><path d={icons[entry.icon] ?? icons.dot} stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round" /></svg>

                                {!rail && <span className="truncate">{entry.label}</span>}

                                {entry.badge && (rail ? (
                                    <span className="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400" />
                                ) : (
                                    <span className="ml-auto rounded-full bg-jade-500 px-1.5 font-mono text-[10px] text-ink-950">{entry.badge}</span>
                                ))}
                            </a>
                        ))}
                    </div>
                ))}
            </nav>

            {footer && <div className={`mt-auto w-full border-t border-white/5 pt-2 ${rail ? 'flex justify-center' : ''}`}>{footer}</div>}
        </aside>
    );
}
