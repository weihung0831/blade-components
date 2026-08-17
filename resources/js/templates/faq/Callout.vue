<script setup>
import { computed } from 'vue';

const props = defineProps({
    tone: { type: String, default: 'tip' },
    label: { type: String, default: null },
});

const tones = {
    tip: { line: 'bg-jade-500/60', label: 'text-jade-300', default: 'Worth knowing' },
    warn: { line: 'bg-amber-400/60', label: 'text-amber-300', default: 'Careful here' },
    stop: { line: 'bg-red-400/60', label: 'text-red-300', default: 'Do not' },
    quiet: { line: 'bg-white/15', label: 'text-zinc-500', default: 'Aside' },
};

const style = computed(() => tones[props.tone] ?? tones.tip);
</script>

<template>
    <div class="relative py-1 pl-4">
        <span aria-hidden="true" class="absolute inset-y-0 left-0 w-0.5 rounded-full" :class="style.line"></span>

        <p class="font-mono text-[10px] tracking-wider uppercase" :class="style.label">{{ label ?? style.default }}</p>
        <div class="mt-1.5 space-y-2 text-[13px]/6 text-zinc-400">
            <slot />
        </div>
    </div>
</template>
