<script setup>
defineProps({
    label: { type: String, default: null },
    swatches: { type: Array, default: () => [] },
});

const model = defineModel({ type: String, default: '#4ea396' });
</script>

<template>
    <div class="w-56">
        <label v-if="label" class="mb-1.5 block text-xs text-zinc-500">{{ label }}</label>
        <div v-if="swatches.length > 0" class="mb-2 flex gap-1.5">
            <button
                v-for="swatch in swatches"
                :key="swatch"
                type="button"
                :aria-label="`Use ${swatch}`"
                :style="{ background: swatch }"
                class="size-6 rounded-md border border-white/10 transition-transform duration-150 ease-snap outline-none hover:scale-110 focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-95"
                @click="model = swatch"
            ></button>
        </div>
        <label class="flex h-10 cursor-pointer items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-2 transition-colors duration-150 focus-within:border-jade-500">
            <input
                v-model="model"
                type="color"
                class="size-6 shrink-0 cursor-pointer appearance-none rounded-md border-none bg-transparent p-0 outline-none [&::-moz-color-swatch]:rounded-md [&::-moz-color-swatch]:border-none [&::-webkit-color-swatch]:rounded-md [&::-webkit-color-swatch]:border-none [&::-webkit-color-swatch-wrapper]:p-0"
            />
            <span class="font-mono text-xs tracking-wide text-zinc-300 uppercase">{{ model }}</span>
        </label>
    </div>
</template>
