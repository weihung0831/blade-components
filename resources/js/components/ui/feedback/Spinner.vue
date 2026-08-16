<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'ring' },
    size: { type: String, default: 'md' },
    color: { type: String, default: 'jade' },
    label: { type: String, default: null },
});

const rings = {
    sm: 'size-4',
    md: 'size-5',
    lg: 'size-8',
};

const dots = {
    sm: 'size-1',
    md: 'size-1.5',
    lg: 'size-2.5',
};

const colors = {
    jade: 'text-jade-500',
    zinc: 'text-zinc-400',
    cream: 'text-cream',
    red: 'text-red-400',
};

const dotClasses = computed(() => ['animate-bounce rounded-full bg-current', dots[props.size] ?? dots.md]);
</script>

<template>
    <span role="status" :class="['inline-flex items-center gap-2.5', colors[color] ?? colors.jade]">
        <span v-if="variant === 'dots'" class="flex items-center gap-1">
            <span :class="dotClasses" class="[animation-delay:-320ms]"></span>
            <span :class="dotClasses" class="[animation-delay:-160ms]"></span>
            <span :class="dotClasses"></span>
        </span>
        <svg v-else class="animate-spin" :class="rings[size] ?? rings.md" viewBox="0 0 16 16" fill="none">
            <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="2" class="opacity-20" />
            <path d="M14.5 8A6.5 6.5 0 0 0 8 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
        <span v-if="label" class="text-sm text-zinc-400">{{ label }}</span>
        <span v-else class="sr-only">Loading</span>
    </span>
</template>
