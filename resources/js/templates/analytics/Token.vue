<script setup>
defineProps({
    type: { type: String, default: 'where' },
    label: { type: String, required: true },
    value: { type: String, default: null },
    removable: { type: Boolean, default: true },
});
</script>

<template>
    <span class="group/token inline-flex items-center gap-2 rounded-lg border border-white/10 bg-ink-900 py-1 pr-1 pl-2.5 text-[13px] transition-colors duration-150 hover:border-white/20">
        <span class="font-mono text-[10px] tracking-wider uppercase" :class="type === 'event' ? 'text-jade-400' : 'text-zinc-600'">{{ type }}</span>

        <span class="text-zinc-200">{{ label }}</span>

        <span v-if="value" class="font-mono text-[11px] text-zinc-500">{{ value }}</span>

        <button
            v-if="removable"
            type="button"
            :aria-label="`Remove ${label}`"
            class="grid size-5 shrink-0 place-items-center rounded-md text-zinc-700 transition-colors duration-150 outline-none hover:bg-white/8 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
        >
            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M3 3l6 6M9 3l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
        </button>
    </span>
</template>
