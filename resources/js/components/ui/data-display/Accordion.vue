<script setup>
import { computed, reactive } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    variant: { type: String, default: 'outline' },
});

const openState = reactive(props.items.map((item) => Boolean(item.open)));

const toggle = (index) => {
    openState[index] = !openState[index];
};

const variants = {
    outline: 'divide-y divide-white/5 rounded-xl border border-white/10 bg-ink-800',
    flush: 'divide-y divide-white/5',
};

const classes = computed(() => variants[props.variant] ?? variants.outline);
</script>

<template>
    <div :class="classes">
        <div v-for="(item, index) in items" :key="index">
            <button
                type="button"
                @click="toggle(index)"
                class="flex w-full cursor-pointer items-center justify-between gap-4 px-4 py-3 text-left text-sm text-zinc-300 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
            >
                {{ item.title }}
                <svg
                    class="size-3.5 shrink-0 transition-transform duration-200 ease-snap"
                    :class="openState[index] ? 'rotate-180 text-jade-400' : 'text-zinc-500'"
                    viewBox="0 0 16 16"
                    fill="none"
                ><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div
                class="grid transition-[grid-template-rows] duration-200 ease-snap"
                :class="openState[index] ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'"
            >
                <div class="overflow-hidden">
                    <p class="px-4 pb-3.5 text-sm/6 text-zinc-500">{{ item.content }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
