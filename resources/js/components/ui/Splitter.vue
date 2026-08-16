<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    orientation: { type: String, default: 'horizontal' },
    size: { type: Number, default: 50 },
    min: { type: Number, default: 20 },
});

const root = ref(null);
const basis = ref(props.size);
const horizontal = computed(() => props.orientation !== 'vertical');

const startDrag = (event) => {
    const gutter = event.currentTarget;
    const rect = root.value.getBoundingClientRect();

    gutter.setPointerCapture(event.pointerId);

    const resize = (move) => {
        const position = horizontal.value
            ? ((move.clientX - rect.left) / rect.width) * 100
            : ((move.clientY - rect.top) / rect.height) * 100;

        basis.value = Math.min(100 - props.min, Math.max(props.min, position));
    };

    const stop = () => {
        gutter.removeEventListener('pointermove', resize);
        gutter.removeEventListener('pointerup', stop);
    };

    gutter.addEventListener('pointermove', resize);
    gutter.addEventListener('pointerup', stop);
    event.preventDefault();
};
</script>

<template>
    <div
        ref="root"
        class="overflow-hidden rounded-xl border border-white/10 bg-ink-800"
        :class="horizontal ? 'flex' : 'flex flex-col'"
    >
        <div class="min-h-0 min-w-0 shrink-0 grow-0 overflow-auto" :style="{ flexBasis: basis + '%' }"><slot name="first" /></div>
        <div
            @pointerdown="startDrag"
            class="group grid shrink-0 touch-none place-items-center bg-ink-950"
            :class="horizontal ? 'w-2 cursor-col-resize border-x border-white/10' : 'h-2 cursor-row-resize border-y border-white/10'"
        >
            <span
                class="rounded-full bg-white/20 transition-colors duration-150 group-hover:bg-jade-500/70 group-active:bg-jade-400"
                :class="horizontal ? 'h-6 w-0.5' : 'h-0.5 w-6'"
            ></span>
        </div>
        <div class="min-h-0 min-w-0 flex-1 overflow-auto"><slot name="second" /></div>
    </div>
</template>
