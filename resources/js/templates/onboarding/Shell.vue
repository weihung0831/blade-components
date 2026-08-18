<script setup>
import { computed } from 'vue';
import UiScrollTop from '../../components/ui/navigation/ScrollTop.vue';
import OnboardingStepper from './Stepper.vue';

const props = defineProps({
    active: { type: String, default: 'Setting up' },
    step: { type: String, default: 'region' },
    skipped: { type: Array, default: () => [] },
    interactive: { type: Boolean, default: false },
    rail: { type: Boolean, default: true },
    padded: { type: Boolean, default: true },
});

defineEmits(['jump']);

const links = [
    { label: 'Setting up', screen: 'setup' },
    { label: 'Bringing it over', screen: 'import' },
    { label: 'What is left', screen: 'checklist' },
    { label: 'Where people stop', screen: 'dropout' },
];

const plan = [
    { key: 'shop', label: 'The shop', note: 'Name, address, what you sell in.', minutes: '2 min' },
    { key: 'region', label: 'Where it lives', note: 'Which datacentre holds your orders. No moving it later.', minutes: '1 min' },
    { key: 'catalog', label: 'The catalog', note: 'A CSV out of the old platform, or start empty.', minutes: '19 min', optional: true },
    { key: 'people', label: 'The others', note: 'Two seats come with the plan.', minutes: '3 min', optional: true },
    { key: 'payouts', label: 'Getting paid', note: 'A bank account before the first order ships.', minutes: '6 min' },
];

const at = computed(() => {
    const index = plan.findIndex((entry) => entry.key === props.step);

    return index < 0 ? plan.length : index;
});

const steps = computed(() => plan.map((entry, index) => ({
    ...entry,
    state: props.skipped.includes(entry.key)
        ? 'skipped'
        : index < at.value ? 'done' : index === at.value ? 'current' : 'todo',
})));

const position = computed(() => Math.min(at.value + 1, plan.length));
</script>

<template>
    <div class="flex h-full w-full flex-col overflow-hidden bg-ink-950">
        <header class="shrink-0 border-b border-white/5 bg-ink-950">
            <div class="flex h-14 items-center gap-5 px-4 sm:px-5">
                <a href="/templates/onboarding/screens/setup" target="_top" class="flex shrink-0 items-center gap-2.5">
                    <svg class="size-6 text-jade-400" viewBox="0 0 24 24" fill="none">
                        <path d="M3.5 8.5 12 5l8.5 3.5v7L12 19l-8.5-3.5z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                        <path d="M12 12v7m0-7 8.5-3.5M12 12 3.5 8.5" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                    </svg>
                    <span class="flex flex-col leading-none">
                        <span class="text-sm font-medium tracking-tight text-cream">Kerouac Coffee</span>
                        <span class="mt-0.5 font-mono text-[10px] text-zinc-600">kerouac.nomadsupply.cc</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-1 md:flex">
                    <a
                        v-for="link in links"
                        :key="link.label"
                        :href="`/templates/onboarding/screens/${link.screen}`"
                        target="_top"
                        :aria-current="link.label === active ? 'page' : undefined"
                        class="rounded-lg px-2.5 py-1.5 text-[13px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        :class="link.label === active ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:bg-white/5 hover:text-cream'"
                    >{{ link.label }}</a>
                </nav>

                <div class="ml-auto flex shrink-0 items-center gap-3">
                    <span class="hidden items-center gap-1.5 font-mono text-[11px] text-zinc-600 lg:flex">
                        <span class="size-1.5 rounded-full bg-jade-500/70"></span>
                        saved 40 seconds ago
                    </span>

                    <span class="font-mono text-[11px] text-zinc-500">step {{ position }} of {{ plan.length }}</span>

                    <a
                        href="/templates/onboarding/screens/checklist"
                        target="_top"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >Leave it for now</a>
                </div>
            </div>

            <div class="h-0.5 w-full bg-white/5">
                <div class="h-full bg-jade-500 transition-[width] duration-300" :style="{ width: `${Math.round((position / plan.length) * 100)}%` }"></div>
            </div>

            <div v-if="$slots.toolbar" class="border-t border-white/5 px-4 py-2.5 sm:px-5">
                <slot name="toolbar" />
            </div>
        </header>

        <div class="relative flex min-h-0 flex-1">
            <aside v-if="rail" class="hidden w-64 shrink-0 flex-col justify-between overflow-y-auto border-r border-white/5 py-4 lg:flex">
                <div>
                    <p class="px-4 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The whole thing, up front</p>

                    <OnboardingStepper class="mt-3 px-4" :steps="steps" :interactive="interactive" @jump="$emit('jump', $event)" />

                    <p class="mt-2 border-t border-white/5 px-4 pt-3 text-[11px]/5 text-zinc-600">
                        31 minutes if you do all five. Most shops open in 12 because they skip the middle two and come back
                        to them in week three.
                    </p>
                </div>

                <div class="mx-2 mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">Nothing here is a lock-in</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">
                        Close the tab whenever. Every field is saved as you leave it, and the shop stays private until you
                        say otherwise.
                    </p>
                    <a
                        href="/templates/onboarding/screens/dropout"
                        target="_top"
                        class="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                    >How far people actually get</a>
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
