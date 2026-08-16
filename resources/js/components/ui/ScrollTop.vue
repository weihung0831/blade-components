<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
    threshold: { type: Number, default: 400 },
    variant: { type: String, default: 'solid' },
    anchor: { type: String, default: 'viewport' },
});

const anchors = {
    viewport: 'fixed right-6 bottom-6',
    container: 'absolute right-4 bottom-4',
};

const variants = {
    solid: 'bg-jade-500 text-ink-950 shadow-lg shadow-jade-500/25 hover:bg-jade-400',
    progress: 'border border-white/10 bg-ink-900 text-cream shadow-lg shadow-black/40 hover:border-white/25',
};

const button = ref(null);
const visible = ref(false);
const progress = ref(0);

const region = () =>
    button.value?.parentElement.querySelector('[data-ui-scroll-region]') ?? button.value?.closest('[data-ui-scroll-region]');

const ringStyle = computed(() => ({
    background: `conic-gradient(var(--color-jade-500) calc(${progress.value} * 1%), color-mix(in oklab, var(--color-white) 12%, transparent) 0)`,
    WebkitMask: 'radial-gradient(closest-side, transparent 78%, black 80%)',
    mask: 'radial-gradient(closest-side, transparent 78%, black 80%)',
}));

const update = () => {
    const scroller = region();
    const top = scroller ? scroller.scrollTop : window.scrollY;
    const max = scroller
        ? scroller.scrollHeight - scroller.clientHeight
        : document.documentElement.scrollHeight - window.innerHeight;

    visible.value = top > props.threshold;
    progress.value = max > 0 ? Math.round((top / max) * 100) : 0;
};

const toTop = () => {
    const behavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';

    (region() ?? window).scrollTo({ top: 0, behavior });
};

onMounted(() => {
    document.addEventListener('scroll', update, { capture: true, passive: true });
    update();
});

onBeforeUnmount(() => document.removeEventListener('scroll', update, { capture: true }));
</script>

<template>
    <button
        ref="button"
        type="button"
        aria-label="Back to top"
        :data-visible="visible ? '' : null"
        class="invisible z-30 grid size-11 translate-y-2 cursor-pointer place-items-center rounded-full opacity-0 transition-[opacity,translate,visibility,background-color,border-color] duration-200 ease-snap outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 data-visible:visible data-visible:translate-y-0 data-visible:opacity-100"
        :class="[anchors[anchor] ?? anchors.viewport, variants[variant] ?? variants.solid]"
        @click="toTop"
    >
        <span v-if="variant === 'progress'" aria-hidden="true" class="absolute inset-0 rounded-full" :style="ringStyle"></span>
        <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M8 12.5v-9M4 7l4-3.5L12 7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
</template>
