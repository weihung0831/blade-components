export function OnboardingFunnel({ step, reached, of, minutes = null, claimed = null, lost = 0, note, worst = false }) {
    const ratio = of > 0 ? Math.round((reached / of) * 1000) / 10 : 0;
    const over = claimed !== null && minutes !== null && minutes > claimed;
    const count = (value) => value.toLocaleString('en-US');

    return (
        <div className="px-3.5 py-3">
            <div className="flex flex-wrap items-baseline gap-x-4 gap-y-1">
                <p className={`min-w-0 flex-1 truncate text-[13px] ${worst ? 'text-amber-300' : 'text-cream'}`}>{step}</p>
                <p className="shrink-0 font-mono text-[11px] text-zinc-400">{count(reached)}</p>
                <p className="w-12 shrink-0 text-right font-mono text-[11px] text-zinc-600">{ratio}%</p>
            </div>

            <div className="mt-2 flex items-center gap-2">
                <span className="h-1.5 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6">
                    <span
                        className={`block h-full rounded-full transition-[width] duration-300 ${worst ? 'bg-amber-400/70' : 'bg-jade-500'}`}
                        style={{ width: `${ratio}%` }}
                    ></span>
                </span>

                {lost > 0 && <span className="shrink-0 font-mono text-[10px] text-zinc-700">{count(lost)} stopped here</span>}
            </div>

            <div className="mt-1.5 flex flex-wrap items-baseline gap-x-4 gap-y-1">
                {minutes !== null && (
                    <p className={`shrink-0 font-mono text-[10px] ${over ? 'text-amber-300/80' : 'text-zinc-600'}`}>
                        {minutes} min in practice{claimed !== null && `, ${claimed} on the label`}
                    </p>
                )}

                {note && <p className="min-w-0 flex-1 text-[11px]/5 text-zinc-600">{note}</p>}
            </div>
        </div>
    );
}
