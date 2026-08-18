import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const LINKS = [
    { label: 'Nothing here', screen: 'missing', code: '404' },
    { label: 'Our fault', screen: 'broken', code: '500' },
    { label: 'Not your seat', screen: 'blocked', code: '403' },
    { label: 'Off on purpose', screen: 'down', code: '503' },
];

const STATES = {
    ok: { dot: 'bg-jade-500', text: 'text-zinc-500', label: 'nine services, all normal' },
    degraded: { dot: 'bg-amber-400', text: 'text-amber-300', label: 'two of nine are slow' },
    down: { dot: 'bg-red-400', text: 'text-red-400', label: 'checkout is down, 6 minutes so far' },
    off: { dot: 'bg-white/30', text: 'text-zinc-500', label: 'off until 04:00, on purpose' },
};

export function ErrorPagesShell({ active = 'Nothing here', state = 'ok', reference = 'req_9f4c21a8', padded = true, toolbar = null, children }) {
    const pill = STATES[state] ?? STATES.ok;

    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="shrink-0 border-b border-white/5 bg-ink-950">
                <div className="flex h-14 items-center gap-5 px-4 sm:px-5">
                    <a href="/templates/error-pages/screens/missing" target="_top" className="flex shrink-0 items-center gap-2.5">
                        <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M4 18 12 5l8 13" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                            <path d="M12 10v4" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                            <circle cx="12" cy="16.4" r=".9" fill="currentColor"/>
                        </svg>
                        <span className="flex flex-col leading-none">
                            <span className="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                            <span className="mt-0.5 font-mono text-[10px] text-zinc-600">something did not work</span>
                        </span>
                    </a>

                    <nav className="hidden items-center gap-1 md:flex">
                        {LINKS.map((link) => (
                            <a
                                key={link.label}
                                href={`/templates/error-pages/screens/${link.screen}`}
                                target="_top"
                                aria-current={link.label === active ? 'page' : undefined}
                                className={`flex items-baseline gap-1.5 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'}`}
                            >
                                <span className="font-mono text-[10px] text-zinc-600">{link.code}</span>
                                {link.label}
                            </a>
                        ))}
                    </nav>

                    <div className="ml-auto flex shrink-0 items-center gap-3">
                        <a
                            href="/templates/error-pages/screens/down"
                            target="_top"
                            className={`hidden items-center gap-1.5 rounded-lg px-2 py-1 font-mono text-[11px] transition-colors duration-150 hover:bg-white/5 lg:flex ${pill.text}`}
                        >
                            <span className={`size-1.5 rounded-full ${pill.dot}`}></span>
                            {pill.label}
                        </a>

                        <a
                            href="/templates/error-pages/screens/missing"
                            target="_top"
                            className="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >Back to the shop</a>
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
                <div className="mx-auto flex max-w-3xl flex-wrap items-center gap-x-4 gap-y-1.5">
                    <span className="font-mono text-[10px] text-zinc-700">{reference}</span>
                    <span className="text-[11px] text-zinc-600">Quote that at the desk and they can read the same thing we can.</span>

                    <span className="ml-auto flex items-center gap-3">
                        <a href="/templates/error-pages/screens/down" target="_top" className="font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-jade-300">what is broken right now</a>
                        <a href="/templates/error-pages/screens/broken" target="_top" className="font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-jade-300">tell a human</a>
                    </span>
                </div>
            </footer>
        </div>
    );
}
