<script setup>
import { computed } from 'vue';

const props = defineProps({
    value: { type: Number, default: 0 },
    max: { type: Number, default: 100 },
    label: { type: String, default: null },
    indeterminate: { type: Boolean, default: false },
    size: { type: String, default: 'md' },
    animate: { type: Boolean, default: false },
    duration: { type: Number, default: 900 },
    delay: { type: Number, default: 0 },
});

const sizes = {
    sm: 'h-1',
    md: 'h-1.5',
    lg: 'h-2.5',
};

const percent = computed(() => (props.max > 0 ? Math.min(100, Math.max(0, (props.value / props.max) * 100)) : 0));

const timing = computed(() => ({
    animationDelay: `${props.delay}ms`,
    '--ui-progress-duration': `${props.duration}ms`,
}));
</script>

<template>
    <div class="w-full">
        <div v-if="label" class="mb-2 flex items-baseline justify-between gap-4">
            <span class="text-xs text-zinc-500">{{ label }}</span>
            <span v-if="!indeterminate" class="font-mono text-xs text-jade-400"
                :class="animate && 'animate-[ui-progress-fade_var(--ui-progress-duration)_var(--ease-snap)_both]'"
                :style="animate ? timing : null">{{ Math.round(percent) }}%</span>
        </div>
        <div
            role="progressbar"
            aria-valuemin="0"
            :aria-valuemax="max"
            :aria-valuenow="indeterminate ? undefined : value"
            :aria-label="label ?? undefined"
            class="overflow-hidden rounded-full bg-ink-800"
            :class="sizes[size] ?? sizes.md"
        >
            <div v-if="indeterminate" class="h-full w-1/3 rounded-full bg-jade-500 animate-[ui-progress-slide_1.4s_ease-in-out_infinite]"></div>
            <div v-else class="h-full rounded-full bg-jade-500"
                :class="animate ? 'origin-left animate-[ui-progress-grow_var(--ui-progress-duration)_var(--ease-snap)_both]' : 'transition-[width] duration-500 ease-snap'"
                :style="{ width: percent + '%', ...(animate ? timing : {}) }"></div>
        </div>
    </div>
</template>

<style>
@keyframes ui-progress-slide {
    from {
        translate: -150% 0;
    }

    to {
        translate: 400% 0;
    }
}

@keyframes ui-progress-grow {
    from {
        transform: scaleX(0);
    }
}

@keyframes ui-progress-fade {
    from {
        opacity: 0;
    }
}

@media (prefers-reduced-motion: reduce) {
    [class*='ui-progress-grow'],
    [class*='ui-progress-fade'] {
        animation: none;
    }
}
</style>
