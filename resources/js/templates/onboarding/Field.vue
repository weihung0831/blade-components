<script setup>
defineProps({
    label: { type: String, required: true },
    value: { type: String, default: '' },
    placeholder: { type: String, default: '' },
    why: { type: String, default: null },
    hint: { type: String, default: null },
    prefix: { type: String, default: null },
    suffix: { type: String, default: null },
    locked: { type: Boolean, default: false },
    optional: { type: Boolean, default: false },
});
</script>

<template>
    <label class="block">
        <span class="flex items-baseline gap-2">
            <span class="text-[12px] text-zinc-300">{{ label }}</span>
            <span v-if="optional" class="font-mono text-[10px] text-zinc-700">optional</span>
            <span v-if="locked" class="ml-auto font-mono text-[10px] text-amber-300/70">set for good</span>
        </span>

        <span
            class="mt-1.5 flex items-center gap-0 overflow-hidden rounded-lg border transition-colors duration-150"
            :class="locked ? 'border-white/8 bg-ink-950/60' : 'border-white/10 bg-ink-950 focus-within:border-jade-500/60'"
        >
            <span v-if="prefix" class="shrink-0 border-r border-white/8 px-2.5 py-2 font-mono text-[11px] text-zinc-600">{{ prefix }}</span>

            <span v-if="locked" class="min-w-0 flex-1 truncate px-3 py-2 font-mono text-[12px] text-zinc-500">{{ value }}</span>
            <input
                v-else
                type="text"
                :value="value"
                :placeholder="placeholder"
                class="min-w-0 flex-1 bg-transparent px-3 py-2 text-[13px] text-cream placeholder:text-zinc-700 focus:outline-none"
            />

            <span v-if="suffix" class="shrink-0 border-l border-white/8 px-2.5 py-2 font-mono text-[11px] text-zinc-600">{{ suffix }}</span>
        </span>

        <span v-if="why" class="mt-1.5 block text-[11px]/5 text-zinc-600">{{ why }}</span>
        <span v-if="hint" class="mt-1 block font-mono text-[10px] text-jade-400/80">{{ hint }}</span>
    </label>
</template>
