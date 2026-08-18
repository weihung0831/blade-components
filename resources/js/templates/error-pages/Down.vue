<script setup>
import { computed, ref } from 'vue';
import ErrorPagesCode from './Code.vue';
import ErrorPagesRoute from './Route.vue';
import ErrorPagesService from './Service.vue';
import ErrorPagesShell from './Shell.vue';

const services = [
    { name: 'The shop front', state: 'normal', means: "Serving yesterday evening's copy of every page. Prices and stock counts are as of 22:40, so treat them as roughly right.", since: 'cached' },
    { name: 'The basket', state: 'normal', means: 'Fills and remembers itself. It just cannot turn into an order until we are back.' },
    { name: 'Checkout', state: 'off', means: 'Off since 03:00. Anything you try goes into the held queue rather than failing.', since: '79 min' },
    { name: 'The admin', state: 'off', means: 'Off entirely. This is the part the work is being done on.', since: '79 min' },
    { name: 'Card payments', state: 'off', means: 'Not taken while checkout is down. Nothing is authorised and nothing is charged.', since: '79 min' },
    { name: 'Webhooks out', state: 'off', means: 'Queued, not dropped. They go out in the order they happened once we are up.', since: '79 min' },
    { name: 'Order emails', state: 'off', means: 'Queued behind the webhooks.', since: '79 min' },
    { name: 'The desk', state: 'normal', means: 'Wei is on call and reading. Ana is back at 08:00.' },
    { name: 'This page', state: 'normal', means: 'Served from somewhere else entirely, which is why it stays up when nothing else does.' },
];

const queued = [
    { label: 'Orders held', value: '41', note: 'Taken and kept. They become real orders in the order they arrived, and the first mail goes out inside a minute of us being back.' },
    { label: 'Webhooks to retry', value: '1,208', note: 'Sent oldest first, at 40 a second, so a busy shop is caught up inside a minute.' },
    { label: 'Emails waiting', value: '96', note: 'Confirmations and shipping notes. Nobody gets two.' },
    { label: 'Imports paused', value: '3', note: 'Mid-flight when we started. They pick up from the last row rather than the first.' },
];

const windows = [
    { date: '18 Aug 2026', what: 'Order table rewritten so freight is an object', planned: 60, actual: 79, over: true, note: 'Running now. Three shops with more than 40,000 orders each are the whole of the overrun — the migration walks them row by row and there is no way to hurry it.' },
    { date: '27 Jul 2026', what: 'Database moved to the new machine', planned: 90, actual: 74 },
    { date: '29 Jun 2026', what: 'Search index rebuilt from scratch', planned: 45, actual: 41 },
    { date: '25 May 2026', what: 'Payment provider cut over', planned: 30, actual: 121, over: true, note: 'The bad one. Their sandbox and their live system disagreed about one field, and we found out at 03:30 with everything off. We now do these on a Tuesday morning with the old provider still wired up.' },
    { date: '27 Apr 2026', what: 'Storage moved to Taipei', planned: 60, actual: 52 },
    { date: '30 Mar 2026', what: 'Certificates and the load balancer', planned: 20, actual: 18 },
    { date: '24 Feb 2026', what: 'Stock counts rebuilt from the ledger', planned: 45, actual: 44 },
    { date: '26 Jan 2026', what: 'Order table indexes', planned: 30, actual: 22 },
    { date: '24 Nov 2025', what: 'Framework upgrade', planned: 60, actual: 55 },
    { date: '27 Oct 2025', what: 'Invoice numbering, ahead of the tax year', planned: 30, actual: 26 },
    { date: '29 Sep 2025', what: 'Image pipeline', planned: 45, actual: 38 },
    { date: '25 Aug 2025', what: 'Webhook delivery log', planned: 30, actual: 31 },
];

const lines = [
    { label: 'went off at', value: '03:00 GMT+8, announced 12 days ago' },
    { label: 'we said', value: 'back by 04:00' },
    { label: 'best guess now', value: '04:40, and we will say so again at 04:35' },
];

const over = windows.filter((entry) => entry.over).length;

const filter = ref('all');

const shown = computed(() => (filter.value === 'over' ? windows.filter((entry) => entry.over) : windows));

const width = (entry) => Math.min(100, Math.round((entry.actual / 130) * 100));
const mark = (entry) => Math.min(100, Math.round((entry.planned / 130) * 100));
</script>

<template>
    <ErrorPagesShell active="Off on purpose" state="off" reference="maint_2026_08_18 · 503">
        <template #toolbar>
            <div class="mx-auto flex max-w-3xl flex-wrap items-center gap-x-4 gap-y-2">
                <span class="flex items-center gap-1.5 font-mono text-[11px] text-amber-300">
                    <span class="size-1.5 rounded-full bg-amber-400"></span>
                    19 minutes past the hour we asked for
                </span>

                <span class="flex min-w-40 flex-1 items-center gap-2">
                    <span class="h-1 min-w-0 flex-1 overflow-hidden rounded-full bg-white/8">
                        <span class="block h-full w-full rounded-full bg-amber-400/60"></span>
                    </span>
                    <span class="shrink-0 font-mono text-[10px] text-amber-300">79 / 60 min</span>
                </span>

                <span class="font-mono text-[10px] text-zinc-600">next update 04:35</span>
            </div>
        </template>

        <div class="mx-auto max-w-3xl">
            <ErrorPagesCode
                code="503"
                tone="off"
                stamp="off on purpose, and running late"
                headline="We said an hour. It has been seventy-nine minutes, and here is what is taking the extra nineteen."
                sentence="The order table is being rewritten one shop at a time. Eleven of the fourteen are done. The three left are the big ones, and the migration walks them row by row — nothing has gone wrong, it is simply slower than we costed it."
                :lines="lines" />

            <div class="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-2">
                <section>
                    <div class="flex items-baseline gap-3">
                        <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What still works</h2>
                        <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                        <span class="shrink-0 font-mono text-[10px] text-zinc-700">4 of 9</span>
                    </div>

                    <div class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <ErrorPagesService v-for="service in services" :key="service.name" v-bind="service" />
                    </div>
                </section>

                <section>
                    <div class="flex items-baseline gap-3">
                        <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What is stacking up</h2>
                        <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                    </div>

                    <div class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <div v-for="row in queued" :key="row.label" class="flex items-start gap-3 px-3.5 py-3">
                            <span class="w-14 shrink-0 pt-0.5 text-right font-mono text-[15px] tabular-nums text-cream">{{ row.value }}</span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-[13px]/5 text-zinc-300">{{ row.label }}</span>
                                <span class="mt-1 block text-[11px]/5 text-zinc-500">{{ row.note }}</span>
                            </span>
                        </div>
                    </div>

                    <p class="mt-3 rounded-xl border border-white/8 bg-ink-900 px-3.5 py-3 text-[11px]/5 text-zinc-500">
                        Nothing in that list is at risk. The queue is on disk on a machine that is not part of tonight's work,
                        and it has survived every entry on the board below, including the two-hour one in May.
                    </p>
                </section>
            </div>

            <section class="mt-8">
                <div class="flex flex-wrap items-baseline gap-3">
                    <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">The last twelve windows</h2>
                    <span class="h-px min-w-0 flex-1 bg-white/6"></span>

                    <span class="flex shrink-0 items-center gap-1">
                        <button
                            v-for="option in [{ key: 'all', label: 'all twelve' }, { key: 'over', label: `the ${over} that ran over` }]"
                            :key="option.key"
                            type="button"
                            @click="filter = option.key"
                            class="rounded-lg px-2 py-0.5 font-mono text-[10px] transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            :class="filter === option.key ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-500'"
                        >{{ option.label }}</button>
                    </span>
                </div>

                <div class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                    <div v-for="entry in shown" :key="entry.date" class="px-3.5 py-3" :class="entry.over ? 'bg-amber-400/4' : ''">
                        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                            <span class="w-24 shrink-0 font-mono text-[11px] text-zinc-600">{{ entry.date }}</span>
                            <span class="min-w-0 flex-1 text-[13px]/5 text-cream">{{ entry.what }}</span>
                            <span class="shrink-0 font-mono text-[10px] tabular-nums" :class="entry.over ? 'text-amber-300' : 'text-zinc-600'">
                                {{ entry.actual }} min of the {{ entry.planned }} we asked for
                            </span>
                        </div>

                        <div class="relative mt-2 h-1 overflow-hidden rounded-full bg-white/6">
                            <span class="absolute inset-y-0 left-0 rounded-full" :class="entry.over ? 'bg-amber-400/70' : 'bg-jade-500/50'" :style="{ width: `${width(entry)}%` }"></span>
                            <span class="absolute inset-y-0 w-px bg-white/50" :style="{ left: `${mark(entry)}%` }"></span>
                        </div>

                        <p v-if="entry.note" class="mt-2 text-[11px]/5 text-zinc-500">{{ entry.note }}</p>
                    </div>
                </div>

                <p class="mt-3 text-[11px]/5 text-zinc-600">
                    The pale line on each bar is the time we asked for. Two of twelve went past it, and both are written out
                    rather than rounded down — a maintenance page that has only ever finished on time is a maintenance page
                    nobody is checking.
                </p>
            </section>

            <section class="mt-8 flex flex-col gap-2">
                <ErrorPagesRoute
                    tone="primary"
                    label="Mail me the moment it is back"
                    note="One mail, sent to everybody waiting at the same time. 210 people are on it tonight."
                    meta="one mail"
                    href="#" />

                <ErrorPagesRoute
                    label="What is being done, in detail"
                    note="The migration, why freight became an object, and the sixteen lines every shop reading our API has to change before February."
                    meta="4 min read"
                    href="#" />

                <ErrorPagesRoute
                    label="Ring Wei, who is holding this"
                    note="02 2771 4180. Worth it if you have an order that has to move tonight — there is a way to push one through by hand."
                    meta="on call until 08:00"
                    href="#" />
            </section>
        </div>
    </ErrorPagesShell>
</template>
