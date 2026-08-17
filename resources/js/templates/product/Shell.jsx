import { useState } from 'react';
import { UiButton } from '../../components/ui/actions/Button';
import { UiDropdown } from '../../components/ui/overlay/Dropdown';
import { UiScrollTop } from '../../components/ui/navigation/ScrollTop';
import { ProductFinishPicker } from './FinishPicker';

const tabs = [
    { label: 'Overview', screen: 'overview' },
    { label: 'Specs', screen: 'specs' },
    { label: 'Reviews', screen: 'reviews' },
    { label: 'Configure', screen: 'configure' },
];

const nav = ['Brewers', 'Filters', 'Journal'];

const columns = [
    { label: 'Shop', items: ['Grinders', 'Brewers', 'Filters', 'Spare parts'] },
    { label: 'Support', items: ['Shipping', 'Returns', 'Warranty claim', 'Service log'] },
    { label: 'Company', items: ['Workshop', 'Stockists', 'Journal', 'Contact'] },
];

export function ProductShell({ active = 'Overview', finish: finishProp = null, onFinishChange = null, children }) {
    const [internal, setInternal] = useState('graphite');
    const finish = finishProp ?? internal;

    const setFinish = (next) => {
        setInternal(next);
        onFinishChange?.(next);
    };

    return (
        <div className="group/shell flex h-full w-full flex-col overflow-hidden bg-ink-950" data-finish={finish}>
            <div className="relative flex min-h-0 flex-1">
                <div data-ui-scroll-region className="flex min-w-0 flex-1 flex-col overflow-y-auto">
                    <div className="flex h-8 shrink-0 items-center justify-center gap-2 bg-jade-500/10 px-5 text-center font-mono text-[10px] text-jade-300">
                        <span>Free express shipping over $600</span>
                        <span className="text-jade-500/40">·</span>
                        <span className="hidden sm:inline">ships from the Taichung workshop within one business day</span>
                    </div>

                    <header className="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-4 border-b border-white/5 bg-ink-950/85 px-5 backdrop-blur sm:px-8">
                        <a href="/templates/product/screens/overview" target="_top" className="flex shrink-0 items-center gap-2.5">
                            <svg className="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                                <path d="M7 4h10l-1.5 5.5a4.5 4.5 0 0 1-7 0L7 4Z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                                <path d="M12 13v7M8.5 20h7" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                            </svg>
                            <span className="text-sm font-medium tracking-tight text-cream">NOMAD Supply</span>
                        </a>

                        <nav className="hidden items-center gap-1 md:flex">
                            <span className="rounded-md bg-jade-500/12 px-2.5 py-1 text-[13px] text-jade-300">Grinders</span>
                            {nav.map((item) => (
                                <a key={item} href="#" className="rounded-md px-2.5 py-1 text-[13px] text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">{item}</a>
                            ))}
                        </nav>

                        <div className="ml-auto flex shrink-0 items-center gap-2">
                            <button type="button" aria-label="Search"
                                className="grid size-9 place-items-center rounded-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <svg className="size-4" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" strokeWidth="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/></svg>
                            </button>

                            <a href="#" aria-label="Cart, 2 items"
                                className="relative grid size-9 place-items-center rounded-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <svg className="size-4" viewBox="0 0 16 16" fill="none"><path d="M2.5 3h1.8l1.3 7.5h6.6l1.3-5.5H5" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round" strokeLinejoin="round"/><circle cx="6.5" cy="13" r="1" fill="currentColor"/><circle cx="11.5" cy="13" r="1" fill="currentColor"/></svg>
                                <span className="absolute top-1 right-1 grid size-4 place-items-center rounded-full bg-jade-500 font-mono text-[9px] font-bold text-ink-950">2</span>
                            </a>

                            <UiDropdown variant="ghost" align="right" className="md:hidden [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]"
                                menu={
                                    <>
                                        <a href="/templates/product/screens/overview" target="_top" className="text-jade-300!">Grinders</a>
                                        {nav.map((item) => <a key={item} href="#">{item}</a>)}
                                        <hr />
                                        <a href="#">Cart · 2 items</a>
                                    </>
                                }
                            >
                                Menu
                            </UiDropdown>
                        </div>
                    </header>

                    <div className="sticky top-14 z-20 border-b border-white/5 bg-ink-950/85 backdrop-blur">
                        <div className="mx-auto flex w-full max-w-6xl flex-wrap items-center gap-x-5 gap-y-2 px-5 py-2.5 sm:px-8">
                            <nav className="flex flex-wrap items-center gap-1 text-sm">
                                {tabs.map((tab) => (
                                    <a
                                        key={tab.label}
                                        href={`/templates/product/screens/${tab.screen}`}
                                        target="_top"
                                        aria-current={tab.label === active ? 'page' : undefined}
                                        className={`rounded-lg px-3 py-1.5 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${tab.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'}`}
                                    >
                                        {tab.label}
                                    </a>
                                ))}
                            </nav>

                            <div className="ml-auto flex items-center gap-4">
                                <ProductFinishPicker value={finish} onChange={setFinish} className="hidden sm:flex" />

                                <span className="hidden font-mono text-[13px] text-cream lg:block">{finish === 'jade' ? '$1,300' : '$1,180'}</span>

                                <UiButton size="sm" href="/templates/product/screens/configure" target="_top">Add to cart</UiButton>
                            </div>
                        </div>
                    </div>

                    <main className="mx-auto w-full max-w-6xl grow px-5 py-8 sm:px-8">{children}</main>

                    <footer className="border-t border-white/5 bg-ink-900/50">
                        <div className="mx-auto w-full max-w-6xl px-5 py-10 sm:px-8">
                            <div className="flex flex-wrap justify-between gap-x-10 gap-y-8">
                                <div className="max-w-xs">
                                    <div className="flex items-center gap-2">
                                        <svg className="size-5 text-jade-400" viewBox="0 0 24 24" fill="none">
                                            <path d="M7 4h10l-1.5 5.5a4.5 4.5 0 0 1-7 0L7 4Z" stroke="currentColor" strokeWidth="1.4" strokeLinejoin="round"/>
                                            <path d="M12 13v7M8.5 20h7" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/>
                                        </svg>
                                        <span className="text-[13px] font-medium text-cream">NOMAD Supply</span>
                                    </div>
                                    <p className="mt-3 text-[13px]/6 text-zinc-600">Grinders and brewers built in Taichung since 2016. Every unit is dialled in by hand before it ships.</p>
                                </div>

                                {columns.map((column) => (
                                    <div key={column.label}>
                                        <p className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{column.label}</p>
                                        <ul className="mt-3 flex flex-col gap-2">
                                            {column.items.map((item) => (
                                                <li key={item}><a href="#" className="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">{item}</a></li>
                                            ))}
                                        </ul>
                                    </div>
                                ))}
                            </div>

                            <div className="mt-10 flex flex-wrap items-center gap-x-4 gap-y-2 border-t border-white/5 pt-5 font-mono text-[10px] text-zinc-600">
                                <span>© 2026 NOMAD Supply Co.</span>
                                <span className="inline-flex items-center gap-1.5">
                                    <span className="size-1.5 rounded-full bg-jade-400"></span>
                                    30-day returns, shipping paid both ways
                                </span>
                                <a href="/templates/pricing/screens/plans" target="_top" className="ml-auto transition-colors duration-150 hover:text-jade-400">storefront running on wharf · ap-1</a>
                            </div>
                        </div>
                    </footer>
                </div>

                <UiScrollTop anchor="container" variant="progress" threshold={300} />
            </div>
        </div>
    );
}
