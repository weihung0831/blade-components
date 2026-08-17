<script setup>
defineProps({
    stars: { type: Number, required: true },
    count: { type: Number, required: true },
    percent: { type: Number, required: true },
    active: { type: Boolean, default: false },
});

defineEmits(['select']);
</script>

<template>
    <button
        type="button"
        @click="$emit('select', stars)"
        class="group/bar flex w-full items-center gap-3 rounded-lg px-2 py-1.5 text-left transition-colors duration-150 outline-none hover:bg-white/4 focus-visible:ring-2 focus-visible:ring-jade-500/70"
    >
        <span class="w-8 shrink-0 font-mono text-[11px]" :class="active ? 'text-jade-300' : 'text-zinc-500'">{{ stars }} ★</span>

        <span class="h-1.5 flex-1 overflow-hidden rounded-full bg-ink-800">
            <span
                class="block h-full rounded-full transition-colors duration-150"
                :class="active ? 'bg-jade-500' : 'bg-zinc-600 group-hover/bar:bg-zinc-500'"
                :style="{ width: `${percent}%` }"
            ></span>
        </span>

        <span class="w-10 shrink-0 text-right font-mono text-[11px] text-zinc-600">{{ count }}</span>
    </button>
</template>
