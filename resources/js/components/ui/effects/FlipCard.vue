<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    trigger: { type: String, default: 'hover' },
    axis: { type: String, default: 'y' },
});

const axes = {
    y: {
        face: '[transform:rotateY(180deg)]',
        hover: 'group-hover:[transform:rotateY(180deg)]',
    },
    x: {
        face: '[transform:rotateX(180deg)]',
        hover: 'group-hover:[transform:rotateX(180deg)]',
    },
};

const flipped = ref(false);

const turn = computed(() => axes[props.axis] ?? axes.y);

const interactive = computed(() => props.trigger === 'click');

const innerClasses = computed(() => [
    'relative size-full transform-3d transition-transform duration-700 ease-snap',
    interactive.value ? (flipped.value ? turn.value.face : '') : turn.value.hover,
]);

const face = 'absolute inset-0 overflow-hidden backface-hidden';
</script>

<template>
    <component
        :is="interactive ? 'button' : 'div'"
        :type="interactive ? 'button' : null"
        :aria-pressed="interactive ? String(flipped) : null"
        :class="['group relative block [perspective:1000px]', interactive ? 'cursor-pointer text-left outline-none' : '']"
        @click="interactive && (flipped = !flipped)"
    >
        <div :class="innerClasses">
            <div :class="face"><slot name="front" /></div>
            <div :class="[face, turn.face]"><slot name="back" /></div>
        </div>
    </component>
</template>
