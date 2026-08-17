<script setup>
import UiCard from '../../components/ui/data-display/Card.vue';
import UiButton from '../../components/ui/actions/Button.vue';
import UiSelect from '../../components/ui/forms/Select.vue';
import AnalyticsShell from './Shell.vue';
import AnalyticsMetric from './Metric.vue';
import AnalyticsSeries from './Series.vue';
import AnalyticsToken from './Token.vue';
import { ref } from 'vue';

const measure = ref('Unique users');
const ranges = ['7d', '28d', '90d'];

const show = {
    '7d': 'hidden group-data-[range=7d]/shell:inline',
    '28d': 'hidden group-data-[range=28d]/shell:inline',
    '90d': 'hidden group-data-[range=90d]/shell:inline',
};

const chart = [
    {
        label: 'checkout_started',
        area: true,
        points: {
            '7d': [54, 63, 58, 71, 41, 36, 67],
            '28d': [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74],
            '90d': [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76],
        },
    },
    {
        label: 'order_paid',
        muted: true,
        dashed: true,
        points: {
            '7d': [23, 27, 25, 31, 17, 14, 29],
            '28d': [16, 19, 18, 22, 20, 24, 21, 27, 25, 29, 27, 31, 30, 35, 33],
            '90d': [9, 12, 11, 15, 13, 17, 19, 17, 22, 25, 27, 31, 34],
        },
    },
];

const axis = {
    '7d': ['11 Aug', '12', '13', '14', '15', '16', '17'],
    '28d': ['21 Jul', '28 Jul', '4 Aug', '11 Aug', '17 Aug'],
    '90d': ['20 May', 'Jun', 'Jul', 'Aug'],
};

const scale = {
    '7d': ['6k', '4k', '2k', '0'],
    '28d': ['6k', '4k', '2k', '0'],
    '90d': ['9k', '6k', '3k', '0'],
};

const buckets = {
    '7d': 'hourly buckets rolled to days',
    '28d': 'daily buckets',
    '90d': 'weekly buckets',
};

const scans = {
    '7d': 'scanned 1.2M rows in 84ms',
    '28d': 'scanned 4.8M rows in 210ms',
    '90d': 'scanned 15.1M rows in 640ms',
};

const intervals = { '7d': '7 days', '28d': '28 days', '90d': '90 days' };

const topEvents = [
    { name: 'session_start', share: 100, counts: { '7d': '184,220', '28d': '742,910', '90d': '2,318,400' } },
    { name: 'product_viewed', share: 71, counts: { '7d': '130,880', '28d': '527,460', '90d': '1,646,100' } },
    { name: 'add_to_cart', share: 26, counts: { '7d': '47,910', '28d': '193,150', '90d': '602,780' } },
    { name: 'checkout_started', share: 17, counts: { '7d': '31,904', '28d': '128,410', '90d': '402,180' } },
    { name: 'payment_submitted', share: 14, counts: { '7d': '25,780', '28d': '103,920', '90d': '324,410' } },
    { name: 'order_paid', share: 13, counts: { '7d': '23,940', '28d': '96,510', '90d': '301,220' } },
    { name: 'refund_requested', share: 1, counts: { '7d': '1,842', '28d': '7,410', '90d': '23,180' } },
];

const breakdown = [
    { plan: 'Scale', dot: 'bg-jade-500', events: { '7d': '21,704', '28d': '87,320', '90d': '271,940' }, users: { '7d': '16,120', '28d': '64,880', '90d': '198,410' }, per: '1.35', cvr: '76.1%', trend: '+14.2%', up: true },
    { plan: 'Launch', dot: 'bg-jade-500/60', events: { '7d': '6,412', '28d': '25,880', '90d': '82,140' }, users: { '7d': '5,240', '28d': '21,190', '90d': '66,720' }, per: '1.22', cvr: '68.4%', trend: '+6.8%', up: true },
    { plan: 'Enterprise', dot: 'bg-jade-500/35', events: { '7d': '2,918', '28d': '11,640', '90d': '36,410' }, users: { '7d': '2,104', '28d': '8,390', '90d': '25,880' }, per: '1.39', cvr: '81.7%', trend: '+2.1%', up: true },
    { plan: 'Trial', dot: 'bg-white/15', events: { '7d': '870', '28d': '3,570', '90d': '11,690' }, users: { '7d': '716', '28d': '2,940', '90d': '9,410' }, per: '1.18', cvr: '44.9%', trend: '−9.4%', up: false },
];
</script>

<template>
    <AnalyticsShell
        active="Explore"
        title="Who started checkout, and what happened to them"
        description="One event, two filters, one breakdown. The chart, the table, and the SQL underneath all answer to the same query — change the range and every number moves together."
    >
        <template #actions>
            <UiButton variant="secondary" size="sm">Save view</UiButton>
            <UiButton size="sm">Run</UiButton>
        </template>

        <template #toolbar>
            <div class="flex flex-wrap items-center gap-2">
                <AnalyticsToken type="event" label="checkout_started" :removable="false" />
                <AnalyticsToken type="where" label="plan" value="is any of Scale, Launch, Enterprise" />
                <AnalyticsToken type="where" label="storefront" value="is not sandbox" />
                <AnalyticsToken type="by" label="plan" />

                <button
                    type="button"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-dashed border-white/12 px-2.5 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:border-jade-500/50 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
                    Condition
                </button>

                <UiSelect v-model="measure" :options="['Unique users', 'Total events', 'Events per user', 'Sessions']" size="sm" class="ml-auto w-44" />
            </div>
        </template>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <AnalyticsMetric
                label="Checkouts started"
                :values="{ '7d': '31,904', '28d': '128,410', '90d': '402,180' }"
                :deltas="{ '7d': '+12.4% vs prior 7d', '28d': '+18.9% vs prior 28d', '90d': '+41.2% vs prior 90d' }"
                :spark="{ '7d': [54, 63, 58, 71, 41, 36, 67], '28d': [38, 44, 41, 52, 47, 55, 49, 61, 57, 66, 62, 71, 68, 79, 74], '90d': [22, 28, 25, 34, 31, 40, 44, 39, 52, 57, 61, 70, 76] }"
            />

            <AnalyticsMetric
                label="Unique users"
                :values="{ '7d': '24,180', '28d': '96,220', '90d': '288,940' }"
                :deltas="{ '7d': '+9.1%', '28d': '+15.4%', '90d': '+34.8%' }"
                :spark="{ '7d': [48, 55, 52, 64, 38, 34, 60], '28d': [34, 39, 37, 46, 42, 49, 45, 54, 51, 58, 55, 63, 61, 70, 66], '90d': [20, 25, 23, 30, 28, 36, 39, 35, 46, 51, 55, 62, 68] }"
            />

            <AnalyticsMetric
                label="Events per user"
                :values="{ '7d': '1.32', '28d': '1.33', '90d': '1.39' }"
                :deltas="{ '7d': '+0.03', '28d': '+0.01', '90d': '−0.04' }"
                :trends="{ '7d': 'up', '28d': 'flat', '90d': 'down' }"
                hint="a second attempt usually means a declined card"
            />

            <AnalyticsMetric
                label="Median time to event"
                :values="{ '7d': '4m 12s', '28d': '4m 06s', '90d': '3m 58s' }"
                :deltas="{ '7d': '+6s slower', '28d': '+8s slower', '90d': '−14s faster' }"
                :trends="{ '7d': 'down', '28d': 'down', '90d': 'up' }"
                hint="from session_start to checkout_started"
            />
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <UiCard class="lg:col-span-2">
                <template #header>
                    <div class="flex flex-wrap items-baseline justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-medium text-cream">Checkouts over time</h2>
                            <p class="mt-0.5 text-xs text-zinc-500">Daily, deduplicated by user and session</p>
                        </div>
                        <span class="font-mono text-[11px] text-zinc-600">
                            <span v-for="range in ranges" :key="range" :class="show[range]">{{ buckets[range] }}</span>
                        </span>
                    </div>
                </template>

                <AnalyticsSeries :series="chart" :axis="axis" :scale="scale" height="h-64" />
            </UiCard>

            <UiCard>
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Event volume</h2>
                        <span class="font-mono text-[11px] text-zinc-600">7 of 42</span>
                    </div>
                </template>

                <ul class="flex flex-col gap-3">
                    <li v-for="event in topEvents" :key="event.name">
                        <div class="flex items-baseline justify-between gap-3">
                            <span class="truncate font-mono text-[11px]" :class="event.name === 'checkout_started' ? 'text-jade-300' : 'text-zinc-400'">{{ event.name }}</span>
                            <span class="shrink-0 font-mono text-[11px] text-zinc-500">
                                <span v-for="range in ranges" :key="range" :class="show[range]">{{ event.counts[range] }}</span>
                            </span>
                        </div>
                        <div class="mt-1.5 h-1 overflow-hidden rounded-full bg-ink-950">
                            <span class="block h-full rounded-full" :class="event.name === 'checkout_started' ? 'bg-jade-500' : 'bg-white/15'" :style="{ width: `${event.share}%` }"></span>
                        </div>
                    </li>
                </ul>
            </UiCard>
        </div>

        <UiCard>
            <template #header>
                <div class="flex flex-wrap items-baseline justify-between gap-3">
                    <h2 class="text-sm font-medium text-cream">Broken down by plan</h2>
                    <span class="font-mono text-[11px] text-zinc-600">conversion = order_paid within 30 minutes</span>
                </div>
            </template>

            <div class="overflow-x-auto">
                <table class="w-full min-w-2xl border-separate border-spacing-0 text-left">
                    <thead>
                        <tr class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">
                            <th scope="col" class="border-b border-white/5 pb-2 font-normal">Plan</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">Events</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">Users</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">Per user</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">Paid</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">Trend</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="row in breakdown" :key="row.plan" class="transition-colors duration-150 hover:bg-white/3">
                            <th scope="row" class="border-b border-white/5 py-2.5 pr-3 font-normal">
                                <span class="flex items-center gap-2.5">
                                    <span class="size-2 shrink-0 rounded-full" :class="row.dot"></span>
                                    <span class="text-[13px] text-zinc-300">{{ row.plan }}</span>
                                </span>
                            </th>
                            <td class="border-b border-white/5 py-2.5 text-right font-mono text-[11px] text-cream">
                                <span v-for="range in ranges" :key="range" :class="show[range]">{{ row.events[range] }}</span>
                            </td>
                            <td class="border-b border-white/5 py-2.5 text-right font-mono text-[11px] text-zinc-400">
                                <span v-for="range in ranges" :key="range" :class="show[range]">{{ row.users[range] }}</span>
                            </td>
                            <td class="border-b border-white/5 py-2.5 text-right font-mono text-[11px] text-zinc-500">{{ row.per }}</td>
                            <td class="border-b border-white/5 py-2.5 text-right font-mono text-[11px] text-zinc-400">{{ row.cvr }}</td>
                            <td class="border-b border-white/5 py-2.5 text-right font-mono text-[11px]" :class="row.up ? 'text-jade-400' : 'text-red-400'">{{ row.trend }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </UiCard>

        <section class="rounded-xl border border-white/8 bg-ink-900 p-5">
            <div class="flex flex-wrap items-baseline justify-between gap-3">
                <h2 class="text-sm font-medium text-cream">The query, as it runs</h2>
                <span class="font-mono text-[11px] text-zinc-600">
                    <span v-for="range in ranges" :key="range" :class="show[range]">{{ scans[range] }}</span>
                </span>
            </div>

            <pre class="mt-4 overflow-x-auto rounded-lg border border-white/8 bg-ink-950 p-4 font-mono text-[11px]/5"><code><span class="text-code-keyword">select</span> plan, <span class="text-code-keyword">count</span>(*) <span class="text-code-keyword">as</span> events, <span class="text-code-keyword">count</span>(<span class="text-code-keyword">distinct</span> user_id) <span class="text-code-keyword">as</span> users
<span class="text-code-keyword">from</span> <span class="text-code-tag">events</span>
<span class="text-code-keyword">where</span> name = <span class="text-code-string">'checkout_started'</span>
  <span class="text-code-control">and</span> plan <span class="text-code-control">in</span> (<span class="text-code-string">'scale'</span>, <span class="text-code-string">'launch'</span>, <span class="text-code-string">'enterprise'</span>)
  <span class="text-code-control">and</span> storefront_kind &lt;&gt; <span class="text-code-string">'sandbox'</span>
  <span class="text-code-control">and</span> occurred_at &gt;= now() - <span class="text-code-string">'<span v-for="range in ranges" :key="range" :class="show[range]">{{ intervals[range] }}</span>'</span>::<span class="text-code-tag">interval</span>
<span class="text-code-keyword">group by</span> plan <span class="text-code-keyword">order by</span> events <span class="text-code-keyword">desc</span></code></pre>

            <p class="mt-3 font-mono text-[10px] text-zinc-700">Every saved view compiles to this. Copy it into a notebook and the numbers match to the row.</p>
        </section>
    </AnalyticsShell>
</template>
