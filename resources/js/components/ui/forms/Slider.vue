<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    min: { type: Number, default: 0 },
    max: { type: Number, default: 100 },
    step: { type: Number, default: 1 },
    disabled: { type: Boolean, default: false },
});

const model = defineModel({ type: Number, default: 50 });

const percent = computed(() =>
    props.max > props.min ? ((model.value - props.min) / (props.max - props.min)) * 100 : 0,
);

const thumbClasses =
    'absolute inset-0 w-full cursor-pointer appearance-none bg-transparent outline-none disabled:pointer-events-none [&::-moz-range-thumb]:size-3.5 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-jade-500 [&::-moz-range-thumb]:bg-cream [&::-webkit-slider-thumb]:size-3.5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-jade-500 [&::-webkit-slider-thumb]:bg-cream [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-150 [&::-webkit-slider-thumb]:ease-snap [&:active::-webkit-slider-thumb]:scale-110 [&:focus-visible::-webkit-slider-thumb]:ring-2 [&:focus-visible::-webkit-slider-thumb]:ring-jade-500/70';
</script>

<template>
    <div class="w-56" :style="{ '--ui-slider-fill': percent + '%' }">
        <div v-if="label" class="mb-2 flex items-center justify-between text-xs">
            <span class="text-zinc-500">{{ label }}</span>
            <span class="font-mono text-jade-400">{{ model }}</span>
        </div>
        <div class="relative flex h-3.5 items-center" :class="disabled ? 'opacity-40' : ''">
            <div class="h-1.5 w-full rounded-full bg-ink-800"></div>
            <div class="absolute h-1.5 rounded-full bg-jade-500" style="width: var(--ui-slider-fill)"></div>
            <input
                v-model.number="model"
                type="range"
                :min="min"
                :max="max"
                :step="step"
                :disabled="disabled"
                :aria-label="label ?? undefined"
                :class="thumbClasses"
            />
        </div>
    </div>
</template>
