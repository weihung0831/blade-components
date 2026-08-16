<script setup>
import { ref } from 'vue';
import DashboardShell from './Shell.vue';
import UiCard from '../../components/ui/Card.vue';
import UiSelect from '../../components/ui/Select.vue';
import UiButton from '../../components/ui/Button.vue';
import UiAlert from '../../components/ui/Alert.vue';
import UiProgress from '../../components/ui/Progress.vue';
import UiSeparator from '../../components/ui/Separator.vue';
import UiTable from '../../components/ui/Table.vue';
import UiAnimatedColumnChart from '../../components/ui/AnimatedColumnChart.vue';

const environment = ref('Production');

const crumbs = [{ label: 'wharf', href: '#' }, { label: 'Platform', href: '#' }, { label: 'Deploys' }];

const slots = Array.from({ length: 30 }, (value, index) => index);

const services = [
    { name: 'Platform API', uptime: '99.98%', latency: '84 ms', state: 'ok', incidents: [] },
    { name: 'Storefront edge', uptime: '99.95%', latency: '38 ms', state: 'ok', incidents: [19] },
    { name: 'Webhook fanout', uptime: '99.71%', latency: '212 ms', state: 'degraded', incidents: [7, 8, 24] },
    { name: 'Background jobs', uptime: '99.99%', latency: '1.2 s', state: 'ok', incidents: [] },
];

const latency = [
    { label: '00', value: 76 },
    { label: '03', value: 71 },
    { label: '06', value: 68 },
    { label: '09', value: 94 },
    { label: '12', value: 118, highlight: true },
    { label: '15', value: 102 },
    { label: '18', value: 88 },
    { label: '21', value: 79 },
];

const regions = [
    { code: 'ap-1', city: 'Taipei', merchants: 612, load: 71 },
    { code: 'ap-2', city: 'Tokyo', merchants: 348, load: 54 },
    { code: 'us-1', city: 'Ashburn', merchants: 221, load: 38 },
    { code: 'eu-1', city: 'Frankfurt', merchants: 103, load: 22 },
];

const columns = [
    { key: 'commit', label: 'Commit' },
    { key: 'message', label: 'Message' },
    { key: 'branch', label: 'Branch' },
    { key: 'author', label: 'Author' },
    { key: 'duration', label: 'Duration', align: 'right' },
    { key: 'state', label: 'State', sortable: false },
    { key: 'finished', label: 'Finished', align: 'right' },
];

const rows = [
    { commit: '2801f2a', message: 'Cache storefront theme manifests', branch: 'main', author: 'wei', duration: '2m 14s', state: { text: 'Live', dot: 'jade' }, finished: '12m ago' },
    { commit: 'f6e38b2', message: 'Retry dunning webhooks with backoff', branch: 'main', author: 'lin', duration: '3m 02s', state: { text: 'Live', dot: 'jade' }, finished: '1h ago' },
    { commit: 'f8834d1', message: 'Split payout batches per region', branch: 'main', author: 'wei', duration: '2m 47s', state: { text: 'Live', dot: 'jade' }, finished: '4h ago' },
    { commit: 'fd5a1c4', message: 'Bump edge runtime to 3.2', branch: 'edge/runtime', author: 'chen', duration: '5m 31s', state: { text: 'Rolled back', dot: 'zinc' }, finished: '7h ago' },
    { commit: '5ce0bbf', message: 'Index orders by merchant and paid_at', branch: 'main', author: 'lin', duration: '4m 08s', state: { text: 'Live', dot: 'jade' }, finished: '11h ago' },
    { commit: '9ab41de', message: 'Seat quota checks on invite', branch: 'billing/seats', author: 'wei', duration: '1m 52s', state: { text: 'Failed', dot: 'zinc' }, finished: '1d ago' },
];
</script>

<template>
    <DashboardShell active="Deploys" title="Deploys" :crumbs="crumbs">
        <template #actions>
            <UiSelect v-model="environment" :options="['Production', 'Staging', 'Preview']" size="sm" class="w-36" />
            <UiButton variant="secondary" size="sm">Rollback</UiButton>
            <UiButton size="sm">Deploy main</UiButton>
        </template>

        <div class="grid grid-cols-4 gap-4">
            <div v-for="service in services" :key="service.name" class="rounded-xl border border-white/10 bg-ink-800 p-4">
                <div class="flex items-center gap-2">
                    <span class="size-1.5 shrink-0 rounded-full" :class="service.state === 'ok' ? 'bg-jade-500' : 'bg-amber-400'"></span>
                    <p class="truncate text-[13px] font-medium text-cream">{{ service.name }}</p>
                    <span class="ml-auto shrink-0 font-mono text-[11px] text-zinc-500">{{ service.latency }}</span>
                </div>

                <div class="mt-3 flex h-7 items-end gap-[3px]">
                    <span v-for="slot in slots" :key="slot" class="h-full flex-1 rounded-[1px]"
                        :class="service.incidents.includes(slot) ? 'bg-red-400' : 'bg-jade-500/35'"></span>
                </div>

                <div class="mt-2 flex items-baseline justify-between font-mono text-[10px] text-zinc-600">
                    <span>30d</span>
                    <span :class="service.state === 'ok' ? 'text-jade-400' : 'text-amber-400'">{{ service.uptime }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <UiCard class="col-span-2">
                <template #header>
                    <div class="flex items-baseline justify-between">
                        <div>
                            <h2 class="text-sm font-medium text-cream">API latency, p95</h2>
                            <p class="mt-0.5 text-xs text-zinc-500">Milliseconds, last 24 hours</p>
                        </div>
                        <span class="font-mono text-xs text-amber-400">peak 118 ms at 12:40</span>
                    </div>
                </template>

                <UiAnimatedColumnChart :items="latency" height="h-44" />
            </UiCard>

            <UiCard>
                <template #header>
                    <h2 class="text-sm font-medium text-cream">Region load</h2>
                </template>

                <div class="flex flex-col gap-3.5">
                    <div v-for="region in regions" :key="region.code">
                        <div class="flex items-baseline justify-between gap-3">
                            <span class="flex items-baseline gap-2">
                                <span class="font-mono text-[11px] text-jade-400">{{ region.code }}</span>
                                <span class="text-[13px] text-zinc-300">{{ region.city }}</span>
                            </span>
                            <span class="font-mono text-[11px] text-zinc-600">{{ region.merchants }} stores</span>
                        </div>
                        <UiProgress :value="region.load" size="sm" class="mt-1.5" />
                    </div>
                </div>

                <UiSeparator class="my-4" />

                <UiAlert variant="warning" title="Webhook fanout degraded">
                    Retry queue is 4,120 deep in ap-2. Draining at ~600/min.
                </UiAlert>
            </UiCard>
        </div>

        <section>
            <div class="mb-3 flex items-baseline justify-between">
                <h2 class="text-sm font-medium text-cream">Deploy log</h2>
                <span class="font-mono text-[11px] text-zinc-600">6 of 214 · main</span>
            </div>

            <UiTable :columns="columns" :rows="rows" hover striped />
        </section>
    </DashboardShell>
</template>
