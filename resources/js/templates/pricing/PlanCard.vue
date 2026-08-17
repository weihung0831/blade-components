<script setup>
import UiButton from '../../components/ui/actions/Button.vue';
import UiSeparator from '../../components/ui/data-display/Separator.vue';

defineProps({
    name: { type: String, required: true },
    tagline: { type: String, required: true },
    monthly: { type: String, required: true },
    annual: { type: String, default: null },
    period: { type: String, default: '/ mo' },
    annualNote: { type: String, default: null },
    unit: { type: String, default: null },
    cta: { type: String, default: 'Start a trial' },
    ctaVariant: { type: String, default: 'secondary' },
    badge: { type: String, default: null },
    features: { type: Array, default: () => [] },
    meta: { type: String, default: null },
    featured: { type: Boolean, default: false },
});
</script>

<template>
    <article
        class="relative flex flex-col rounded-2xl border p-6"
        :class="featured ? 'border-jade-500/40 bg-jade-500/6 shadow-xl shadow-jade-950/20' : 'border-white/8 bg-ink-900'"
    >
        <span
            v-if="badge"
            class="absolute -top-2.5 right-6 rounded-full px-2.5 py-0.5 font-mono text-[10px] tracking-wider uppercase"
            :class="featured ? 'bg-jade-500 text-ink-950' : 'border border-white/10 bg-ink-950 text-zinc-500'"
        >
            {{ badge }}
        </span>

        <h3 class="text-lg font-semibold tracking-tight" :class="featured ? 'text-jade-300' : 'text-cream'">{{ name }}</h3>
        <p class="mt-1.5 min-h-12 text-[13px]/6 text-zinc-500">{{ tagline }}</p>

        <div class="mt-6 flex items-baseline gap-1.5">
            <span class="text-3xl font-semibold tracking-tight text-cream">
                <span :class="annual !== null && 'group-data-[cycle=annual]/shell:hidden'">{{ monthly }}</span>
                <span v-if="annual !== null" class="hidden group-data-[cycle=annual]/shell:inline">{{ annual }}</span>
            </span>
            <span v-if="period" class="font-mono text-xs text-zinc-600">{{ period }}</span>
        </div>

        <p class="mt-2 min-h-8 font-mono text-[11px]/5 text-zinc-600">
            <span v-if="unit" class="block text-zinc-500">{{ unit }}</span>
            <span v-if="annualNote" class="hidden group-data-[cycle=annual]/shell:block">{{ annualNote }}</span>
        </p>

        <UiButton :variant="ctaVariant" class="mt-5 w-full">{{ cta }}</UiButton>

        <UiSeparator class="my-6" />

        <ul class="flex flex-col gap-2.5">
            <li v-for="feature in features" :key="feature.label" class="flex items-start gap-2.5">
                <svg class="mt-1 size-3 shrink-0" :class="featured ? 'text-jade-400' : 'text-zinc-600'" viewBox="0 0 12 12" fill="none">
                    <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-[13px]/5 text-zinc-400">
                    {{ feature.label }}
                    <span v-if="feature.meta" class="ml-1 font-mono text-[11px] text-zinc-600">{{ feature.meta }}</span>
                </span>
            </li>
        </ul>

        <template v-if="meta">
            <div class="grow"></div>
            <p class="mt-6 border-t border-white/5 pt-4 font-mono text-[10px]/5 text-zinc-600">{{ meta }}</p>
        </template>
    </article>
</template>
