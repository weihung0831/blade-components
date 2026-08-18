<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    id: { type: String, required: true },
    when: { type: String, required: true },
    region: { type: String, default: null },
    build: { type: String, default: null },
    note: { type: String, default: null },
    tone: { type: String, default: 'quiet' },
});

const rows = computed(() => [
    { label: 'reference', value: props.id },
    { label: 'happened', value: props.when },
    ...(props.region ? [{ label: 'served from', value: props.region }] : []),
    ...(props.build ? [{ label: 'running', value: props.build }] : []),
]);

const label = ref('copy all four');

const copy = () => {
    navigator.clipboard?.writeText(rows.value.map((row) => `${row.label}: ${row.value}`).join('  '));
    label.value = 'on your clipboard';
    setTimeout(() => (label.value = 'copy all four'), 1600);
};
</script>

<template>
    <div class="overflow-hidden rounded-xl border bg-ink-900" :class="tone === 'fault' ? 'border-red-400/25' : 'border-white/8'">
        <div class="flex items-center gap-3 border-b border-white/5 px-3.5 py-2">
            <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What to quote</p>

            <button
                type="button"
                @click="copy"
                class="ml-auto inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2 py-1 font-mono text-[10px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
            >
                <svg class="size-3" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 5.5v-1a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h1" stroke="currentColor" stroke-width="1.3"/></svg>
                {{ label }}
            </button>
        </div>

        <dl class="divide-y divide-white/5">
            <div v-for="row in rows" :key="row.label" class="flex items-baseline gap-3 px-3.5 py-2">
                <dt class="w-24 shrink-0 font-mono text-[10px] text-zinc-700">{{ row.label }}</dt>
                <dd class="min-w-0 flex-1 font-mono text-[11px] break-all text-zinc-300">{{ row.value }}</dd>
            </div>
        </dl>

        <p v-if="note" class="border-t border-white/5 px-3.5 py-2.5 text-[11px]/5 text-zinc-600">{{ note }}</p>
    </div>
</template>
