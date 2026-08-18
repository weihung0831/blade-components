const FREIGHTS = {
    you: { label: 'you pay $18', class: 'text-zinc-500' },
    us: { label: 'we book the courier', class: 'text-jade-400/90' },
    none: { label: 'nothing to send', class: 'text-zinc-600' },
};

const OUTCOMES = {
    all: { label: 'every cent back', dot: 'bg-jade-500', class: 'text-jade-400/90' },
    part: { label: 'most of it back', dot: 'bg-white/25', class: 'text-zinc-500' },
    none: { label: 'nothing back', dot: 'bg-amber-400/70', class: 'text-amber-300/80' },
};

export function RefundRule({ reason, window, condition, freight = 'you', back = 'all', note = null }) {
    const carrier = FREIGHTS[freight] ?? FREIGHTS.you;
    const outcome = OUTCOMES[back] ?? OUTCOMES.all;

    return (
        <div className="flex flex-col gap-2 px-3.5 py-3 sm:flex-row sm:gap-5">
            <div className="w-full shrink-0 sm:w-52">
                <p className="text-[13px] text-cream">{reason}</p>
                <p className="mt-0.5 font-mono text-[10px] text-zinc-600">{window}</p>
            </div>

            <div className="min-w-0 flex-1">
                <p className="text-[12px]/5 text-zinc-400">{condition}</p>
                {note && <p className="mt-1.5 text-[11px]/5 text-zinc-600">{note}</p>}
            </div>

            <div className="flex shrink-0 items-baseline gap-4 sm:w-44 sm:flex-col sm:items-end sm:gap-1.5">
                <p className={`font-mono text-[11px] ${carrier.class}`}>{carrier.label}</p>
                <p className={`flex items-center gap-1.5 font-mono text-[10px] ${outcome.class}`}>
                    <span className={`size-1.5 rounded-full ${outcome.dot}`}></span>
                    {outcome.label}
                </p>
            </div>
        </div>
    );
}
