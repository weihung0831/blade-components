<script setup>
import { computed, ref } from 'vue';
import KanbanShell from './Shell.vue';
import KanbanAssignee from './Assignee.vue';

const weeks = [
    {
        slug: '33',
        label: 'Week 33',
        range: '17–21 Aug · batch 41 ships Thursday',
        days: ['Mon 17', 'Tue 18', 'Wed 19', 'Thu 20', 'Fri 21'],
        note: 'Everyone wants the van on Thursday, so everyone booked Thursday. The board says the same thing from the other end: bench test is at its limit and assembly is over it.',
        crew: [
            { name: 'Mei Tsai', role: 'assembly · bench 1', capacity: 8, hours: [7, 8, 6, 10, 5] },
            { name: 'Piotr Adamek', role: 'machining · TM-1, lathe 2', capacity: 8, hours: [8, 9, 8, 11, 4] },
            { name: 'Lena Kohler', role: 'test · grind rig', capacity: 8, hours: [4, 6, 7, 9, 8] },
            { name: 'Idris Bahar', role: 'supply · packing', capacity: 6, hours: [3, 4, 5, 8, 6] },
        ],
        machines: [
            { name: 'TM-1', note: 'carriers, jade run', booked: 22, available: 40 },
            { name: 'Lathe 2', note: 'chatters above 1800 rpm', booked: 31, available: 40, flag: true },
            { name: 'Mill', note: 'motor mounts', booked: 18, available: 40 },
            { name: 'Grind rig', note: 'bench test, 3 kg a machine', booked: 27, available: 40 },
            { name: 'Benches 1–3', note: 'assembly and rework', booked: 96, available: 120 },
        ],
    },
    {
        slug: '34',
        label: 'Week 34',
        range: '24–28 Aug · lathe 2 down Monday and Tuesday',
        days: ['Mon 24', 'Tue 25', 'Wed 26', 'Thu 27', 'Fri 28'],
        note: 'Looks like room, is not. Batch 42 has not been scheduled yet and the backlog is holding 63 hours, most of which wants a lathe that is in pieces until Wednesday.',
        crew: [
            { name: 'Mei Tsai', role: 'assembly · bench 1', capacity: 8, hours: [6, 5, 7, 6, 4] },
            { name: 'Piotr Adamek', role: 'machining · TM-1, lathe 2', capacity: 8, hours: [7, 8, 6, 5, 3] },
            { name: 'Lena Kohler', role: 'test · grind rig', capacity: 8, hours: [5, 5, 4, 6, 5] },
            { name: 'Idris Bahar', role: 'supply · packing', capacity: 6, hours: [4, 3, 4, 5, 3] },
        ],
        machines: [
            { name: 'TM-1', note: 'spare carriers', booked: 14, available: 40 },
            { name: 'Lathe 2', note: 'tool holder swap, 16 h down', booked: 8, available: 24, flag: true },
            { name: 'Mill', note: 'keyed loom bracket', booked: 21, available: 40 },
            { name: 'Grind rig', note: 'particle runs', booked: 19, available: 40 },
            { name: 'Benches 1–3', note: 'assembly', booked: 72, available: 120 },
        ],
    },
];

const current = ref('33');
const focused = ref(null);

const week = computed(() => weeks.find((entry) => entry.slug === current.value));

const booked = computed(() => week.value.crew.reduce((sum, person) => sum + person.hours.reduce((a, b) => a + b, 0), 0));
const roster = computed(() => week.value.crew.reduce((sum, person) => sum + person.capacity * 5, 0));

const overs = computed(() => week.value.days
    .map((label, index) => ({
        label: label.split(' ')[0],
        excess: week.value.crew.reduce((sum, person) => sum + Math.max(0, person.hours[index] - person.capacity), 0),
    }))
    .filter((day) => day.excess > 0)
    .map((day) => `${day.label} over by ${day.excess} h`));

const toggle = (name) => {
    focused.value = focused.value === name ? null : name;
};
</script>

<template>
    <KanbanShell active="Workload">
        <div class="mx-auto w-full max-w-5xl">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h1 class="text-xl font-semibold tracking-tight text-cream">Who is carrying what</h1>
                    <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                        Hours already promised, against the hours the roster actually has. Anything over the day's capacity is somebody staying late or a job slipping — the board finds out on Thursday either way.
                    </p>
                </div>

                <div class="flex items-center gap-1 rounded-lg bg-ink-900 p-0.5">
                    <label
                        v-for="entry in weeks"
                        :key="entry.slug"
                        class="cursor-pointer rounded-md px-3 py-1.5 font-mono text-[11px] transition-colors duration-150"
                        :class="current === entry.slug ? 'bg-white/10 text-cream' : 'text-zinc-500 hover:text-cream'"
                    >
                        <input v-model="current" type="radio" name="workload-week" :value="entry.slug" class="sr-only">
                        {{ entry.label }}
                    </label>
                </div>
            </div>

            <div class="mt-6">
                <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1 font-mono text-[11px] text-zinc-600">
                    <span class="text-zinc-400">{{ week.range }}</span>
                    <span>{{ booked }} h booked of {{ roster }} h on the roster</span>
                    <span v-if="overs.length" class="text-red-300">{{ overs.join(' · ') }}</span>
                </div>

                <div class="mt-4 overflow-x-auto rounded-2xl border border-white/8 bg-ink-900 p-3">
                    <div class="min-w-[48rem]">
                        <div class="grid grid-cols-[12.5rem_repeat(5,minmax(0,1fr))_6rem] items-center gap-2 px-1 pb-2 font-mono text-[10px] text-zinc-600">
                            <span>on the roster</span>
                            <span v-for="label in week.days" :key="label" class="text-center">{{ label }}</span>
                            <span class="text-right">week</span>
                        </div>

                        <div class="flex flex-col gap-2">
                            <div
                                v-for="person in week.crew"
                                :key="person.name"
                                class="grid grid-cols-[12.5rem_repeat(5,minmax(0,1fr))_6rem] items-stretch gap-2 rounded-xl p-1 transition-opacity duration-200"
                                :class="focused && focused !== person.name ? 'opacity-30' : ''"
                            >
                                <button
                                    type="button"
                                    class="flex items-center gap-2.5 rounded-lg px-2 py-1.5 text-left transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    @click="toggle(person.name)"
                                >
                                    <KanbanAssignee :name="person.name" size="sm" />
                                    <span class="min-w-0">
                                        <span class="block truncate text-[13px] text-cream">{{ person.name }}</span>
                                        <span class="block truncate font-mono text-[10px] text-zinc-600">{{ person.role }}</span>
                                    </span>
                                </button>

                                <div
                                    v-for="(hours, index) in person.hours"
                                    :key="index"
                                    class="rounded-lg border px-2 py-1.5"
                                    :class="hours > person.capacity ? 'border-red-400/40 bg-red-500/10' : 'border-white/8 bg-ink-950'"
                                    :title="`${person.name} · ${week.days[index]} · ${hours} h against ${person.capacity}`"
                                >
                                    <span class="font-mono text-[11px]" :class="hours > person.capacity ? 'text-red-300' : 'text-zinc-300'">{{ hours }} h</span>
                                    <span class="mt-1.5 block h-0.5 overflow-hidden rounded-full bg-white/10">
                                        <span
                                            class="block h-full rounded-full"
                                            :class="hours > person.capacity ? 'bg-red-400' : 'bg-jade-500/70'"
                                            :style="{ width: `${Math.min(100, (hours / person.capacity) * 100)}%` }"
                                        ></span>
                                    </span>
                                    <span class="mt-1.5 block font-mono text-[10px]" :class="hours > person.capacity ? 'text-red-300/80' : 'text-zinc-700'">
                                        {{ hours > person.capacity ? `+${hours - person.capacity} over` : `${person.capacity - hours} free` }}
                                    </span>
                                </div>

                                <div class="flex flex-col items-end justify-center gap-1.5 px-1">
                                    <span class="font-mono text-[11px]" :class="person.hours.reduce((a, b) => a + b, 0) > person.capacity * 5 ? 'text-red-300' : 'text-zinc-400'">
                                        {{ person.hours.reduce((a, b) => a + b, 0) }}/{{ person.capacity * 5 }}
                                    </span>
                                    <span class="block h-0.5 w-full overflow-hidden rounded-full bg-white/10">
                                        <span
                                            class="block h-full rounded-full bg-jade-500/70"
                                            :style="{ width: `${Math.min(100, (person.hours.reduce((a, b) => a + b, 0) / (person.capacity * 5)) * 100)}%` }"
                                        ></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 grid gap-4 lg:grid-cols-[minmax(0,1fr)_18rem]">
                    <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Machines</p>
                        <ul class="mt-4 flex flex-col gap-3.5">
                            <li v-for="machine in week.machines" :key="machine.name">
                                <div class="flex items-baseline gap-2.5">
                                    <span class="text-[13px] text-zinc-300">{{ machine.name }}</span>
                                    <span class="font-mono text-[10px]" :class="machine.flag ? 'text-red-300' : 'text-zinc-700'">{{ machine.note }}</span>
                                    <span class="ml-auto font-mono text-[11px]" :class="machine.booked / machine.available >= 0.75 ? 'text-amber-300' : 'text-zinc-500'">
                                        {{ machine.booked }}/{{ machine.available }} h
                                    </span>
                                </div>
                                <span class="mt-2 block h-1 overflow-hidden rounded-full bg-white/8">
                                    <span
                                        class="block h-full rounded-full"
                                        :class="machine.booked / machine.available >= 0.75 ? 'bg-amber-400' : 'bg-jade-500/70'"
                                        :style="{ width: `${Math.min(100, (machine.booked / machine.available) * 100)}%` }"
                                    ></span>
                                </span>
                            </li>
                        </ul>
                    </section>

                    <section class="flex flex-col gap-4">
                        <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">What this says</p>
                            <p class="mt-2.5 text-[13px]/6 text-zinc-400">{{ week.note }}</p>
                        </div>

                        <a href="/templates/kanban/screens/backlog" target="_top" class="group/link flex items-center gap-3 rounded-2xl border border-white/8 bg-ink-900 p-5 transition-colors duration-150 hover:border-jade-500/50">
                            <span>
                                <span class="block text-[13px] text-cream">Move something out</span>
                                <span class="mt-1 block font-mono text-[10px] text-zinc-600">the backlog holds 63 h more</span>
                            </span>
                            <svg class="ml-auto size-4 text-zinc-600 transition-transform duration-200 ease-snap group-hover/link:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </section>
                </div>
            </div>
        </div>
    </KanbanShell>
</template>
