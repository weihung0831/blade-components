<script setup>
defineProps({
    label: { type: String, required: true },
    value: { type: String, required: true },
    note: { type: String, default: null },
});
</script>

<template>
    <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1 px-5 py-3">
        <span class="w-40 shrink-0 text-[13px] text-zinc-500">{{ label }}</span>
        <span class="font-mono text-[13px] text-zinc-200">{{ value }}</span>
        <span v-if="note" class="ml-auto hidden font-mono text-[10px] text-zinc-600 sm:block">{{ note }}</span>
    </div>
</template>
