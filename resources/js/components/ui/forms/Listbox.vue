<script setup>
const props = defineProps({
    options: { type: Array, default: () => [] },
    multiple: { type: Boolean, default: false },
});

const model = defineModel({ default: null });

const isSelected = (option) =>
    props.multiple ? (model.value ?? []).includes(option) : model.value === option;

const toggle = (option) => {
    if (!props.multiple) {
        model.value = option;

        return;
    }

    const current = model.value ?? [];

    model.value = current.includes(option)
        ? current.filter((value) => value !== option)
        : [...current, option];
};
</script>

<template>
    <div role="listbox" :aria-multiselectable="multiple || undefined" class="w-full rounded-lg border border-white/10 bg-ink-950 p-1">
        <button
            v-for="option in options"
            :key="option"
            type="button"
            role="option"
            :aria-selected="isSelected(option)"
            @click="toggle(option)"
            class="flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm transition-colors duration-150"
            :class="isSelected(option) ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'"
        >
            {{ option }}
            <svg class="size-3.5 shrink-0 transition-opacity duration-150" :class="isSelected(option) ? 'opacity-100' : 'opacity-0'" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
    </div>
</template>
