<script setup>
import { computed } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    max: { type: Number, default: null },
    values: { type: Boolean, default: true },
    duration: { type: Number, default: 900 },
    stagger: { type: Number, default: 120 },
    labelWidth: { type: String, default: 'w-16' },
});

const ceiling = computed(() => props.max ?? Math.max(1, ...props.items.map((item) => Number(item.value))));

const percent = (item) => Math.min(100, Math.max(0, (Number(item.value) / ceiling.value) * 100));

const timing = (index) => ({
    animationDelay: `${index * props.stagger}ms`,
    '--ui-chart-duration': `${props.duration}ms`,
});
</script>

<template>
    <div class="flex w-full flex-col gap-2.5">
        <div v-for="(item, index) in items" :key="item.label" class="flex items-center gap-3">
            <span :class="['shrink-0 text-right font-mono text-[10px] text-zinc-600', labelWidth]">{{ item.label }}</span>

            <div class="relative h-2.5 flex-1">
                <span
                    :class="[
                        'block h-full origin-left rounded-r-sm animate-[ui-bar-chart-grow_var(--ui-chart-duration)_var(--ease-snap)_both]',
                        item.highlight ? 'bg-jade-500' : 'bg-jade-500/30',
                    ]"
                    :style="{ width: `${percent(item)}%`, ...timing(index) }"
                ></span>

                <span
                    v-if="values"
                    class="absolute top-1/2 -translate-y-1/2 pl-2 font-mono text-[10px] text-zinc-500 animate-[ui-bar-chart-fade_var(--ui-chart-duration)_var(--ease-snap)_both]"
                    :style="{ left: `${percent(item)}%`, ...timing(index) }"
                    >{{ item.value }}</span
                >
            </div>
        </div>
    </div>
</template>

<style>
@keyframes ui-bar-chart-grow {
    from {
        transform: scaleX(0);
    }
}

@keyframes ui-bar-chart-fade {
    from {
        opacity: 0;
    }
}

@media (prefers-reduced-motion: reduce) {
    [class*='ui-bar-chart-'] {
        animation: none;
    }
}
</style>
