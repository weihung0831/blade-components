<script setup>
import { ref } from 'vue';

const props = defineProps({
    options: { type: Object, default: () => ({}) },
    placeholder: { type: String, default: 'Select…' },
    disabled: { type: Boolean, default: false },
});

const model = defineModel({ default: null });

const open = ref(false);
const openBranch = ref(null);

const close = () => {
    open.value = false;
    openBranch.value = null;
};

const select = (item) => {
    model.value = item;
    close();
};

const panelClasses = 'rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40';
</script>

<template>
    <div class="relative inline-block" :class="disabled && 'pointer-events-none opacity-40'">
        <button
            type="button"
            :disabled="disabled"
            @click="open ? close() : (open = true)"
            class="flex h-10 w-full cursor-pointer items-center justify-between gap-6 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm transition-colors duration-150 outline-none hover:border-white/25 focus-visible:ring-2 focus-visible:ring-jade-500/70"
            :class="open && 'border-jade-500'"
        >
            <span :class="model !== null ? 'text-zinc-300' : 'text-zinc-600'">{{ model ?? placeholder }}</span>
            <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" :class="open && 'rotate-180'" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <template v-if="open">
            <div class="fixed inset-0 z-10" @click="close"></div>
            <div class="absolute top-full left-0 z-20 mt-2 min-w-44" :class="panelClasses">
                <div v-for="(items, group) in options" :key="group" class="relative">
                    <button
                        type="button"
                        @click="openBranch = openBranch === group ? null : group"
                        class="flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream"
                        :class="openBranch === group && 'bg-white/5 text-cream'"
                    >
                        {{ group }}
                        <svg class="size-3 shrink-0 text-zinc-500" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <div v-if="openBranch === group" class="absolute top-0 left-full z-30 ml-1 min-w-36" :class="panelClasses">
                        <button
                            v-for="item in items"
                            :key="item"
                            type="button"
                            @click="select(item)"
                            class="flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm transition-colors duration-150"
                            :class="model === item ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'"
                        >
                            {{ item }}
                            <svg v-if="model === item" class="size-3 shrink-0" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>
