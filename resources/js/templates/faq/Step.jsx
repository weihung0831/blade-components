export function FaqStep({ number, title, minutes = null, tools = [], last = false, children }) {
    return (
        <div className="relative flex gap-4 pb-6">
            {!last && <span aria-hidden="true" className="absolute top-8 bottom-0 left-3.5 w-px bg-white/8"></span>}

            <span className="relative z-10 grid size-7 shrink-0 place-items-center rounded-full border border-jade-500/40 bg-ink-950 font-mono text-[11px] text-jade-300">{number}</span>

            <div className="min-w-0 flex-1">
                <div className="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                    <h4 className="text-[13px] font-medium text-cream">{title}</h4>
                    {minutes && <span className="font-mono text-[10px] text-zinc-600">{minutes}</span>}
                </div>

                <div className="mt-1.5 space-y-2 text-[13px]/6 text-zinc-400">{children}</div>

                {tools.length > 0 && (
                    <div className="mt-2.5 flex flex-wrap items-center gap-1.5">
                        <span className="font-mono text-[10px] text-zinc-700">needs</span>
                        {tools.map((tool) => (
                            <span key={tool} className="rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500">{tool}</span>
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}
