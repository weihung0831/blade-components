<script setup>
import { computed } from 'vue';

const props = defineProps({
    sections: { type: Array, default: () => [] },
    variant: { type: String, default: 'full' },
});

const icons = {
    grid: 'M2.5 2.5h4.2v4.2H2.5zM9.3 2.5h4.2v4.2H9.3zM2.5 9.3h4.2v4.2H2.5zM9.3 9.3h4.2v4.2H9.3z',
    deploy: 'M8 13V3m0 0L4.5 6.5M8 3l3.5 3.5',
    bell: 'M4.5 6.5a3.5 3.5 0 1 1 7 0c0 3 1 4 1 4h-9s1-1 1-4Zm2 4.5v.5a1.5 1.5 0 0 0 3 0V11',
    billing: 'M2.5 4.5h11v7h-11zM2.5 7.5h11',
    users: 'M6 7.5a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Zm-3.5 5.4c0-1.9 1.6-3.1 3.5-3.1s3.5 1.2 3.5 3.1m1.6-9.2a2.25 2.25 0 0 1 0 4.4m1.4 4.8c0-1.6-.9-2.5-2.3-2.9',
    settings: 'M2.5 5.5h11M2.5 10.5h11M6 3.5v4M10.5 8.5v4',
    logs: 'M3.5 5 6 7.5 3.5 10M8 11h4.5',
    lock: 'M5 7.5V6a3 3 0 0 1 6 0v1.5M4 7.5h8v5H4z',
    docs: 'M8 5v8m-5-9.5h3.5A1.5 1.5 0 0 1 8 5v8a1.5 1.5 0 0 0-1.5-1.5H3v-8Zm10 0H9.5A1.5 1.5 0 0 0 8 5v8a1.5 1.5 0 0 1 1.5-1.5H13v-8Z',
    chart: 'M3 13V8m3.5 5V4m3.5 9v-6m3.5 6V6',
    dot: 'M8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5Z',
};

const rail = computed(() => props.variant === 'rail');

const iconPath = (entry) => icons[entry.icon] ?? icons.dot;

const tone = (entry) =>
    entry.active ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream';
</script>

<template>
    <aside class="flex flex-col rounded-xl border border-white/10 bg-ink-800 p-2" :class="rail ? 'w-16 items-center' : 'w-60'">
        <div v-if="$slots.brand" class="mb-2 flex items-center gap-2.5 px-1.5 py-1" :class="{ 'justify-center': rail }">
            <slot name="brand" />
        </div>

        <nav class="flex w-full flex-col gap-0.5">
            <template v-for="(section, index) in sections" :key="section.label ?? index">
                <p
                    v-if="section.label && !rail"
                    class="px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase"
                    :class="{ 'pt-3': index > 0 }"
                >{{ section.label }}</p>
                <hr v-else-if="rail && index > 0" class="my-2 w-full border-white/8" />

                <a
                    v-for="entry in section.items ?? []"
                    :key="entry.label"
                    :href="entry.href ?? '#'"
                    :title="entry.label"
                    :target="entry.target ?? null"
                    :aria-current="entry.active ? 'page' : null"
                    class="relative flex items-center rounded-lg text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    :class="[rail ? 'justify-center p-2.5' : 'gap-2.5 px-2.5 py-2', tone(entry)]"
                >
                    <svg class="size-4 shrink-0" viewBox="0 0 16 16" fill="none"><path :d="iconPath(entry)" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>

                    <span v-if="!rail" class="truncate">{{ entry.label }}</span>

                    <template v-if="entry.badge">
                        <span v-if="rail" class="absolute top-1.5 right-1.5 size-1.5 rounded-full bg-jade-400"></span>
                        <span v-else class="ml-auto rounded-full bg-jade-500 px-1.5 font-mono text-[10px] text-ink-950">{{ entry.badge }}</span>
                    </template>
                </a>
            </template>
        </nav>

        <div v-if="$slots.footer" class="mt-auto w-full border-t border-white/5 pt-2" :class="{ 'flex justify-center': rail }">
            <slot name="footer" />
        </div>
    </aside>
</template>
