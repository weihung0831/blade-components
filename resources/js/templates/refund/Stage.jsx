export function RefundStage({ reference, order, amount, lands, steps = [], stage = 0, note = null }) {
    return (
        <article className="overflow-hidden rounded-xl border border-jade-500/25 bg-jade-500/5">
            <div className="flex flex-wrap items-baseline gap-x-5 gap-y-2 border-b border-jade-500/15 px-4 py-3">
                <div className="min-w-0 flex-1">
                    <p className="text-[13px] text-cream">{amount} on its way back</p>
                    <p className="mt-0.5 font-mono text-[10px] text-zinc-500">{reference} · against order {order}</p>
                </div>

                <div className="text-right">
                    <p className="font-mono text-[11px] text-jade-300">{lands}</p>
                    <p className="mt-0.5 font-mono text-[10px] text-zinc-600">to the card that paid</p>
                </div>
            </div>

            <ol className="flex flex-col gap-0 px-4 py-3.5 sm:flex-row sm:gap-1">
                {steps.map((step, index) => (
                    <li key={step.label} className="flex flex-1 gap-2.5 sm:block">
                        <span className="flex shrink-0 flex-col items-center sm:w-full sm:flex-row sm:gap-1.5">
                            <span className={`block size-2 shrink-0 rounded-full ${index <= stage ? 'bg-jade-500' : 'border border-white/15'}`}></span>
                            {index < steps.length - 1 && (
                                <span className={`block w-px flex-1 sm:h-px sm:w-auto sm:flex-1 ${index < stage ? 'bg-jade-500/40' : 'bg-white/10'}`}></span>
                            )}
                        </span>

                        <span className="block pb-3 sm:pt-2 sm:pb-0">
                            <span className={`block text-[12px] ${index === stage ? 'text-cream' : index < stage ? 'text-zinc-400' : 'text-zinc-600'}`}>{step.label}</span>
                            <span className="mt-0.5 block font-mono text-[10px] text-zinc-700">{step.at ?? 'not yet'}</span>
                        </span>
                    </li>
                ))}
            </ol>

            {note && <p className="border-t border-jade-500/15 px-4 py-2.5 text-[11px]/5 text-zinc-500">{note}</p>}
        </article>
    );
}
