<script setup>
defineProps({
    number: { type: String, required: true },
    issued: { type: String, required: true },
    due: { type: String, default: null },
    terms: { type: String, default: null },
    reference: { type: String, default: null },
    currency: { type: String, default: 'TWD' },
    title: { type: String, default: 'Invoice' },
});
</script>

<template>
    <article class="relative overflow-hidden rounded-2xl border border-white/10 bg-ink-900 shadow-2xl shadow-black/40">
        <span aria-hidden="true" class="absolute inset-x-0 top-0 h-0.5 bg-jade-500/60"></span>

        <header class="flex flex-col gap-6 border-b border-white/8 p-6 sm:flex-row sm:items-start sm:justify-between sm:p-8">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 size-7 shrink-0 text-jade-400" viewBox="0 0 24 24" fill="none">
                    <path d="M6 4h12l-2.2 8.5a4 4 0 0 1-3.9 3H12a4 4 0 0 1-3.9-3.1L6 4Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                    <path d="M12 15.5V20M9.5 20h5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>

                <div>
                    <p class="text-[15px] font-medium tracking-tight text-cream">Nomad Supply Ltd</p>
                    <p class="mt-1 text-[11px]/5 text-zinc-500">
                        No. 12, Ln. 44, Sec. 3, Bade Rd<br>
                        Songshan District, Taipei 105, Taiwan
                    </p>
                    <p class="mt-1.5 font-mono text-[10px] text-zinc-600">統一編號 54318207 · +886 2 2771 4180</p>
                </div>
            </div>

            <div class="sm:text-right">
                <p class="font-mono text-[11px] tracking-[0.2em] text-zinc-600 uppercase">{{ title }}</p>
                <p class="mt-1 font-mono text-xl font-semibold tracking-tight text-cream">{{ number }}</p>

                <dl class="mt-3 flex flex-col gap-1 sm:items-end">
                    <div class="flex items-baseline gap-3 sm:justify-end">
                        <dt class="font-mono text-[10px] text-zinc-700">issued</dt>
                        <dd class="font-mono text-[11px] text-zinc-400">{{ issued }}</dd>
                    </div>

                    <div v-if="due" class="flex items-baseline gap-3 sm:justify-end">
                        <dt class="font-mono text-[10px] text-zinc-700">due</dt>
                        <dd class="font-mono text-[11px] text-zinc-300">{{ due }}</dd>
                    </div>

                    <div v-if="terms" class="flex items-baseline gap-3 sm:justify-end">
                        <dt class="font-mono text-[10px] text-zinc-700">terms</dt>
                        <dd class="font-mono text-[11px] text-zinc-400">{{ terms }}</dd>
                    </div>

                    <div v-if="reference" class="flex items-baseline gap-3 sm:justify-end">
                        <dt class="font-mono text-[10px] text-zinc-700">your ref</dt>
                        <dd class="font-mono text-[11px] text-zinc-400">{{ reference }}</dd>
                    </div>

                    <div class="flex items-baseline gap-3 sm:justify-end">
                        <dt class="font-mono text-[10px] text-zinc-700">currency</dt>
                        <dd class="font-mono text-[11px] text-zinc-400">{{ currency }}</dd>
                    </div>
                </dl>
            </div>
        </header>

        <slot />
    </article>
</template>
