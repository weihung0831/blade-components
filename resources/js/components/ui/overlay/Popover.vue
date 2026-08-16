<script setup>
import { computed } from 'vue';

const props = defineProps({
    position: { type: String, default: 'bottom' },
});

const positions = {
    bottom: 'top-full left-0 mt-2',
    'bottom-end': 'top-full right-0 mt-2',
    top: 'bottom-full left-0 mb-2',
    'top-end': 'bottom-full right-0 mb-2',
};

const panelClasses = computed(() => [
    'absolute z-10 w-72 rounded-xl border border-white/10 bg-ink-900 p-4 shadow-lg shadow-black/40',
    positions[props.position] ?? positions.bottom,
]);
</script>

<template>
    <details class="group/popover relative inline-block" name="ui-popover">
        <summary
            class="inline-block cursor-pointer list-none rounded-lg outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/popover:before:fixed group-open/popover:before:inset-0 group-open/popover:before:cursor-default group-open/popover:before:content-['']"
        >
            <slot name="trigger" />
        </summary>
        <div :class="panelClasses"><slot /></div>
    </details>
</template>
