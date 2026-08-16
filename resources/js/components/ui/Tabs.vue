<script setup>
import { computed } from 'vue';

const props = defineProps({
    items: { type: Array, default: () => [] },
    variant: { type: String, default: 'line' },
});

const active = defineModel('active', { type: String, default: null });

const lists = {
    line: 'flex items-center gap-6 border-b border-white/8',
    pill: 'inline-flex items-center gap-1 rounded-lg border border-white/10 bg-ink-950 p-1',
};

const tabs = {
    line: '-mb-px border-b-2 border-transparent pb-2.5 text-zinc-500 hover:text-zinc-300 data-active:border-jade-500 data-active:text-cream',
    pill: 'rounded-md px-3 py-1.5 text-zinc-500 hover:text-zinc-300 data-active:bg-white/10 data-active:text-cream',
};

const current = computed(() => active.value ?? props.items[0]?.value);
const listClasses = computed(() => lists[props.variant] ?? lists.line);
const tabClasses = computed(() => tabs[props.variant] ?? tabs.line);
</script>

<template>
    <div>
        <div role="tablist" :class="listClasses">
            <button
                v-for="item in items"
                :key="item.value"
                type="button"
                role="tab"
                :aria-selected="item.value === current"
                :data-active="item.value === current ? '' : null"
                :class="[
                    'inline-flex cursor-pointer items-center gap-2 text-sm font-medium transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                    tabClasses,
                ]"
                @click="active = item.value"
            >
                {{ item.label }}
                <span v-if="item.badge" class="rounded-full bg-white/8 px-1.5 font-mono text-[10px] text-zinc-400">{{ item.badge }}</span>
            </button>
        </div>
        <slot :name="current" />
    </div>
</template>
