<script setup>
import { computed } from 'vue';

const props = defineProps({
    role: { type: String, default: 'to' },
    name: { type: String, required: true },
    taxId: { type: String, default: null },
    lines: { type: Array, default: () => [] },
    contact: { type: String, default: null },
    note: { type: String, default: null },
});

const labels = {
    to: 'billed to',
    ship: 'shipped to',
    from: 'from',
};

const label = computed(() => labels[props.role] ?? props.role);
</script>

<template>
    <div class="min-w-0">
        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ label }}</p>

        <p class="mt-2 text-[14px] font-medium tracking-tight text-cream">{{ name }}</p>

        <p v-if="taxId" class="mt-1 font-mono text-[10px] text-jade-300">統一編號 {{ taxId }}</p>

        <p v-if="lines.length" class="mt-2 text-[11px]/5 text-zinc-500">
            <template v-for="(line, index) in lines" :key="line">
                {{ line }}<br v-if="index < lines.length - 1">
            </template>
        </p>

        <p v-if="contact" class="mt-2 font-mono text-[10px] text-zinc-600">{{ contact }}</p>

        <p v-if="note" class="mt-2 border-l border-white/10 pl-2.5 text-[11px]/5 text-zinc-600">{{ note }}</p>
    </div>
</template>
