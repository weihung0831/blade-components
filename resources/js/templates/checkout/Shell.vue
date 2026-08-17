<script setup>
import { computed } from 'vue';
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';

const props = defineProps({
    active: { type: String, default: 'Cart' },
});

const ship = defineModel('ship', { type: String, default: 'standard' });

const steps = [
    { label: 'Cart', screen: 'cart', note: 'one box' },
    { label: 'Delivery', screen: 'delivery', note: 'address' },
    { label: 'Payment', screen: 'payment', note: 'card' },
    { label: 'Done', screen: 'confirmation', note: 'receipt' },
];

const current = computed(() => {
    const index = steps.findIndex((step) => step.label === props.active);

    return index === -1 ? 1 : index + 1;
});

const markerClasses = (number) => {
    if (number < current.value) {
        return 'bg-jade-500 text-ink-950';
    }

    return number === current.value ? 'border border-jade-500 text-jade-400' : 'border border-white/15 text-zinc-600';
};

const labelClasses = (number) => {
    if (number < current.value) {
        return 'text-zinc-400';
    }

    return number === current.value ? 'text-cream' : 'text-zinc-600';
};
</script>

<template>
    <div class="group/shell flex h-full w-full flex-col overflow-hidden bg-ink-950" :data-ship="ship">
        <div class="relative flex min-h-0 flex-1">
            <div data-ui-scroll-region class="flex min-w-0 flex-1 flex-col overflow-y-auto">
                <header class="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-4 border-b border-white/5 bg-ink-950/85 px-5 backdrop-blur sm:px-8">
                    <a href="/templates/product/screens/overview" target="_top" class="flex shrink-0 items-center gap-2.5">
                        <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                            <path d="M7 4h10l-1.5 5.5a4.5 4.5 0 0 1-7 0L7 4Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                            <path d="M12 13v7M8.5 20h7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                        </svg>
                        <span class="text-sm font-medium tracking-tight text-cream">NOMAD Supply</span>
                    </a>

                    <span class="hidden items-center gap-1.5 font-mono text-[10px] text-zinc-600 sm:inline-flex">
                        <svg class="size-3 text-jade-400" viewBox="0 0 16 16" fill="none">
                            <rect x="3.5" y="7" width="9" height="6" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                            <path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="currentColor" stroke-width="1.3"/>
                        </svg>
                        encrypted · 3-D Secure
                    </span>

                    <div class="ml-auto flex shrink-0 items-center gap-4">
                        <span class="hidden font-mono text-[10px] text-zinc-600 lg:block">cart held until 14:52</span>

                        <a href="/templates/product/screens/configure" target="_top"
                            class="text-[13px] text-zinc-500 transition-colors duration-150 hover:text-cream">Keep shopping</a>
                    </div>
                </header>

                <div class="sticky top-14 z-20 border-b border-white/5 bg-ink-950/85 backdrop-blur">
                    <div class="mx-auto w-full max-w-6xl px-5 sm:px-8">
                        <ol class="flex items-stretch gap-1 overflow-x-auto py-2.5">
                            <li v-for="(step, index) in steps" :key="step.label" class="flex shrink-0 items-center gap-1">
                                <a
                                    :href="`/templates/checkout/screens/${step.screen}`"
                                    target="_top"
                                    :aria-current="index + 1 === current ? 'step' : null"
                                    class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                                    :class="index + 1 === current ? 'bg-white/8' : 'hover:bg-white/5'"
                                >
                                    <span class="grid size-6 shrink-0 place-items-center rounded-full font-mono text-[11px]" :class="markerClasses(index + 1)">
                                        <svg v-if="index + 1 < current" class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <template v-else>{{ index + 1 }}</template>
                                    </span>

                                    <span class="flex flex-col">
                                        <span class="text-[13px]/4" :class="labelClasses(index + 1)">{{ step.label }}</span>
                                        <span class="font-mono text-[10px] text-zinc-600">{{ step.note }}</span>
                                    </span>
                                </a>

                                <span v-if="index < steps.length - 1" aria-hidden="true" class="h-px w-5 shrink-0"
                                    :class="index + 1 < current ? 'bg-jade-500/50' : 'bg-white/10'"></span>
                            </li>
                        </ol>
                    </div>
                </div>

                <main class="mx-auto w-full max-w-6xl grow px-5 py-8 sm:px-8">
                    <slot />
                </main>

                <footer class="border-t border-white/5 bg-ink-900/50">
                    <div class="mx-auto flex w-full max-w-6xl flex-wrap items-center gap-x-5 gap-y-3 px-5 py-6 font-mono text-[10px] text-zinc-600 sm:px-8">
                        <span>© 2026 NOMAD Supply Co. · tax ID 24681357</span>
                        <a href="#" class="transition-colors duration-150 hover:text-cream">Returns</a>
                        <a href="#" class="transition-colors duration-150 hover:text-cream">Privacy</a>
                        <a href="#" class="transition-colors duration-150 hover:text-cream">Reach a person</a>
                        <span class="ml-auto inline-flex items-center gap-1.5">
                            <span class="size-1.5 rounded-full bg-jade-400"></span>
                            payments settling normally
                        </span>
                    </div>
                </footer>
            </div>

            <UiScrollTop anchor="container" variant="progress" :threshold="300" />
        </div>
    </div>
</template>
