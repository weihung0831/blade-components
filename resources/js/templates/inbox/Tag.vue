<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    tone: { type: String, default: 'plain' },
});

const tones = {
    plain: 'border-white/10 text-zinc-400',
    order: 'border-jade-500/40 bg-jade-500/10 text-jade-300',
    warranty: 'border-amber-400/35 bg-amber-400/10 text-amber-300',
    escalated: 'border-red-400/40 bg-red-500/10 text-red-300',
    dealer: 'border-white/20 bg-white/8 text-cream',
    quiet: 'border-transparent bg-white/5 text-zinc-600',
};

const tone = computed(() => tones[props.tone] ?? tones.plain);
</script>

<template>
    <span class="inline-flex shrink-0 items-center gap-1 rounded-md border px-1.5 py-0.5 font-mono text-[10px] whitespace-nowrap" :class="tone">
        <slot>{{ label }}</slot>
    </span>
</template>
