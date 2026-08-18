<script setup>
import { computed } from 'vue';

const props = defineProps({
    rows: { type: Array, default: () => [] },
    total: { type: String, required: true },
    totalLabel: { type: String, default: 'Total due' },
    note: { type: String, default: null },
    words: { type: String, default: null },
    tone: { type: String, default: 'quiet' },
});

const tones = {
    quiet: 'text-cream',
    due: 'text-jade-300',
    overdue: 'text-red-400',
};

const mark = computed(() => tones[props.tone] ?? tones.quiet);
</script>

<template>
    <div class="flex flex-col gap-3">
        <dl class="flex flex-col gap-2">
            <div v-for="row in rows" :key="row.label" class="flex items-baseline justify-between gap-6">
                <dt class="text-[12px]" :class="row.strong ? 'text-zinc-300' : 'text-zinc-500'">
                    {{ row.label }}
                    <span v-if="row.note" class="ml-1.5 font-mono text-[10px] text-zinc-700">{{ row.note }}</span>
                </dt>
                <dd class="shrink-0 font-mono text-[12px] tabular-nums" :class="row.strong ? 'text-cream' : 'text-zinc-400'">{{ row.value }}</dd>
            </div>
        </dl>

        <div class="flex items-baseline justify-between gap-6 border-t border-white/10 pt-3">
            <span class="text-[13px] text-zinc-300">{{ totalLabel }}</span>
            <span class="shrink-0 font-mono text-lg font-semibold tracking-tight tabular-nums" :class="mark">{{ total }}</span>
        </div>

        <p v-if="words" class="text-[11px]/5 text-zinc-600">{{ words }}</p>

        <p v-if="note" class="border-t border-white/6 pt-2.5 font-mono text-[10px] text-zinc-700">{{ note }}</p>
    </div>
</template>
