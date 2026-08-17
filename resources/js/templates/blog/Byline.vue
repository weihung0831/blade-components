<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: { type: String, required: true },
    role: { type: String, default: null },
    date: { type: String, default: null },
    read: { type: Number, default: null },
    initials: { type: String, default: null },
    bio: { type: String, default: null },
    size: { type: String, default: 'sm' },
});

const large = computed(() => props.size === 'lg');

const mark = computed(() => props.initials ?? props.name.split(' ').slice(0, 2).map((part) => part[0]).join(''));
</script>

<template>
    <div class="flex" :class="large ? 'gap-4' : 'items-center gap-3'">
        <span
            class="grid shrink-0 place-items-center rounded-full border border-jade-500/30 bg-jade-500/10 font-mono text-jade-300 uppercase"
            :class="large ? 'size-12 text-sm' : 'size-8 text-[11px]'"
        >{{ mark }}</span>

        <div class="flex min-w-0 flex-col">
            <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
                <span class="text-cream" :class="large ? 'text-[15px] font-medium' : 'text-[13px]'">{{ name }}</span>
                <span v-if="role" class="font-mono text-[10px] text-zinc-600">{{ role }}</span>
            </div>

            <p v-if="date || read" class="mt-0.5 flex flex-wrap items-center gap-x-2 gap-y-0.5 font-mono text-[10px] text-zinc-600">
                <span v-if="date">{{ date }}</span>
                <span v-if="date && read" aria-hidden="true" class="size-1 rounded-full bg-white/15"></span>
                <span v-if="read">{{ read }} min read</span>
            </p>

            <p v-if="bio" class="mt-2 max-w-md text-[13px]/6 text-zinc-500">{{ bio }}</p>

            <slot />
        </div>
    </div>
</template>
