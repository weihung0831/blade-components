<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
    words: { type: Array, default: () => [] },
    speed: { type: Number, default: 70 },
    pause: { type: Number, default: 1600 },
    loop: { type: Boolean, default: true },
    cursor: { type: Boolean, default: true },
});

const text = ref(props.words[0] ?? '');

let timer = null;

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || (props.words.length < 2 && !props.loop)) {
        return;
    }

    let index = 0;
    let length = text.value.length;
    let deleting = true;

    const step = () => {
        const word = props.words[index];

        length += deleting ? -1 : 1;
        text.value = word.slice(0, length);

        if (!deleting && length === word.length) {
            if (!props.loop && index === props.words.length - 1) {
                return;
            }

            deleting = true;
            timer = setTimeout(step, props.pause);

            return;
        }

        if (deleting && length === 0) {
            deleting = false;
            index = (index + 1) % props.words.length;
        }

        timer = setTimeout(step, deleting ? props.speed / 2 : props.speed);
    };

    timer = setTimeout(step, props.pause);
});

onBeforeUnmount(() => clearTimeout(timer));
</script>

<template>
    <span class="inline-flex items-center">
        <span>{{ text }}</span>
        <span
            v-if="cursor"
            aria-hidden="true"
            class="ml-0.5 inline-block h-[1em] w-0.5 shrink-0 bg-jade-400 animate-[ui-typewriter-blink_1s_step-end_infinite]"
        ></span>
    </span>
</template>

<style>
@keyframes ui-typewriter-blink {
    50% {
        opacity: 0;
    }
}
</style>
