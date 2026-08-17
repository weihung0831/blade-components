<script setup>
import { computed, ref } from 'vue';
import FaqShell from './Shell.vue';
import FaqTopic from './Topic.vue';
import FaqQuestion from './Question.vue';
import FaqCallout from './Callout.vue';

const topics = [
    { name: 'Noise and grind', count: 4, lead: 'It howls above half the dial after three weeks.', health: 91, note: null },
    { name: 'Setting it up', count: 3, lead: 'How much coffee do I waste seasoning the burrs?', health: 88, note: null },
    { name: 'Warranty', count: 3, lead: 'I opened it myself. Have I voided anything?', health: 62, note: '2 need a rewrite' },
    { name: 'Orders and delivery', count: 3, lead: 'Nine days and the tracking has not moved.', health: 84, note: null },
    { name: 'Before you buy', count: 2, lead: 'Jade or graphite — does the finish change anything?', health: 96, note: null },
    { name: 'Dealers', count: 1, lead: 'What do dealer terms look like for two shops?', health: 90, note: null },
];

const questions = [
    { topic: 'Noise and grind', q: 'It howls above half the dial after three weeks. Is that normal?', helpful: 94, votes: 212, opens: 1840, updated: '3 days ago', full: true, a: [
        'No. Burrs bedding in are quieter each week, not louder, and they never pick a single point on the dial to scream at.',
        'If it starts around the middle and gets worse on lighter roasts, it is almost certainly Batch 40 — a run of 600 machines from March where the top burr seat came out 0.15 mm shallow. Twenty minutes and two shims fixes it for good.',
    ], note: { tone: 'tip', label: 'How to tell', text: 'Run it empty. Bedding-in noise is even across the dial; a proud seat only sings once the load comes on.' } },

    { topic: 'Noise and grind', q: 'Grounds cling to everything. Is the graphite finish static?', helpful: 89, votes: 146, opens: 980, updated: '2 weeks ago', a: [
        'The finish has nothing to do with it. Dry beans below about 40% humidity build a charge as they break, and the jade machines do exactly the same thing — you just cannot see the dust on them.',
        'One drop of water stirred through the beans before they go in kills it. It is called the Ross droplet technique and it is the only piece of coffee folklore we will vouch for.',
    ] },

    { topic: 'Noise and grind', q: 'How fine does it actually go? Fine enough for Turkish?', helpful: 92, votes: 88, opens: 610, updated: '1 Jul', a: [
        'Yes, at 2 or below on the dial, but it will take you four minutes for 18 grams and the motor gets warm. It was built for espresso through to filter and that is where it is happy.',
        'If Turkish is the daily habit rather than the occasional one, buy the hand mill instead. We would rather say that than sell you the wrong machine twice.',
    ] },

    { topic: 'Noise and grind', q: 'The dial crept two numbers coarser on its own. Loose?', helpful: 78, votes: 54, opens: 410, updated: '18 Jun', a: [
        'Vibration walks the collar when the detent spring has flattened. Machines built before serial NS-B22 shipped with the softer spring; the replacement is free and posts the same day you ask for it.',
    ] },

    { topic: 'Setting it up', q: 'Do I have to season the burrs, and how much coffee does that cost me?', helpful: 96, votes: 174, opens: 1320, updated: '11 Aug', a: [
        'About 250 grams of anything cheap and stale. Run it at 12 on the dial, in 20 gram doses, and throw the lot away. The grind stops drifting after that and your first proper bag lands on a machine that has settled.',
    ], note: { tone: 'quiet', label: 'Or skip it', text: 'Nothing breaks if you do not. You will just spend the first fortnight chasing a dial that is still moving under you.' } },

    { topic: 'Setting it up', q: 'It arrived with grounds inside. Was mine used?', helpful: 97, votes: 203, opens: 1490, updated: '4 Aug', a: [
        'Every machine grinds 30 grams on the bench before it is boxed, because a burr gap set with a feeler gauge and a burr gap that actually grinds coffee are two different numbers. The dose that proves it is yours is in the chute.',
        'The card in the lid has the initials of whoever ran it. If the chute is clean, that is the machine we should be worried about.',
    ] },

    { topic: 'Setting it up', q: 'Which way round does the top burr seat?', helpful: 85, votes: 67, opens: 520, updated: '22 Jul', a: [
        'Three tabs, one of them narrower than the other two. The narrow tab lines up with the punch mark on the carrier. It will physically sit either way, but only one of them holds the gap.',
    ] },

    { topic: 'Warranty', q: 'Three years — what is not covered?', helpful: 88, votes: 158, opens: 1130, updated: '9 Aug', a: [
        'Burrs past 400 kg, which is roughly six years of a two-a-day habit. Anything you drop. Anything that has been through water. Beyond that, if it stops working the way it worked on day one, it is ours.',
        'Second-hand machines keep the balance of the warranty. It follows the serial, not the buyer.',
    ] },

    { topic: 'Warranty', q: 'I opened it myself before writing in. Have I voided anything?', helpful: 62, votes: 91, opens: 740, updated: '2 Mar', stale: true, a: [
        'No. There are four hex screws and a service manual on this site — taking the top off is not tampering, it is the machine working as intended.',
        'The exception is the motor housing, which is sealed with a torque we cannot reproduce on the bench. Once that is open we can still repair it, but the repair is chargeable.',
    ], note: { tone: 'warn', label: 'We know', text: 'A third of the people who read this still write in unsure. It is on the bench to be rewritten this month.' } },

    { topic: 'Warranty', q: 'Do I need the receipt?', helpful: 93, votes: 72, opens: 480, updated: '9 Aug', a: [
        'The serial is enough. It is on a plate under the base, starts NS-B, and tells us which run you have and what went out with it.',
    ] },

    { topic: 'Orders and delivery', q: 'Nine days and the tracking has not moved. Where is it?', helpful: 71, votes: 189, opens: 1610, updated: '6 Aug', a: [
        'Almost always the carrier scanning late rather than a parcel sitting still. Anything past ten working days we treat as lost, refund or resend the same day you ask, and argue with the carrier ourselves afterwards.',
        'If the tracking says Taoyuan and has said Taoyuan for four days, that is customs. Those we cannot hurry, but we can tell you what they are waiting for.',
    ] },

    { topic: 'Orders and delivery', q: 'Can I change the address after ordering?', helpful: 90, votes: 96, opens: 690, updated: '28 Jul', a: [
        'Until the label prints, which is 16:00 on the day before the van. Write in with the order number and the new address and it costs nothing.',
    ] },

    { topic: 'Orders and delivery', q: 'Do you ship outside Taiwan, and who pays the duty?', helpful: 86, votes: 134, opens: 920, updated: '30 Jul', a: [
        'Sixteen countries, and the price you see at checkout is the price at your door — duty and handling are ours, and we would rather quote high than have a courier ask you for money.',
    ] },

    { topic: 'Before you buy', q: 'Jade or graphite — does the finish change anything?', helpful: 98, votes: 245, opens: 2100, updated: '12 Aug', a: [
        'Nothing that touches the coffee. Same burrs, same motor, same gap. The graphite hides grounds and shows fingerprints; the jade does the reverse. Pick the one you want on your counter at seven in the morning.',
    ] },

    { topic: 'Before you buy', q: 'Will it hold a 58 mm portafilter?', helpful: 95, votes: 112, opens: 780, updated: '19 Jul', a: [
        'The fork adjusts between 49 and 58 mm. Anything wider than 58 needs the dosing cup, which is in the box.',
    ] },

    { topic: 'Dealers', q: 'What do dealer terms look like for two shops?', helpful: 90, votes: 41, opens: 260, updated: '1 Aug', a: [
        'Six units to open the account, 40% off list, and 60 days. Below six we would rather sell you three at retail than sign paperwork neither of us wants to administer.',
    ] },
];

const searched = ['noise', 'batch 40', 'warranty', 'burr gap', 'shipping', 'static', 'refund'];

const term = ref('');
const topic = ref(null);
const forced = ref(null);

const listed = computed(() => questions.filter((entry) => {
    const haystack = `${entry.q} ${entry.topic}`.toLowerCase();

    return (topic.value === null || entry.topic === topic.value)
        && (term.value.trim() === '' || haystack.includes(term.value.trim().toLowerCase()));
}));

const pick = (name) => {
    topic.value = topic.value === name ? null : name;
};

const suggest = (word) => {
    term.value = term.value.trim().toLowerCase() === word ? '' : word;
};

const clear = () => {
    term.value = '';
    topic.value = null;
};

const toggleAll = () => {
    forced.value = forced.value === true ? false : true;
};

const opened = (entry) => forced.value === true || (listed.value.length === 1 && term.value.trim() !== '' && listed.value[0] === entry);
</script>

<template>
    <FaqShell active="Answers" :padded="false">
        <div class="flex min-h-0 flex-1 flex-col overflow-hidden">
            <div class="shrink-0 border-b border-white/5 px-5 py-5">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <h1 class="text-lg font-semibold tracking-tight text-cream">Sixteen answers</h1>
                        <p class="mt-1 max-w-lg text-[13px]/6 text-zinc-500">
                            Four of them are about noise, which is what eight out of every ten letters are about.
                            Everything here was written by whoever answered it the first time.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="shrink-0 rounded-lg border border-white/10 px-3 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                        @click="toggleAll"
                    >{{ forced === true ? 'close every one' : 'open every one' }}</button>
                </div>

                <label class="relative mt-4 flex max-w-xl items-center">
                    <svg class="pointer-events-none absolute left-3.5 size-4 text-zinc-600" viewBox="0 0 16 16" fill="none">
                        <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <input
                        v-model="term"
                        type="search"
                        spellcheck="false"
                        placeholder="Describe it the way you would say it out loud"
                        class="w-full rounded-xl border border-white/10 bg-ink-900 py-2.5 pr-3 pl-10 text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                    >
                    <span class="sr-only">Search the answers</span>
                </label>

                <div class="mt-2.5 flex flex-wrap items-center gap-1.5">
                    <span class="font-mono text-[10px] text-zinc-700">this week</span>
                    <button
                        v-for="word in searched"
                        :key="word"
                        type="button"
                        class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                        @click="suggest(word)"
                    >{{ word }}</button>
                </div>
            </div>

            <div class="min-h-0 flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 gap-2.5 px-5 py-5 sm:grid-cols-2 xl:grid-cols-3">
                    <FaqTopic
                        v-for="entry in topics"
                        :key="entry.name"
                        :name="entry.name"
                        :count="entry.count"
                        :lead="entry.lead"
                        :health="entry.health"
                        :note="entry.note"
                        :active="topic === entry.name"
                        @click="pick(entry.name)"
                    />
                </div>

                <div class="flex items-center gap-3 border-y border-white/5 bg-ink-900/40 px-5 py-2">
                    <p class="font-mono text-[10px] text-zinc-600">
                        showing <span class="text-zinc-400">{{ listed.length }}</span> of {{ questions.length }}
                        <span v-if="topic" class="text-zinc-700">· {{ topic }}</span>
                    </p>
                    <button
                        v-if="topic !== null || term.trim() !== ''"
                        type="button"
                        class="ml-auto font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream"
                        @click="clear"
                    >clear</button>
                </div>

                <div>
                    <FaqQuestion
                        v-for="entry in listed"
                        :key="entry.q"
                        :number="questions.indexOf(entry) + 1"
                        :question="entry.q"
                        :topic="entry.topic"
                        :helpful="entry.helpful"
                        :votes="entry.votes"
                        :updated="entry.updated"
                        :stale="entry.stale ?? false"
                        :open="opened(entry)"
                    >
                        <p v-for="paragraph in entry.a" :key="paragraph">{{ paragraph }}</p>

                        <FaqCallout v-if="entry.note" :tone="entry.note.tone" :label="entry.note.label" class="mt-4">
                            <p>{{ entry.note.text }}</p>
                        </FaqCallout>

                        <template #footer>
                            <div class="flex flex-wrap items-center gap-3">
                                <a
                                    v-if="entry.full"
                                    href="/templates/faq/screens/answer"
                                    target="_top"
                                    class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                                >
                                    The whole thing, with photographs
                                    <svg class="size-3" viewBox="0 0 16 16" fill="none"><path d="M6 3.5 10.5 8 6 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>

                                <span class="font-mono text-[10px] text-zinc-700">opened {{ entry.opens.toLocaleString() }} times</span>

                                <a href="/templates/faq/screens/ask" target="_top" class="ml-auto font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">this did not answer it →</a>
                            </div>
                        </template>
                    </FaqQuestion>

                    <div v-if="listed.length === 0" class="px-5 py-16 text-center">
                        <p class="font-mono text-[11px] text-zinc-600">Nobody has written that one down yet.</p>
                        <p class="mx-auto mt-2 max-w-sm text-[12px]/5 text-zinc-700">
                            Which is worth knowing on its own — every search that lands here goes on a list, and the list is what gets written next.
                        </p>
                        <a href="/templates/faq/screens/ask" target="_top" class="mt-4 inline-block rounded-lg bg-jade-500 px-3.5 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">Ask the desk instead</a>
                    </div>
                </div>

                <div class="px-5 py-8">
                    <div class="flex flex-wrap items-center justify-between gap-4 rounded-xl border border-white/8 bg-ink-900 px-5 py-4">
                        <div>
                            <p class="text-[13px] text-zinc-300">Still not it?</p>
                            <p class="mt-1 text-[12px]/5 text-zinc-600">Nine questions found nothing last month. Yours might be the tenth, and we would rather hear it.</p>
                        </div>
                        <a href="/templates/faq/screens/ask" target="_top" class="shrink-0 rounded-lg border border-white/10 px-3.5 py-2 text-[13px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Write to the desk</a>
                    </div>
                </div>
            </div>
        </div>
    </FaqShell>
</template>
