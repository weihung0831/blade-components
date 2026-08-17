const PILLS = {
    accepted: { label: 'accepted', class: 'border-jade-500/40 bg-jade-500/10 text-jade-300' },
    waiting: { label: 'not yet accepted', class: 'border-amber-400/30 bg-amber-400/8 text-amber-300/90' },
    superseded: { label: 'superseded', class: 'border-white/10 text-zinc-600' },
};

export function TermsStamp({ version, state = 'accepted', when = null, rows = [], hash = null, note = null, actions = null }) {
    const pill = PILLS[state] ?? { label: state, class: 'border-white/10 text-zinc-600' };

    return (
        <div className="rounded-xl border border-white/8 bg-ink-900 p-4">
            <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1.5">
                <span className="font-mono text-xl text-cream">{version}</span>
                <span className={`rounded border px-1.5 py-0.5 font-mono text-[10px] ${pill.class}`}>{pill.label}</span>
                {when && <span className="ml-auto font-mono text-[11px] text-zinc-600">{when}</span>}
            </div>

            {rows.length > 0 && (
                <dl className="mt-3.5 border-t border-dashed border-white/10 pt-3.5">
                    {rows.map((row) => (
                        <div key={row.label} className="flex gap-4 py-1">
                            <dt className="w-28 shrink-0 font-mono text-[10px] text-zinc-700 uppercase">{row.label}</dt>
                            <dd className={`min-w-0 flex-1 text-[12px]/5 ${row.mono ? 'font-mono text-zinc-300' : 'text-zinc-400'}`}>{row.value}</dd>
                        </div>
                    ))}
                </dl>
            )}

            {hash && (
                <p className="mt-3 truncate border-t border-dashed border-white/10 pt-3 font-mono text-[10px] text-zinc-700">sha256 {hash}</p>
            )}

            {note && <p className="mt-3 text-[11px]/5 text-zinc-600">{note}</p>}

            {actions && <div className="mt-3.5 flex flex-wrap gap-2">{actions}</div>}
        </div>
    );
}
