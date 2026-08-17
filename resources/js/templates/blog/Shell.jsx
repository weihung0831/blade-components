import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const links = [
    { label: 'Latest', screen: 'latest' },
    { label: 'Archive', screen: 'archive' },
    { label: 'Author', screen: 'author' },
];

export function BlogShell({ active = 'Latest', progress = null, children }) {
    return (
        <div className="group/shell flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <div className="relative flex min-h-0 flex-1">
                <div data-blog-scroll data-ui-scroll-region className="flex min-w-0 flex-1 flex-col overflow-y-auto">
                    <header className="sticky top-0 z-30 shrink-0 border-b border-white/5 bg-ink-950/85 backdrop-blur">
                        <div className="mx-auto flex h-14 w-full max-w-5xl items-center gap-5 px-5 sm:px-8">
                            <a href="/templates/blog/screens/latest" target="_top" className="flex shrink-0 items-center gap-2.5">
                                <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 5.5h9a2 2 0 0 1 2 2v11H7a2 2 0 0 1-2-2v-11Z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                                    <path d="M16 9.5h3v7a2 2 0 0 1-2 2M8 9h5M8 12h5M8 15h3" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                                </svg>
                                <span className="flex flex-col leading-none">
                                    <span className="text-sm font-medium tracking-tight text-cream">Bench Notes</span>
                                    <span className="mt-0.5 font-mono text-[10px] text-zinc-600">by NOMAD Supply</span>
                                </span>
                            </a>

                            <nav className="hidden items-center gap-1 sm:flex">
                                {links.map((link) => (
                                    <a
                                        key={link.label}
                                        href={`/templates/blog/screens/${link.screen}`}
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

                            <div className="ml-auto flex shrink-0 items-center gap-4">
                                <span className="hidden font-mono text-[10px] text-zinc-600 lg:block">no tracking, no popups</span>

                                <a
                                    href="/templates/blog/screens/author"
                                    target="_top"
                                    className="rounded-lg border border-white/10 px-3 py-1.5 text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                >
                                    Subscribe
                                </a>
                            </div>
                        </div>

                        {progress !== null && (
                            <div className="h-px w-full bg-white/5">
                                <span className="block h-px bg-jade-500 transition-[width] duration-100 ease-linear" style={{ width: `${progress}%` }}></span>
                            </div>
                        )}
                    </header>

                    <main className="mx-auto w-full max-w-5xl grow px-5 py-10 sm:px-8">{children}</main>

                    <footer className="border-t border-white/5 bg-ink-900/50">
                        <div className="mx-auto flex w-full max-w-5xl flex-wrap items-center gap-x-5 gap-y-3 px-5 py-6 font-mono text-[10px] text-zinc-600 sm:px-8">
                            <span>© 2026 NOMAD Supply Co. · written in the workshop, Taichung</span>
                            <a href="/templates/blog/screens/archive" target="_top" className="transition-colors duration-150 hover:text-cream">Archive</a>
                            <a href="#" className="transition-colors duration-150 hover:text-cream">RSS</a>
                            <a href="/templates/product/screens/overview" target="_top" className="transition-colors duration-150 hover:text-cream">The shop</a>
                            <span className="ml-auto">22 notes · one every other Tuesday</span>
                        </div>
                    </footer>
                </div>

                <UiScrollTop anchor="container" variant="progress" threshold={400} />
            </div>
        </div>
    );
}
