export function ProductReviewBar({ stars, count, percent, active = false, onSelect }) {
    return (
        <button
            type="button"
            onClick={() => onSelect?.(stars)}
            className="group/bar flex w-full items-center gap-3 rounded-lg px-2 py-1.5 text-left transition-colors duration-150 outline-none hover:bg-white/4 focus-visible:ring-2 focus-visible:ring-jade-500/70"
        >
            <span className={`w-8 shrink-0 font-mono text-[11px] ${active ? 'text-jade-300' : 'text-zinc-500'}`}>{stars} ★</span>

            <span className="h-1.5 flex-1 overflow-hidden rounded-full bg-ink-800">
                <span
                    className={`block h-full rounded-full transition-colors duration-150 ${active ? 'bg-jade-500' : 'bg-zinc-600 group-hover/bar:bg-zinc-500'}`}
                    style={{ width: `${percent}%` }}
                ></span>
            </span>

            <span className="w-10 shrink-0 text-right font-mono text-[11px] text-zinc-600">{count}</span>
        </button>
    );
}
