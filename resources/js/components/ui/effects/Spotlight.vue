<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    mode: { type: String, default: 'pointer' },
    size: { type: Number, default: 260 },
    tone: { type: String, default: 'cream' },
});

const tints = {
    cream: 'color-mix(in srgb, var(--color-white) 12%, transparent)',
    jade: 'color-mix(in srgb, var(--color-jade-500) 30%, transparent)',
};

const root = ref(null);
const point = ref({ x: '50%', y: '0%' });

const tint = computed(() => tints[props.tone] ?? tints.cream);

const track = (event) => {
    if (props.mode !== 'pointer') {
        return;
    }

    const bounds = root.value.getBoundingClientRect();

    point.value = { x: `${event.clientX - bounds.left}px`, y: `${event.clientY - bounds.top}px` };
};
</script>

<template>
    <div
        ref="root"
        class="group relative isolate overflow-hidden"
        :style="{ '--ui-spotlight-size': `${size}px` }"
        @pointermove="track"
    >
        <span
            v-if="mode === 'pointer'"
            aria-hidden="true"
            class="pointer-events-none absolute inset-0 -z-10 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
            :style="{
                background: `radial-gradient(var(--ui-spotlight-size) circle at ${point.x} ${point.y}, ${tint}, transparent 70%)`,
            }"
        ></span>
        <span
            v-else
            aria-hidden="true"
            class="pointer-events-none absolute -top-1/2 left-0 -z-10 aspect-square blur-2xl animate-[ui-spotlight-sweep_5s_ease-in-out_infinite_alternate]"
            :style="{ width: 'var(--ui-spotlight-size)', background: `radial-gradient(circle, ${tint}, transparent 65%)` }"
        ></span>

        <slot />
    </div>
</template>

<style>
@keyframes ui-spotlight-sweep {
    from {
        transform: translateX(-40%);
    }

    to {
        transform: translateX(160%);
    }
}

@media (prefers-reduced-motion: reduce) {
    [class*='ui-spotlight-'] {
        animation: none;
    }
}
</style>
