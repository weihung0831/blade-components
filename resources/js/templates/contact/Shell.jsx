import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const LINKS = [
    { label: 'The desk', screen: 'desk' },
    { label: 'Write in', screen: 'write' },
    { label: 'Visit', screen: 'visit' },
];

const ROUTES = [
    { label: 'Warranty and repairs', reply: '47 min' },
    { label: 'Orders and delivery', reply: '2 h' },
    { label: 'Dealers and wholesale', reply: '1 day' },
    { label: 'Press and everything else', reply: '3 days' },
];

export function ContactShell({ active = 'The desk', rail = true, padded = true, toolbar = null, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/contact/screens/desk" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M3.5 7.5h17v11h-17z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="m3.5 8 8.5 6 8.5-6" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M8 4.5h8" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">nomadsupply.cc/contact</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/contact/screens/${link.screen}`}
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
                        <span className="hidden items-center gap-1.5 rounded-lg border border-amber-400/25 bg-amber-400/8 px-2 py-1 font-mono text-[11px] text-amber-300/90 lg:flex">
                            <span className="size-1.5 rounded-full bg-amber-400"></span>
                            Bench shut · 04:12 in Taipei
                        </span>

                        <a
                            href="/templates/contact/screens/write"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            Write in
                        </a>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="relative flex min-h-0 flex-1">
                {rail && (
                    <aside className="hidden w-56 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                        <div>
                            <p className="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where it lands</p>
                            <nav className="mt-2 px-2">
                                {ROUTES.map((entry) => (
                                    <a
                                        key={entry.label}
                                        href="/templates/contact/screens/write"
                                        target="_top"
                                        className="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        <span className="truncate">{entry.label}</span>
                                        <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{entry.reply}</span>
                                    </a>
                                ))}
                            </nav>

                            <p className="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Straight through</p>
                            <div className="mt-2 px-4">
                                <p className="font-mono text-[13px] text-cream">+886 2 2765 4418</p>
                                <p className="mt-1 text-[11px]/5 text-zinc-600">Tue to Thu, 14:00–17:00. Outside that it rings in an empty room and we would rather tell you than let you find out.</p>
                            </div>

                            <p className="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Counter</p>
                            <div className="mt-2 px-4">
                                <p className="text-[12px]/5 text-zinc-400">No. 12, Ln. 44, Sec. 3<br />Bade Rd, Songshan, Taipei</p>
                                <a
                                    href="/templates/contact/screens/visit"
                                    target="_top"
                                    className="mt-1.5 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300"
                                >
                                    how to get in →
                                </a>
                            </div>
                        </div>

                        <div className="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                            <p className="font-mono text-[10px] text-zinc-600">Before you write</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">Six letters in ten have an answer already sitting on the help centre.</p>
                            <a
                                href="/templates/faq/screens/questions"
                                target="_top"
                                className="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >
                                Look there first
                            </a>
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
