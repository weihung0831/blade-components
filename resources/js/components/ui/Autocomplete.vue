<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    options: { type: Array, default: () => [] },
    placeholder: { type: String, default: '' },
    variant: { type: String, default: 'outline' },
});

const model = defineModel({ default: '' });

const open = ref(false);

const variants = {
    outline: 'border border-white/10 bg-ink-950 hover:border-white/25 focus:border-jade-500',
    filled: 'border border-transparent bg-ink-800 hover:bg-white/5 focus:border-jade-500',
};

const inputClasses = computed(() => [
    'h-10 w-full rounded-lg px-3 text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 disabled:pointer-events-none disabled:opacity-40',
    variants[props.variant] ?? variants.outline,
]);

const filtered = computed(() => {
    const query = model.value.trim().toLowerCase();

    return props.options.filter((option) => option.toLowerCase().includes(query));
});

const select = (option) => {
    model.value = option;
    open.value = false;
};
</script>

<template>
    <div class="relative block">
        <input
            type="text"
            autocomplete="off"
            v-model="model"
            :placeholder="placeholder"
            :class="inputClasses"
            @focus="open = true"
            @input="open = true"
            @blur="open = false"
            @keydown.esc="open = false"
        >
        <div v-if="open && filtered.length" class="absolute top-full left-0 z-20 mt-2 w-full min-w-max rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
            <button
                v-for="option in filtered"
                :key="option"
                type="button"
                @mousedown.prevent="select(option)"
                class="block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream"
            >
                {{ option }}
            </button>
        </div>
    </div>
</template>
