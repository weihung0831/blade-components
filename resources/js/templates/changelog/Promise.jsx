const STATES = {
    shipped: { label: 'shipped', text: 'text-cream', bar: 'bg-jade-500' },
    late: { label: 'shipped late', text: 'text-cream', bar: 'bg-amber-400/70' },
    dropped: { label: 'dropped', text: 'text-zinc-500 line-through decoration-white/20', bar: 'bg-white/10' },
    open: { label: 'still open', text: 'text-zinc-300', bar: 'bg-white/20' },
};

export function ChangelogPromise({ thing, announced, shipped = null, slip = null, state = 'shipped', version, note }) {
    const mark = STATES[state] ?? STATES.shipped;
    const width = slip === null ? 4 : Math.min(100, Math.max(4, Math.round((slip / 40) * 100)));

    return (
        <div data-promise={state} className="px-3.5 py-3">
            <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                <p className={`min-w-0 flex-1 text-[13px] ${mark.text}`}>{thing}</p>

                {version && <span className="shrink-0 font-mono text-[10px] text-zinc-600">{version}</span>}

                <span className={`w-24 shrink-0 text-right font-mono text-[10px] ${state === 'late' ? 'text-amber-300/80' : 'text-zinc-700'}`}>{mark.label}</span>
            </div>

            <div className="mt-2 flex items-center gap-2">
                <span className="w-20 shrink-0 font-mono text-[10px] text-zinc-700">{announced}</span>

                <span className="h-1.5 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6">
                    <span className={`block h-full rounded-full transition-[width] duration-300 ${mark.bar}`} style={{ width: `${width}%` }}></span>
                </span>

                <span className={`w-20 shrink-0 text-right font-mono text-[10px] ${shipped ? 'text-zinc-500' : 'text-zinc-700'}`}>{shipped ?? 'never'}</span>
            </div>

            {(slip !== null || note) && (
                <div className="mt-1.5 flex flex-wrap items-baseline gap-x-3 gap-y-1">
                    {slip !== null && <p className={`shrink-0 font-mono text-[10px] ${slip > 12 ? 'text-amber-300/80' : 'text-zinc-600'}`}>{slip} weeks between the two</p>}
                    {note && <p className="min-w-0 flex-1 text-[11px]/5 text-zinc-600">{note}</p>}
                </div>
            )}
        </div>
    );
}
