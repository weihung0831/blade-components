<script setup>
import { useId } from 'vue';

const props = defineProps({
    max: { type: Number, default: 5 },
    readonly: { type: Boolean, default: false },
});

const model = defineModel({ type: Number, default: 0 });

const name = useId();

const stars = (count) => Array.from({ length: count }, (_, index) => count - index);
</script>

<template>
    <span v-if="readonly" class="inline-flex items-center gap-1.5">
        <svg
            v-for="star in max"
            :key="star"
            class="size-4.5"
            :class="star <= model ? 'text-jade-400' : 'text-white/15'"
            viewBox="0 0 16 16"
            fill="currentColor"
        ><path d="M8 1.5l1.9 3.9 4.3.6-3.1 3 .7 4.3L8 11.3l-3.8 2 .7-4.3-3.1-3 4.3-.6L8 1.5Z"/></svg>
        <span class="ml-1 font-mono text-xs text-zinc-500">{{ model.toFixed(1) }}</span>
    </span>
    <fieldset v-else class="inline-flex flex-row-reverse items-center">
        <template v-for="star in stars(max)" :key="star">
            <input v-model.number="model" type="radio" :name="name" :value="star" :id="`${name}-${star}`" class="peer sr-only" />
            <label
                :for="`${name}-${star}`"
                :aria-label="`${star} of ${max}`"
                class="cursor-pointer px-0.5 text-white/15 transition-colors duration-150 peer-checked:text-jade-400 peer-focus-visible:text-jade-300 hover:text-jade-300 [&:hover~label]:text-jade-300"
            >
                <svg class="size-4.5" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1.5l1.9 3.9 4.3.6-3.1 3 .7 4.3L8 11.3l-3.8 2 .7-4.3-3.1-3 4.3-.6L8 1.5Z"/></svg>
            </label>
        </template>
    </fieldset>
</template>
