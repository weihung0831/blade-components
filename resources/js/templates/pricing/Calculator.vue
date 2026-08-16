<script setup>
import { computed, ref } from 'vue';
import PricingShell from './Shell.vue';
import PricingDial from './Dial.vue';

const PLANS = {
    launch: { name: 'Launch', fee: 79, seat: 6, freeSeats: 5, minSeats: 0, api: 250, storage: 50, bandwidth: 250 },
    scale: { name: 'Scale', fee: 1240, seat: 12, freeSeats: 0, minSeats: 10, api: 12000, storage: 1024, bandwidth: 5120 },
};

const CEILING = { seats: 25, api: 2000, storage: 250, bandwidth: 1000 };
const FLOOR = { seats: 500, api: 30000, storage: 3072, bandwidth: 15360 };
const RATE = { api: 0.04, storage: 0.09, bandwidth: 0.05 };

const presets = [
    { label: 'Single storefront', meta: '8 seats', values: { seats: 8, api: 800, storage: 150, bandwidth: 750 } },
    { label: 'Regional brand', meta: '312 seats', values: { seats: 312, api: 8400, storage: 600, bandwidth: 3000 } },
    { label: 'Marketplace', meta: '640 seats', values: { seats: 640, api: 34000, storage: 3200, bandwidth: 16000 } },
];

const billing = ref('monthly');
const usage = ref({ seats: 312, api: 8400, storage: 600, bandwidth: 3000 });

const money = (value) => '$' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
const trim = (value) => Number(value.toFixed(1)).toLocaleString('en-US');
const seats = (value) => value.toLocaleString('en-US');
const calls = (value) => (value >= 1000 ? trim(value / 1000) + 'M' : value + 'k');
const bytes = (value) => (value >= 1024 ? trim(value / 1024) + ' TB' : value + ' GB');

const annual = computed(() => billing.value === 'annual');
const discount = computed(() => (annual.value ? 0.84 : 1));

const cost = (plan) => {
    const fee = plan.fee * discount.value;
    const seatRate = plan.seat * discount.value;
    const billed = Math.max(usage.value.seats - plan.freeSeats, plan.minSeats);
    const over = {
        api: Math.max(0, usage.value.api - plan.api) * RATE.api,
        storage: Math.max(0, usage.value.storage - plan.storage) * RATE.storage,
        bandwidth: Math.max(0, usage.value.bandwidth - plan.bandwidth) * RATE.bandwidth,
    };
    const recurring = fee + billed * seatRate;

    return { fee, seatRate, seats: billed, seatCost: billed * seatRate, over, recurring, total: recurring + over.api + over.storage + over.bandwidth };
};

const launch = computed(() => cost(PLANS.launch));
const scale = computed(() => cost(PLANS.scale));
const blocked = computed(() => Object.keys(CEILING).filter((key) => usage.value[key] > CEILING[key]));
const outgrown = computed(() => Object.keys(FLOOR).some((key) => usage.value[key] >= FLOOR[key]));

const winner = computed(() => {
    if (outgrown.value) {
        return 'enterprise';
    }

    return blocked.value.length === 0 && launch.value.total < scale.value.total ? 'launch' : 'scale';
});

const plan = computed(() => (winner.value === 'launch' ? PLANS.launch : PLANS.scale));
const bill = computed(() => (winner.value === 'launch' ? launch.value : scale.value));
const metered = computed(() => scale.value.over.api + scale.value.over.storage + scale.value.over.bandwidth);

const included = (key, format) =>
    usage.value[key] > plan.value[key]
        ? format(usage.value[key]) + ' · ' + format(usage.value[key] - plan.value[key]) + ' over'
        : format(usage.value[key]) + ' of ' + format(plan.value[key]) + ' included';

const cards = computed(() => [
    {
        key: 'launch',
        name: 'Launch',
        total: blocked.value.length > 0 ? 'Over the limits' : money(launch.value.total),
        sub: blocked.value.length > 0 ? blocked.value.join(', ') + ' past the cap' : 'per month',
        note: blocked.value.length > 0
            ? 'Launch stops at 25 seats, 2M calls, 250 GB of assets and 1 TB out.'
            : 'One storefront, one region, support next business day.',
    },
    {
        key: 'scale',
        name: 'Scale',
        total: money(scale.value.total),
        sub: annual.value ? 'per month, billed yearly' : 'per month',
        note: metered.value > 0
            ? 'Includes ' + money(metered.value) + ' of metered overage.'
            : 'Everything sits inside the included limits.',
    },
    {
        key: 'enterprise',
        name: 'Enterprise',
        total: 'Quoted',
        sub: 'from 500 seats',
        note: outgrown.value
            ? 'These numbers are past the self-serve ceiling — the rate gets negotiated.'
            : 'Worth a call once seats pass 500 or calls pass 30M.',
    },
]);

const lines = computed(() => [
    { key: 'fee', label: 'Platform fee', detail: plan.value.name + (annual.value ? ', 16% off' : ', monthly'), amount: bill.value.fee },
    { key: 'seats', label: 'Seats', detail: seats(bill.value.seats) + ' × ' + money(bill.value.seatRate), amount: bill.value.seatCost },
    { key: 'api', label: 'API calls', detail: included('api', calls), amount: bill.value.over.api },
    { key: 'storage', label: 'Asset storage', detail: included('storage', bytes), amount: bill.value.over.storage },
    { key: 'bandwidth', label: 'Bandwidth', detail: included('bandwidth', bytes), amount: bill.value.over.bandwidth },
]);

const caption = computed(() => outgrown.value
    ? plan.value.name + ' equivalent · Enterprise is quoted, not metered'
    : plan.value.name + (annual.value ? ' · billed once for 12 months' : ' · billed monthly on the 1st'));

const alternative = computed(() => annual.value
    ? money(bill.value.recurring * 12) + ' up front, metered charges monthly'
    : 'annual would save ' + money(bill.value.recurring * 12 * 0.16) + ' a year');
</script>

<template>
    <PricingShell
        v-model:billing="billing"
        active="Calculator"
        title="Four numbers in, three plans costed, one invoice out."
        description="Pull last month's figures off the usage panel and drag. The estimate assumes the usage repeats — it is arithmetic, not a forecast."
    >
        <div class="grid items-start gap-6 lg:grid-cols-[22rem_minmax(0,1fr)]">
            <aside class="flex flex-col gap-6 rounded-2xl border border-white/8 bg-ink-900 p-6 lg:sticky lg:top-20">
                <div>
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Your workspace</p>
                    <p class="mt-2 text-[13px]/6 text-zinc-500">Seats are the number that moves the total. Everything else stays inside the included limits for most merchants.</p>
                </div>

                <PricingDial v-model="usage.seats" label="Seats" hint="warehouse and support staff each need one"
                    :min="5" :max="1200" :step="1" :format="seats" />

                <PricingDial v-model="usage.api" label="API calls" hint="storefront reads, orders, and webhooks out"
                    :min="200" :max="40000" :step="200" :format="calls" />

                <PricingDial v-model="usage.storage" label="Asset storage" hint="product images, invoices, exports"
                    :min="50" :max="4000" :step="50" :format="bytes" />

                <PricingDial v-model="usage.bandwidth" label="Bandwidth" hint="everything served from the edge"
                    :min="250" :max="20000" :step="250" :format="bytes" />

                <div class="border-t border-white/5 pt-5">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Start from a shape</p>
                    <div class="mt-3 flex flex-col gap-1.5">
                        <button
                            v-for="preset in presets"
                            :key="preset.label"
                            type="button"
                            @click="usage = { ...preset.values }"
                            class="flex items-center gap-2 rounded-lg border border-white/8 px-3 py-2 text-left text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/40 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            {{ preset.label }}
                            <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ preset.meta }}</span>
                        </button>
                    </div>
                </div>
            </aside>

            <div class="flex flex-col gap-6">
                <div class="grid gap-4 sm:grid-cols-3">
                    <article
                        v-for="card in cards"
                        :key="card.key"
                        class="rounded-2xl border bg-ink-900 p-5 transition-colors duration-200"
                        :class="card.key === winner ? 'border-jade-500/40 bg-jade-500/6' : 'border-white/8'"
                    >
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-[13px] font-medium text-zinc-300">{{ card.name }}</span>
                            <span v-if="card.key === winner" class="font-mono text-[10px] text-jade-400">recommended</span>
                        </div>

                        <p class="mt-3 font-mono text-xl text-cream">{{ card.total }}</p>
                        <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ card.sub }}</p>
                        <p class="mt-3 text-[11px]/5 text-zinc-500">{{ card.note }}</p>
                    </article>
                </div>

                <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-4">
                        <h2 class="text-base font-medium text-cream">Estimated invoice</h2>
                        <p class="font-mono text-[11px] text-zinc-600">{{ caption }}</p>
                    </div>

                    <ul class="flex flex-col divide-y divide-white/5">
                        <li v-for="line in lines" :key="line.key" class="flex items-baseline gap-4 px-5 py-3">
                            <span class="text-[13px] text-zinc-300">{{ line.label }}</span>
                            <span class="hidden truncate font-mono text-[11px] text-zinc-600 sm:block">{{ line.detail }}</span>
                            <span class="ml-auto shrink-0 font-mono text-[13px] text-zinc-400">{{ money(line.amount) }}</span>
                        </li>
                    </ul>

                    <div class="flex flex-wrap items-baseline gap-x-4 gap-y-2 border-t border-white/8 bg-ink-950 px-5 py-4">
                        <span class="text-[13px] text-cream">Per month</span>
                        <span class="font-mono text-[11px] text-zinc-600">{{ alternative }}</span>
                        <span class="ml-auto font-mono text-xl text-cream">{{ money(bill.total) }}</span>
                    </div>
                </section>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">What this leaves out</p>
                        <p class="mt-3 text-[13px]/6 text-zinc-400">Payment processing, which your PSP bills you for directly, and tax. Sandbox storefronts never meter.</p>
                    </div>

                    <div class="flex flex-col justify-between rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p class="text-[13px]/6 text-zinc-400">An estimate is not a quote. Send us the numbers and we will hold a rate for 30 days.</p>
                        <a href="/templates/pricing/screens/enterprise" target="_top"
                            class="mt-4 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Ask for a quote →</a>
                    </div>
                </div>
            </div>
        </div>
    </PricingShell>
</template>
