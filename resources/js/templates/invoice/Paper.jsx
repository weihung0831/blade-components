export function InvoicePaper({ number, issued, due, terms, reference, currency = 'TWD', title = 'Invoice', children }) {
    return (
        <article className="relative overflow-hidden rounded-2xl border border-white/10 bg-ink-900 shadow-2xl shadow-black/40">
            <span aria-hidden="true" className="absolute inset-x-0 top-0 h-0.5 bg-jade-500/60"></span>

            <header className="flex flex-col gap-6 border-b border-white/8 p-6 sm:flex-row sm:items-start sm:justify-between sm:p-8">
                <div className="flex items-start gap-3">
                    <svg className="mt-0.5 size-7 shrink-0 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M6 4h12l-2.2 8.5a4 4 0 0 1-3.9 3H12a4 4 0 0 1-3.9-3.1L6 4Z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                        <path d="M12 15.5V20M9.5 20h5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                    </svg>

                    <div>
                        <p className="text-[15px] font-medium tracking-tight text-cream">Nomad Supply Ltd</p>
                        <p className="mt-1 text-[11px]/5 text-zinc-500">
                            No. 12, Ln. 44, Sec. 3, Bade Rd<br />
                            Songshan District, Taipei 105, Taiwan
                        </p>
                        <p className="mt-1.5 font-mono text-[10px] text-zinc-600">統一編號 54318207 · +886 2 2771 4180</p>
                    </div>
                </div>

                <div className="sm:text-right">
                    <p className="font-mono text-[11px] tracking-[0.2em] text-zinc-600 uppercase">{title}</p>
                    <p className="mt-1 font-mono text-xl font-semibold tracking-tight text-cream">{number}</p>

                    <dl className="mt-3 flex flex-col gap-1 sm:items-end">
                        <div className="flex items-baseline gap-3 sm:justify-end">
                            <dt className="font-mono text-[10px] text-zinc-700">issued</dt>
                            <dd className="font-mono text-[11px] text-zinc-400">{issued}</dd>
                        </div>

                        {due && (
                            <div className="flex items-baseline gap-3 sm:justify-end">
                                <dt className="font-mono text-[10px] text-zinc-700">due</dt>
                                <dd className="font-mono text-[11px] text-zinc-300">{due}</dd>
                            </div>
                        )}

                        {terms && (
                            <div className="flex items-baseline gap-3 sm:justify-end">
                                <dt className="font-mono text-[10px] text-zinc-700">terms</dt>
                                <dd className="font-mono text-[11px] text-zinc-400">{terms}</dd>
                            </div>
                        )}

                        {reference && (
                            <div className="flex items-baseline gap-3 sm:justify-end">
                                <dt className="font-mono text-[10px] text-zinc-700">your ref</dt>
                                <dd className="font-mono text-[11px] text-zinc-400">{reference}</dd>
                            </div>
                        )}

                        <div className="flex items-baseline gap-3 sm:justify-end">
                            <dt className="font-mono text-[10px] text-zinc-700">currency</dt>
                            <dd className="font-mono text-[11px] text-zinc-400">{currency}</dd>
                        </div>
                    </dl>
                </div>
            </header>

            {children}
        </article>
    );
}
