<script setup>
import { computed } from 'vue';

const props = defineProps({
    source: { type: String, required: true },
    sample: { type: String, required: true },
    target: { type: String, required: true },
    state: { type: String, default: 'matched' },
    note: { type: String, default: null },
    options: { type: Array, default: () => [] },
});

const states = {
    matched: { label: 'matched', class: 'text-jade-400/90', dot: 'bg-jade-500' },
    guessed: { label: 'our guess', class: 'text-zinc-400', dot: 'bg-white/30' },
    clash: { label: 'already here', class: 'text-amber-300/80', dot: 'bg-amber-400/70' },
    dropped: { label: 'not coming', class: 'text-zinc-600', dot: 'bg-white/10' },
};

const tone = computed(() => states[props.state] ?? states.matched);
</script>

<template>
    <div class="flex flex-col gap-2 px-3.5 py-3 sm:flex-row sm:items-center sm:gap-4" :data-state="state">
        <div class="min-w-0 sm:w-44">
            <p class="truncate font-mono text-[12px] text-cream">{{ source }}</p>
            <p class="mt-0.5 truncate font-mono text-[10px] text-zinc-600">{{ sample }}</p>
        </div>

        <svg class="hidden size-3 shrink-0 text-zinc-700 sm:block" viewBox="0 0 12 12" fill="none">
            <path d="M2 6h8m0 0L7.2 3.2M10 6 7.2 8.8" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <div class="min-w-0 flex-1">
            <p v-if="state === 'dropped'" class="font-mono text-[12px] text-zinc-700 line-through">{{ target }}</p>
            <div v-else class="flex items-center gap-2">
                <span class="min-w-0 truncate rounded-lg border border-white/10 bg-ink-950 px-2.5 py-1.5 font-mono text-[12px] text-zinc-300">{{ target }}</span>
                <span v-if="options.length" class="font-mono text-[10px] text-zinc-700">{{ options.length }} other columns fit</span>
            </div>

            <p v-if="note" class="mt-1.5 text-[11px]/5 text-zinc-600">{{ note }}</p>
        </div>

        <p class="flex shrink-0 items-center gap-1.5 font-mono text-[10px] sm:w-28 sm:justify-end" :class="tone.class">
            <span class="size-1.5 rounded-full" :class="tone.dot"></span>
            {{ tone.label }}
        </p>
    </div>
</template>
