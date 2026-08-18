import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const LINKS = [
    { label: 'The log', screen: 'releases' },
    { label: 'One release', screen: 'release' },
    { label: 'Getting told', screen: 'subscribe' },
    { label: 'The record', screen: 'record' },
];

const MONTHS = [
    { label: 'August 2026', count: 4, pulled: 0 },
    { label: 'July 2026', count: 5, pulled: 1 },
    { label: 'June 2026', count: 4, pulled: 0 },
    { label: 'May 2026', count: 3, pulled: 0 },
    { label: 'April 2026', count: 6, pulled: 1 },
];

export function ChangelogShell({ active = 'The log', version = '4.2.1', rail = true, padded = true, toolbar = null, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/changelog/screens/releases" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M12 4v16" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                            <circle cx="12" cy="8" r="2.2" stroke="currentColor" strokeWidth="1.4"/>
                            <circle cx="12" cy="16" r="2.2" stroke="currentColor" strokeWidth="1.4"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">what changed, and when</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/changelog/screens/${link.screen}`}
                                target="_top"
                                aria-current={link.label === active ? 'page' : undefined}
                                className={`rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'}`}
                            >{link.label}</a>
                        ))}
                    </nav>

                    <div className="ml-auto flex shrink-0 items-center gap-3">
                        <span className="hidden items-center gap-1.5 font-mono text-[11px] text-zinc-600 lg:flex">
                            <span className="size-1.5 rounded-full bg-jade-500/70"></span>
                            running {version} everywhere since Tuesday
                        </span>

                        <a
                            href="/templates/changelog/screens/subscribe"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Get told</a>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="relative flex min-h-0 flex-1">
                {rail && (
                    <aside className="hidden w-60 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                        <div>
                            <p className="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">41 releases since March 2023</p>

                            <ul className="mt-3">
                                {MONTHS.map((month, index) => (
                                    <li key={month.label}>
                                        <a
                                            href="/templates/changelog/screens/releases"
                                            target="_top"
                                            className={`flex items-baseline gap-2 px-4 py-1.5 text-[13px] transition-colors duration-150 ${index === 0 ? 'text-cream' : 'text-zinc-500 hover:text-cream'}`}
                                        >
                                            <span className="min-w-0 flex-1 truncate">{month.label}</span>
                                            <span className="shrink-0 font-mono text-[10px] text-zinc-700">{month.count}</span>
                                            {month.pulled > 0 && <span className="size-1.5 shrink-0 rounded-full bg-red-400/70" title="one was pulled"></span>}
                                        </a>
                                    </li>
                                ))}
                            </ul>

                            <p className="mt-2 border-t border-white/5 px-4 pt-3 text-[11px]/5 text-zinc-600">
                                Everything before April 2026 sits in the archive. Nothing is ever edited after it goes up — a wrong
                                entry gets a second entry under it.
                            </p>
                        </div>

                        <div className="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                            <p className="font-mono text-[10px] text-zinc-600">Three of the 41 came back off</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">
                                They stay in the log with the reason written under them. A changelog you can delete from is a
                                marketing page.
                            </p>
                            <a
                                href="/templates/changelog/screens/record"
                                target="_top"
                                className="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >What we said we would ship</a>
                        </div>
                    </aside>
                )}

                {padded ? (
                    <main data-ui-scroll-region className="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{children}</main>
                ) : (
                    <main className="flex min-h-0 flex-1 flex-col overflow-hidden">{children}</main>
                )}

                {padded && <UiScrollTop anchor="container" variant="progress" threshold={300} />}
            </div>
        </div>
    );
}
