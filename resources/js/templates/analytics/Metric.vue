<script setup>
defineProps({
    label: { type: String, required: true },
    values: { type: Object, default: () => ({}) },
    deltas: { type: Object, default: () => ({}) },
    trends: { type: Object, default: () => ({}) },
    spark: { type: Object, default: () => ({}) },
    hint: { type: String, default: null },
});

const ranges = ['7d', '28d', '90d'];

const show = {
    '7d': 'hidden group-data-[range=7d]/shell:block',
    '28d': 'hidden group-data-[range=28d]/shell:block',
    '90d': 'hidden group-data-[range=90d]/shell:block',
};

const tones = {
    up: 'text-jade-400',
    down: 'text-red-400',
    flat: 'text-zinc-600',
};

const line = (points) => {
    if (!points || points.length < 2) {
        return '';
    }

    const low = Math.min(...points);
    const span = Math.max(...points) - low || 1;

    return points
        .map((point, index) => `${((index / (points.length - 1)) * 100).toFixed(2)},${(26 - ((point - low) / span) * 22).toFixed(2)}`)
        .join(' ');
};
</script>

<template>
    <div class="flex flex-col rounded-xl border border-white/10 bg-ink-800 p-4">
        <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ label }}</p>

        <div class="mt-2.5 flex items-end justify-between gap-3">
            <div>
                <div v-for="range in ranges" :key="range" :class="show[range]">
                    <p class="text-2xl font-semibold tracking-tight text-cream">{{ values[range] ?? '—' }}</p>
                    <p v-if="deltas[range]" class="mt-1 font-mono text-[11px]" :class="tones[trends[range] ?? 'up']">{{ deltas[range] }}</p>
                </div>
            </div>

            <svg v-if="Object.keys(spark).length" class="h-7 w-20 shrink-0 text-jade-500" viewBox="0 0 100 28" preserveAspectRatio="none" fill="none" aria-hidden="true">
                <template v-for="range in ranges" :key="range">
                    <polyline
                        v-if="spark[range]"
                        :points="line(spark[range])"
                        :class="show[range]"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        vector-effect="non-scaling-stroke"
                    />
                </template>
            </svg>
        </div>

        <p v-if="hint" class="mt-3 font-mono text-[10px] text-zinc-700">{{ hint }}</p>
    </div>
</template>
