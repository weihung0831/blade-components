const LINKS = [
    { label: 'Answers', screen: 'questions' },
    { label: 'Ask', screen: 'ask' },
    { label: 'Editing', screen: 'editing' },
];

const TOPICS = [
    { label: 'Noise and grind', count: 4, hot: true },
    { label: 'Setting it up', count: 3, hot: false },
    { label: 'Warranty', count: 3, hot: false },
    { label: 'Orders and delivery', count: 3, hot: false },
    { label: 'Before you buy', count: 2, hot: false },
    { label: 'Dealers', count: 1, hot: false },
];

const ELSEWHERE = [
    { label: 'The manual, as a PDF', meta: '2.4 MB' },
    { label: 'Spare parts list', meta: '48 items' },
    { label: 'Workshop notes', meta: 'blog' },
];

export function FaqShell({ active = 'Answers', topic = null, rail = true, padded = true, toolbar = null, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/faq/screens/questions" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M4 5.5h7a2 2 0 0 1 2 2v11a2 2 0 0 0-2-2H4zM20 5.5h-7a2 2 0 0 0-2 2v11a2 2 0 0 1 2-2h7z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Help centre</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">help.nomadsupply.cc</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/faq/screens/${link.screen}`}
                                target="_top"
                                aria-current={link.label === active ? 'page' : undefined}
                                className={`rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                                    link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'
                                }`}
                            >
                                {link.label}
                            </a>
                        ))}
                    </nav>

                    <div className="ml-auto flex shrink-0 items-center gap-3">
                        <span className="hidden items-center gap-1.5 font-mono text-[11px] text-zinc-600 lg:flex">
                            <span className="size-1.5 rounded-full bg-jade-400"></span>
                            16 answers · last edited yesterday
                        </span>

                        <a
                            href="/templates/faq/screens/ask"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            Ask a person
                        </a>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="flex min-h-0 flex-1">
                {rail && (
                    <aside className="hidden w-56 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                        <div>
                            <p className="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Headings</p>
                            <nav className="mt-2 px-2">
                                {TOPICS.map((entry) => (
                                    <a
                                        key={entry.label}
                                        href="/templates/faq/screens/questions"
                                        target="_top"
                                        aria-current={entry.label === topic ? 'page' : undefined}
                                        className={`flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                                            entry.label === topic ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'
                                        }`}
                                    >
                                        <span className="truncate">{entry.label}</span>
                                        {entry.hot && <span className="size-1 shrink-0 rounded-full bg-jade-400/70"></span>}
                                        <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{entry.count}</span>
                                    </a>
                                ))}
                            </nav>

                            <p className="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Elsewhere</p>
                            <nav className="mt-2 px-2">
                                {ELSEWHERE.map((link) => (
                                    <a
                                        key={link.label}
                                        href="/templates/faq/screens/answer"
                                        target="_top"
                                        className="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        <span className="truncate">{link.label}</span>
                                        <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{link.meta}</span>
                                    </a>
                                ))}
                            </nav>
                        </div>

                        <div className="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                            <p className="font-mono text-[10px] text-zinc-600">If none of this helps</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">Four people read the mail. One of them built your grinder.</p>
                            <div className="mt-2.5 flex items-baseline gap-1.5">
                                <span className="font-mono text-lg text-cream">47</span>
                                <span className="font-mono text-[10px] text-zinc-600">min median first reply</span>
                            </div>
                            <a
                                href="/templates/faq/screens/ask"
                                target="_top"
                                className="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >
                                Write to the desk
                            </a>
                        </div>
                    </aside>
                )}

                {padded ? (
                    <main data-faq-scroll className="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{children}</main>
                ) : (
                    <main className="flex min-h-0 flex-1 flex-col overflow-hidden">{children}</main>
                )}
            </div>
        </div>
    );
}
