<script setup>
import { computed } from 'vue';

const props = defineProps({
    sent: { type: String, default: '02:41' },
    due: { type: String, default: '10:20' },
    shut: { type: Number, default: 409 },
    worked: { type: Number, default: 0 },
    left: { type: Number, default: 47 },
    lead: { type: String, default: null },
});

const total = computed(() => Math.max(1, props.shut + props.worked + props.left));

const span = (minutes) => `${(minutes / total.value * 100).toFixed(3)}%`;

const spell = (minutes) => {
    const hours = Math.floor(minutes / 60);

    return `${hours > 0 ? `${hours} h ` : ''}${minutes % 60} m`;
};

</script>

<template>
    <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
            <span class="font-mono text-xl text-cream">{{ due }}</span>
            <span class="text-[13px] text-zinc-400">{{ lead ?? 'is when a person should have got to it' }}</span>
            <span class="ml-auto font-mono text-[11px] text-zinc-700">sent {{ sent }}</span>
        </div>

        <div class="mt-3.5 flex h-1.5 overflow-hidden rounded-full bg-white/6">
            <span class="shrink-0 bg-white/5 bg-[repeating-linear-gradient(90deg,currentColor_0_1px,transparent_1px_5px)] text-white/18" :style="{ width: span(shut) }"></span>

            <span v-if="worked > 0" class="shrink-0 bg-jade-500/60" :style="{ width: span(worked) }"></span>
        </div>

        <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2">
            <span class="flex items-center gap-2">
                <span class="h-1.5 w-5 rounded-full bg-white/5 bg-[repeating-linear-gradient(90deg,currentColor_0_1px,transparent_1px_5px)] text-white/18"></span>
                <span class="font-mono text-[10px] text-zinc-600">{{ spell(shut) }} of it, the bench is shut</span>
            </span>

            <span class="flex items-center gap-2">
                <span class="h-1.5 w-5 rounded-full bg-jade-500/60"></span>
                <span class="font-mono text-[10px] text-zinc-600">{{ spell(worked) }} worked</span>
            </span>

            <span class="flex items-center gap-2">
                <span class="h-1.5 w-5 rounded-full bg-white/10"></span>
                <span class="font-mono text-[10px] text-zinc-600">{{ spell(left) }} still owed to you</span>
            </span>
        </div>
    </div>
</template>
