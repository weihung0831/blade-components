<script setup>
import { computed, useSlots } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'outline' },
});

const slots = useSlots();

const variants = {
    outline: 'border border-white/10 bg-ink-800',
    elevated: 'border border-white/5 bg-ink-800 shadow-lg shadow-black/40',
    interactive: 'cursor-pointer border border-white/10 bg-ink-800 transition duration-200 ease-snap hover:-translate-y-0.5 hover:border-white/25',
};

const classes = computed(() => ['overflow-hidden rounded-xl', variants[props.variant] ?? variants.outline]);
</script>

<template>
    <div :class="classes">
        <div v-if="slots.header" class="border-b border-white/5 px-4 py-3"><slot name="header" /></div>
        <div class="p-4"><slot /></div>
        <div v-if="slots.footer" class="border-t border-white/5 px-4 py-3"><slot name="footer" /></div>
    </div>
</template>
