<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
    words: { type: Array, default: () => [] },
    interval: { type: Number, default: 2200 },
    duration: { type: Number, default: 400 },
});

const index = ref(0);

let timer = null;

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || props.words.length < 2) {
        return;
    }

    timer = setInterval(() => (index.value = (index.value + 1) % props.words.length), props.interval);
});

onBeforeUnmount(() => clearInterval(timer));
</script>

<template>
    <span class="inline-grid overflow-hidden align-bottom" :style="{ '--ui-word-rotate-duration': `${duration}ms` }">
        <span
            :key="index"
            class="col-start-1 row-start-1 whitespace-nowrap animate-[ui-word-rotate-in_var(--ui-word-rotate-duration)_var(--ease-snap)_both]"
            >{{ words[index] }}</span
        >
    </span>
</template>

<style>
@keyframes ui-word-rotate-in {
    from {
        opacity: 0;
        transform: translateY(65%);
    }
}
</style>
