<script setup>
import { computed, ref } from 'vue';
import OnboardingShell from './Shell.vue';
import OnboardingFunnel from './Funnel.vue';

const ranges = [
    { key: 'year', label: 'Last 12 months' },
    { key: 'march', label: 'Since the March cut' },
];

const stages = [
    { key: 'signup', step: 'Signed up', year: { reached: 1847, lost: 35, minutes: 0.4 }, march: { reached: 892, lost: 14, minutes: 0.4 }, claimed: null, note: 'Mail confirmed, workspace made. The clock starts here.' },
    { key: 'shop', step: 'The shop', year: { reached: 1812, lost: 163, minutes: 2 }, march: { reached: 878, lost: 75, minutes: 2 }, claimed: 2, note: 'Four fields. Nobody has ever complained about this step and nobody ever will.' },
    { key: 'region', step: 'Where it lives', year: { reached: 1649, lost: 264, minutes: 4 }, march: { reached: 803, lost: 113, minutes: 4 }, claimed: 1, note: 'One radio button, four minutes. People leave to go and ask somebody whether it matters, and 63% come back.' },
    { key: 'catalog', step: 'The catalog', year: { reached: 1385, lost: 84, minutes: 19 }, march: { reached: 690, lost: 39, minutes: 19 }, claimed: 8, worst: true, note: 'The longest step by a factor of three, and the one we told people would take eight minutes for two years.' },
    { key: 'people', step: 'The others', year: { reached: 1301, lost: 121, minutes: 3 }, march: { reached: 651, lost: 50, minutes: 3 }, claimed: 3, note: 'Skipped by 74%. Skipping is a click, which is why almost nobody stops here.' },
    { key: 'payouts', step: 'Getting paid', year: { reached: 1180, lost: 67, minutes: 6 }, march: { reached: 601, lost: 31, minutes: 6 }, claimed: 4, note: 'A bank account, typed off a statement somebody has to go and find. Half the stops here happen at 11pm.' },
    { key: 'open', step: 'Opened the shop', year: { reached: 1113, lost: 0, minutes: null }, march: { reached: 570, lost: 0, minutes: null }, claimed: null, note: 'The 67 who finished setup and never pressed the button are the ones we understand least.' },
];

const totals = {
    year: { started: '1,847', opened: '1,113', rate: '60.3%', median: '38 min' },
    march: { started: '892', opened: '570', rate: '63.9%', median: '31 min' },
};

const samples = {
    year: '1,847 shops, every one that got past the mail',
    march: '892 shops, since the seven steps became five',
};

const of = { year: 1847, march: 892 };

const deleted = [
    { label: 'Theme picker', note: 'Eleven minutes spent choosing between four themes that differ by a heading font. 8% of everybody who left, left here.' },
    { label: 'Shipping zone builder', note: 'A map, six weight brackets and a rate table, asked for before the shop had a single product in it. Now a default table you correct later.' },
];

const outstanding = [
    'The catalog step is nineteen minutes and can be handed to somebody else. It says neither of those things while you are in it.',
    'The region page loses 264 shops to a question with no wrong answer for 91% of them.',
    'Nothing on the payouts step tells you it can wait until after you open. It can.',
];

const range = ref('year');

const rows = computed(() => stages.map((stage) => ({
    key: stage.key,
    step: stage.step,
    reached: stage[range.value].reached,
    lost: stage[range.value].lost,
    minutes: stage[range.value].minutes,
    claimed: stage.claimed,
    worst: stage.worst ?? false,
    note: stage.note,
})));

const figures = computed(() => [
    ['Started', totals[range.value].started],
    ['Opened', totals[range.value].opened],
    ['Got through', totals[range.value].rate],
    ['Median start to open', totals[range.value].median],
]);
</script>

<template>
    <OnboardingShell active="Where people stop" step="open" :rail="false">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-3 gap-y-2">
                <button
                    v-for="entry in ranges"
                    :key="entry.key"
                    type="button"
                    :data-active="range === entry.key ? '' : undefined"
                    class="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300"
                    @click="range = entry.key"
                >{{ entry.label }}</button>

                <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ samples[range] }}</span>
            </div>
        </template>

        <div class="mx-auto max-w-6xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Where the other 734 went</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                This is the onboarding looking at itself. Every step with the number of shops that reached it, how long it takes
                against what the label promised, and the two steps that are not on it any more because of this page.
            </p>

            <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
                <section>
                    <div class="flex items-baseline justify-between gap-3">
                        <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Step by step</h2>
                        <span class="font-mono text-[10px] text-zinc-700">reached · share · stopped</span>
                    </div>

                    <div class="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        <OnboardingFunnel v-for="row in rows" :key="row.key" v-bind="row" :of="of[range]" />
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Selling with no bank account</p>
                            <p class="mt-2 font-mono text-2xl text-cream">312</p>
                            <p class="mt-1.5 text-[12px]/5 text-zinc-400">
                                Shops taking orders with nowhere for the money to go. 89 of them have shipped something. The
                                longest has been at it 41 days and has $4,180 sitting with us.
                            </p>
                            <p class="mt-2 font-mono text-[10px] text-zinc-600">we mail them on day 3, 10 and 30</p>
                        </div>

                        <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Finished and never opened</p>
                            <p class="mt-2 font-mono text-2xl text-cream">67</p>
                            <p class="mt-1.5 text-[12px]/5 text-zinc-400">
                                All five steps done, catalog in, account attached, and the button never pressed. We rang eleven of
                                them. Nine said they were waiting for a photograph.
                            </p>
                            <p class="mt-2 font-mono text-[10px] text-zinc-600">the smallest group here and the most annoying</p>
                        </div>
                    </div>
                </section>

                <aside>
                    <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div v-for="[label, value] in figures" :key="label" class="rounded-lg border border-white/8 bg-ink-950/40 px-2.5 py-2">
                                <p class="font-mono text-[10px] text-zinc-600">{{ label }}</p>
                                <p class="mt-1 font-mono text-[15px] text-cream">{{ value }}</p>
                            </div>
                        </div>

                        <p class="mt-3 border-t border-white/5 pt-3 text-[11px]/5 text-zinc-600">
                            Median is start to open across shops that opened at all, and it includes the ones who left it three
                            weeks and came back on a Sunday.
                        </p>
                    </div>

                    <div class="mt-4 rounded-xl border border-jade-500/25 bg-jade-500/5 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-jade-300/80 uppercase">Two steps that are gone</p>

                        <ul class="mt-3 flex flex-col gap-3">
                            <li v-for="entry in deleted" :key="entry.label">
                                <p class="text-[12px] text-cream line-through decoration-jade-400/40">{{ entry.label }}</p>
                                <p class="mt-1 text-[11px]/5 text-zinc-500">{{ entry.note }}</p>
                            </li>
                        </ul>

                        <p class="mt-3 border-t border-jade-500/15 pt-3 text-[12px]/5 text-zinc-400">
                            Seven steps became five in March. Shops that open went from 60.3% to 63.9%, and the median run
                            dropped seven minutes. Nobody has asked for the theme picker back.
                        </p>
                    </div>

                    <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Still on the list to fix</p>
                        <ul class="mt-3 flex flex-col gap-2.5">
                            <li v-for="line in outstanding" :key="line" class="flex gap-2 text-[11px]/5 text-zinc-500">
                                <span class="mt-2 size-1 shrink-0 rounded-full bg-zinc-700"></span>
                                <span>{{ line }}</span>
                            </li>
                        </ul>
                    </div>

                    <a
                        href="/templates/onboarding/screens/setup"
                        target="_top"
                        class="mt-4 block rounded-xl border border-white/10 py-2 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >Back to the first step</a>
                </aside>
            </div>
        </div>
    </OnboardingShell>
</template>
