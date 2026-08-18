const STATES = {
    matched: { label: 'matched', className: 'text-jade-400/90', dot: 'bg-jade-500' },
    guessed: { label: 'our guess', className: 'text-zinc-400', dot: 'bg-white/30' },
    clash: { label: 'already here', className: 'text-amber-300/80', dot: 'bg-amber-400/70' },
    dropped: { label: 'not coming', className: 'text-zinc-600', dot: 'bg-white/10' },
};

export function OnboardingMapping({ source, sample, target, state = 'matched', note, options = [] }) {
    const tone = STATES[state] ?? STATES.matched;

    return (
        <div className="flex flex-col gap-2 px-3.5 py-3 sm:flex-row sm:items-center sm:gap-4" data-state={state}>
            <div className="min-w-0 sm:w-44">
                <p className="truncate font-mono text-[12px] text-cream">{source}</p>
                <p className="mt-0.5 truncate font-mono text-[10px] text-zinc-600">{sample}</p>
            </div>

            <svg className="hidden size-3 shrink-0 text-zinc-700 sm:block" viewBox="0 0 12 12" fill="none">
                <path d="M2 6h8m0 0L7.2 3.2M10 6 7.2 8.8" stroke="currentColor" strokeWidth="1.2" strokeLinecap="round" strokeLinejoin="round"/>
            </svg>

            <div className="min-w-0 flex-1">
                {state === 'dropped' ? (
                    <p className="font-mono text-[12px] text-zinc-700 line-through">{target}</p>
                ) : (
                    <div className="flex items-center gap-2">
                        <span className="min-w-0 truncate rounded-lg border border-white/10 bg-ink-950 px-2.5 py-1.5 font-mono text-[12px] text-zinc-300">{target}</span>
                        {options.length > 0 && <span className="font-mono text-[10px] text-zinc-700">{options.length} other columns fit</span>}
                    </div>
                )}

                {note && <p className="mt-1.5 text-[11px]/5 text-zinc-600">{note}</p>}
            </div>

            <p className={`flex shrink-0 items-center gap-1.5 font-mono text-[10px] sm:w-28 sm:justify-end ${tone.className}`}>
                <span className={`size-1.5 rounded-full ${tone.dot}`}></span>
                {tone.label}
            </p>
        </div>
    );
}
