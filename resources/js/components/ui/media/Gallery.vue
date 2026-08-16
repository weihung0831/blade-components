<script setup>
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    variant: { type: String, default: 'grid' },
    columns: { type: Number, default: 3 },
});

const active = defineModel('active', { type: Number, default: 0 });

const grids = {
    2: 'grid-cols-2',
    3: 'grid-cols-3',
    4: 'grid-cols-2 sm:grid-cols-4',
};

const step =
    'grid size-8 cursor-pointer place-items-center rounded-full border border-white/10 bg-ink-950/70 text-cream backdrop-blur-sm transition-colors duration-150 outline-none hover:bg-ink-950 focus-visible:ring-2 focus-visible:ring-jade-500/70';

const dialog = ref(null);
const open = ref(false);

const current = computed(() => props.items[active.value] ?? {});

const go = (index) => {
    active.value = (index + props.items.length) % props.items.length;
};

const pick = (index) => {
    go(index);

    if (props.variant !== 'filmstrip') {
        open.value = true;
    }
};

const onKeydown = (event) => {
    if (!open.value) {
        return;
    }

    if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
        event.preventDefault();
        go(active.value + (event.key === 'ArrowRight' ? 1 : -1));
    }
};

watch(open, (value) => (value ? dialog.value.showModal() : dialog.value.close()));

onMounted(() => document.addEventListener('keydown', onKeydown));
onBeforeUnmount(() => document.removeEventListener('keydown', onKeydown));
</script>

<template>
    <div>
        <template v-if="variant === 'filmstrip'">
            <figure class="relative overflow-hidden rounded-xl border border-white/10 bg-ink-900">
                <button
                    type="button"
                    aria-label="Open full size"
                    class="block aspect-video w-full cursor-zoom-in outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 focus-visible:ring-inset"
                    @click="open = true"
                >
                    <img :src="current.src" :alt="current.alt ?? ''" class="size-full object-cover" />
                </button>
                <figcaption class="pointer-events-none absolute inset-x-0 bottom-0 bg-linear-to-t from-ink-950 via-ink-950/70 to-transparent px-4 pt-10 pb-3">
                    <p class="text-sm font-medium text-cream">{{ current.caption }}</p>
                    <p class="mt-0.5 font-mono text-[11px] text-zinc-400">{{ current.meta }}</p>
                </figcaption>
            </figure>

            <div class="mt-2 grid grid-cols-4 gap-1.5">
                <button
                    v-for="(item, index) in items"
                    :key="item.src"
                    type="button"
                    :aria-label="item.caption ?? `Image ${index + 1}`"
                    :data-active="index === active ? '' : null"
                    class="aspect-[4/3] cursor-pointer overflow-hidden rounded-md border border-white/10 opacity-50 transition-[opacity,border-color] duration-200 outline-none hover:opacity-90 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:border-jade-500 data-active:opacity-100"
                    @click="pick(index)"
                >
                    <img :src="item.src" alt="" loading="lazy" class="size-full object-cover" />
                </button>
            </div>
        </template>

        <div v-else class="grid gap-2" :class="grids[columns] ?? grids[3]">
            <button
                v-for="(item, index) in items"
                :key="item.src"
                type="button"
                :aria-label="item.caption ?? `Image ${index + 1}`"
                class="group relative aspect-square cursor-zoom-in overflow-hidden rounded-lg border border-white/10 bg-ink-900 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70"
                @click="pick(index)"
            >
                <img :src="item.src" :alt="item.alt ?? ''" loading="lazy" class="size-full object-cover transition-transform duration-500 ease-snap group-hover:scale-105" />
                <span
                    v-if="item.caption"
                    class="absolute inset-x-0 bottom-0 translate-y-full bg-linear-to-t from-ink-950 to-transparent px-3 pt-8 pb-2.5 text-left text-xs font-medium text-cream transition-transform duration-300 ease-snap group-hover:translate-y-0 group-focus-visible:translate-y-0"
                >
                    {{ item.caption }}
                </span>
            </button>
        </div>

        <dialog
            ref="dialog"
            class="m-auto w-[calc(100%-2.5rem)] max-w-3xl scale-95 overflow-hidden rounded-2xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-300 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/80 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-300 open:backdrop:opacity-100 starting:open:backdrop:opacity-0"
            @close="open = false"
            @click="$event.target === dialog && (open = false)"
        >
            <div class="relative">
                <img :src="current.src" :alt="current.alt ?? ''" class="aspect-video w-full bg-ink-950 object-contain" />
                <button type="button" aria-label="Previous image" :class="['absolute top-1/2 left-3 -translate-y-1/2', step]" @click="go(active - 1)">
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button type="button" aria-label="Next image" :class="['absolute top-1/2 right-3 -translate-y-1/2', step]" @click="go(active + 1)">
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
            <div class="flex items-center justify-between gap-4 border-t border-white/5 px-4 py-3">
                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-cream">{{ current.caption }}</p>
                    <p class="mt-0.5 truncate font-mono text-[11px] text-zinc-500">{{ current.meta }}</p>
                </div>
                <div class="flex shrink-0 items-center gap-3">
                    <span class="font-mono text-xs text-zinc-600">{{ active + 1 }} / {{ items.length }}</span>
                    <button
                        type="button"
                        aria-label="Close"
                        class="grid size-6 cursor-pointer place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                        @click="open = false"
                    >
                        <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    </button>
                </div>
            </div>
        </dialog>
    </div>
</template>
