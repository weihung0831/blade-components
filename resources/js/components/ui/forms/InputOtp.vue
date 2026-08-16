<script setup>
import { ref } from 'vue';

const props = defineProps({
    length: { type: Number, default: 6 },
    label: { type: String, default: null },
    masked: { type: Boolean, default: false },
});

const model = defineModel({ type: String, default: '' });

const cells = ref(Array.from({ length: props.length }, (empty, index) => model.value[index] ?? ''));
const inputs = ref([]);

const sync = () => {
    model.value = cells.value.join('');
};

const onInput = (index, event) => {
    const digits = event.target.value.replace(/\D/g, '').split('');

    if (digits.length === 0) {
        cells.value[index] = '';
        event.target.value = '';
        sync();
        return;
    }

    digits.slice(0, props.length - index).forEach((digit, offset) => {
        cells.value[index + offset] = digit;
    });

    sync();

    const next = inputs.value[Math.min(index + digits.length, props.length - 1)];

    next?.focus();
    next?.select();
};

const onKeydown = (index, event) => {
    if (event.key === 'Backspace' && cells.value[index] === '' && index > 0) {
        event.preventDefault();
        cells.value[index - 1] = '';
        sync();
        inputs.value[index - 1]?.focus();
    }

    if (event.key === 'ArrowLeft' && index > 0) {
        event.preventDefault();
        inputs.value[index - 1]?.focus();
    }

    if (event.key === 'ArrowRight' && index < props.length - 1) {
        event.preventDefault();
        inputs.value[index + 1]?.focus();
    }
};
</script>

<template>
    <div>
        <label v-if="label" class="mb-1.5 block text-xs text-zinc-500">{{ label }}</label>
        <div class="flex items-center gap-2">
            <input
                v-for="(cell, index) in cells"
                :key="index"
                :ref="(el) => (inputs[index] = el)"
                :type="masked ? 'password' : 'text'"
                inputmode="numeric"
                autocomplete="one-time-code"
                :value="cell"
                :aria-label="`${label ?? 'Code'} digit ${index + 1}`"
                class="size-10 rounded-lg border border-white/10 bg-ink-950 text-center font-mono text-sm text-cream transition-colors duration-150 outline-none focus:border-jade-500 focus:ring-2 focus:ring-jade-500/20"
                @input="onInput(index, $event)"
                @keydown="onKeydown(index, $event)"
                @focus="$event.target.select()"
            />
        </div>
    </div>
</template>
