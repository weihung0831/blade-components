<script setup>
import { computed } from 'vue';

const props = defineProps({
    clause: { type: String, required: true },
    title: { type: String, default: null },
    lines: { type: Array, default: () => [] },
    why: { type: String, default: null },
    verdict: { type: String, default: null },
});

const tints = {
    '-': { row: 'bg-red-400/6', mark: 'text-red-400/80', text: 'text-zinc-500' },
    '+': { row: 'bg-jade-500/8', mark: 'text-jade-400', text: 'text-zinc-300' },
};

const skin = (mark) => tints[mark] ?? { row: '', mark: 'text-zinc-700', text: 'text-zinc-500' };

const added = computed(() => props.lines.filter((line) => line.mark === '+').length);
const removed = computed(() => props.lines.filter((line) => line.mark === '-').length);

const verdictClass = computed(() => ({
    'better for you': 'border-jade-500/40 bg-jade-500/10 text-jade-300',
    'better for us': 'border-amber-400/30 bg-amber-400/8 text-amber-300/90',
}[props.verdict] ?? 'border-white/10 text-zinc-600'));
</script>

<template>
    <div class="overflow-hidden rounded-xl border border-white/8 bg-ink-900">
        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1 border-b border-white/5 px-3.5 py-2.5">
            <span class="font-mono text-[11px] text-zinc-700">{{ clause }}</span>
            <span v-if="title" class="text-[13px] text-zinc-300">{{ title }}</span>

            <span class="ml-auto flex shrink-0 items-center gap-2 font-mono text-[10px]">
                <span class="text-red-400/80">−{{ removed }}</span>
                <span class="text-jade-400">+{{ added }}</span>
            </span>
        </div>

        <div class="divide-y divide-white/4">
            <p v-for="(line, index) in lines" :key="index" class="flex gap-3 px-3.5 py-2" :class="skin(line.mark).row">
                <span class="w-2 shrink-0 font-mono text-[11px]" :class="skin(line.mark).mark">{{ line.mark === ' ' ? '' : line.mark }}</span>
                <span class="font-mono text-[11px]/5" :class="skin(line.mark).text">{{ line.text }}</span>
            </p>
        </div>

        <div v-if="why || verdict" class="flex flex-wrap items-baseline gap-x-3 gap-y-1.5 border-t border-white/5 px-3.5 py-2.5">
            <span v-if="why" class="min-w-0 flex-1 text-[12px]/5 text-zinc-500">{{ why }}</span>
            <span v-if="verdict" class="shrink-0 rounded border px-1.5 py-0.5 font-mono text-[10px]" :class="verdictClass">{{ verdict }}</span>
        </div>
    </div>
</template>
