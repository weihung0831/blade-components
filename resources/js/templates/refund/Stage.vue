<script setup>
defineProps({
    reference: { type: String, required: true },
    order: { type: String, required: true },
    amount: { type: String, required: true },
    lands: { type: String, required: true },
    steps: { type: Array, default: () => [] },
    stage: { type: Number, default: 0 },
    note: { type: String, default: null },
});
</script>

<template>
    <article class="overflow-hidden rounded-xl border border-jade-500/25 bg-jade-500/5">
        <div class="flex flex-wrap items-baseline gap-x-5 gap-y-2 border-b border-jade-500/15 px-4 py-3">
            <div class="min-w-0 flex-1">
                <p class="text-[13px] text-cream">{{ amount }} on its way back</p>
                <p class="mt-0.5 font-mono text-[10px] text-zinc-500">{{ reference }} · against order {{ order }}</p>
            </div>

            <div class="text-right">
                <p class="font-mono text-[11px] text-jade-300">{{ lands }}</p>
                <p class="mt-0.5 font-mono text-[10px] text-zinc-600">to the card that paid</p>
            </div>
        </div>

        <ol class="flex flex-col gap-0 px-4 py-3.5 sm:flex-row sm:gap-1">
            <li v-for="(step, index) in steps" :key="step.label" class="flex flex-1 gap-2.5 sm:block">
                <span class="flex shrink-0 flex-col items-center sm:w-full sm:flex-row sm:gap-1.5">
                    <span class="block size-2 shrink-0 rounded-full" :class="index <= stage ? 'bg-jade-500' : 'border border-white/15'"></span>
                    <span
                        v-if="index < steps.length - 1"
                        class="block w-px flex-1 sm:h-px sm:w-auto sm:flex-1"
                        :class="index < stage ? 'bg-jade-500/40' : 'bg-white/10'"
                    ></span>
                </span>

                <span class="block pb-3 sm:pt-2 sm:pb-0">
                    <span class="block text-[12px]" :class="index === stage ? 'text-cream' : index < stage ? 'text-zinc-400' : 'text-zinc-600'">{{ step.label }}</span>
                    <span class="mt-0.5 block font-mono text-[10px] text-zinc-700">{{ step.at ?? 'not yet' }}</span>
                </span>
            </li>
        </ol>

        <p v-if="note" class="border-t border-jade-500/15 px-4 py-2.5 text-[11px]/5 text-zinc-500">{{ note }}</p>
    </article>
</template>
