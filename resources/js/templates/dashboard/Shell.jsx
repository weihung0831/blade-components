import { UiSidebar } from '../../components/ui/Sidebar';
import { UiBreadcrumb } from '../../components/ui/Breadcrumb';
import { UiSearch } from '../../components/ui/Search';
import { UiSeparator } from '../../components/ui/Separator';
import { UiAvatar } from '../../components/ui/Avatar';
import { UiProgress } from '../../components/ui/Progress';
import { UiButton } from '../../components/ui/Button';

const nav = [
    { label: 'Platform', items: [
        { label: 'Overview', icon: 'grid', href: '#' },
        { label: 'Analytics', icon: 'chart', href: '#' },
        { label: 'Merchants', icon: 'users', href: '#' },
        { label: 'Deploys', icon: 'deploy', href: '#' },
        { label: 'Orders', icon: 'billing', href: '#' },
    ] },
    { label: 'Account', items: [
        { label: 'Alerts', icon: 'bell', href: '#', badge: 3 },
        { label: 'Audit log', icon: 'logs', href: '#' },
        { label: 'Settings', icon: 'settings', href: '#' },
    ] },
];

export function DashboardShell({ active = 'Overview', title = 'Overview', crumbs = [], actions = null, children }) {
    const sections = nav.map((section) => ({
        label: section.label,
        items: section.items.map((item) => ({ ...item, active: item.label === active })),
    }));

    return (
        <div className="flex min-h-[42rem] w-full min-w-[64rem] gap-4 bg-ink-950 p-4">
            <UiSidebar
                sections={sections}
                className="sticky top-4 h-fit shrink-0"
                brand={
                    <>
                        <span className="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                        <span className="text-sm font-medium text-cream">wharf</span>
                        <span className="ml-auto rounded-full border border-white/10 px-1.5 font-mono text-[10px] text-zinc-500">ap-1</span>
                    </>
                }
                footer={
                    <>
                        <div className="rounded-lg bg-ink-950 p-2.5">
                            <div className="flex items-baseline justify-between">
                                <span className="text-xs font-medium text-cream">Scale plan</span>
                                <span className="font-mono text-[10px] text-zinc-500">312 / 400</span>
                            </div>
                            <UiProgress value={78} size="sm" className="mt-2" />
                            <p className="mt-2 text-[11px]/4 text-zinc-500">Seats renew 1 Sep</p>
                            <UiButton variant="secondary" size="sm" className="mt-2.5 w-full">Upgrade</UiButton>
                        </div>
                        <div className="mt-2 flex items-center gap-2.5 px-1.5 py-1">
                            <UiAvatar initials="WH" size="sm" status="online" />
                            <div className="min-w-0">
                                <p className="truncate text-xs text-zinc-300">Wei Hung</p>
                                <p className="truncate font-mono text-[10px] text-zinc-600">Owner</p>
                            </div>
                        </div>
                    </>
                }
            />

            <div className="flex min-w-0 flex-1 flex-col gap-4">
                <header className="flex h-12 shrink-0 items-center gap-4 rounded-xl border border-white/10 bg-ink-800 px-3">
                    <UiBreadcrumb items={crumbs} separator="slash" className="min-w-0 shrink" />

                    <UiSearch size="sm" placeholder="Search merchants, deploys…" shortcut="⌘ K" className="ml-auto max-w-64" />

                    <button type="button" aria-label="Alerts" className="relative grid size-8 shrink-0 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                        <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                        <span className="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
                    </button>

                    <UiSeparator vertical className="my-2.5" />

                    <UiAvatar initials="WH" size="sm" color="jade" />
                </header>

                <main className="flex flex-col gap-4">
                    <div className="flex flex-wrap items-end justify-between gap-3">
                        <h1 className="text-xl font-semibold tracking-tight text-cream">{title}</h1>
                        {actions && <div className="flex items-center gap-2">{actions}</div>}
                    </div>

                    {children}
                </main>
            </div>
        </div>
    );
}
