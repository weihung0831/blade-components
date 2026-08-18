import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const LINKS = [
    { label: 'The pitch', screen: 'pitch' },
    { label: 'The measurements', screen: 'proof' },
    { label: 'Not for you', screen: 'objections' },
    { label: 'The next batch', screen: 'batch' },
];

const COLUMNS = [
    { heading: 'The machine', items: ['Mk3, NT$4,200', 'Burrs and spares', 'What is in the box', 'Every measurement we take'] },
    { heading: 'The workshop', items: ['Where it is made', 'The four of us', 'Batch 39, eleven weeks late', 'What we stopped making'] },
    { heading: 'If it goes wrong', items: ['Send it back, 60 days', 'The crank collar fix', 'Ana at the desk', 'Warranty, and what it covers'] },
];

export function LandingShell({ active = 'The pitch', ribbon = 'Batch 41 opens 2 September. 46 of the 180 are still unspoken for.', padded = true, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                {ribbon && (
                    <div className="flex items-center justify-center gap-2 border-b border-jade-500/15 bg-jade-500/6 px-4 py-1.5 text-center">
                        <span className="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                        <p className="text-[11px] text-jade-300">{ribbon}</p>
                    </div>
                )}

                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/landing/screens/pitch" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M6 4h12l-2.2 8.5a4 4 0 0 1-3.9 3H12a4 4 0 0 1-3.9-3.1L6 4Z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M12 15.5V20M9.5 20h5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">hand grinders, Taipei</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 lg:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/landing/screens/${link.screen}`}
                                target="_top"
                                aria-current={link.label === active ? 'page' : undefined}
                                className={`rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'}`}
                            >{link.label}</a>
                        ))}
                    </nav>

                    <div className="ml-auto flex shrink-0 items-center gap-3">
                        <span className="hidden items-center gap-2 font-mono text-[11px] text-zinc-600 sm:flex">
                            <span className="tabular-nums text-zinc-400">6,142</span> out there since 2019
                        </span>

                        <a
                            href="/templates/landing/screens/batch"
                            target="_top"
                            className="inline-flex items-center gap-2 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            Join batch 41
                            <span className="font-mono text-[10px] text-ink-950/60">46 left</span>
                        </a>
                    </div>
                </div>
            </header>

            <div className="relative flex min-h-0 flex-1 flex-col">
                {padded ? (
                    <main data-ui-scroll-region className="min-h-0 flex-1 overflow-y-auto">
                        <div className="px-4 py-10 sm:px-5">{children}</div>

                        <footer className="mt-10 border-t border-white/5 bg-ink-900/60 px-4 py-8 sm:px-5">
                            <div className="mx-auto max-w-5xl">
                                <div className="grid grid-cols-2 gap-6 sm:grid-cols-4">
                                    <div>
                                        <p className="text-sm font-medium tracking-tight text-cream">Nomad Supply</p>
                                        <p className="mt-2 text-[11px]/5 text-zinc-500">
                                            Four people, one bench, 200 metres off Dihua Street. We make one grinder and the parts
                                            that keep it going.
                                        </p>
                                    </div>

                                    {COLUMNS.map((column) => (
                                        <div key={column.heading}>
                                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{column.heading}</p>
                                            <ul className="mt-2.5 flex flex-col gap-1.5">
                                                {column.items.map((item) => (
                                                    <li key={item}>
                                                        <a href="#" className="text-[12px] text-zinc-500 transition-colors duration-150 hover:text-jade-300">{item}</a>
                                                    </li>
                                                ))}
                                            </ul>
                                        </div>
                                    ))}
                                </div>

                                <div className="mt-8 flex flex-wrap items-center gap-x-4 gap-y-1.5 border-t border-white/5 pt-4">
                                    <span className="font-mono text-[10px] text-zinc-700">nomadsupply.tw</span>
                                    <span className="text-[11px] text-zinc-600">Every number on this site is measured, including the ones that do us no favours.</span>
                                    <span className="ml-auto font-mono text-[10px] text-zinc-700">updated 18 Aug 2026</span>
                                </div>
                            </div>
                        </footer>
                    </main>
                ) : (
                    <main className="flex min-h-0 flex-1 flex-col overflow-hidden">{children}</main>
                )}

                {padded && <UiScrollTop anchor="container" variant="progress" threshold={300} />}
            </div>
        </div>
    );
}
