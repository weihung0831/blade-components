<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
    value: { type: Number, default: 0 },
    from: { type: Number, default: 0 },
    decimals: { type: Number, default: 0 },
    duration: { type: Number, default: 1600 },
    prefix: { type: String, default: null },
    suffix: { type: String, default: null },
    locale: { type: String, default: 'en-US' },
});

const root = ref(null);
const current = ref(props.value);

const format = computed(
    () => new Intl.NumberFormat(props.locale, { minimumFractionDigits: props.decimals, maximumFractionDigits: props.decimals }),
);

let observer = null;

const count = () => {
    let began = null;

    const frame = (now) => {
        began ??= now;

        const progress = Math.min(1, (now - began) / props.duration);
        const eased = 1 - Math.pow(1 - progress, 3);

        current.value = props.from + (props.value - props.from) * eased;

        if (progress < 1) {
            requestAnimationFrame(frame);
        }
    };

    requestAnimationFrame(frame);
};

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    observer = new IntersectionObserver(
        ([entry]) => {
            if (!entry.isIntersecting) {
                return;
            }

            observer.disconnect();
            count();
        },
        { threshold: 0.5 },
    );

    observer.observe(root.value);
});

onBeforeUnmount(() => observer?.disconnect());
</script>

<template>
    <span ref="root" class="inline-flex items-baseline tabular-nums">
        <span v-if="prefix" class="text-jade-400">{{ prefix }}</span>
        <span>{{ format.format(current) }}</span>
        <span v-if="suffix" class="text-zinc-500">{{ suffix }}</span>
    </span>
</template>
