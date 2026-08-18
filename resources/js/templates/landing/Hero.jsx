export function LandingHero({ eyebrow, headline, sentence, price, priceNote, action, actionNote, second, facts = [], children }) {
    return (
        <section className="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)] lg:gap-12">
            <div className="min-w-0">
                {eyebrow && (
                    <p className="flex items-center gap-2 font-mono text-[11px] tracking-wider text-jade-400 uppercase">
                        <span className="h-px w-6 bg-jade-500/50"></span>
                        {eyebrow}
                    </p>
                )}

                <h1 className="mt-4 max-w-2xl text-3xl leading-[1.1] font-semibold tracking-tight text-balance text-cream sm:text-[40px]">{headline}</h1>

                {sentence && <p className="mt-4 max-w-xl text-[14px]/7 text-zinc-400">{sentence}</p>}

                <div className="mt-7 flex flex-wrap items-center gap-3">
                    {price && (
                        <>
                            <span className="flex items-baseline gap-1.5">
                                <span className="font-mono text-2xl font-semibold tracking-tight tabular-nums text-cream">{price}</span>
                                {priceNote && <span className="font-mono text-[10px] text-zinc-600">{priceNote}</span>}
                            </span>

                            <span className="h-6 w-px bg-white/10"></span>
                        </>
                    )}

                    {action && (
                        <a
                            href="#"
                            target="_top"
                            className="group inline-flex items-center gap-2 rounded-xl bg-jade-500 px-4 py-2.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            {action}
                            <svg className="size-3.5 transition-transform duration-150 group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M3 8h9m0 0L8.5 4.5M12 8l-3.5 3.5" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        </a>
                    )}

                    {second && (
                        <a
                            href="#"
                            target="_top"
                            className="inline-flex items-center gap-2 rounded-xl border border-white/10 px-4 py-2.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >{second}</a>
                    )}
                </div>

                {actionNote && <p className="mt-3 font-mono text-[10px] text-zinc-600">{actionNote}</p>}

                {facts.length > 0 && (
                    <dl className="mt-8 grid grid-cols-2 gap-x-6 gap-y-4 border-t border-white/6 pt-6 sm:grid-cols-4">
                        {facts.map((fact) => (
                            <div key={fact.label}>
                                <dt className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{fact.label}</dt>
                                <dd className="mt-1 font-mono text-[15px] tabular-nums text-cream">{fact.value}</dd>
                                {fact.note && <dd className="mt-0.5 text-[11px]/4 text-zinc-600">{fact.note}</dd>}
                            </div>
                        ))}
                    </dl>
                )}
            </div>

            {children && <div className="min-w-0">{children}</div>}
        </section>
    );
}
