<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    autoplay: { type: Number, default: 0 },
    loop: { type: Boolean, default: true },
    arrows: { type: Boolean, default: true },
    indicators: { type: Boolean, default: true },
    ratio: { type: String, default: 'aspect-video' },
});

const active = defineModel('active', { type: Number, default: 0 });

const arrow =
    'absolute top-1/2 grid size-8 -translate-y-1/2 cursor-pointer place-items-center rounded-full border border-white/10 bg-ink-950/70 text-cream backdrop-blur-sm transition-colors duration-150 outline-none hover:bg-ink-950 focus-visible:ring-2 focus-visible:ring-jade-500/70';

const go = (index) => {
    const count = props.items.length;

    active.value = props.loop ? (index + count) % count : Math.min(count - 1, Math.max(0, index));
};

const paused = ref(false);
let timer = null;

onMounted(() => {
    if (props.autoplay > 0) {
        timer = setInterval(() => paused.value || document.hidden || go(active.value + 1), props.autoplay);
    }
});

onBeforeUnmount(() => clearInterval(timer));
</script>

<template>
    <div
        role="region"
        aria-roledescription="carousel"
        @pointerenter="paused = true"
        @pointerleave="paused = false"
        @focusin="paused = true"
        @focusout="paused = false"
    >
        <div class="relative overflow-hidden rounded-xl border border-white/10 bg-ink-900">
            <div class="flex transition-transform duration-500 ease-snap" :style="{ transform: `translateX(-${active * 100}%)` }">
                <figure
                    v-for="(item, index) in items"
                    :key="item.src"
                    :class="['relative w-full shrink-0', ratio]"
                    :inert="index !== active"
                >
                    <img :src="item.src" :alt="item.alt ?? ''" class="size-full object-cover" />
                    <figcaption
                        v-if="item.caption"
                        class="absolute inset-x-0 bottom-0 bg-linear-to-t from-ink-950 via-ink-950/70 to-transparent px-4 pt-10 pb-4"
                    >
                        <p class="text-sm font-medium text-cream">{{ item.caption }}</p>
                        <p v-if="item.meta" class="mt-0.5 font-mono text-[11px] text-zinc-400">{{ item.meta }}</p>
                    </figcaption>
                </figure>
            </div>

            <template v-if="arrows">
                <button type="button" aria-label="Previous slide" :class="['left-3', arrow]" @click="go(active - 1)">
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button type="button" aria-label="Next slide" :class="['right-3', arrow]" @click="go(active + 1)">
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </template>
        </div>

        <div v-if="indicators" class="mt-3 flex justify-center gap-1.5">
            <button
                v-for="(item, index) in items"
                :key="item.src"
                type="button"
                :aria-label="`Slide ${index + 1}`"
                :data-active="index === active ? '' : null"
                class="h-1 w-1 cursor-pointer rounded-full bg-white/15 transition-[width,background-color] duration-300 ease-snap outline-none hover:bg-white/30 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:w-4 data-active:bg-jade-500"
                @click="go(index)"
            ></button>
        </div>
    </div>
</template>
