<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    span: { type: Number, required: true },
    unit: { type: String, default: 'days' },
    elapsed: { type: Number, default: 0 },
    then: { type: String, required: true },
    pinned: { type: Boolean, default: false },
});

const ratio = computed(() => (props.span > 0 ? Math.min(100, (props.elapsed / props.span) * 100) : 0));
</script>

<template>
    <div class="rounded-xl border border-white/8 bg-ink-900 p-3.5">
        <div class="flex items-baseline gap-3">
            <p class="min-w-0 flex-1 truncate text-[13px] text-cream">{{ label }}</p>
            <p class="shrink-0 font-mono text-[11px]" :class="pinned ? 'text-amber-300/80' : 'text-zinc-400'">{{ span }} {{ unit }}</p>
        </div>

        <div class="mt-2.5 h-1.5 overflow-hidden rounded-full bg-white/8">
            <div class="h-full rounded-full" :class="pinned ? 'bg-amber-400/60' : 'bg-jade-500'" :style="{ width: `${ratio.toFixed(2)}%` }"></div>
        </div>

        <div class="mt-2 flex items-baseline justify-between gap-3">
            <p class="shrink-0 font-mono text-[10px] whitespace-nowrap text-zinc-700">{{ elapsed }} {{ unit }} in</p>
            <p class="min-w-0 truncate text-right text-[11px] text-zinc-500">{{ then }}</p>
        </div>
    </div>
</template>
