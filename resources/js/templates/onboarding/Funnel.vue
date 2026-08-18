<script setup>
import { computed } from 'vue';

const props = defineProps({
    step: { type: String, required: true },
    reached: { type: Number, required: true },
    of: { type: Number, required: true },
    minutes: { type: Number, default: null },
    claimed: { type: Number, default: null },
    lost: { type: Number, default: 0 },
    note: { type: String, default: null },
    worst: { type: Boolean, default: false },
});

const ratio = computed(() => (props.of > 0 ? Math.round((props.reached / props.of) * 1000) / 10 : 0));
const over = computed(() => props.claimed !== null && props.minutes !== null && props.minutes > props.claimed);
const count = (value) => value.toLocaleString('en-US');
</script>

<template>
    <div class="px-3.5 py-3">
        <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1">
            <p class="min-w-0 flex-1 truncate text-[13px]" :class="worst ? 'text-amber-300' : 'text-cream'">{{ step }}</p>
            <p class="shrink-0 font-mono text-[11px] text-zinc-400">{{ count(reached) }}</p>
            <p class="w-12 shrink-0 text-right font-mono text-[11px] text-zinc-600">{{ ratio }}%</p>
        </div>

        <div class="mt-2 flex items-center gap-2">
            <span class="h-1.5 min-w-0 flex-1 overflow-hidden rounded-full bg-white/6">
                <span
                    class="block h-full rounded-full transition-[width] duration-300"
                    :class="worst ? 'bg-amber-400/70' : 'bg-jade-500'"
                    :style="{ width: `${ratio}%` }"
                ></span>
            </span>

            <span v-if="lost > 0" class="shrink-0 font-mono text-[10px] text-zinc-700">{{ count(lost) }} stopped here</span>
        </div>

        <div class="mt-1.5 flex flex-wrap items-baseline gap-x-4 gap-y-1">
            <p v-if="minutes !== null" class="shrink-0 font-mono text-[10px]" :class="over ? 'text-amber-300/80' : 'text-zinc-600'">
                {{ minutes }} min in practice<template v-if="claimed !== null">, {{ claimed }} on the label</template>
            </p>

            <p v-if="note" class="min-w-0 flex-1 text-[11px]/5 text-zinc-600">{{ note }}</p>
        </div>
    </div>
</template>
