<script setup>
import InboxAvatar from './Avatar.vue';
import InboxTag from './Tag.vue';
import InboxClock from './Clock.vue';

defineProps({
    thread: { type: Object, required: true },
    active: { type: Boolean, default: false },
});

const channels = {
    email: 'M2.5 4.5h11v7h-11zM2.5 5l5.5 4 5.5-4',
    form: 'M3.5 2.5h9v11h-9zM5.5 5.5h5M5.5 8h5M5.5 10.5h3',
    chat: 'M2.5 4.5h11v6h-6l-3 2.5v-2.5h-2z',
    phone: 'M4 2.8 5.8 6 4.6 7.4a7 7 0 0 0 4 4L10 10.2l3.2 1.8v2.2A11 11 0 0 1 1.8 2.8z',
};

const states = {
    open: null,
    waiting: 'waiting on them',
    snoozed: 'snoozed till Thu',
    closed: 'closed',
};
</script>

<template>
    <button
        type="button"
        class="group/thread relative block w-full cursor-pointer border-b border-white/5 py-3 pr-3 pl-4 text-left outline-none transition-colors duration-150 hover:bg-white/4 focus-visible:bg-white/4"
        :class="active ? 'bg-white/6' : ''"
    >
        <span aria-hidden="true" class="absolute inset-y-0 left-0 w-0.5 bg-jade-400 transition-opacity duration-150" :class="active ? 'opacity-100' : 'opacity-0'"></span>
        <span aria-hidden="true" class="absolute top-4.5 left-1.5 size-1.5 rounded-full bg-jade-400" :class="thread.unread && !active ? 'opacity-100' : 'opacity-0'"></span>

        <span class="flex items-start gap-2.5">
            <InboxAvatar :name="thread.from" size="md" kind="customer" :meta="thread.company" class="mt-0.5" />

            <span class="min-w-0 flex-1">
                <span class="flex items-baseline gap-2">
                    <span class="truncate text-[13px]" :class="thread.unread ? 'font-medium text-cream' : 'text-zinc-400'">{{ thread.from }}</span>
                    <span v-if="thread.company" class="hidden truncate font-mono text-[10px] text-zinc-600 sm:block">{{ thread.company }}</span>
                    <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600">{{ thread.time }}</span>
                </span>

                <span class="mt-1 flex items-center gap-1.5">
                    <svg class="size-3 shrink-0 text-zinc-700" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path :d="channels[thread.channel] ?? channels.email" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                    </svg>
                    <span class="truncate text-[13px]/5" :class="thread.unread ? 'text-cream' : 'text-zinc-300'">{{ thread.subject }}</span>
                    <span v-if="thread.count > 1" class="shrink-0 font-mono text-[10px] text-zinc-700">{{ thread.count }}</span>
                </span>

                <span v-if="thread.preview" class="mt-1 line-clamp-1 block text-[12px]/5 text-zinc-600">{{ thread.preview }}</span>

                <span class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1.5">
                    <InboxTag v-for="tag in thread.tags" :key="tag.label" :label="tag.label" :tone="tag.tone" />

                    <span v-if="states[thread.state]" class="font-mono text-[10px] text-zinc-600">{{ states[thread.state] }}</span>

                    <span class="ml-auto flex items-center gap-2.5">
                        <InboxClock v-if="thread.minutes !== null && thread.minutes !== undefined" :minutes="thread.minutes" compact />

                        <InboxAvatar v-if="thread.assignee" :name="thread.assignee" size="xs" />
                        <span v-else class="grid size-5 place-items-center rounded-full border border-dashed border-white/15 font-mono text-[9px] text-zinc-700">?</span>
                    </span>
                </span>
            </span>
        </span>
    </button>
</template>
