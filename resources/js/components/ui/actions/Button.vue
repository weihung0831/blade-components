<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'primary' },
    size: { type: String, default: 'md' },
    href: { type: String, default: null },
});

const base =
    'inline-flex items-center justify-center rounded-lg font-medium transition-[transform,background-color,border-color,color] duration-150 ease-snap outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-[0.97] disabled:pointer-events-none disabled:opacity-40';

const variants = {
    primary: 'bg-jade-500 text-ink-950 hover:bg-jade-400',
    secondary: 'border border-white/10 text-zinc-300 hover:border-white/25',
    ghost: 'text-zinc-400 hover:bg-white/5 hover:text-cream',
    danger: 'border border-red-500/20 bg-red-500/10 text-red-400 hover:bg-red-500/20',
};

const sizes = {
    sm: 'h-8 px-3 text-[13px]',
    md: 'h-10 px-5 text-sm',
    lg: 'h-11 px-6 text-[15px]',
};

const classes = computed(() =>
    [base, variants[props.variant] ?? variants.primary, sizes[props.size] ?? sizes.md].join(' '),
);
</script>

<template>
    <a v-if="href" :href="href" :class="classes"><slot /></a>
    <button v-else type="button" :class="classes"><slot /></button>
</template>
