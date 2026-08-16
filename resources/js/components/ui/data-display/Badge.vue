<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'solid' },
    color: { type: String, default: 'jade' },
});

const solids = {
    jade: 'bg-jade-500/15 font-medium text-jade-400',
    zinc: 'bg-white/10 font-medium text-zinc-300',
    red: 'bg-red-400/15 font-medium text-red-400',
    amber: 'bg-amber-400/15 font-medium text-amber-400',
};

const dots = {
    jade: 'bg-jade-500',
    zinc: 'bg-zinc-500',
    red: 'bg-red-400',
    amber: 'bg-amber-400',
};

const badgeClasses = computed(() => [
    'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs',
    ['outline', 'dot'].includes(props.variant)
        ? 'border border-white/10 text-zinc-400'
        : solids[props.color] ?? solids.jade,
]);

const dotClasses = computed(() => ['size-1.5 rounded-full', dots[props.color] ?? dots.jade]);
</script>

<template>
    <span :class="badgeClasses">
        <span v-if="variant === 'dot'" :class="dotClasses"></span>
        <slot />
    </span>
</template>
