const PILLS = {
    force: { label: 'in force', class: 'border-jade-500/40 bg-jade-500/10 text-jade-300' },
    pending: { label: 'waiting', class: 'border-amber-400/30 bg-amber-400/8 text-amber-300/90' },
    retired: { label: 'retired', class: 'border-white/10 text-zinc-600' },
};

export function TermsRevision({ version, date, state = 'retired', lead = null, touched = [], consent = false, active = false, onSelect = null }) {
    const pill = PILLS[state] ?? { label: state, class: 'border-white/10 text-zinc-600' };

    return (
        <button
            type="button"
            onClick={onSelect}
            className={`group/rev flex w-full flex-col rounded-xl border p-3.5 text-left outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                active ? 'border-jade-500/60 bg-jade-500/8' : 'border-white/8 bg-ink-900 hover:border-white/15'
            }`}
        >
            <span className="flex items-baseline gap-2.5">
                <span className="font-mono text-base text-cream">{version}</span>
                <span className={`rounded border px-1.5 py-0.5 font-mono text-[10px] ${pill.class}`}>{pill.label}</span>
                <span className="ml-auto font-mono text-[10px] text-zinc-700">{date}</span>
            </span>

            {lead && <span className="mt-2 text-[12px]/5 text-zinc-500">{lead}</span>}

            <span className="mt-2.5 flex flex-wrap items-center gap-1.5">
                {touched.length > 0 && <span className="font-mono text-[10px] text-zinc-700">touched</span>}
                {touched.map((number) => (
                    <span key={number} className="rounded border border-white/10 px-1 py-0.5 font-mono text-[10px] text-zinc-500">{number}</span>
                ))}

                <span className={`ml-auto font-mono text-[10px] ${consent ? 'text-amber-300/80' : 'text-zinc-700'}`}>
                    {consent ? 'needed a yes from you' : 'notice only'}
                </span>
            </span>
        </button>
    );
}
