<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: { type: String, required: true },
    source: { type: String, default: 'you' },
    why: { type: String, required: true },
    keeps: { type: String, required: true },
    removable: { type: String, default: 'yes' },
    note: { type: String, default: null },
});

const sources = {
    you: { label: 'you typed it', class: 'text-zinc-500' },
    us: { label: 'we wrote it down', class: 'text-zinc-500' },
    law: { label: 'the law makes us', class: 'text-amber-300/80' },
};

const removals = {
    yes: { label: 'gone on request', dot: 'bg-jade-500', class: 'text-jade-400/90' },
    partly: { label: 'name comes off', dot: 'bg-white/25', class: 'text-zinc-500' },
    no: { label: 'pinned by law', dot: 'bg-amber-400/70', class: 'text-amber-300/80' },
};

const tag = computed(() => sources[props.source] ?? sources.you);
const removal = computed(() => removals[props.removable] ?? removals.yes);
</script>

<template>
    <div class="flex flex-col gap-2 px-3.5 py-3 sm:flex-row sm:gap-5">
        <div class="w-full shrink-0 sm:w-48">
            <p class="text-[13px] text-cream">{{ name }}</p>
            <p class="mt-0.5 font-mono text-[10px]" :class="tag.class">{{ tag.label }}</p>
        </div>

        <div class="min-w-0 flex-1">
            <p class="text-[12px]/5 text-zinc-400">{{ why }}</p>
            <p v-if="note" class="mt-1.5 text-[11px]/5 text-zinc-600">{{ note }}</p>
        </div>

        <div class="flex shrink-0 items-baseline gap-4 sm:w-44 sm:flex-col sm:items-end sm:gap-1.5">
            <p class="font-mono text-[11px] text-zinc-400">{{ keeps }}</p>
            <p class="flex items-center gap-1.5 font-mono text-[10px]" :class="removal.class">
                <span class="size-1.5 rounded-full" :class="removal.dot"></span>
                {{ removal.label }}
            </p>
        </div>
    </div>
</template>
