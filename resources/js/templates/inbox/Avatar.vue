<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: { type: String, required: true },
    size: { type: String, default: 'sm' },
    kind: { type: String, default: 'agent' },
    meta: { type: String, default: null },
});

const crew = [
    'border-jade-500/50 bg-jade-500/15 text-jade-300',
    'border-white/20 bg-white/10 text-cream',
    'border-white/12 bg-ink-800 text-zinc-300',
];

const sizes = {
    xs: 'size-5 text-[9px]',
    sm: 'size-6 text-[10px]',
    md: 'size-8 text-[11px]',
    lg: 'size-10 text-[13px]',
};

const initials = computed(() => props.name
    .split(' ')
    .slice(0, 2)
    .map((part) => part.charAt(0).toUpperCase())
    .join(''));

const tone = computed(() => props.kind === 'customer'
    ? 'border-dashed border-white/15 bg-ink-950 text-zinc-500'
    : crew[[...props.name].reduce((sum, char) => sum + char.charCodeAt(0), 0) % 3]);
</script>

<template>
    <span
        class="grid shrink-0 place-items-center border font-mono select-none"
        :class="[kind === 'customer' ? 'rounded-lg' : 'rounded-full', tone, sizes[size] ?? sizes.sm]"
        :title="meta ? `${name} · ${meta}` : name"
    >{{ initials }}</span>
</template>
