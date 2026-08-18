<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    value: { type: Number, default: 0 },
    max: { type: Number, default: 100 },
    display: { type: String, default: null },
    note: { type: String, default: null },
    tone: { type: String, default: 'quiet' },
    marker: { type: Number, default: null },
});

const tones = {
    quiet: 'bg-white/15',
    ours: 'bg-jade-500',
    warn: 'bg-amber-400/70',
    bad: 'bg-red-400/60',
};

const width = computed(() => (props.max > 0 ? Math.min(100, (props.value / props.max) * 100) : 0));
const fill = computed(() => tones[props.tone] ?? tones.quiet);
</script>

<template>
    <div class="flex flex-col gap-1.5">
        <div class="flex items-baseline gap-3">
            <span class="min-w-0 flex-1 truncate text-[12px]" :class="tone === 'ours' ? 'text-cream' : 'text-zinc-400'">{{ label }}</span>
            <span class="shrink-0 font-mono text-[11px] tabular-nums text-zinc-500">{{ display ?? value }}</span>
        </div>

        <div class="relative h-1.5 overflow-hidden rounded-full bg-white/6">
            <div class="h-full rounded-full transition-[width] duration-300 ease-snap" :class="fill" :style="{ width: `${width}%` }"></div>

            <span v-if="marker !== null" class="absolute inset-y-0 w-px bg-cream/40" :style="{ left: `${Math.min(100, (marker / Math.max(max, 1)) * 100)}%` }"></span>
        </div>

        <p v-if="note" class="text-[11px]/5 text-zinc-600">{{ note }}</p>
    </div>
</template>
