<script setup>
import { ref } from 'vue';
import DashboardShell from './Shell.vue';
import DashboardStat from './Stat.vue';
import UiCard from '../../components/ui/Card.vue';
import UiSelect from '../../components/ui/Select.vue';
import UiButton from '../../components/ui/Button.vue';
import UiBadge from '../../components/ui/Badge.vue';
import UiProgress from '../../components/ui/Progress.vue';
import UiSeparator from '../../components/ui/Separator.vue';
import UiTimeline from '../../components/ui/Timeline.vue';
import UiMeterGroup from '../../components/ui/MeterGroup.vue';
import UiAnimatedColumnChart from '../../components/ui/AnimatedColumnChart.vue';

const range = ref('Last 30 days');

const crumbs = [{ label: 'wharf', href: '#' }, { label: 'Overview' }];

const revenue = [
    { label: 'Sep', value: 28.4 },
    { label: 'Oct', value: 30.1 },
    { label: 'Nov', value: 33.6 },
    { label: 'Dec', value: 35.2 },
    { label: 'Jan', value: 34.8 },
    { label: 'Feb', value: 37.9 },
    { label: 'Mar', value: 39.5 },
    { label: 'Apr', value: 41.2 },
    { label: 'May', value: 43.7 },
    { label: 'Jun', value: 44.1 },
    { label: 'Jul', value: 46.8 },
    { label: 'Aug', value: 48.2, highlight: true },
];

const planMix = [
    { label: 'Scale', value: 34, color: 'jade' },
    { label: 'Growth', value: 47, color: 'mint' },
    { label: 'Starter', value: 19, color: 'zinc' },
];

const quotas = [
    { label: 'API calls', used: 8.4, limit: 12, unit: 'M' },
    { label: 'Asset storage', used: 612, limit: 1024, unit: 'GB' },
    { label: 'Bandwidth', used: 3.1, limit: 5, unit: 'TB' },
    { label: 'Webhook events', used: 940, limit: 1000, unit: 'k' },
];

const activity = [
    { title: 'Northbeam Supply upgraded to Scale', time: '12m ago' },
    { title: 'Payout batch #4471 settled — $18,204', time: '48m ago' },
    { title: 'Kettle & Co. added 6 seats', time: '2h ago' },
    { title: 'Trial started — Verdant Studio', time: '3h ago' },
    { title: 'Dunning retry cleared for Halcyon', time: '5h ago', state: 'current' },
];

const risk = [
    { name: 'Halcyon Goods', reason: 'Card declined twice', mrr: '$890', tone: 'red' },
    { name: 'Pale Fire Ltd', reason: 'Usage down 41%', mrr: '$640', tone: 'amber' },
    { name: 'Osprey Outfitters', reason: 'No login in 21 days', mrr: '$420', tone: 'amber' },
];
</script>

<template>
    <DashboardShell active="Overview" title="Overview" :crumbs="crumbs">
        <template #actions>
            <UiSelect v-model="range" :options="['Last 30 days', 'Last 90 days', 'Year to date']" size="sm" class="w-40" />
            <UiButton variant="secondary" size="sm">Export</UiButton>
            <UiButton size="sm">Invite merchant</UiButton>
        </template>

        <div class="grid grid-cols-4 gap-4">
            <DashboardStat label="MRR" :value="48240" prefix="$" delta="12.4%" trend="up" hint="vs last month" />
            <DashboardStat label="Active merchants" :value="1284" delta="3.1%" trend="up" hint="42 new this month" />
            <DashboardStat label="Net revenue churn" :value="2.1" :decimals="1" suffix="%" delta="0.4pt" trend="down" hint="improved" />
            <DashboardStat label="Seats in use" :value="312" delta="18" trend="up" hint="of 400 licensed" />
        </div>

        <div class="grid grid-cols-3 gap-4">
            <UiCard class="col-span-2">
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <div>
                            <h2 class="text-sm font-medium text-cream">Recurring revenue</h2>
                            <p class="mt-0.5 text-xs text-zinc-500">Monthly, in thousands of USD</p>
                        </div>
                        <span class="font-mono text-xs text-jade-400">+69.7% YoY</span>
                    </div>
                </template>

                <UiAnimatedColumnChart :items="revenue" height="h-52" />
            </UiCard>

            <UiCard>
                <template #header>
                    <h2 class="text-sm font-medium text-cream">Plan mix</h2>
                </template>

                <UiMeterGroup :segments="planMix" total="1,284 merchants" />

                <UiSeparator class="my-4" />

                <dl class="grid grid-cols-2 gap-3 text-xs">
                    <div>
                        <dt class="text-zinc-500">ARPA</dt>
                        <dd class="mt-1 font-mono text-sm text-cream">$37.60</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Trial → paid</dt>
                        <dd class="mt-1 font-mono text-sm text-cream">31.8%</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Expansion MRR</dt>
                        <dd class="mt-1 font-mono text-sm text-jade-400">+$5,120</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Contraction</dt>
                        <dd class="mt-1 font-mono text-sm text-red-400">−$1,010</dd>
                    </div>
                </dl>
            </UiCard>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <UiCard>
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Plan quota</h2>
                        <span class="font-mono text-[11px] text-zinc-600">resets 1 Sep</span>
                    </div>
                </template>

                <div class="flex flex-col gap-3.5">
                    <UiProgress v-for="quota in quotas" :key="quota.label" :value="quota.used" :max="quota.limit"
                        :label="`${quota.label} · ${quota.used}/${quota.limit} ${quota.unit}`" />
                </div>
            </UiCard>

            <UiCard>
                <template #header>
                    <h2 class="text-sm font-medium text-cream">Recent activity</h2>
                </template>

                <UiTimeline :items="activity" variant="compact" />
            </UiCard>

            <UiCard>
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Churn risk</h2>
                        <UiBadge color="red" class="py-0.5">3 accounts</UiBadge>
                    </div>
                </template>

                <ul class="flex flex-col gap-3">
                    <li v-for="account in risk" :key="account.name" class="flex items-start gap-3">
                        <span class="mt-1.5 size-1.5 shrink-0 rounded-full"
                            :class="account.tone === 'red' ? 'bg-red-400' : 'bg-amber-400'"></span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[13px] text-zinc-200">{{ account.name }}</p>
                            <p class="mt-0.5 text-[11px] text-zinc-500">{{ account.reason }}</p>
                        </div>
                        <span class="shrink-0 font-mono text-[11px] text-zinc-500">{{ account.mrr }}</span>
                    </li>
                </ul>

                <UiButton variant="ghost" size="sm" class="mt-3 w-full">Open retention queue</UiButton>
            </UiCard>
        </div>
    </DashboardShell>
</template>
