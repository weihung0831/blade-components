import { UiSidebar } from '../../components/ui/Sidebar';
import { UiBreadcrumb } from '../../components/ui/Breadcrumb';
import { UiSearch } from '../../components/ui/Search';
import { UiSeparator } from '../../components/ui/Separator';
import { UiAvatar } from '../../components/ui/Avatar';
import { UiProgress } from '../../components/ui/Progress';
import { UiButton } from '../../components/ui/Button';

const nav = [
    { label: 'Platform', items: [
        { label: 'Overview', icon: 'grid', screen: 'overview' },
        { label: 'Analytics', icon: 'chart', screen: 'analytics' },
        { label: 'Merchants', icon: 'users', screen: 'merchants' },
        { label: 'Deploys', icon: 'deploy', screen: 'deploys' },
        { label: 'Orders', icon: 'billing', screen: 'orders' },
    ] },
    { label: 'Account', items: [
        { label: 'Alerts', icon: 'bell', badge: 3 },
        { label: 'Audit log', icon: 'logs' },
        { label: 'Settings', icon: 'settings' },
    ] },
];

const link = (item) => (item.screen
    ? { href: `/templates/dashboard/screens/${item.screen}`, target: '_top' }
    : { href: '#' });

export function DashboardShell({ active = 'Overview', title = 'Overview', crumbs = [], actions = null, children }) {
    const sections = nav.map((section) => ({
        label: section.label,
        items: section.items.map((item) => ({ ...item, ...link(item), active: item.label === active })),
    }));

    return (
        <div className="flex h-full min-h-[42rem] w-full gap-3 overflow-hidden bg-ink-950 p-3 sm:gap-4 sm:p-4">
            <UiSidebar
                sections={sections}
                className="hidden shrink-0 lg:flex"
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
                            <UiAvatar initials="WH" size="sm" color="jade" />
                            <div className="min-w-0">
                                <p className="truncate text-xs text-zinc-300">Wei Hung</p>
                                <p className="truncate font-mono text-[10px] text-zinc-600">Owner</p>
                            </div>
                        </div>
                    </>
                }
            />

            <div className="flex min-w-0 flex-1 flex-col gap-3 overflow-y-auto sm:gap-4">
                <header className="flex h-12 shrink-0 items-center gap-3 rounded-xl border border-white/10 bg-ink-800 px-3 sm:gap-4">
                    <button type="button" aria-label="Open navigation" className="grid size-8 shrink-0 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream lg:hidden">
                        <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M2.5 4.5h11M2.5 8h11M2.5 11.5h11" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/></svg>
                    </button>

                    <UiBreadcrumb items={crumbs} separator="slash" className="min-w-0 shrink" />

                    <div className="ml-auto flex shrink-0 items-center gap-3 sm:gap-4">
                        <UiSearch size="sm" placeholder="Search merchants, deploys…" shortcut="⌘ K" className="hidden basis-64 md:flex" />

                        <button type="button" aria-label="Alerts" className="relative grid size-8 shrink-0 place-items-center rounded-lg text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                            <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/></svg>
                            <span className="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
                        </button>

                        <UiSeparator vertical className="my-2.5" />

                        <UiAvatar initials="WH" size="sm" color="jade" />
                    </div>
                </header>

                <main className="flex min-w-0 flex-col gap-3 sm:gap-4">
                    <div className="flex flex-wrap items-end justify-between gap-3">
                        <h1 className="text-xl font-semibold tracking-tight text-cream">{title}</h1>
                        {actions && <div className="flex flex-wrap items-center gap-2">{actions}</div>}
                    </div>

                    {children}
                </main>
            </div>
        </div>
    );
}
