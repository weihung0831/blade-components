<script setup>
defineProps({
    label: { type: String, default: null },
    vertical: { type: Boolean, default: false },
});
</script>

<template>
    <span v-if="vertical" class="inline-block w-px self-stretch bg-white/10"></span>
    <div v-else-if="label !== null" class="flex w-full items-center gap-3">
        <span class="h-px flex-1 bg-white/10"></span>
        <span class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ label }}</span>
        <span class="h-px flex-1 bg-white/10"></span>
    </div>
    <div v-else class="h-px w-full bg-white/10"></div>
</template>
