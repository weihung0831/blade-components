<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    columns: { type: Array, default: () => [] },
    rows: { type: Array, default: () => [] },
    striped: { type: Boolean, default: false },
    hover: { type: Boolean, default: false },
});

const dots = {
    jade: 'bg-jade-500',
    zinc: 'bg-zinc-600',
};

const dotText = {
    jade: 'text-jade-400',
    zinc: 'text-zinc-500',
};

const isStatus = (cell) => cell !== null && typeof cell === 'object';

const isSortable = (column) => column.sortable ?? true;

const sortKey = ref(null);
const sortDir = ref('asc');

const toggleSort = (column) => {
    if (!isSortable(column)) {
        return;
    }

    if (sortKey.value === column.key) {
        sortDir.value = sortDir.value === 'asc' ? 'desc' : 'asc';
    } else {
        sortKey.value = column.key;
        sortDir.value = 'asc';
    }
};

const cellText = (cell) => String((isStatus(cell) ? cell.text : cell) ?? '');

const sortedRows = computed(() => {
    if (sortKey.value === null) {
        return props.rows;
    }

    return [...props.rows].sort((a, b) => {
        const x = cellText(a[sortKey.value]);
        const y = cellText(b[sortKey.value]);
        const nx = parseFloat(x.replace(/[$,]/g, ''));
        const ny = parseFloat(y.replace(/[$,]/g, ''));
        const order = Number.isNaN(nx) || Number.isNaN(ny) ? x.localeCompare(y) : nx - ny;

        return sortDir.value === 'asc' ? order : -order;
    });
});
</script>

<template>
    <div class="overflow-x-auto rounded-xl border border-white/10 bg-ink-950">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-ink-800">
                    <th
                        v-for="column in columns"
                        :key="column.key"
                        :data-dir="sortKey === column.key ? sortDir : null"
                        @click="toggleSort(column)"
                        class="px-4 py-2.5 font-mono text-[11px] font-normal tracking-wider text-zinc-500 uppercase"
                        :class="[
                            column.align === 'right' && 'text-right',
                            isSortable(column) && 'group/th cursor-pointer transition-colors duration-150 select-none hover:text-zinc-300 data-[dir]:text-jade-400',
                        ]"
                    >
                        <span v-if="isSortable(column)" class="inline-flex items-center gap-1">
                            {{ column.label }}
                            <svg class="size-3 shrink-0 opacity-0 transition-all duration-150 ease-snap group-hover/th:opacity-60 group-data-[dir]/th:opacity-100 group-data-[dir=desc]/th:rotate-180" viewBox="0 0 12 12" fill="none"><path d="m3 7.5 3-3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <template v-else>{{ column.label }}</template>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(row, index) in sortedRows"
                    :key="index"
                    class="border-t border-white/5"
                    :class="[striped && index % 2 === 1 && 'bg-white/3', hover && 'transition-colors duration-150 hover:bg-white/5']"
                >
                    <td
                        v-for="column in columns"
                        :key="column.key"
                        class="px-4 py-2.5 text-zinc-300"
                        :class="column.align === 'right' && 'text-right font-mono text-[13px]'"
                    >
                        <span v-if="isStatus(row[column.key])" class="inline-flex items-center gap-1.5 text-[13px]" :class="dotText[row[column.key].dot] ?? dotText.zinc">
                            <span class="size-1.5 rounded-full" :class="dots[row[column.key].dot] ?? dots.zinc"></span>
                            {{ row[column.key].text }}
                        </span>
                        <template v-else>{{ row[column.key] }}</template>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
