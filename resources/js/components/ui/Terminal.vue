<script setup>
import { computed } from 'vue';

const props = defineProps({
    lines: { type: Array, default: () => [] },
    title: { type: String, default: null },
    variant: { type: String, default: 'window' },
    cursor: { type: Boolean, default: false },
});

const frames = {
    window: 'border border-white/10',
    plain: 'border border-white/5',
};

const classes = computed(() => [
    'overflow-hidden rounded-lg bg-ink-950 font-mono text-xs/6',
    frames[props.variant] ?? frames.window,
]);
</script>

<template>
    <div :class="classes">
        <div v-if="variant === 'window'" class="flex items-center gap-1.5 border-b border-white/5 px-3.5 py-2.5">
            <span class="size-2 rounded-full bg-white/10"></span>
            <span class="size-2 rounded-full bg-white/10"></span>
            <span class="size-2 rounded-full bg-white/10"></span>
            <span v-if="title !== null" class="ml-2 text-[11px] text-zinc-600">{{ title }}</span>
        </div>
        <div class="p-3.5">
            <template v-for="(line, index) in lines" :key="index">
                <p v-if="line.type === 'command'"><span class="text-jade-400">$</span> <span class="text-zinc-300">{{ line.text }}</span></p>
                <p v-else-if="line.type === 'success'" class="text-zinc-500">{{ line.text }} <span class="text-jade-400">✓</span></p>
                <p v-else class="text-zinc-500">{{ line.text }}</p>
            </template>
            <p v-if="cursor"><span class="text-jade-400">$</span> <span class="ml-0.5 inline-block h-3.5 w-2 animate-pulse bg-jade-400 align-middle"></span></p>
        </div>
    </div>
</template>
