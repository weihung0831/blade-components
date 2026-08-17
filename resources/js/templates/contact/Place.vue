<script setup>
defineProps({
    name: { type: String, required: true },
    tag: { type: String, default: null },
    lines: { type: Array, default: () => [] },
    hours: { type: Array, default: () => [] },
    travel: { type: Array, default: () => [] },
    note: { type: String, default: null },
    map: { type: Boolean, default: false },
    mapLabel: { type: String, default: 'map of the lane' },
});
</script>

<template>
    <div class="overflow-hidden rounded-xl border border-white/8 bg-ink-900">
        <div v-if="map" class="border-b border-white/5 bg-ink-950 p-3">
            <div class="flex aspect-2/1 items-center justify-center rounded-lg border border-dashed border-white/12">
                <span class="font-mono text-[10px] text-zinc-700">{{ mapLabel }}</span>
            </div>
        </div>

        <div class="p-4">
            <div class="flex items-baseline gap-2">
                <p class="text-[13px] font-medium text-cream">{{ name }}</p>
                <span v-if="tag" class="ml-auto rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">{{ tag }}</span>
            </div>

            <p v-if="lines.length > 0" class="mt-2 text-[12px]/5 text-zinc-400">
                <template v-for="(line, index) in lines" :key="line">
                    {{ line }}<br v-if="index < lines.length - 1">
                </template>
            </p>

            <div v-if="hours.length > 0" class="mt-3.5 border-t border-white/5 pt-3">
                <div v-for="entry in hours" :key="entry.when" class="flex items-baseline gap-3 py-1">
                    <span class="w-20 shrink-0 font-mono text-[11px] text-zinc-500">{{ entry.when }}</span>
                    <span class="text-[12px]/5 text-zinc-400">{{ entry.what }}</span>
                </div>
            </div>

            <div v-if="travel.length > 0" class="mt-3.5 border-t border-white/5 pt-3">
                <div v-for="entry in travel" :key="entry.mode" class="flex gap-3 py-1">
                    <span class="w-20 shrink-0 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ entry.mode }}</span>
                    <span class="text-[12px]/5 text-zinc-500">{{ entry.detail }}</span>
                </div>
            </div>

            <p v-if="note" class="mt-3.5 border-t border-white/5 pt-3 text-[12px]/5 text-zinc-500">{{ note }}</p>

            <slot />
        </div>
    </div>
</template>
