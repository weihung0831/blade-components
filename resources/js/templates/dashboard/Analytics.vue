<script setup>
import { ref } from 'vue';
import DashboardShell from './Shell.vue';
import DashboardStat from './Stat.vue';
import UiCard from '../../components/ui/Card.vue';
import UiSelect from '../../components/ui/Select.vue';
import UiButton from '../../components/ui/Button.vue';
import UiSeparator from '../../components/ui/Separator.vue';
import UiTable from '../../components/ui/Table.vue';
import UiMeterGroup from '../../components/ui/MeterGroup.vue';
import UiAnimatedBarChart from '../../components/ui/AnimatedBarChart.vue';
import UiAnimatedColumnChart from '../../components/ui/AnimatedColumnChart.vue';

const scope = ref('All storefronts');
const range = ref('Last 28 days');

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
</script>

<template>
    <DashboardShell active="Analytics" title="Analytics" :crumbs="crumbs">
        <template #actions>
            <UiSelect v-model="scope" :options="['All storefronts', 'Scale plan only', 'Trials']" size="sm" class="w-44" />
            <UiSelect v-model="range" :options="['Last 28 days', 'Last 7 days', 'This quarter']" size="sm" class="w-40" />
            <UiButton variant="secondary" size="sm">Share report</UiButton>
        </template>

        <div class="grid grid-cols-4 gap-4">
            <DashboardStat label="Sessions" :value="412800" delta="14.9%" trend="up" hint="vs prior 28 days"
                :points="[288, 301, 322, 340, 358, 371, 396, 412]" />
            <DashboardStat label="Product views" :value="1284900" delta="11.2%" trend="up" hint="across 1,284 stores"
                :points="[980, 1020, 1075, 1104, 1160, 1198, 1240, 1284]" />
            <DashboardStat label="Conversion" :value="3.4" :decimals="1" suffix="%" delta="0.3pt" trend="up" hint="paid orders / sessions"
                :points="[2.8, 2.9, 2.9, 3.0, 3.1, 3.2, 3.3, 3.4]" />
            <DashboardStat label="Avg order value" :value="86.4" :decimals="2" prefix="$" delta="1.9%" trend="down" hint="promo-heavy month"
                :points="[92, 91, 90, 89, 89, 88, 87, 86]" />
        </div>

        <div class="grid grid-cols-3 gap-4">
            <UiCard class="col-span-2">
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <div>
                            <h2 class="text-sm font-medium text-cream">Sessions</h2>
                            <p class="mt-0.5 text-xs text-zinc-500">Thousands per day, August</p>
                        </div>
                        <div class="flex items-center gap-3 font-mono text-[11px] text-zinc-600">
                            <span class="flex items-center gap-1.5"><span class="size-2 rounded-full bg-jade-500"></span>peak 58k</span>
                            <span class="flex items-center gap-1.5"><span class="size-2 rounded-full bg-jade-500/30"></span>median 39k</span>
                        </div>
                    </div>
                </template>

                <UiAnimatedColumnChart :items="sessions" height="h-56" :values="false" />
            </UiCard>

            <UiCard>
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Traffic sources</h2>
                        <span class="font-mono text-[11px] text-zinc-600">thousands</span>
                    </div>
                </template>

                <UiAnimatedBarChart :items="sources" :max="185" label-width="w-14" class="pb-1" />

                <UiSeparator class="my-4" />

                <UiMeterGroup :segments="devices" label="Devices" total="412.8k sessions" />
            </UiCard>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <UiCard class="col-span-2">
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Checkout funnel</h2>
                        <span class="font-mono text-[11px] text-zinc-600">3.4% end to end</span>
                    </div>
                </template>

                <ol class="flex flex-col gap-3">
                    <li v-for="(stage, index) in funnel" :key="stage.step">
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="text-[13px] text-zinc-300">{{ stage.step }}</span>
                            <span class="flex items-baseline gap-3 font-mono text-[11px]">
                                <span class="text-cream">{{ stage.count }}</span>
                                <span v-if="stage.drop" class="w-16 text-right text-red-400">{{ stage.drop }}</span>
                                <span v-else class="w-16 text-right text-zinc-600">entry</span>
                            </span>
                        </div>
                        <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-ink-950">
                            <span class="block h-full rounded-full bg-jade-500 transition-[width] duration-700 ease-snap"
                                :style="{ width: `${stage.percent}%`, opacity: 1 - index * 0.14 }"></span>
                        </div>
                    </li>
                </ol>
            </UiCard>

            <UiCard>
                <template #header>
                    <h2 class="text-sm font-medium text-cream">Top regions</h2>
                </template>

                <ul class="flex flex-col gap-3">
                    <li v-for="region in regions" :key="region.code" class="flex items-center gap-3">
                        <span class="grid size-7 shrink-0 place-items-center rounded-md bg-ink-950 font-mono text-[10px] text-zinc-400">{{ region.code }}</span>
                        <span class="min-w-0 flex-1 truncate text-[13px] text-zinc-300">{{ region.name }}</span>
                        <span class="shrink-0 font-mono text-[11px] text-zinc-500">{{ region.share }}</span>
                    </li>
                </ul>
            </UiCard>
        </div>

        <section>
            <div class="mb-3 flex items-baseline justify-between">
                <h2 class="text-sm font-medium text-cream">Top storefronts</h2>
                <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">View all 1,284</a>
            </div>

            <UiTable :columns="columns" :rows="rows" hover striped />
        </section>
    </DashboardShell>
</template>
