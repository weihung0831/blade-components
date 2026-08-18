<script setup>
import { computed } from 'vue';

const props = defineProps({
    code: { type: String, default: '404' },
    headline: { type: String, required: true },
    sentence: { type: String, default: null },
    tone: { type: String, default: 'quiet' },
    stamp: { type: String, default: null },
    lines: { type: Array, default: () => [] },
});

const tones = {
    quiet: { code: 'text-white/12', rule: 'bg-white/10', stamp: 'text-zinc-600' },
    fault: { code: 'text-red-400/25', rule: 'bg-red-400/40', stamp: 'text-red-400' },
    held: { code: 'text-amber-400/25', rule: 'bg-amber-400/40', stamp: 'text-amber-300' },
    off: { code: 'text-jade-500/25', rule: 'bg-jade-500/40', stamp: 'text-jade-300' },
};

const mark = computed(() => tones[props.tone] ?? tones.quiet);
</script>

<template>
    <div :data-code="code" class="flex gap-5 sm:gap-7">
        <div class="flex shrink-0 flex-col items-center">
            <span class="font-mono text-[44px] leading-none font-bold tracking-tighter tabular-nums sm:text-[64px]" :class="mark.code">{{ code }}</span>
            <span class="mt-3 w-px flex-1" :class="mark.rule"></span>
        </div>

        <div class="min-w-0 flex-1 pt-1">
            <p v-if="stamp" class="font-mono text-[10px] tracking-wider uppercase" :class="mark.stamp">{{ stamp }}</p>

            <h1 class="mt-1.5 text-xl font-semibold tracking-tight text-balance text-cream sm:text-2xl">{{ headline }}</h1>

            <p v-if="sentence" class="mt-2.5 max-w-xl text-[13px]/6 text-zinc-400">{{ sentence }}</p>

            <dl v-if="lines.length" class="mt-4 grid max-w-lg grid-cols-[auto_minmax(0,1fr)] gap-x-4 gap-y-1.5 border-l border-white/8 pl-3.5">
                <template v-for="line in lines" :key="line.label">
                    <dt class="font-mono text-[10px] text-zinc-700">{{ line.label }}</dt>
                    <dd class="font-mono text-[11px] break-all text-zinc-500">{{ line.value }}</dd>
                </template>
            </dl>

            <slot />
        </div>
    </div>
</template>
