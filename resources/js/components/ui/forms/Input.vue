<script setup>
import { computed, useId } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    hint: { type: String, default: null },
    error: { type: String, default: null },
    state: { type: String, default: 'default' },
    size: { type: String, default: 'md' },
});

const id = useId();

const base =
    'block w-full rounded-lg border bg-ink-950 text-zinc-200 placeholder:text-zinc-600 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40';

const states = {
    default: 'border-white/10 hover:border-white/20 focus:border-jade-500',
    invalid: 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
    success: 'border-jade-500/60 hover:border-jade-500/80 focus:border-jade-400',
};

const sizes = {
    sm: 'h-8 px-2.5 text-[13px]',
    md: 'h-10 px-3 text-sm',
    lg: 'h-11 px-3.5 text-[15px]',
};

const state = computed(() => (props.error !== null ? 'invalid' : props.state));

const classes = computed(() =>
    [base, states[state.value] ?? states.default, sizes[props.size] ?? sizes.md].join(' '),
);
</script>

<template>
    <div>
        <label v-if="label" :for="id" class="mb-1.5 block text-[13px] text-zinc-400">{{ label }}</label>
        <input :id="id" type="text" :aria-invalid="state === 'invalid' || undefined" :class="classes" v-bind="$attrs" />
        <p v-if="error" class="mt-1.5 text-xs text-red-400">{{ error }}</p>
        <p v-else-if="hint" class="mt-1.5 text-xs text-zinc-500">{{ hint }}</p>
    </div>
</template>
