<script setup>
import { ref } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    selected: { type: Number, default: 0 },
    extremes: { type: Boolean, default: false },
});

const list = ref([...props.items]);
const current = ref(props.selected);

const control = 'grid size-6 cursor-pointer place-items-center rounded-md border border-white/10 text-zinc-400 transition-colors duration-150 hover:border-white/25 hover:text-cream';

const moveTo = (target) => {
    const index = Math.max(0, Math.min(list.value.length - 1, target));
    const [item] = list.value.splice(current.value, 1);

    list.value.splice(index, 0, item);
    current.value = index;
};
</script>

<template>
    <div class="flex items-center gap-2 text-[13px]">
        <div class="w-40 rounded-lg border border-white/10 bg-ink-950 p-1">
            <button
                v-for="(item, index) in list"
                :key="item"
                type="button"
                @click="current = index"
                class="block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left transition-colors duration-150"
                :class="index === current ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:text-cream'"
            >
                {{ item }}
            </button>
        </div>
        <div class="flex flex-col gap-1.5">
            <button v-if="extremes" type="button" @click="moveTo(0)" :class="control">
                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M3 6 6 3l3 3M3 9.5 6 6.5l3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" @click="moveTo(current - 1)" :class="control">
                <svg class="size-3 -rotate-90" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" @click="moveTo(current + 1)" :class="control">
                <svg class="size-3 rotate-90" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button v-if="extremes" type="button" @click="moveTo(list.length - 1)" :class="control">
                <svg class="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M3 6 6 3l3 3M3 9.5 6 6.5l3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
    </div>
</template>
