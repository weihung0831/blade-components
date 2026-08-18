const MARKS = {
    hard: { dot: 'bg-red-400', label: 'buy something else' },
    soft: { dot: 'bg-amber-400', label: 'probably not' },
    fine: { dot: 'bg-jade-500', label: 'this one is fine' },
};

export function LandingObjection({ who, body, instead, insteadPrice, tone = 'hard', href = null }) {
    const mark = MARKS[tone] ?? MARKS.hard;

    return (
        <div className="flex flex-col gap-3 px-4 py-3.5 sm:flex-row sm:items-start sm:gap-5">
            <div className="min-w-0 flex-1">
                <p className="flex items-center gap-2">
                    <span className={`size-1.5 shrink-0 rounded-full ${mark.dot}`}></span>
                    <span className="text-[13px]/5 text-cream">{who}</span>
                </p>

                {body && <p className="mt-1.5 text-[12px]/5 text-zinc-500">{body}</p>}
            </div>

            <div className="shrink-0 sm:w-56">
                <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{mark.label}</p>

                {instead && (href
                    ? <a href={href} target="_top" className="mt-1 block text-[12px] text-jade-300 transition-colors duration-150 hover:text-jade-400">{instead}</a>
                    : <p className="mt-1 text-[12px] text-zinc-400">{instead}</p>)}

                {insteadPrice && <p className="mt-0.5 font-mono text-[10px] text-zinc-600">{insteadPrice}</p>}
            </div>
        </div>
    );
}
