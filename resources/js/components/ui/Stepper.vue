<script setup>
const props = defineProps({
    steps: { type: Array, default: () => [] },
    current: { type: Number, default: 1 },
    orientation: { type: String, default: 'horizontal' },
});

const circleClasses = (number) => {
    if (number < props.current) {
        return 'bg-jade-500';
    }

    return number === props.current
        ? 'border-2 border-jade-500 font-mono text-xs text-jade-400'
        : 'border-2 border-white/15 font-mono text-xs text-zinc-500';
};

const labelClasses = (number) =>
    number < props.current
        ? 'text-zinc-400'
        : number === props.current
          ? 'font-medium text-cream'
          : 'text-zinc-500';
</script>

<template>
    <div v-if="orientation === 'vertical'" class="flex flex-col">
        <div v-for="(step, index) in steps" :key="index" class="flex gap-3">
            <div class="flex flex-col items-center">
                <span class="grid size-7 shrink-0 place-items-center rounded-full" :class="circleClasses(index + 1)">
                    <svg v-if="index + 1 < current" class="size-3.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <template v-else>{{ index + 1 }}</template>
                </span>
                <span
                    v-if="index < steps.length - 1"
                    class="my-1 min-h-4 w-px flex-1"
                    :class="index + 1 < current ? 'bg-jade-500' : 'bg-white/15'"
                ></span>
            </div>
            <div class="pt-1" :class="index < steps.length - 1 ? 'pb-6' : ''">
                <p class="text-sm" :class="labelClasses(index + 1)">{{ step.label }}</p>
                <p v-if="step.description" class="mt-0.5 text-xs/5 text-zinc-500">{{ step.description }}</p>
            </div>
        </div>
    </div>
    <div v-else class="flex items-start">
        <template v-for="(step, index) in steps" :key="index">
            <div class="flex flex-col items-center gap-1.5 text-center">
                <span class="grid size-7 shrink-0 place-items-center rounded-full" :class="circleClasses(index + 1)">
                    <svg v-if="index + 1 < current" class="size-3.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <template v-else>{{ index + 1 }}</template>
                </span>
                <span class="text-xs" :class="labelClasses(index + 1)">{{ step.label }}</span>
            </div>
            <span
                v-if="index < steps.length - 1"
                class="mx-2 mt-3.5 h-px w-10"
                :class="index + 1 < current ? 'bg-jade-500' : 'bg-white/15'"
            ></span>
        </template>
    </div>
</template>
