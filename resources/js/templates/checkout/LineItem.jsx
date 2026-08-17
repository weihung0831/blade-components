const money = (value) => '$' + value.toLocaleString('en-US');

export function CheckoutLineItem({ item, editable = false, onStep = null, onRemove = null }) {
    return (
        <div className={`flex gap-4 ${editable ? 'py-5' : 'py-4'}`}>
            <div className={`dot-grid grid shrink-0 place-items-center rounded-xl border border-white/8 bg-ink-950 ${editable ? 'size-16 sm:size-20' : 'size-12'}`}>
                <svg className={`text-zinc-700 ${editable ? 'size-6' : 'size-5'}`} viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" strokeWidth="1.3"/>
                    <circle cx="8.5" cy="10" r="1.5" stroke="currentColor" strokeWidth="1.3"/>
                    <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
            </div>

            <div className="flex min-w-0 flex-1 flex-col">
                <div className="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                    <p className={`text-cream ${editable ? 'text-[15px]' : 'text-[13px]'}`}>{item.name}</p>
                    <p className={`shrink-0 font-mono text-cream ${editable ? 'text-[15px]' : 'text-[13px]'}`}>{money(item.price * item.qty)}</p>
                </div>

                <p className="mt-1 font-mono text-[11px] text-zinc-600">
                    {item.sku}
                    {item.option && ` · ${item.option}`}
                </p>

                {item.meta && <p className="mt-1.5 text-[13px] text-zinc-500">{item.meta}</p>}

                {editable ? (
                    <div className="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2">
                        <div className="inline-flex items-center rounded-lg border border-white/10 bg-ink-950">
                            <button
                                type="button"
                                aria-label={`One fewer ${item.name}`}
                                onClick={() => onStep?.(-1)}
                                className="grid size-8 place-items-center rounded-l-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            >
                                <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6h7" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round"/></svg>
                            </button>
                            <span className="w-8 text-center font-mono text-[13px] text-zinc-200">{item.qty}</span>
                            <button
                                type="button"
                                aria-label={`One more ${item.name}`}
                                onClick={() => onStep?.(1)}
                                className="grid size-8 place-items-center rounded-r-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            >
                                <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="M6 2.5v7M2.5 6h7" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round"/></svg>
                            </button>
                        </div>

                        <span className={`font-mono text-[11px] text-zinc-600 ${item.qty < 2 ? 'invisible' : ''}`}>{money(item.price)} each</span>

                        <button
                            type="button"
                            onClick={() => onRemove?.()}
                            className="ml-auto font-mono text-[11px] text-zinc-600 transition-colors duration-150 outline-none hover:text-red-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            Remove
                        </button>
                    </div>
                ) : (
                    <p className="mt-1.5 font-mono text-[11px] text-zinc-600">
                        × {item.qty}
                        {item.qty > 1 && ` · ${money(item.price)} each`}
                    </p>
                )}
            </div>
        </div>
    );
}
