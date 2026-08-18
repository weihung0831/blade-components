import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const LINKS = [
    { label: 'The policy', screen: 'policy' },
    { label: 'Send it back', screen: 'send' },
    { label: 'Where yours is', screen: 'progress' },
    { label: 'The ledger', screen: 'ledger' },
];

const WINDOWS = [
    { key: 'mind', title: 'Changed your mind', span: '30 days' },
    { key: 'broken', title: 'Arrived broken', span: '30 days' },
    { key: 'fault', title: 'Stopped working', span: '2 years' },
    { key: 'parts', title: 'Parts on the shelf', span: '10 years' },
];

const NEVER = [
    'Charge a restocking fee',
    'Ask for the box it came in',
    'Refuse a return for a missing receipt',
    'Send you a credit note instead of money',
];

export function RefundShell({ active = 'The policy', rail = true, padded = true, toolbar = null, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/refund/screens/policy" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M3.5 8.5 12 5l8.5 3.5v7L12 19l-8.5-3.5z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M13.5 12H9m0 0 1.8-1.8M9 12l1.8 1.8" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">nomadsupply.cc/refunds</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/refund/screens/${link.screen}`}
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
                            href="/templates/refund/screens/ledger"
                            target="_top"
                            className="hidden items-center gap-1.5 rounded-lg border border-white/10 px-2 py-1 font-mono text-[11px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream lg:flex"
                        >
                            <span className="size-1.5 rounded-full bg-jade-500"></span>
                            6 days to the bank, median
                        </a>

                        <a
                            href="/templates/refund/screens/send"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Start a return</a>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="relative flex min-h-0 flex-1">
                {rail && (
                    <aside className="hidden w-56 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                        <div>
                            <p className="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">How long you have</p>
                            <nav className="mt-2 px-2">
                                {WINDOWS.map((entry) => (
                                    <a
                                        key={entry.key}
                                        href={`/templates/refund/screens/policy#window-${entry.key}`}
                                        target="_top"
                                        className="flex items-baseline gap-2 rounded-lg px-2 py-1.5 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        <span className="truncate">{entry.title}</span>
                                        <span className="ml-auto font-mono text-[10px] text-zinc-700">{entry.span}</span>
                                    </a>
                                ))}
                            </nav>

                            <p className="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we do not do</p>
                            <ul className="mt-2 space-y-1.5 px-4">
                                {NEVER.map((line) => (
                                    <li key={line} className="flex gap-2 text-[11px]/5 text-zinc-600">
                                        <span className="mt-1.5 h-px w-2 shrink-0 bg-zinc-700"></span>
                                        <span>{line}</span>
                                    </li>
                                ))}
                            </ul>
                        </div>

                        <div className="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                            <p className="font-mono text-[10px] text-zinc-600">Wei opens every box</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">The inspection is a person at a bench with the machine in bits, not a warehouse scanning a label.</p>
                            <a
                                href="/templates/contact/screens/desk"
                                target="_top"
                                className="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >Ask before you send</a>
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
