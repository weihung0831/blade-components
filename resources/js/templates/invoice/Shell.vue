<script setup>
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';

defineProps({
    active: { type: String, default: 'The invoice' },
    outstanding: { type: String, default: 'NT$1,943,600' },
    padded: { type: Boolean, default: true },
});

const links = [
    { label: 'The invoice', screen: 'document' },
    { label: 'Writing one', screen: 'compose' },
    { label: 'What is owed', screen: 'ledger' },
    { label: 'Getting paid', screen: 'chase' },
];
</script>

<template>
    <div class="flex h-full w-full flex-col overflow-hidden bg-ink-950">
        <header class="shrink-0 border-b border-white/5 bg-ink-950">
            <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
                <a href="/templates/invoice/screens/document" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M6 3.5h9l3.5 3.5v13.5H6z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="M15 3.5V7h3.5" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="M9 12h6M9 15.5h4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <span class="flex flex-col leading-none">
                        <span class="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                        <span class="mt-0.5 font-mono text-[10px] text-zinc-600">billing, four people deep</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 lg:flex">
                    <a
                        v-for="link in links"
                        :key="link.label"
                        :href="`/templates/invoice/screens/${link.screen}`"
                        target="_top"
                        :aria-current="link.label === active ? 'page' : undefined"
                        class="rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                    >{{ link.label }}</a>
                </nav>

                <div class="ml-auto flex shrink-0 items-center gap-3">
                    <a href="/templates/invoice/screens/ledger" target="_top" class="hidden flex-col items-end leading-none transition-colors duration-150 hover:text-cream sm:flex">
                        <span class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">out there</span>
                        <span class="mt-1 font-mono text-[13px] tabular-nums text-zinc-300">{{ outstanding }}</span>
                    </a>

                    <a
                        href="/templates/invoice/screens/compose"
                        target="_top"
                        class="inline-flex items-center gap-2 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >Write one</a>
                </div>
            </div>

            <div v-if="$slots.toolbar" class="border-t border-white/5 px-4 py-2.5 sm:px-5">
                <slot name="toolbar" />
            </div>
        </header>

        <div class="relative flex min-h-0 flex-1 flex-col">
            <main v-if="padded" data-ui-scroll-region class="min-h-0 flex-1 overflow-y-auto px-4 py-8 sm:px-5">
                <slot />
            </main>
            <main v-else class="flex min-h-0 flex-1 flex-col overflow-hidden">
                <slot />
            </main>

            <UiScrollTop v-if="padded" anchor="container" variant="progress" :threshold="300" />
        </div>

        <footer class="shrink-0 border-t border-white/5 bg-ink-950 px-4 py-2.5 sm:px-5">
            <div class="mx-auto flex max-w-4xl flex-wrap items-center gap-x-4 gap-y-1.5">
                <span class="font-mono text-[10px] text-zinc-700">統一編號 54318207</span>
                <span class="text-[11px] text-zinc-600">Nomad Supply Ltd · No. 12, Ln. 44, Sec. 3, Bade Rd, Songshan, Taipei 105</span>
                <span class="ml-auto font-mono text-[10px] text-zinc-700">every figure here is what the customer is charged, to the dollar</span>
            </div>
        </footer>
    </div>
</template>
