<script setup>
import { computed, nextTick, ref, watch } from 'vue';

const props = defineProps({
    options: { type: Array, default: () => [] },
    placeholder: { type: String, default: 'Select…' },
    variant: { type: String, default: 'outline' },
    size: { type: String, default: 'md' },
    disabled: { type: Boolean, default: false },
});

const model = defineModel({ default: null });

const open = ref(false);
const root = ref(null);
const menu = ref(null);
const dropUp = ref(false);

const clipper = (element) => {
    let parent = element.parentElement;

    while (parent && parent !== document.body) {
        if (/(auto|scroll|hidden)/.test(getComputedStyle(parent).overflowY)) {
            return parent;
        }

        parent = parent.parentElement;
    }

    return null;
};

const place = async () => {
    if (!open.value) {
        dropUp.value = false;

        return;
    }

    await nextTick();

    const box = clipper(root.value);
    const bounds = box ? box.getBoundingClientRect() : { top: 0, bottom: window.innerHeight };
    const trigger = root.value.getBoundingClientRect();
    const needed = menu.value.offsetHeight + 8;

    dropUp.value = bounds.bottom - trigger.bottom < needed && trigger.top - bounds.top > needed;
};

watch(open, place);

const select = (option) => {
    model.value = option;
    open.value = false;
};

const triggers = {
    outline: 'border border-white/10 bg-ink-950 hover:border-white/25',
    filled: 'border border-transparent bg-ink-800 hover:bg-white/5',
    invalid: 'border border-red-400/60 bg-ink-950',
};

const openBorders = {
    outline: 'border-jade-500',
    filled: 'border-jade-500',
    invalid: 'border-red-400',
};

const sizes = {
    sm: 'h-8 px-2.5 text-xs',
    md: 'h-10 px-3 text-sm',
};

const triggerClasses = computed(() => [
    'flex w-full cursor-pointer items-center justify-between gap-6 rounded-lg transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
    triggers[props.variant] ?? triggers.outline,
    sizes[props.size] ?? sizes.md,
    open.value && (openBorders[props.variant] ?? openBorders.outline),
]);
</script>

<template>
    <div ref="root" class="relative block" :class="disabled && 'pointer-events-none opacity-40'">
        <button type="button" :disabled="disabled" @click="open = !open" :class="triggerClasses">
            <span class="truncate" :class="model !== null ? 'text-zinc-300' : 'text-zinc-600'">{{ model ?? placeholder }}</span>
            <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" :class="open && 'rotate-180'" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <template v-if="open">
            <div class="fixed inset-0 z-10" @click="open = false"></div>
            <div
                ref="menu"
                class="absolute left-0 z-20 w-full min-w-max rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40"
                :class="dropUp ? 'bottom-full mb-2' : 'top-full mt-2'"
            >
                <button
                    v-for="option in options"
                    :key="option"
                    type="button"
                    @click="select(option)"
                    class="flex w-full cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm transition-colors duration-150"
                    :class="model === option ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'"
                >
                    {{ option }}
                    <svg v-if="model === option" class="size-3 shrink-0" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </template>
    </div>
</template>
