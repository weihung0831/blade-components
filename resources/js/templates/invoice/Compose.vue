<script setup>
import { computed, ref } from 'vue';
import InvoiceShell from './Shell.vue';
import InvoiceStamp from './Stamp.vue';

const customers = [
    {
        key: 'formosa',
        name: 'Formosa Coffee Works Ltd',
        meta: 'Kaohsiung · buying since 2021',
        tax: '統一編號 24681357',
        rate: 5,
        rateLabel: 'Business tax 5%',
        note: 'A company invoice. Once it is issued the tax number cannot be changed, only voided and reissued, so check it now rather than on Friday.',
    },
    {
        key: 'kuro',
        name: 'Kuro Roasters KK',
        meta: 'Osaka · export, third order',
        tax: 'no Taiwan tax number',
        rate: 0,
        rateLabel: 'Zero-rated export',
        note: 'Zero-rated, which only holds if the bill of lading is filed with the return. Keep the forwarder receipt against this invoice number.',
    },
    {
        key: 'walkin',
        name: 'A shop with no account yet',
        meta: 'first order · pays before it ships',
        tax: 'tax number to be confirmed',
        rate: 5,
        rateLabel: 'Business tax 5%',
        note: 'No credit on a first order. This one prints as a proforma and turns into an invoice the day the money lands.',
    },
];

const terms = [
    { key: '14', label: 'Net 14', due: '2 September 2026', note: 'A Wednesday. Most shops run payments on a Wednesday, so this one usually lands on the day.' },
    { key: '30', label: 'Net 30', due: '18 September 2026', note: 'A Friday, which means the money moves that afternoon or on Monday. Assume Monday.' },
    { key: '60', label: 'Net 60', due: '19 October 2026', note: '60 days lands on a Sunday, so the date on the invoice is the Monday. We give 60 days to four accounts and this is one of them.' },
];

const issuing = [
    'Files the e-invoice with the Ministry of Finance, which is the part that cannot be taken back.',
    'Emails the PDF to the address on the account, and nowhere else.',
    'Puts the amount into the ledger as outstanding from that minute, not from when it is opened.',
    'Books the stock out. If the pallet is still here on Friday, that is a separate problem.',
];

const lines = ref([
    { code: 'MK3-GR', description: 'Mk3 hand grinder, graphite', note: 'Batch 40, ready now', price: 2940, qty: 40, step: 4, unit: 'ea', kind: 'machine' },
    { code: 'BUR-38', description: '38 mm burr set, spare', note: 'Off the shelf behind the bench', price: 520, qty: 60, step: 10, unit: 'set', kind: 'part' },
    { code: 'COL-02', description: 'Collar, with the 2 mm key', note: 'The part that works loose', price: 45, qty: 100, step: 20, unit: 'ea', kind: 'part' },
    { code: 'FRT-KH', description: 'Freight, two pallets', note: 'At cost, quote attached', price: 3800, qty: 1, step: 1, unit: 'job', kind: 'freight' },
]);

const picked = ref('formosa');
const term = ref('30');

const money = (value) => `NT$${Math.round(value).toLocaleString('en-US')}`;

const customer = computed(() => customers.find((entry) => entry.key === picked.value));
const chosenTerm = computed(() => terms.find((entry) => entry.key === term.value));

const machines = computed(() => lines.value.filter((line) => line.kind === 'machine').reduce((sum, line) => sum + line.qty, 0));
const subtotal = computed(() => lines.value.reduce((sum, line) => sum + line.qty * line.price, 0));
const machineTotal = computed(() => lines.value.filter((line) => line.kind === 'machine').reduce((sum, line) => sum + line.qty * line.price, 0));
const discount = computed(() => (machines.value >= 50 ? Math.round(machineTotal.value * 0.03) : 0));
const taxable = computed(() => subtotal.value - discount.value);
const tax = computed(() => Math.round(taxable.value * customer.value.rate / 100));

const step = (line, direction) => {
    line.qty = Math.max(0, line.qty + line.step * direction);
};
</script>

<template>
    <InvoiceShell active="Writing one">
        <template #toolbar>
            <div class="mx-auto flex max-w-5xl flex-wrap items-center gap-3">
                <InvoiceStamp label="Draft" tone="draft" tilt="none" class="scale-90" />

                <span class="font-mono text-[10px] text-zinc-600">INV-2026-0208 · saved 40 seconds ago</span>

                <span class="ml-auto flex items-center gap-2">
                    <button type="button" class="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Save and come back</button>
                    <button type="button" class="rounded-lg bg-jade-500 px-3 py-1.5 text-[12px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Issue it</button>
                </span>
            </div>
        </template>

        <div class="mx-auto grid max-w-5xl grid-cols-1 gap-4 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)]">
            <div class="flex flex-col gap-4">
                <section class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                    <div class="flex items-baseline justify-between gap-3">
                        <h2 class="text-[15px] font-medium tracking-tight text-cream">Who it goes to</h2>
                        <span class="font-mono text-[10px] text-zinc-700">the tax treatment follows from this</span>
                    </div>

                    <div class="mt-4 flex flex-col gap-2">
                        <button
                            v-for="entry in customers"
                            :key="entry.key"
                            type="button"
                            class="flex items-start gap-3 rounded-xl border px-3.5 py-3 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            :class="picked === entry.key ? 'border-jade-500/50 bg-jade-500/8' : 'border-white/8 hover:border-white/20'"
                            @click="picked = entry.key"
                        >
                            <span class="mt-1 size-3.5 shrink-0 rounded-full border" :class="picked === entry.key ? 'border-jade-400 bg-jade-500' : 'border-white/15'"></span>

                            <span class="min-w-0 flex-1">
                                <span class="flex flex-wrap items-baseline gap-x-2">
                                    <span class="text-[13px] text-cream">{{ entry.name }}</span>
                                    <span class="font-mono text-[10px] text-zinc-600">{{ entry.meta }}</span>
                                </span>
                                <span class="mt-1 block font-mono text-[10px] text-jade-300">{{ entry.tax }}</span>
                            </span>

                            <span
                                class="shrink-0 rounded-lg border px-2 py-0.5 font-mono text-[10px]"
                                :class="entry.rate === 0 ? 'border-amber-400/30 text-amber-300' : 'border-white/10 text-zinc-500'"
                            >{{ entry.rate }}%</span>
                        </button>
                    </div>
                </section>

                <section class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                    <div class="flex items-baseline justify-between gap-3">
                        <h2 class="text-[15px] font-medium tracking-tight text-cream">What is on it</h2>
                        <span class="font-mono text-[10px] text-zinc-700">50 machines or more takes 3% off the machines</span>
                    </div>

                    <div class="mt-4 flex flex-col divide-y divide-white/5">
                        <div v-for="line in lines" :key="line.code" class="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
                            <div class="min-w-0 flex-1">
                                <p class="text-[13px]/5 text-cream">{{ line.description }}</p>
                                <p class="mt-0.5 text-[11px]/5 text-zinc-600">{{ line.note }}</p>
                                <p class="mt-1 font-mono text-[10px] text-zinc-700">{{ line.code }} · {{ money(line.price) }} each</p>
                            </div>

                            <div class="flex shrink-0 items-center gap-1.5">
                                <button type="button" aria-label="fewer" class="grid size-6 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70" @click="step(line, -1)">−</button>

                                <span class="w-14 text-center">
                                    <span class="block font-mono text-[13px] tabular-nums text-cream">{{ line.qty }}</span>
                                    <span class="block font-mono text-[9px] text-zinc-700">{{ line.unit }}</span>
                                </span>

                                <button type="button" aria-label="more" class="grid size-6 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70" @click="step(line, 1)">+</button>
                            </div>

                            <span class="w-24 shrink-0 text-right font-mono text-[12px] tabular-nums text-zinc-300">{{ money(line.qty * line.price) }}</span>
                        </div>
                    </div>

                    <button type="button" class="mt-4 w-full rounded-xl border border-dashed border-white/12 px-3 py-2.5 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:border-jade-500/50 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        Add a line · the last eleven invoices all used the same four
                    </button>
                </section>

                <section class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                    <div class="flex items-baseline justify-between gap-3">
                        <h2 class="text-[15px] font-medium tracking-tight text-cream">When it is due</h2>
                        <span class="font-mono text-[10px] text-zinc-700">issued 19 August 2026</span>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <button
                            v-for="entry in terms"
                            :key="entry.key"
                            type="button"
                            class="rounded-xl border px-3 py-2 text-[12px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            :class="term === entry.key ? 'border-jade-500/50 bg-jade-500/8 text-cream' : 'border-white/8 text-zinc-400 hover:border-white/20 hover:text-cream'"
                            @click="term = entry.key"
                        >{{ entry.label }}</button>
                    </div>

                    <p class="mt-3 text-[12px]/5 text-zinc-500">{{ chosenTerm.note }}</p>
                </section>
            </div>

            <div class="flex flex-col gap-4">
                <section class="overflow-hidden rounded-2xl border border-white/10 bg-ink-900">
                    <div class="flex items-baseline justify-between border-b border-white/8 px-5 py-3">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What the customer will get</p>
                        <p class="font-mono text-[10px] text-zinc-700">INV-2026-0208</p>
                    </div>

                    <div class="px-5 py-4">
                        <p class="text-[14px] font-medium tracking-tight text-cream">{{ customer.name }}</p>
                        <p class="mt-1 font-mono text-[10px] text-jade-300">{{ customer.tax }}</p>

                        <dl class="mt-4 flex flex-col gap-2 border-t border-white/6 pt-3">
                            <div class="flex items-baseline justify-between gap-4">
                                <dt class="text-[12px] text-zinc-500">Subtotal</dt>
                                <dd class="font-mono text-[12px] tabular-nums text-zinc-300">{{ money(subtotal) }}</dd>
                            </div>

                            <div v-if="discount > 0" class="flex items-baseline justify-between gap-4">
                                <dt class="text-[12px] text-zinc-500">Trade discount <span class="font-mono text-[10px] text-zinc-700">3%, machines</span></dt>
                                <dd class="font-mono text-[12px] tabular-nums text-zinc-400">−{{ money(discount) }}</dd>
                            </div>

                            <div class="flex items-baseline justify-between gap-4">
                                <dt class="text-[12px] text-zinc-500">{{ customer.rateLabel }}</dt>
                                <dd class="font-mono text-[12px] tabular-nums text-zinc-400">{{ money(tax) }}</dd>
                            </div>

                            <div class="flex items-baseline justify-between gap-4 border-t border-white/10 pt-3">
                                <dt class="text-[13px] text-zinc-300">Total</dt>
                                <dd class="font-mono text-lg font-semibold tracking-tight tabular-nums text-jade-300">{{ money(taxable + tax) }}</dd>
                            </div>
                        </dl>

                        <dl class="mt-4 flex flex-col gap-1.5 border-t border-white/6 pt-3">
                            <div class="flex items-baseline justify-between gap-4">
                                <dt class="font-mono text-[10px] text-zinc-700">terms</dt>
                                <dd class="font-mono text-[11px] text-zinc-400">Net {{ chosenTerm.key }}</dd>
                            </div>
                            <div class="flex items-baseline justify-between gap-4">
                                <dt class="font-mono text-[10px] text-zinc-700">due</dt>
                                <dd class="font-mono text-[11px] text-zinc-300">{{ chosenTerm.due }}</dd>
                            </div>
                            <div class="flex items-baseline justify-between gap-4">
                                <dt class="font-mono text-[10px] text-zinc-700">machines</dt>
                                <dd class="font-mono text-[11px] text-zinc-400">
                                    {{ machines >= 50 ? `${machines} · discount applies` : `${machines} · ${50 - machines} short of the discount` }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </section>

                <section class="rounded-2xl border border-amber-400/25 bg-amber-400/4 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-amber-300 uppercase">Before you press issue</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">{{ customer.note }}</p>
                </section>

                <section class="rounded-2xl border border-white/8 bg-ink-900/50 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What issuing actually does</p>
                    <ul class="mt-2.5 flex flex-col gap-1.5">
                        <li v-for="line in issuing" :key="line" class="flex gap-2 text-[11px]/5 text-zinc-500">
                            <span class="mt-1.5 size-1 shrink-0 rounded-full bg-zinc-700"></span>
                            {{ line }}
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </InvoiceShell>
</template>
