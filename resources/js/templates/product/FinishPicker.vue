<script setup>
defineProps({
    detailed: { type: Boolean, default: false },
});

const finish = defineModel({ type: String, default: 'graphite' });

const finishes = [
    { key: 'graphite', label: 'Graphite', swatch: 'bg-finish-graphite', note: '12 left' },
    { key: 'cream', label: 'Cream', swatch: 'bg-finish-cream', note: '4 left' },
    { key: 'jade', label: 'Jade', swatch: 'bg-finish-jade', note: '+$120' },
];
</script>

<template>
    <div v-if="detailed" class="grid gap-2 sm:grid-cols-3" role="group" aria-label="Finish">
        <button
            v-for="item in finishes"
            :key="item.key"
            type="button"
            @click="finish = item.key"
            class="flex items-center gap-2.5 rounded-xl border bg-ink-900 px-3 py-2.5 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
            :class="finish === item.key ? 'border-jade-500/50 bg-jade-500/6' : 'border-white/8 hover:border-white/20'"
        >
            <span class="size-5 shrink-0 rounded-full ring-1 ring-white/15" :class="item.swatch"></span>
            <span class="min-w-0">
                <span class="block truncate text-[13px] text-zinc-300">{{ item.label }}</span>
                <span class="block truncate font-mono text-[10px] text-zinc-600">{{ item.note }}</span>
            </span>
        </button>
    </div>

    <div v-else class="flex items-center gap-1.5" role="group" aria-label="Finish">
        <button
            v-for="item in finishes"
            :key="item.key"
            type="button"
            :aria-label="item.label"
            @click="finish = item.key"
            class="rounded-full p-0.5 ring-1 transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
            :class="finish === item.key ? 'ring-jade-400' : 'ring-white/12 hover:ring-white/35'"
        >
            <span class="block size-4 rounded-full" :class="item.swatch"></span>
        </button>
    </div>
</template>
