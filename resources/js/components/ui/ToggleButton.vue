<script setup>
import { computed } from 'vue';

const props = defineProps({
    type: { type: String, default: 'checkbox' },
    value: { type: [String, Number, Boolean], default: null },
    size: { type: String, default: 'md' },
    disabled: { type: Boolean, default: false },
});

const model = defineModel({ type: [String, Number, Boolean], default: false });

const sizes = {
    sm: 'h-8 px-3.5 text-[13px]',
    md: 'h-10 px-4 text-sm',
};

const sizeClasses = computed(() => sizes[props.size] ?? sizes.md);
</script>

<template>
    <label class="inline-flex has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40">
        <input v-model="model" :type="type" :value="value" :disabled="disabled" class="peer sr-only" />
        <span
            class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-white/10 font-medium text-zinc-400 transition-[transform,background-color,border-color,color] duration-150 ease-snap select-none peer-checked:border-jade-500/40 peer-checked:bg-jade-500/15 peer-checked:text-jade-300 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70 hover:border-white/25 active:scale-[0.97]"
            :class="sizeClasses"
        >
            <slot />
        </span>
    </label>
</template>
