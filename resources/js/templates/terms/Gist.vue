<script setup>
import { computed } from 'vue';

const props = defineProps({
    number: { type: String, required: true },
    title: { type: String, required: true },
    says: { type: String, required: true },
    means: { type: String, default: null },
    favours: { type: String, default: 'both' },
    bites: { type: Boolean, default: false },
    href: { type: String, default: null },
});

const labels = { us: 'ours', you: 'yours', both: 'even' };

const label = computed(() => labels[props.favours] ?? 'even');

const target = computed(() => props.href ?? `/templates/terms/screens/document#clause-${props.number}`);

const left = computed(() => ({
    us: 'bg-amber-400/70',
    both: 'bg-white/15',
    you: 'bg-white/8',
}[props.favours]));

const right = computed(() => ({
    you: 'bg-jade-500',
    both: 'bg-white/15',
    us: 'bg-white/8',
}[props.favours]));

const tone = computed(() => ({
    us: 'text-amber-300/80',
    you: 'text-jade-400/90',
    both: 'text-zinc-700',
}[props.favours]));
</script>

<template>
    <a
        :href="target"
        target="_top"
        class="group/gist flex gap-3 px-3 py-3 outline-none transition-colors duration-150 hover:bg-white/3 focus-visible:ring-2 focus-visible:ring-jade-500/70 sm:gap-5"
    >
        <span class="w-6 shrink-0 font-mono text-[11px] text-zinc-700">{{ number }}</span>

        <span class="min-w-0 flex-1">
            <span class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                <span class="text-[13px] text-zinc-300 group-hover/gist:text-cream">{{ title }}</span>
                <span v-if="bites" class="font-mono text-[10px] text-amber-300/80">catches people out</span>
            </span>

            <span class="mt-1 block text-[12px]/5 text-zinc-500">{{ says }}</span>
            <span v-if="means" class="mt-1.5 block text-[11px]/5 text-zinc-600">{{ means }}</span>
        </span>

        <span class="flex w-20 shrink-0 flex-col items-end gap-1.5 pt-1">
            <span class="flex w-14 gap-px">
                <span class="h-1 flex-1 rounded-l-full" :class="left"></span>
                <span class="h-1 flex-1 rounded-r-full" :class="right"></span>
            </span>
            <span class="font-mono text-[10px]" :class="tone">{{ label }}</span>
        </span>
    </a>
</template>
