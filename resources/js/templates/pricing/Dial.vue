<script setup>
import { computed, useId } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    hint: { type: String, default: null },
    min: { type: Number, default: 0 },
    max: { type: Number, default: 100 },
    step: { type: Number, default: 1 },
    format: { type: Function, default: (value) => String(value) },
});

const model = defineModel({ type: Number, default: 50 });

const id = useId();
const percent = computed(() => (props.max > props.min ? ((model.value - props.min) / (props.max - props.min)) * 100 : 0));

const thumbClasses =
    'absolute inset-0 w-full cursor-pointer appearance-none bg-transparent outline-none [&::-moz-range-thumb]:size-3.5 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-jade-500 [&::-moz-range-thumb]:bg-cream [&::-webkit-slider-thumb]:size-3.5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-jade-500 [&::-webkit-slider-thumb]:bg-cream [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-150 [&::-webkit-slider-thumb]:ease-snap [&:active::-webkit-slider-thumb]:scale-110 [&:focus-visible::-webkit-slider-thumb]:ring-2 [&:focus-visible::-webkit-slider-thumb]:ring-jade-500/70';
</script>

<template>
    <div :style="{ '--ui-slider-fill': percent + '%' }">
        <div class="flex items-baseline justify-between gap-3">
            <label :for="id" class="text-[13px] text-zinc-300">{{ label }}</label>
            <output class="font-mono text-sm text-jade-400">{{ format(model) }}</output>
        </div>

        <div class="relative mt-3 flex h-3.5 items-center">
            <div class="h-1.5 w-full rounded-full bg-ink-800"></div>
            <div class="absolute h-1.5 rounded-full bg-jade-500" style="width: var(--ui-slider-fill)"></div>
            <input :id="id" v-model.number="model" type="range" :min="min" :max="max" :step="step" :class="thumbClasses" />
        </div>

        <p v-if="hint" class="mt-2 font-mono text-[10px] text-zinc-600">{{ hint }}</p>
    </div>
</template>
