<script setup>
import { computed, ref } from 'vue';
import BlogShell from './Shell.vue';
import BlogTopicPill from './TopicPill.vue';

const years = [
    {
        year: 2026,
        notes: [
            { date: '12 Aug', title: 'What 412 returned grinders told us about alignment', topic: 'Machines', read: 14 },
            { date: '29 Jul', title: 'We stopped putting the tamper in the box. Nobody wrote in.', topic: 'Supply', read: 6 },
            { date: '15 Jul', title: 'The 0.05 mm shim that closed a five-year complaint', topic: 'Workshop', read: 9 },
            { date: '1 Jul', title: 'Lead time doubled in March. Here is the whole chain.', topic: 'Supply', read: 11 },
            { date: '17 Jun', title: 'Burr seasoning is mostly folklore, and here is 40 kg of it', topic: 'Method', read: 13 },
            { date: '3 Jun', title: 'A bench test you can run with a phone and a spirit level', topic: 'Method', read: 5 },
            { date: '20 May', title: 'Why the warranty follows the serial and not the receipt', topic: 'Workshop', read: 4 },
            { date: '6 May', title: 'Anodising in Taichung: three shops, one finish, three prices', topic: 'Supply', read: 8 },
            { date: '22 Apr', title: 'The retention bin we removed, then put back', topic: 'Machines', read: 7 },
        ],
    },
    {
        year: 2025,
        notes: [
            { date: '18 Dec', title: 'Two years of repair tickets, sorted by what people actually said', topic: 'Workshop', read: 12 },
            { date: '4 Nov', title: 'The packing foam that failed one drop test in four', topic: 'Supply', read: 6 },
            { date: '9 Sep', title: 'Grinding at 1400 rpm against 900: what the sieve says', topic: 'Method', read: 15 },
            { date: '12 Aug', title: 'We priced a repair at cost for a year. Here is the ledger.', topic: 'Workshop', read: 10 },
            { date: '3 Jun', title: 'A hopper redesign that made the machine quieter by accident', topic: 'Machines', read: 7 },
            { date: '21 Mar', title: 'Why we build to stock in February and to order in August', topic: 'Supply', read: 9 },
        ],
    },
    {
        year: 2024,
        notes: [
            { date: '2 Dec', title: 'The espresso setting is a range, not a number', topic: 'Method', read: 8 },
            { date: '15 Oct', title: 'Six months on a coating that was supposed to last five years', topic: 'Machines', read: 11 },
            { date: '7 Jul', title: 'What a 12 kg week does to a burr set, measured weekly', topic: 'Method', read: 14 },
            { date: '19 Apr', title: 'The first hundred machines, and the eleven that came back', topic: 'Workshop', read: 13 },
            { date: '8 Feb', title: 'Sourcing 83 mm blanks when nobody wants to cut fifty', topic: 'Supply', read: 10 },
        ],
    },
    {
        year: 2023,
        notes: [
            { date: '28 Nov', title: 'Choosing a motor when the datasheet is optimistic', topic: 'Machines', read: 9 },
            { date: '14 Nov', title: 'Why this bench exists, and what we plan to write down', topic: 'Workshop', read: 4 },
        ],
    },
];

const topics = ['Workshop', 'Machines', 'Supply', 'Method'];
const flat = years.flatMap((group) => group.notes);
const total = flat.length;

const topic = ref('all');
const term = ref('');

const countFor = (name) => flat.filter((note) => note.topic === name).length;

const matches = (note) => {
    const needle = term.value.trim().toLowerCase();

    return (topic.value === 'all' || note.topic === topic.value)
        && (needle === '' || `${note.title} ${note.topic}`.toLowerCase().includes(needle));
};

const groups = computed(() => years
    .map((group) => ({ year: group.year, notes: group.notes.filter(matches) }))
    .filter((group) => group.notes.length > 0));

const shown = computed(() => groups.value.reduce((sum, group) => sum + group.notes.length, 0));
</script>

<template>
    <BlogShell active="Archive">
        <div>
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-cream">Everything, oldest at the bottom</h1>
                    <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                        Nothing here has been taken down. Two pieces carry corrections at the top, and one was rewritten in 2025 with the original left underneath it.
                    </p>
                </div>
                <span class="font-mono text-[10px] text-zinc-600">{{ total }} notes · Nov 2023 to now</span>
            </div>

            <div class="mt-8 flex flex-col gap-4">
                <div class="relative">
                    <svg class="pointer-events-none absolute top-1/2 left-4 size-4 -translate-y-1/2 text-zinc-600" viewBox="0 0 16 16" fill="none">
                        <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/>
                        <path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>

                    <input
                        v-model="term"
                        type="search"
                        placeholder="Search titles and topics"
                        aria-label="Search the archive"
                        class="h-12 w-full rounded-xl border border-white/10 bg-ink-900 pr-28 pl-11 text-sm text-zinc-200 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500"
                    />

                    <span class="absolute top-1/2 right-4 -translate-y-1/2 font-mono text-[10px] text-zinc-600">{{ shown }} shown</span>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <BlogTopicPill v-model="topic" value="all" label="Everything" :count="total" />
                    <BlogTopicPill v-for="name in topics" :key="name" v-model="topic" :value="name" :label="name" :count="countFor(name)" />
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-10">
                <section v-for="group in groups" :key="group.year">
                    <div class="flex items-baseline gap-4">
                        <h2 class="font-mono text-sm tracking-wider text-cream">{{ group.year }}</h2>
                        <span class="h-px flex-1 bg-white/8"></span>
                        <span class="font-mono text-[10px] text-zinc-600">{{ group.notes.length }} {{ group.notes.length === 1 ? 'note' : 'notes' }}</span>
                    </div>

                    <ol class="mt-2 flex flex-col divide-y divide-white/5">
                        <li v-for="note in group.notes" :key="note.title">
                            <a href="/templates/blog/screens/article" target="_top"
                                class="group/row flex flex-wrap items-baseline gap-x-4 gap-y-1 rounded-lg px-3 py-3.5 transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <span class="w-14 shrink-0 font-mono text-[11px] text-zinc-600">{{ note.date }}</span>
                                <span class="min-w-0 flex-1 text-[14px]/6 text-zinc-300 transition-colors duration-150 group-hover/row:text-jade-300">{{ note.title }}</span>
                                <span class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ note.topic }}</span>
                                <span class="w-14 shrink-0 text-right font-mono text-[10px] text-zinc-700">{{ note.read }} min</span>
                            </a>
                        </li>
                    </ol>
                </section>

                <div v-if="shown === 0" class="rounded-2xl border border-dashed border-white/10 px-6 py-14 text-center">
                    <p class="text-[13px] text-zinc-400">No note matches that.</p>
                    <p class="mt-1 font-mono text-[10px] text-zinc-600">Mail the bench and it may become one.</p>
                </div>
            </div>
        </div>
    </BlogShell>
</template>
