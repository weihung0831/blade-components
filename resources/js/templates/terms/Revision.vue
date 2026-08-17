<script setup>
import { computed } from 'vue';

const props = defineProps({
    version: { type: String, required: true },
    date: { type: String, required: true },
    state: { type: String, default: 'retired' },
    lead: { type: String, default: null },
    touched: { type: Array, default: () => [] },
    consent: { type: Boolean, default: false },
    active: { type: Boolean, default: false },
});

const pills = {
    force: { label: 'in force', class: 'border-jade-500/40 bg-jade-500/10 text-jade-300' },
    pending: { label: 'waiting', class: 'border-amber-400/30 bg-amber-400/8 text-amber-300/90' },
    retired: { label: 'retired', class: 'border-white/10 text-zinc-600' },
};

const pill = computed(() => pills[props.state] ?? { label: props.state, class: 'border-white/10 text-zinc-600' });
</script>

<template>
    <button
        type="button"
        class="group/rev flex w-full flex-col rounded-xl border p-3.5 text-left outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-jade-500/70"
        :class="active ? 'border-jade-500/60 bg-jade-500/8' : 'border-white/8 bg-ink-900 hover:border-white/15'"
    >
        <span class="flex items-baseline gap-2.5">
            <span class="font-mono text-base text-cream">{{ version }}</span>
            <span class="rounded border px-1.5 py-0.5 font-mono text-[10px]" :class="pill.class">{{ pill.label }}</span>
            <span class="ml-auto font-mono text-[10px] text-zinc-700">{{ date }}</span>
        </span>

        <span v-if="lead" class="mt-2 text-[12px]/5 text-zinc-500">{{ lead }}</span>

        <span class="mt-2.5 flex flex-wrap items-center gap-1.5">
            <template v-if="touched.length">
                <span class="font-mono text-[10px] text-zinc-700">touched</span>
                <span
                    v-for="number in touched"
                    :key="number"
                    class="rounded border border-white/10 px-1 py-0.5 font-mono text-[10px] text-zinc-500"
                >{{ number }}</span>
            </template>

            <span class="ml-auto font-mono text-[10px]" :class="consent ? 'text-amber-300/80' : 'text-zinc-700'">
                {{ consent ? 'needed a yes from you' : 'notice only' }}
            </span>
        </span>
    </button>
</template>
