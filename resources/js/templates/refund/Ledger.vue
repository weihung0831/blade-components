<script setup>
import RefundShell from './Shell.vue';
import RefundVerdict from './Verdict.vue';

const headline = [
    { label: 'Refunds since 2019', value: '214', meta: 'against 3,910 orders' },
    { label: 'Of everything sold', value: '5.5%', meta: 'the trade average is about 8' },
    { label: 'Median to the bank', value: '6 days', meta: 'worst 23, over Lunar New Year' },
    { label: 'Refused', value: '9', meta: 'one of them wrongly' },
];

const reasons = [
    { label: 'Changed their mind', count: 96, share: 45 },
    { label: 'Stopped working inside two years', count: 44, share: 21 },
    { label: 'Arrived broken', count: 31, share: 14 },
    { label: 'Cancelled before it shipped', count: 22, share: 10 },
    { label: 'Sounded wrong, and did', count: 14, share: 7 },
    { label: 'We picked the wrong thing', count: 7, share: 3 },
];

const refused = [
    { when: 'Jan 2020', asked: 'A Jade body, eleven weeks on', said: 'Anodised to order, outside every window, and the colour had been sitting on a shelf since. We offered to resell it and pass on whatever it made. Nobody wanted it.', record: 'RF-2001-0004', outcome: 'refused' },
    { when: 'Aug 2021', asked: 'Burrs worn flat at 400 kg', said: 'Four hundred kilos is about eight years of home use and roughly a year in a bar. That is wear, not a fault, and a burr set is $40 on the parts page.', record: 'RF-2108-0031', outcome: 'refused' },
    { when: 'Mar 2022', asked: 'Cracked body, dropped down a stairwell', said: 'They told us exactly what happened, which we appreciated. We sold them a body at cost instead, $95 rather than $260.', record: 'RF-2203-0058', outcome: 'refused' },
    { when: 'Nov 2022', asked: 'Noise at coarse settings, day 34', said: 'Four days past the window, so we said no. Then Batch 40 turned out to have a real fault and we paid it in full six weeks later without being asked twice. We got this one wrong and the customer was right.', record: 'RF-2211-0074', outcome: 'wrong' },
    { when: 'Jun 2023', asked: 'Two machines, one order, both opened', said: 'One came back on the change-of-mind rule. The second had 3 kg through it, which is not a trial, so the burr deduction applied and the rest was paid.', record: 'RF-2306-0102', outcome: 'paid' },
    { when: 'Feb 2025', asked: 'Bought from a reseller in Osaka', said: 'Not our sale and not our money to give back. We handled the warranty repair anyway, because the machine is ours whoever sold it.', record: 'RF-2502-0171', outcome: 'refused' },
];

const fixes = [
    { title: 'Batch 40 burr carrier', body: 'Eleven returns for noise in five weeks, all from one batch. The wave washer was under-spec and the carrier rang at coarse settings. Forty machines were written to, whether or not they had complained.', meta: 'found by refunds, Nov 2022' },
    { title: 'The knocker screw', body: 'Six machines came back with the chute knocker loose. It was a thread-lock step somebody had quietly dropped from the build sheet to save forty seconds.', meta: 'found by refunds, Mar 2024' },
    { title: 'Boxes on the Kaohsiung run', body: 'Damage-on-arrival ran at four times normal for one courier depot over one summer. Changed the depot, changed nothing else, and it went back to normal.', meta: 'found by refunds, Jul 2025' },
];
</script>

<template>
    <RefundShell active="The ledger">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                <span class="font-mono text-[10px] text-zinc-500">seven years · 214 refunds · $198,400 paid back</span>
                <span class="hidden font-mono text-[10px] text-zinc-700 sm:inline">updated 12 Aug 2026</span>
                <a
                    href="/templates/refund/screens/policy"
                    target="_top"
                    class="ml-auto rounded-lg px-2.5 py-1 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:bg-white/5 hover:text-jade-300"
                >the rules these came under →</a>
            </div>
        </template>

        <div class="mx-auto max-w-6xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Every refund we have paid, and the nine we did not</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                A policy is a promise and this is the receipt. It includes the one we refused and then paid six weeks later,
                because a refusal list with no mistakes in it is a list somebody edited.
            </p>

            <div class="mt-6 grid grid-cols-2 gap-3 lg:grid-cols-4">
                <div v-for="stat in headline" :key="stat.label" class="rounded-xl border border-white/8 bg-ink-900 p-3.5">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ stat.label }}</p>
                    <p class="mt-1.5 text-2xl font-semibold tracking-tight text-cream">{{ stat.value }}</p>
                    <p class="mt-1 text-[11px]/5 text-zinc-600">{{ stat.meta }}</p>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
                <section>
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">What they were for</h2>
                    <p class="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                        Change of mind is nearly half, which is what a thirty-day window buys you and roughly what it costs.
                        The bottom row is ours and we would rather it were zero.
                    </p>

                    <div class="mt-3 flex flex-col gap-2.5">
                        <div v-for="reason in reasons" :key="reason.label" class="flex items-center gap-4">
                            <p class="w-52 shrink-0 truncate text-[12px] text-zinc-400">{{ reason.label }}</p>
                            <div class="h-2 min-w-0 flex-1 overflow-hidden rounded-full bg-white/8">
                                <div class="h-full rounded-full bg-jade-500" :style="{ width: `${reason.share}%` }"></div>
                            </div>
                            <p class="w-10 shrink-0 text-right font-mono text-[11px] text-zinc-500">{{ reason.count }}</p>
                        </div>
                    </div>

                    <h2 class="mt-8 text-[15px] font-medium tracking-tight text-cream">Six of the nine we turned down</h2>
                    <p class="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                        Written up with what we said at the time. Two of them we would decide the same way tomorrow, one of them
                        we got wrong, and the rest sit somewhere in between.
                    </p>

                    <ul class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        <RefundVerdict v-for="entry in refused" :key="entry.record" v-bind="entry" />
                    </ul>

                    <p class="mt-3 text-[11px]/5 text-zinc-600">
                        The other three were the same shape as the Osaka one — machines we made and somebody else sold. We repair
                        those and we do not refund them, and both halves of that sentence matter.
                    </p>
                </section>

                <aside>
                    <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Three faults the returns found</h2>
                    <p class="mt-2 text-[12px]/5 text-zinc-500">
                        A refund is expensive and it is also the only honest signal a workshop gets. These three were invisible
                        on the bench and obvious in the returns pile.
                    </p>

                    <div class="mt-3 flex flex-col gap-3">
                        <div v-for="fix in fixes" :key="fix.title" class="rounded-xl border border-white/8 bg-ink-900 p-3.5">
                            <p class="text-[13px] text-cream">{{ fix.title }}</p>
                            <p class="mt-1.5 text-[12px]/5 text-zinc-400">{{ fix.body }}</p>
                            <p class="mt-2.5 font-mono text-[10px] text-zinc-700">{{ fix.meta }}</p>
                        </div>
                    </div>

                    <div class="mt-7 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where the 23 days came from</p>
                        <p class="mt-2 text-[12px]/5 text-zinc-400">
                            Lunar New Year 2024. The workshop was shut for nine days, the courier was shut for seven, and one
                            refund sat in a locked building the whole time. Nobody was told, which was the actual failure —
                            the shutdown is on the calendar now and the page says so before you send anything.
                        </p>
                        <p class="mt-2.5 font-mono text-[10px] text-zinc-600">Next shutdown: 14–22 Feb 2027.</p>
                    </div>

                    <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why this page exists</p>
                        <p class="mt-2 text-[12px]/5 text-zinc-400">
                            Four of us, one bench, and a refund rate we can publish because it is low enough to be worth publishing.
                            If it ever climbs past ten percent, this page will say so before anybody else notices.
                        </p>
                        <a
                            href="/templates/refund/screens/send"
                            target="_top"
                            class="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                        >Start one of your own</a>
                    </div>
                </aside>
            </div>
        </div>
    </RefundShell>
</template>
