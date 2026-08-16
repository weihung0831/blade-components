<script setup>
import { computed } from 'vue';

const props = defineProps({
    size: { type: String, default: 'md' },
});

const sizes = {
    sm: 'h-8 px-2.5 [&>input]:text-[13px]',
    md: 'h-10 px-3 [&>input]:text-sm',
};

const classes = computed(
    () =>
        'flex w-full items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500' +
        ' [&>svg]:size-4 [&>svg]:shrink-0 [&>svg]:text-zinc-500' +
        ' [&>input]:h-full [&>input]:min-w-0 [&>input]:flex-1 [&>input]:bg-transparent [&>input]:text-zinc-200 [&>input]:outline-none [&>input::placeholder]:text-zinc-600' +
        ' ' +
        (sizes[props.size] ?? sizes.md),
);
</script>

<template>
    <label :class="classes">
        <slot />
    </label>
</template>
