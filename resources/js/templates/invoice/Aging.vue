<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    count: { type: Number, default: 0 },
    amount: { type: String, required: true },
    value: { type: Number, default: 0 },
    max: { type: Number, default: 100 },
    tone: { type: String, default: 'quiet' },
    note: { type: String, default: null },
    active: { type: Boolean, default: false },
});

const tones = {
    quiet: { fill: 'bg-white/20', text: 'text-zinc-400' },
    ok: { fill: 'bg-jade-500', text: 'text-jade-300' },
    warn: { fill: 'bg-amber-400/70', text: 'text-amber-300' },
    bad: { fill: 'bg-red-400/70', text: 'text-red-400' },
};

const skin = computed(() => tones[props.tone] ?? tones.quiet);
const width = computed(() => (props.max > 0 ? Math.min(100, (props.value / props.max) * 100) : 0));
</script>

<template>
    <div
        class="flex flex-col gap-2 rounded-xl border p-3.5 text-left transition-colors duration-150"
        :class="active ? 'border-jade-500/50 bg-jade-500/6' : 'border-white/8 bg-ink-950 hover:border-white/20'"
    >
        <div class="flex items-baseline justify-between gap-3">
            <span class="text-[12px] text-zinc-400">{{ label }}</span>
            <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ count }} inv</span>
        </div>

        <span class="font-mono text-[15px] tabular-nums" :class="skin.text">{{ amount }}</span>

        <span class="block h-1.5 overflow-hidden rounded-full bg-white/6">
            <span class="block h-full rounded-full transition-[width] duration-300 ease-snap" :class="skin.fill" :style="{ width: `${width}%` }"></span>
        </span>

        <span v-if="note" class="text-[11px]/4 text-zinc-600">{{ note }}</span>
    </div>
</template>
