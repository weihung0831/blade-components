<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    description: { type: String, default: null },
    align: { type: String, default: 'start' },
});

const classes = computed(() => [
    'flex flex-col gap-2.5 py-4 sm:flex-row sm:gap-6',
    props.align === 'center' ? 'sm:items-center' : 'sm:items-start',
]);
</script>

<template>
    <div :class="classes">
        <div class="sm:w-48 sm:shrink-0">
            <p class="text-[13px] text-zinc-300">{{ label }}</p>
            <p v-if="description" class="mt-1 text-[11px]/5 text-zinc-600">{{ description }}</p>
        </div>

        <div class="min-w-0 flex-1">
            <slot />
        </div>
    </div>
</template>
