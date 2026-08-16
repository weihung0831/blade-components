<script setup>
import { ref } from 'vue';

defineProps({
    label: { type: String, default: null },
    placeholder: { type: String, default: 'Add a tag…' },
});

const tags = defineModel({ type: Array, default: () => [] });
const draft = ref('');
const field = ref(null);

const onKeydown = (event) => {
    if (event.key === 'Enter' || event.key === ',') {
        event.preventDefault();

        const value = draft.value.trim();

        if (value !== '' && !tags.value.includes(value)) {
            tags.value = [...tags.value, value];
        }

        draft.value = '';
    }

    if (event.key === 'Backspace' && draft.value === '') {
        tags.value = tags.value.slice(0, -1);
    }
};

const removeTag = (index) => {
    tags.value = tags.value.filter((tag, position) => position !== index);
};
</script>

<template>
    <div class="w-64">
        <label v-if="label" class="mb-1.5 block text-xs text-zinc-500">{{ label }}</label>
        <div class="flex min-h-10 w-full cursor-text flex-wrap items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1.5 transition-colors duration-150 focus-within:border-jade-500" @click="field?.focus()">
            <span v-for="(tag, index) in tags" :key="tag" class="flex items-center gap-1 rounded-md bg-jade-500/15 py-0.5 pr-1 pl-2 text-xs text-jade-300">
                {{ tag }}
                <button
                    type="button"
                    :aria-label="`Remove ${tag}`"
                    class="grid size-4 place-items-center rounded text-jade-500/70 transition-colors duration-150 outline-none hover:text-jade-300 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    @click.stop="removeTag(index)"
                >
                    <svg class="size-2.5" viewBox="0 0 16 16" fill="none"><path d="m4 4 8 8M12 4l-8 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </button>
            </span>
            <input
                ref="field"
                v-model="draft"
                type="text"
                :placeholder="placeholder"
                class="h-6 min-w-24 flex-1 bg-transparent text-xs text-zinc-300 outline-none placeholder:text-zinc-600"
                @keydown="onKeydown"
            />
        </div>
    </div>
</template>
