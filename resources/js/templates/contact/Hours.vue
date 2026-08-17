<script setup>
import { computed } from 'vue';

const props = defineProps({
    zone: { type: String, default: 'Taipei' },
    time: { type: String, default: '04:12' },
    cursor: { type: Number, default: 4.2 },
    state: { type: String, default: 'shut' },
    days: { type: String, default: 'Mon–Fri' },
    windows: { type: Array, default: () => [[9.5, 18.5]] },
    note: { type: String, default: null },
});

const pills = {
    open: { dot: 'bg-jade-400', text: 'text-jade-300', edge: 'border-jade-500/30 bg-jade-500/8', word: 'The bench is open' },
    soon: { dot: 'bg-jade-400/60', text: 'text-jade-300/90', edge: 'border-jade-500/25 bg-jade-500/5', word: 'Opening shortly' },
    shut: { dot: 'bg-amber-400', text: 'text-amber-300/90', edge: 'border-amber-400/25 bg-amber-400/8', word: 'Nobody is at the bench' },
};

const ticks = [[0, '00'], [6, '06'], [12, '12'], [18, '18']];

const pill = computed(() => pills[props.state] ?? pills.shut);

const band = computed(() => (props.state === 'open' ? 'bg-jade-500/55' : 'bg-white/14'));

const at = (hour) => `${(hour / 24 * 100).toFixed(3)}%`;

const across = ([from, to]) => `${((to - from) / 24 * 100).toFixed(3)}%`;
</script>

<template>
    <div class="flex flex-wrap items-center gap-x-5 gap-y-3">
        <span class="flex shrink-0 items-center gap-2 rounded-lg border px-2.5 py-1.5" :class="pill.edge">
            <span class="size-1.5 rounded-full" :class="pill.dot"></span>
            <span class="text-[12px]" :class="pill.text">{{ pill.word }}</span>
            <span class="font-mono text-[11px] text-zinc-600">{{ time }} {{ zone }}</span>
        </span>

        <div class="min-w-[14rem] flex-1">
            <div class="relative h-1.5 rounded-full bg-white/6">
                <span
                    v-for="window in windows"
                    :key="window[0]"
                    class="absolute inset-y-0 rounded-full"
                    :class="band"
                    :style="{ left: at(window[0]), width: across(window) }"
                ></span>

                <span class="absolute -top-1.5 -bottom-1.5 w-px bg-cream" :style="{ left: at(cursor) }">
                    <span class="absolute -top-1 -left-[1.5px] size-1 rounded-full bg-cream"></span>
                </span>
            </div>

            <div class="relative mt-1.5 h-3">
                <span
                    v-for="[hour, label] in ticks"
                    :key="hour"
                    class="absolute font-mono text-[9px] text-zinc-700"
                    :style="{ left: at(hour) }"
                >{{ label }}</span>
                <span class="absolute right-0 font-mono text-[9px] text-zinc-700">24</span>
            </div>
        </div>

        <span class="shrink-0 font-mono text-[11px] text-zinc-600">{{ note ?? days }}</span>
    </div>
</template>
