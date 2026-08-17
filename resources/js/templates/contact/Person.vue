<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: { type: String, required: true },
    initials: { type: String, default: null },
    role: { type: String, default: null },
    handles: { type: String, default: null },
    hours: { type: String, default: null },
    here: { type: Boolean, default: false },
});

const mark = computed(() => props.initials ?? props.name.slice(0, 2));
</script>

<template>
    <div class="flex gap-3">
        <span
            class="relative flex size-9 shrink-0 items-center justify-center rounded-lg border font-mono text-[11px]"
            :class="here ? 'border-jade-500/40 bg-jade-500/10 text-jade-300' : 'border-white/10 bg-ink-900 text-zinc-500'"
        >
            {{ mark }}
            <span v-if="here" class="absolute -top-0.5 -right-0.5 size-2 rounded-full border-2 border-ink-950 bg-jade-400"></span>
        </span>

        <div class="min-w-0 flex-1">
            <p class="flex items-baseline gap-2">
                <span class="text-[13px] text-zinc-300">{{ name }}</span>
                <span v-if="role" class="truncate font-mono text-[10px] text-zinc-700">{{ role }}</span>
            </p>

            <p v-if="handles" class="mt-1 text-[12px]/5 text-zinc-500">{{ handles }}</p>

            <p v-if="hours" class="mt-1 font-mono text-[10px]" :class="here ? 'text-jade-400/80' : 'text-zinc-700'">{{ hours }}</p>
        </div>
    </div>
</template>
