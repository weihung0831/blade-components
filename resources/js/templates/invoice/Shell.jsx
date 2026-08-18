import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const LINKS = [
    { label: 'The invoice', screen: 'document' },
    { label: 'Writing one', screen: 'compose' },
    { label: 'What is owed', screen: 'ledger' },
    { label: 'Getting paid', screen: 'chase' },
];

export function InvoiceShell({ active = 'The invoice', outstanding = 'NT$1,943,600', padded = true, toolbar = null, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/invoice/screens/document" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M6 3.5h9l3.5 3.5v13.5H6z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M15 3.5V7h3.5" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M9 12h6M9 15.5h4" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">billing, four people deep</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 lg:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/invoice/screens/${link.screen}`}
                                target="_top"
                                aria-current={link.label === active ? 'page' : undefined}
                                className={`rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'}`}
                            >{link.label}</a>
                        ))}
                    </nav>

                    <div className="ml-auto flex shrink-0 items-center gap-3">
                        <a href="/templates/invoice/screens/ledger" target="_top" className="hidden flex-col items-end leading-none transition-colors duration-150 hover:text-cream sm:flex">
                            <span className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">out there</span>
                            <span className="mt-1 font-mono text-[13px] tabular-nums text-zinc-300">{outstanding}</span>
                        </a>

                        <a
                            href="/templates/invoice/screens/compose"
                            target="_top"
                            className="inline-flex items-center gap-2 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Write one</a>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="relative flex min-h-0 flex-1 flex-col">
                {padded ? (
                    <main data-ui-scroll-region className="min-h-0 flex-1 overflow-y-auto px-4 py-8 sm:px-5">{children}</main>
                ) : (
                    <main className="flex min-h-0 flex-1 flex-col overflow-hidden">{children}</main>
                )}

                {padded && <UiScrollTop anchor="container" variant="progress" threshold={300} />}
            </div>

            <footer className="shrink-0 border-t border-white/5 bg-ink-950 px-4 py-2.5 sm:px-5">
                <div className="mx-auto flex max-w-4xl flex-wrap items-center gap-x-4 gap-y-1.5">
                    <span className="font-mono text-[10px] text-zinc-700">統一編號 54318207</span>
                    <span className="text-[11px] text-zinc-600">Nomad Supply Ltd · No. 12, Ln. 44, Sec. 3, Bade Rd, Songshan, Taipei 105</span>
                    <span className="ml-auto font-mono text-[10px] text-zinc-700">every figure here is what the customer is charged, to the dollar</span>
                </div>
            </footer>
        </div>
    );
}
