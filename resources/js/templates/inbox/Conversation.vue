<script setup>
import { computed, ref } from 'vue';
import InboxShell from './Shell.vue';
import InboxMessage from './Message.vue';
import InboxAvatar from './Avatar.vue';
import InboxTag from './Tag.vue';
import InboxClock from './Clock.vue';

const thread = {
    ref: 'NS-4471',
    subject: 'Grinder howls above 1800 rpm after three weeks',
    minutes: -40,
    tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Batch 40', tone: 'order' }, { label: 'Escalated', tone: 'escalated' }],
};

const messages = [
    { kind: 'event', internal: true, time: 'Tue 08:41', body: ['Web form · picked the "something is wrong with it" box · routed to Unassigned'] },
    { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 08:41', body: ['Three weeks old and it has started screaming past halfway on the dial. Espresso settings are where it is worst — anything coarser than that and I barely hear it.', 'I have recorded it. Is this the burrs bedding in, or is something actually wrong?'], attachments: [{ name: 'grinder-1800rpm.m4a', size: '1.2 MB' }, { name: 'dial-position.jpg', size: '1.8 MB' }] },
    { kind: 'event', internal: true, time: 'Tue 08:52', body: ['Hana Okabe took the thread out of Unassigned'] },
    { kind: 'outbound', author: 'Hana Okabe', role: 'front desk', time: 'Tue 08:53', seen: 'read Tue 09:18', body: ['That is not bedding in. Bedding in is a hiss that fades over a fortnight — what is on your clip is metal touching metal, and it should not.', 'Two things and then I can tell you exactly what happened: the serial off the underside plate, and roughly where the dial sits when it starts.'] },
    { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 09:20', body: ['NS-B40-0117, jade finish, bought straight from you on the 21st. It starts about a third of the way up and gets uglier from there.'] },
    { kind: 'note', author: 'Hana Okabe', role: 'front desk', time: 'Tue 09:24', internal: true, body: ['@Lena — B40 is the run where the seats came back shallow, isn\'t it? This is the third one this week that starts at the same place on the dial.'] },
    { kind: 'note', author: 'Lena Kohler', role: 'bench test', time: 'Tue 09:41', internal: true, body: ['Batch 40, yes. Seat depth is 0.15 shallow across the run, so the top burr sits proud and touches once the load comes on. It is not dangerous, it will eat the burr edge in a couple of months.', 'Workshop job NS-1102 is shimming 24 of them. We have kits on the shelf — no need to make him post the machine anywhere.'] },
    { kind: 'event', internal: true, time: 'Tue 09:42', body: ['Assigned to Lena Kohler · tagged Warranty · escalated'] },
    { kind: 'outbound', author: 'Lena Kohler', role: 'bench test', time: 'Tue 10:05', seen: 'read Tue 10:44', body: ['It is ours, and we already know about it. Your machine is from a run where the burr seats were cut 0.15 mm shallow — the top burr sits a fraction proud and touches under load. That is the noise.', 'You have two ways out and both are free. I post you a shim kit with a 3 mm hex and a card of instructions, twenty minutes at your kitchen table. Or you post the machine to us on our label and it comes back in about ten days.', 'If you would rather not open it, say so and I will send the label instead — no argument from me either way.'], attachments: [{ name: 'seat-shim-instructions.pdf', size: '620 KB' }] },
    { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 11:12', body: ['Send the kit. I would rather spend twenty minutes than ten days without it. How long before the noise comes back if I leave it as it is?'] },
    { kind: 'event', internal: true, time: '40m ago', body: ['Reply promise passed · 4h from Tue 11:12'] },
];

const related = [
    { ref: 'NS-4450', who: 'Kenji Sato', note: 'same batch, twice repaired' },
    { ref: 'NS-4402', who: 'Julia Brandt', note: 'same noise, took the shim kit' },
    { ref: 'NS-4388', who: 'Owen Pryce', note: 'same noise, sent it back' },
];

const facts = [
    ['Machine', 'NS-B40-0117'],
    ['Finish', 'Jade'],
    ['Shipped', '21 Mar, direct'],
    ['Warranty', 'runs to Mar 2028'],
    ['Lifetime', '€389, one machine'],
];

const hints = {
    reply: 'goes to tomas.ferreira@…pt · 04:12 where he is, so it will land with his morning',
    note: 'stays in the workshop — nobody outside this desk sees it',
    forward: 'picks a new recipient and takes the whole thread with it',
};

const placeholders = {
    reply: 'Answer him — the kit is on the shelf and he has already said yes',
    note: 'Leave it for whoever picks this up next',
    forward: 'Say why you are handing it on',
};

const view = ref('everything');
const mode = ref('reply');

const shown = computed(() => view.value === 'everything' ? messages : messages.filter((message) => !message.internal));
</script>

<template>
    <InboxShell active="Inbox" :rail="false" :padded="false">
        <div class="flex min-h-0 flex-1 overflow-hidden">
            <div class="flex min-w-0 flex-1 flex-col">
                <header class="shrink-0 border-b border-white/5 px-5 py-4">
                    <a href="/templates/inbox/screens/threads" target="_top" class="inline-flex items-center gap-1.5 font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">
                        <svg class="size-3" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Unassigned
                    </a>

                    <div class="mt-2 flex flex-wrap items-start gap-x-4 gap-y-3">
                        <div class="min-w-0 flex-1">
                            <h3 class="text-[17px] font-medium tracking-tight text-cream">{{ thread.subject }}</h3>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span class="font-mono text-[10px] text-zinc-600">{{ thread.ref }}</span>
                                <InboxTag v-for="tag in thread.tags" :key="tag.label" :label="tag.label" :tone="tag.tone" />
                                <InboxClock :minutes="thread.minutes" bar />
                            </div>
                        </div>

                        <div class="flex shrink-0 flex-wrap items-center gap-1.5">
                            <button type="button" class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <InboxAvatar name="Lena Kohler" size="xs" />
                                Lena has it
                            </button>
                            <button
                                v-for="action in ['Snooze', 'Merge', 'Close']"
                                :key="action"
                                type="button"
                                class="rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            >{{ action }}</button>
                        </div>
                    </div>
                </header>

                <div class="flex shrink-0 flex-wrap items-center gap-2 border-b border-white/5 px-5 py-2.5">
                    <label
                        v-for="[value, label, count] in [['everything', 'Everything', 11], ['sent', 'What they can see', 5]]"
                        :key="value"
                        class="cursor-pointer rounded-lg border px-2.5 py-1 font-mono text-[11px] transition-colors duration-150"
                        :class="view === value ? 'border-jade-500/60 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-500 hover:text-cream'"
                    >
                        <input v-model="view" type="radio" name="transcript-view" :value="value" class="sr-only">
                        {{ label }} <span class="text-zinc-700">{{ count }}</span>
                    </label>

                    <p class="ml-auto font-mono text-[10px] text-zinc-700">two hands on this one · 2h 31m from first touch to a real answer</p>
                </div>

                <div class="min-h-0 flex-1 space-y-4 overflow-y-auto px-5 py-6">
                    <InboxMessage v-for="(message, index) in shown" :key="index" :message="message" />
                </div>

                <footer class="shrink-0 border-t border-white/5 px-5 py-3.5">
                    <div
                        class="rounded-xl border bg-ink-900 transition-colors duration-150 focus-within:border-jade-500/50"
                        :class="mode === 'note' ? 'border-amber-400/40 bg-amber-400/5' : 'border-white/10'"
                    >
                        <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                            <label
                                v-for="[value, label] in [['reply', 'Reply'], ['note', 'Internal note'], ['forward', 'Forward']]"
                                :key="value"
                                class="cursor-pointer rounded-md px-2 py-1 font-mono text-[11px] transition-colors duration-150"
                                :class="mode === value ? 'bg-white/8 text-cream' : 'text-zinc-500 hover:text-cream'"
                            >
                                <input v-model="mode" type="radio" name="reply-mode" :value="value" class="sr-only">
                                {{ label }}
                            </label>

                            <span class="ml-auto font-mono text-[10px] text-zinc-600">{{ hints[mode] }}</span>
                        </div>

                        <textarea
                            rows="3"
                            :placeholder="placeholders[mode]"
                            class="w-full resize-none bg-transparent px-3.5 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:outline-none"
                        ></textarea>

                        <div class="flex flex-wrap items-center gap-2 border-t border-white/5 px-3 py-2">
                            <button
                                v-for="macro in ['Shim kit — dispatch', 'Warranty, no charge', 'Ask for the serial']"
                                :key="macro"
                                type="button"
                                class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                            >{{ macro }}</button>

                            <a href="/templates/inbox/screens/compose" target="_top" class="ml-auto inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">
                                Send and close
                            </a>
                        </div>
                    </div>
                </footer>
            </div>

            <aside class="hidden w-72 shrink-0 overflow-y-auto border-l border-white/5 px-4 py-5 xl:block">
                <div class="flex items-center gap-3">
                    <InboxAvatar name="Tomás Ferreira" size="lg" kind="customer" />
                    <div class="min-w-0">
                        <p class="truncate text-[13px] font-medium text-cream">Tomás Ferreira</p>
                        <p class="mt-0.5 font-mono text-[10px] text-zinc-600">Porto, PT · 04:12 there</p>
                    </div>
                </div>

                <dl class="mt-5 space-y-2.5 border-t border-white/5 pt-4">
                    <div v-for="[term, value] in facts" :key="term" class="flex items-baseline gap-3">
                        <dt class="font-mono text-[10px] text-zinc-700">{{ term }}</dt>
                        <dd class="ml-auto text-right font-mono text-[11px] text-zinc-400">{{ value }}</dd>
                    </div>
                </dl>

                <div class="mt-5 rounded-xl border border-amber-400/25 bg-amber-400/5 p-3">
                    <p class="font-mono text-[10px] tracking-wide text-amber-300/80 uppercase">Known fault</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-300">Batch 40 seats cut 0.15 mm shallow. 24 machines on the bench, kits in stock, no charge either way.</p>
                    <a href="/templates/kanban/screens/ticket" target="_top" class="mt-2.5 inline-flex items-center gap-1.5 font-mono text-[10px] text-amber-300 transition-colors duration-150 hover:text-amber-200">
                        workshop job NS-1102 →
                    </a>
                </div>

                <div class="mt-5">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Same batch, same noise</p>
                    <ul class="mt-2 space-y-1">
                        <li v-for="entry in related" :key="entry.ref">
                            <a href="/templates/inbox/screens/threads" target="_top" class="block rounded-lg px-2 py-1.5 transition-colors duration-150 hover:bg-white/5">
                                <span class="flex items-baseline gap-2">
                                    <span class="shrink-0 font-mono text-[10px] text-jade-400">{{ entry.ref }}</span>
                                    <span class="truncate text-[12px] text-zinc-400">{{ entry.who }}</span>
                                </span>
                                <span class="mt-0.5 block truncate font-mono text-[10px] text-zinc-700">{{ entry.note }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mt-5 border-t border-white/5 pt-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Before this</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-500">One thread, April, asking which basket fits a 58 mm portafilter. Answered in eleven minutes, closed happy.</p>
                </div>
            </aside>
        </div>
    </InboxShell>
</template>
