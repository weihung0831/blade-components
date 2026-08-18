<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: { type: String, required: true },
    state: { type: String, default: 'off' },
    lead: { type: String, required: true },
    breaks: { type: String, required: true },
    items: { type: Array, default: () => [] },
    on: { type: Boolean, default: false },
});

const emit = defineEmits(['toggle']);

const locked = computed(() => props.state === 'locked');
const checked = computed(() => locked.value || props.on);
</script>

<template>
    <section class="flex flex-col gap-3.5 px-4 py-4 sm:flex-row sm:gap-5">
        <div class="order-2 min-w-0 flex-1 sm:order-1">
            <div class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                <h3 class="text-[13px] text-cream">{{ name }}</h3>
                <span v-if="locked" class="font-mono text-[10px] text-zinc-600">no switch — it is how the shop works</span>
                <span v-else class="font-mono text-[10px]" :class="checked ? 'text-jade-400/90' : 'text-zinc-600'">{{ checked ? 'on' : 'off' }}</span>
            </div>

            <p class="mt-1.5 text-[12px]/5 text-zinc-400">{{ lead }}</p>

            <p class="mt-2 border-l-2 border-white/10 pl-2.5 text-[11px]/5 text-zinc-500">
                <span class="font-mono text-[10px] text-zinc-700 uppercase">Without it</span><br>
                {{ breaks }}
            </p>

            <dl v-if="items.length" class="mt-2.5 flex flex-wrap gap-x-4 gap-y-1">
                <div v-for="item in items" :key="item.name" class="flex items-baseline gap-1.5">
                    <dt class="font-mono text-[10px] text-zinc-500">{{ item.name }}</dt>
                    <dd class="font-mono text-[10px] text-zinc-700">{{ item.life }}</dd>
                </div>
            </dl>
        </div>

        <div class="order-1 shrink-0 sm:order-2 sm:pt-0.5">
            <label class="inline-flex items-center gap-2.5" :class="locked ? 'pointer-events-none opacity-50' : 'cursor-pointer'">
                <input
                    type="checkbox"
                    role="switch"
                    class="peer sr-only"
                    :aria-label="name"
                    :checked="checked"
                    :disabled="locked"
                    @change="emit('toggle', $event.target.checked)"
                >
                <span class="relative h-5 w-9 rounded-full border border-white/10 bg-ink-800 transition-colors duration-200 ease-snap peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70 after:absolute after:top-1 after:left-1 after:size-2.5 after:rounded-full after:bg-zinc-400 after:transition-[translate,background-color] after:duration-200 after:ease-snap peer-checked:after:translate-x-4 peer-checked:after:bg-ink-950"></span>
            </label>
        </div>
    </section>
</template>
