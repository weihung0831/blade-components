<script setup>
defineProps({
    name: { type: String, required: true },
    count: { type: Number, default: 0 },
    lead: { type: String, default: null },
    health: { type: Number, default: null },
    note: { type: String, default: null },
    active: { type: Boolean, default: false },
});

const pad = (value) => String(value).padStart(2, '0');
</script>

<template>
    <button
        type="button"
        class="group/topic flex flex-col rounded-xl border bg-ink-900 px-4 py-3.5 text-left outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-jade-500/70"
        :class="active ? 'border-jade-500/60 bg-jade-500/8' : 'border-white/8 hover:border-white/15'"
    >
        <span class="flex items-baseline gap-2">
            <span class="text-[13px] font-medium" :class="active ? 'text-cream' : 'text-zinc-300'">{{ name }}</span>
            <span class="ml-auto font-mono text-[11px]" :class="active ? 'text-jade-400' : 'text-zinc-700'">{{ pad(count) }}</span>
        </span>

        <span v-if="lead" class="mt-1.5 line-clamp-2 text-[12px]/5 text-zinc-600">Most opened: {{ lead }}</span>

        <span class="mt-3 flex items-center gap-2">
            <span class="block h-0.5 flex-1 overflow-hidden rounded-full bg-white/8">
                <span class="block h-full rounded-full" :class="(health ?? 100) >= 80 ? 'bg-jade-500/60' : 'bg-amber-400/60'" :style="{ width: `${health ?? 0}%` }"></span>
            </span>
            <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ note ?? `${health}% helpful` }}</span>
        </span>
    </button>
</template>
