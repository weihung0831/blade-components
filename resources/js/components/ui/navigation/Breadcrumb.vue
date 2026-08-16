<script setup>
defineProps({
    items: { type: Array, default: () => [] },
    separator: { type: String, default: 'chevron' },
    home: { type: String, default: null },
});
</script>

<template>
    <nav aria-label="Breadcrumb" class="flex">
        <ol class="flex flex-wrap items-center gap-2 text-sm">
            <li v-if="home">
                <a
                    :href="home"
                    aria-label="Home"
                    class="grid size-5 place-items-center rounded text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    <svg class="size-4" viewBox="0 0 16 16" fill="none"><path d="M2.5 7 8 2.5 13.5 7v6a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V7Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                </a>
            </li>

            <li v-for="(item, index) in items" :key="item.label" class="flex items-center gap-2">
                <span v-if="home || index > 0" aria-hidden="true" class="text-zinc-700 select-none">
                    <span v-if="separator === 'slash'" class="text-xs">/</span>
                    <svg v-else class="size-3" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>

                <span v-if="index === items.length - 1" aria-current="page" class="font-medium text-cream">{{ item.label }}</span>
                <a
                    v-else-if="item.href"
                    :href="item.href"
                    class="rounded text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >{{ item.label }}</a>
                <span v-else class="text-zinc-600">{{ item.label }}</span>
            </li>
        </ol>
    </nav>
</template>
