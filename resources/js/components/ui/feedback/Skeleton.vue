<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'text' },
    animation: { type: String, default: 'pulse' },
});

const shapes = {
    text: 'h-3 rounded',
    circle: 'rounded-full',
    rect: 'rounded-lg',
};

const animations = {
    pulse: 'animate-pulse bg-white/8',
    wave: 'bg-white/6 bg-[linear-gradient(100deg,transparent_35%,color-mix(in_srgb,var(--color-white)_12%,transparent)_50%,transparent_65%)] bg-[length:250%_100%] animate-[ui-skeleton-wave_1.8s_linear_infinite]',
    none: 'bg-white/8',
};

const classes = computed(() => [
    shapes[props.variant] ?? shapes.text,
    animations[props.animation] ?? animations.pulse,
]);
</script>

<template>
    <div aria-hidden="true" :class="classes"></div>
</template>

<style>
@keyframes ui-skeleton-wave {
    from {
        background-position: 165% 0;
    }

    to {
        background-position: -65% 0;
    }
}
</style>
