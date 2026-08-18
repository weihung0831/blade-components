<script setup>
import { computed, ref } from 'vue';
import LandingBar from './Bar.vue';
import LandingFeature from './Feature.vue';
import LandingShell from './Shell.vue';

const sets = [
    {
        key: 'spread',
        tab: 'Grind spread',
        title: 'How much of the grind lands where you aimed',
        blurb: 'One kilo of the same Colombian, ground at the setting each machine calls medium filter, sieved into six sizes. The number is the share that came out between 400 and 800 microns — the window a V60 wants. Higher is better and we do not win.',
        unit: '% in the window',
        rows: [
            { label: 'The NT$12,000 electric', value: 71, display: '71%', tone: 'quiet', note: 'Flat burrs and a motor that never slows down. This is what the money buys.' },
            { label: 'The Mk3, this one', value: 62, display: '62%', tone: 'ours', note: 'Nine points behind, at a third of the price. Whether nine points matter to you is a question the cup answers, not us.' },
            { label: 'The Mk2, discontinued 2024', value: 58, display: '58%', tone: 'warn', note: 'Same body, older burr geometry. Still on 6,000 counters and still fine.' },
            { label: 'The NT$1,450 aluminium one', value: 38, display: '38%', tone: 'bad', note: 'A third of it comes out as dust or gravel. Brand new, before anything has worn.' },
        ],
        foot: 'measured 4 Feb 2026 · 1 kg per machine, three runs each, sieve stack rented from the food lab on Minsheng',
    },
    {
        key: 'claims',
        tab: 'What breaks',
        title: 'Every warranty claim since 2019, by part',
        blurb: 'Eighty-nine months, 6,142 machines across the Mk2 and the Mk3, 832 claims. One part accounts for four in five of them and it is the one we have not managed to design out — the third attempt is in batch 41 and we will know by March whether it worked.',
        unit: 'claims',
        rows: [
            { label: 'Crank collar backs off', value: 681, display: '681', tone: 'bad', note: 'Two minutes with the key in the box. Annoying rather than serious, and it should not happen at all.' },
            { label: 'Burr seat wears oval', value: 92, display: '92', tone: 'warn', note: 'Almost all of them on machines past 400 kg of coffee. Replaced free, whatever the age.' },
            { label: 'Catch thread strips', value: 40, display: '40', tone: 'warn', note: 'Cross-threaded in a hurry, usually before breakfast. We send a new catch and say nothing.' },
            { label: 'Shaft bends', value: 12, display: '12', tone: 'quiet', note: 'Eleven of the twelve had been dropped. The twelfth we never explained.' },
            { label: 'Crank arm cracks', value: 7, display: '7', tone: 'quiet', note: 'All seven from the same 2023 casting run, all replaced before anyone asked.' },
        ],
        foot: 'claims to 31 Jul 2026 · a claim is anything we posted a part for, including the ones out of warranty',
    },
    {
        key: 'wear',
        tab: 'How long the burrs last',
        title: 'Kilos through the machine before the grind moves',
        blurb: 'We ran four sets to destruction, checking the spread every 50 kg. A burr set is finished when the window share drops below 50%, which for most people reading this is somewhere between four and seven years.',
        unit: 'kg before the window drops under 50%',
        rows: [
            { label: 'Set A, filter roasts only', value: 610, display: '610 kg', tone: 'ours', note: 'The gentlest life a burr set gets. Ended at 51% and we stopped the test.' },
            { label: 'Set B, mixed', value: 480, display: '480 kg', tone: 'ours', note: 'Filter in the morning, espresso at weekends. The one closest to how people actually live.' },
            { label: 'Set C, espresso only', value: 355, display: '355 kg', tone: 'warn', note: 'Fine settings wear the burr edge fastest. Grinding for a café would get you here in fourteen months.' },
            { label: 'Set D, one dropped machine', value: 120, display: '120 kg', tone: 'bad', note: 'Dropped onto tile from waist height at 90 kg, then run on. The seat never sat true again.' },
        ],
        foot: 'four sets, Sep 2024 to Jun 2026 · a replacement set is NT$780 and takes about four minutes to fit',
    },
];

const drops = [
    { when: 'Mar 2024', what: 'Waist height, tile, on the crank', outcome: 'Failed', detail: 'Crank arm sheared at the collar. The design we shipped the Mk2 with, and the reason the Mk3 slipped a month.', tone: 'bad' },
    { when: 'May 2024', what: 'Waist height, tile, on the crank', outcome: 'Failed', detail: 'Arm held, collar deformed. Better, still a machine you would have to send back.', tone: 'bad' },
    { when: 'Jul 2024', what: 'Waist height, tile, on the crank', outcome: 'Passed', detail: 'Thicker collar, softer pin. Cosmetic dent, grind unchanged at 61%. This is the part in every machine since.', tone: 'ok' },
    { when: 'Jul 2024', what: 'Waist height, tile, on the body', outcome: 'Passed', detail: 'Dented, ran fine. The dent is on the machine at the front of the bench if you want to see it.', tone: 'ok' },
    { when: 'Jul 2024', what: 'Head height, concrete', outcome: 'Failed', detail: 'Body split. We did not redesign for this one — a grinder that survives head height onto concrete would weigh twice what anybody wants to carry.', tone: 'warn' },
];

const method = [
    { mark: 'method', title: 'Who measured it and with what', body: 'Sieve stack borrowed from the food science lab on Minsheng East Road, calibrated in January. Three runs per machine, the middle one reported. The bench sheets are scans of paper, handwriting and all.', meta: 'ask for the scans, we will send them' },
    { mark: 'conflict', title: 'We paid for the machines we lost to', body: 'The electric and the aluminium grinder were bought at retail, by us, no discount and nobody told. Neither maker knows this page exists.', meta: 'receipts on the same sheets', tone: 'caveat' },
    { mark: 'stale', title: 'What is out of date here', body: 'The spread test predates the batch 40 burr change, which our own runs say is worth a point or two. We will not claim it until the next full test in October.', meta: 'next measurement, w/c 5 Oct', tone: 'primary' },
];

const outcomes = {
    bad: 'border-red-400/30 text-red-400',
    warn: 'border-amber-400/30 text-amber-300',
    ok: 'border-jade-500/30 text-jade-300',
};

const tab = ref('spread');

const set = computed(() => sets.find((entry) => entry.key === tab.value));
const ceiling = computed(() => Math.max(...set.value.rows.map((row) => row.value)));
</script>

<template>
    <LandingShell active="The measurements" ribbon="Every figure below was measured in the workshop. The method is at the bottom of the page.">
        <div class="mx-auto max-w-5xl">
            <header class="max-w-2xl">
                <p class="flex items-center gap-2 font-mono text-[11px] tracking-wider text-jade-400 uppercase">
                    <span class="h-px w-6 bg-jade-500/50"></span>
                    what we can prove
                </p>
                <h1 class="mt-4 text-3xl leading-[1.15] font-semibold tracking-tight text-balance text-cream">Three sets of numbers, one of which we lose.</h1>
                <p class="mt-4 text-[14px]/7 text-zinc-400">
                    Grinder marketing runs on adjectives because adjectives cannot be checked. These can. Below is the grind
                    spread against three other machines, every warranty claim since 2019 sorted by which part gave up, and
                    what four burr sets did before they were finished.
                </p>
            </header>

            <section class="mt-10">
                <div class="flex w-fit flex-wrap items-center gap-1 rounded-xl border border-white/8 bg-ink-900/60 p-1">
                    <button
                        v-for="entry in sets"
                        :key="entry.key"
                        type="button"
                        class="rounded-lg px-3 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="tab === entry.key ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:text-cream'"
                        @click="tab = entry.key"
                    >{{ entry.tab }}</button>
                </div>

                <div class="mt-5">
                    <div class="flex flex-wrap items-end justify-between gap-3">
                        <div class="max-w-xl">
                            <h2 class="text-[15px] font-medium tracking-tight text-cream">{{ set.title }}</h2>
                            <p class="mt-1.5 text-[12px]/5 text-zinc-500">{{ set.blurb }}</p>
                        </div>
                        <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ set.unit }}</span>
                    </div>

                    <div class="mt-6 flex flex-col gap-5 rounded-2xl border border-white/8 bg-ink-950 p-5">
                        <LandingBar v-for="row in set.rows" :key="row.label" v-bind="row" :max="ceiling" />
                    </div>

                    <p class="mt-3 font-mono text-[10px] text-zinc-700">{{ set.foot }}</p>
                </div>
            </section>

            <section class="mt-14">
                <div class="flex items-baseline gap-3">
                    <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">The drop test, including the two it failed</h2>
                    <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                    <span class="shrink-0 font-mono text-[10px] text-zinc-700">five drops, 2024</span>
                </div>

                <div class="mt-4 overflow-hidden rounded-2xl border border-white/8 bg-ink-950">
                    <div
                        v-for="(drop, index) in drops"
                        :key="`${drop.when}-${drop.what}`"
                        class="flex flex-col gap-2 px-4 py-3.5 sm:flex-row sm:items-baseline sm:gap-5"
                        :class="index > 0 ? 'border-t border-white/5' : ''"
                    >
                        <span class="shrink-0 font-mono text-[10px] text-zinc-700 sm:w-20">{{ drop.when }}</span>

                        <div class="min-w-0 flex-1">
                            <p class="text-[13px]/5 text-cream">{{ drop.what }}</p>
                            <p class="mt-1 text-[12px]/5 text-zinc-500">{{ drop.detail }}</p>
                        </div>

                        <span class="inline-flex shrink-0 items-center gap-1.5 rounded-lg border px-2 py-0.5 font-mono text-[10px] uppercase" :class="outcomes[drop.tone]">{{ drop.outcome }}</span>
                    </div>
                </div>
            </section>

            <section class="mt-12 grid grid-cols-1 gap-3 lg:grid-cols-3">
                <LandingFeature v-for="card in method" :key="card.title" v-bind="card" />
            </section>

            <section class="mt-12 rounded-2xl border border-white/8 bg-ink-900/50 p-5">
                <h2 class="text-[15px] font-medium tracking-tight text-cream">The part of this page that argues against us</h2>
                <p class="mt-2 max-w-2xl text-[13px]/6 text-zinc-400">
                    If you grind espresso every day, the electric is nine points better and pays that back in four years of
                    mornings. If you grind one filter cup a day, the nine points are inside the range that the beans, the water
                    and how awake you are already move it by. That is the whole argument, and it is the reason the comparison
                    sits on our own site rather than someone else's forum.
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <a href="/templates/landing/screens/objections" target="_top" class="inline-flex items-center gap-2 rounded-xl border border-white/10 px-4 py-2.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Five people who should buy the electric</a>
                    <span class="font-mono text-[10px] text-zinc-700">we name it, and where to get it</span>
                </div>
            </section>
        </div>
    </LandingShell>
</template>
