<script setup>
import { ref } from 'vue';

const props = defineProps({
    nodes: { type: Array, default: () => [] },
    depth: { type: Number, default: 0 },
});

const openState = ref(props.nodes.map((node) => Boolean(node.open)));

const toggle = (index) => {
    openState.value[index] = !openState.value[index];
};
</script>

<template>
    <div :class="depth === 0 && 'flex flex-col text-[13px]'">
        <template v-for="(node, index) in nodes" :key="node.label">
            <div v-if="node.children?.length">
                <button
                    type="button"
                    @click="toggle(index)"
                    class="flex w-full cursor-pointer items-center gap-1.5 rounded-md px-2 py-1 text-left text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream"
                >
                    <svg class="size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" :class="openState[index] && 'rotate-90'" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    {{ node.label }}
                </button>
                <div v-if="openState[index]" class="ml-3.5 border-l border-white/10 pl-1.5">
                    <Tree :nodes="node.children" :depth="depth + 1" />
                </div>
            </div>
            <div
                v-else
                class="flex items-center gap-1.5 rounded-md px-2 py-1 pl-6.5 transition-colors duration-150"
                :class="node.active ? 'text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'"
            >
                {{ node.label }}
            </div>
        </template>
    </div>
</template>
