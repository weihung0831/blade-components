<script setup>
import InboxAvatar from './Avatar.vue';

defineProps({
    active: { type: String, default: 'Inbox' },
    folder: { type: String, default: 'Unassigned' },
    rail: { type: Boolean, default: true },
    padded: { type: Boolean, default: true },
    promise: { type: String, default: '4h first reply, business hours GMT+8' },
});

const links = [
    { label: 'Inbox', screen: 'threads' },
    { label: 'Compose', screen: 'compose' },
    { label: 'Search', screen: 'search' },
];

const folders = [
    { label: 'Unassigned', count: 3, urgent: true },
    { label: 'Mine', count: 3, urgent: false },
    { label: 'Waiting on them', count: 1, urgent: false },
    { label: 'Snoozed', count: 1, urgent: false },
];

const lanes = [
    { label: 'Warranty', count: 2 },
    { label: 'Dealers', count: 3 },
    { label: 'Orders', count: 2 },
    { label: 'Parts', count: 1 },
];

const desk = ['Hana Okabe', 'Lena Kohler', 'Idris Bahar'];
</script>

<template>
    <div class="flex h-full w-full flex-col overflow-hidden bg-ink-950">
        <header class="shrink-0 border-b border-white/5 bg-ink-950">
            <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
                <a href="/templates/inbox/screens/threads" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M3.5 8.5 12 14l8.5-5.5M3.5 6.5h17v11h-17z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                    </svg>
                    <span class="flex flex-col leading-none">
                        <span class="text-sm font-medium tracking-tight text-cream">Front desk</span>
                        <span class="mt-0.5 font-mono text-[10px] text-zinc-600">support@nomadsupply.cc</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a
                        v-for="link in links"
                        :key="link.label"
                        :href="`/templates/inbox/screens/${link.screen}`"
                        target="_top"
                        :aria-current="link.label === active ? 'page' : undefined"
                        class="rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                    >{{ link.label }}</a>
                </nav>

                <div class="ml-auto flex shrink-0 items-center gap-3">
                    <span class="hidden items-center gap-1.5 rounded-lg border border-red-400/40 bg-red-500/8 px-2.5 py-1.5 font-mono text-[11px] text-red-300 lg:flex">
                        <span class="size-1.5 rounded-full bg-red-400"></span>
                        2 past the promise
                    </span>

                    <div class="hidden items-center -space-x-1.5 sm:flex">
                        <InboxAvatar v-for="person in desk" :key="person" :name="person" size="sm" class="ring-2 ring-ink-950" />
                    </div>

                    <button
                        type="button"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >
                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                        Write
                    </button>
                </div>
            </div>

            <div v-if="$slots.toolbar" class="border-t border-white/5 px-4 py-2.5 sm:px-5">
                <slot name="toolbar" />
            </div>
        </header>

        <div class="flex min-h-0 flex-1">
            <aside v-if="rail" class="hidden w-52 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                <div>
                    <p class="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Queues</p>
                    <nav class="mt-2 px-2">
                        <a
                            v-for="entry in folders"
                            :key="entry.label"
                            href="/templates/inbox/screens/threads"
                            target="_top"
                            :aria-current="entry.label === folder ? 'page' : undefined"
                            class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            :class="entry.label === folder ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                        >
                            <span class="truncate">{{ entry.label }}</span>
                            <span class="ml-auto shrink-0 font-mono text-[10px]" :class="entry.urgent ? 'text-red-300' : 'text-zinc-600'">{{ entry.count }}</span>
                        </a>
                    </nav>

                    <p class="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Lanes</p>
                    <nav class="mt-2 px-2">
                        <a
                            v-for="lane in lanes"
                            :key="lane.label"
                            href="/templates/inbox/screens/search"
                            target="_top"
                            class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            <span class="truncate">{{ lane.label }}</span>
                            <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ lane.count }}</span>
                        </a>
                    </nav>
                </div>

                <div class="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">Reply promise</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">{{ promise }}</p>
                    <div class="mt-2.5 flex items-center gap-2">
                        <span class="block h-0.5 flex-1 overflow-hidden rounded-full bg-white/10">
                            <span class="block h-full w-[82%] rounded-full bg-jade-500/70"></span>
                        </span>
                        <span class="font-mono text-[10px] text-zinc-500">82%</span>
                    </div>
                    <p class="mt-1.5 font-mono text-[10px] text-zinc-700">kept, last 30 days</p>
                </div>
            </aside>

            <main v-if="padded" class="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">
                <slot />
            </main>
            <main v-else class="flex min-h-0 flex-1 flex-col overflow-hidden">
                <slot />
            </main>
        </div>
    </div>
</template>
