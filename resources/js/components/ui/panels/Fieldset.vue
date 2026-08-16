<script setup>
import { ref } from 'vue';

const props = defineProps({
    legend: { type: String, required: true },
    toggleable: { type: Boolean, default: false },
    open: { type: Boolean, default: true },
});

const expanded = ref(props.open);
</script>

<template>
    <fieldset v-if="toggleable" class="rounded-xl border border-white/10 px-4 pt-1.5 pb-1.5">
        <legend class="px-2">
            <button
                type="button"
                @click="expanded = !expanded"
                class="flex cursor-pointer items-center gap-2 rounded text-sm font-medium text-zinc-200 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
            >
                {{ legend }}
                <svg
                    class="size-3.5 transition-transform duration-200 ease-snap"
                    :class="expanded ? 'rotate-180 text-jade-400' : 'text-zinc-500'"
                    viewBox="0 0 16 16"
                    fill="none"
                ><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </legend>
        <div
            class="grid transition-[grid-template-rows] duration-200 ease-snap"
            :class="expanded ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
        >
            <div class="overflow-hidden">
                <div class="pt-1 pb-2.5"><slot /></div>
            </div>
        </div>
    </fieldset>
    <fieldset v-else class="rounded-xl border border-white/10 px-4 pt-1.5 pb-4">
        <legend class="px-2 text-sm font-medium text-zinc-200">{{ legend }}</legend>
        <div class="pt-1"><slot /></div>
    </fieldset>
</template>
