<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    label: { type: String, default: '' },
    avatar: { type: String, default: null },
    removable: { type: Boolean, default: false },
});

const emit = defineEmits(['remove']);

const removed = ref(false);

const remove = () => {
    removed.value = true;
    emit('remove');
};

const chipClasses = computed(() => [
    'inline-flex items-center gap-1.5 rounded-full border border-white/10 bg-ink-800 py-1 text-xs',
    props.avatar !== null ? 'pl-1' : 'pl-2.5',
    props.removable ? 'pr-1.5' : 'pr-2.5',
]);
</script>

<template>
    <span v-if="!removed" :class="chipClasses">
        <span v-if="avatar !== null" class="grid size-5 shrink-0 place-items-center rounded-full bg-jade-500 text-[9px] font-semibold text-ink-950">{{ avatar }}</span>
        <span class="text-zinc-300">{{ label }}</span>
        <button
            v-if="removable"
            type="button"
            @click="remove"
            class="grid size-4 cursor-pointer place-items-center rounded-full text-zinc-600 transition-colors duration-150 hover:bg-white/10 hover:text-cream"
        >
            <svg class="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
    </span>
</template>
