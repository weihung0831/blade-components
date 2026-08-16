<script setup>
import { computed, useId } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    hint: { type: String, default: null },
    error: { type: String, default: null },
    state: { type: String, default: 'default' },
    autoResize: { type: Boolean, default: false },
});

const id = useId();

const states = {
    default: 'border-white/10 hover:border-white/20 focus:border-jade-500',
    invalid: 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
};

const state = computed(() => (props.error !== null ? 'invalid' : props.state));

const classes = computed(() =>
    [
        'block w-full rounded-lg border bg-ink-950 px-3 py-2 text-sm/6 text-zinc-200 placeholder:text-zinc-600 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40',
        states[state.value] ?? states.default,
        props.autoResize ? 'field-sizing-content resize-none' : 'resize-y',
    ].join(' '),
);
</script>

<template>
    <div>
        <label v-if="label" :for="id" class="mb-1.5 block text-[13px] text-zinc-400">{{ label }}</label>
        <textarea :id="id" rows="4" :aria-invalid="state === 'invalid' || undefined" :class="classes" v-bind="$attrs"></textarea>
        <p v-if="error" class="mt-1.5 text-xs text-red-400">{{ error }}</p>
        <p v-else-if="hint" class="mt-1.5 text-xs text-zinc-500">{{ hint }}</p>
    </div>
</template>
