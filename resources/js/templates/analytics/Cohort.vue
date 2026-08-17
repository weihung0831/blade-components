<script setup>
defineProps({
    columns: { type: Array, default: () => [] },
    rows: { type: Array, default: () => [] },
});

const fill = (value) => (0.1 + (value / 100) * 0.52).toFixed(3);
</script>

<template>
    <div class="overflow-x-auto">
        <table class="w-full min-w-2xl border-separate border-spacing-0 text-left">
            <thead>
                <tr>
                    <th scope="col" class="sticky left-0 z-10 bg-ink-800 pr-3 pb-2 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Cohort</th>
                    <th scope="col" class="pr-3 pb-2 text-right font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Users</th>
                    <th v-for="column in columns" :key="column" scope="col" class="pb-2 text-center font-mono text-[10px] tracking-wider text-zinc-600 uppercase">
                        {{ column }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="row in rows" :key="row.label">
                    <th scope="row" class="sticky left-0 z-10 bg-ink-800 py-0.5 pr-3 text-[13px] font-normal whitespace-nowrap text-zinc-300">{{ row.label }}</th>
                    <td class="py-0.5 pr-3 text-right font-mono text-[11px] text-zinc-500">{{ row.size }}</td>

                    <td v-for="(value, index) in row.values" :key="index" class="p-0.5">
                        <div v-if="value === null" class="h-9 rounded-md border border-dashed border-white/8"></div>

                        <div v-else class="relative grid h-9 place-items-center overflow-hidden rounded-md bg-ink-950">
                            <span aria-hidden="true" class="absolute inset-0 bg-jade-500" :style="{ opacity: fill(value) }"></span>
                            <span class="relative font-mono text-[11px] text-cream">{{ value }}%</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
