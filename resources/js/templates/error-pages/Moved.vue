<script setup>
defineProps({
    address: { type: String, required: true },
    was: { type: String, default: null },
    happened: { type: String, default: null },
    now: { type: String, default: null },
    href: { type: String, default: null },
    when: { type: String, default: null },
    hits: { type: String, default: null },
});
</script>

<template>
    <div class="px-3.5 py-3">
        <div class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
            <span class="font-mono text-[11px] text-zinc-600 line-through decoration-white/20">{{ address }}</span>
            <span v-if="when" class="font-mono text-[10px] text-zinc-700">{{ when }}</span>
            <span v-if="hits" class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ hits }}</span>
        </div>

        <p v-if="was" class="mt-1.5 text-[13px]/5 text-cream">{{ was }}</p>
        <p v-if="happened" class="mt-1 text-[11px]/5 text-zinc-500">{{ happened }}</p>

        <div v-if="now" class="mt-2 flex items-baseline gap-1.5">
            <svg class="size-3 shrink-0 translate-y-0.5 text-jade-500/70" viewBox="0 0 12 12" fill="none"><path d="M2 6h8M7 3l3 3-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>

            <a v-if="href" :href="href" target="_top" class="text-[12px]/5 text-jade-300 transition-colors duration-150 hover:text-jade-400">{{ now }}</a>
            <span v-else class="text-[12px]/5 text-zinc-400">{{ now }}</span>
        </div>
    </div>
</template>
