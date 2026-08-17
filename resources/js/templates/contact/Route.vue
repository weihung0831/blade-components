<script setup>
defineProps({
    name: { type: String, required: true },
    lead: { type: String, default: null },
    person: { type: String, default: null },
    reply: { type: String, default: null },
    window: { type: String, default: null },
    open: { type: Boolean, default: false },
    bring: { type: Array, default: () => [] },
    active: { type: Boolean, default: false },
    href: { type: String, default: '/templates/contact/screens/write' },
});
</script>

<template>
    <a
        :href="href"
        target="_top"
        class="group/route flex flex-col rounded-xl border bg-ink-900 p-4 outline-none transition-colors duration-150 focus-visible:ring-2 focus-visible:ring-jade-500/70"
        :class="active ? 'border-jade-500/60 bg-jade-500/8' : 'border-white/8 hover:border-white/15'"
    >
        <span class="flex items-baseline gap-2">
            <span class="text-[13px] font-medium group-hover/route:text-cream" :class="active ? 'text-cream' : 'text-zinc-300'">{{ name }}</span>

            <span class="ml-auto flex shrink-0 items-center gap-1.5">
                <span class="size-1.5 rounded-full" :class="open ? 'bg-jade-400' : 'bg-amber-400/70'"></span>
                <span class="font-mono text-[10px]" :class="open ? 'text-jade-400/90' : 'text-zinc-700'">{{ open ? 'reading now' : 'asleep' }}</span>
            </span>
        </span>

        <span v-if="lead" class="mt-1.5 text-[12px]/5 text-zinc-500">{{ lead }}</span>

        <span class="mt-3.5 flex items-end gap-3 border-t border-white/5 pt-3">
            <span class="flex flex-col">
                <span class="font-mono text-base text-cream">{{ reply }}</span>
                <span class="mt-0.5 font-mono text-[10px] text-zinc-700">median first reply</span>
            </span>

            <span class="ml-auto flex flex-col text-right">
                <span v-if="person" class="text-[12px] text-zinc-400">{{ person }}</span>
                <span v-if="window" class="mt-0.5 font-mono text-[10px] text-zinc-700">{{ window }}</span>
            </span>
        </span>

        <span v-if="bring.length > 0" class="mt-3 flex flex-wrap items-center gap-1.5">
            <span class="font-mono text-[10px] text-zinc-700">have ready</span>
            <span
                v-for="item in bring"
                :key="item"
                class="rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500"
            >{{ item }}</span>
        </span>
    </a>
</template>
