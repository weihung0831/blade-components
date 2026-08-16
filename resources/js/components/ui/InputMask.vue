<script setup>
const props = defineProps({
    mask: { type: String, required: true },
    label: { type: String, default: null },
    placeholder: { type: String, default: null },
});

const model = defineModel({ type: String, default: '' });

const format = (raw) => {
    const pending = [...raw].filter((char) => /[0-9a-z]/i.test(char));
    let output = '';

    for (const token of props.mask) {
        if (pending.length === 0) {
            break;
        }

        if (token === '#' || token === 'a') {
            const pattern = token === '#' ? /\d/ : /[a-z]/i;

            while (pending.length > 0 && !pattern.test(pending[0])) {
                pending.shift();
            }

            if (pending.length === 0) {
                break;
            }

            output += pending.shift();
        } else {
            output += token;
        }
    }

    return output;
};

const onInput = (event) => {
    const formatted = format(event.target.value);

    event.target.value = formatted;
    model.value = formatted;
};
</script>

<template>
    <div class="w-56">
        <label v-if="label" class="mb-1.5 block text-xs text-zinc-500">{{ label }}</label>
        <input
            type="text"
            :value="model"
            :placeholder="placeholder ?? mask"
            :aria-label="label ?? undefined"
            class="h-9 w-full rounded-lg border border-white/10 bg-ink-950 px-3 font-mono text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500"
            @input="onInput"
        />
    </div>
</template>
