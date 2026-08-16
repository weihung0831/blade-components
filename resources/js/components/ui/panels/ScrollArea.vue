<script setup>
import { computed } from 'vue';

const props = defineProps({
    orientation: { type: String, default: 'vertical' },
});

const orientations = {
    vertical: 'overflow-y-auto',
    horizontal: 'overflow-x-auto',
    both: 'overflow-auto',
};

const scrollbar =
    '[scrollbar-width:thin] [scrollbar-color:color-mix(in_oklab,var(--color-jade-500)_45%,transparent)_transparent] [&::-webkit-scrollbar]:size-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-jade-500/40 [&::-webkit-scrollbar-thumb:hover]:bg-jade-500/60';

const classes = computed(() => [orientations[props.orientation] ?? orientations.vertical, scrollbar]);
</script>

<template>
    <div :class="classes">
        <slot />
    </div>
</template>
