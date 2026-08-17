<script setup>
import { computed } from 'vue';

const props = defineProps({
    minutes: { type: Number, default: 0 },
    target: { type: Number, default: 240 },
    bar: { type: Boolean, default: false },
    label: { type: String, default: null },
    compact: { type: Boolean, default: false },
});

const late = computed(() => props.minutes < 0);

const clock = computed(() => {
    const span = Math.abs(props.minutes);
    const hours = Math.floor(span / 60);
    const rest = span % 60;

    return hours > 0 ? `${hours}h${rest > 0 ? ` ${rest}m` : ''}` : `${rest}m`;
});

const words = computed(() => props.label ?? (late.value ? 'overdue' : 'to first reply'));

const text = computed(() => {
    if (props.compact) {
        return clock.value;
    }

    return late.value ? `${words.value} ${clock.value}` : `${clock.value} ${words.value}`;
});

const tone = computed(() => {
    if (late.value) return 'text-red-300';

    return props.minutes <= 60 ? 'text-amber-300' : 'text-zinc-500';
});

const fillTone = computed(() => {
    if (late.value) return 'bg-red-400';

    return props.minutes <= 60 ? 'bg-amber-400' : 'bg-jade-500/70';
});

const burned = computed(() => props.target > 0
    ? Math.min(100, Math.max(0, Math.round(((props.target - props.minutes) / props.target) * 100)))
    : 100);
</script>

<template>
    <span
        class="inline-flex items-center gap-1.5 font-mono text-[10px] whitespace-nowrap"
        :class="tone"
        :title="late ? `First reply is ${clock} past the promise` : `${clock} left on the reply promise`"
    >
        <svg v-if="late" class="size-3 shrink-0" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <circle cx="8" cy="8" r="5.5" stroke="currentColor" stroke-width="1.3"/><path d="M8 5.2v3.4M8 10.6v.6" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        </svg>
        <svg v-else class="size-3 shrink-0" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <circle cx="8" cy="8" r="5.5" stroke="currentColor" stroke-width="1.3"/><path d="M8 5v3.2l2.2 1.3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <span>{{ text }}</span>

        <span v-if="bar" class="ml-0.5 block h-0.5 w-12 overflow-hidden rounded-full bg-white/10">
            <span class="block h-full rounded-full" :class="fillTone" :style="{ width: `${burned}%` }"></span>
        </span>
    </span>
</template>
