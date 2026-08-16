<script setup>
import { computed } from 'vue';

const props = defineProps({
    placeholder: { type: String, default: 'Search…' },
    shortcut: { type: String, default: null },
    size: { type: String, default: 'md' },
});

const sizes = {
    sm: 'h-8 px-2.5',
    md: 'h-10 px-3',
};

const classes = computed(
    () =>
        'flex w-full items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500 ' +
        (sizes[props.size] ?? sizes.md),
);

const inputClasses = computed(
    () =>
        'h-full min-w-0 flex-1 bg-transparent text-zinc-200 outline-none placeholder:text-zinc-600 [&::-webkit-search-cancel-button]:hidden ' +
        (props.size === 'sm' ? 'text-[13px]' : 'text-sm'),
);

const keys = computed(() => (props.shortcut ? props.shortcut.split(' ') : []));
</script>

<template>
    <label :class="classes">
        <svg class="size-4 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.3"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
        <input type="search" :placeholder="placeholder" :class="inputClasses" v-bind="$attrs" />
        <span v-if="keys.length" class="flex shrink-0 gap-1">
            <span
                v-for="key in keys"
                :key="key"
                class="grid h-5 min-w-5 place-items-center rounded border border-white/10 border-b-white/20 bg-ink-800 px-1 font-mono text-[10px] text-zinc-400"
            >{{ key }}</span>
        </span>
    </label>
</template>
