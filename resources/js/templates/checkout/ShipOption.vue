<script setup>
defineProps({
    value: { type: String, required: true },
    label: { type: String, required: true },
    detail: { type: String, default: null },
    price: { type: Number, default: 0 },
    eta: { type: String, required: true },
    note: { type: String, default: null },
});

const model = defineModel({ type: String, default: 'standard' });

const money = (value) => (value === 0 ? 'free' : '$' + value.toLocaleString('en-US'));
</script>

<template>
    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-white/10 bg-ink-950 p-4 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
        <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
            <input
                v-model="model"
                type="radio"
                name="ship"
                :value="value"
                class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
            />
            <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
        </span>

        <span class="flex min-w-0 flex-1 flex-col gap-1">
            <span class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                <span class="text-[13px]/5 text-zinc-200">{{ label }}</span>
                <span class="shrink-0 font-mono text-[13px]" :class="price === 0 ? 'text-jade-400' : 'text-zinc-300'">{{ money(price) }}</span>
            </span>

            <span v-if="detail" class="text-xs/5 text-zinc-500">{{ detail }}</span>

            <span class="font-mono text-[10px] text-zinc-600">{{ eta }}</span>

            <span v-if="note" class="font-mono text-[10px] text-amber-400/80">{{ note }}</span>
        </span>
    </label>
</template>
