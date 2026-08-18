<script setup>
import PrivacyShell from './Shell.vue';
import PrivacyParcel from './Parcel.vue';
import PrivacyTrail from './Trail.vue';

const steps = [
    { label: 'Asked for', at: '14 Aug, 09:12' },
    { label: 'Gathered', at: '14 Aug, 16:40' },
    { label: 'Read by a person', at: null },
    { label: 'Sent', at: null },
];

const files = [
    { name: 'orders.csv', what: 'Four orders, every field on each of them, including the ones you never see.', size: '6 KB' },
    { name: 'addresses.csv', what: 'Every address you have used here, and which order went to which.', size: '2 KB' },
    { name: 'mail.mbox', what: 'Thirty-one messages, both directions, in a format your mail client will open.', size: '840 KB' },
    { name: 'repairs.pdf', what: 'Two visits to the bench: the notes, the parts, and the photographs of the burr.', size: '4.2 MB' },
    { name: 'consent.csv', what: 'Every switch on the controls page, when it moved, and from which country.', size: '1 KB' },
    { name: 'weblog-sample.csv', what: 'The fourteen days we still have. Everything older is genuinely gone.', size: '11 KB' },
];

const stays = [
    { name: 'The invoice for each order', why: '稅捐稽徵法 §11-2 puts seven years on it and does not take requests.', until: 'until Mar 2031' },
    { name: 'Repair notes against the serial', why: 'It is the machine\'s record rather than yours, so a recall can reach whoever owns it next. Your name comes off the same day you ask.', until: 'until 2034' },
    { name: 'A hash of your email', why: 'Sixteen characters, held so that a later import cannot put you back on a list you left.', until: 'kept for good' },
];

const trail = [
    { who: 'Mei-Ling', role: 'support', when: '12 Aug, 14:20', why: 'Answering your mail about the rattle at coarse settings.', record: '#4821' },
    { who: 'Wei', role: 'bench', when: '12 Aug, 15:05', why: 'Looked up which burr batch your serial shipped with.', record: 'NS-2411-0392' },
    { who: 'Nightly backup', role: 'automatic', when: '13 Aug, 03:00', why: 'Copied the database. Nothing was opened and nobody read anything.', record: 'job 8842' },
    { who: 'Yi-Chen', role: 'counter', when: '13 Aug, 11:44', why: 'Opened the wrong Chen. Shut it after nine seconds and wrote this line herself.', record: 'flagged', flagged: true },
    { who: 'Mei-Ling', role: 'support', when: '14 Aug, 09:12', why: 'Started the export you are watching on the left.', record: 'PR-2026-0412' },
    { who: '誠泰記帳士事務所', role: 'bookkeeper', when: '30 Jun, 10:15', why: 'Quarterly invoice list. Your name was in it and nothing else was.', record: 'Q2 filing' },
];
</script>

<template>
    <PrivacyShell active="Ask for it">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                <span class="font-mono text-[10px] text-zinc-500">PR-2026-0412 · gathered, waiting to be read</span>
                <span class="hidden font-mono text-[10px] text-zinc-700 sm:inline">the law allows 30 days · the last twelve took four</span>
                <a
                    href="/templates/privacy/screens/held"
                    target="_top"
                    class="ml-auto rounded-lg px-2.5 py-1 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:bg-white/5 hover:text-jade-300"
                >see what is in it first →</a>
            </div>
        </template>

        <div class="mx-auto max-w-6xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Ask for a copy, or ask us to forget</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                Both are one form and neither costs anything. The law gives us thirty days; the last twelve requests went out in
                four working days, and the slow part is a person reading the file before it leaves, which is the step we are not
                going to automate away.
            </p>

            <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
                <section>
                    <PrivacyParcel
                        reference="PR-2026-0412"
                        kind="A copy of everything"
                        asked="14 Aug 2026"
                        due="due by 13 Sep"
                        :steps="steps"
                        :stage="1"
                        note="Mei-Ling reads the export before it goes anywhere. It is the slow step and it is also where the mistakes get caught — twice so far, both of them a file belonging to somebody else."
                    />

                    <h2 class="mt-8 text-[15px] font-medium tracking-tight text-cream">What arrives</h2>
                    <p class="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                        Six files, about five megabytes, as a link that stops working after seven days. Nothing is a screenshot and
                        nothing is a PDF of a table — it is the actual rows, so you can do something with them.
                    </p>

                    <div class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        <div v-for="file in files" :key="file.name" class="flex flex-col gap-1.5 px-3.5 py-3 sm:flex-row sm:items-baseline sm:gap-5">
                            <p class="w-full shrink-0 font-mono text-[11px] text-jade-400 sm:w-44">{{ file.name }}</p>
                            <p class="min-w-0 flex-1 text-[12px]/5 text-zinc-400">{{ file.what }}</p>
                            <p class="shrink-0 font-mono text-[10px] text-zinc-600">{{ file.size }}</p>
                        </div>
                    </div>

                    <h2 class="mt-8 text-[15px] font-medium tracking-tight text-cream">What stays behind, and what pins it</h2>
                    <p class="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                        An erase request empties everything except these three. Each one names the reason, and two of the three are
                        somebody else's rule rather than ours.
                    </p>

                    <div class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-amber-400/20 bg-amber-400/5">
                        <div v-for="row in stays" :key="row.name" class="flex flex-col gap-1.5 px-3.5 py-3 sm:flex-row sm:items-baseline sm:gap-5">
                            <p class="w-full shrink-0 text-[13px] text-cream sm:w-52">{{ row.name }}</p>
                            <p class="min-w-0 flex-1 text-[12px]/5 text-zinc-400">{{ row.why }}</p>
                            <p class="shrink-0 font-mono text-[10px] text-amber-300/80">{{ row.until }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-3 rounded-xl border border-white/8 bg-ink-900 p-4 sm:flex-row sm:items-center sm:gap-5">
                        <div class="min-w-0 flex-1">
                            <p class="text-[13px] text-cream">Start one</p>
                            <p class="mt-1 text-[12px]/5 text-zinc-500">
                                Reply from the address on the order and that is the identity check finished. We do not want a
                                photograph of your ID and we will not ask for one — collecting a passport scan to prove who you are
                                is how a privacy request turns into a breach.
                            </p>
                        </div>
                        <div class="flex shrink-0 gap-2">
                            <button type="button" class="rounded-lg border border-white/15 px-3.5 py-1.5 text-[13px] text-zinc-200 transition-colors duration-150 outline-none hover:border-white/30 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Erase it</button>
                            <button type="button" class="rounded-lg bg-jade-500 px-3.5 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Send me a copy</button>
                        </div>
                    </div>
                </section>

                <aside>
                    <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Who opened your record</h2>
                    <p class="mt-2 text-[12px]/5 text-zinc-500">
                        Written by the system rather than by us, and shown to you whether or not you asked. The amber line is what
                        an honest log looks like.
                    </p>

                    <ul class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        <PrivacyTrail
                            v-for="entry in trail"
                            :key="entry.record + entry.when"
                            :who="entry.who"
                            :role="entry.role"
                            :when="entry.when"
                            :why="entry.why"
                            :record="entry.record"
                            :flagged="entry.flagged ?? false"
                        />
                    </ul>

                    <p class="mt-3 text-[11px]/5 text-zinc-600">
                        Six entries in three months, which is about average for an order with a repair on it. An account that has
                        only ever bought something usually shows the backup line and nothing else.
                    </p>

                    <div class="mt-7 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If we get it wrong</p>
                        <p class="mt-2 text-[12px]/5 text-zinc-400">
                            Tell us first — Mei-Ling would rather hear it from you than from a regulator, and so would you, because
                            it is faster. If that goes nowhere, the 個人資料保護法 route in Taiwan runs through the ministry that
                            supervises us, and readers in the EU keep the right to complain to their own authority instead.
                        </p>
                        <a
                            href="/templates/contact/screens/desk"
                            target="_top"
                            class="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                        >Find the right desk</a>
                    </div>

                    <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Twelve requests so far</p>
                        <p class="mt-2 text-[12px]/5 text-zinc-400">
                            Nine copies and three erasures since 2019. Median four working days, worst eleven, and the eleven was a
                            week when the whole shop was at a trade fair in Kyoto. None was refused.
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </PrivacyShell>
</template>
