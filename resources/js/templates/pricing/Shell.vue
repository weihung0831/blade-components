<script setup>
import UiButton from '../../components/ui/actions/Button.vue';
import UiDropdown from '../../components/ui/overlay/Dropdown.vue';
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';

defineProps({
    active: { type: String, default: 'Plans' },
    title: { type: String, default: 'Pricing' },
    description: { type: String, default: null },
    cycle: { type: Boolean, default: true },
});

const billing = defineModel('billing', { type: String, default: 'monthly' });

const tabs = [
    { label: 'Plans', screen: 'plans' },
    { label: 'Compare', screen: 'compare' },
    { label: 'Calculator', screen: 'calculator' },
    { label: 'Enterprise', screen: 'enterprise' },
];

const nav = ['Product', 'Merchants', 'Docs', 'Changelog'];

const footer = [
    { label: 'Platform', items: ['Storefronts', 'Checkout', 'Webhooks', 'Regions'] },
    { label: 'Pricing', items: ['Plans', 'Feature matrix', 'Estimator', 'Enterprise'] },
    { label: 'Company', items: ['Status', 'Security', 'DPA', 'Sub-processors'] },
];
</script>

<template>
    <div class="group/shell flex h-full w-full flex-col overflow-hidden bg-ink-950" :data-cycle="billing">
        <div class="relative flex min-h-0 flex-1">
            <div data-ui-scroll-region class="flex min-w-0 flex-1 flex-col overflow-y-auto">
                <header class="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-4 border-b border-white/5 bg-ink-950/85 px-5 backdrop-blur sm:px-8">
                    <a href="/templates/pricing/screens/plans" target="_top" class="flex shrink-0 items-center gap-2">
                        <span class="grid size-7 place-items-center rounded-lg bg-jade-500 font-mono text-[11px] font-bold text-ink-950">///</span>
                        <span class="text-sm font-medium text-cream">wharf</span>
                    </a>

                    <nav class="hidden items-center gap-1 md:flex">
                        <a v-for="item in nav" :key="item" href="#"
                            class="rounded-md px-2.5 py-1 text-[13px] text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">{{ item }}</a>
                        <span class="rounded-md bg-jade-500/12 px-2.5 py-1 text-[13px] text-jade-300">Pricing</span>
                    </nav>

                    <div class="ml-auto flex shrink-0 items-center gap-2">
                        <a href="/templates/auth/screens/sign-in" target="_top"
                            class="hidden text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream md:block">Sign in</a>

                        <UiButton size="sm" href="/templates/auth/screens/sign-up" target="_top">Start a trial</UiButton>

                        <UiDropdown variant="ghost" align="right" class="md:hidden [&>summary]:h-8 [&>summary]:px-2.5 [&>summary]:text-[13px]">
                            Menu

                            <template #menu>
                                <a v-for="item in nav" :key="item" href="#">{{ item }}</a>

                                <a href="/templates/pricing/screens/plans" target="_top" class="text-jade-300!">Pricing</a>

                                <hr />

                                <a href="/templates/auth/screens/sign-in" target="_top">Sign in</a>
                            </template>
                        </UiDropdown>
                    </div>
                </header>

                <div class="dot-grid relative border-b border-white/5">
                    <span aria-hidden="true" class="pointer-events-none absolute top-0 left-1/2 size-96 -translate-x-1/2 -translate-y-1/2 rounded-full bg-jade-500/8 blur-3xl"></span>

                    <div class="relative mx-auto w-full max-w-6xl px-5 pt-12 pb-8 sm:px-8">
                        <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Pricing · ap-1 · TWD prices on request</p>
                        <div class="mt-3 flex flex-wrap items-end justify-between gap-x-8 gap-y-5">
                            <div>
                                <h1 class="max-w-2xl text-3xl/10 font-semibold tracking-tight text-cream sm:text-4xl/12">{{ title }}</h1>
                                <p v-if="description" class="mt-3 max-w-xl text-sm/6 text-zinc-500">{{ description }}</p>
                            </div>

                            <div v-if="cycle" class="flex shrink-0 flex-col items-start gap-2">
                                <div class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-ink-900 p-1">
                                    <button
                                        type="button"
                                        @click="billing = 'monthly'"
                                        class="rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none group-data-[cycle=monthly]/shell:bg-jade-500/15 group-data-[cycle=monthly]/shell:text-jade-300 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        Monthly
                                    </button>
                                    <button
                                        type="button"
                                        @click="billing = 'annual'"
                                        class="inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none group-data-[cycle=annual]/shell:bg-jade-500/15 group-data-[cycle=annual]/shell:text-jade-300 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    >
                                        Annual
                                        <span class="font-mono text-[10px] text-jade-400">−16%</span>
                                    </button>
                                </div>
                                <p class="font-mono text-[10px] text-zinc-600">
                                    {{ billing === 'annual' ? 'billed once, 12 months up front' : 'billed on the 1st, cancel any time' }}
                                </p>
                            </div>
                        </div>

                        <nav class="mt-8 flex flex-wrap items-center gap-1 text-sm">
                            <a
                                v-for="tab in tabs"
                                :key="tab.label"
                                :href="`/templates/pricing/screens/${tab.screen}`"
                                target="_top"
                                :aria-current="tab.label === active ? 'page' : null"
                                class="rounded-lg px-3 py-1.5 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                :class="tab.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                            >
                                {{ tab.label }}
                            </a>
                        </nav>
                    </div>
                </div>

                <main class="mx-auto w-full max-w-6xl grow px-5 py-10 sm:px-8">
                    <slot />
                </main>

                <footer class="border-t border-white/5 bg-ink-900/50">
                    <div class="mx-auto w-full max-w-6xl px-5 py-10 sm:px-8">
                        <div class="flex flex-wrap justify-between gap-x-10 gap-y-8">
                            <div class="max-w-xs">
                                <div class="flex items-center gap-2">
                                    <span class="grid size-6 place-items-center rounded-md bg-jade-500 font-mono text-[10px] font-bold text-ink-950">///</span>
                                    <span class="text-[13px] font-medium text-cream">wharf</span>
                                </div>
                                <p class="mt-3 text-[13px]/6 text-zinc-600">Commerce infrastructure for 1,284 storefronts, in three regions, billed by what they move.</p>
                            </div>

                            <div v-for="column in footer" :key="column.label">
                                <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ column.label }}</p>
                                <ul class="mt-3 flex flex-col gap-2">
                                    <li v-for="item in column.items" :key="item">
                                        <a href="#" class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">{{ item }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-10 flex flex-wrap items-center gap-x-4 gap-y-2 border-t border-white/5 pt-5 font-mono text-[10px] text-zinc-600">
                            <span>© 2026 Wharf Systems</span>
                            <span class="inline-flex items-center gap-1.5">
                                <span class="size-1.5 rounded-full bg-jade-400"></span>
                                all regions operational
                            </span>
                            <span class="ml-auto">SOC 2 Type II · ISO 27001 · GDPR</span>
                        </div>
                    </div>
                </footer>
            </div>

            <UiScrollTop anchor="container" variant="progress" :threshold="300" />
        </div>
    </div>
</template>
