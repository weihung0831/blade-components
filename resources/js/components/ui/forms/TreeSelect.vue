<script setup>
import { ref } from 'vue';

const props = defineProps({
    options: { type: Object, default: () => ({}) },
    placeholder: { type: String, default: 'Select…' },
    expanded: { type: Array, default: () => [] },
    disabled: { type: Boolean, default: false },
});

const model = defineModel({ default: null });

const open = ref(false);
const expandedBranches = ref([...props.expanded]);

const toggleBranch = (branch) => {
    expandedBranches.value = expandedBranches.value.includes(branch)
        ? expandedBranches.value.filter((name) => name !== branch)
        : [...expandedBranches.value, branch];
};

const select = (branch, leaf) => {
    model.value = `${branch} / ${leaf}`;
    open.value = false;
};
</script>

<template>
    <div class="relative inline-block" :class="disabled && 'pointer-events-none opacity-40'">
        <button
            type="button"
            :disabled="disabled"
            @click="open = !open"
            class="flex h-10 w-full cursor-pointer items-center justify-between gap-6 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm transition-colors duration-150 outline-none hover:border-white/25 focus-visible:ring-2 focus-visible:ring-jade-500/70"
            :class="open && 'border-jade-500'"
        >
            <span :class="model !== null ? 'text-zinc-300' : 'text-zinc-600'">{{ model ?? placeholder }}</span>
            <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" :class="open && 'rotate-180'" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <template v-if="open">
            <div class="fixed inset-0 z-10" @click="open = false"></div>
            <div class="absolute top-full left-0 z-20 mt-2 w-full min-w-44 rounded-lg border border-white/10 bg-ink-900 py-1.5 shadow-lg shadow-black/40">
                <div v-for="(leaves, branch) in options" :key="branch">
                    <button
                        type="button"
                        @click="toggleBranch(branch)"
                        class="flex w-full cursor-pointer items-center gap-1.5 px-2.5 py-1 text-sm text-zinc-300 transition-colors duration-150 hover:text-cream"
                    >
                        <svg class="size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" :class="expandedBranches.includes(branch) && 'rotate-90'" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ branch }}
                    </button>
                    <template v-if="expandedBranches.includes(branch)">
                        <button
                            v-for="leaf in leaves"
                            :key="leaf"
                            type="button"
                            @click="select(branch, leaf)"
                            class="flex w-full cursor-pointer items-center py-1 pr-2.5 pl-7 text-sm transition-colors duration-150"
                            :class="model === `${branch} / ${leaf}` ? 'text-jade-300' : 'text-zinc-400 hover:text-cream'"
                        >
                            {{ leaf }}
                        </button>
                    </template>
                </div>
            </div>
        </template>
    </div>
</template>
