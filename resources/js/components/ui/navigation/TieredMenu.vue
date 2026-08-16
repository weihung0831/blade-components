<script setup>
defineProps({
    items: { type: Array, default: () => [] },
});

const itemClasses =
    'flex w-full items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';

const submenuClasses =
    'invisible absolute top-0 left-full z-10 ml-1 -translate-x-1 opacity-0 transition-[opacity,translate,visibility] duration-150 ease-snap group-hover/tier:visible group-hover/tier:translate-x-0 group-hover/tier:opacity-100 group-focus-within/tier:visible group-focus-within/tier:translate-x-0 group-focus-within/tier:opacity-100';

const tone = (entry) =>
    entry.danger
        ? 'text-red-400 hover:bg-red-500/10 [&:has(+ul:hover)]:bg-red-500/10'
        : 'text-zinc-300 hover:bg-white/5 hover:text-cream [&:has(+ul:hover)]:bg-white/5 [&:has(+ul:hover)]:text-cream';
</script>

<template>
    <ul role="menu" class="min-w-52 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
        <template v-for="(entry, index) in items" :key="index">
            <li v-if="entry.separator"><hr class="my-1 border-white/5" /></li>
            <li v-else class="group/tier relative" role="none">
                <a v-if="entry.href && !entry.items" :href="entry.href" role="menuitem" :class="[itemClasses, tone(entry)]">
                    <span>{{ entry.label }}</span>
                    <span v-if="entry.shortcut" class="font-mono text-[11px] text-zinc-600">{{ entry.shortcut }}</span>
                </a>
                <button v-else type="button" role="menuitem" :aria-haspopup="entry.items ? 'true' : null" :class="[itemClasses, tone(entry)]">
                    <span>{{ entry.label }}</span>
                    <svg v-if="entry.items" class="size-3 text-zinc-500" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span v-else-if="entry.shortcut" class="font-mono text-[11px] text-zinc-600">{{ entry.shortcut }}</span>
                </button>

                <TieredMenu v-if="entry.items" :items="entry.items" :class="submenuClasses" />
            </li>
        </template>
    </ul>
</template>
