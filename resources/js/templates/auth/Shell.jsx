import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';

const events = [
    { time: '02:41:08', name: 'auth.session.created', meta: 'ap-1' },
    { time: '02:40:55', name: 'sso.saml.asserted', meta: 'northbeam' },
    { time: '02:40:12', name: 'device.trusted', meta: '+1' },
    { time: '02:38:47', name: 'invite.accepted', meta: 'seat 312' },
];

const regions = [
    { label: 'ap-1', active: true },
    { label: 'sfo-2', active: false },
    { label: 'fra-1', active: false },
];

const slots = Array.from({ length: 30 }, (empty, index) => index);
const incidents = [17, 18];

export function AuthShell({ title = 'Sign in', subtitle = null, action = null, children }) {
    return (
        <div className="flex h-full w-full bg-ink-900">
            <aside className="dot-grid relative hidden w-[42%] max-w-md shrink-0 flex-col justify-between overflow-hidden border-r border-white/5 bg-ink-950 p-8 lg:flex">
                <span aria-hidden="true" className="pointer-events-none absolute -top-24 -left-20 size-72 rounded-full bg-jade-500/10 blur-3xl" />

                <div className="relative flex items-center gap-2">
                    <span className="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                    <span className="text-sm font-medium text-cream">wharf</span>
                    <span className="rounded-full border border-white/10 px-1.5 font-mono text-[10px] text-zinc-500">ap-1</span>
                </div>

                <div className="relative">
                    <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Platform access</p>
                    <h2 className="mt-3 text-2xl/8 font-semibold tracking-tight text-cream">1,284 storefronts run on wharf, across three regions.</h2>
                    <p className="mt-3 text-sm/6 text-zinc-500">Sessions are pinned to a region. Sign in and you land in the one nearest you — <span className="text-zinc-300">ap-1</span> today.</p>

                    <ul className="mt-8 flex flex-col gap-2 font-mono text-[11px]">
                        {events.map((event) => (
                            <li key={event.time} className="flex items-center gap-3 border-l border-white/8 pl-3">
                                <span className="text-zinc-600">{event.time}</span>
                                <span className="truncate text-zinc-400">{event.name}</span>
                                <span className="ml-auto shrink-0 text-jade-400">{event.meta}</span>
                            </li>
                        ))}
                    </ul>
                </div>

                <div className="relative">
                    <div className="flex items-baseline justify-between font-mono text-[10px] text-zinc-600">
                        <span>auth.wharf.app · 30d</span>
                        <span className="text-jade-400">99.98%</span>
                    </div>

                    <div className="mt-2 flex h-6 items-end gap-[3px]">
                        {slots.map((slot) => (
                            <span key={slot} className={`h-full flex-1 rounded-[1px] ${incidents.includes(slot) ? 'bg-amber-400' : 'bg-jade-500/35'}`} />
                        ))}
                    </div>

                    <div className="mt-4 flex items-center gap-1.5">
                        {regions.map((region) => (
                            <span
                                key={region.label}
                                className={`rounded-full border px-2 py-0.5 font-mono text-[10px] ${region.active ? 'border-jade-500/40 bg-jade-500/10 text-jade-300' : 'border-white/8 text-zinc-600'}`}
                            >
                                {region.label}
                            </span>
                        ))}
                        <span className="ml-auto font-mono text-[10px] text-zinc-600">SOC 2 · GDPR</span>
                    </div>
                </div>
            </aside>

            <div className="relative flex min-w-0 flex-1">
                <div data-ui-scroll-region className="flex min-w-0 flex-1 flex-col overflow-y-auto">
                    <header className="flex h-14 shrink-0 items-center gap-4 px-5 sm:px-8">
                        <div className="flex items-center gap-2 lg:hidden">
                            <span className="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                            <span className="text-sm font-medium text-cream">wharf</span>
                        </div>

                        {action && <div className="ml-auto flex shrink-0 items-center gap-1.5 text-[13px]">{action}</div>}
                    </header>

                    <main className="flex flex-1 items-center justify-center px-5 py-8 sm:px-8">
                        <div className="w-full max-w-sm">
                            <h1 className="text-xl font-semibold tracking-tight text-cream">{title}</h1>
                            {subtitle && <p className="mt-2 text-[13px]/6 text-zinc-500">{subtitle}</p>}

                            <div className="mt-7">{children}</div>
                        </div>
                    </main>

                    <footer className="flex h-12 shrink-0 items-center gap-4 border-t border-white/5 px-5 font-mono text-[10px] text-zinc-600 sm:px-8">
                        <span>© 2026 wharf</span>
                        <a href="#" className="transition-colors duration-150 hover:text-zinc-400">Terms</a>
                        <a href="#" className="transition-colors duration-150 hover:text-zinc-400">Privacy</a>
                        <span className="ml-auto flex items-center gap-1.5">
                            <span className="size-1.5 rounded-full bg-jade-400" />
                            All systems normal
                        </span>
                    </footer>
                </div>

                <UiScrollTop anchor="container" variant="progress" threshold={300} />
            </div>
        </div>
    );
}
