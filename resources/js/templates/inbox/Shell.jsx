import { InboxAvatar } from './Avatar';

const LINKS = [
    { label: 'Inbox', screen: 'threads' },
    { label: 'Compose', screen: 'compose' },
    { label: 'Search', screen: 'search' },
];

const FOLDERS = [
    { label: 'Unassigned', count: 3, urgent: true },
    { label: 'Mine', count: 3, urgent: false },
    { label: 'Waiting on them', count: 1, urgent: false },
    { label: 'Snoozed', count: 1, urgent: false },
];

const LANES = [
    { label: 'Warranty', count: 2 },
    { label: 'Dealers', count: 3 },
    { label: 'Orders', count: 2 },
    { label: 'Parts', count: 1 },
];

const DESK = ['Hana Okabe', 'Lena Kohler', 'Idris Bahar'];

export function InboxShell({
    active = 'Inbox',
    folder = 'Unassigned',
    rail = true,
    padded = true,
    promise = '4h first reply, business hours GMT+8',
    toolbar = null,
    children,
}) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/inbox/screens/threads" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M3.5 8.5 12 14l8.5-5.5M3.5 6.5h17v11h-17z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Front desk</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">support@nomadsupply.cc</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/inbox/screens/${link.screen}`}
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
                        <span className="hidden items-center gap-1.5 rounded-lg border border-red-400/40 bg-red-500/8 px-2.5 py-1.5 font-mono text-[11px] text-red-300 lg:flex">
                            <span className="size-1.5 rounded-full bg-red-400"></span>
                            2 past the promise
                        </span>

                        <div className="hidden items-center -space-x-1.5 sm:flex">
                            {DESK.map((person) => <InboxAvatar key={person} name={person} size="sm" className="ring-2 ring-ink-950" />)}
                        </div>

                        <button
                            type="button"
                            className="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round"/></svg>
                            Write
                        </button>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            <div className="flex min-h-0 flex-1">
                {rail && (
                    <aside className="hidden w-52 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                        <div>
                            <p className="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Queues</p>
                            <nav className="mt-2 px-2">
                                {FOLDERS.map((entry) => (
                                    <a
                                        key={entry.label}
                                        href="/templates/inbox/screens/threads"
                                        target="_top"
                                        aria-current={entry.label === folder ? 'page' : undefined}
                                        className={`flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${
                                            entry.label === folder ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'
                                        }`}
                                    >
                                        <span className="truncate">{entry.label}</span>
                                        <span className={`ml-auto shrink-0 font-mono text-[10px] ${entry.urgent ? 'text-red-300' : 'text-zinc-600'}`}>{entry.count}</span>
                                    </a>
                                ))}
                            </nav>

                            <p className="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Lanes</p>
                            <nav className="mt-2 px-2">
                                {LANES.map((lane) => (
                                    <a
                                        key={lane.label}
                                        href="/templates/inbox/screens/search"
                                        target="_top"
                                        className="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        <span className="truncate">{lane.label}</span>
                                        <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{lane.count}</span>
                                    </a>
                                ))}
                            </nav>
                        </div>

                        <div className="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                            <p className="font-mono text-[10px] text-zinc-600">Reply promise</p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">{promise}</p>
                            <div className="mt-2.5 flex items-center gap-2">
                                <span className="block h-0.5 flex-1 overflow-hidden rounded-full bg-white/10">
                                    <span className="block h-full w-[82%] rounded-full bg-jade-500/70"></span>
                                </span>
                                <span className="font-mono text-[10px] text-zinc-500">82%</span>
                            </div>
                            <p className="mt-1.5 font-mono text-[10px] text-zinc-700">kept, last 30 days</p>
                        </div>
                    </aside>
                )}

                {padded ? (
                    <main className="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{children}</main>
                ) : (
                    <main className="flex min-h-0 flex-1 flex-col overflow-hidden">{children}</main>
                )}
            </div>
        </div>
    );
}
