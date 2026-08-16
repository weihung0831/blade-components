<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    size: { type: String, default: 'md' },
    disabled: { type: Boolean, default: false },
});

const model = defineModel({ type: Boolean, default: false });

const tracks = {
    sm: 'h-5 w-9 after:size-3 peer-checked:after:translate-x-4',
    md: 'h-6 w-11 after:size-4 peer-checked:after:translate-x-5',
};

const trackClasses = computed(() => tracks[props.size] ?? tracks.md);
</script>

<template>
    <label class="inline-flex cursor-pointer items-center gap-3 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40">
        <span v-if="label" class="text-[13px] text-zinc-400">{{ label }}</span>
        <input v-model="model" type="checkbox" role="switch" :disabled="disabled" class="peer sr-only" />
        <span
            class="relative rounded-full border border-white/10 bg-ink-800 transition-colors duration-200 ease-snap peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70 after:absolute after:top-1 after:left-1 after:rounded-full after:bg-zinc-400 after:transition-[translate,background-color] after:duration-200 after:ease-snap peer-checked:after:bg-ink-950"
            :class="trackClasses"
        ></span>
    </label>
</template>
