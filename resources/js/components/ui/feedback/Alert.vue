<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'info' },
    title: { type: String, default: null },
    dismissible: { type: Boolean, default: false },
});

const emit = defineEmits(['dismiss']);

const visible = ref(true);

const variants = {
    info: {
        box: 'border-white/10 bg-white/5',
        icon: 'text-zinc-400',
        title: 'text-zinc-200',
        mark: 'M8 7.4v3.4M8 5v.2',
    },
    success: {
        box: 'border-jade-500/25 bg-jade-500/10',
        icon: 'text-jade-400',
        title: 'text-jade-300',
        mark: 'm5.4 8.3 1.8 1.8 3.4-4.2',
    },
    warning: {
        box: 'border-amber-400/25 bg-amber-400/10',
        icon: 'text-amber-400',
        title: 'text-amber-300',
        mark: 'M8 5v3.4M8 11v.2',
    },
    danger: {
        box: 'border-red-500/25 bg-red-500/10',
        icon: 'text-red-400',
        title: 'text-red-300',
        mark: 'm6.2 6.2 3.6 3.6M9.8 6.2 6.2 9.8',
    },
};

const style = computed(() => variants[props.variant] ?? variants.info);

const dismiss = () => {
    visible.value = false;
    emit('dismiss');
};
</script>

<template>
    <div v-if="visible" role="alert" :class="['flex gap-3 rounded-xl border px-4 py-3.5', style.box]">
        <svg class="mt-0.5 size-4 shrink-0" :class="style.icon" viewBox="0 0 16 16" fill="none">
            <circle cx="8" cy="8" r="6.4" stroke="currentColor" stroke-width="1.4" />
            <path :d="style.mark" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="min-w-0 flex-1">
            <p v-if="title" class="text-sm font-medium" :class="style.title">{{ title }}</p>
            <div :class="['text-sm/6 text-zinc-400', title ? 'mt-1' : '']"><slot /></div>
            <div v-if="$slots.actions" class="mt-2.5 flex items-center gap-4"><slot name="actions" /></div>
        </div>
        <button
            v-if="dismissible"
            type="button"
            aria-label="Dismiss"
            class="-mt-0.5 -mr-1 grid size-6 shrink-0 place-items-center rounded-md text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
            @click="dismiss"
        >
            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" /></svg>
        </button>
    </div>
</template>
