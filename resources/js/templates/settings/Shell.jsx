import { Fragment } from 'react';
import { UiSeparator } from '../../components/ui/Separator';
import { UiBreadcrumb } from '../../components/ui/Breadcrumb';
import { UiAvatar } from '../../components/ui/Avatar';
import { UiButton } from '../../components/ui/Button';
import { UiScrollTop } from '../../components/ui/ScrollTop';
import { UiDropdown } from '../../components/ui/Dropdown';

const nav = [
    { label: 'Personal', items: [
        { label: 'Profile', screen: 'profile' },
        { label: 'Notifications' },
        { label: 'Appearance' },
    ] },
    { label: 'Workspace', items: [
        { label: 'General' },
        { label: 'Team', screen: 'team', meta: '312' },
        { label: 'Billing', screen: 'billing' },
        { label: 'API keys', screen: 'api-keys' },
        { label: 'Audit log' },
        { label: 'Data region', meta: 'ap-1' },
    ] },
];

export function SettingsShell({ active = 'Profile', title = 'Profile', description = null, dirty = false, actions = null, children }) {
    const sections = nav.map((section) => ({
        label: section.label,
        items: section.items.map((item) => ({
            ...item,
            href: item.screen ? `/templates/settings/screens/${item.screen}` : '#',
            active: item.label === active,
        })),
    }));

    const crumbs = [{ label: 'wharf', href: '#' }, { label: 'Settings', href: '#' }, { label: title }];

    return (
        <div className="flex h-full w-full flex-col overflow-hidden bg-ink-950">
            <header className="flex h-14 shrink-0 items-center gap-3 border-b border-white/5 px-4 sm:gap-4 sm:px-6">
                <a href="/templates/dashboard/screens/overview" target="_top" className="inline-flex shrink-0 items-center gap-1.5 text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">
                    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    Console
                </a>

                <UiSeparator vertical className="my-3.5" />

                <UiBreadcrumb items={crumbs.slice(1)} separator="slash" className="min-w-0 shrink sm:hidden" />
                <UiBreadcrumb items={crumbs} separator="slash" className="hidden min-w-0 shrink sm:flex" />

                <div className="ml-auto flex shrink-0 items-center gap-3">
                    <span className="hidden items-center gap-2 rounded-full border border-white/10 py-1 pr-3 pl-1 md:inline-flex">
                        <UiAvatar initials="NB" size="sm" />
                        <span className="text-[13px] text-zinc-300">Northbeam Supply</span>
                        <span className="font-mono text-[10px] text-zinc-600">Scale</span>
                    </span>

                    <UiAvatar initials="WH" size="sm" color="jade" />
                </div>
            </header>

            <div className="flex min-h-0 flex-1">
                <nav className="hidden w-56 shrink-0 flex-col gap-0.5 overflow-y-auto border-r border-white/5 p-4 lg:flex">
                    {sections.map((section, index) => (
                        <div key={section.label} className="contents">
                            <p className={`px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase ${index > 0 ? 'pt-4' : ''}`}>{section.label}</p>

                            {section.items.map((item) => (
                                <a
                                    key={item.label}
                                    href={item.href}
                                    target={item.screen ? '_top' : undefined}
                                    aria-current={item.active ? 'page' : undefined}
                                    className={`flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${item.active ? 'bg-jade-500/12 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'}`}
                                >
                                    <span className="truncate">{item.label}</span>
                                    {item.meta && <span className="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{item.meta}</span>}
                                </a>
                            ))}
                        </div>
                    ))}

                    <div className="mt-auto rounded-lg border border-white/8 p-3">
                        <p className="text-[11px]/5 text-zinc-500">Owners see every panel. Developers see the first four.</p>
                        <a href="#" className="mt-1.5 inline-block font-mono text-[10px] text-jade-400 hover:text-jade-300">Role reference</a>
                    </div>
                </nav>

                <div className="relative flex min-w-0 flex-1">
                    <div data-ui-scroll-region className="flex min-w-0 flex-1 flex-col overflow-y-auto">
                        <div className="shrink-0 border-b border-white/5 px-4 py-2.5 lg:hidden">
                            <UiDropdown
                                menu={sections.map((section, index) => (
                                    <Fragment key={section.label}>
                                        <p className={`px-3 pb-1 font-mono text-[10px] tracking-wider text-zinc-600 uppercase ${index > 0 ? 'pt-2' : ''}`}>{section.label}</p>

                                        {section.items.map((item) => (
                                            <a
                                                key={item.label}
                                                href={item.href}
                                                target={item.screen ? '_top' : undefined}
                                                className={item.active ? 'text-jade-300!' : undefined}
                                            >
                                                {item.label}
                                                {item.meta && <span className="ml-auto font-mono text-[10px] text-zinc-600">{item.meta}</span>}
                                            </a>
                                        ))}
                                    </Fragment>
                                ))}
                            >
                                {active}
                            </UiDropdown>
                        </div>

                        <div className="mx-auto w-full max-w-3xl shrink-0 px-5 py-8 sm:px-8">
                            <div className="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <h1 className="text-xl font-semibold tracking-tight text-cream">{title}</h1>
                                    {description && <p className="mt-1.5 max-w-lg text-[13px]/6 text-zinc-500">{description}</p>}
                                </div>
                                {actions && <div className="flex shrink-0 flex-wrap items-center gap-2">{actions}</div>}
                            </div>

                            <div className="mt-7 flex flex-col gap-5">{children}</div>

                            {dirty && (
                                <div className="sticky bottom-0 z-10 mt-6 flex flex-wrap items-center gap-x-3 gap-y-2 rounded-xl border border-jade-500/25 bg-ink-900/95 px-4 py-3 backdrop-blur">
                                    <span className="size-1.5 shrink-0 rounded-full bg-jade-400" />
                                    <p className="text-[13px] text-zinc-200">Unsaved changes</p>
                                    <p className="font-mono text-[11px] text-zinc-600">applies to every workspace you belong to</p>

                                    <div className="ml-auto flex shrink-0 items-center gap-2">
                                        <UiButton variant="ghost" size="sm">Reset</UiButton>
                                        <UiButton size="sm">Save changes</UiButton>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>

                    <UiScrollTop anchor="container" variant="progress" threshold={300} />
                </div>
            </div>
        </div>
    );
}
