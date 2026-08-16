<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    min: { type: Number, default: 0 },
    max: { type: Number, default: 100 },
    step: { type: Number, default: 1 },
    size: { type: String, default: 'md' },
    readonly: { type: Boolean, default: false },
});

const model = defineModel({ type: Number, default: 50 });

const sizes = {
    sm: { knob: 'size-16', text: 'text-xs' },
    md: { knob: 'size-20', text: 'text-sm' },
    lg: { knob: 'size-24', text: 'text-base' },
};

const style = computed(() => sizes[props.size] ?? sizes.md);

const angle = computed(() =>
    props.max > props.min ? ((model.value - props.min) / (props.max - props.min)) * 360 : 0,
);

const set = (next) => {
    model.value = parseFloat(
        Math.min(props.max, Math.max(props.min, Math.round(next / props.step) * props.step)).toFixed(10),
    );
};

const onPointerdown = (event) => {
    if (props.readonly) {
        return;
    }

    event.preventDefault();
    event.currentTarget.focus();

    const startY = event.clientY;
    const startValue = model.value;
    const range = props.max - props.min;

    const move = (moveEvent) => set(startValue + ((startY - moveEvent.clientY) / 150) * range);

    const stop = () => {
        document.removeEventListener('pointermove', move);
        document.removeEventListener('pointerup', stop);
    };

    document.addEventListener('pointermove', move);
    document.addEventListener('pointerup', stop);
};

const onKeydown = (event) => {
    if (props.readonly) {
        return;
    }

    const deltas = { ArrowUp: props.step, ArrowRight: props.step, ArrowDown: -props.step, ArrowLeft: -props.step };

    if (deltas[event.key] === undefined) {
        return;
    }

    event.preventDefault();
    set(model.value + deltas[event.key]);
};

const onWheel = (event) => {
    if (props.readonly) {
        return;
    }

    event.preventDefault();
    set(model.value + (event.deltaY < 0 ? props.step : -props.step));
};
</script>

<template>
    <div class="inline-flex flex-col items-center gap-2">
        <div
            role="slider"
            :aria-label="label ?? 'Value'"
            :aria-valuemin="min"
            :aria-valuemax="max"
            :aria-valuenow="model"
            :tabindex="readonly ? undefined : 0"
            class="grid touch-none place-items-center rounded-full outline-none select-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
            :class="[style.knob, readonly ? '' : 'cursor-ns-resize']"
            :style="{ background: `conic-gradient(var(--color-jade-500) ${angle}deg, var(--color-ink-800) 0)` }"
            @pointerdown="onPointerdown"
            @keydown="onKeydown"
            @wheel="onWheel"
        >
            <div class="grid size-[calc(100%-14px)] place-items-center rounded-full bg-ink-950">
                <span class="font-mono text-cream" :class="style.text">{{ model }}</span>
            </div>
        </div>
        <span v-if="label" class="text-xs text-zinc-500">{{ label }}</span>
    </div>
</template>
