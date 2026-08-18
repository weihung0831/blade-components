<script setup>
import { computed, ref } from 'vue';
import LandingBar from './Bar.vue';
import LandingShell from './Shell.vue';

const finishes = [
    { key: 'graphite', name: 'Graphite', swatch: 'bg-finish-graphite', left: 28, ships: 'w/c 12 Oct', note: 'The anodised black. Nine in ten machines we have ever made, and the one that hides a dropped-on-tile dent best.' },
    { key: 'cream', name: 'Cream', swatch: 'bg-finish-cream', left: 11, ships: 'w/c 19 Oct', note: 'A week behind the others because the coating shop runs light colours last. Shows coffee oil at the catch thread until you learn to wipe it.' },
    { key: 'jade', name: 'Jade', swatch: 'bg-finish-jade', left: 7, ships: 'w/c 26 Oct', note: 'Thirty machines a batch, seven left, and the only one that has ever sold out before the batch was cut. It is the same machine underneath.' },
];

const steps = [
    { when: '2 Sep', title: 'The list closes and the batch is cut', body: 'Cards are charged that morning. Anyone who has changed their mind before then pays nothing and does not have to say why.', state: 'next' },
    { when: '8 Sep', title: 'Castings land from Taichung', body: '190 bodies for 180 machines. The ten spare are the margin the last four batches say we need.', state: 'later' },
    { when: '15 Sep – 3 Oct', title: 'Anodising, in three colour runs', body: 'The coating shop takes graphite first and cream last. This is where batch 39 lost eight of its eleven weeks.', state: 'later' },
    { when: '6 – 9 Oct', title: 'Assembly, four of us at the bench', body: 'About 45 machines a day. Every one is ground with 25 g of the house filter roast before it is boxed, and the sheet goes in the box.', state: 'later' },
    { when: 'w/c 12 Oct', title: 'Boxes leave, graphite first', body: 'Taiwan next day, everywhere else four to nine days. Tracking goes out the afternoon the box is picked up.', state: 'later' },
];

const history = [
    { batch: '40', cut: 'Mar 2026', made: 180, promised: 'w/c 20 Apr', shipped: 'w/c 20 Apr', slip: 'on the day', tone: 'ok' },
    { batch: '39', cut: 'Oct 2025', made: 180, promised: 'w/c 24 Nov', shipped: 'w/c 9 Feb', slip: '11 weeks late', tone: 'bad' },
    { batch: '38', cut: 'Jun 2025', made: 150, promised: 'w/c 21 Jul', shipped: 'w/c 28 Jul', slip: '1 week late', tone: 'warn' },
    { batch: '37', cut: 'Feb 2025', made: 150, promised: 'w/c 24 Mar', shipped: 'w/c 24 Mar', slip: 'on the day', tone: 'ok' },
    { batch: '36', cut: 'Oct 2024', made: 150, promised: 'w/c 25 Nov', shipped: 'w/c 2 Dec', slip: '1 week late', tone: 'warn' },
];

const slips = {
    ok: 'border-jade-500/30 text-jade-300',
    warn: 'border-amber-400/30 text-amber-300',
    bad: 'border-red-400/30 text-red-400',
};

const opening = [
    ['list closes', '2 Sep 2026'],
    ['charged', 'that morning'],
    ['price', 'NT$4,200'],
];

const picked = ref('graphite');

const finish = computed(() => finishes.find((entry) => entry.key === picked.value));
</script>

<template>
    <LandingShell active="The next batch" ribbon="Batch 41 closes on 2 September. Nothing is charged before that morning.">
        <div class="mx-auto max-w-5xl">
            <header class="flex flex-wrap items-end justify-between gap-6">
                <div class="max-w-xl">
                    <p class="flex items-center gap-2 font-mono text-[11px] tracking-wider text-jade-400 uppercase">
                        <span class="h-px w-6 bg-jade-500/50"></span>
                        batch 41 of 41
                    </p>
                    <h1 class="mt-4 text-3xl leading-[1.15] font-semibold tracking-tight text-balance text-cream">180 machines, 46 places, and the eleven weeks we ran late last autumn.</h1>
                    <p class="mt-4 text-[14px]/7 text-zinc-400">
                        We make grinders in batches because four people and one anodising shop cannot do it any other way. The
                        dates below are what we believe. The table at the bottom is what actually happened the last five times
                        we believed something.
                    </p>
                </div>

                <div class="w-full shrink-0 rounded-2xl border border-white/8 bg-ink-900/60 p-4 sm:w-72">
                    <LandingBar
                        label="Spoken for"
                        :value="134"
                        :max="180"
                        display="134 / 180"
                        tone="ours"
                        note="Batch 40 filled with nine days to spare. Batch 39 filled in four." />

                    <dl class="mt-4 flex flex-col gap-2 border-t border-white/6 pt-3">
                        <div v-for="row in opening" :key="row[0]" class="flex items-baseline justify-between gap-2">
                            <dt class="text-[11px] text-zinc-600">{{ row[0] }}</dt>
                            <dd class="font-mono text-[11px] text-zinc-400">{{ row[1] }}</dd>
                        </div>
                    </dl>
                </div>
            </header>

            <section class="mt-12 grid grid-cols-1 gap-3 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,1fr)]">
                <div class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">Pick a finish, then leave an address</h2>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-500">The finish decides which week your box goes out, because the coating shop runs one colour at a time.</p>

                    <div class="mt-5 flex flex-col gap-2">
                        <button
                            v-for="entry in finishes"
                            :key="entry.key"
                            type="button"
                            class="flex items-center gap-3 rounded-xl border px-3.5 py-3 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            :class="picked === entry.key ? 'border-jade-500/50 bg-jade-500/8' : 'border-white/8 hover:border-white/20'"
                            @click="picked = entry.key"
                        >
                            <span class="size-6 shrink-0 rounded-full border border-white/15" :class="entry.swatch"></span>

                            <span class="min-w-0 flex-1">
                                <span class="flex items-baseline gap-2">
                                    <span class="text-[13px] text-cream">{{ entry.name }}</span>
                                    <span class="font-mono text-[10px] text-zinc-600">{{ entry.left }} left</span>
                                </span>
                                <span class="mt-0.5 block text-[11px]/5 text-zinc-500">ships {{ entry.ships }}</span>
                            </span>

                            <span class="size-4 shrink-0 rounded-full border" :class="picked === entry.key ? 'border-jade-400 bg-jade-500' : 'border-white/15'"></span>
                        </button>
                    </div>

                    <div class="mt-5 flex flex-col gap-2.5 border-t border-white/6 pt-5">
                        <label class="flex flex-col gap-1.5">
                            <span class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where the mail goes</span>
                            <input type="email" placeholder="you@example.com" class="rounded-xl border border-white/10 bg-ink-900 px-3 py-2.5 text-[13px] text-cream outline-none transition-colors duration-150 placeholder:text-zinc-700 focus:border-jade-500/60">
                        </label>

                        <label class="flex items-start gap-2.5 py-1">
                            <input type="checkbox" checked class="mt-0.5 size-3.5 shrink-0 accent-jade-500">
                            <span class="text-[11px]/5 text-zinc-500">Tell me if the dates move. Two mails last batch, both of them bad news, both sent the day we knew.</span>
                        </label>

                        <button type="button" class="mt-1 inline-flex items-center justify-center gap-2 rounded-xl bg-jade-500 px-4 py-2.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                            Hold a {{ finish.name }} in batch 41
                        </button>

                        <p class="font-mono text-[10px] text-zinc-700">no card taken now · leave the list any time before 2 Sep</p>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <div class="rounded-2xl border border-jade-500/25 bg-jade-500/5 p-5">
                        <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">What you would be holding</p>

                        <dl class="mt-3 flex flex-col gap-2.5">
                            <div class="flex items-baseline justify-between gap-3 border-b border-white/6 pb-2.5">
                                <dt class="text-[12px] text-zinc-500">finish</dt>
                                <dd class="font-mono text-[12px] text-cream">{{ finish.name }}</dd>
                            </div>

                            <div class="flex items-baseline justify-between gap-3 border-b border-white/6 pb-2.5">
                                <dt class="text-[12px] text-zinc-500">ships</dt>
                                <dd class="font-mono text-[12px] text-cream">{{ finish.ships }}</dd>
                            </div>

                            <div class="flex items-baseline justify-between gap-3 border-b border-white/6 pb-2.5">
                                <dt class="text-[12px] text-zinc-500">left in that colour</dt>
                                <dd class="font-mono text-[12px] text-cream">{{ finish.left }} of 180</dd>
                            </div>

                            <div class="flex items-baseline justify-between gap-3">
                                <dt class="text-[12px] text-zinc-500">price</dt>
                                <dd class="font-mono text-[12px] text-cream">NT$4,200</dd>
                            </div>
                        </dl>

                        <p class="mt-4 border-t border-white/6 pt-3 text-[12px]/5 text-zinc-400">{{ finish.note }}</p>
                    </div>

                    <div class="rounded-2xl border border-white/8 bg-ink-900/50 p-5">
                        <h3 class="text-[13px] font-medium tracking-tight text-cream">If the jade runs out while you are reading this</h3>
                        <p class="mt-1.5 text-[12px]/5 text-zinc-500">
                            The page will say so and your place moves to graphite unless you tell us otherwise. We do not hold
                            colours back to make a number look small — the seven are seven.
                        </p>
                    </div>
                </div>
            </section>

            <section class="mt-14">
                <div class="flex items-baseline gap-3">
                    <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What happens between the money and the box</h2>
                    <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                    <span class="shrink-0 font-mono text-[10px] text-zinc-700">six weeks, if nothing goes wrong</span>
                </div>

                <ol class="mt-5 flex flex-col">
                    <li v-for="(step, index) in steps" :key="step.title" class="flex gap-4">
                        <div class="flex shrink-0 flex-col items-center">
                            <span class="mt-1 size-2.5 rounded-full border" :class="step.state === 'next' ? 'border-jade-400 bg-jade-500' : 'border-white/20 bg-ink-900'"></span>
                            <span v-if="index < steps.length - 1" class="w-px flex-1 bg-white/8"></span>
                        </div>

                        <div class="min-w-0 flex-1" :class="index < steps.length - 1 ? 'pb-6' : ''">
                            <div class="flex flex-wrap items-baseline gap-x-3">
                                <span class="font-mono text-[11px] text-jade-300">{{ step.when }}</span>
                                <h3 class="text-[13px]/5 text-cream">{{ step.title }}</h3>
                            </div>
                            <p class="mt-1.5 max-w-2xl text-[12px]/5 text-zinc-500">{{ step.body }}</p>
                        </div>
                    </li>
                </ol>
            </section>

            <section class="mt-12">
                <div class="flex flex-wrap items-end justify-between gap-3">
                    <div class="max-w-lg">
                        <h2 class="text-[15px] font-medium tracking-tight text-cream">The last five times we gave a date</h2>
                        <p class="mt-1.5 text-[12px]/5 text-zinc-500">
                            Two on the day, two a week out, and one that went eleven weeks over because the anodising shop lost a
                            line for a month and we did not have a second one. We do now.
                        </p>
                    </div>
                    <span class="shrink-0 font-mono text-[10px] text-zinc-700">batches 36 – 40</span>
                </div>

                <div class="mt-4 overflow-x-auto rounded-2xl border border-white/8 bg-ink-950">
                    <table class="w-full min-w-lg border-collapse text-left">
                        <thead>
                            <tr class="border-b border-white/8">
                                <th v-for="head in ['batch', 'cut', 'machines', 'promised', 'shipped', ' ']" :key="head" class="px-4 py-2.5 font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">{{ head }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in history" :key="row.batch" :class="index > 0 ? 'border-t border-white/5' : ''">
                                <td class="px-4 py-3 font-mono text-[12px] text-cream">{{ row.batch }}</td>
                                <td class="px-4 py-3 text-[12px] text-zinc-500">{{ row.cut }}</td>
                                <td class="px-4 py-3 font-mono text-[12px] tabular-nums text-zinc-400">{{ row.made }}</td>
                                <td class="px-4 py-3 font-mono text-[12px] text-zinc-500">{{ row.promised }}</td>
                                <td class="px-4 py-3 font-mono text-[12px] text-zinc-300">{{ row.shipped }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-lg border px-2 py-0.5 font-mono text-[10px]" :class="slips[row.tone]">{{ row.slip }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="mt-3 font-mono text-[10px] text-zinc-700">everybody on batch 39 was offered their money back at week four, week seven and week ten · 14 of 180 took it</p>
            </section>
        </div>
    </LandingShell>
</template>
