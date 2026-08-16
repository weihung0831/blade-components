<script setup>
import { ref, useSlots } from 'vue';

const props = defineProps({
    heading: { type: String, required: true },
    toggleable: { type: Boolean, default: false },
    open: { type: Boolean, default: true },
});

const slots = useSlots();
const expanded = ref(props.open);
</script>

<template>
    <div class="overflow-hidden rounded-xl border border-white/10 bg-ink-800">
        <template v-if="toggleable">
            <button
                type="button"
                @click="expanded = !expanded"
                class="flex w-full cursor-pointer items-center justify-between gap-4 px-4 py-3 text-left text-sm font-medium text-zinc-200 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
            >
                {{ heading }}
                <svg
                    class="size-3.5 shrink-0 transition-transform duration-200 ease-snap"
                    :class="expanded ? 'rotate-180 text-jade-400' : 'text-zinc-500'"
                    viewBox="0 0 16 16"
                    fill="none"
                ><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div
                class="grid transition-[grid-template-rows] duration-200 ease-snap"
                :class="expanded ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
            >
                <div class="overflow-hidden">
                    <div class="border-t border-white/5 p-4 text-sm/6 text-zinc-500"><slot /></div>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="flex items-center justify-between gap-4 border-b border-white/5 px-4 py-3">
                <p class="text-sm font-medium text-zinc-200">{{ heading }}</p>
                <div v-if="slots.actions" class="flex items-center gap-2"><slot name="actions" /></div>
            </div>
            <div class="p-4 text-sm/6 text-zinc-500"><slot /></div>
            <div v-if="slots.footer" class="border-t border-white/5 px-4 py-3"><slot name="footer" /></div>
        </template>
    </div>
</template>
