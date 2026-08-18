<script setup>
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';

defineProps({
    active: { type: String, default: 'The desk' },
    rail: { type: Boolean, default: true },
    padded: { type: Boolean, default: true },
});

const links = [
    { label: 'The desk', screen: 'desk' },
    { label: 'Write in', screen: 'write' },
    { label: 'Visit', screen: 'visit' },
];

const routes = [
    { label: 'Warranty and repairs', reply: '47 min' },
    { label: 'Orders and delivery', reply: '2 h' },
    { label: 'Dealers and wholesale', reply: '1 day' },
    { label: 'Press and everything else', reply: '3 days' },
];
</script>

<template>
    <div class="flex h-full w-full flex-col overflow-hidden bg-ink-950">
        <header class="shrink-0 border-b border-white/5 bg-ink-950">
            <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
                <a href="/templates/contact/screens/desk" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M3.5 7.5h17v11h-17z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="m3.5 8 8.5 6 8.5-6" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="M8 4.5h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <span class="flex flex-col leading-none">
                        <span class="text-sm font-medium tracking-tight text-cream">Nomad Supply</span>
                        <span class="mt-0.5 font-mono text-[10px] text-zinc-600">nomadsupply.cc/contact</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a
                        v-for="link in links"
                        :key="link.label"
                        :href="`/templates/contact/screens/${link.screen}`"
                        target="_top"
                        :aria-current="link.label === active ? 'page' : undefined"
                        class="rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                    >{{ link.label }}</a>
                </nav>

                <div class="ml-auto flex shrink-0 items-center gap-3">
                    <span class="hidden items-center gap-1.5 rounded-lg border border-amber-400/25 bg-amber-400/8 px-2 py-1 font-mono text-[11px] text-amber-300/90 lg:flex">
                        <span class="size-1.5 rounded-full bg-amber-400"></span>
                        Bench shut · 04:12 in Taipei
                    </span>

                    <a
                        href="/templates/contact/screens/write"
                        target="_top"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >Write in</a>
                </div>
            </div>

            <div v-if="$slots.toolbar" class="border-t border-white/5 px-4 py-2.5 sm:px-5">
                <slot name="toolbar" />
            </div>
        </header>

        <div class="relative flex min-h-0 flex-1">
            <aside v-if="rail" class="hidden w-56 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                <div>
                    <p class="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where it lands</p>
                    <nav class="mt-2 px-2">
                        <a
                            v-for="entry in routes"
                            :key="entry.label"
                            href="/templates/contact/screens/write"
                            target="_top"
                            class="flex items-center gap-2 rounded-lg px-2 py-1.5 text-[13px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        >
                            <span class="truncate">{{ entry.label }}</span>
                            <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-700">{{ entry.reply }}</span>
                        </a>
                    </nav>

                    <p class="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Straight through</p>
                    <div class="mt-2 px-4">
                        <p class="font-mono text-[13px] text-cream">+886 2 2765 4418</p>
                        <p class="mt-1 text-[11px]/5 text-zinc-600">Tue to Thu, 14:00–17:00. Outside that it rings in an empty room and we would rather tell you than let you find out.</p>
                    </div>

                    <p class="mt-6 px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Counter</p>
                    <div class="mt-2 px-4">
                        <p class="text-[12px]/5 text-zinc-400">No. 12, Ln. 44, Sec. 3<br>Bade Rd, Songshan, Taipei</p>
                        <a
                            href="/templates/contact/screens/visit"
                            target="_top"
                            class="mt-1.5 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300"
                        >how to get in →</a>
                    </div>
                </div>

                <div class="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">Before you write</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">Six letters in ten have an answer already sitting on the help centre.</p>
                    <a
                        href="/templates/faq/screens/questions"
                        target="_top"
                        class="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >Look there first</a>
                </div>
            </aside>

            <main v-if="padded" data-contact-scroll data-ui-scroll-region class="min-h-0 flex-1 overflow-y-auto px-4 py-6 sm:px-5">
                <slot />
            </main>
            <main v-else class="flex min-h-0 flex-1 flex-col overflow-hidden">
                <slot />
            </main>

            <UiScrollTop v-if="padded" anchor="container" variant="progress" :threshold="300" />
        </div>
    </div>
</template>
