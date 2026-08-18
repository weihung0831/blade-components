<script setup>
defineProps({
    steps: { type: Array, default: () => [] },
    layout: { type: String, default: 'rail' },
    interactive: { type: Boolean, default: false },
});

defineEmits(['jump']);

const dot = 'size-2 shrink-0 rounded-full border border-white/15 bg-transparent transition-colors duration-150 '
    + 'group-data-[step-state=done]/step:border-jade-500 group-data-[step-state=done]/step:bg-jade-500 '
    + 'group-data-[step-state=current]/step:border-jade-500 group-data-[step-state=current]/step:bg-jade-500 group-data-[step-state=current]/step:ring-4 group-data-[step-state=current]/step:ring-jade-500/20 '
    + 'group-data-[step-state=skipped]/step:border-dashed group-data-[step-state=skipped]/step:border-amber-400/60';

const text = 'text-zinc-600 transition-colors duration-150 '
    + 'group-data-[step-state=done]/step:text-zinc-400 '
    + 'group-data-[step-state=current]/step:text-cream '
    + 'group-data-[step-state=skipped]/step:text-amber-300/70';

const line = 'bg-white/10 group-data-[step-state=done]/step:bg-jade-500/40';
</script>

<template>
    <ol v-if="layout === 'row'" class="flex items-center gap-1.5">
        <li
            v-for="(step, index) in steps"
            :key="step.key"
            class="group/step flex min-w-0 flex-1 items-center gap-1.5"
            :data-step-state="step.state || 'todo'"
        >
            <span :class="dot"></span>
            <span class="truncate text-[11px]" :class="text">{{ step.label }}</span>
            <span v-if="index < steps.length - 1" class="h-px min-w-3 flex-1" :class="line"></span>
        </li>
    </ol>

    <ol v-else class="flex flex-col">
        <li
            v-for="(step, index) in steps"
            :key="step.key"
            class="group/step flex gap-3"
            :data-step-state="step.state || 'todo'"
        >
            <span class="flex w-2 shrink-0 flex-col items-center pt-1.5">
                <span :class="dot"></span>
                <span v-if="index < steps.length - 1" class="mt-1 w-px flex-1" :class="line"></span>
            </span>

            <component
                :is="interactive ? 'button' : 'div'"
                :type="interactive ? 'button' : undefined"
                class="min-w-0 flex-1 pb-4 text-left outline-none"
                :class="interactive ? '-mx-2 rounded-lg px-2 transition-colors duration-150 hover:bg-white/4 focus-visible:ring-2 focus-visible:ring-jade-500/70' : ''"
                @click="interactive && $emit('jump', step.key)"
            >
                <span class="flex items-baseline gap-2">
                    <span class="truncate text-[13px]" :class="text">{{ step.label }}</span>

                    <span v-if="step.optional" class="shrink-0 font-mono text-[10px] text-zinc-700 group-data-[step-state=skipped]/step:text-amber-300/70">
                        <span class="hidden group-data-[step-state=skipped]/step:inline">skipped</span>
                        <span class="group-data-[step-state=skipped]/step:hidden group-data-[step-state=done]/step:hidden">optional</span>
                    </span>

                    <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ step.minutes }}</span>
                </span>

                <span v-if="step.note" class="mt-0.5 block text-[11px]/5 text-zinc-600">{{ step.note }}</span>
            </component>
        </li>
    </ol>
</template>
