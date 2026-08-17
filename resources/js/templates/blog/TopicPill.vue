<script setup>
defineProps({
    value: { type: String, required: true },
    label: { type: String, required: true },
    count: { type: Number, default: null },
    name: { type: String, default: 'topic' },
});

const model = defineModel({ type: String, default: 'all' });
</script>

<template>
    <label class="inline-flex cursor-pointer items-center gap-2 rounded-full border border-white/10 bg-ink-900 px-3 py-1.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/10">
        <input v-model="model" type="radio" :name="name" :value="value" class="peer sr-only" />

        <span class="text-[13px] text-zinc-400 peer-checked:text-jade-300">{{ label }}</span>

        <span v-if="count !== null" class="font-mono text-[10px] text-zinc-600 peer-checked:text-jade-400/70">{{ count }}</span>
    </label>
</template>
