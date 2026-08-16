<script setup>
import { useSlots } from 'vue';

const slots = useSlots();
</script>

<template>
    <div class="flex items-center justify-between gap-2 rounded-xl border border-white/10 bg-ink-800 p-1.5" role="toolbar">
        <div v-if="slots.start" class="flex items-center gap-1"><slot name="start" /></div>
        <div v-if="slots.center" class="flex items-center gap-1"><slot name="center" /></div>
        <div v-if="slots.end" class="flex items-center gap-1.5"><slot name="end" /></div>
    </div>
</template>
