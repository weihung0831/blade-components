import { useState } from 'react';

export function KanbanColumn({ station, count = 0, onDrop, children }) {
    const [collapsed, setCollapsed] = useState(false);
    const [over, setOver] = useState(false);

    const limit = station.limit ?? 0;
    const overLimit = limit > 0 && count > limit;
    const fill = limit > 0 ? Math.min(100, (count / limit) * 100) : 0;

    return (
        <section className={`flex shrink-0 flex-col transition-[width] duration-300 ease-snap ${collapsed ? 'w-12' : 'w-72'}`}>
            <header className="shrink-0 px-1">
                <div className={`flex items-center gap-2 ${collapsed ? 'flex-col gap-3' : ''}`}>
                    <button
                        type="button"
                        onClick={() => setCollapsed((state) => !state)}
                        className="grid size-5 shrink-0 place-items-center rounded text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >
                        <svg className={`size-3.5 transition-transform duration-300 ease-snap ${collapsed ? 'rotate-180' : ''}`} viewBox="0 0 16 16" fill="none">
                            <path d="M10 4 6 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/>
                        </svg>
                        <span className="sr-only">Collapse {station.name}</span>
                    </button>

                    <h3 className={`text-[13px] font-medium tracking-tight text-cream ${collapsed ? '[writing-mode:vertical-rl]' : ''}`}>{station.name}</h3>

                    <span className={`font-mono text-[11px] ${collapsed ? '' : 'ml-auto'} ${overLimit ? 'text-red-300' : 'text-zinc-600'}`}>
                        {count}{limit > 0 && <span className="text-zinc-700">/{limit}</span>}
                    </span>
                </div>

                {!collapsed && (
                    <div className="mt-2.5">
                        {limit > 0 ? (
                            <div className="h-0.5 w-full overflow-hidden rounded-full bg-white/8">
                                <span
                                    className={`block h-full rounded-full transition-[width] duration-300 ease-snap ${overLimit ? 'bg-red-400' : 'bg-jade-500/70'}`}
                                    style={{ width: `${fill}%` }}
                                ></span>
                            </div>
                        ) : (
                            <div className="h-0.5 w-full rounded-full bg-white/5"></div>
                        )}

                        <p className="mt-2 flex items-center gap-1.5 font-mono text-[10px] text-zinc-700">
                            {station.machine && <span className="truncate">{station.machine}</span>}
                            {overLimit && <span className="ml-auto shrink-0 text-red-300">over by {count - limit}</span>}
                            {!overLimit && limit === 0 && <span className="ml-auto shrink-0">no limit</span>}
                        </p>
                    </div>
                )}
            </header>

            {!collapsed && (
                <div
                    onDragOver={(event) => { event.preventDefault(); setOver(true); }}
                    onDragLeave={() => setOver(false)}
                    onDrop={(event) => { event.preventDefault(); setOver(false); onDrop?.(event); }}
                    className={`mt-2.5 flex min-h-24 flex-1 flex-col gap-2.5 overflow-y-auto rounded-xl border border-dashed p-1 transition-colors duration-150 ${
                        over ? 'border-jade-500/50 bg-jade-500/5' : 'border-transparent'
                    }`}
                >
                    {children}

                    {count === 0 && (
                        <p className="rounded-xl border border-dashed border-white/8 px-3 py-6 text-center font-mono text-[10px] text-zinc-700">drop a job here</p>
                    )}
                </div>
            )}
        </section>
    );
}
