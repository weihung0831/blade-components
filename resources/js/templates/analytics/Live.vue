<script setup>
import { ref } from 'vue';
import UiCard from '../../components/ui/data-display/Card.vue';
import UiButton from '../../components/ui/actions/Button.vue';
import UiSelect from '../../components/ui/forms/Select.vue';
import AnalyticsShell from './Shell.vue';

const filter = ref('All events');
const ranges = ['7d', '28d', '90d'];

const show = {
    '7d': 'hidden group-data-[range=7d]/shell:inline',
    '28d': 'hidden group-data-[range=28d]/shell:inline',
    '90d': 'hidden group-data-[range=90d]/shell:inline',
};

const minutes = [34, 41, 38, 46, 52, 44, 39, 47, 55, 61, 58, 49, 44, 51, 63, 70, 66, 58, 52, 47, 55, 64, 72, 68, 61, 57, 66, 74, 81, 76, 69, 62, 58, 65, 73, 80, 88, 82, 74, 68, 71, 79, 86, 92, 85, 77, 70, 66, 74, 83, 90, 96, 89, 81, 75, 78, 87, 94, 100, 93];

const stream = [
    { time: '14:32:07', user: 'u_8c41d0', event: 'order_paid', detail: '$128.40 · northbeam.shop', region: 'TW', kind: 'paid' },
    { time: '14:32:06', user: 'u_2b7e19', event: 'product_viewed', detail: 'sku VG-2213 · mobile', region: 'JP' },
    { time: '14:32:05', user: 'u_1f90aa', event: 'checkout_started', detail: 'cart 3 items · $86.00', region: 'SG' },
    { time: '14:32:05', user: 'u_44c082', event: 'session_start', detail: 'organic search · desktop', region: 'TW' },
    { time: '14:32:03', user: 'u_9d3f57', event: 'payment_failed', detail: 'card declined · retry 1', region: 'US', kind: 'failed' },
    { time: '14:32:02', user: 'u_7a1e64', event: 'add_to_cart', detail: 'sku KT-0918 · mobile', region: 'TW' },
    { time: '14:32:01', user: 'u_0e88b3', event: 'order_paid', detail: '$41.90 · kettleandco.store', region: 'AU', kind: 'paid' },
    { time: '14:32:00', user: 'u_5c62f1', event: 'product_viewed', detail: 'sku OS-4471 · tablet', region: 'JP' },
    { time: '14:31:59', user: 'u_b3907c', event: 'session_start', detail: 'paid social · mobile', region: 'SG' },
    { time: '14:31:58', user: 'u_e21446', event: 'checkout_started', detail: 'cart 1 item · $24.00', region: 'TW' },
    { time: '14:31:57', user: 'u_3f70da', event: 'refund_requested', detail: 'order #48120 · sizing', region: 'US', kind: 'failed' },
    { time: '14:31:56', user: 'u_6ac815', event: 'add_to_cart', detail: 'sku VG-2213 · mobile', region: 'TW' },
];

const comparisons = [
    { label: 'Peak concurrent', values: { '7d': '1,612', '28d': '1,844', '90d': '2,096' } },
    { label: 'Median concurrent', values: { '7d': '1,104', '28d': '1,038', '90d': '921' } },
    { label: 'Busiest hour', values: { '7d': 'Sat 20:00', '28d': 'Sat 20:00', '90d': 'Fri 21:00' } },
    { label: 'Now sits at', values: { '7d': '79th percentile', '28d': '84th percentile', '90d': '91st percentile' } },
];

const pages = [
    { path: '/products/verdant-carafe', value: 312 },
    { path: '/collections/kitchen', value: 248 },
    { path: '/checkout', value: 186 },
    { path: '/products/osprey-pack-40l', value: 141 },
    { path: '/cart', value: 119 },
];

const rules = [
    { name: 'payment_failed rate above 2%', state: 'firing', meta: 'at 3.4% since 14:08 · paging on-call' },
    { name: 'checkout_started down 20% hour over hour', state: 'ok', meta: 'currently +6.2%' },
    { name: 'order_paid below forecast', state: 'ok', meta: '104% of forecast' },
    { name: 'ingest lag over 30s', state: 'ok', meta: 'lag 3s' },
];

const eventTone = (kind) => (kind === 'paid' ? 'text-jade-300' : kind === 'failed' ? 'text-red-400' : 'text-zinc-300');
</script>

<template>
    <AnalyticsShell
        active="Live"
        title="Right now, in the last sixty seconds"
        description="The stream and the counter ignore the range switch — they are always now. The panel on the right is where the range still applies, so you can tell whether now is unusual."
    >
        <template #actions>
            <UiSelect v-model="filter" :options="['All events', 'Commerce only', 'Errors only']" size="sm" class="w-40" />
            <UiButton variant="secondary" size="sm">Pause stream</UiButton>
        </template>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <UiCard class="lg:col-span-2">
                <template #header>
                    <div class="flex flex-wrap items-baseline justify-between gap-3">
                        <div class="flex items-center gap-2.5">
                            <span class="relative flex size-2">
                                <span class="absolute inline-flex size-full animate-ping rounded-full bg-jade-400 opacity-70"></span>
                                <span class="relative inline-flex size-2 rounded-full bg-jade-500"></span>
                            </span>
                            <h2 class="text-sm font-medium text-cream">Active right now</h2>
                        </div>
                        <span class="font-mono text-[11px] text-zinc-600">events per minute, last hour</span>
                    </div>
                </template>

                <div class="flex flex-wrap items-end justify-between gap-6">
                    <div>
                        <p class="text-4xl font-semibold tracking-tight text-cream">1,284</p>
                        <p class="mt-1.5 font-mono text-[11px] text-jade-400">+18.2% vs this time yesterday</p>
                    </div>

                    <dl class="flex gap-8 font-mono text-[11px]">
                        <div>
                            <dt class="text-zinc-600">events / min</dt>
                            <dd class="mt-1 text-lg text-cream">4,218</dd>
                        </div>
                        <div>
                            <dt class="text-zinc-600">carts open</dt>
                            <dd class="mt-1 text-lg text-cream">341</dd>
                        </div>
                        <div>
                            <dt class="text-zinc-600">paid / min</dt>
                            <dd class="mt-1 text-lg text-cream">27</dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6 flex h-28 items-end gap-px">
                    <span
                        v-for="(minute, index) in minutes"
                        :key="index"
                        class="flex-1 rounded-t-[2px]"
                        :class="index === minutes.length - 1 ? 'bg-jade-500' : 'bg-jade-500/45'"
                        :style="{ height: `${minute}%` }"
                    ></span>
                </div>

                <div class="mt-2 flex justify-between font-mono text-[10px] text-zinc-700">
                    <span>13:32</span>
                    <span>14:02</span>
                    <span>now</span>
                </div>
            </UiCard>

            <UiCard>
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <h2 class="text-sm font-medium text-cream">Is this unusual?</h2>
                        <span class="font-mono text-[11px] text-jade-400">
                            <span v-for="range in ranges" :key="range" :class="show[range]">{{ range }}</span>
                        </span>
                    </div>
                </template>

                <dl class="flex flex-col gap-4">
                    <div v-for="stat in comparisons" :key="stat.label" class="flex items-baseline justify-between gap-3 border-b border-white/5 pb-3 last:border-0 last:pb-0">
                        <dt class="text-[13px] text-zinc-400">{{ stat.label }}</dt>
                        <dd class="font-mono text-[13px] text-cream">
                            <span v-for="range in ranges" :key="range" :class="show[range]">{{ stat.values[range] }}</span>
                        </dd>
                    </div>
                </dl>

                <p class="mt-4 font-mono text-[10px]/5 text-zinc-700">A Monday afternoon this busy usually means a campaign landed. Check the paid social split before calling it growth.</p>
            </UiCard>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <UiCard class="lg:col-span-2">
                <template #header>
                    <div class="flex flex-wrap items-baseline justify-between gap-3">
                        <h2 class="text-sm font-medium text-cream">Event stream</h2>
                        <span class="font-mono text-[11px] text-zinc-600">tailing · 12 of 4,218 per minute</span>
                    </div>
                </template>

                <ol class="-mx-1 flex flex-col font-mono text-[11px]">
                    <li
                        v-for="(entry, index) in stream"
                        :key="entry.time + entry.user"
                        class="flex items-center gap-3 rounded-md px-1 py-1.5 transition-colors duration-150 hover:bg-white/4"
                        :class="index === 0 ? 'rise' : null"
                        :style="index === 0 ? { animationDelay: '120ms' } : null"
                    >
                        <span class="shrink-0 text-zinc-700">{{ entry.time }}</span>
                        <span class="hidden w-20 shrink-0 truncate text-zinc-600 sm:block">{{ entry.user }}</span>
                        <span class="w-40 shrink-0 truncate" :class="eventTone(entry.kind)">{{ entry.event }}</span>
                        <span class="min-w-0 flex-1 truncate text-zinc-500">{{ entry.detail }}</span>
                        <span class="shrink-0 rounded border border-white/8 px-1.5 text-[10px] text-zinc-600">{{ entry.region }}</span>
                    </li>
                </ol>

                <div class="mt-3 border-t border-white/5 pt-3">
                    <p class="font-mono text-[10px] text-zinc-700">Scrolls until you pause it. Click any row to open that user's session replay.</p>
                </div>
            </UiCard>

            <div class="flex flex-col gap-4">
                <UiCard>
                    <template #header>
                        <div class="flex items-baseline justify-between">
                            <h2 class="text-sm font-medium text-cream">Pages, right now</h2>
                            <span class="font-mono text-[11px] text-zinc-600">viewers</span>
                        </div>
                    </template>

                    <ul class="flex flex-col gap-2.5">
                        <li v-for="page in pages" :key="page.path" class="flex items-center gap-3">
                            <span class="min-w-0 flex-1 truncate font-mono text-[11px] text-zinc-400">{{ page.path }}</span>
                            <span class="h-1 w-12 shrink-0 overflow-hidden rounded-full bg-ink-950">
                                <span class="block h-full rounded-full bg-jade-500/60" :style="{ width: `${Math.round(page.value / 3.12)}%` }"></span>
                            </span>
                            <span class="w-8 shrink-0 text-right font-mono text-[11px] text-cream">{{ page.value }}</span>
                        </li>
                    </ul>
                </UiCard>

                <UiCard>
                    <template #header>
                        <div class="flex items-baseline justify-between">
                            <h2 class="text-sm font-medium text-cream">Alert rules</h2>
                            <span class="font-mono text-[11px] text-red-400">1 firing</span>
                        </div>
                    </template>

                    <ul class="flex flex-col gap-3">
                        <li v-for="rule in rules" :key="rule.name" class="flex items-start gap-2.5">
                            <span class="mt-1.5 size-1.5 shrink-0 rounded-full" :class="rule.state === 'firing' ? 'bg-red-400' : 'bg-jade-500'"></span>
                            <div class="min-w-0">
                                <p class="text-[13px]/5" :class="rule.state === 'firing' ? 'text-cream' : 'text-zinc-400'">{{ rule.name }}</p>
                                <p class="mt-0.5 font-mono text-[10px] text-zinc-700">{{ rule.meta }}</p>
                            </div>
                        </li>
                    </ul>
                </UiCard>
            </div>
        </div>
    </AnalyticsShell>
</template>
