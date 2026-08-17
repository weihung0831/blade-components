<script setup>
import { computed } from 'vue';

const props = defineProps({
    term: { type: String, required: true },
    hits: { type: Number, required: true },
    peak: { type: Number, default: 100 },
    results: { type: Number, default: 0 },
    read: { type: Number, default: null },
    state: { type: String, default: 'answered' },
});

const states = {
    answered: { bar: 'bg-jade-500/50', tone: 'text-zinc-600', dot: 'bg-white/10' },
    thin: { bar: 'bg-amber-400/50', tone: 'text-amber-300', dot: 'bg-amber-400' },
    missing: { bar: 'bg-red-400/50', tone: 'text-red-300', dot: 'bg-red-400' },
};

const style = computed(() => states[props.state] ?? states.answered);

const width = computed(() => Math.max(4, Math.round(props.hits / Math.max(props.peak, 1) * 100)));
</script>

<template>
    <div class="flex items-center gap-3 border-b border-white/5 py-2.5 pr-3 pl-4">
        <span aria-hidden="true" class="size-1.5 shrink-0 rounded-full" :class="style.dot"></span>

        <span class="w-52 shrink-0 truncate font-mono text-[12px] text-zinc-300">{{ term }}</span>

        <span class="hidden h-1 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6 sm:block">
            <span class="block h-full rounded-full" :class="style.bar" :style="{ width: `${width}%` }"></span>
        </span>

        <span class="ml-auto flex shrink-0 items-baseline gap-4 whitespace-nowrap">
            <span class="hidden w-10 text-right font-mono text-[10px] text-zinc-700 md:block">{{ read !== null ? `${read}%` : '—' }}</span>
            <span class="w-16 text-right font-mono text-[10px]" :class="style.tone">{{ results }} {{ results === 1 ? 'answer' : 'answers' }}</span>
            <span class="w-10 text-right font-mono text-[12px] text-zinc-400">{{ hits }}</span>
        </span>
    </div>
</template>
