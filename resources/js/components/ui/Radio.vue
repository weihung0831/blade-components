<script setup>
import { computed } from 'vue';

const props = defineProps({
    value: { type: [String, Number, Boolean], required: true },
    label: { type: String, default: null },
    description: { type: String, default: null },
    variant: { type: String, default: 'default' },
    disabled: { type: Boolean, default: false },
});

const model = defineModel({ type: [String, Number, Boolean], default: null });

const wrappers = {
    default: 'inline-flex cursor-pointer items-start gap-2.5 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40',
    card: 'flex cursor-pointer items-start gap-3 rounded-xl border border-white/10 bg-ink-950 p-4 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5 has-[:checked]:hover:border-jade-500/50 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40',
};

const wrapperClasses = computed(() => wrappers[props.variant] ?? wrappers.default);
</script>

<template>
    <label :class="wrapperClasses">
        <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
            <input
                v-model="model"
                type="radio"
                :value="value"
                :disabled="disabled"
                class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70"
            />
            <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
        </span>
        <span v-if="label || description" class="flex flex-col gap-0.5">
            <span v-if="label" class="text-[13px]/5 text-zinc-300">{{ label }}</span>
            <span v-if="description" class="text-xs/5 text-zinc-500">{{ description }}</span>
        </span>
    </label>
</template>
