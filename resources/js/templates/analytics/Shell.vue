<script setup>
import UiAvatar from '../../components/ui/data-display/Avatar.vue';
import UiButton from '../../components/ui/actions/Button.vue';
import UiDropdown from '../../components/ui/overlay/Dropdown.vue';
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';

defineProps({
    active: { type: String, default: 'Explore' },
    title: { type: String, default: 'Explore' },
    description: { type: String, default: null },
});

const range = defineModel('range', { type: String, default: '28d' });

const tabs = [
    { label: 'Explore', screen: 'explore', icon: 'M2 12.5 6 7.5l3 2.5 5-7' },
    { label: 'Funnels', screen: 'funnels', icon: 'M2 3h12l-4.5 5.5V14L6.5 12V8.5L2 3Z' },
    { label: 'Retention', screen: 'retention', icon: 'M2.5 2.5h4.5v4.5h-4.5zM9 2.5h4.5v4.5H9zM2.5 9h4.5v4.5h-4.5zM9 9h4.5v4.5H9z' },
    { label: 'Live', screen: 'live', icon: 'M8 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM4 3.5A6 6 0 0 0 2 8c0 1.7.7 3.3 2 4.5M12 3.5A6 6 0 0 1 14 8c0 1.7-.7 3.3-2 4.5' },
];

const ranges = ['7d', '28d', '90d'];

const windows = {
    '7d': '11 – 17 Aug 2026',
    '28d': '21 Jul – 17 Aug 2026',
    '90d': '20 May – 17 Aug 2026',
};
</script>

<template>
    <div class="group/shell flex h-full w-full overflow-hidden bg-ink-950" :data-range="range">
        <nav class="hidden w-14 shrink-0 flex-col items-center gap-1 border-r border-white/5 bg-ink-900/60 py-3 md:flex">
            <a href="/templates/analytics/screens/explore" target="_top"
                class="grid size-8 shrink-0 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</a>

            <span class="my-2 h-px w-6 bg-white/8"></span>

            <a
                v-for="tab in tabs"
                :key="tab.label"
                :href="`/templates/analytics/screens/${tab.screen}`"
                target="_top"
                :aria-current="tab.label === active ? 'page' : null"
                class="group/rail relative grid size-9 place-items-center rounded-lg transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                :class="tab.label === active ? 'bg-jade-500/12 text-jade-300' : 'text-zinc-600 hover:bg-white/5 hover:text-cream'"
            >
                <svg class="size-4" viewBox="0 0 16 16" fill="none">
                    <path :d="tab.icon" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="pointer-events-none absolute left-full z-40 ml-2 hidden rounded-md border border-white/10 bg-ink-800 px-2 py-1 font-mono text-[10px] whitespace-nowrap text-zinc-300 group-hover/rail:block">{{ tab.label }}</span>
            </a>

            <div class="grow"></div>

            <span class="font-mono text-[9px] tracking-wider text-zinc-700 uppercase [writing-mode:vertical-rl]">v4.2</span>
            <UiAvatar initials="WH" size="sm" color="jade" class="mt-3" />
        </nav>

        <div class="relative flex min-w-0 flex-1">
            <div data-ui-scroll-region class="flex min-w-0 flex-1 flex-col overflow-y-auto">
                <header class="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-3 border-b border-white/5 bg-ink-950/85 px-4 backdrop-blur sm:px-6">
                    <UiDropdown variant="ghost" class="shrink-0 [&>summary]:h-8 [&>summary]:px-2 [&>summary]:text-[13px]">
                        <span class="flex items-center gap-2">
                            <span class="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                            <span class="text-cream">storefront-app</span>
                            <span class="hidden font-mono text-[10px] text-zinc-600 sm:inline">production</span>
                        </span>

                        <template #menu>
                            <a href="#">storefront-app <span class="ml-auto font-mono text-[10px] text-zinc-600">prod</span></a>
                            <a href="#">storefront-app <span class="ml-auto font-mono text-[10px] text-zinc-600">staging</span></a>
                            <a href="#">checkout-web</a>
                            <a href="#">merchant-console</a>

                            <hr />

                            <a href="#">New project</a>
                        </template>
                    </UiDropdown>

                    <span class="hidden font-mono text-[10px] text-zinc-700 lg:inline">ingesting 4.2k events / min</span>

                    <div class="ml-auto flex shrink-0 items-center gap-2 sm:gap-3">
                        <span class="hidden font-mono text-[10px] text-zinc-600 lg:inline">{{ windows[range] }}</span>

                        <div class="inline-flex items-center rounded-lg border border-white/10 bg-ink-900 p-0.5 font-mono text-[11px]">
                            <button
                                v-for="option in ranges"
                                :key="option"
                                type="button"
                                @click="range = option"
                                class="rounded-md px-2 py-1 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                :class="range === option ? 'bg-jade-500/15 text-jade-300' : 'text-zinc-500 hover:text-cream'"
                            >
                                {{ option }}
                            </button>
                        </div>

                        <UiButton variant="secondary" size="sm" class="hidden sm:inline-flex">Share</UiButton>

                        <UiDropdown variant="ghost" align="right" class="md:hidden [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
                            Menu

                            <template #menu>
                                <a
                                    v-for="tab in tabs"
                                    :key="tab.label"
                                    :href="`/templates/analytics/screens/${tab.screen}`"
                                    target="_top"
                                    :class="tab.label === active ? 'text-jade-300!' : null"
                                >
                                    {{ tab.label }}
                                </a>

                                <hr />

                                <a href="/templates/dashboard/screens/overview" target="_top">Back to console</a>
                            </template>
                        </UiDropdown>
                    </div>
                </header>

                <div class="border-b border-white/5 px-4 py-6 sm:px-6">
                    <div class="flex flex-wrap items-end justify-between gap-x-8 gap-y-4">
                        <div>
                            <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Lens · {{ active }}</p>
                            <h1 class="mt-2 max-w-2xl text-2xl font-semibold tracking-tight text-cream">{{ title }}</h1>
                            <p v-if="description" class="mt-2 max-w-xl text-[13px]/6 text-zinc-500">{{ description }}</p>
                        </div>

                        <div v-if="$slots.actions" class="flex flex-wrap items-center gap-2">
                            <slot name="actions" />
                        </div>
                    </div>

                    <div v-if="$slots.toolbar" class="mt-5">
                        <slot name="toolbar" />
                    </div>
                </div>

                <main class="flex grow flex-col gap-5 px-4 py-6 sm:px-6">
                    <slot />
                </main>

                <footer class="flex flex-wrap items-center gap-x-4 gap-y-2 border-t border-white/5 px-4 py-4 font-mono text-[10px] text-zinc-700 sm:px-6">
                    <span>wharf lens</span>
                    <span>events retained 24 months</span>
                    <span class="ml-auto">last ingest 3s ago</span>
                </footer>
            </div>

            <UiScrollTop anchor="container" variant="progress" :threshold="300" />
        </div>
    </div>
</template>
