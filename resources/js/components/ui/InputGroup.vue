<script setup>
import { computed, useSlots } from 'vue';

const props = defineProps({
    size: { type: String, default: 'md' },
});

const slots = useSlots();

const base =
    'flex items-stretch overflow-hidden rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500' +
    ' [&>input]:min-w-0 [&>input]:flex-1 [&>input]:bg-transparent [&>input]:text-zinc-200 [&>input]:outline-none [&>input::placeholder]:text-zinc-600' +
    ' [&>button]:shrink-0 [&>button]:border-l [&>button]:border-white/10 [&>button]:bg-ink-800 [&>button]:font-medium [&>button]:text-zinc-300 [&>button]:transition-colors [&>button]:duration-150 [&>button]:outline-none [&>button:hover]:text-cream [&>button:focus-visible]:text-cream';

const sizes = {
    sm: '[&>input]:h-8 [&>input]:px-2.5 [&>input]:text-[13px] [&>button]:px-2.5 [&>button]:text-[13px]',
    md: '[&>input]:h-10 [&>input]:px-3 [&>input]:text-sm [&>button]:px-3.5 [&>button]:text-sm',
};

const classes = computed(() => [base, sizes[props.size] ?? sizes.md].join(' '));

const addon = computed(
    () =>
        'grid shrink-0 place-items-center bg-ink-800 px-3 font-mono text-zinc-500 [&_svg]:size-4 ' +
        (props.size === 'sm' ? 'text-xs' : 'text-[13px]'),
);
</script>

<template>
    <div :class="classes">
        <span v-if="slots.prefix" :class="[addon, 'border-r border-white/10']">
            <slot name="prefix" />
        </span>
        <slot />
        <span v-if="slots.suffix" :class="[addon, 'border-l border-white/10']">
            <slot name="suffix" />
        </span>
    </div>
</template>
