<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    label: { type: String, default: null },
    placeholder: { type: String, default: '••••••••' },
    meter: { type: Boolean, default: false },
});

const model = defineModel({ type: String, default: '' });
const revealed = ref(false);

const score = computed(() =>
    [
        model.value.length >= 8,
        /[a-z]/.test(model.value) && /[A-Z]/.test(model.value),
        /\d/.test(model.value),
        /[^a-zA-Z0-9]/.test(model.value),
    ].filter(Boolean).length,
);

const hints = ['Use 8+ characters', 'Weak — keep going', 'Okay — mix cases', 'Good — add a symbol', 'Strong password'];
</script>

<template>
    <div class="w-56">
        <label v-if="label" class="mb-1.5 block text-xs text-zinc-500">{{ label }}</label>
        <div class="relative">
            <input
                v-model="model"
                :type="revealed ? 'text' : 'password'"
                :placeholder="placeholder"
                class="h-10 w-full rounded-lg border border-white/10 bg-ink-950 pr-10 pl-3 text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500"
            />
            <button
                type="button"
                :aria-label="revealed ? 'Hide password' : 'Show password'"
                class="absolute top-1/2 right-1.5 grid size-7 -translate-y-1/2 place-items-center rounded-md text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                @click="revealed = !revealed"
            >
                <svg v-if="!revealed" class="size-4" viewBox="0 0 16 16" fill="none"><path d="M1.5 8s2.5-4.5 6.5-4.5S14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8Z" stroke="currentColor" stroke-width="1.3"/><circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.3"/></svg>
                <svg v-else class="size-4" viewBox="0 0 16 16" fill="none"><path d="M1.5 8s2.5-4.5 6.5-4.5S14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8Z" stroke="currentColor" stroke-width="1.3"/><path d="m3 13 10-10" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
            </button>
        </div>
        <template v-if="meter">
            <div class="mt-2 flex gap-1">
                <span
                    v-for="bar in 4"
                    :key="bar"
                    class="h-1 flex-1 rounded-full transition-colors duration-200"
                    :class="bar <= score ? 'bg-jade-500' : 'bg-white/10'"
                ></span>
            </div>
            <p class="mt-1.5 text-xs text-zinc-500">{{ hints[score] }}</p>
        </template>
    </div>
</template>
