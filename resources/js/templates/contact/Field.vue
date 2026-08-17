<script setup>
import { computed, useSlots } from 'vue';

const props = defineProps({
    label: { type: String, required: true },
    modelValue: { type: String, default: '' },
    type: { type: String, default: 'text' },
    hint: { type: String, default: null },
    note: { type: String, default: null },
    placeholder: { type: String, default: null },
    mono: { type: Boolean, default: false },
    rows: { type: Number, default: 4 },
    optional: { type: Boolean, default: false },
});

defineEmits(['update:modelValue']);

const slots = useSlots();

const control = computed(() => [
    'w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px] text-cream placeholder:text-zinc-600 transition-colors duration-150 focus:border-jade-500/60 focus:outline-none',
    props.mono ? 'font-mono' : '',
].join(' '));
</script>

<template>
    <label class="block">
        <span class="flex items-baseline gap-2">
            <span class="text-[12px] text-zinc-400">{{ label }}</span>
            <span v-if="optional" class="font-mono text-[10px] text-zinc-700">optional</span>
            <span v-if="note" class="ml-auto font-mono text-[10px] text-zinc-700">{{ note }}</span>
        </span>

        <span class="mt-1.5 block">
            <slot v-if="slots.default" />

            <textarea
                v-else-if="type === 'textarea'"
                :value="modelValue"
                :rows="rows"
                :placeholder="placeholder"
                spellcheck="false"
                :class="[control, 'resize-none leading-6']"
                @input="$emit('update:modelValue', $event.target.value)"
            ></textarea>

            <input
                v-else
                :type="type"
                :value="modelValue"
                :placeholder="placeholder"
                :spellcheck="mono ? 'false' : undefined"
                :class="control"
                @input="$emit('update:modelValue', $event.target.value)"
            >
        </span>

        <span v-if="hint" class="mt-1.5 block text-[11px]/5 text-zinc-600">{{ hint }}</span>
    </label>
</template>
