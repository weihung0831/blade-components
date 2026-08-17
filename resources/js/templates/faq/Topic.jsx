const pad = (value) => String(value).padStart(2, '0');

export function FaqTopic({ name, count = 0, lead = null, health = null, note = null, active = false, onSelect }) {
    return (
        <button
            type="button"
            onClick={onSelect}
            className={`group/topic flex flex-col rounded-xl border bg-ink-900 px-4 py-3.5 text-left outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                active ? 'border-jade-500/60 bg-jade-500/8' : 'border-white/8 hover:border-white/15'
            }`}
        >
            <span className="flex items-baseline gap-2">
                <span className={`text-[13px] font-medium ${active ? 'text-cream' : 'text-zinc-300'}`}>{name}</span>
                <span className={`ml-auto font-mono text-[11px] ${active ? 'text-jade-400' : 'text-zinc-700'}`}>{pad(count)}</span>
            </span>

            {lead && <span className="mt-1.5 line-clamp-2 text-[12px]/5 text-zinc-600">Most opened: {lead}</span>}

            <span className="mt-3 flex items-center gap-2">
                <span className="block h-0.5 flex-1 overflow-hidden rounded-full bg-white/8">
                    <span
                        className={`block h-full rounded-full ${(health ?? 100) >= 80 ? 'bg-jade-500/60' : 'bg-amber-400/60'}`}
                        style={{ width: `${health ?? 0}%` }}
                    ></span>
                </span>
                <span className="shrink-0 font-mono text-[10px] text-zinc-700">{note ?? `${health}% helpful`}</span>
            </span>
        </button>
    );
}
