<script setup>
import { computed } from 'vue';

const props = defineProps({
    initials: { type: String, default: null },
    src: { type: String, default: null },
    alt: { type: String, default: '' },
    size: { type: String, default: 'md' },
    color: { type: String, default: 'ink' },
    status: { type: String, default: null },
});

const sizes = {
    sm: 'size-7 text-[10px]',
    md: 'size-9 text-xs',
    lg: 'size-12 text-sm',
};

const colors = {
    jade: 'bg-jade-500 font-semibold text-ink-950',
    ink: 'bg-ink-800 font-semibold text-zinc-300',
    ghost: 'bg-ink-950 font-mono text-zinc-500',
};

const statuses = {
    online: 'bg-jade-500',
    away: 'bg-amber-400',
    busy: 'bg-red-400',
    offline: 'bg-zinc-600',
};

const dotSizes = {
    sm: 'size-2',
    md: 'size-2.5',
    lg: 'size-3',
};

const avatarClasses = computed(() => [
    'relative inline-grid shrink-0 place-items-center rounded-full select-none',
    sizes[props.size] ?? sizes.md,
    colors[props.color] ?? colors.ink,
]);

const dotClasses = computed(() => [
    'absolute right-0 bottom-0 rounded-full ring-2 ring-ink-900',
    dotSizes[props.size] ?? dotSizes.md,
    statuses[props.status] ?? statuses.online,
]);
</script>

<template>
    <span :class="avatarClasses">
        <img v-if="src !== null" :src="src" :alt="alt" class="size-full rounded-full object-cover" />
        <template v-else>{{ initials }}</template>
        <span v-if="status !== null" :class="dotClasses"></span>
    </span>
</template>
