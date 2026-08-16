<script setup>
import { computed, watch } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'success' },
    title: { type: String, required: true },
    description: { type: String, default: null },
    duration: { type: Number, default: 4000 },
    position: { type: String, default: 'bottom-right' },
});

const open = defineModel('open', { type: Boolean, default: false });

const variants = {
    success: { chip: 'bg-jade-500/15 text-jade-400', mark: 'M2.5 6.5 5 9l4.5-6' },
    danger: { chip: 'bg-red-500/15 text-red-400', mark: 'm3.5 3.5 5 5M8.5 3.5l-5 5' },
    warning: { chip: 'bg-amber-400/15 text-amber-400', mark: 'M6 2.8v3.9M6 9.2v.2' },
    neutral: { chip: 'bg-white/10 text-zinc-300', mark: 'M6 5.4v3.8M6 3v.2' },
};

const positions = {
    'bottom-right': 'right-5 bottom-5 translate-y-2 data-[open]:translate-y-0',
    'bottom-left': 'left-5 bottom-5 translate-y-2 data-[open]:translate-y-0',
    'top-right': 'top-5 right-5 -translate-y-2 data-[open]:translate-y-0',
    'top-center': 'top-5 left-1/2 -translate-x-1/2 -translate-y-2 data-[open]:translate-y-0',
};

const style = computed(() => variants[props.variant] ?? variants.success);

let timer = null;

watch(open, (isOpen) => {
    clearTimeout(timer);

    if (isOpen && props.duration > 0) {
        timer = setTimeout(() => (open.value = false), props.duration);
    }
});
</script>

<template>
    <div
        role="status"
        :data-open="open ? '' : undefined"
        :class="[
            'pointer-events-none fixed z-50 flex w-80 items-start gap-3 rounded-xl border border-white/10 bg-ink-800 p-3.5 opacity-0 shadow-lg shadow-black/40 transition-[opacity,translate] duration-300 ease-snap data-[open]:pointer-events-auto data-[open]:opacity-100',
            positions[position] ?? positions['bottom-right'],
        ]"
    >
        <span class="grid size-5 shrink-0 place-items-center rounded-full" :class="style.chip">
            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path :d="style.mark" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
        </span>
        <div class="min-w-0 flex-1">
            <p class="text-sm font-medium text-zinc-200">{{ title }}</p>
            <p v-if="description" class="mt-0.5 text-xs/5 text-zinc-500">{{ description }}</p>
            <div v-if="$slots.action" class="mt-2"><slot name="action" /></div>
        </div>
        <button
            type="button"
            aria-label="Dismiss"
            class="grid size-5 shrink-0 place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
            @click="open = false"
        >
            <svg class="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" /></svg>
        </button>
    </div>
</template>
