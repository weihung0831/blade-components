import { KanbanAssignee } from './Assignee';

const LINKS = [
    { label: 'Board', screen: 'board' },
    { label: 'Backlog', screen: 'backlog' },
    { label: 'Workload', screen: 'workload' },
];

const CREW = ['Mei Tsai', 'Idris Bahar', 'Lena Kohler', 'Piotr Adamek'];

export function KanbanShell({ active = 'Board', padded = true, batch = 'Batch 41 · week 33', toolbar = null, children }) {
    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/kanban/screens/board" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M4.5 5.5h4v13h-4zM10 5.5h4v8h-4zM15.5 5.5h4v11h-4z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Shop floor</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">NOMAD Supply · Taichung</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/kanban/screens/${link.screen}`}
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
                        <span className="hidden rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 lg:block">{batch}</span>

                        <div className="hidden items-center -space-x-1.5 sm:flex">
                            {CREW.map((person) => <KanbanAssignee key={person} name={person} size="sm" className="ring-2 ring-ink-950" />)}
                        </div>

                        <button
                            type="button"
                            className="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round"/></svg>
                            New job
                        </button>
                    </div>
                </div>

                {toolbar && <div className="border-t border-white/5 px-4 py-2.5 sm:px-5">{toolbar}</div>}
            </header>

            {padded ? (
                <main className="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">{children}</main>
            ) : (
                <main className="flex min-h-0 flex-1 flex-col">{children}</main>
            )}
        </div>
    );
}
