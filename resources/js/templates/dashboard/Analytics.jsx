import { useState } from 'react';
import { DashboardShell } from './Shell';
import { DashboardStat } from './Stat';
import { UiCard } from '../../components/ui/data-display/Card';
import { UiSelect } from '../../components/ui/forms/Select';
import { UiButton } from '../../components/ui/actions/Button';
import { UiSeparator } from '../../components/ui/data-display/Separator';
import { UiTable } from '../../components/ui/data-display/Table';
import { UiMeterGroup } from '../../components/ui/data-display/MeterGroup';
import { UiAnimatedBarChart } from '../../components/ui/effects/AnimatedBarChart';
import { UiAnimatedColumnChart } from '../../components/ui/effects/AnimatedColumnChart';

const crumbs = [{ label: 'wharf', href: '#' }, { label: 'Analytics' }];

const sessions = [
    { label: '01', value: 24 },
    { label: '03', value: 27 },
    { label: '05', value: 31 },
    { label: '07', value: 29 },
    { label: '09', value: 34 },
    { label: '11', value: 38 },
    { label: '13', value: 36 },
    { label: '15', value: 41 },
    { label: '17', value: 44 },
    { label: '19', value: 40 },
    { label: '21', value: 47 },
    { label: '23', value: 52 },
    { label: '25', value: 49 },
    { label: '27', value: 58, highlight: true },
];

const sources = [
    { label: 'Direct', value: 148, highlight: true },
    { label: 'Search', value: 112 },
    { label: 'Social', value: 74 },
    { label: 'Email', value: 51 },
    { label: 'Affiliate', value: 27 },
];

const devices = [
    { label: 'Mobile', value: 63, color: 'jade' },
    { label: 'Desktop', value: 31, color: 'mint' },
    { label: 'Tablet', value: 6, color: 'zinc' },
];

const funnel = [
    { step: 'Storefront visit', count: '412,800', percent: 100, drop: null },
    { step: 'Product viewed', count: '246,100', percent: 60, drop: '−40.4%' },
    { step: 'Added to cart', count: '88,400', percent: 21, drop: '−64.1%' },
    { step: 'Checkout started', count: '31,900', percent: 8, drop: '−63.9%' },
    { step: 'Order paid', count: '14,035', percent: 3, drop: '−56.0%' },
];

const regions = [
    { code: 'TW', name: 'Taiwan', share: '38.2%' },
    { code: 'JP', name: 'Japan', share: '21.7%' },
    { code: 'SG', name: 'Singapore', share: '14.9%' },
    { code: 'US', name: 'United States', share: '12.4%' },
    { code: 'AU', name: 'Australia', share: '6.1%' },
];

const columns = [
    { key: 'store', label: 'Storefront' },
    { key: 'sessions', label: 'Sessions', align: 'right' },
    { key: 'conversion', label: 'CVR', align: 'right' },
    { key: 'revenue', label: 'Revenue', align: 'right' },
    { key: 'trend', label: 'Trend', align: 'right' },
];

const rows = [
    { store: 'northbeam.shop', sessions: '84,120', conversion: '4.8%', revenue: '$62,410', trend: '+18.2%' },
    { store: 'kettleandco.store', sessions: '61,904', conversion: '3.9%', revenue: '$41,880', trend: '+9.4%' },
    { store: 'verdant.studio', sessions: '48,331', conversion: '3.1%', revenue: '$28,205', trend: '+4.1%' },
    { store: 'osprey.outfitters', sessions: '37,712', conversion: '2.6%', revenue: '$19,640', trend: '−2.8%' },
    { store: 'palefire.co', sessions: '29,455', conversion: '2.2%', revenue: '$12,915', trend: '−6.5%' },
];

export function Analytics() {
    const [scope, setScope] = useState('All storefronts');
    const [range, setRange] = useState('Last 28 days');

    return (
        <DashboardShell
            active="Analytics"
            title="Analytics"
            crumbs={crumbs}
            actions={
                <>
                    <UiSelect options={['All storefronts', 'Scale plan only', 'Trials']} value={scope} onChange={setScope} size="sm" className="w-44" />
                    <UiSelect options={['Last 28 days', 'Last 7 days', 'This quarter']} value={range} onChange={setRange} size="sm" className="w-40" />
                    <UiButton variant="secondary" size="sm">Share report</UiButton>
                </>
            }
        >
            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <DashboardStat label="Sessions" value={412800} delta="14.9%" trend="up" hint="vs prior 28 days" />
                <DashboardStat label="Product views" value={1284900} delta="11.2%" trend="up" hint="across 1,284 stores" />
                <DashboardStat label="Conversion" value={3.4} decimals={1} suffix="%" delta="0.3pt" trend="up" hint="paid orders / sessions" />
                <DashboardStat label="Avg order value" value={86.4} decimals={2} prefix="$" delta="1.9%" trend="down" hint="promo-heavy month" />
            </div>

            <div className="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <UiCard
                    className="lg:col-span-2"
                    header={
                        <div className="flex items-baseline justify-between">
                            <div>
                                <h2 className="text-sm font-medium text-cream">Sessions</h2>
                                <p className="mt-0.5 text-xs text-zinc-500">Thousands per day, August</p>
                            </div>
                            <div className="flex items-center gap-3 font-mono text-[11px] text-zinc-600">
                                <span className="flex items-center gap-1.5"><span className="size-2 rounded-full bg-jade-500"></span>peak 58k</span>
                                <span className="flex items-center gap-1.5"><span className="size-2 rounded-full bg-jade-500/30"></span>median 39k</span>
                            </div>
                        </div>
                    }
                >
                    <UiAnimatedColumnChart items={sessions} height="h-56" values={false} />
                </UiCard>

                <UiCard
                    header={
                        <div className="flex items-baseline justify-between">
                            <h2 className="text-sm font-medium text-cream">Traffic sources</h2>
                            <span className="font-mono text-[11px] text-zinc-600">thousands</span>
                        </div>
                    }
                >
                    <UiAnimatedBarChart items={sources} max={185} labelWidth="w-14" className="pb-1" />

                    <UiSeparator className="my-4" />

                    <UiMeterGroup animate segments={devices} label="Devices" total="412.8k sessions" />
                </UiCard>
            </div>

            <div className="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <UiCard
                    className="lg:col-span-2"
                    header={
                        <div className="flex items-baseline justify-between">
                            <h2 className="text-sm font-medium text-cream">Checkout funnel</h2>
                            <span className="font-mono text-[11px] text-zinc-600">3.4% end to end</span>
                        </div>
                    }
                >
                    <ol className="flex flex-col gap-3">
                        {funnel.map((stage, index) => (
                            <li key={stage.step}>
                                <div className="flex items-baseline justify-between gap-4">
                                    <span className="text-[13px] text-zinc-300">{stage.step}</span>
                                    <span className="flex items-baseline gap-3 font-mono text-[11px]">
                                        <span className="text-cream">{stage.count}</span>
                                        {stage.drop
                                            ? <span className="w-16 text-right text-red-400">{stage.drop}</span>
                                            : <span className="w-16 text-right text-zinc-600">entry</span>}
                                    </span>
                                </div>
                                <div className="mt-1.5 h-2 overflow-hidden rounded-full bg-ink-950">
                                    <span className="block h-full rounded-full bg-jade-500 transition-[width] duration-700 ease-snap"
                                        style={{ width: `${stage.percent}%`, opacity: 1 - index * 0.14 }}></span>
                                </div>
                            </li>
                        ))}
                    </ol>
                </UiCard>

                <UiCard header={<h2 className="text-sm font-medium text-cream">Top regions</h2>}>
                    <ul className="flex flex-col gap-3">
                        {regions.map((region) => (
                            <li key={region.code} className="flex items-center gap-3">
                                <span className="grid size-7 shrink-0 place-items-center rounded-md bg-ink-950 font-mono text-[10px] text-zinc-400">{region.code}</span>
                                <span className="min-w-0 flex-1 truncate text-[13px] text-zinc-300">{region.name}</span>
                                <span className="shrink-0 font-mono text-[11px] text-zinc-500">{region.share}</span>
                            </li>
                        ))}
                    </ul>
                </UiCard>
            </div>

            <section>
                <div className="mb-3 flex items-baseline justify-between">
                    <h2 className="text-sm font-medium text-cream">Top storefronts</h2>
                    <a href="#" className="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">View all 1,284</a>
                </div>

                <UiTable columns={columns} rows={rows} hover striped />
            </section>
        </DashboardShell>
    );
}
