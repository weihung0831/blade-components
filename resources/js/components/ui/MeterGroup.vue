<script setup>
const props = defineProps({
    segments: { type: Array, default: () => [] },
    label: { type: String, default: null },
    total: { type: String, default: null },
    max: { type: Number, default: 100 },
    unit: { type: String, default: '%' },
});

const colors = {
    jade: 'bg-jade-500',
    mint: 'bg-jade-300',
    zinc: 'bg-zinc-500',
};

const colorClass = (segment) => colors[segment.color] ?? colors.jade;

const width = (segment) => `${Math.round((segment.value / props.max) * 10000) / 100}%`;

const display = (segment) => (props.unit === '%' ? `${segment.value}%` : `${segment.value} ${props.unit}`);
</script>

<template>
    <div class="w-full">
        <div v-if="label !== null || total !== null" class="mb-2.5 flex items-baseline justify-between gap-4">
            <p v-if="label !== null" class="text-sm font-medium text-cream">{{ label }}</p>
            <p v-if="total !== null" class="font-mono text-xs text-zinc-500">{{ total }}</p>
        </div>
        <div class="flex h-2 overflow-hidden rounded-full bg-ink-800">
            <span v-for="(segment, index) in segments" :key="index" :class="colorClass(segment)" :style="{ width: width(segment) }"></span>
        </div>
        <div class="mt-3 flex flex-col gap-1.5 text-xs">
            <span v-for="(segment, index) in segments" :key="index" class="flex items-center gap-2 text-zinc-400">
                <span class="size-2 shrink-0 rounded-full" :class="colorClass(segment)"></span>
                {{ segment.label }}
                <span class="ml-auto font-mono text-zinc-500">{{ display(segment) }}</span>
            </span>
        </div>
    </div>
</template>
