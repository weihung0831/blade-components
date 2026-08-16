<script setup>
import { computed } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    max: { type: Number, default: null },
    height: { type: String, default: 'h-40' },
    values: { type: Boolean, default: true },
    duration: { type: Number, default: 900 },
    stagger: { type: Number, default: 120 },
});

const ceiling = computed(() => props.max ?? Math.max(1, ...props.items.map((item) => Number(item.value))));

const percent = (item) => Math.min(100, Math.max(0, (Number(item.value) / ceiling.value) * 100));

const timing = (index) => ({
    animationDelay: `${index * props.stagger}ms`,
    '--ui-chart-duration': `${props.duration}ms`,
});
</script>

<template>
    <div class="w-full">
        <div :class="['flex items-end gap-2', height]">
            <div v-for="(item, index) in items" :key="item.label" class="relative flex h-full flex-1 items-end">
                <span
                    :class="[
                        'w-full origin-bottom rounded-t-sm animate-[ui-column-chart-grow_var(--ui-chart-duration)_var(--ease-snap)_both]',
                        item.highlight ? 'bg-jade-500' : 'bg-jade-500/30',
                    ]"
                    :style="{ height: `${percent(item)}%`, ...timing(index) }"
                ></span>

                <span
                    v-if="values"
                    class="absolute inset-x-0 text-center font-mono text-[10px] text-zinc-500 animate-[ui-column-chart-fade_var(--ui-chart-duration)_var(--ease-snap)_both]"
                    :style="{ bottom: `calc(${percent(item)}% + 6px)`, ...timing(index) }"
                    >{{ item.value }}</span
                >
            </div>
        </div>

        <div class="mt-1.5 h-px bg-white/10"></div>

        <div class="mt-1.5 flex gap-2">
            <span v-for="item in items" :key="item.label" class="flex-1 text-center font-mono text-[10px] text-zinc-600">
                {{ item.label }}
            </span>
        </div>
    </div>
</template>

<style>
@keyframes ui-column-chart-grow {
    from {
        transform: scaleY(0);
    }
}

@keyframes ui-column-chart-fade {
    from {
        opacity: 0;
    }
}

@media (prefers-reduced-motion: reduce) {
    [class*='ui-column-chart-'] {
        animation: none;
    }
}
</style>
