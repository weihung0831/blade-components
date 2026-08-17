<script setup>
import { computed } from 'vue';

const props = defineProps({
    item: { type: Object, required: true },
    editable: { type: Boolean, default: false },
});

const emit = defineEmits(['step', 'remove']);

const money = (value) => '$' + value.toLocaleString('en-US');

const total = computed(() => money(props.item.price * props.item.qty));
</script>

<template>
    <div class="flex gap-4" :class="editable ? 'py-5' : 'py-4'">
        <div class="dot-grid grid shrink-0 place-items-center rounded-xl border border-white/8 bg-ink-950" :class="editable ? 'size-16 sm:size-20' : 'size-12'">
            <svg class="text-zinc-700" :class="editable ? 'size-6' : 'size-5'" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.3"/>
                <circle cx="8.5" cy="10" r="1.5" stroke="currentColor" stroke-width="1.3"/>
                <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <div class="flex min-w-0 flex-1 flex-col">
            <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                <p class="text-cream" :class="editable ? 'text-[15px]' : 'text-[13px]'">{{ item.name }}</p>
                <p class="shrink-0 font-mono text-cream" :class="editable ? 'text-[15px]' : 'text-[13px]'">{{ total }}</p>
            </div>

            <p class="mt-1 font-mono text-[11px] text-zinc-600">{{ item.sku }}<template v-if="item.option"> · {{ item.option }}</template></p>

            <p v-if="item.meta" class="mt-1.5 text-[13px] text-zinc-500">{{ item.meta }}</p>

            <div v-if="editable" class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2">
                <div class="inline-flex items-center rounded-lg border border-white/10 bg-ink-950">
                    <button
                        type="button"
                        :aria-label="`One fewer ${item.name}`"
                        @click="emit('step', -1)"
                        class="grid size-8 place-items-center rounded-l-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >
                        <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6h7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </button>
                    <span class="w-8 text-center font-mono text-[13px] text-zinc-200">{{ item.qty }}</span>
                    <button
                        type="button"
                        :aria-label="`One more ${item.name}`"
                        @click="emit('step', 1)"
                        class="grid size-8 place-items-center rounded-r-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    >
                        <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M6 2.5v7M2.5 6h7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </button>
                </div>

                <span class="font-mono text-[11px] text-zinc-600" :class="item.qty < 2 && 'invisible'">{{ money(item.price) }} each</span>

                <button type="button" @click="emit('remove')"
                    class="ml-auto font-mono text-[11px] text-zinc-600 transition-colors duration-150 outline-none hover:text-red-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Remove</button>
            </div>

            <p v-else class="mt-1.5 font-mono text-[11px] text-zinc-600">
                × {{ item.qty }}<template v-if="item.qty > 1"> · {{ money(item.price) }} each</template>
            </p>
        </div>
    </div>
</template>
