<script setup>
import { computed } from 'vue';

const props = defineProps({
    kind: { type: String, default: 'changed' },
    title: { type: String, required: true },
    note: { type: String, default: null },
    who: { type: String, default: null },
    breaking: { type: Boolean, default: false },
    issue: { type: String, default: null },
});

const kinds = {
    added: { label: 'added', class: 'border-jade-500/40 text-jade-300' },
    changed: { label: 'changed', class: 'border-white/15 text-zinc-300' },
    fixed: { label: 'fixed', class: 'border-white/10 text-zinc-500' },
    removed: { label: 'removed', class: 'border-amber-400/40 text-amber-300' },
    broke: { label: 'we broke it', class: 'border-red-400/40 text-red-400' },
};

const tag = computed(() => kinds[props.kind] ?? kinds.changed);
</script>

<template>
    <div :data-kind="kind" :data-breaking="breaking ? 'yes' : 'no'" class="flex items-start gap-3 px-3.5 py-3">
        <span class="mt-px w-24 shrink-0 rounded border px-1.5 py-0.5 text-center font-mono text-[10px]" :class="tag.class">{{ tag.label }}</span>

        <span class="min-w-0 flex-1">
            <span class="flex flex-wrap items-baseline gap-x-2 gap-y-1">
                <span class="text-[13px]/5 text-cream">{{ title }}</span>

                <span v-if="breaking" class="shrink-0 rounded bg-amber-400/12 px-1.5 py-0.5 font-mono text-[10px] text-amber-300">you may have to do something</span>
                <span v-if="issue" class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ issue }}</span>
            </span>

            <span v-if="note" class="mt-1 block text-[11px]/5 text-zinc-500">{{ note }}</span>

            <span v-if="who" class="mt-1.5 flex items-baseline gap-1.5 font-mono text-[10px] text-zinc-700">
                <span class="mt-1.5 h-px w-3 shrink-0 bg-zinc-700"></span>
                {{ who }}
            </span>
        </span>
    </div>
</template>
