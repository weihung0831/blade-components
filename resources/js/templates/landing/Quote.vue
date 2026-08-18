<script setup>
import { computed } from 'vue';

const props = defineProps({
    body: { type: String, required: true },
    name: { type: String, required: true },
    role: { type: String, default: null },
    machine: { type: String, default: null },
    since: { type: String, default: null },
});

const initials = computed(() => props.name.split(' ').slice(0, 2).map((part) => part.charAt(0)).join(''));
</script>

<template>
    <figure class="flex flex-col rounded-2xl border border-white/8 bg-ink-950 p-4">
        <blockquote class="text-[13px]/6 text-zinc-300">{{ body }}</blockquote>

        <figcaption class="mt-4 flex items-center gap-3 border-t border-white/5 pt-3">
            <span class="flex size-7 shrink-0 items-center justify-center rounded-full border border-white/10 bg-ink-900 font-mono text-[10px] text-zinc-500">{{ initials }}</span>

            <span class="min-w-0 flex-1">
                <span class="block truncate text-[12px] text-cream">{{ name }}</span>
                <span v-if="role" class="block truncate text-[11px] text-zinc-600">{{ role }}</span>
            </span>

            <span class="shrink-0 text-right">
                <span v-if="machine" class="block font-mono text-[10px] text-zinc-600">{{ machine }}</span>
                <span v-if="since" class="block font-mono text-[10px] text-zinc-700">{{ since }}</span>
            </span>
        </figcaption>
    </figure>
</template>
