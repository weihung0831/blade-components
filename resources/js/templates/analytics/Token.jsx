export function AnalyticsToken({ type = 'where', label, value = null, removable = true }) {
    return (
        <span className="group/token inline-flex items-center gap-2 rounded-lg border border-white/10 bg-ink-900 py-1 pr-1 pl-2.5 text-[13px] transition-colors duration-150 hover:border-white/20">
            <span className={`font-mono text-[10px] tracking-wider uppercase ${type === 'event' ? 'text-jade-400' : 'text-zinc-600'}`}>{type}</span>

            <span className="text-zinc-200">{label}</span>

            {value && <span className="font-mono text-[11px] text-zinc-500">{value}</span>}

            {removable && (
                <button
                    type="button"
                    aria-label={`Remove ${label}`}
                    className="grid size-5 shrink-0 place-items-center rounded-md text-zinc-700 transition-colors duration-150 outline-none hover:bg-white/8 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M3 3l6 6M9 3l-6 6" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" /></svg>
                </button>
            )}
        </span>
    );
}
