<script setup>
import { computed, ref } from 'vue';
import TermsShell from './Shell.vue';
import TermsGist from './Gist.vue';

const gists = [
    { number: '01', title: 'Who you are dealing with', says: 'A four-person company in Songshan, Taipei, with a number you can look up.', means: 'The registered address is the workshop, so a letter reaches the bench rather than an agent.', favours: 'both' },
    { number: '02', title: 'What these cover', says: 'Anything bought from this site, and the site itself.', means: 'A signed dealer agreement is separate paper and beats this page wherever they disagree.', favours: 'both' },
    { number: '03', title: 'Ordering, price, and when we charge', says: 'Authorised when you order, charged the day your batch ships.', means: 'That gap runs to eleven weeks, and you can walk away free if it slips three past the date we gave.', favours: 'you' },
    { number: '04', title: 'Delivery, customs, and risk', says: 'Shipped delivered-at-place: import duty and VAT are yours.', means: 'On an NT$18,000 machine into the EU that is another NT$4,000 to NT$5,000, and we will not under-declare it.', favours: 'us', bites: true },
    { number: '05', title: 'Changing your mind', says: 'Fourteen days from delivery, no reason asked.', means: 'Seven from the Consumer Protection Act, seven we added in 4.1 because a customer said seven was mean.', favours: 'you' },
    { number: '06', title: 'The two-year warranty', says: 'Two years on motor, gearbox, electronics and frame.', means: 'It follows the machine, not you, so selling it on does not kill what is left.', favours: 'you' },
    { number: '07', title: 'Repairs outside the warranty', says: 'NT$900 an hour, quoted before anything is opened.', means: 'And quoted again if the number moves by more than a fifth.', favours: 'you' },
    { number: '08', title: 'Burrs, and what wears out', says: 'Consumables are not covered past 300 kg through the machine.', means: 'Three years in a house, four months in a shop. Version 4.2 lifts it to 500 kg.', favours: 'us', bites: true },
    { number: '09', title: 'Your account and the help centre', says: 'Optional. It holds orders and serials, and closes after three dormant years.', means: 'You get a month of warning before that happens.', favours: 'both' },
    { number: '10', title: 'Our photographs, drawings, and the manual', says: 'Reuse them for repair, review or resale, with a credit.', means: 'Not to sell a different machine, and not in a way that implies we built one we did not.', favours: 'both' },
    { number: '11', title: 'When the site is down', says: 'No uptime promise, and an unconfirmed order is not an order.', means: 'Nothing is charged until a mail with an order number arrives.', favours: 'us' },
    { number: '12', title: 'What we owe you if it goes wrong', says: 'Capped at the price you paid for the machine.', means: 'Injury, fraud and anything the Consumer Protection Act protects sit outside the cap. 4.2 puts a floor of NT$40,000 under it.', favours: 'you' },
    { number: '13', title: 'Changing these terms', says: 'Thirty days of notice, and your order keeps the version you read.', means: 'A change that takes away a right you already hold gets asked, not announced.', favours: 'you' },
    { number: '14', title: 'Law, and where an argument goes', says: 'Taiwan law, mediation first, then the Taipei District Court.', means: 'Unless your own consumer law hands you a court closer to home, which across the EU it does.', favours: 'us', bites: true },
];

const filters = [
    { key: 'all', label: 'All fourteen' },
    { key: 'you', label: 'Written for you' },
    { key: 'us', label: 'Written for us' },
    { key: 'bites', label: 'Catches people out' },
];

const tally = [
    { count: 6, label: 'yours', class: 'bg-jade-500' },
    { count: 4, label: 'ours', class: 'bg-amber-400/70' },
    { count: 4, label: 'even', class: 'bg-white/15' },
];

const traps = [
    { number: '04', what: 'The customs bill', do: 'Work out your own duty before you order. We publish the tariff code (8509.40) and declare the price you actually paid.' },
    { number: '08', what: 'Burrs are a consumable', do: 'A shop gets through a set in about four months. Buy the second set with the machine and we fit it free at the counter.' },
    { number: '14', what: 'Arguments happen in Taipei', do: 'If you are an EU consumer, your own courts stay open to you. We say so in the clause rather than hoping you never check.' },
];

const cannot = [
    'The seven days. It is the Consumer Protection Act, not us — clause 05 can only add to it.',
    'Death or injury we cause. Uncapped, in every version, in every country we ship to.',
    'Fraud. Ours, obviously.',
];

const spell = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen'];

const picked = ref('all');

const shown = computed(() => gists.filter((gist) => {
    if (picked.value === 'all') {
        return true;
    }

    if (picked.value === 'bites') {
        return gist.bites === true;
    }

    return gist.favours === picked.value;
}));

const count = computed(() => (picked.value === 'all' ? 'showing all fourteen' : `showing ${spell[shown.value.length]} of fourteen`));
</script>

<template>
    <TermsShell active="Short version">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                <span class="flex items-center gap-2.5">
                    <span class="flex w-24 gap-px overflow-hidden rounded-full">
                        <span
                            v-for="slice in tally"
                            :key="slice.label"
                            class="h-1.5"
                            :class="slice.class"
                            :style="{ width: `${((slice.count / 14) * 100).toFixed(3)}%` }"
                        ></span>
                    </span>
                    <span class="font-mono text-[10px] text-zinc-600">6 yours · 4 ours · 4 even</span>
                </span>

                <span class="hidden font-mono text-[10px] text-zinc-700 sm:inline">{{ count }}</span>

                <div class="ml-auto flex flex-wrap items-center gap-1">
                    <button
                        v-for="filter in filters"
                        :key="filter.key"
                        type="button"
                        class="rounded-lg px-2.5 py-1 text-[12px] transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="picked === filter.key ? 'bg-white/8 text-cream' : 'text-zinc-500'"
                        @click="picked = filter.key"
                    >{{ filter.label }}</button>
                </div>
            </div>
        </template>

        <div class="mx-auto max-w-5xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">The whole thing in fourteen lines</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                Every clause with the marker that says who it is actually for. Four of them are for us, and putting that in
                writing costs less than having you find out on the day it matters. This column is a reading, not the contract —
                where it and the numbered clause disagree, the clause wins, and you should tell us which one drifted.
            </p>

            <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
                <section>
                    <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        <TermsGist
                            v-for="gist in shown"
                            :key="gist.number"
                            :number="gist.number"
                            :title="gist.title"
                            :says="gist.says"
                            :means="gist.means"
                            :favours="gist.favours"
                            :bites="gist.bites ?? false"
                        />
                    </div>

                    <p v-if="!shown.length" class="mt-3 text-[12px]/5 text-zinc-600">Nothing under this filter.</p>

                    <p class="mt-4 text-[11px]/5 text-zinc-600">
                        We wrote the markers as well as the clauses, which is a conflict of interest we cannot design our way
                        out of. Read 12 and 14 in full before taking our word for the marker on 12 and 14.
                    </p>
                </section>

                <aside>
                    <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The three people get caught by</h2>

                    <div class="mt-3 space-y-3">
                        <div v-for="trap in traps" :key="trap.number" class="rounded-xl border border-amber-400/20 bg-amber-400/5 p-3.5">
                            <p class="flex items-baseline gap-2">
                                <span class="font-mono text-[10px] text-amber-300/80">{{ trap.number }}</span>
                                <span class="text-[13px] text-cream">{{ trap.what }}</span>
                            </p>
                            <p class="mt-1.5 text-[12px]/5 text-zinc-500">{{ trap.do }}</p>
                        </div>
                    </div>

                    <h2 class="mt-7 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we cannot sign away</h2>
                    <ul class="mt-3 space-y-2.5">
                        <li v-for="line in cannot" :key="line" class="flex gap-2.5 text-[12px]/5 text-zinc-500">
                            <span class="mt-1.5 size-1 shrink-0 rounded-full bg-jade-400/70"></span>
                            <span>{{ line }}</span>
                        </li>
                    </ul>

                    <div class="mt-7 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Reading the marker</p>
                        <div class="mt-3 space-y-2.5">
                            <p class="flex items-center gap-2.5">
                                <span class="flex w-10 gap-px"><span class="h-1 flex-1 rounded-l-full bg-white/8"></span><span class="h-1 flex-1 rounded-r-full bg-jade-500"></span></span>
                                <span class="text-[12px] text-zinc-400">gives you something the law does not</span>
                            </p>
                            <p class="flex items-center gap-2.5">
                                <span class="flex w-10 gap-px"><span class="h-1 flex-1 rounded-l-full bg-amber-400/70"></span><span class="h-1 flex-1 rounded-r-full bg-white/8"></span></span>
                                <span class="text-[12px] text-zinc-400">limits what we carry</span>
                            </p>
                            <p class="flex items-center gap-2.5">
                                <span class="flex w-10 gap-px"><span class="h-1 flex-1 rounded-l-full bg-white/15"></span><span class="h-1 flex-1 rounded-r-full bg-white/15"></span></span>
                                <span class="text-[12px] text-zinc-400">housekeeping, either way</span>
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </TermsShell>
</template>
