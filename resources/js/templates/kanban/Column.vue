<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    station: { type: Object, required: true },
    count: { type: Number, default: 0 },
});

const emit = defineEmits(['drop']);

const collapsed = ref(false);
const over = ref(false);

const limit = computed(() => props.station.limit ?? 0);
const overLimit = computed(() => limit.value > 0 && props.count > limit.value);
const fill = computed(() => (limit.value > 0 ? Math.min(100, (props.count / limit.value) * 100) : 0));

const onDrop = (event) => {
    over.value = false;
    emit('drop', event);
};
</script>

<template>
    <section class="flex shrink-0 flex-col transition-[width] duration-300 ease-snap" :class="collapsed ? 'w-12' : 'w-72'">
        <header class="shrink-0 px-1">
            <div class="flex items-center gap-2" :class="collapsed ? 'flex-col gap-3' : ''">
                <button
                    type="button"
                    class="grid size-5 shrink-0 place-items-center rounded text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                    @click="collapsed = !collapsed"
                >
                    <svg class="size-3.5 transition-transform duration-300 ease-snap" :class="collapsed ? 'rotate-180' : ''" viewBox="0 0 16 16" fill="none">
                        <path d="M10 4 6 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="sr-only">Collapse {{ station.name }}</span>
                </button>

                <h3 class="text-[13px] font-medium tracking-tight text-cream" :class="collapsed ? '[writing-mode:vertical-rl]' : ''">{{ station.name }}</h3>

                <span class="font-mono text-[11px]" :class="[collapsed ? '' : 'ml-auto', overLimit ? 'text-red-300' : 'text-zinc-600']">
                    {{ count }}<span v-if="limit" class="text-zinc-700">/{{ limit }}</span>
                </span>
            </div>

            <div v-show="!collapsed" class="mt-2.5">
                <div v-if="limit" class="h-0.5 w-full overflow-hidden rounded-full bg-white/8">
                    <span class="block h-full rounded-full transition-[width] duration-300 ease-snap" :class="overLimit ? 'bg-red-400' : 'bg-jade-500/70'" :style="{ width: `${fill}%` }"></span>
                </div>
                <div v-else class="h-0.5 w-full rounded-full bg-white/5"></div>

                <p class="mt-2 flex items-center gap-1.5 font-mono text-[10px] text-zinc-700">
                    <span v-if="station.machine" class="truncate">{{ station.machine }}</span>
                    <span v-if="overLimit" class="ml-auto shrink-0 text-red-300">over by {{ count - limit }}</span>
                    <span v-else-if="!limit" class="ml-auto shrink-0">no limit</span>
                </p>
            </div>
        </header>

        <div
            v-show="!collapsed"
            class="mt-2.5 flex min-h-24 flex-1 flex-col gap-2.5 overflow-y-auto rounded-xl border border-dashed p-1 transition-colors duration-150"
            :class="over ? 'border-jade-500/50 bg-jade-500/5' : 'border-transparent'"
            @dragover.prevent="over = true"
            @dragleave="over = false"
            @drop.prevent="onDrop"
        >
            <slot />

            <p v-if="count === 0" class="rounded-xl border border-dashed border-white/8 px-3 py-6 text-center font-mono text-[10px] text-zinc-700">drop a job here</p>
        </div>
    </section>
</template>
