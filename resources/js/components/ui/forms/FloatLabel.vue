<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    state: { type: String, default: 'default' },
});

const states = {
    default: 'border-white/10 hover:border-white/20 focus:border-jade-500',
    invalid: 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
};

const inputClasses = computed(
    () =>
        'peer block h-10 w-full rounded-lg border bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40 ' +
        (states[props.state] ?? states.default),
);

const labelClasses = computed(
    () =>
        'pointer-events-none absolute top-1/2 left-2.5 -translate-y-1/2 bg-ink-900 px-1 text-sm text-zinc-600 transition-all duration-150 ease-snap peer-[:not(:placeholder-shown)]:top-0 peer-[:not(:placeholder-shown)]:text-[11px] peer-[:not(:placeholder-shown)]:text-zinc-500 peer-focus:top-0 peer-focus:text-[11px] ' +
        (props.state === 'invalid' ? 'peer-focus:text-red-400' : 'peer-focus:text-jade-400'),
);
</script>

<template>
    <label class="relative block">
        <input type="text" placeholder=" " :class="inputClasses" v-bind="$attrs" />
        <span :class="labelClasses">{{ label }}</span>
    </label>
</template>
