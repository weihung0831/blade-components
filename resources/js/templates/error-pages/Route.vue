<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    note: { type: String, default: null },
    href: { type: String, default: null },
    meta: { type: String, default: null },
    kbd: { type: String, default: null },
    tone: { type: String, default: 'quiet' },
});

const classes = {
    quiet: 'border-white/8 bg-ink-950 text-zinc-300 hover:border-white/20 hover:text-cream',
    primary: 'border-jade-500/40 bg-jade-500/8 text-cream hover:border-jade-500/70',
    dead: 'border-white/6 bg-ink-950 text-zinc-600',
};

const tag = computed(() => (props.href === null ? 'div' : 'a'));
</script>

<template>
    <component
        :is="tag"
        :href="href ?? undefined"
        :target="href ? '_top' : undefined"
        class="group flex items-center gap-3 rounded-xl border px-3.5 py-3 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
        :class="classes[tone] ?? classes.quiet"
    >
        <span class="min-w-0 flex-1">
            <span class="flex flex-wrap items-baseline gap-x-2">
                <span class="text-[13px]/5">{{ label }}</span>
                <span v-if="kbd" class="rounded border border-white/10 px-1 font-mono text-[10px] text-zinc-600">{{ kbd }}</span>
            </span>

            <span v-if="note" class="mt-1 block text-[11px]/5 text-zinc-500">{{ note }}</span>
        </span>

        <span v-if="meta" class="shrink-0 font-mono text-[10px] text-zinc-700">{{ meta }}</span>

        <svg v-if="href" class="size-3.5 shrink-0 text-zinc-700 transition-transform duration-150 group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M6 3.5 10.5 8 6 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </component>
</template>
