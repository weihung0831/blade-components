export function PrivacyConsent({ name, state = 'off', lead, breaks, items = [], on = false, onToggle = () => {} }) {
    const locked = state === 'locked';
    const checked = locked || on;

    return (
        <section className="flex flex-col gap-3.5 px-4 py-4 sm:flex-row sm:gap-5">
            <div className="order-2 min-w-0 flex-1 sm:order-1">
                <div className="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                    <h3 className="text-[13px] text-cream">{name}</h3>
                    {locked ? (
                        <span className="font-mono text-[10px] text-zinc-600">no switch — it is how the shop works</span>
                    ) : (
                        <span className={`font-mono text-[10px] ${checked ? 'text-jade-400/90' : 'text-zinc-600'}`}>{checked ? 'on' : 'off'}</span>
                    )}
                </div>

                <p className="mt-1.5 text-[12px]/5 text-zinc-400">{lead}</p>

                <p className="mt-2 border-l-2 border-white/10 pl-2.5 text-[11px]/5 text-zinc-500">
                    <span className="font-mono text-[10px] text-zinc-700 uppercase">Without it</span><br/>
                    {breaks}
                </p>

                {items.length > 0 && (
                    <dl className="mt-2.5 flex flex-wrap gap-x-4 gap-y-1">
                        {items.map((item) => (
                            <div key={item.name} className="flex items-baseline gap-1.5">
                                <dt className="font-mono text-[10px] text-zinc-500">{item.name}</dt>
                                <dd className="font-mono text-[10px] text-zinc-700">{item.life}</dd>
                            </div>
                        ))}
                    </dl>
                )}
            </div>

            <div className="order-1 shrink-0 sm:order-2 sm:pt-0.5">
                <label className={`inline-flex items-center gap-2.5 ${locked ? 'pointer-events-none opacity-50' : 'cursor-pointer'}`}>
                    <input
                        type="checkbox"
                        role="switch"
                        className="peer sr-only"
                        aria-label={name}
                        checked={checked}
                        disabled={locked}
                        onChange={(event) => onToggle(event.target.checked)}
                    />
                    <span className="relative h-5 w-9 rounded-full border border-white/10 bg-ink-800 transition-colors duration-200 ease-snap peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70 after:absolute after:top-1 after:left-1 after:size-2.5 after:rounded-full after:bg-zinc-400 after:transition-[translate,background-color] after:duration-200 after:ease-snap peer-checked:after:translate-x-4 peer-checked:after:bg-ink-950"></span>
                </label>
            </div>
        </section>
    );
}
