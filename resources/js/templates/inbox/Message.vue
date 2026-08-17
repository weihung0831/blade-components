<script setup>
import { computed } from 'vue';
import InboxAvatar from './Avatar.vue';

const props = defineProps({
    message: { type: Object, required: true },
});

const bubbles = {
    outbound: 'border-jade-500/25 bg-jade-500/8',
    note: 'border-dashed border-amber-400/30 bg-amber-400/5',
    inbound: 'border-white/8 bg-ink-900',
};

const outbound = computed(() => props.message.kind === 'outbound');
const note = computed(() => props.message.kind === 'note');
const bubble = computed(() => bubbles[props.message.kind] ?? bubbles.inbound);
</script>

<template>
    <div v-if="message.kind === 'event'" class="flex items-center gap-2.5 py-1 pl-3">
        <span aria-hidden="true" class="size-1 shrink-0 rounded-full bg-zinc-700"></span>
        <p class="font-mono text-[10px] text-zinc-600">{{ message.body.join(' ') }}</p>
        <span aria-hidden="true" class="h-px min-w-4 flex-1 bg-white/5"></span>
        <span v-if="message.time" class="shrink-0 font-mono text-[10px] text-zinc-700">{{ message.time }}</span>
    </div>

    <article v-else class="flex gap-3" :class="outbound ? 'flex-row-reverse' : ''">
        <InboxAvatar
            :name="message.author"
            size="md"
            :kind="message.kind === 'inbound' ? 'customer' : 'agent'"
            :meta="message.role"
            class="mt-1"
        />

        <div class="min-w-0 max-w-[44rem] flex-1">
            <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5" :class="outbound ? 'flex-row-reverse' : ''">
                <span class="text-[13px] font-medium text-cream">{{ message.author }}</span>
                <span v-if="message.role" class="font-mono text-[10px] text-zinc-600">{{ message.role }}</span>
                <span class="font-mono text-[10px] text-zinc-700">{{ message.time }}</span>
            </div>

            <div class="mt-1.5 rounded-xl border px-3.5 py-3" :class="bubble">
                <p v-if="note" class="mb-2 flex items-center gap-1.5 font-mono text-[10px] tracking-wide text-amber-300/80 uppercase">
                    <svg class="size-3" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M11.5 2.5 13.5 4.5 6 12l-3 1 1-3z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                    </svg>
                    internal note — the customer never sees this
                </p>

                <div class="space-y-2.5 text-[13px]/6 text-zinc-300">
                    <p v-for="(paragraph, index) in message.body" :key="index">{{ paragraph }}</p>
                </div>

                <div v-if="message.attachments?.length" class="mt-3 flex flex-wrap gap-1.5 border-t border-white/5 pt-3">
                    <span
                        v-for="file in message.attachments"
                        :key="file.name"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1 font-mono text-[10px] text-zinc-400"
                    >
                        <svg class="size-3 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M9 2.5H4.5v11h7V5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M9 2.5V5h2.5" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                        </svg>
                        {{ file.name }}
                        <span class="text-zinc-700">{{ file.size }}</span>
                    </span>
                </div>
            </div>

            <div class="mt-1 flex items-center gap-2" :class="outbound ? 'justify-end' : ''">
                <span v-if="message.via" class="font-mono text-[10px] text-zinc-700">{{ message.via }}</span>
                <span v-if="message.seen" class="font-mono text-[10px] text-jade-400/70">{{ message.seen }}</span>
            </div>
        </div>
    </article>
</template>
