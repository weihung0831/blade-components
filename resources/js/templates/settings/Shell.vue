<script setup>
import { computed } from 'vue';
import UiSeparator from '../../components/ui/data-display/Separator.vue';
import UiBreadcrumb from '../../components/ui/navigation/Breadcrumb.vue';
import UiAvatar from '../../components/ui/data-display/Avatar.vue';
import UiButton from '../../components/ui/actions/Button.vue';
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';
import UiDropdown from '../../components/ui/overlay/Dropdown.vue';

const props = defineProps({
    active: { type: String, default: 'Profile' },
    title: { type: String, default: 'Profile' },
    description: { type: String, default: null },
    dirty: { type: Boolean, default: false },
});

const nav = [
    { label: 'Personal', items: [
        { label: 'Profile', screen: 'profile' },
        { label: 'Notifications' },
        { label: 'Appearance' },
    ] },
    { label: 'Workspace', items: [
        { label: 'General' },
        { label: 'Team', screen: 'team', meta: '312' },
        { label: 'Billing', screen: 'billing' },
        { label: 'API keys', screen: 'api-keys' },
        { label: 'Audit log' },
        { label: 'Data region', meta: 'ap-1' },
    ] },
];

const sections = computed(() => nav.map((section) => ({
    label: section.label,
    items: section.items.map((item) => ({
        ...item,
        href: item.screen ? `/templates/settings/screens/${item.screen}` : '#',
        active: item.label === props.active,
    })),
})));

const crumbs = computed(() => [{ label: 'wharf', href: '#' }, { label: 'Settings', href: '#' }, { label: props.title }]);
const shortCrumbs = computed(() => crumbs.value.slice(1));
</script>

<template>
    <div class="flex h-full w-full flex-col overflow-hidden bg-ink-950">
        <header class="flex h-14 shrink-0 items-center gap-3 border-b border-white/5 px-4 sm:gap-4 sm:px-6">
            <a href="/templates/dashboard/screens/overview" target="_top"
                class="inline-flex shrink-0 items-center gap-1.5 text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Console
            </a>

            <UiSeparator vertical class="my-3.5" />

            <UiBreadcrumb :items="shortCrumbs" separator="slash" class="min-w-0 shrink sm:hidden" />
            <UiBreadcrumb :items="crumbs" separator="slash" class="hidden min-w-0 shrink sm:flex" />

            <div class="ml-auto flex shrink-0 items-center gap-3">
                <span class="hidden items-center gap-2 rounded-full border border-white/10 py-1 pr-3 pl-1 md:inline-flex">
                    <UiAvatar initials="NB" size="sm" />
                    <span class="text-[13px] text-zinc-300">Northbeam Supply</span>
                    <span class="font-mono text-[10px] text-zinc-600">Scale</span>
                </span>

                <UiAvatar initials="WH" size="sm" color="jade" />
            </div>
        </header>

        <div class="flex min-h-0 flex-1">
            <nav class="hidden w-56 shrink-0 flex-col gap-0.5 overflow-y-auto border-r border-white/5 p-4 lg:flex">
                <template v-for="(section, index) in sections" :key="section.label">
                    <p class="px-2.5 pb-1.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase" :class="index > 0 && 'pt-4'">{{ section.label }}</p>

                    <a
                        v-for="item in section.items"
                        :key="item.label"
                        :href="item.href"
                        :target="item.screen ? '_top' : null"
                        :aria-current="item.active ? 'page' : null"
                        class="flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="item.active ? 'bg-jade-500/12 text-jade-300' : 'text-zinc-400 hover:bg-white/5 hover:text-cream'"
                    >
                        <span class="truncate">{{ item.label }}</span>
                        <span v-if="item.meta" class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ item.meta }}</span>
                    </a>
                </template>

                <div class="mt-auto rounded-lg border border-white/8 p-3">
                    <p class="text-[11px]/5 text-zinc-500">Owners see every panel. Developers see the first four.</p>
                    <a href="#" class="mt-1.5 inline-block font-mono text-[10px] text-jade-400 hover:text-jade-300">Role reference</a>
                </div>
            </nav>

            <div class="relative flex min-w-0 flex-1">
                <div data-ui-scroll-region class="flex min-w-0 flex-1 flex-col overflow-y-auto">
                    <div class="shrink-0 border-b border-white/5 px-4 py-2.5 lg:hidden">
                        <UiDropdown>
                            {{ active }}

                            <template #menu>
                                <template v-for="(section, index) in sections" :key="section.label">
                                    <p class="px-3 pb-1 font-mono text-[10px] tracking-wider text-zinc-600 uppercase" :class="index > 0 && 'pt-2'">{{ section.label }}</p>

                                    <a
                                        v-for="item in section.items"
                                        :key="item.label"
                                        :href="item.href"
                                        :target="item.screen ? '_top' : null"
                                        :class="item.active && 'text-jade-300!'"
                                    >
                                        {{ item.label }}
                                        <span v-if="item.meta" class="ml-auto font-mono text-[10px] text-zinc-600">{{ item.meta }}</span>
                                    </a>
                                </template>
                            </template>
                        </UiDropdown>
                    </div>

                    <div class="mx-auto w-full max-w-3xl shrink-0 px-5 py-8 sm:px-8">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <h1 class="text-xl font-semibold tracking-tight text-cream">{{ title }}</h1>
                                <p v-if="description" class="mt-1.5 max-w-lg text-[13px]/6 text-zinc-500">{{ description }}</p>
                            </div>
                            <div v-if="$slots.actions" class="flex shrink-0 flex-wrap items-center gap-2">
                                <slot name="actions" />
                            </div>
                        </div>

                        <div class="mt-7 flex flex-col gap-5">
                            <slot />
                        </div>

                        <div v-if="dirty" class="sticky bottom-0 z-10 mt-6 flex flex-wrap items-center gap-x-3 gap-y-2 rounded-xl border border-jade-500/25 bg-ink-900/95 px-4 py-3 backdrop-blur">
                            <span class="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                            <p class="text-[13px] text-zinc-200">Unsaved changes</p>
                            <p class="font-mono text-[11px] text-zinc-600">applies to every workspace you belong to</p>

                            <div class="ml-auto flex shrink-0 items-center gap-2">
                                <UiButton variant="ghost" size="sm">Reset</UiButton>
                                <UiButton size="sm">Save changes</UiButton>
                            </div>
                        </div>
                    </div>
                </div>

                <UiScrollTop anchor="container" variant="progress" :threshold="300" />
            </div>
        </div>
    </div>
</template>
