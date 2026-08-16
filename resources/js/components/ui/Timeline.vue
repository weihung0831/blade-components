<script setup>
const props = defineProps({
    items: { type: Array, default: () => [] },
    variant: { type: String, default: 'default' },
});

const compactDots = {
    done: 'bg-jade-500',
    current: 'border border-jade-500 bg-ink-950',
    upcoming: 'border border-white/15 bg-ink-950',
};
</script>

<template>
    <div class="flex flex-col">
        <div v-for="(item, index) in items" :key="item.title" class="flex gap-3.5">
            <div class="flex flex-col items-center">
                <span v-if="variant === 'compact'" class="mt-1 size-2.5 shrink-0 rounded-full" :class="compactDots[item.state ?? 'done']"></span>
                <span v-else-if="(item.state ?? 'done') === 'done'" class="grid size-4 shrink-0 place-items-center rounded-full bg-jade-500">
                    <svg class="size-2.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <span v-else-if="item.state === 'current'" class="size-4 shrink-0 rounded-full border-2 border-jade-500 bg-ink-950"></span>
                <span v-else class="size-4 shrink-0 rounded-full border-2 border-white/15 bg-ink-950"></span>
                <span v-if="index < items.length - 1" class="w-px flex-1 bg-white/15"></span>
            </div>
            <div v-if="variant === 'compact'" class="flex min-w-0 flex-1 items-baseline justify-between gap-4" :class="index < items.length - 1 && 'pb-4'">
                <p class="truncate text-[13px]" :class="item.state === 'upcoming' ? 'text-zinc-500' : 'text-zinc-200'">{{ item.title }}</p>
                <span v-if="item.time" class="shrink-0 font-mono text-[11px] text-zinc-600">{{ item.time }}</span>
            </div>
            <div v-else class="min-w-0" :class="index < items.length - 1 && 'pb-6'">
                <p class="text-sm" :class="item.state === 'upcoming' ? 'text-zinc-500' : 'text-zinc-200'">{{ item.title }}</p>
                <p v-if="item.description" class="mt-0.5 text-xs/5 text-zinc-500">{{ item.description }}</p>
                <p v-if="item.time" class="mt-1 font-mono text-[11px] text-zinc-600">{{ item.time }}</p>
            </div>
        </div>
    </div>
</template>
