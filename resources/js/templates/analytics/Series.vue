<script setup>
defineProps({
    series: { type: Array, default: () => [] },
    axis: { type: Object, default: () => ({}) },
    scale: { type: Object, default: () => ({}) },
    height: { type: String, default: 'h-64' },
});

const ranges = ['7d', '28d', '90d'];

const show = {
    '7d': 'hidden group-data-[range=7d]/shell:block',
    '28d': 'hidden group-data-[range=28d]/shell:block',
    '90d': 'hidden group-data-[range=90d]/shell:block',
};

const flex = {
    '7d': 'hidden group-data-[range=7d]/shell:flex',
    '28d': 'hidden group-data-[range=28d]/shell:flex',
    '90d': 'hidden group-data-[range=90d]/shell:flex',
};

const path = (points, close = false) => {
    if (!points || points.length < 2) {
        return '';
    }

    const steps = points.map((point, index) => `${((index / (points.length - 1)) * 100).toFixed(2)} ${(100 - point).toFixed(2)}`);
    const line = `M${steps.join(' L')}`;

    return close ? `${line} L100 100 L0 100 Z` : line;
};
</script>

<template>
    <div>
        <div class="flex gap-3">
            <div class="flex w-9 shrink-0 flex-col justify-between py-px text-right font-mono text-[10px] text-zinc-700">
                <template v-for="range in ranges" :key="range">
                    <div v-if="scale[range]" class="h-full flex-col justify-between" :class="flex[range]">
                        <span v-for="tick in scale[range]" :key="tick">{{ tick }}</span>
                    </div>
                </template>
            </div>

            <div class="relative min-w-0 flex-1" :class="height">
                <div aria-hidden="true" class="absolute inset-0 flex flex-col justify-between">
                    <span v-for="index in 4" :key="index" class="h-px w-full bg-white/6"></span>
                </div>

                <svg class="relative h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none" aria-hidden="true">
                    <template v-for="(line, lineIndex) in series" :key="lineIndex">
                        <template v-for="range in ranges" :key="range">
                            <path
                                v-if="line.points[range] && line.area"
                                :d="path(line.points[range], true)"
                                :class="[show[range], 'text-jade-500']"
                                fill="currentColor"
                                opacity="0.1"
                            />

                            <path
                                v-if="line.points[range]"
                                :d="path(line.points[range])"
                                :class="[show[range], line.muted ? 'text-zinc-500' : 'text-jade-500']"
                                stroke="currentColor"
                                stroke-width="1.75"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                vector-effect="non-scaling-stroke"
                                :stroke-dasharray="line.dashed ? '4 3' : null"
                            />
                        </template>
                    </template>
                </svg>
            </div>
        </div>

        <div class="mt-2 flex gap-3">
            <span class="w-9 shrink-0"></span>
            <div class="min-w-0 flex-1">
                <template v-for="range in ranges" :key="range">
                    <div v-if="axis[range]" class="justify-between font-mono text-[10px] text-zinc-700" :class="flex[range]">
                        <span v-for="tick in axis[range]" :key="tick">{{ tick }}</span>
                    </div>
                </template>
            </div>
        </div>

        <div v-if="series.length" class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 font-mono text-[11px] text-zinc-500">
            <span v-for="line in series" :key="line.label" class="inline-flex items-center gap-2">
                <span class="h-0.5 w-4 rounded-full" :class="line.muted ? 'bg-zinc-500' : 'bg-jade-500'"></span>
                {{ line.label }}
            </span>
        </div>
    </div>
</template>
