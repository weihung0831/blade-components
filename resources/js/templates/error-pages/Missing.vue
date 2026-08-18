<script setup>
import { computed, ref } from 'vue';
import ErrorPagesCode from './Code.vue';
import ErrorPagesMoved from './Moved.vue';
import ErrorPagesRoute from './Route.vue';
import ErrorPagesShell from './Shell.vue';

const gone = {
    address: '/shop/grinders/nomad-hand-grinder-mk2',
    was: 'The Mk2 hand grinder, sold from March 2022 to November 2024',
    happened: 'Discontinued when the burr supplier stopped making the 38mm set. We kept the page up for a year with a note on it, then the tidy-up in March took it down along with 40 others.',
    now: 'The Mk3, same body, burrs you can still buy in 2030',
    when: 'gone 14 Nov 2024',
    hits: '1,284 asks since March',
};

const nearest = [
    { address: '/shop/grinders/nomad-hand-grinder-mk3', was: 'Mk3 hand grinder — NT$4,200', happened: 'The one the Mk2 turned into. Same 38mm body, a burr set three suppliers make, and it takes the Mk2 crank if you kept yours.', now: 'In stock, ships from Taipei tomorrow', when: 'live since Nov 2024' },
    { address: '/parts/mk2-burr-set', was: 'Mk2 burr set, 38mm', happened: 'Still sold, and will be until the last of the 900 sets goes. This is the page most people who land on the Mk2 are actually after.', now: 'NT$780, 312 sets left', when: 'still here', hits: '410 asks since March' },
    { address: '/support/mk2-crank-wobble', was: 'The Mk2 crank wobble, and the two minutes it takes to fix', happened: 'Kept alive on purpose. There are 6,000 Mk2s out there and the collar works loose on all of them eventually.', now: 'Read the fix', when: 'still here' },
    { address: '/shop/grinders/nomad-electric', was: 'The electric grinder we announced in 2023', happened: 'Never shipped. The page went up two weeks before we admitted it was not going to work, and stayed up for four months after.', now: 'Why it was dropped, written out', when: 'gone 2 Feb 2024' },
];

const ways = [
    { label: 'Search the shop for "nomad hand grinder"', note: 'Three matches, and the top one is the Mk3.', meta: '3 matches', tone: 'primary' },
    { label: 'Every grinder we sell, eleven of them', note: 'Sorted by burr size rather than price, because that is what people actually pick on.', meta: '11' },
    { label: 'The parts shelf', note: 'Burrs, cranks, collars and seals for everything back to 2019, including the two machines we stopped selling.', meta: '84 parts' },
    { label: 'Ask Ana at the desk', note: 'Keeps the old paper catalogue on the wall and can place a discontinued code from memory. Answers inside four hours on a weekday.', meta: 'weekdays' },
];

const lines = [
    { label: 'you asked for', value: 'nomadsupply.tw/shop/grinders/nomad-hand-grinder-mk2' },
    { label: 'you came from', value: 'a printed catalogue, autumn 2024 — no referrer' },
    { label: 'asked for', value: '1,284 times since March, 900 of them off that catalogue' },
];

const query = ref('');

const terms = (entry) => `${entry.was ?? ''} ${entry.address} ${entry.now ?? ''}`.toLowerCase();

const shown = computed(() => {
    const words = query.value.toLowerCase().split(/\s+/).filter(Boolean);

    return nearest.filter((entry) => words.every((word) => terms(entry).includes(word)));
});
</script>

<template>
    <ErrorPagesShell active="Nothing here" state="ok" reference="req_9f4c21a8 · 404">
        <template #toolbar>
            <div class="mx-auto flex max-w-3xl items-center gap-3">
                <label class="flex min-w-0 flex-1 items-center gap-2 rounded-lg border border-white/10 bg-ink-900 px-2.5 py-1.5 focus-within:border-jade-500/60">
                    <svg class="size-3.5 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    <input v-model="query" type="search" placeholder="What were you after? Try &quot;burr&quot; or &quot;mk2&quot;"
                        class="min-w-0 flex-1 bg-transparent text-[13px] text-cream outline-none placeholder:text-zinc-700">
                </label>

                <span class="shrink-0 font-mono text-[10px] text-zinc-600">{{ shown.length }} of {{ nearest.length }}</span>
            </div>
        </template>

        <div class="mx-auto max-w-3xl">
            <ErrorPagesCode
                code="404"
                stamp="nothing at this address"
                headline="This page has been gone since November 2024, and we know exactly what it was"
                sentence="A 404 that only says the page is missing wastes the one thing we have — a record of what used to be here. Below is the product that stood at this address, why it went, and what it turned into."
                :lines="lines" />

            <section class="mt-9">
                <div class="flex items-baseline gap-3">
                    <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What stood here</h2>
                    <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                </div>

                <div class="mt-3 overflow-hidden rounded-xl border border-jade-500/25 bg-jade-500/4">
                    <ErrorPagesMoved v-bind="gone" href="#" />
                </div>
            </section>

            <section class="mt-8">
                <div class="flex items-baseline gap-3">
                    <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">The nearest four</h2>
                    <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                    <span class="shrink-0 font-mono text-[10px] text-zinc-700">matched on the words in the address</span>
                </div>

                <div v-if="shown.length" class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                    <ErrorPagesMoved v-for="entry in shown" :key="entry.address" v-bind="entry" href="#" />
                </div>

                <p v-else class="mt-3 rounded-xl border border-white/8 bg-ink-900 px-3.5 py-8 text-center text-[12px] text-zinc-600">
                    Nothing on the shelf matches that. Ana at the desk keeps the paper catalogue and can usually place an old code from memory.
                </p>
            </section>

            <section class="mt-8">
                <div class="flex items-baseline gap-3">
                    <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">Ways out</h2>
                    <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                </div>

                <div class="mt-3 flex flex-col gap-2">
                    <ErrorPagesRoute v-for="way in ways" :key="way.label" v-bind="way" href="#" />
                </div>
            </section>

            <section class="mt-8 rounded-xl border border-white/8 bg-ink-900 p-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If a link on our own site sent you here</p>
                <p class="mt-2 text-[12px]/5 text-zinc-400">
                    Then it is ours to fix, not yours to work around. The button sends the page you came from along with this
                    address, and nothing else. Eleven of these came in last month and nine were our own stale links — two in the
                    footer, which had been wrong since the shop moved in January.
                </p>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <button type="button" class="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Report the link that sent me</button>
                    <span class="font-mono text-[10px] text-zinc-700">no account needed, no reply unless you ask for one</span>
                </div>
            </section>
        </div>
    </ErrorPagesShell>
</template>
