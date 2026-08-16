<script setup>
import { ref } from 'vue';
import DashboardShell from './Shell.vue';
import DashboardStat from './Stat.vue';
import UiCard from '../../components/ui/Card.vue';
import UiSelect from '../../components/ui/Select.vue';
import UiButton from '../../components/ui/Button.vue';
import UiBadge from '../../components/ui/Badge.vue';
import UiSeparator from '../../components/ui/Separator.vue';
import UiTable from '../../components/ui/Table.vue';
import UiMeterGroup from '../../components/ui/MeterGroup.vue';
import UiNumberTicker from '../../components/ui/NumberTicker.vue';
import UiAnimatedBarChart from '../../components/ui/AnimatedBarChart.vue';
import UiAnimatedColumnChart from '../../components/ui/AnimatedColumnChart.vue';

const range = ref('This week');

const crumbs = [{ label: 'wharf', href: '#' }, { label: 'Commerce', href: '#' }, { label: 'Orders' }];

const volume = [
    { label: 'Mon', value: 21.4 },
    { label: 'Tue', value: 24.8 },
    { label: 'Wed', value: 23.1 },
    { label: 'Thu', value: 27.6 },
    { label: 'Fri', value: 34.2, highlight: true },
    { label: 'Sat', value: 31.7 },
    { label: 'Sun', value: 22.1 },
];

const products = [
    { label: 'Kettle 1.2L', value: 1840, highlight: true },
    { label: 'Trail pack', value: 1412 },
    { label: 'Cedar candle', value: 1108 },
    { label: 'Linen apron', value: 906 },
    { label: 'Stoneware mug', value: 742 },
];

const refunds = [
    { label: 'Damaged in transit', value: 44, color: 'jade' },
    { label: 'Wrong size', value: 33, color: 'mint' },
    { label: 'Changed mind', value: 23, color: 'zinc' },
];

const columns = [
    { key: 'order', label: 'Order' },
    { key: 'merchant', label: 'Merchant' },
    { key: 'customer', label: 'Customer' },
    { key: 'method', label: 'Method' },
    { key: 'total', label: 'Total', align: 'right' },
    { key: 'status', label: 'Status', sortable: false },
    { key: 'placed', label: 'Placed', align: 'right' },
];

const rows = [
    { order: '#WF-40218', merchant: 'Northbeam Supply', customer: 'A. Sandoval', method: 'Visa ·· 4412', total: '$248.00', status: { text: 'Paid', dot: 'jade' }, placed: '4m ago' },
    { order: '#WF-40217', merchant: 'Kettle & Co.', customer: 'M. Iwata', method: 'Apple Pay', total: '$96.50', status: { text: 'Paid', dot: 'jade' }, placed: '11m ago' },
    { order: '#WF-40216', merchant: 'Verdant Studio', customer: 'R. Okafor', method: 'Mastercard ·· 0091', total: '$412.20', status: { text: 'Processing', dot: 'zinc' }, placed: '26m ago' },
    { order: '#WF-40215', merchant: 'Cormorant Bakery', customer: 'L. Beaumont', method: 'Bank transfer', total: '$58.00', status: { text: 'Paid', dot: 'jade' }, placed: '38m ago' },
    { order: '#WF-40214', merchant: 'Osprey Outfitters', customer: 'S. Whitlock', method: 'Visa ·· 7730', total: '$1,204.00', status: { text: 'Refunded', dot: 'zinc' }, placed: '52m ago' },
    { order: '#WF-40213', merchant: 'Tidewater Provisions', customer: 'H. Duarte', method: 'Google Pay', total: '$174.90', status: { text: 'Paid', dot: 'jade' }, placed: '1h ago' },
    { order: '#WF-40212', merchant: 'Junebright Ceramics', customer: 'K. Tanaka', method: 'Visa ·· 2288', total: '$88.00', status: { text: 'Disputed', dot: 'zinc' }, placed: '2h ago' },
    { order: '#WF-40211', merchant: 'Marlowe Press', customer: 'D. Ferreira', method: 'Mastercard ·· 6612', total: '$320.75', status: { text: 'Paid', dot: 'jade' }, placed: '2h ago' },
];
</script>

<template>
    <DashboardShell active="Orders" title="Orders" :crumbs="crumbs">
        <template #actions>
            <UiSelect v-model="range" :options="['This week', 'This month', 'This quarter']" size="sm" class="w-36" />
            <UiButton variant="secondary" size="sm">Export CSV</UiButton>
            <UiButton size="sm">Open payouts</UiButton>
        </template>

        <div class="grid grid-cols-4 gap-4">
            <DashboardStat label="Gross volume" :value="184920" prefix="$" delta="8.7%" trend="up" hint="platform-wide, 7 days"
                :points="[142, 148, 155, 161, 168, 172, 179, 185]" />
            <DashboardStat label="Orders" :value="14035" delta="6.2%" trend="up" hint="2,004 per day"
                :points="[11800, 12100, 12600, 12900, 13200, 13500, 13800, 14035]" />
            <DashboardStat label="Refund rate" :value="1.8" :decimals="1" suffix="%" delta="0.2pt" trend="up" hint="watch Osprey returns"
                :points="[1.4, 1.4, 1.5, 1.5, 1.6, 1.7, 1.7, 1.8]" />
            <DashboardStat label="Platform fee" :value="5547.6" :decimals="2" prefix="$" delta="8.7%" trend="up" hint="3% of volume"
                :points="[4.2, 4.4, 4.6, 4.8, 5.0, 5.1, 5.3, 5.5]" />
        </div>

        <div class="grid grid-cols-3 gap-4">
            <UiCard class="col-span-2">
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <div>
                            <h2 class="text-sm font-medium text-cream">Gross volume</h2>
                            <p class="mt-0.5 text-xs text-zinc-500">Thousands of USD per day</p>
                        </div>
                        <span class="font-mono text-xs text-jade-400">Friday best day, $34.2k</span>
                    </div>
                </template>

                <UiAnimatedColumnChart :items="volume" height="h-44" />
            </UiCard>

            <UiCard>
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Next payout</h2>
                        <UiBadge variant="dot" color="jade" class="py-0.5">Scheduled</UiBadge>
                    </div>
                </template>

                <p class="text-2xl font-semibold tracking-tight text-cream">
                    <UiNumberTicker :value="179372.4" :decimals="2" prefix="$" />
                </p>
                <p class="mt-1 text-xs text-zinc-500">Arrives Mon 18 Aug · 1,284 merchant accounts</p>

                <UiSeparator class="my-4" />

                <dl class="flex flex-col gap-2.5 text-xs">
                    <div class="flex items-baseline justify-between">
                        <dt class="text-zinc-500">Gross volume</dt>
                        <dd class="font-mono text-zinc-300">$184,920.00</dd>
                    </div>
                    <div class="flex items-baseline justify-between">
                        <dt class="text-zinc-500">Platform fee</dt>
                        <dd class="font-mono text-zinc-300">−$5,547.60</dd>
                    </div>
                    <div class="flex items-baseline justify-between">
                        <dt class="text-zinc-500">Refunds</dt>
                        <dd class="font-mono text-red-400">−$3,328.56</dd>
                    </div>
                    <div class="flex items-baseline justify-between border-t border-white/5 pt-2.5">
                        <dt class="text-zinc-300">Net</dt>
                        <dd class="font-mono text-jade-400">$179,372.40</dd>
                    </div>
                </dl>
            </UiCard>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <UiCard class="col-span-2">
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Best sellers</h2>
                        <span class="font-mono text-[11px] text-zinc-600">units, 7 days</span>
                    </div>
                </template>

                <UiAnimatedBarChart :items="products" :max="2100" label-width="w-24" />

                <UiSeparator class="my-4" />

                <dl class="grid grid-cols-3 gap-4 text-xs">
                    <div>
                        <dt class="text-zinc-500">Units shipped</dt>
                        <dd class="mt-1 font-mono text-sm text-cream">6,008</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Repeat buyers</dt>
                        <dd class="mt-1 font-mono text-sm text-cream">41.2%</dd>
                    </div>
                    <div>
                        <dt class="text-zinc-500">Out of stock</dt>
                        <dd class="mt-1 font-mono text-sm text-amber-400">9 SKUs</dd>
                    </div>
                </dl>
            </UiCard>

            <UiCard>
                <template #header>
                    <h2 class="text-sm font-medium text-cream">Refund reasons</h2>
                </template>

                <UiMeterGroup :segments="refunds" label="Reason mix" total="252 refunds" />

                <UiSeparator class="my-4" />

                <div class="flex items-baseline justify-between text-xs">
                    <span class="text-zinc-500">Open disputes</span>
                    <span class="font-mono text-amber-400">7 · $2,140</span>
                </div>
                <UiButton variant="ghost" size="sm" class="mt-3 w-full">Review disputes</UiButton>
            </UiCard>
        </div>

        <section>
            <div class="mb-3 flex items-baseline justify-between">
                <h2 class="text-sm font-medium text-cream">Recent orders</h2>
                <a href="#" class="text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Open order queue</a>
            </div>

            <UiTable :columns="columns" :rows="rows" hover striped />
        </section>
    </DashboardShell>
</template>
