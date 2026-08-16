<script setup>
import { computed } from 'vue';

const props = defineProps({
    node: { type: Object, default: () => ({}) },
    depth: { type: Number, default: 0 },
});

const boxes = {
    default: 'border-white/10 bg-ink-800 text-zinc-300',
    jade: 'border-jade-500/40 bg-jade-500/15 text-jade-300',
};

const tone = computed(() => props.node.tone ?? (props.depth === 0 ? 'jade' : 'default'));

const boxClasses = computed(() => boxes[tone.value] ?? boxes.default);

const wrapperClasses = computed(() =>
    props.depth === 0
        ? 'inline-flex flex-col items-center text-xs'
        : 'relative flex flex-col items-center px-2 before:absolute before:top-0 before:left-0 before:h-px before:w-full before:bg-white/15 first:before:left-1/2 first:before:w-1/2 last:before:left-0 last:before:w-1/2 only:before:hidden',
);
</script>

<template>
    <div :class="wrapperClasses">
        <span v-if="depth > 0" class="h-3 w-px bg-white/15"></span>
        <span class="flex flex-col items-center whitespace-nowrap rounded-md border px-3 py-1" :class="boxClasses">
            {{ node.label }}
            <span v-if="node.meta" class="font-mono text-[10px]" :class="tone === 'jade' ? 'text-jade-400' : 'text-zinc-500'">{{ node.meta }}</span>
        </span>
        <template v-if="node.children?.length">
            <span class="h-3 w-px bg-white/15"></span>
            <div class="grid auto-cols-fr grid-flow-col items-start">
                <OrgChart v-for="child in node.children" :key="child.label" :node="child" :depth="depth + 1" />
            </div>
        </template>
    </div>
</template>
