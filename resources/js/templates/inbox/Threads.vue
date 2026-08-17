<script setup>
import { computed, ref } from 'vue';
import InboxShell from './Shell.vue';
import InboxThread from './Thread.vue';
import InboxMessage from './Message.vue';
import InboxAvatar from './Avatar.vue';
import InboxTag from './Tag.vue';
import InboxClock from './Clock.vue';

const threads = ref([
    {
        ref: 'NS-4471', from: 'Tomás Ferreira', company: null, subject: 'Grinder howls above 1800 rpm after three weeks',
        preview: 'It starts around the middle of the dial and gets worse on lighter roasts. Sound clip attached.',
        tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Batch 40', tone: 'order' }],
        minutes: -40, unread: true, assignee: null, count: 4, time: '11:12', channel: 'form', state: 'open',
        customer: ['Porto, PT', 'NS-B40-0117', 'bought 21 Mar', '€389'],
        messages: [
            { kind: 'event', time: 'Tue 08:41', body: ['Web form · routed to Unassigned'] },
            { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 08:41', body: ['Three weeks old and it has started screaming past halfway on the dial. Fine espresso setting is where it is worst.', 'I have recorded it. Is this normal bedding-in noise or is something wrong?'], attachments: [{ name: 'grinder-1800rpm.m4a', size: '1.2 MB' }] },
            { kind: 'outbound', author: 'Hana Okabe', role: 'front desk', time: 'Tue 08:53', body: ['Not normal, and thank you for the recording — that is a metal-on-metal note, not run-in.', 'Can you read me the serial from the underside plate?'], seen: 'read Tue 09:18' },
            { kind: 'inbound', author: 'Tomás Ferreira', time: 'Tue 11:12', body: ['NS-B40-0117. Bought it from you directly, jade finish.'] },
        ],
    },
    {
        ref: 'NS-4468', from: 'Kenta Mori', company: 'Osaka Roast Supply', subject: 'Batch 40 landed — 48 units, no invoice in the crate',
        preview: 'Units are fine, count is right. Accounts cannot pay against a packing slip.',
        tags: [{ label: 'Dealer', tone: 'dealer' }, { label: 'Batch 40', tone: 'order' }],
        minutes: 80, unread: false, assignee: 'Idris Bahar', count: 5, time: '10:04', channel: 'email', state: 'open',
        customer: ['Osaka, JP', 'PO-2211', 'dealer since 2023', '48 units a quarter'],
        messages: [
            { kind: 'inbound', author: 'Kenta Mori', time: '09:31', body: ['All 48 arrived Thursday, count matches. The crate only had the packing slip — accounts will not release payment without the invoice.'] },
            { kind: 'note', author: 'Idris Bahar', role: 'shipping', time: '09:48', body: ['Invoice went out with the Osaka paperwork on the 12th. Checking whether it got stapled to the wrong pallet.'] },
            { kind: 'outbound', author: 'Idris Bahar', role: 'shipping', time: '10:04', body: ['Reissuing it today against PO-2211, same terms, 30 days from the delivery date rather than the invoice date.'], attachments: [{ name: 'INV-40118.pdf', size: '84 KB' }] },
        ],
    },
    {
        ref: 'NS-4465', from: 'Anja Lindqvist', company: null, subject: 'Ordered jade, opened graphite',
        preview: 'The box label says jade. The grinder inside is not jade.',
        tags: [{ label: 'Order', tone: 'order' }],
        minutes: 130, unread: true, assignee: 'Hana Okabe', count: 2, time: '09:41', channel: 'email', state: 'open',
        customer: ['Malmö, SE', 'NS-B41-0043', 'bought 2 Aug', '€389'],
        messages: [
            { kind: 'inbound', author: 'Anja Lindqvist', time: '09:41', body: ['Label on the box says jade. What came out of it is graphite. Happy to keep it if you knock something off, otherwise I would like the one I ordered.'], attachments: [{ name: 'box-and-grinder.jpg', size: '2.4 MB' }] },
            { kind: 'note', author: 'Mei Tsai', role: 'workshop', time: '09:52', body: ['Serial is from the run we packed on the 2nd — two jade and two graphite went out swapped that afternoon. The other three are already back.'] },
        ],
    },
    {
        ref: 'NS-4462', from: 'Bruno Sacchi', company: null, subject: 'Can I buy the dosing cup on its own?',
        preview: 'Dropped mine on tile. The lip is cracked, everything else is fine.',
        tags: [{ label: 'Parts', tone: 'plain' }],
        minutes: 205, unread: false, assignee: null, count: 1, time: '09:12', channel: 'form', state: 'open',
        customer: ['Bologna, IT', 'NS-B38-0210', 'bought Nov 2024', '€389'],
        messages: [
            { kind: 'inbound', author: 'Bruno Sacchi', time: '09:12', body: ['Dropped it on a tile floor. The cup lip is cracked, the grinder is untouched. I do not need a whole machine, I need a cup.'] },
        ],
    },
    {
        ref: 'NS-4459', from: 'Wei-Ting Kao', company: 'Taipei Coffee Fair', subject: 'Six show units — can we take them Wednesday instead?',
        preview: 'Hall access moved forward a day. Thursday van would land after the doors open.',
        tags: [{ label: 'Dealer', tone: 'dealer' }],
        minutes: 55, unread: false, assignee: 'Idris Bahar', count: 3, time: 'Tue', channel: 'email', state: 'open',
        customer: ['Taipei, TW', 'PO-2240', 'third year', 'NT$74,000'],
        messages: [
            { kind: 'inbound', author: 'Wei-Ting Kao', time: 'Tue 16:20', body: ['Hall access moved to Wednesday morning. If the van comes Thursday the stand is empty when the doors open.'] },
            { kind: 'note', author: 'Idris Bahar', role: 'shipping', time: 'Tue 16:44', body: ['Six units are packed. Wednesday means someone drives them up — two hours each way, and the Thursday run still has to happen for the rest.'] },
        ],
    },
    {
        ref: 'NS-4455', from: 'Marta Nowak', company: null, subject: 'Refund, day 12 of 14',
        preview: 'Nothing wrong with it. It is louder than my flat allows at 6am.',
        tags: [{ label: 'Refund', tone: 'plain' }],
        minutes: null, unread: false, assignee: 'Hana Okabe', count: 4, time: 'Tue', channel: 'email', state: 'waiting',
        customer: ['Kraków, PL', 'NS-B40-0088', 'bought 5 Aug', '€389'],
        messages: [
            { kind: 'outbound', author: 'Hana Okabe', role: 'front desk', time: 'Tue 14:02', body: ['Label is attached, no charge. Refund lands two working days after it reaches the workshop.'], attachments: [{ name: 'return-label-4455.pdf', size: '41 KB' }], seen: 'read Tue 14:30' },
            { kind: 'event', time: '18h', body: ['Waiting on the customer since Tue 14:30'] },
        ],
    },
    {
        ref: 'NS-4450', from: 'Kenji Sato', company: null, subject: 'Burrs still off after the seat swap',
        preview: 'Second time round. Same drift, same side. I would rather not post it a third time.',
        tags: [{ label: 'Warranty', tone: 'warranty' }, { label: 'Escalated', tone: 'escalated' }],
        minutes: -160, unread: true, assignee: 'Lena Kohler', count: 6, time: 'Tue', channel: 'email', state: 'open',
        customer: ['Kobe, JP', 'NS-B39-0176', 'bought Jan', '€389 + €0 repairs'],
        messages: [
            { kind: 'inbound', author: 'Kenji Sato', time: 'Tue 19:40', body: ['It came back Friday, and by Sunday the grind is drifting to the same side again. This is the second repair.', 'I have been patient. I would rather not post it a third time.'] },
            { kind: 'note', author: 'Lena Kohler', role: 'bench test', time: 'Tue 21:05', body: ['Both repairs used seats from the same shelf. If that shelf is the bad depth then everything we sent back is wrong. Pulling the batch numbers in the morning.'] },
        ],
    },
    {
        ref: 'NS-4447', from: 'Emre Yıldız', company: 'Café Bereket', subject: 'Quote for 12 units, Istanbul',
        preview: 'Four shops, three grinders each. What does that look like on dealer terms?',
        tags: [{ label: 'Dealer', tone: 'dealer' }],
        minutes: 300, unread: false, assignee: null, count: 1, time: 'Mon', channel: 'form', state: 'open',
        customer: ['Istanbul, TR', 'no account yet', 'first contact', '—'],
        messages: [
            { kind: 'inbound', author: 'Emre Yıldız', time: 'Mon 13:15', body: ['We run four shops and want three grinders in each. Do you sell on dealer terms at that size, and what is the lead time from order?'] },
        ],
    },
    {
        ref: 'NS-4444', from: 'Ida Sørensen', company: null, subject: 'Change the address before the Thursday van',
        preview: 'Moving on the 20th. Send it to the new place, not the old one.',
        tags: [{ label: 'Order', tone: 'order' }],
        minutes: null, unread: false, assignee: 'Hana Okabe', count: 2, time: 'Mon', channel: 'chat', state: 'snoozed',
        customer: ['Aarhus, DK', 'NS-B41-0061', 'bought 14 Aug', '€389'],
        messages: [
            { kind: 'inbound', author: 'Ida Sørensen', time: 'Mon 10:22', body: ['I move on the 20th. If it has not shipped yet, please send it to the new address.'] },
            { kind: 'event', time: 'Mon 10:40', body: ['Snoozed until Thursday, when the van is loaded'] },
        ],
    },
]);

const views = [['all', 'All'], ['unassigned', 'Nobody has it'], ['mine', 'Mine'], ['overdue', 'Past the promise']];

const mine = 'Hana Okabe';

const view = ref('all');
const term = ref('');
const picked = ref('NS-4471');
const read = ref([]);

const matches = (thread) => {
    const haystack = `${thread.ref} ${thread.from} ${thread.company ?? ''} ${thread.subject} ${thread.preview} ${thread.tags.map((tag) => tag.label).join(' ')}`.toLowerCase();

    const passesView = view.value === 'all'
        || (view.value === 'unassigned' && thread.assignee === null)
        || (view.value === 'mine' && thread.assignee === mine)
        || (view.value === 'overdue' && thread.minutes !== null && thread.minutes < 0);

    return passesView && (term.value.trim() === '' || haystack.includes(term.value.trim().toLowerCase()));
};

const listed = computed(() => threads.value.filter(matches));

const open = computed(() => listed.value.find((thread) => thread.ref === picked.value) ?? listed.value[0] ?? null);

const total = computed(() => threads.value.length);
const overdue = computed(() => threads.value.filter((thread) => thread.minutes !== null && thread.minutes < 0).length);
const unowned = computed(() => threads.value.filter((thread) => thread.assignee === null).length);

const select = (thread) => {
    picked.value = thread.ref;

    if (!read.value.includes(thread.ref)) {
        read.value = [...read.value, thread.ref];
    }
};

const actions = [
    ['Assign', 'M8 8.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5M3.5 13c.6-2 2.3-3 4.5-3s3.9 1 4.5 3'],
    ['Snooze', 'M8 4v4l2.5 1.5M8 2.5a5.5 5.5 0 1 1 0 11 5.5 5.5 0 0 1 0-11'],
    ['Close', 'm4 8.5 2.5 2.5L12 5.5'],
];
</script>

<template>
    <InboxShell active="Inbox" folder="Unassigned" :padded="false">
        <template #toolbar>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2.5">
                <label class="relative flex items-center">
                    <svg class="pointer-events-none absolute left-2.5 size-3.5 text-zinc-600" viewBox="0 0 16 16" fill="none">
                        <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                    </svg>
                    <input
                        v-model="term"
                        type="search"
                        placeholder="Search name, ref, subject"
                        class="w-56 rounded-lg border border-white/10 bg-ink-900 py-1.5 pr-3 pl-8 text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"
                    >
                    <span class="sr-only">Filter the inbox</span>
                </label>

                <div class="flex items-center gap-1">
                    <label
                        v-for="[value, label] in views"
                        :key="value"
                        class="cursor-pointer rounded-lg border px-2.5 py-1.5 font-mono text-[11px] transition-colors duration-150"
                        :class="view === value ? 'border-jade-500/60 bg-jade-500/10 text-jade-300' : 'border-white/10 text-zinc-500 hover:text-cream'"
                    >
                        <input v-model="view" type="radio" name="inbox-view" :value="value" class="sr-only">
                        {{ label }}
                    </label>
                </div>

                <p class="ml-auto font-mono text-[10px] text-zinc-600">
                    <span class="text-zinc-400">{{ listed.length }}</span> of {{ total }} open ·
                    {{ unowned }} unowned · <span class="text-red-300">{{ overdue }} past the promise</span>
                </p>
            </div>
        </template>

        <div class="flex min-h-0 flex-1 overflow-hidden">
            <div class="flex w-full min-w-0 shrink-0 flex-col border-r border-white/5 md:w-[23rem] lg:w-[25rem]">
                <div class="min-h-0 flex-1 overflow-y-auto">
                    <InboxThread
                        v-for="thread in listed"
                        :key="thread.ref"
                        :thread="{ ...thread, unread: thread.unread && !read.includes(thread.ref) }"
                        :active="open?.ref === thread.ref"
                        @click="select(thread)"
                    />

                    <p v-if="listed.length === 0" class="px-4 py-10 text-center font-mono text-[11px] text-zinc-700">
                        Nothing matches. The queue is not that big.
                    </p>
                </div>

                <div class="shrink-0 border-t border-white/5 px-4 py-2 font-mono text-[10px] text-zinc-700">
                    oldest unowned has been sitting 5h · night shift picks up at 22:00
                </div>
            </div>

            <article v-if="open" class="hidden min-w-0 flex-1 flex-col md:flex">
                <header class="shrink-0 border-b border-white/5 px-5 py-3.5">
                    <div class="flex flex-wrap items-start gap-x-4 gap-y-2">
                        <div class="min-w-0 flex-1">
                            <h3 class="truncate text-[15px] font-medium text-cream">{{ open.subject }}</h3>
                            <div class="mt-1.5 flex flex-wrap items-center gap-2">
                                <span class="font-mono text-[10px] text-zinc-600">{{ open.ref }}</span>
                                <InboxTag v-for="tag in open.tags" :key="tag.label" :label="tag.label" :tone="tag.tone" />
                                <InboxClock v-if="open.minutes !== null" :minutes="open.minutes" bar />
                            </div>
                        </div>

                        <div class="flex shrink-0 items-center gap-1.5">
                            <button
                                v-for="[action, path] in actions"
                                :key="action"
                                type="button"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70"
                            >
                                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path :d="path" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                {{ action }}
                            </button>
                        </div>
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1.5 rounded-lg border border-white/8 bg-ink-900 px-3 py-2">
                        <span class="flex items-center gap-2">
                            <InboxAvatar :name="open.from" size="sm" kind="customer" />
                            <span class="text-[13px] text-zinc-300">{{ open.from }}</span>
                        </span>
                        <span v-for="fact in open.customer" :key="fact" class="font-mono text-[10px] text-zinc-600">{{ fact }}</span>
                        <a href="/templates/inbox/screens/conversation" target="_top" class="ml-auto font-mono text-[10px] text-jade-400 transition-colors duration-150 hover:text-jade-300">open the full thread →</a>
                    </div>
                </header>

                <div class="min-h-0 flex-1 space-y-4 overflow-y-auto px-5 py-5">
                    <InboxMessage v-for="(message, index) in open.messages" :key="index" :message="message" />
                </div>

                <footer class="shrink-0 border-t border-white/5 px-5 py-3">
                    <div class="rounded-xl border border-white/10 bg-ink-900 focus-within:border-jade-500/50">
                        <textarea
                            rows="2"
                            :placeholder="`Reply to ${open.from.split(' ')[0]}, or press N for a note nobody outside sees`"
                            class="w-full resize-none bg-transparent px-3.5 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:outline-none"
                        ></textarea>
                        <div class="flex flex-wrap items-center gap-2 border-t border-white/5 px-3 py-2">
                            <span class="font-mono text-[10px] text-zinc-600">macros</span>
                            <button
                                v-for="macro in ['warranty swap', 'return label', 'lead time']"
                                :key="macro"
                                type="button"
                                class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream"
                            >{{ macro }}</button>
                            <a href="/templates/inbox/screens/compose" target="_top" class="ml-auto inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">
                                Write it properly
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
        </div>
    </InboxShell>
</template>
