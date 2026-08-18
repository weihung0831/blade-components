<script setup>
import KanbanAssignee from './Assignee.vue';
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';

defineProps({
    active: { type: String, default: 'Board' },
    padded: { type: Boolean, default: true },
    batch: { type: String, default: 'Batch 41 · week 33' },
});

const links = [
    { label: 'Board', screen: 'board' },
    { label: 'Backlog', screen: 'backlog' },
    { label: 'Workload', screen: 'workload' },
];

const crew = ['Mei Tsai', 'Idris Bahar', 'Lena Kohler', 'Piotr Adamek'];
</script>

<template>
    <div class="relative flex h-full w-full flex-col overflow-hidden bg-ink-950">
        <header class="shrink-0 border-b border-white/5 bg-ink-950">
            <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
                <a href="/templates/kanban/screens/board" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M4.5 5.5h4v13h-4zM10 5.5h4v8h-4zM15.5 5.5h4v11h-4z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                    </svg>
                    <span class="flex flex-col leading-none">
                        <span class="text-sm font-medium tracking-tight text-cream">Shop floor</span>
                        <span class="mt-0.5 font-mono text-[10px] text-zinc-600">NOMAD Supply · Taichung</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a
                        v-for="link in links"
                        :key="link.label"
                        :href="`/templates/kanban/screens/${link.screen}`"
                        target="_top"
                        :aria-current="link.label === active ? 'page' : null"
                        class="rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                    >{{ link.label }}</a>
                </nav>

                <div class="ml-auto flex shrink-0 items-center gap-3">
                    <span class="hidden rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 lg:block">{{ batch }}</span>

                    <div class="hidden items-center -space-x-1.5 sm:flex">
                        <KanbanAssignee v-for="person in crew" :key="person" :name="person" size="sm" class="ring-2 ring-ink-950" />
                    </div>

                    <button
                        type="button"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >
                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        New job
                    </button>
                </div>
            </div>

            <div v-if="$slots.toolbar" class="border-t border-white/5 px-4 py-2.5 sm:px-5">
                <slot name="toolbar" />
            </div>
        </header>

        <main v-if="padded" data-ui-scroll-region class="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">
            <slot />
        </main>
        <main v-else class="flex min-h-0 flex-1 flex-col">
            <slot />
        </main>

        <UiScrollTop v-if="padded" anchor="container" variant="progress" :threshold="300" />
    </div>
</template>
