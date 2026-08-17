<script setup>
import { ref } from 'vue';
import UiCard from '../../components/ui/data-display/Card.vue';
import UiButton from '../../components/ui/actions/Button.vue';
import UiSelect from '../../components/ui/forms/Select.vue';
import AnalyticsShell from './Shell.vue';
import AnalyticsMetric from './Metric.vue';

const conversionWindow = ref('30 minute window');
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

const steps = {
    '7d': [
        { event: 'session_start', count: '184,220', percent: 100.0, drop: null, gap: null },
        { event: 'product_viewed', count: '130,880', percent: 71.0, drop: '−29.0%', gap: '21s' },
        { event: 'add_to_cart', count: '47,910', percent: 26.0, drop: '−63.4%', gap: '1m 44s' },
        { event: 'checkout_started', count: '31,904', percent: 17.3, drop: '−33.4%', gap: '2m 01s' },
        { event: 'order_paid', count: '23,940', percent: 13.0, drop: '−25.0%', gap: '3m 12s' },
    ],
    '28d': [
        { event: 'session_start', count: '742,910', percent: 100.0, drop: null, gap: null },
        { event: 'product_viewed', count: '515,580', percent: 69.4, drop: '−30.6%', gap: '22s' },
        { event: 'add_to_cart', count: '184,240', percent: 24.8, drop: '−64.3%', gap: '1m 48s' },
        { event: 'checkout_started', count: '122,580', percent: 16.5, drop: '−33.5%', gap: '2m 04s' },
        { event: 'order_paid', count: '92,120', percent: 12.4, drop: '−24.9%', gap: '3m 18s' },
    ],
    '90d': [
        { event: 'session_start', count: '2,318,400', percent: 100.0, drop: null, gap: null },
        { event: 'product_viewed', count: '1,534,780', percent: 66.2, drop: '−33.8%', gap: '24s' },
        { event: 'add_to_cart', count: '512,370', percent: 22.1, drop: '−66.6%', gap: '1m 55s' },
        { event: 'checkout_started', count: '338,490', percent: 14.6, drop: '−33.9%', gap: '2m 12s' },
        { event: 'order_paid', count: '252,700', percent: 10.9, drop: '−25.3%', gap: '3m 26s' },
    ],
};

const dropped = {
    '7d': '7,964 dropped at checkout',
    '28d': '30,460 dropped at checkout',
    '90d': '85,790 dropped at checkout',
};

const segments = [
    { label: 'Mobile', share: '63.4%', rate: '10.8%', delta: '−1.6pt', up: false, note: 'card form is where it goes' },
    { label: 'Desktop', share: '30.9%', rate: '16.2%', delta: '+3.8pt', up: true, note: 'saved cards, fewer retries' },
    { label: 'Tablet', share: '5.7%', rate: '11.9%', delta: '−0.5pt', up: false, note: 'behaves like mobile' },
];

const instead = [
    { label: 'Went back to the cart', value: 34.2 },
    { label: 'Session ended there', value: 26.1 },
    { label: 'Opened shipping and duties', value: 18.7 },
    { label: 'Switched payment method', value: 12.4 },
    { label: 'Tried a discount code', value: 8.6 },
];
</script>

<template>
    <AnalyticsShell
        active="Funnels"
        title="Five steps, and the two that cost you the order"
        description="Cart abandonment is one number. The gaps between the steps — how long each one takes and how many walk away during it — are the ones you can act on."
    >
        <template #actions>
            <UiSelect v-model="conversionWindow" :options="['30 minute window', '1 hour window', '24 hour window', '7 day window']" size="sm" class="w-44" />
            <UiButton variant="secondary" size="sm">Export CSV</UiButton>
        </template>

        <template #toolbar>
            <div class="flex flex-wrap items-center gap-2">
                <template v-for="(step, index) in steps['28d']" :key="step.event">
                    <svg v-if="index > 0" class="size-3 shrink-0 text-zinc-700" viewBox="0 0 12 12" fill="none">
                        <path d="M4 2.5 7.5 6 4 9.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="inline-flex items-center gap-2 rounded-lg border border-white/10 bg-ink-900 px-2.5 py-1.5">
                        <span class="font-mono text-[10px] text-zinc-700">{{ String(index + 1).padStart(2, '0') }}</span>
                        <span class="font-mono text-[11px] text-zinc-300">{{ step.event }}</span>
                    </span>
                </template>

                <button
                    type="button"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-dashed border-white/12 px-2.5 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:border-jade-500/50 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M6 2v8M2 6h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
                    Step
                </button>
            </div>
        </template>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <AnalyticsMetric
                label="Entered"
                :values="{ '7d': '184,220', '28d': '742,910', '90d': '2,318,400' }"
                :deltas="{ '7d': '+8.2%', '28d': '+11.6%', '90d': '+29.4%' }"
            />

            <AnalyticsMetric
                label="Completed"
                :values="{ '7d': '23,940', '28d': '92,120', '90d': '252,700' }"
                :deltas="{ '7d': '+14.1%', '28d': '+19.8%', '90d': '+38.1%' }"
            />

            <AnalyticsMetric
                label="End to end"
                :values="{ '7d': '13.0%', '28d': '12.4%', '90d': '10.9%' }"
                :deltas="{ '7d': '+0.6pt', '28d': '+1.5pt', '90d': 'baseline' }"
                :trends="{ '7d': 'up', '28d': 'up', '90d': 'flat' }"
                hint="the shorter the window, the better it looks"
            />

            <AnalyticsMetric
                label="Median time to convert"
                :values="{ '7d': '7m 18s', '28d': '7m 32s', '90d': '8m 02s' }"
                :deltas="{ '7d': '−14s', '28d': '−30s', '90d': 'baseline' }"
                :trends="{ '7d': 'up', '28d': 'up', '90d': 'flat' }"
                hint="first touch to payment cleared"
            />
        </div>

        <UiCard>
            <template #header>
                <div class="flex flex-wrap items-baseline justify-between gap-3">
                    <div>
                        <h2 class="text-sm font-medium text-cream">Storefront to paid order</h2>
                        <p class="mt-0.5 text-xs text-zinc-500">Bar width is share of everyone who entered. The rail between two steps is how long that hop takes.</p>
                    </div>
                    <span class="font-mono text-[11px] text-zinc-600">worst hop: add_to_cart</span>
                </div>
            </template>

            <ol v-for="range in ranges" :key="range" :class="block[range]">
                <li v-for="(step, index) in steps[range]" :key="step.event">
                    <div v-if="step.gap" class="flex items-center gap-3 py-2 pl-1">
                        <span class="ml-1 h-6 w-px border-l border-dashed border-white/15"></span>
                        <span class="font-mono text-[10px] text-zinc-700">median {{ step.gap }}</span>
                        <span class="font-mono text-[10px]" :class="step.event === 'add_to_cart' ? 'text-red-400' : 'text-zinc-600'">{{ step.drop }} left here</span>
                    </div>

                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                        <span class="font-mono text-[13px] text-zinc-300">{{ step.event }}</span>
                        <span class="flex items-baseline gap-3 font-mono text-[11px]">
                            <span class="text-cream">{{ step.count }}</span>
                            <span class="w-14 text-right text-zinc-500">{{ step.percent.toFixed(1) }}%</span>
                        </span>
                    </div>

                    <div class="mt-2 h-9 overflow-hidden rounded-lg bg-ink-950">
                        <span
                            class="block h-full rounded-lg transition-[width] duration-700 ease-snap"
                            :class="index === steps[range].length - 1 ? 'bg-jade-500' : 'bg-jade-500/70'"
                            :style="{ width: `${Math.max(step.percent, 4)}%` }"
                        ></span>
                    </div>
                </li>
            </ol>
        </UiCard>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <UiCard>
                <template #header>
                    <div class="flex flex-wrap items-baseline justify-between gap-3">
                        <h2 class="text-sm font-medium text-cream">By device</h2>
                        <span class="font-mono text-[11px] text-zinc-600">steady inside ±0.4pt across every range</span>
                    </div>
                </template>

                <table class="w-full border-separate border-spacing-0 text-left">
                    <thead>
                        <tr class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">
                            <th scope="col" class="border-b border-white/5 pb-2 font-normal">Device</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">Entries</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">End to end</th>
                            <th scope="col" class="border-b border-white/5 pb-2 text-right font-normal">vs all</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="segment in segments" :key="segment.label">
                            <th scope="row" class="border-b border-white/5 py-3 pr-3 font-normal">
                                <span class="block text-[13px] text-zinc-300">{{ segment.label }}</span>
                                <span class="mt-0.5 block font-mono text-[10px] text-zinc-700">{{ segment.note }}</span>
                            </th>
                            <td class="border-b border-white/5 py-3 text-right align-top font-mono text-[11px] text-zinc-400">{{ segment.share }}</td>
                            <td class="border-b border-white/5 py-3 text-right align-top font-mono text-[11px] text-cream">{{ segment.rate }}</td>
                            <td class="border-b border-white/5 py-3 text-right align-top font-mono text-[11px]" :class="segment.up ? 'text-jade-400' : 'text-red-400'">{{ segment.delta }}</td>
                        </tr>
                    </tbody>
                </table>

                <p class="mt-4 font-mono text-[10px]/5 text-zinc-700">
                    Mobile carries two thirds of the entries and converts worst. The gap opens at payment_submitted, not before it.
                </p>
            </UiCard>

            <UiCard>
                <template #header>
                    <div class="flex flex-wrap items-baseline justify-between gap-3">
                        <h2 class="text-sm font-medium text-cream">What they did instead</h2>
                        <span class="font-mono text-[11px] text-zinc-600">
                            <span v-for="range in ranges" :key="range" :class="show[range]">{{ dropped[range] }}</span>
                        </span>
                    </div>
                </template>

                <ul class="flex flex-col gap-3.5">
                    <li v-for="item in instead" :key="item.label">
                        <div class="flex items-baseline justify-between gap-3">
                            <span class="text-[13px] text-zinc-300">{{ item.label }}</span>
                            <span class="font-mono text-[11px] text-zinc-500">{{ item.value }}%</span>
                        </div>
                        <div class="mt-1.5 h-1.5 overflow-hidden rounded-full bg-ink-950">
                            <span class="block h-full rounded-full bg-jade-500/70" :style="{ width: `${item.value}%` }"></span>
                        </div>
                    </li>
                </ul>

                <div class="mt-5 rounded-lg border border-white/8 bg-ink-950 p-3.5">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Worth a look</p>
                    <p class="mt-2 text-[13px]/6 text-zinc-400">
                        A third of the people who leave checkout go back to the cart and never return. Shipping cost lands on the checkout screen, not the cart.
                    </p>
                </div>
            </UiCard>
        </div>
    </AnalyticsShell>
</template>
