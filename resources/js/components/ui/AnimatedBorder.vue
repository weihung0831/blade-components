<script setup>
import { computed } from 'vue';

const props = defineProps({
    duration: { type: Number, default: 4 },
    tone: { type: String, default: 'jade' },
    radius: { type: String, default: 'rounded-xl' },
    thickness: { type: String, default: 'p-px' },
});

const tones = {
    jade: 'from-jade-400 via-transparent to-transparent',
    cream: 'from-cream via-transparent to-transparent',
    split: 'from-jade-400 via-transparent to-cream',
};

const beamClasses = computed(() => [
    'absolute top-1/2 left-1/2 aspect-square w-[150%] -translate-x-1/2 -translate-y-1/2 bg-conic animate-[ui-animated-border-spin_var(--ui-border-speed)_linear_infinite]',
    tones[props.tone] ?? tones.jade,
]);
</script>

<template>
    <div
        :class="['relative overflow-hidden bg-white/10', radius, thickness]"
        :style="{ '--ui-border-speed': `${Math.max(1, duration)}s` }"
    >
        <span aria-hidden="true" :class="beamClasses"></span>

        <div class="relative h-full rounded-[inherit] bg-ink-900">
            <slot />
        </div>
    </div>
</template>

<style>
@keyframes ui-animated-border-spin {
    to {
        transform: translate(-50%, -50%) rotate(1turn);
    }
}

@media (prefers-reduced-motion: reduce) {
    [class*='ui-animated-border-'] {
        animation: none;
    }
}
</style>
