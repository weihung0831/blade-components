export function RefundReason({ label, lead, days, picked = false, onPick }) {
    return (
        <button
            type="button"
            data-active={picked ? '' : undefined}
            className="group flex w-full flex-col gap-1.5 rounded-xl border border-white/8 bg-ink-900 p-3.5 text-left transition-colors duration-150 outline-none hover:border-white/20 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:border-jade-500/50 data-active:bg-jade-500/8"
            onClick={onPick}
        >
            <span className="flex items-baseline gap-2.5">
                <span className="size-1.5 shrink-0 rounded-full bg-zinc-700 group-data-active:bg-jade-500"></span>
                <span className="min-w-0 flex-1 text-[13px] text-zinc-300 group-data-active:text-cream">{label}</span>
                <span className="shrink-0 font-mono text-[10px] text-zinc-700 group-data-active:text-jade-400">{days}</span>
            </span>

            <span className="block pl-4 text-[11px]/5 text-zinc-600 group-data-active:text-zinc-400">{lead}</span>
        </button>
    );
}
