<script setup>
defineProps({
    menus: { type: Array, default: () => [] },
});

const itemClasses =
    'flex w-full items-center justify-between gap-8 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';

const tone = (entry) =>
    entry.danger ? 'text-red-400 hover:bg-red-500/10' : 'text-zinc-300 hover:bg-white/5 hover:text-cream';
</script>

<template>
    <div role="menubar" class="flex items-center gap-1 rounded-xl border border-white/10 bg-ink-800 px-2 py-1.5">
        <div v-if="$slots.brand" class="mr-1 flex items-center"><slot name="brand" /></div>

        <details v-for="menu in menus" :key="menu.label" class="group/menu relative" name="ui-menubar">
            <summary
                :class="`cursor-pointer list-none rounded-md px-2.5 py-1 text-sm text-zinc-400 transition-colors duration-150 outline-none select-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/menu:bg-white/8 group-open/menu:text-cream group-open/menu:before:fixed group-open/menu:before:inset-0 group-open/menu:before:cursor-default group-open/menu:before:content-['']`"
            >
                {{ menu.label }}
            </summary>
            <div role="menu" class="absolute top-full left-0 z-10 mt-1.5 min-w-52 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
                <template v-for="(entry, index) in menu.items ?? []" :key="index">
                    <hr v-if="entry.separator" class="my-1 border-white/5" />
                    <a v-else-if="entry.href" :href="entry.href" role="menuitem" :class="[itemClasses, tone(entry)]">
                        <span>{{ entry.label }}</span>
                        <span v-if="entry.shortcut" class="font-mono text-[11px] text-zinc-600">{{ entry.shortcut }}</span>
                    </a>
                    <button v-else type="button" role="menuitem" :class="[itemClasses, tone(entry)]">
                        <span>{{ entry.label }}</span>
                        <span v-if="entry.shortcut" class="font-mono text-[11px] text-zinc-600">{{ entry.shortcut }}</span>
                    </button>
                </template>
            </div>
        </details>

        <div v-if="$slots.end" class="ml-auto flex items-center gap-2 pl-2"><slot name="end" /></div>
    </div>
</template>
