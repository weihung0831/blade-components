<script setup>
import { computed } from 'vue';

const props = defineProps({
    who: { type: String, required: true },
    body: { type: String, default: null },
    instead: { type: String, default: null },
    insteadPrice: { type: String, default: null },
    tone: { type: String, default: 'hard' },
    href: { type: String, default: null },
});

const marks = {
    hard: { dot: 'bg-red-400', label: 'buy something else' },
    soft: { dot: 'bg-amber-400', label: 'probably not' },
    fine: { dot: 'bg-jade-500', label: 'this one is fine' },
};

const mark = computed(() => marks[props.tone] ?? marks.hard);
</script>

<template>
    <div class="flex flex-col gap-3 px-4 py-3.5 sm:flex-row sm:items-start sm:gap-5">
        <div class="min-w-0 flex-1">
            <p class="flex items-center gap-2">
                <span class="size-1.5 shrink-0 rounded-full" :class="mark.dot"></span>
                <span class="text-[13px]/5 text-cream">{{ who }}</span>
            </p>

            <p v-if="body" class="mt-1.5 text-[12px]/5 text-zinc-500">{{ body }}</p>
        </div>

        <div class="shrink-0 sm:w-56">
            <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ mark.label }}</p>

            <a v-if="instead && href" :href="href" target="_top" class="mt-1 block text-[12px] text-jade-300 transition-colors duration-150 hover:text-jade-400">{{ instead }}</a>
            <p v-else-if="instead" class="mt-1 text-[12px] text-zinc-400">{{ instead }}</p>

            <p v-if="insteadPrice" class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ insteadPrice }}</p>
        </div>
    </div>
</template>
