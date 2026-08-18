export function PrivacyClock({ label, span, unit = 'days', elapsed = 0, then, pinned = false }) {
    const ratio = span > 0 ? Math.min(100, (elapsed / span) * 100) : 0;

    return (
        <div className="rounded-xl border border-white/8 bg-ink-900 p-3.5">
            <div className="flex items-baseline gap-3">
                <p className="min-w-0 flex-1 truncate text-[13px] text-cream">{label}</p>
                <p className={`shrink-0 font-mono text-[11px] ${pinned ? 'text-amber-300/80' : 'text-zinc-400'}`}>{span} {unit}</p>
            </div>

            <div className="mt-2.5 h-1.5 overflow-hidden rounded-full bg-white/8">
                <div className={`h-full rounded-full ${pinned ? 'bg-amber-400/60' : 'bg-jade-500'}`} style={{ width: `${ratio.toFixed(2)}%` }}></div>
            </div>

            <div className="mt-2 flex items-baseline justify-between gap-3">
                <p className="shrink-0 font-mono text-[10px] whitespace-nowrap text-zinc-700">{elapsed} {unit} in</p>
                <p className="min-w-0 truncate text-right text-[11px] text-zinc-500">{then}</p>
            </div>
        </div>
    );
}
