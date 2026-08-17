const LINKS = [
    { label: 'The terms', screen: 'document' },
    { label: 'Short version', screen: 'plain' },
    { label: 'What changed', screen: 'changes' },
    { label: 'Your copy', screen: 'record' },
];

const SECTIONS = [
    { number: '01', title: 'Who you are dealing with' },
    { number: '02', title: 'What these cover' },
    { number: '03', title: 'Ordering and when we charge' },
    { number: '04', title: 'Delivery, customs, risk' },
    { number: '05', title: 'Changing your mind' },
    { number: '06', title: 'The two-year warranty' },
    { number: '07', title: 'Repairs outside it' },
    { number: '08', title: 'Burrs and what wears out' },
    { number: '09', title: 'Your account' },
    { number: '10', title: 'Our photographs and drawings' },
    { number: '11', title: 'When the site is down' },
    { number: '12', title: 'What we owe you' },
    { number: '13', title: 'Changing these terms' },
    { number: '14', title: 'Law, and arguments' },
];

export function TermsShell({ active = 'The terms', rail = true, padded = true, toolbar = null, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/terms/screens/document" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M6 3.5h8l4 4v13H6z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M14 3.5v4h4" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M9 12h6M9 15.5h4" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">nomadsupply.cc/terms</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/terms/screens/${link.screen}`}
                                target="_top"
                                aria-current={link.label === active ? 'page' : undefined}
                                className={`rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                                    link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'
                                }`}
                            >{link.label}</a>
                        ))}
                    </nav>

                    <div className="ml-auto flex shrink-0 items-center gap-3">
                        <a
                            href="/templates/terms/screens/changes"
                            target="_top"
                            className="hidden items-center gap-1.5 rounded-lg border border-amber-400/25 bg-amber-400/8 px-2 py-1 font-mono text-[11px] text-amber-300/90 transition-colors duration-150 hover:border-amber-400/50 lg:flex"
                        >
                            <span className="size-1.5 rounded-full bg-amber-400"></span>
                            4.2 takes effect in 28 days
                        </a>

                        <a
                            href="/templates/terms/screens/record"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Your copy</a>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="flex min-h-0 flex-1">
                {rail && (
                    <aside className="hidden w-56 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                        <div>
                            <p className="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Fourteen clauses</p>
                            <nav className="mt-2 px-2">
                                {SECTIONS.map((section) => (
                                    <a
                                        key={section.number}
                                        href={`/templates/terms/screens/document#clause-${section.number}`}
                                        target="_top"
                                        className="flex items-baseline gap-2 rounded-lg px-2 py-1 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        <span className="font-mono text-[10px] text-zinc-700">{section.number}</span>
                                        <span className="truncate">{section.title}</span>
                                    </a>
                                ))}
                            </nav>

                            <p className="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">In force</p>
                            <div className="mt-2 px-4">
                                <p className="font-mono text-[13px] text-cream">4.1</p>
                                <p className="mt-1 text-[11px]/5 text-zinc-600">Since 12 March 2026. Every order you have placed since then is under this one and stays under it.</p>
                                <a
                                    href="/templates/terms/screens/changes"
                                    target="_top"
                                    className="mt-1.5 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300"
                                >seven versions before it →</a>
                            </div>
                        </div>

                        <div className="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                            <p className="font-mono text-[10px] text-zinc-600">A clause you do not like</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">Say which number and what you would rather it said. Two of these ended up in 4.1.</p>
                            <a
                                href="/templates/contact/screens/write"
                                target="_top"
                                className="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >Write in about it</a>
                        </div>
                    </aside>
                )}

                {padded ? (
                    <main data-terms-scroll className="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{children}</main>
                ) : (
                    <main className="flex min-h-0 flex-1 flex-col overflow-hidden">{children}</main>
                )}
            </div>
        </div>
    );
}
