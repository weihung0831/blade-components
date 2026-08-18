<script setup>
import { computed } from 'vue';

const props = defineProps({
    reason: { type: String, required: true },
    window: { type: String, required: true },
    condition: { type: String, required: true },
    freight: { type: String, default: 'you' },
    back: { type: String, default: 'all' },
    note: { type: String, default: null },
});

const freights = {
    you: { label: 'you pay $18', class: 'text-zinc-500' },
    us: { label: 'we book the courier', class: 'text-jade-400/90' },
    none: { label: 'nothing to send', class: 'text-zinc-600' },
};

const outcomes = {
    all: { label: 'every cent back', dot: 'bg-jade-500', class: 'text-jade-400/90' },
    part: { label: 'most of it back', dot: 'bg-white/25', class: 'text-zinc-500' },
    none: { label: 'nothing back', dot: 'bg-amber-400/70', class: 'text-amber-300/80' },
};

const carrier = computed(() => freights[props.freight] ?? freights.you);
const outcome = computed(() => outcomes[props.back] ?? outcomes.all);
</script>

<template>
    <div class="flex flex-col gap-2 px-3.5 py-3 sm:flex-row sm:gap-5">
        <div class="w-full shrink-0 sm:w-52">
            <p class="text-[13px] text-cream">{{ reason }}</p>
            <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ window }}</p>
        </div>

        <div class="min-w-0 flex-1">
            <p class="text-[12px]/5 text-zinc-400">{{ condition }}</p>
            <p v-if="note" class="mt-1.5 text-[11px]/5 text-zinc-600">{{ note }}</p>
        </div>

        <div class="flex shrink-0 items-baseline gap-4 sm:w-44 sm:flex-col sm:items-end sm:gap-1.5">
            <p class="font-mono text-[11px]" :class="carrier.class">{{ carrier.label }}</p>
            <p class="flex items-center gap-1.5 font-mono text-[10px]" :class="outcome.class">
                <span class="size-1.5 rounded-full" :class="outcome.dot"></span>
                {{ outcome.label }}
            </p>
        </div>
    </div>
</template>
