<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: { type: String, required: true },
    state: { type: String, default: 'normal' },
    means: { type: String, default: null },
    since: { type: String, default: null },
});

const states = {
    normal: { label: 'normal', dot: 'bg-jade-500', text: 'text-zinc-600' },
    slow: { label: 'slow', dot: 'bg-amber-400', text: 'text-amber-300' },
    down: { label: 'down', dot: 'bg-red-400', text: 'text-red-400' },
    off: { label: 'off on purpose', dot: 'bg-white/25', text: 'text-zinc-500' },
};

const mark = computed(() => states[props.state] ?? states.normal);
</script>

<template>
    <div :data-state="state" class="flex items-start gap-3 px-3.5 py-2.5">
        <span class="mt-1.5 size-1.5 shrink-0 rounded-full" :class="mark.dot"></span>

        <span class="min-w-0 flex-1">
            <span class="flex flex-wrap items-baseline gap-x-2">
                <span class="text-[13px]/5 text-cream">{{ name }}</span>
                <span class="font-mono text-[10px]" :class="mark.text">{{ mark.label }}</span>
                <span v-if="since" class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ since }}</span>
            </span>

            <span v-if="means" class="mt-0.5 block text-[11px]/5 text-zinc-500">{{ means }}</span>
        </span>
    </div>
</template>
