<script setup>
import { ref } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    view: { type: String, default: 'list' },
});

const current = ref(props.view);

const views = [
    { value: 'list', path: 'M2.5 4h11M2.5 8h11M2.5 12h11' },
    { value: 'grid', path: null },
];
</script>

<template>
    <div class="w-full">
        <div class="mb-3 flex justify-end">
            <div class="inline-flex rounded-lg border border-white/10 bg-ink-950 p-0.5">
                <button
                    v-for="option in views"
                    :key="option.value"
                    type="button"
                    @click="current = option.value"
                    class="grid cursor-pointer place-items-center rounded-md px-2 py-1 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    :class="current === option.value ? 'bg-white/10 text-cream' : 'text-zinc-500 hover:text-zinc-300'"
                >
                    <svg v-if="option.path" class="size-3.5" viewBox="0 0 16 16" fill="none"><path :d="option.path" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    <svg v-else class="size-3.5" viewBox="0 0 16 16" fill="none"><rect x="2.5" y="2.5" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="2.5" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="2.5" y="9" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/><rect x="9" y="9" width="4.5" height="4.5" rx="1" stroke="currentColor" stroke-width="1.5"/></svg>
                </button>
            </div>
        </div>
        <div :class="current === 'grid' ? 'grid grid-cols-2 gap-2' : 'flex flex-col gap-2'">
            <div v-for="item in items" :key="item.title" class="flex items-center gap-3 rounded-lg border border-white/10 bg-ink-800 p-3">
                <span class="grid size-10 shrink-0 place-items-center rounded-md font-mono text-[11px]" :class="item.accent ? 'bg-jade-500/15 text-jade-400' : 'bg-white/5 text-zinc-400'">{{ item.badge }}</span>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-[13px] font-medium text-zinc-200">{{ item.title }}</p>
                    <p class="truncate text-xs text-zinc-500">{{ item.subtitle }}</p>
                </div>
                <span class="font-mono text-xs" :class="item.accent ? 'text-jade-400' : 'text-zinc-400'">{{ item.meta }}</span>
            </div>
        </div>
    </div>
</template>
