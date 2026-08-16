<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    before: { type: String, required: true },
    after: { type: String, required: true },
    beforeAlt: { type: String, default: '' },
    afterAlt: { type: String, default: '' },
    beforeLabel: { type: String, default: 'Before' },
    afterLabel: { type: String, default: 'After' },
    position: { type: Number, default: 50 },
    orientation: { type: String, default: 'horizontal' },
    ratio: { type: String, default: 'aspect-video' },
});

const label = 'absolute rounded-md border border-white/10 bg-ink-950/70 px-2 py-1 font-mono text-[10px] tracking-wider uppercase backdrop-blur-sm';
const steps = { ArrowLeft: -2, ArrowUp: -2, ArrowRight: 2, ArrowDown: 2, Home: -100, End: 100 };

const root = ref(null);
const value = ref(props.position);
const horizontal = computed(() => props.orientation !== 'vertical');

const set = (percent) => (value.value = Math.round(Math.min(100, Math.max(0, percent))));

const startDrag = (event) => {
    const rect = root.value.getBoundingClientRect();

    const drag = (pointer) => set(horizontal.value
        ? ((pointer.clientX - rect.left) / rect.width) * 100
        : ((pointer.clientY - rect.top) / rect.height) * 100);

    const stop = () => {
        root.value.removeEventListener('pointermove', drag);
        root.value.removeEventListener('pointerup', stop);
    };

    root.value.setPointerCapture(event.pointerId);
    root.value.addEventListener('pointermove', drag);
    root.value.addEventListener('pointerup', stop);
    drag(event);
    event.preventDefault();
};

const onKeydown = (event) => {
    if (!(event.key in steps)) {
        return;
    }

    set(value.value + steps[event.key]);
    event.preventDefault();
};
</script>

<template>
    <div
        ref="root"
        class="relative touch-none overflow-hidden rounded-xl border border-white/10 bg-ink-900 select-none"
        :class="ratio"
        :style="{ '--ui-compare': value + '%' }"
        @pointerdown="startDrag"
    >
        <img :src="before" :alt="beforeAlt" class="pointer-events-none absolute inset-0 size-full object-cover" />
        <img
            :src="after"
            :alt="afterAlt"
            class="pointer-events-none absolute inset-0 size-full object-cover"
            :class="horizontal ? '[clip-path:inset(0_0_0_var(--ui-compare))]' : '[clip-path:inset(var(--ui-compare)_0_0_0)]'"
        />

        <span :class="[label, 'top-3 left-3 text-zinc-400']">{{ beforeLabel }}</span>
        <span :class="[label, 'right-3 bottom-3 text-jade-300']">{{ afterLabel }}</span>

        <div
            role="slider"
            tabindex="0"
            aria-label="Comparison position"
            :aria-orientation="horizontal ? 'horizontal' : 'vertical'"
            aria-valuemin="0"
            aria-valuemax="100"
            :aria-valuenow="value"
            class="group absolute bg-cream/70 outline-none"
            :class="horizontal
                ? 'inset-y-0 left-[var(--ui-compare)] w-px -translate-x-1/2 cursor-col-resize'
                : 'inset-x-0 top-[var(--ui-compare)] h-px -translate-y-1/2 cursor-row-resize'"
            @keydown="onKeydown"
        >
            <span class="absolute top-1/2 left-1/2 grid size-8 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border border-white/20 bg-ink-950/80 text-cream shadow-lg shadow-black/40 backdrop-blur-sm transition-colors duration-150 group-hover:border-jade-500/70 group-focus-visible:ring-2 group-focus-visible:ring-jade-500/70 group-active:border-jade-400">
                <svg class="size-3.5" :class="horizontal ? '' : 'rotate-90'" viewBox="0 0 16 16" fill="none">
                    <path d="M6 4.5 2.5 8 6 11.5M10 4.5 13.5 8 10 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </div>
    </div>
</template>
