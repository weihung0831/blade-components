<script setup>
import { computed } from 'vue';

const props = defineProps({
    version: { type: String, required: true },
    state: { type: String, default: 'accepted' },
    when: { type: String, default: null },
    rows: { type: Array, default: () => [] },
    hash: { type: String, default: null },
    note: { type: String, default: null },
});

const pills = {
    accepted: { label: 'accepted', class: 'border-jade-500/40 bg-jade-500/10 text-jade-300' },
    waiting: { label: 'not yet accepted', class: 'border-amber-400/30 bg-amber-400/8 text-amber-300/90' },
    superseded: { label: 'superseded', class: 'border-white/10 text-zinc-600' },
};

const pill = computed(() => pills[props.state] ?? { label: props.state, class: 'border-white/10 text-zinc-600' });
</script>

<template>
    <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1.5">
            <span class="font-mono text-xl text-cream">{{ version }}</span>
            <span class="rounded border px-1.5 py-0.5 font-mono text-[10px]" :class="pill.class">{{ pill.label }}</span>
            <span v-if="when" class="ml-auto font-mono text-[11px] text-zinc-600">{{ when }}</span>
        </div>

        <dl v-if="rows.length" class="mt-3.5 border-t border-dashed border-white/10 pt-3.5">
            <div v-for="row in rows" :key="row.label" class="flex gap-4 py-1">
                <dt class="w-28 shrink-0 font-mono text-[10px] text-zinc-700 uppercase">{{ row.label }}</dt>
                <dd class="min-w-0 flex-1 text-[12px]/5" :class="row.mono ? 'font-mono text-zinc-300' : 'text-zinc-400'">{{ row.value }}</dd>
            </div>
        </dl>

        <p v-if="hash" class="mt-3 truncate border-t border-dashed border-white/10 pt-3 font-mono text-[10px] text-zinc-700">
            sha256 {{ hash }}
        </p>

        <p v-if="note" class="mt-3 text-[11px]/5 text-zinc-600">{{ note }}</p>

        <div v-if="$slots.actions" class="mt-3.5 flex flex-wrap gap-2">
            <slot name="actions" />
        </div>
    </div>
</template>
