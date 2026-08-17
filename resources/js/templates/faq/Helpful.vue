<script setup>
import { ref } from 'vue';

defineProps({
    helpful: { type: Number, default: 91 },
    votes: { type: Number, default: 212 },
    prompt: { type: String, default: 'Did this answer it?' },
});

const vote = ref(null);
</script>

<template>
    <div class="rounded-xl border border-white/8 bg-ink-900 px-4 py-3">
        <div class="flex flex-wrap items-center gap-x-4 gap-y-3">
            <p class="text-[13px] text-zinc-300">{{ prompt }}</p>

            <div class="flex items-center gap-1.5">
                <button
                    type="button"
                    class="cursor-pointer rounded-lg border px-3 py-1.5 text-[12px] transition-colors duration-150"
                    :class="vote === 'yes' ? 'border-jade-500/60 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-400 hover:border-jade-500/50 hover:text-cream'"
                    @click="vote = 'yes'"
                >It did</button>

                <button
                    type="button"
                    class="cursor-pointer rounded-lg border px-3 py-1.5 text-[12px] transition-colors duration-150"
                    :class="vote === 'no' ? 'border-amber-400/60 bg-amber-400/10 text-amber-300' : 'border-white/10 text-zinc-400 hover:border-amber-400/50 hover:text-cream'"
                    @click="vote = 'no'"
                >Not really</button>

                <span class="ml-1 hidden items-center gap-2 sm:flex">
                    <span class="block h-0.5 w-16 overflow-hidden rounded-full bg-white/10">
                        <span class="block h-full rounded-full bg-jade-500/70" :style="{ width: `${helpful}%` }"></span>
                    </span>
                    <span class="font-mono text-[10px] text-zinc-600">{{ helpful }}% of {{ votes.toLocaleString() }}</span>
                </span>
            </div>

            <p v-if="vote === 'no'" class="w-full text-[12px]/5 text-amber-200/80">
                Then it is our fault, not yours.
                <a href="/templates/faq/screens/ask" target="_top" class="text-amber-300 underline decoration-amber-400/40 underline-offset-3 transition-colors duration-150 hover:decoration-amber-300">Tell the desk what is missing</a>
                and whoever rewrites it will read exactly that sentence.
            </p>
        </div>
    </div>
</template>
