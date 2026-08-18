const STATES = {
    normal: { label: 'normal', dot: 'bg-jade-500', text: 'text-zinc-600' },
    slow: { label: 'slow', dot: 'bg-amber-400', text: 'text-amber-300' },
    down: { label: 'down', dot: 'bg-red-400', text: 'text-red-400' },
    off: { label: 'off on purpose', dot: 'bg-white/25', text: 'text-zinc-500' },
};

export function ErrorPagesService({ name, state = 'normal', means, since }) {
    const mark = STATES[state] ?? STATES.normal;

    return (
        <div data-state={state} className="flex items-start gap-3 px-3.5 py-2.5">
            <span className={`mt-1.5 size-1.5 shrink-0 rounded-full ${mark.dot}`}></span>

            <span className="min-w-0 flex-1">
                <span className="flex flex-wrap items-baseline gap-x-2">
                    <span className="text-[13px]/5 text-cream">{name}</span>
                    <span className={`font-mono text-[10px] ${mark.text}`}>{mark.label}</span>
                    {since && <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{since}</span>}
                </span>

                {means && <span className="mt-0.5 block text-[11px]/5 text-zinc-500">{means}</span>}
            </span>
        </div>
    );
}
