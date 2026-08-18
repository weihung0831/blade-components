<script setup>
import { computed, ref } from 'vue';
import ErrorPagesCode from './Code.vue';
import ErrorPagesRoute from './Route.vue';
import ErrorPagesShell from './Shell.vue';

const grantors = [
    {
        key: 'ana',
        name: 'Ana Wu',
        role: 'Shop manager',
        hours: '08:00–18:00 Taipei',
        awake: true,
        typical: 'answers these in about 20 minutes',
        note: 'The one who took the permission off in the first place, which makes them the person who can put it back without asking anybody else.',
    },
    {
        key: 'wei',
        name: 'Wei Chen',
        role: 'Owner',
        hours: '09:00–17:00 Taipei, and never on Sunday',
        awake: false,
        typical: 'answers by the next morning',
        note: 'Can grant anything, but goes through Ana for refunds anyway. Worth asking only if Ana is away.',
    },
];

const reachable = [
    { label: 'Orders — read, edit, and mark as shipped', note: 'Everything up to the point money moves back.', meta: 'yours' },
    { label: 'The parts shelf and stock counts', note: 'Including the stock adjustments, which is the one people expect to be locked and is not.', meta: 'yours' },
    { label: 'The desk — every conversation, and replying to them', note: 'You have had 340 of these since February.', meta: 'yours' },
    { label: 'Refunds — issuing them', note: 'This one. Ana holds it, along with payouts and the bank details.', meta: 'not yours', tone: 'dead' },
    { label: 'Payouts and the bank account', note: 'Owner only. Nobody on the bench has ever had this.', meta: 'not yours', tone: 'dead' },
];

const lines = [
    { label: 'you asked for', value: 'nomadsupply.tw/admin/orders/NS-24817/refund' },
    { label: 'it needs', value: 'orders.refund — held by 2 of the 9 seats' },
    { label: 'you have', value: 'orders.read, orders.write, stock.write, desk.reply' },
];

const picked = ref(grantors[0].key);

const chosen = computed(() => grantors.find((grantor) => grantor.key === picked.value));
const first = computed(() => chosen.value.name.split(' ')[0]);
</script>

<template>
    <ErrorPagesShell active="Not your seat" state="ok" reference="req_5a30e7b1 · 403">
        <div class="mx-auto max-w-3xl">
            <ErrorPagesCode
                code="403"
                tone="held"
                stamp="you are signed in, just not as this"
                headline="Refunds sit with Ana. Your seat stops one step short of moving money back."
                sentence="Nothing has gone wrong and you have not been logged out. This page could tell you that in four words and send you to the dashboard, which is what most of them do — and then you spend twenty minutes working out whether it was you or the software."
                :lines="lines" />

            <section class="mt-8 grid grid-cols-1 gap-4 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.1fr)]">
                <div class="self-start overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                    <div class="flex items-center gap-3 border-b border-white/5 px-3.5 py-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-full border border-white/10 bg-ink-900 font-mono text-[12px] text-zinc-400">LK</span>
                        <span class="min-w-0 flex-1">
                            <span class="block truncate text-[13px] text-cream">Lin Kai-ting</span>
                            <span class="block truncate font-mono text-[10px] text-zinc-600">kai@nomadsupply.tw</span>
                        </span>
                        <span class="shrink-0 rounded border border-white/12 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400">Bench</span>
                    </div>

                    <div class="px-3.5 py-3">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why it changed</p>
                        <p class="mt-1.5 text-[12px]/5 text-zinc-400">
                            You could open this until 6 August. Ana moved refunds off the bench seats the morning after a
                            NT$41,000 refund went out on a machine that never came back — not because anybody suspected you, but
                            because two people had to be looking at it and only one was.
                        </p>

                        <dl class="mt-3 grid grid-cols-[auto_minmax(0,1fr)] gap-x-4 gap-y-1.5 border-l border-white/8 pl-3">
                            <dt class="font-mono text-[10px] text-zinc-700">changed</dt>
                            <dd class="font-mono text-[11px] text-zinc-500">6 Aug 2026, 09:40</dd>
                            <dt class="font-mono text-[10px] text-zinc-700">by</dt>
                            <dd class="font-mono text-[11px] text-zinc-500">Ana Wu</dd>
                            <dt class="font-mono text-[10px] text-zinc-700">affected</dt>
                            <dd class="font-mono text-[11px] text-zinc-500">4 seats, all told the same day</dd>
                        </dl>
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                    <div class="border-b border-white/5 px-3.5 py-2.5">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Ask for it</p>
                        <p class="mt-1 text-[11px]/5 text-zinc-500">Two people can grant this. One of them is at a desk right now.</p>
                    </div>

                    <div class="divide-y divide-white/5">
                        <label
                            v-for="grantor in grantors"
                            :key="grantor.key"
                            class="flex cursor-pointer items-start gap-3 px-3.5 py-3 transition-colors duration-150 hover:bg-white/2"
                            :class="picked === grantor.key ? 'bg-jade-500/6' : ''"
                        >
                            <input
                                v-model="picked"
                                type="radio"
                                name="grantor"
                                :value="grantor.key"
                                class="mt-1 size-3.5 shrink-0 appearance-none rounded-full border border-white/20 outline-none checked:border-jade-500 checked:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">

                            <span class="min-w-0 flex-1">
                                <span class="flex flex-wrap items-baseline gap-x-2">
                                    <span class="text-[13px] text-cream">{{ grantor.name }}</span>
                                    <span class="font-mono text-[10px] text-zinc-600">{{ grantor.role }}</span>

                                    <span class="ml-auto flex shrink-0 items-center gap-1.5 font-mono text-[10px]" :class="grantor.awake ? 'text-jade-300' : 'text-zinc-700'">
                                        <span class="size-1.5 rounded-full" :class="grantor.awake ? 'bg-jade-500' : 'bg-white/20'"></span>
                                        {{ grantor.awake ? 'at a desk now' : 'asleep, it is 04:19' }}
                                    </span>
                                </span>

                                <span class="mt-1 block text-[11px]/5 text-zinc-500">{{ grantor.note }}</span>
                                <span class="mt-1.5 block font-mono text-[10px] text-zinc-700">{{ grantor.hours }} · {{ grantor.typical }}</span>
                            </span>
                        </label>
                    </div>

                    <div class="border-t border-white/5 px-3.5 py-3">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What they get, word for word</p>
                        <p class="mt-2 rounded-lg border border-white/8 bg-ink-900 px-3 py-2.5 text-[12px]/5 text-zinc-400">
                            {{ first }} — Kai is asking for orders.refund to refund NS-24817, at 04:19 on 18 August. Granting it
                            covers this one order and comes back off at midnight.
                        </p>

                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <button type="button" class="rounded-lg border border-jade-500/40 bg-jade-500/10 px-2.5 py-1.5 text-[12px] text-cream transition-colors duration-150 outline-none hover:border-jade-500/70 focus-visible:ring-2 focus-visible:ring-jade-500/70">Ask {{ first }}</button>
                            <span class="font-mono text-[10px] text-zinc-600">{{ chosen.typical }}</span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-8">
                <div class="flex items-baseline gap-3">
                    <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What your seat does reach</h2>
                    <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                    <span class="shrink-0 font-mono text-[10px] text-zinc-700">3 of 5</span>
                </div>

                <div class="mt-3 flex flex-col gap-2">
                    <ErrorPagesRoute
                        v-for="entry in reachable"
                        :key="entry.label"
                        v-bind="entry"
                        :href="entry.tone === 'dead' ? null : '#'" />
                </div>
            </section>

            <section class="mt-8 rounded-xl border border-white/8 bg-ink-900 p-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why this is not a redirect</p>
                <p class="mt-2 text-[12px]/5 text-zinc-400">
                    Bouncing you to the dashboard hides the fact that anything happened, and the next thing you do is try again
                    from a different link. Naming the permission, the person who holds it and the date it moved turns a wall into
                    a twenty-minute wait. The seat that cannot see a page still gets told the page exists — hiding that has never
                    stopped anybody who was actually trying to get in.
                </p>
            </section>
        </div>
    </ErrorPagesShell>
</template>
