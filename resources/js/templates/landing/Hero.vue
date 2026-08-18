<script setup>
defineProps({
    eyebrow: { type: String, default: null },
    headline: { type: String, required: true },
    sentence: { type: String, default: null },
    price: { type: String, default: null },
    priceNote: { type: String, default: null },
    action: { type: String, default: null },
    actionNote: { type: String, default: null },
    second: { type: String, default: null },
    facts: { type: Array, default: () => [] },
});
</script>

<template>
    <section class="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)] lg:gap-12">
        <div class="min-w-0">
            <p v-if="eyebrow" class="flex items-center gap-2 font-mono text-[11px] tracking-wider text-jade-400 uppercase">
                <span class="h-px w-6 bg-jade-500/50"></span>
                {{ eyebrow }}
            </p>

            <h1 class="mt-4 max-w-2xl text-3xl leading-[1.1] font-semibold tracking-tight text-balance text-cream sm:text-[40px]">{{ headline }}</h1>

            <p v-if="sentence" class="mt-4 max-w-xl text-[14px]/7 text-zinc-400">{{ sentence }}</p>

            <div class="mt-7 flex flex-wrap items-center gap-3">
                <span v-if="price" class="flex items-baseline gap-1.5">
                    <span class="font-mono text-2xl font-semibold tracking-tight tabular-nums text-cream">{{ price }}</span>
                    <span v-if="priceNote" class="font-mono text-[10px] text-zinc-600">{{ priceNote }}</span>
                </span>

                <span v-if="price" class="h-6 w-px bg-white/10"></span>

                <a
                    v-if="action"
                    href="#"
                    target="_top"
                    class="group inline-flex items-center gap-2 rounded-xl bg-jade-500 px-4 py-2.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >
                    {{ action }}
                    <svg class="size-3.5 transition-transform duration-150 group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M3 8h9m0 0L8.5 4.5M12 8l-3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>

                <a
                    v-if="second"
                    href="#"
                    target="_top"
                    class="inline-flex items-center gap-2 rounded-xl border border-white/10 px-4 py-2.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                >{{ second }}</a>
            </div>

            <p v-if="actionNote" class="mt-3 font-mono text-[10px] text-zinc-600">{{ actionNote }}</p>

            <dl v-if="facts.length" class="mt-8 grid grid-cols-2 gap-x-6 gap-y-4 border-t border-white/6 pt-6 sm:grid-cols-4">
                <div v-for="fact in facts" :key="fact.label">
                    <dt class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ fact.label }}</dt>
                    <dd class="mt-1 font-mono text-[15px] tabular-nums text-cream">{{ fact.value }}</dd>
                    <dd v-if="fact.note" class="mt-0.5 text-[11px]/4 text-zinc-600">{{ fact.note }}</dd>
                </div>
            </dl>
        </div>

        <div v-if="$slots.default" class="min-w-0">
            <slot />
        </div>
    </section>
</template>
