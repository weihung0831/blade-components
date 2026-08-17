<script setup>
import { computed } from 'vue';

const props = defineProps({
    version: { type: String, required: true },
    effective: { type: String, required: true },
    announced: { type: String, default: null },
    days: { type: Number, default: 28 },
    window: { type: Number, default: 45 },
    elapsed: { type: Number, default: 17 },
    lead: { type: String, default: null },
    promise: { type: String, default: null },
});

const ratio = computed(() => `${Math.max(0, Math.min(100, (props.elapsed / Math.max(1, props.window)) * 100)).toFixed(3)}%`);
</script>

<template>
    <div class="rounded-xl border border-amber-400/25 bg-amber-400/5 p-4">
        <div class="flex flex-wrap items-start gap-x-6 gap-y-3">
            <div class="min-w-0 flex-1">
                <p class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                    <span class="font-mono text-[13px] text-amber-300">{{ version }}</span>
                    <span class="text-[13px] text-cream">takes effect on {{ effective }}</span>
                </p>

                <p v-if="lead" class="mt-1.5 max-w-xl text-[12px]/5 text-zinc-500">{{ lead }}</p>
            </div>

            <div class="flex shrink-0 items-baseline gap-2">
                <span class="font-mono text-2xl text-cream">{{ days }}</span>
                <span class="font-mono text-[10px] text-zinc-600">days from today</span>
            </div>
        </div>

        <div class="mt-4">
            <div class="relative h-1.5 overflow-hidden rounded-full bg-white/6">
                <span class="absolute inset-y-0 left-0 rounded-full bg-amber-400/50" :style="{ width: ratio }"></span>
                <span class="absolute -top-1 -bottom-1 w-px bg-cream" :style="{ left: ratio }"></span>
            </div>

            <div class="mt-2 flex flex-wrap items-baseline gap-x-4 gap-y-1 font-mono text-[10px] text-zinc-700">
                <span v-if="announced">announced {{ announced }}</span>
                <span>{{ window }} days of notice, {{ elapsed }} of them gone</span>
                <span class="ml-auto">{{ effective }}</span>
            </div>
        </div>

        <p v-if="promise" class="mt-3 border-t border-amber-400/15 pt-3 text-[11px]/5 text-zinc-500">{{ promise }}</p>

        <div v-if="$slots.actions" class="mt-3.5 flex flex-wrap gap-2">
            <slot name="actions" />
        </div>
    </div>
</template>
