<script setup>
import { computed } from 'vue';

const props = defineProps({
    state: { type: String, default: 'same' },
    text: { type: String, required: true },
    note: { type: String, default: null },
});

const marks = {
    gone: { sign: '-', class: 'bg-red-400/6 text-red-400/90', sign_class: 'text-red-400/70' },
    new: { sign: '+', class: 'bg-jade-500/8 text-jade-300', sign_class: 'text-jade-400/70' },
    same: { sign: ' ', class: 'text-zinc-500', sign_class: 'text-zinc-700' },
};

const mark = computed(() => marks[props.state] ?? marks.same);
</script>

<template>
    <div :data-diff="state" class="flex items-baseline gap-2 px-3 py-1" :class="mark.class">
        <span class="w-2 shrink-0 font-mono text-[11px]" :class="mark.sign_class">{{ mark.sign }}</span>
        <code class="min-w-0 flex-1 font-mono text-[11px]/5 break-all whitespace-pre-wrap">{{ text }}</code>

        <span v-if="note" class="hidden shrink-0 font-mono text-[10px] text-zinc-700 sm:block">{{ note }}</span>
    </div>
</template>
