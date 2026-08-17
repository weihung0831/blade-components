const STATES = {
    answered: { bar: 'bg-jade-500/50', tone: 'text-zinc-600', dot: 'bg-white/10' },
    thin: { bar: 'bg-amber-400/50', tone: 'text-amber-300', dot: 'bg-amber-400' },
    missing: { bar: 'bg-red-400/50', tone: 'text-red-300', dot: 'bg-red-400' },
};

export function FaqQuery({ term, hits, peak = 100, results = 0, read = null, state = 'answered' }) {
    const style = STATES[state] ?? STATES.answered;
    const width = Math.max(4, Math.round(hits / Math.max(peak, 1) * 100));

    return (
        <div className="flex items-center gap-3 border-b border-white/5 py-2.5 pr-3 pl-4">
            <span aria-hidden="true" className={`size-1.5 shrink-0 rounded-full ${style.dot}`}></span>

            <span className="w-52 shrink-0 truncate font-mono text-[12px] text-zinc-300">{term}</span>

            <span className="hidden h-1 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6 sm:block">
                <span className={`block h-full rounded-full ${style.bar}`} style={{ width: `${width}%` }}></span>
            </span>

            <span className="ml-auto flex shrink-0 items-baseline gap-4 whitespace-nowrap">
                <span className="hidden w-10 text-right font-mono text-[10px] text-zinc-700 md:block">{read !== null ? `${read}%` : '—'}</span>
                <span className={`w-16 text-right font-mono text-[10px] ${style.tone}`}>{results} {results === 1 ? 'answer' : 'answers'}</span>
                <span className="w-10 text-right font-mono text-[12px] text-zinc-400">{hits}</span>
            </span>
        </div>
    );
}
