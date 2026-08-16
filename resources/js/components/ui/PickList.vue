<script setup>
import { ref } from 'vue';

const props = defineProps({
    available: { type: Array, default: () => [] },
    selected: { type: Array, default: () => [] },
    availableLabel: { type: String, default: null },
    selectedLabel: { type: String, default: null },
    all: { type: Boolean, default: false },
});

const source = ref([...props.available]);
const target = ref([...props.selected]);
const picked = ref([]);

const control = 'grid size-6 cursor-pointer place-items-center rounded-md border border-white/10 text-zinc-400 transition-colors duration-150 hover:border-white/25 hover:text-cream';

const key = (side, entry) => `${side}:${entry}`;

const toggle = (side, entry) => {
    picked.value = picked.value.includes(key(side, entry))
        ? picked.value.filter((name) => name !== key(side, entry))
        : [...picked.value, key(side, entry)];
};

const move = (fromSide, onlyPicked) => {
    const [from, to] = fromSide === 'source' ? [source, target] : [target, source];
    const moving = from.value.filter((entry) => !onlyPicked || picked.value.includes(key(fromSide, entry)));

    from.value = from.value.filter((entry) => !moving.includes(entry));
    to.value = [...to.value, ...moving];
    picked.value = picked.value.filter((name) => !name.startsWith(`${fromSide}:`));
};
</script>

<template>
    <div class="flex items-center gap-2 text-[13px]">
        <div class="flex flex-col gap-1.5">
            <span v-if="availableLabel" class="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{{ availableLabel }}</span>
            <div class="min-h-24 w-36 rounded-lg border border-white/10 bg-ink-950 p-1">
                <button
                    v-for="entry in source"
                    :key="entry"
                    type="button"
                    @click="toggle('source', entry)"
                    class="block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left transition-colors duration-150"
                    :class="picked.includes(key('source', entry)) ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:text-cream'"
                >
                    {{ entry }}
                </button>
            </div>
        </div>
        <div class="flex flex-col gap-1.5">
            <button type="button" @click="move('source', true)" :class="control">
                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" @click="move('target', true)" :class="control">
                <svg class="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <template v-if="all">
                <button type="button" @click="move('source', false)" :class="control">
                    <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 3 5.5 6l-3 3M6.5 3 9.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button type="button" @click="move('target', false)" :class="control">
                    <svg class="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M2.5 3 5.5 6l-3 3M6.5 3 9.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </template>
        </div>
        <div class="flex flex-col gap-1.5">
            <span v-if="selectedLabel" class="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{{ selectedLabel }}</span>
            <div class="min-h-24 w-36 rounded-lg border border-white/10 bg-ink-950 p-1">
                <button
                    v-for="entry in target"
                    :key="entry"
                    type="button"
                    @click="toggle('target', entry)"
                    class="block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left transition-colors duration-150"
                    :class="picked.includes(key('target', entry)) ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:text-cream'"
                >
                    {{ entry }}
                </button>
            </div>
        </div>
    </div>
</template>
