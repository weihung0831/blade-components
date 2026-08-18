<script setup>
import { computed } from 'vue';

const props = defineProps({
    mark: { type: String, default: null },
    title: { type: String, required: true },
    body: { type: String, default: null },
    meta: { type: String, default: null },
    tone: { type: String, default: 'quiet' },
});

const tones = {
    quiet: { card: 'border-white/8 bg-ink-950', mark: 'text-zinc-600 border-white/10' },
    primary: { card: 'border-jade-500/30 bg-jade-500/5', mark: 'text-jade-300 border-jade-500/40' },
    caveat: { card: 'border-amber-400/25 bg-amber-400/4', mark: 'text-amber-300 border-amber-400/40' },
};

const skin = computed(() => tones[props.tone] ?? tones.quiet);
</script>

<template>
    <div class="flex flex-col rounded-2xl border p-4 transition-colors duration-150" :class="skin.card">
        <span v-if="mark" class="inline-flex w-fit items-center rounded-lg border px-1.5 py-0.5 font-mono text-[10px] tracking-wider uppercase" :class="skin.mark">{{ mark }}</span>

        <h3 class="mt-3 text-[14px]/6 font-medium tracking-tight text-cream">{{ title }}</h3>

        <p v-if="body" class="mt-1.5 text-[12px]/5 text-zinc-500">{{ body }}</p>

        <slot />

        <p v-if="meta" class="mt-3 border-t border-white/5 pt-2.5 font-mono text-[10px] text-zinc-700">{{ meta }}</p>
    </div>
</template>
