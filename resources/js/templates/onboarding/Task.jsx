export function OnboardingTask({ label, why, cost, done = false, required = false, moved, onToggle }) {
    return (
        <button
            type="button"
            data-required={required ? 'yes' : 'no'}
            data-done={done ? '' : undefined}
            className="group/task flex w-full items-start gap-3 px-3.5 py-3 text-left outline-none transition-colors duration-150 hover:bg-white/4 focus-visible:ring-2 focus-visible:ring-jade-500/70 focus-visible:-outline-offset-1"
            onClick={onToggle}
        >
            <span className="mt-0.5 grid size-4 shrink-0 place-items-center rounded border border-white/15 text-transparent transition-colors duration-150 group-hover/task:border-white/30 group-data-done/task:border-jade-500 group-data-done/task:bg-jade-500 group-data-done/task:text-ink-950">
                <svg className="size-2.5" viewBox="0 0 10 10" fill="none">
                    <path d="M1.5 5.2 3.8 7.5 8.5 2.5" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
            </span>

            <span className="min-w-0 flex-1">
                <span className="flex flex-wrap items-baseline gap-x-2 gap-y-1">
                    <span className="text-[13px] text-cream transition-colors duration-150 group-data-done/task:text-zinc-500 group-data-done/task:line-through group-data-done/task:decoration-white/20">{label}</span>

                    {required && <span className="shrink-0 font-mono text-[10px] text-amber-300/70 group-data-done/task:text-zinc-700">holds the shop shut</span>}
                    {cost && <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{cost}</span>}
                </span>

                {why && <span className="mt-1 block text-[11px]/5 text-zinc-600">{why}</span>}

                {moved && (
                    <span className="mt-1.5 flex items-baseline gap-1.5 font-mono text-[10px] text-zinc-700">
                        <span className="mt-1.5 h-px w-3 shrink-0 bg-zinc-700"></span>
                        {moved}
                    </span>
                )}
            </span>
        </button>
    );
}
