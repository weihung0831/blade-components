<script setup>
import { computed, ref } from 'vue';
import KanbanShell from './Shell.vue';
import KanbanColumn from './Column.vue';
import KanbanCard from './Card.vue';
import KanbanAssignee from './Assignee.vue';

const stations = [
    { slug: 'queued', name: 'Queued', machine: 'not on a machine yet', limit: null },
    { slug: 'machining', name: 'Machining', machine: 'TM-1 · lathe 2 · mill', limit: 3 },
    { slug: 'assembly', name: 'Assembly', machine: 'benches 1–3', limit: 4 },
    { slug: 'bench-test', name: 'Bench test', machine: 'grind rig · sieve stack', limit: 2 },
    { slug: 'shipped', name: 'Shipped', machine: 'packing, Thursday van', limit: null },
];

const crew = ['Mei Tsai', 'Piotr Adamek', 'Lena Kohler', 'Idris Bahar'];

const jobs = ref([
    { code: 'NS-1102', column: 'queued', title: 'Shim 24 burr seats from the Tuesday batch', tags: [{ label: 'Rework', tone: 'alert' }, { label: 'Batch 41', tone: 'batch' }], assignee: 'Mei Tsai', done: 0, steps: 4, qty: 24, days: 1 },
    { code: 'NS-1097', column: 'queued', title: 'Deepen the dosing cup lip by 0.4 mm', tags: [{ label: 'ECR-19', tone: 'batch' }], assignee: 'Piotr Adamek', done: 0, steps: 6, qty: 60, days: 2 },
    { code: 'NS-1094', column: 'queued', title: 'Re-anodise the 12 handles that came back streaked', tags: [{ label: 'Supplier', tone: 'plain' }], assignee: 'Idris Bahar', done: 0, steps: 3, qty: 12, days: 4 },
    { code: 'NS-1090', column: 'queued', title: 'Second-source the M4 grub screw', tags: [{ label: 'Supply', tone: 'plain' }, { label: 'Held', tone: 'hold' }], assignee: 'Idris Bahar', done: 1, steps: 5, days: 3, blocked: true },
    { code: 'NS-1086', column: 'queued', title: 'Write the bench card for the jade finish', tags: [{ label: 'Docs', tone: 'quiet' }], assignee: 'Lena Kohler', done: 0, steps: 2, days: 6 },
    { code: 'NS-1081', column: 'queued', title: 'Fixture for the 45° chamfer, so it stops being hand-held', tags: [{ label: 'Tooling', tone: 'plain' }], assignee: 'Piotr Adamek', done: 2, steps: 7, days: 9 },
    { code: 'NS-1076', column: 'machining', title: 'Turn 60 burr carriers, jade run', tags: [{ label: 'Batch 41', tone: 'batch' }], assignee: 'Piotr Adamek', station: 'TM-1', done: 3, steps: 5, qty: 60, days: 2 },
    { code: 'NS-1073', column: 'machining', title: 'Bore the motor mount 0.02 under', tags: [{ label: 'ECR-18', tone: 'batch' }], assignee: 'Piotr Adamek', station: 'mill', done: 4, steps: 6, qty: 60, days: 3 },
    { code: 'NS-1071', column: 'machining', title: 'Cut 40 collars, graphite', tags: [{ label: 'Batch 41', tone: 'batch' }], assignee: 'Mei Tsai', station: 'lathe 2', done: 1, steps: 4, qty: 40, days: 1 },
    { code: 'NS-1068', column: 'machining', title: 'Lathe 2 chatters above 1800 rpm', tags: [{ label: 'Machine', tone: 'alert' }], assignee: 'Piotr Adamek', station: 'lathe 2', done: 1, steps: 3, days: 5, blocked: true },
    { code: 'NS-1064', column: 'assembly', title: 'Press burr sets into 40 carriers', tags: [{ label: 'Batch 41', tone: 'batch' }], assignee: 'Mei Tsai', station: 'bench 1', done: 2, steps: 4, qty: 40, days: 2 },
    { code: 'NS-1061', column: 'assembly', title: 'Fit the shimmed seats, first 24', tags: [{ label: 'Rework', tone: 'alert' }, { label: 'Batch 41', tone: 'batch' }], assignee: 'Mei Tsai', station: 'bench 1', done: 3, steps: 4, qty: 24, days: 1 },
    { code: 'NS-1058', column: 'assembly', title: 'Wire 40 motors on the new loom', tags: [{ label: 'ECR-18', tone: 'batch' }], assignee: 'Lena Kohler', station: 'bench 2', done: 2, steps: 6, qty: 40, days: 3 },
    { code: 'NS-1055', column: 'assembly', title: 'Torque check every hopper thread', tags: [{ label: 'QA', tone: 'plain' }], assignee: 'Lena Kohler', station: 'bench 3', done: 5, steps: 8, qty: 40, days: 4 },
    { code: 'NS-1052', column: 'assembly', title: 'Label and serialise the jade run', tags: [{ label: 'Batch 41', tone: 'batch' }], assignee: 'Idris Bahar', station: 'bench 3', done: 0, steps: 3, qty: 60, days: 1 },
    { code: 'NS-1047', column: 'bench-test', title: 'Grind 3 kg through each of the first eight', tags: [{ label: 'QA', tone: 'plain' }], assignee: 'Lena Kohler', station: 'grind rig', done: 6, steps: 8, qty: 8, days: 2 },
    { code: 'NS-1043', column: 'bench-test', title: 'Particle spread: shimmed seats against the old ones', tags: [{ label: 'Rework', tone: 'alert' }], assignee: 'Lena Kohler', station: 'sieve stack', done: 2, steps: 5, qty: 6, days: 3 },
    { code: 'NS-1038', column: 'shipped', title: 'Batch 40, 48 units to the Osaka distributor', tags: [{ label: 'Shipped', tone: 'quiet' }], assignee: 'Idris Bahar', done: 4, steps: 4, qty: 48, days: 7 },
    { code: 'NS-1034', column: 'shipped', title: 'Twelve warranty machines, seats swapped', tags: [{ label: 'Rework', tone: 'quiet' }], assignee: 'Mei Tsai', done: 6, steps: 6, qty: 12, days: 8 },
    { code: 'NS-1029', column: 'shipped', title: 'Six show units for the Taipei fair', tags: [{ label: 'Shipped', tone: 'quiet' }], assignee: 'Idris Bahar', done: 3, steps: 3, qty: 6, days: 11 },
    { code: 'NS-1025', column: 'shipped', title: 'Sample pair back to the burr supplier', tags: [{ label: 'Supplier', tone: 'quiet' }], assignee: 'Lena Kohler', done: 2, steps: 2, qty: 2, days: 14 },
]);

const owners = ref([]);
const blockedOnly = ref(false);
const term = ref('');
const dragging = ref(null);

const blocked = computed(() => jobs.value.filter((job) => job.blocked).length);

const matches = (job) => {
    const haystack = `${job.code} ${job.title} ${job.assignee} ${job.tags.map((tag) => tag.label).join(' ')}`.toLowerCase();

    return (owners.value.length === 0 || owners.value.includes(job.assignee))
        && (!blockedOnly.value || job.blocked === true)
        && (term.value.trim() === '' || haystack.includes(term.value.trim().toLowerCase()));
};

const held = (slug) => jobs.value.filter((job) => job.column === slug);
const listed = (slug) => held(slug).filter(matches);

const showing = computed(() => jobs.value.filter(matches).length);

const move = (slug) => {
    const job = jobs.value.find((entry) => entry.code === dragging.value);

    if (!job || job.column === slug) {
        return;
    }

    job.column = slug;
    jobs.value = [...jobs.value.filter((entry) => entry !== job), job];
};
</script>

<template>
    <KanbanShell active="Board" :padded="false">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2.5">
                <label class="relative flex items-center">
                    <svg class="pointer-events-none absolute left-2.5 size-3.5 text-zinc-600" viewBox="0 0 16 16" fill="none">
                        <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <input
                        v-model="term"
                        type="search"
                        placeholder="Find a job, a ref, a name"
                        class="w-56 rounded-lg border border-white/10 bg-ink-900 py-1.5 pr-3 pl-8 text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                    >
                    <span class="sr-only">Filter the board</span>
                </label>

                <div class="flex items-center gap-1.5">
                    <label
                        v-for="person in crew"
                        :key="person"
                        class="cursor-pointer rounded-full transition-opacity duration-150"
                        :class="owners.includes(person) ? 'opacity-100 ring-2 ring-jade-500/70' : 'opacity-45'"
                    >
                        <input v-model="owners" type="checkbox" :value="person" class="sr-only">
                        <KanbanAssignee :name="person" size="sm" />
                        <span class="sr-only">{{ person }}</span>
                    </label>
                </div>

                <label
                    class="flex cursor-pointer items-center gap-2 rounded-lg border px-2.5 py-1.5 font-mono text-[11px] transition-colors duration-150"
                    :class="blockedOnly ? 'border-red-400/50 text-red-300' : 'border-white/10 text-zinc-500 hover:text-cream'"
                >
                    <input v-model="blockedOnly" type="checkbox" class="sr-only">
                    <span class="size-1.5 rounded-full bg-red-400"></span>
                    blocked only
                </label>

                <p class="ml-auto font-mono text-[10px] text-zinc-600">
                    <span class="text-zinc-400">{{ showing }}</span> of {{ jobs.length }} jobs · {{ blocked }} blocked · drag one anywhere
                </p>
            </div>
        </template>

        <div class="flex min-h-0 flex-1 gap-4 overflow-x-auto px-4 py-4 sm:px-5">
            <KanbanColumn
                v-for="station in stations"
                :key="station.slug"
                :station="station"
                :count="held(station.slug).length"
                @drop="move(station.slug)"
            >
                <KanbanCard
                    v-for="job in listed(station.slug)"
                    :key="job.code"
                    :job="job"
                    :dragging="dragging === job.code"
                    @dragstart="dragging = job.code"
                    @dragend="dragging = null"
                />
            </KanbanColumn>
        </div>

        <footer class="flex shrink-0 flex-wrap items-center gap-x-5 gap-y-2 border-t border-white/5 px-4 py-2.5 font-mono text-[10px] text-zinc-600 sm:px-5">
            <span class="flex items-center gap-1.5"><span class="h-2.5 w-0.5 rounded-full bg-red-400"></span>blocked, someone else owns the next move</span>
            <span class="flex items-center gap-1.5"><span class="h-0.5 w-5 rounded-full bg-jade-500/70"></span>station load against its limit</span>
            <span class="hidden sm:inline">limits come off the roster, not a guess: two people on machining, four benches, one grind rig</span>
            <span class="ml-auto">board reads from the shop tablet · last move 6 min ago</span>
        </footer>
    </KanbanShell>
</template>
