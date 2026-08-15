<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'primary' },
    disabled: { type: Boolean, default: false },
});

const variants = {
    primary: {
        group: 'bg-jade-500 text-ink-950',
        button: 'hover:bg-jade-400',
        caret: 'border-l border-ink-950/15 hover:bg-jade-400',
    },
    secondary: {
        group: 'border border-white/10 text-zinc-300',
        button: 'hover:bg-white/5 hover:text-cream',
        caret: 'border-l border-white/10 hover:bg-white/5 hover:text-cream',
    },
};

const buttonBase =
    'outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70';

const styles = computed(() => variants[props.variant] ?? variants.primary);

const groupClasses = computed(() =>
    ['inline-flex overflow-hidden rounded-lg', styles.value.group, props.disabled ? 'pointer-events-none opacity-40' : '']
        .filter(Boolean)
        .join(' '),
);
</script>

<template>
    <div role="group" :class="groupClasses">
        <button type="button" :disabled="disabled" :class="[buttonBase, 'h-10 px-5 text-sm font-medium', styles.button]">
            <slot />
        </button>
        <button
            type="button"
            :disabled="disabled"
            aria-label="More options"
            :class="[buttonBase, 'grid h-10 w-9 place-items-center', styles.caret]"
        >
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
    </div>
</template>
