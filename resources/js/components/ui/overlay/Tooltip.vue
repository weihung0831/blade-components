<script setup>
import { computed } from 'vue';

const props = defineProps({
    text: { type: String, required: true },
    position: { type: String, default: 'top' },
});

const positions = {
    top: 'bottom-full left-1/2 mb-2 -translate-x-1/2 translate-y-1 group-hover/tooltip:translate-y-0 group-focus-within/tooltip:translate-y-0',
    bottom: 'top-full left-1/2 mt-2 -translate-x-1/2 -translate-y-1 group-hover/tooltip:translate-y-0 group-focus-within/tooltip:translate-y-0',
    left: 'top-1/2 right-full mr-2 -translate-y-1/2 translate-x-1 group-hover/tooltip:translate-x-0 group-focus-within/tooltip:translate-x-0',
    right: 'top-1/2 left-full ml-2 -translate-y-1/2 -translate-x-1 group-hover/tooltip:translate-x-0 group-focus-within/tooltip:translate-x-0',
};

const arrows = {
    top: 'top-full left-1/2 -translate-x-1/2 -translate-y-1/2 border-r border-b',
    bottom: 'bottom-full left-1/2 -translate-x-1/2 translate-y-1/2 border-t border-l',
    left: 'top-1/2 left-full -translate-x-1/2 -translate-y-1/2 border-t border-r',
    right: 'top-1/2 right-full translate-x-1/2 -translate-y-1/2 border-b border-l',
};

const panelClasses = computed(() => positions[props.position] ?? positions.top);
const arrowClasses = computed(() => arrows[props.position] ?? arrows.top);
</script>

<template>
    <span class="group/tooltip relative inline-flex">
        <slot />
        <span
            role="tooltip"
            :class="[
                'pointer-events-none absolute z-20 w-max max-w-52 rounded-md border border-white/10 bg-ink-800 px-2.5 py-1.5 text-xs text-zinc-300 opacity-0 shadow-md shadow-black/30 transition-[opacity,translate] duration-150 ease-snap group-hover/tooltip:opacity-100 group-focus-within/tooltip:opacity-100',
                panelClasses,
            ]"
        >
            {{ text }}
            <span class="absolute size-1.5 rotate-45 border-white/10 bg-ink-800" :class="arrowClasses"></span>
        </span>
    </span>
</template>
