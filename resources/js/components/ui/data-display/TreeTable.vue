<script setup>
import { ref } from 'vue';

const props = defineProps({
    columns: { type: Array, default: () => [] },
    rows: { type: Array, default: () => [] },
    depth: { type: Number, default: 0 },
});

const openState = ref(props.rows.map((row) => Boolean(row.open)));

const toggle = (index) => {
    openState.value[index] = !openState.value[index];
};
</script>

<template>
    <div v-if="depth === 0" class="w-full overflow-hidden rounded-lg border border-white/10 bg-ink-950 text-[13px]">
        <div class="flex items-center gap-4 bg-ink-800 px-3 py-1.5 font-mono text-[10px] tracking-wider text-zinc-500 uppercase">
            <span v-for="(column, index) in columns" :key="column" :class="index === 0 ? 'flex-1' : 'w-20 text-right'">{{ column }}</span>
        </div>
        <TreeTable :rows="rows" :depth="1" />
    </div>
    <template v-else>
        <template v-for="(row, index) in rows" :key="row.cells[0]">
            <template v-if="row.children?.length">
                <button
                    type="button"
                    @click="toggle(index)"
                    class="flex w-full cursor-pointer items-center gap-4 border-t border-white/5 px-3 py-1.5 transition-colors duration-150 hover:bg-white/5"
                >
                    <span class="flex flex-1 items-center gap-1.5 text-zinc-300" :style="{ paddingLeft: `${(depth - 1) * 16}px` }">
                        <svg class="size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" :class="openState[index] && 'rotate-90'" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ row.cells[0] }}
                    </span>
                    <span v-for="cell in row.cells.slice(1)" :key="cell" class="w-20 text-right font-mono text-[10px] text-zinc-500">{{ cell }}</span>
                </button>
                <TreeTable v-if="openState[index]" :rows="row.children" :depth="depth + 1" />
            </template>
            <div v-else class="flex items-center gap-4 border-t border-white/5 px-3 py-1.5">
                <span class="flex-1 text-zinc-400" :style="{ paddingLeft: `${(depth - 1) * 16}px` }">{{ row.cells[0] }}</span>
                <span v-for="cell in row.cells.slice(1)" :key="cell" class="w-20 text-right font-mono text-[10px] text-zinc-500">{{ cell }}</span>
            </div>
        </template>
    </template>
</template>
