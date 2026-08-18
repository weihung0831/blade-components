<script setup>
import { computed } from 'vue';

const props = defineProps({
    version: { type: String, required: true },
    date: { type: String, required: true },
    state: { type: String, default: 'live' },
    lines: { type: Number, default: null },
    note: { type: String, default: null },
    lived: { type: String, default: null },
});

const states = {
    live: { label: 'live', dot: 'bg-jade-500', text: 'text-zinc-600' },
    pulled: { label: 'taken back out', dot: 'bg-red-400', text: 'text-red-400' },
    superseded: { label: 'replaced by a later one', dot: 'bg-white/25', text: 'text-zinc-700' },
    rolling: { label: 'still rolling out', dot: 'bg-amber-400', text: 'text-amber-300' },
};

const mark = computed(() => states[props.state] ?? states.live);
</script>

<template>
    <div :data-state="state" class="flex flex-wrap items-baseline gap-x-3 gap-y-1.5">
        <h3
            class="font-mono text-[15px] tracking-tight"
            :class="state === 'pulled' ? 'text-red-400 line-through decoration-red-400/40' : 'text-cream'"
        >{{ version }}</h3>

        <span class="font-mono text-[11px] text-zinc-600">{{ date }}</span>

        <span class="flex shrink-0 items-center gap-1.5 font-mono text-[10px]" :class="mark.text">
            <span class="size-1.5 rounded-full" :class="mark.dot"></span>
            {{ mark.label }}
        </span>

        <span v-if="lived" class="font-mono text-[10px] text-zinc-700">{{ lived }}</span>

        <span v-if="lines !== null" class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ lines }} {{ lines === 1 ? 'line' : 'lines' }}</span>

        <p v-if="note" class="w-full text-[11px]/5" :class="state === 'pulled' ? 'text-red-400/80' : 'text-zinc-600'">{{ note }}</p>
    </div>
</template>
