<script setup>
import { computed, ref, watch } from 'vue';

const props = defineProps({
    number: { type: Number, default: null },
    question: { type: String, required: true },
    topic: { type: String, default: null },
    helpful: { type: Number, default: null },
    votes: { type: Number, default: 0 },
    updated: { type: String, default: null },
    open: { type: Boolean, default: false },
    stale: { type: Boolean, default: false },
});

const isOpen = ref(props.open);

watch(() => props.open, (value) => { isOpen.value = value; });

const tone = computed(() => {
    if (props.helpful === null) return 'text-zinc-600';
    if (props.helpful >= 85) return 'text-jade-300';

    return props.helpful >= 65 ? 'text-amber-300' : 'text-red-300';
});

const pad = (value) => String(value).padStart(2, '0');
</script>

<template>
    <details
        class="group/question relative border-b border-white/5"
        :open="isOpen"
        @toggle="isOpen = $event.target.open"
    >
        <span aria-hidden="true" class="absolute inset-y-0 left-0 w-0.5 bg-jade-400 transition-opacity duration-150" :class="isOpen ? 'opacity-100' : 'opacity-0'"></span>

        <summary class="flex cursor-pointer list-none items-baseline gap-3 py-3.5 pr-4 pl-4 outline-none transition-colors duration-150 hover:bg-white/4 focus-visible:bg-white/4 [&::-webkit-details-marker]:hidden">
            <span v-if="number !== null" class="w-6 shrink-0 font-mono text-[11px]" :class="isOpen ? 'text-jade-400' : 'text-zinc-700'">{{ pad(number) }}</span>

            <span class="min-w-0 flex-1">
                <span class="block text-[13px]/5" :class="isOpen ? 'text-cream' : 'text-zinc-300'">{{ question }}</span>

                <span class="mt-1.5 flex flex-wrap items-center gap-x-2.5 gap-y-1">
                    <span v-if="topic" class="font-mono text-[10px] text-zinc-700">{{ topic }}</span>

                    <template v-if="helpful !== null">
                        <span class="font-mono text-[10px]" :class="tone">{{ helpful }}% said this helped</span>
                        <span class="font-mono text-[10px] text-zinc-700">of {{ votes }}</span>
                    </template>

                    <span v-if="stale" class="rounded border border-amber-400/30 px-1 font-mono text-[9px] text-amber-300/80">needs a rewrite</span>
                </span>
            </span>

            <span class="flex shrink-0 items-center gap-3">
                <span v-if="updated" class="hidden font-mono text-[10px] text-zinc-700 sm:block">{{ updated }}</span>

                <svg class="size-3.5 shrink-0 transition-transform duration-200" :class="isOpen ? 'rotate-45 text-jade-400' : 'text-zinc-600'" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </span>
        </summary>

        <div class="pt-0.5 pr-4 pb-5 pl-4" :class="number !== null ? 'sm:pl-13' : ''">
            <div class="max-w-2xl space-y-3 text-[13px]/6 text-zinc-400">
                <slot />
            </div>

            <div v-if="$slots.footer" class="mt-4 max-w-2xl">
                <slot name="footer" />
            </div>
        </div>
    </details>
</template>
