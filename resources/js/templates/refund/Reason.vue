<script setup>
defineProps({
    label: { type: String, required: true },
    lead: { type: String, required: true },
    days: { type: String, required: true },
    picked: { type: Boolean, default: false },
});

defineEmits(['pick']);
</script>

<template>
    <button
        type="button"
        :data-active="picked ? '' : undefined"
        class="group flex w-full flex-col gap-1.5 rounded-xl border border-white/8 bg-ink-900 p-3.5 text-left transition-colors duration-150 outline-none hover:border-white/20 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:border-jade-500/50 data-active:bg-jade-500/8"
        @click="$emit('pick')"
    >
        <span class="flex items-baseline gap-2.5">
            <span class="size-1.5 shrink-0 rounded-full bg-zinc-700 group-data-active:bg-jade-500"></span>
            <span class="min-w-0 flex-1 text-[13px] text-zinc-300 group-data-active:text-cream">{{ label }}</span>
            <span class="shrink-0 font-mono text-[10px] text-zinc-700 group-data-active:text-jade-400">{{ days }}</span>
        </span>

        <span class="block pl-4 text-[11px]/5 text-zinc-600 group-data-active:text-zinc-400">{{ lead }}</span>
    </button>
</template>
