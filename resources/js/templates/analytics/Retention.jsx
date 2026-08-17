import { useState } from 'react';
import { UiCard } from '../../components/ui/data-display/Card';
import { UiButton } from '../../components/ui/actions/Button';
import { UiSelect } from '../../components/ui/forms/Select';
import { AnalyticsShell } from './Shell';
import { AnalyticsMetric } from './Metric';
import { AnalyticsSeries } from './Series';
import { AnalyticsCohort } from './Cohort';
import { AnalyticsToken } from './Token';

const ranges = ['7d', '28d', '90d'];

const show = {
    '7d': 'hidden group-data-[range=7d]/shell:inline',
    '28d': 'hidden group-data-[range=28d]/shell:inline',
    '90d': 'hidden group-data-[range=90d]/shell:inline',
};

const block = {
    '7d': 'hidden group-data-[range=7d]/shell:block',
    '28d': 'hidden group-data-[range=28d]/shell:block',
    '90d': 'hidden group-data-[range=90d]/shell:block',
};

const grids = {
    '7d': {
        columns: ['d0', 'd1', 'd2', 'd3', 'd5', 'd7'],
        rows: [
            { label: 'Tue 11 Aug', size: '3,412', values: [100, 48, 39, 34, 29, 26] },
            { label: 'Wed 12 Aug', size: '3,684', values: [100, 51, 41, 36, 31, null] },
            { label: 'Thu 13 Aug', size: '3,270', values: [100, 49, 40, 35, null, null] },
            { label: 'Fri 14 Aug', size: '4,118', values: [100, 54, 44, 38, null, null] },
            { label: 'Sat 15 Aug', size: '2,806', values: [100, 44, 35, null, null, null] },
            { label: 'Sun 16 Aug', size: '2,461', values: [100, 42, null, null, null, null] },
            { label: 'Mon 17 Aug', size: '3,940', values: [100, null, null, null, null, null] },
        ],
    },
    '28d': {
        columns: ['d0', 'd1', 'd7', 'd14', 'd21', 'd28'],
        rows: [
            { label: 'w/c 21 Jul', size: '18,240', values: [100, 47, 33, 28, 25, 23] },
            { label: 'w/c 28 Jul', size: '19,106', values: [100, 49, 35, 30, 27, null] },
            { label: 'w/c 4 Aug', size: '20,884', values: [100, 52, 38, 32, null, null] },
            { label: 'w/c 11 Aug', size: '23,691', values: [100, 56, 41, null, null, null] },
            { label: 'w/c 18 Aug', size: '4,180', values: [100, null, null, null, null, null] },
        ],
    },
    '90d': {
        columns: ['d0', 'd1', 'd7', 'd30', 'd60', 'd90'],
        rows: [
            { label: 'May 2026', size: '58,920', values: [100, 41, 27, 19, 15, 13] },
            { label: 'Jun 2026', size: '66,410', values: [100, 44, 30, 22, 18, null] },
            { label: 'Jul 2026', size: '78,180', values: [100, 48, 34, 26, null, null] },
            { label: 'Aug 2026', size: '52,904', values: [100, 53, 39, null, null, null] },
        ],
    },
};

const curve = [
    {
        label: 'Scale',
        area: true,
        points: {
            '7d': [100, 54, 44, 38, 33, 29, 26],
            '28d': [100, 56, 44, 38, 34, 31, 29, 27],
            '90d': [100, 53, 39, 31, 26, 22, 19, 17, 15, 13],
        },
    },
    {
        label: 'Launch',
        muted: true,
        dashed: true,
        points: {
            '7d': [100, 41, 31, 25, 21, 18, 16],
            '28d': [100, 43, 30, 24, 20, 18, 16, 15],
            '90d': [100, 39, 26, 19, 15, 12, 10, 9, 8, 7],
        },
    },
];

const axis = {
    '7d': ['d0', 'd1', 'd2', 'd3', 'd4', 'd5', 'd7'],
    '28d': ['d0', 'd1', 'd3', 'd5', 'd7', 'd14', 'd21', 'd28'],
    '90d': ['d0', 'd1', 'd7', 'd14', 'd21', 'd30', 'd45', 'd60', 'd75', 'd90'],
};

const scale = {
    '7d': ['100%', '66%', '33%', '0'],
    '28d': ['100%', '66%', '33%', '0'],
    '90d': ['100%', '66%', '33%', '0'],
};

const grouping = {
    '7d': 'Daily cohorts, seven of them, still filling in.',
    '28d': 'Weekly cohorts. The newest row has one day of data.',
    '90d': 'Monthly cohorts. May is the only one with a full d90.',
};

const shape = {
    '7d': 'flattens around d5',
    '28d': 'flattens around d14',
    '90d': 'still sliding at d90',
};

const plans = [
    { label: 'Enterprise', value: 74, note: 'contracted, so the floor is high' },
    { label: 'Scale', value: 61, note: 'the cohort that pays the bills' },
    { label: 'Launch', value: 38, note: 'one storefront, one buyer' },
    { label: 'Trial', value: 12, note: 'most never place a second order' },
];

const barFor = (value) => (value >= 50 ? 'bg-jade-500' : value >= 20 ? 'bg-jade-500/50' : 'bg-white/15');

export function AnalyticsRetention() {
    const [event, setEvent] = useState('order_paid');

    return (
        <AnalyticsShell
            active="Retention"
            title="Who comes back, and how long the first order buys you"
            description="Cohorts by the day they placed their first paid order. The grid regroups with the range — daily cohorts over a week, weekly over a month, monthly over a quarter."
            actions={
                <>
                    <UiSelect options={['order_paid', 'session_start', 'add_to_cart']} value={event} onChange={setEvent} size="sm" className="w-40" />
                    <UiButton variant="secondary" size="sm">Compare plans</UiButton>
                </>
            }
            toolbar={
                <div className="flex flex-wrap items-center gap-2">
                    <AnalyticsToken type="event" label="order_paid" value="first occurrence" removable={false} />
                    <AnalyticsToken type="return" label="order_paid" value="any later occurrence" removable={false} />
                    <AnalyticsToken type="by" label="cohort" value="follows the range" removable={false} />
                </div>
            }
        >
            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <AnalyticsMetric
                    label="Day 1"
                    values={{ '7d': '48.3%', '28d': '51.0%', '90d': '46.5%' }}
                    deltas={{ '7d': '+2.1pt', '28d': '+3.4pt', '90d': '+5.2pt' }}
                    spark={{ '7d': [44, 46, 45, 48, 47, 50, 48], '28d': [47, 49, 52, 56], '90d': [41, 44, 48, 53] }}
                />

                <AnalyticsMetric
                    label="Day 7"
                    values={{ '7d': '26.4%', '28d': '36.8%', '90d': '32.5%' }}
                    deltas={{ '7d': '+0.8pt', '28d': '+2.9pt', '90d': '+4.1pt' }}
                    spark={{ '7d': [24, 25, 26, 27, 26, 28, 26], '28d': [33, 35, 38, 41], '90d': [27, 30, 34, 39] }}
                />

                <AnalyticsMetric
                    label="Day 30"
                    values={{ '7d': 'not yet', '28d': '23.4%', '90d': '22.3%' }}
                    deltas={{ '28d': '+1.6pt', '90d': '+3.8pt' }}
                    trends={{ '28d': 'up', '90d': 'up' }}
                    hint="cohorts younger than 30 days are excluded"
                />

                <AnalyticsMetric
                    label="Still active"
                    values={{ '7d': '6,104', '28d': '19,880', '90d': '48,310' }}
                    deltas={{ '7d': '+4.2%', '28d': '+12.7%', '90d': '+26.4%' }}
                    hint="placed a second order inside the window"
                />
            </div>

            <UiCard
                header={
                    <div className="flex flex-wrap items-baseline justify-between gap-3">
                        <div>
                            <h2 className="text-sm font-medium text-cream">Retention grid</h2>
                            <p className="mt-0.5 text-xs text-zinc-500">
                                {ranges.map((range) => <span key={range} className={show[range]}>{grouping[range]}</span>)}
                            </p>
                        </div>
                        <span className="font-mono text-[11px] text-zinc-600">dashed cells have not happened yet</span>
                    </div>
                }
            >
                {ranges.map((range) => (
                    <AnalyticsCohort key={range} columns={grids[range].columns} rows={grids[range].rows} className={block[range]} />
                ))}
            </UiCard>

            <div className="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <UiCard
                    className="lg:col-span-2"
                    header={
                        <div className="flex flex-wrap items-baseline justify-between gap-3">
                            <h2 className="text-sm font-medium text-cream">Retention curve</h2>
                            <span className="font-mono text-[11px] text-zinc-600">
                                {ranges.map((range) => <span key={range} className={show[range]}>{shape[range]}</span>)}
                            </span>
                        </div>
                    }
                >
                    <AnalyticsSeries series={curve} axis={axis} scale={scale} height="h-56" />
                </UiCard>

                <UiCard
                    header={
                        <div className="flex items-baseline justify-between">
                            <h2 className="text-sm font-medium text-cream">Day 30 by plan</h2>
                            <span className="font-mono text-[11px] text-zinc-600">28d cohorts</span>
                        </div>
                    }
                >
                    <ul className="flex flex-col gap-4">
                        {plans.map((plan) => (
                            <li key={plan.label}>
                                <div className="flex items-baseline justify-between gap-3">
                                    <span className="text-[13px] text-zinc-300">{plan.label}</span>
                                    <span className="font-mono text-[11px] text-cream">{plan.value}%</span>
                                </div>
                                <div className="mt-1.5 h-1.5 overflow-hidden rounded-full bg-ink-950">
                                    <span className={`block h-full rounded-full ${barFor(plan.value)}`} style={{ width: `${plan.value}%` }} />
                                </div>
                                <p className="mt-1.5 font-mono text-[10px] text-zinc-700">{plan.note}</p>
                            </li>
                        ))}
                    </ul>
                </UiCard>
            </div>

            <section className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div className="rounded-xl border border-white/8 bg-ink-900 p-5">
                    <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">How a cell is counted</p>
                    <p className="mt-3 text-[13px]/6 text-zinc-400">
                        A user lands in the cohort of the day their first <span className="font-mono text-[12px] text-zinc-300">order_paid</span> cleared.
                        They count in column dN if another order cleared on that day — not on or before it. Refunded orders are removed from both sides, which is why a
                        cell can drop after the fact.
                    </p>
                </div>

                <div className="rounded-xl border border-white/8 bg-ink-900 p-5">
                    <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Reading the grid</p>
                    <p className="mt-3 text-[13px]/6 text-zinc-400">
                        Compare down a column, not across a row. Every row is a different age, so the diagonal edge is missing data, not churn.
                        The August cohorts are darker at d1 than May's — the checkout rewrite shipped on 2 June.
                    </p>
                </div>
            </section>
        </AnalyticsShell>
    );
}
