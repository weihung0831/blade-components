<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    tone: { type: String, default: 'issued' },
    note: { type: String, default: null },
    tilt: { type: String, default: 'left' },
});

const tones = {
    issued: 'border-zinc-600 text-zinc-500',
    paid: 'border-jade-500/70 text-jade-300',
    overdue: 'border-red-400/70 text-red-400',
    draft: 'border-amber-400/60 text-amber-300',
    void: 'border-white/15 text-zinc-700',
};

const tilts = {
    left: '-rotate-6',
    right: 'rotate-3',
    none: 'rotate-0',
};

const skin = computed(() => `${tones[props.tone] ?? tones.issued} ${tilts[props.tilt] ?? tilts.left}`);
</script>

<template>
    <span class="inline-flex flex-col items-center gap-1 rounded-lg border-2 border-dashed px-3 py-1.5 select-none" :class="skin">
        <span class="font-mono text-[13px] font-bold tracking-[0.18em] uppercase">{{ label }}</span>
        <span v-if="note" class="font-mono text-[9px] tracking-wider opacity-80">{{ note }}</span>
    </span>
</template>
