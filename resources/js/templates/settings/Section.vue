<script setup>
import { computed } from 'vue';

const props = defineProps({
    heading: { type: String, required: true },
    description: { type: String, default: null },
    flush: { type: Boolean, default: false },
    tone: { type: String, default: 'default' },
});

const tones = {
    default: 'border-white/10 bg-ink-800',
    danger: 'border-red-400/25 bg-ink-800',
};

const classes = computed(() => ['overflow-hidden rounded-xl border', tones[props.tone] ?? tones.default]);
</script>

<template>
    <section :class="classes">
        <div class="flex flex-wrap items-start justify-between gap-3 border-b border-white/5 px-5 py-3.5">
            <div>
                <h2 class="text-sm font-medium" :class="tone === 'danger' ? 'text-red-400' : 'text-cream'">{{ heading }}</h2>
                <p v-if="description" class="mt-1 max-w-md text-xs/5 text-zinc-500">{{ description }}</p>
            </div>
            <div v-if="$slots.actions" class="flex shrink-0 items-center gap-2">
                <slot name="actions" />
            </div>
        </div>

        <slot v-if="flush" />
        <div v-else class="divide-y divide-white/5 px-5">
            <slot />
        </div>

        <div v-if="$slots.footer" class="flex flex-wrap items-center justify-between gap-3 border-t border-white/5 bg-ink-950/40 px-5 py-3">
            <slot name="footer" />
        </div>
    </section>
</template>
