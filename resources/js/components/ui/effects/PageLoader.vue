<script setup>
import { computed, onMounted, ref } from 'vue';

const props = defineProps({
    variant: { type: String, default: 'overlay' },
    label: { type: String, default: 'Loading' },
    fixed: { type: Boolean, default: false },
    autoHide: { type: Boolean, default: false },
    active: { type: Boolean, default: true },
});

const loaded = ref(false);

const visible = computed(() => props.active && !(props.autoHide && loaded.value));

const classes = computed(() => [
    props.fixed ? 'fixed' : 'absolute',
    'inset-0 z-50 overflow-hidden transition-opacity duration-300',
    props.variant === 'overlay' ? 'grid place-items-center bg-ink-950/85 backdrop-blur-sm' : 'pointer-events-none h-0.5',
    visible.value ? '' : 'pointer-events-none opacity-0',
]);

onMounted(() => {
    if (document.readyState === 'complete') {
        loaded.value = true;

        return;
    }

    window.addEventListener('load', () => (loaded.value = true), { once: true });
});
</script>

<template>
    <div role="status" aria-live="polite" :class="classes">
        <span class="absolute top-0 left-0 h-0.5 w-2/5 rounded-full bg-jade-500 animate-[ui-page-loader-slide_1.6s_ease-in-out_infinite]"></span>

        <div v-if="variant === 'overlay'" class="flex flex-col items-center gap-3">
            <svg class="size-6 animate-spin text-jade-500" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="2" class="opacity-20"/>
                <path d="M14.5 8A6.5 6.5 0 0 0 8 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="font-mono text-xs tracking-wider text-zinc-500 uppercase">{{ label }}</span>
        </div>
        <span v-else class="sr-only">{{ label }}</span>
    </div>
</template>

<style>
@keyframes ui-page-loader-slide {
    from {
        transform: translateX(-100%);
    }

    to {
        transform: translateX(350%);
    }
}
</style>
