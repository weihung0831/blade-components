<script setup>
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';

defineProps({
    active: { type: String, default: 'The policy' },
    rail: { type: Boolean, default: true },
    padded: { type: Boolean, default: true },
});

const links = [
    { label: 'The policy', screen: 'policy' },
    { label: 'Send it back', screen: 'send' },
    { label: 'Where yours is', screen: 'progress' },
    { label: 'The ledger', screen: 'ledger' },
];

const windows = [
    { key: 'mind', title: 'Changed your mind', span: '30 days' },
    { key: 'broken', title: 'Arrived broken', span: '30 days' },
    { key: 'fault', title: 'Stopped working', span: '2 years' },
    { key: 'parts', title: 'Parts on the shelf', span: '10 years' },
];

const never = [
    'Charge a restocking fee',
    'Ask for the box it came in',
    'Refuse a return for a missing receipt',
    'Send you a credit note instead of money',
];
</script>

<template>
    <div class="flex h-full w-full flex-col overflow-hidden bg-ink-950">
        <header class="shrink-0 border-b border-white/5 bg-ink-950">
            <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
                <a href="/templates/refund/screens/policy" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M3.5 8.5 12 5l8.5 3.5v7L12 19l-8.5-3.5z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="M13.5 12H9m0 0 1.8-1.8M9 12l1.8 1.8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="flex flex-col leading-none">
                        <span class="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                        <span class="mt-0.5 font-mono text-[10px] text-zinc-600">nomadsupply.cc/refunds</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a
                        v-for="link in links"
                        :key="link.label"
                        :href="`/templates/refund/screens/${link.screen}`"
                        target="_top"
                        :aria-current="link.label === active ? 'page' : undefined"
                        class="rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                    >{{ link.label }}</a>
                </nav>

                <div class="ml-auto flex shrink-0 items-center gap-3">
                    <a
                        href="/templates/refund/screens/ledger"
                        target="_top"
                        class="hidden items-center gap-1.5 rounded-lg border border-white/10 px-2 py-1 font-mono text-[11px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream lg:flex"
                    >
                        <span class="size-1.5 rounded-full bg-jade-500"></span>
                        6 days to the bank, median
                    </a>

                    <a
                        href="/templates/refund/screens/send"
                        target="_top"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >Start a return</a>
                </div>
            </div>

            <div v-if="$slots.toolbar" class="border-t border-white/5 px-4 py-2.5 sm:px-5">
                <slot name="toolbar" />
            </div>
        </header>

        <div class="relative flex min-h-0 flex-1">
            <aside v-if="rail" class="hidden w-56 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                <div>
                    <p class="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">How long you have</p>
                    <nav class="mt-2 px-2">
                        <a
                            v-for="entry in windows"
                            :key="entry.key"
                            :href="`/templates/refund/screens/policy#window-${entry.key}`"
                            target="_top"
                            class="flex items-baseline gap-2 rounded-lg px-2 py-1.5 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            <span class="truncate">{{ entry.title }}</span>
                            <span class="ml-auto font-mono text-[10px] text-zinc-700">{{ entry.span }}</span>
                        </a>
                    </nav>

                    <p class="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we do not do</p>
                    <ul class="mt-2 space-y-1.5 px-4">
                        <li v-for="line in never" :key="line" class="flex gap-2 text-[11px]/5 text-zinc-600">
                            <span class="mt-1.5 h-px w-2 shrink-0 bg-zinc-700"></span>
                            <span>{{ line }}</span>
                        </li>
                    </ul>
                </div>

                <div class="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">Wei opens every box</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">The inspection is a person at a bench with the machine in bits, not a warehouse scanning a label.</p>
                    <a
                        href="/templates/contact/screens/desk"
                        target="_top"
                        class="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >Ask before you send</a>
                </div>
            </aside>

            <main v-if="padded" data-ui-scroll-region class="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">
                <slot />
            </main>
            <main v-else class="flex min-h-0 flex-1 flex-col overflow-hidden">
                <slot />
            </main>

            <UiScrollTop v-if="padded" anchor="container" variant="progress" :threshold="300" />
        </div>
    </div>
</template>
