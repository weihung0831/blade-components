<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    min: { type: Number, default: null },
    max: { type: Number, default: null },
    step: { type: Number, default: 1 },
});

const model = defineModel({ type: Number, default: 0 });

const lower = computed(() => props.min ?? -Infinity);
const upper = computed(() => props.max ?? Infinity);

const adjust = (direction) => {
    model.value = parseFloat(
        Math.min(upper.value, Math.max(lower.value, (model.value || 0) + props.step * direction)).toFixed(10),
    );
};

const stepClasses =
    'grid w-9 shrink-0 place-items-center text-zinc-400 outline-none transition-colors duration-150 hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70 disabled:pointer-events-none disabled:opacity-30';
</script>

<template>
    <div class="w-40">
        <label v-if="label" class="mb-1.5 block text-xs text-zinc-500">{{ label }}</label>
        <div class="flex h-9 items-stretch overflow-hidden rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500">
            <button type="button" aria-label="Decrease" :disabled="model <= lower" :class="stepClasses" @click="adjust(-1)">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </button>
            <input
                v-model.number="model"
                type="number"
                inputmode="decimal"
                :min="min ?? undefined"
                :max="max ?? undefined"
                :step="step"
                :aria-label="label ?? undefined"
                class="min-w-0 flex-1 border-x border-white/10 bg-transparent text-center font-mono text-sm text-zinc-300 outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
            />
            <button type="button" aria-label="Increase" :disabled="model >= upper" :class="stepClasses" @click="adjust(1)">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            </button>
        </div>
    </div>
</template>
