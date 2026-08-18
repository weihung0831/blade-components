<script setup>
import { computed } from 'vue';

const props = defineProps({
    thing: { type: String, required: true },
    announced: { type: String, required: true },
    shipped: { type: String, default: null },
    slip: { type: Number, default: null },
    state: { type: String, default: 'shipped' },
    version: { type: String, default: null },
    note: { type: String, default: null },
});

const states = {
    shipped: { label: 'shipped', text: 'text-cream', bar: 'bg-jade-500' },
    late: { label: 'shipped late', text: 'text-cream', bar: 'bg-amber-400/70' },
    dropped: { label: 'dropped', text: 'text-zinc-500 line-through decoration-white/20', bar: 'bg-white/10' },
    open: { label: 'still open', text: 'text-zinc-300', bar: 'bg-white/20' },
};

const mark = computed(() => states[props.state] ?? states.shipped);
const width = computed(() => (props.slip === null ? 4 : Math.min(100, Math.max(4, Math.round((props.slip / 40) * 100)))));
</script>

<template>
    <div :data-promise="state" class="px-3.5 py-3">
        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
            <p class="min-w-0 flex-1 text-[13px]" :class="mark.text">{{ thing }}</p>

            <span v-if="version" class="shrink-0 font-mono text-[10px] text-zinc-600">{{ version }}</span>

            <span
                class="w-24 shrink-0 text-right font-mono text-[10px]"
                :class="state === 'late' ? 'text-amber-300/80' : 'text-zinc-700'"
            >{{ mark.label }}</span>
        </div>

        <div class="mt-2 flex items-center gap-2">
            <span class="w-20 shrink-0 font-mono text-[10px] text-zinc-700">{{ announced }}</span>

            <span class="h-1.5 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6">
                <span class="block h-full rounded-full transition-[width] duration-300" :class="mark.bar" :style="{ width: `${width}%` }"></span>
            </span>

            <span
                class="w-20 shrink-0 text-right font-mono text-[10px]"
                :class="shipped ? 'text-zinc-500' : 'text-zinc-700'"
            >{{ shipped ?? 'never' }}</span>
        </div>

        <div v-if="slip !== null || note" class="mt-1.5 flex flex-wrap items-baseline gap-x-3 gap-y-1">
            <p v-if="slip !== null" class="shrink-0 font-mono text-[10px]" :class="slip > 12 ? 'text-amber-300/80' : 'text-zinc-600'">{{ slip }} weeks between the two</p>
            <p v-if="note" class="min-w-0 flex-1 text-[11px]/5 text-zinc-600">{{ note }}</p>
        </div>
    </div>
</template>
