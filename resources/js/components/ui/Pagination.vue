<script setup>
import { computed } from 'vue';

const props = defineProps({
    pages: { type: Number, default: 1 },
    current: { type: Number, default: 1 },
    url: { type: String, default: '#' },
    variant: { type: String, default: 'numbered' },
    siblings: { type: Number, default: 1 },
});

const arrow =
    'grid size-9 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70';
const disabled = 'grid size-9 place-items-center rounded-lg border border-white/5 text-zinc-700';

const href = (page) => props.url.replace(':page', String(page));

const numbers = computed(() => {
    const list = [];
    let previous = 0;

    for (let page = 1; page <= props.pages; page++) {
        if (page !== 1 && page !== props.pages && Math.abs(page - props.current) > props.siblings) {
            continue;
        }

        if (previous !== 0 && page - previous > 1) {
            list.push(null);
        }

        list.push(page);
        previous = page;
    }

    return list;
});
</script>

<template>
    <nav aria-label="Pagination" class="flex items-center gap-1.5">
        <a v-if="current > 1" :href="href(current - 1)" rel="prev" aria-label="Previous page" :class="arrow">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <span v-else aria-disabled="true" :class="disabled">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>

        <span v-if="variant === 'simple'" class="px-3 font-mono text-xs text-zinc-500">
            Page <span class="text-cream">{{ current }}</span> of {{ pages }}
        </span>
        <template v-else>
            <template v-for="(page, index) in numbers" :key="index">
                <span v-if="page === null" aria-hidden="true" class="grid size-9 place-items-center text-zinc-600">…</span>
                <span v-else-if="page === current" aria-current="page" class="grid size-9 place-items-center rounded-lg bg-jade-500 text-sm font-medium text-ink-950">{{ page }}</span>
                <a
                    v-else
                    :href="href(page)"
                    class="grid size-9 place-items-center rounded-lg border border-white/10 text-sm text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >{{ page }}</a>
            </template>
        </template>

        <a v-if="current < pages" :href="href(current + 1)" rel="next" aria-label="Next page" :class="arrow">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <span v-else aria-disabled="true" :class="disabled">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
    </nav>
</template>
