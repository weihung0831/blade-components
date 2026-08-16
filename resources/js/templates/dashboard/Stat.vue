<script setup>
import UiNumberTicker from '../../components/ui/NumberTicker.vue';

defineProps({
    label: { type: String, default: '' },
    value: { type: Number, default: 0 },
    decimals: { type: Number, default: 0 },
    prefix: { type: String, default: null },
    suffix: { type: String, default: null },
    delta: { type: String, default: null },
    trend: { type: String, default: 'up' },
    hint: { type: String, default: null },
});

const tones = {
    up: 'text-jade-400',
    down: 'text-red-400',
    flat: 'text-zinc-500',
};

const arrows = {
    up: 'M8 12.5v-9M4 7l4-3.5L12 7',
    down: 'M8 3.5v9M4 9l4 3.5L12 9',
    flat: 'M3.5 8h9',
};
</script>

<template>
    <div class="rounded-xl border border-white/10 bg-ink-800 p-4 transition-colors duration-200 hover:border-white/20">
        <p class="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{{ label }}</p>

        <p class="mt-2.5 text-2xl font-semibold tracking-tight text-cream">
            <UiNumberTicker :value="value" :decimals="decimals" :prefix="prefix" :suffix="suffix" />
        </p>

        <div class="mt-2 flex items-center gap-2">
            <span v-if="delta" class="inline-flex items-center gap-1 font-mono text-[11px]" :class="tones[trend] ?? tones.flat">
                <svg class="size-3" viewBox="0 0 16 16" fill="none"><path :d="arrows[trend] ?? arrows.flat" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ delta }}
            </span>
            <span v-if="hint" class="truncate text-[11px] text-zinc-600">{{ hint }}</span>
        </div>
    </div>
</template>
