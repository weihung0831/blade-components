const TONES = {
    quiet: 'text-cream',
    due: 'text-jade-300',
    overdue: 'text-red-400',
};

export function InvoiceTotals({ rows = [], total, totalLabel = 'Total due', note, words, tone = 'quiet' }) {
    return (
        <div className="flex flex-col gap-3">
            <dl className="flex flex-col gap-2">
                {rows.map((row) => (
                    <div key={row.label} className="flex items-baseline justify-between gap-6">
                        <dt className={`text-[12px] ${row.strong ? 'text-zinc-300' : 'text-zinc-500'}`}>
                            {row.label}
                            {row.note && <span className="ml-1.5 font-mono text-[10px] text-zinc-700">{row.note}</span>}
                        </dt>
                        <dd className={`shrink-0 font-mono text-[12px] tabular-nums ${row.strong ? 'text-cream' : 'text-zinc-400'}`}>{row.value}</dd>
                    </div>
                ))}
            </dl>

            <div className="flex items-baseline justify-between gap-6 border-t border-white/10 pt-3">
                <span className="text-[13px] text-zinc-300">{totalLabel}</span>
                <span className={`shrink-0 font-mono text-lg font-semibold tracking-tight tabular-nums ${TONES[tone] ?? TONES.quiet}`}>{total}</span>
            </div>

            {words && <p className="text-[11px]/5 text-zinc-600">{words}</p>}

            {note && <p className="border-t border-white/6 pt-2.5 font-mono text-[10px] text-zinc-700">{note}</p>}
        </div>
    );
}
