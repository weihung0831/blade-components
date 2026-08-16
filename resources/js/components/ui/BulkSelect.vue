<script setup>
import { computed } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    label: { type: String, default: 'Name' },
    actions: { type: Array, default: () => [] },
});

const model = defineModel({ type: Array, default: () => [] });

const normalized = computed(() => props.items.map((item) => (typeof item === 'string' ? { label: item } : item)));

const allChecked = computed(() => normalized.value.length > 0 && model.value.length === normalized.value.length);
const someChecked = computed(() => model.value.length > 0 && !allChecked.value);

const toggleAll = () => {
    model.value = allChecked.value ? [] : normalized.value.map((item) => item.label);
};

const toggleRow = (label) => {
    model.value = model.value.includes(label) ? model.value.filter((value) => value !== label) : [...model.value, label];
};
</script>

<template>
    <div class="overflow-hidden rounded-xl border border-white/10 bg-ink-950">
        <div v-if="model.length > 0" class="flex items-center justify-between bg-jade-500/10 px-4 py-2 text-[13px]">
            <span class="text-jade-300">{{ model.length }} selected</span>
            <span class="flex gap-3 font-medium">
                <button
                    v-for="action in actions"
                    :key="action.label"
                    type="button"
                    class="cursor-pointer transition-colors duration-150"
                    :class="action.danger ? 'text-red-400 hover:text-red-300' : 'text-zinc-400 hover:text-cream'"
                >
                    {{ action.label }}
                </button>
            </span>
        </div>
        <label class="flex cursor-pointer items-center gap-3 bg-ink-800 px-4 py-2.5">
            <span class="relative grid size-4 shrink-0 place-items-center">
                <input
                    type="checkbox"
                    :checked="allChecked"
                    :indeterminate="someChecked"
                    @change="toggleAll"
                    class="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 indeterminate:border-jade-500 indeterminate:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                />
                <svg class="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <svg class="pointer-events-none absolute size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-indeterminate:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M3 6h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </span>
            <span class="font-mono text-[11px] tracking-wider text-zinc-500 uppercase">{{ label }}</span>
        </label>
        <label
            v-for="item in normalized"
            :key="item.label"
            class="flex cursor-pointer items-center gap-3 border-t border-white/5 px-4 py-2.5 text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/3 has-[:checked]:bg-jade-500/8 has-[:checked]:text-zinc-200"
        >
            <span class="relative grid size-4 shrink-0 place-items-center">
                <input
                    type="checkbox"
                    :checked="model.includes(item.label)"
                    @change="toggleRow(item.label)"
                    class="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                />
                <svg class="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <span class="flex-1 truncate">{{ item.label }}</span>
            <span v-if="item.meta" class="font-mono text-xs text-zinc-600">{{ item.meta }}</span>
        </label>
    </div>
</template>
