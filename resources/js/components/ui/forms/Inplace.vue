<script setup>
import { nextTick, ref } from 'vue';

defineProps({
    mono: { type: Boolean, default: false },
});

const model = defineModel({ type: String, required: true });

const editing = ref(false);
const draft = ref('');
const field = ref(null);

const open = async () => {
    draft.value = model.value;
    editing.value = true;

    await nextTick();
    field.value?.focus();
    field.value?.select();
};

const close = (commit) => {
    if (commit && draft.value.trim() !== '') {
        model.value = draft.value.trim();
    }

    editing.value = false;
};
</script>

<template>
    <div class="inline-flex">
        <button
            v-if="!editing"
            type="button"
            class="group flex items-center gap-2 text-[13px] outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
            :class="mono ? 'font-mono' : ''"
            @click="open"
        >
            <span class="border-b border-dashed border-white/25 pb-0.5 text-zinc-300 transition-colors duration-150 group-hover:border-jade-400/60 group-hover:text-cream">{{ model }}</span>
            <svg class="size-3.5 text-zinc-600 transition-colors duration-150 group-hover:text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
        </button>
        <input
            v-else
            ref="field"
            v-model="draft"
            type="text"
            class="h-8 w-48 rounded-lg border border-white/10 bg-ink-950 px-2.5 text-[13px] text-zinc-300 outline-none focus:border-jade-500"
            :class="mono ? 'font-mono' : ''"
            @keydown.enter.prevent="close(true)"
            @keydown.escape.prevent="close(false)"
            @blur="close(true)"
        />
    </div>
</template>
