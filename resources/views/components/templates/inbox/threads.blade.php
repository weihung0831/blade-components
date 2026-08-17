@php
    $threads = [
        [
            'ref' => 'NS-4471',
            'from' => 'Tomás Ferreira',
            'company' => null,
            'subject' => 'Grinder howls above 1800 rpm after three weeks',
            'preview' => 'It starts around the middle of the dial and gets worse on lighter roasts. Sound clip attached.',
            'tags' => [['label' => 'Warranty', 'tone' => 'warranty'], ['label' => 'Batch 40', 'tone' => 'order']],
            'minutes' => -40,
            'unread' => true,
            'assignee' => null,
            'count' => 4,
            'time' => '11:12',
            'channel' => 'form',
            'state' => 'open',
            'customer' => ['where' => 'Porto, PT', 'order' => 'NS-B40-0117', 'since' => 'bought 21 Mar', 'spend' => '€389'],
            'messages' => [
                ['kind' => 'event', 'body' => ['Web form · routed to Unassigned'], 'time' => 'Tue 08:41'],
                ['kind' => 'inbound', 'author' => 'Tomás Ferreira', 'time' => 'Tue 08:41', 'body' => ['Three weeks old and it has started screaming past halfway on the dial. Fine espresso setting is where it is worst.', 'I have recorded it. Is this normal bedding-in noise or is something wrong?'], 'attachments' => [['name' => 'grinder-1800rpm.m4a', 'size' => '1.2 MB']]],
                ['kind' => 'outbound', 'author' => 'Hana Okabe', 'role' => 'front desk', 'time' => 'Tue 08:53', 'body' => ['Not normal, and thank you for the recording — that is a metal-on-metal note, not run-in.', 'Can you read me the serial from the underside plate?'], 'seen' => 'read Tue 09:18'],
                ['kind' => 'inbound', 'author' => 'Tomás Ferreira', 'time' => 'Tue 11:12', 'body' => ['NS-B40-0117. Bought it from you directly, jade finish.']],
            ],
        ],
        [
            'ref' => 'NS-4468',
            'from' => 'Kenta Mori',
            'company' => 'Osaka Roast Supply',
            'subject' => 'Batch 40 landed — 48 units, no invoice in the crate',
            'preview' => 'Units are fine, count is right. Accounts cannot pay against a packing slip.',
            'tags' => [['label' => 'Dealer', 'tone' => 'dealer'], ['label' => 'Batch 40', 'tone' => 'order']],
            'minutes' => 80,
            'unread' => false,
            'assignee' => 'Idris Bahar',
            'count' => 5,
            'time' => '10:04',
            'channel' => 'email',
            'state' => 'open',
            'customer' => ['where' => 'Osaka, JP', 'order' => 'PO-2211', 'since' => 'dealer since 2023', 'spend' => '48 units a quarter'],
            'messages' => [
                ['kind' => 'inbound', 'author' => 'Kenta Mori', 'time' => '09:31', 'body' => ['All 48 arrived Thursday, count matches. The crate only had the packing slip — accounts will not release payment without the invoice.']],
                ['kind' => 'note', 'author' => 'Idris Bahar', 'role' => 'shipping', 'time' => '09:48', 'body' => ['Invoice went out with the Osaka paperwork on the 12th. Checking whether it got stapled to the wrong pallet.']],
                ['kind' => 'outbound', 'author' => 'Idris Bahar', 'role' => 'shipping', 'time' => '10:04', 'body' => ['Reissuing it today against PO-2211, same terms, 30 days from the delivery date rather than the invoice date.'], 'attachments' => [['name' => 'INV-40118.pdf', 'size' => '84 KB']]],
            ],
        ],
        [
            'ref' => 'NS-4465',
            'from' => 'Anja Lindqvist',
            'company' => null,
            'subject' => 'Ordered jade, opened graphite',
            'preview' => 'The box label says jade. The grinder inside is not jade.',
            'tags' => [['label' => 'Order', 'tone' => 'order']],
            'minutes' => 130,
            'unread' => true,
            'assignee' => 'Hana Okabe',
            'count' => 2,
            'time' => '09:41',
            'channel' => 'email',
            'state' => 'open',
            'customer' => ['where' => 'Malmö, SE', 'order' => 'NS-B41-0043', 'since' => 'bought 2 Aug', 'spend' => '€389'],
            'messages' => [
                ['kind' => 'inbound', 'author' => 'Anja Lindqvist', 'time' => '09:41', 'body' => ['Label on the box says jade. What came out of it is graphite. Happy to keep it if you knock something off, otherwise I would like the one I ordered.'], 'attachments' => [['name' => 'box-and-grinder.jpg', 'size' => '2.4 MB']]],
                ['kind' => 'note', 'author' => 'Mei Tsai', 'role' => 'workshop', 'time' => '09:52', 'body' => ['Serial is from the run we packed on the 2nd — two jade and two graphite went out swapped that afternoon. The other three are already back.']],
            ],
        ],
        [
            'ref' => 'NS-4462',
            'from' => 'Bruno Sacchi',
            'company' => null,
            'subject' => 'Can I buy the dosing cup on its own?',
            'preview' => 'Dropped mine on tile. The lip is cracked, everything else is fine.',
            'tags' => [['label' => 'Parts', 'tone' => 'plain']],
            'minutes' => 205,
            'unread' => false,
            'assignee' => null,
            'count' => 1,
            'time' => '09:12',
            'channel' => 'form',
            'state' => 'open',
            'customer' => ['where' => 'Bologna, IT', 'order' => 'NS-B38-0210', 'since' => 'bought Nov 2024', 'spend' => '€389'],
            'messages' => [
                ['kind' => 'inbound', 'author' => 'Bruno Sacchi', 'time' => '09:12', 'body' => ['Dropped it on a tile floor. The cup lip is cracked, the grinder is untouched. I do not need a whole machine, I need a cup.']],
            ],
        ],
        [
            'ref' => 'NS-4459',
            'from' => 'Wei-Ting Kao',
            'company' => 'Taipei Coffee Fair',
            'subject' => 'Six show units — can we take them Wednesday instead?',
            'preview' => 'Hall access moved forward a day. Thursday van would land after the doors open.',
            'tags' => [['label' => 'Dealer', 'tone' => 'dealer']],
            'minutes' => 55,
            'unread' => false,
            'assignee' => 'Idris Bahar',
            'count' => 3,
            'time' => 'Tue',
            'channel' => 'email',
            'state' => 'open',
            'customer' => ['where' => 'Taipei, TW', 'order' => 'PO-2240', 'since' => 'third year', 'spend' => 'NT$74,000'],
            'messages' => [
                ['kind' => 'inbound', 'author' => 'Wei-Ting Kao', 'time' => 'Tue 16:20', 'body' => ['Hall access moved to Wednesday morning. If the van comes Thursday the stand is empty when the doors open.']],
                ['kind' => 'note', 'author' => 'Idris Bahar', 'role' => 'shipping', 'time' => 'Tue 16:44', 'body' => ['Six units are packed. Wednesday means someone drives them up — two hours each way, and the Thursday run still has to happen for the rest.']],
            ],
        ],
        [
            'ref' => 'NS-4455',
            'from' => 'Marta Nowak',
            'company' => null,
            'subject' => 'Refund, day 12 of 14',
            'preview' => 'Nothing wrong with it. It is louder than my flat allows at 6am.',
            'tags' => [['label' => 'Refund', 'tone' => 'plain']],
            'minutes' => null,
            'unread' => false,
            'assignee' => 'Hana Okabe',
            'count' => 4,
            'time' => 'Tue',
            'channel' => 'email',
            'state' => 'waiting',
            'customer' => ['where' => 'Kraków, PL', 'order' => 'NS-B40-0088', 'since' => 'bought 5 Aug', 'spend' => '€389'],
            'messages' => [
                ['kind' => 'outbound', 'author' => 'Hana Okabe', 'role' => 'front desk', 'time' => 'Tue 14:02', 'body' => ['Label is attached, no charge. Refund lands two working days after it reaches the workshop.'], 'attachments' => [['name' => 'return-label-4455.pdf', 'size' => '41 KB']], 'seen' => 'read Tue 14:30'],
                ['kind' => 'event', 'body' => ['Waiting on the customer since Tue 14:30'], 'time' => '18h'],
            ],
        ],
        [
            'ref' => 'NS-4450',
            'from' => 'Kenji Sato',
            'company' => null,
            'subject' => 'Burrs still off after the seat swap',
            'preview' => 'Second time round. Same drift, same side. I would rather not post it a third time.',
            'tags' => [['label' => 'Warranty', 'tone' => 'warranty'], ['label' => 'Escalated', 'tone' => 'escalated']],
            'minutes' => -160,
            'unread' => true,
            'assignee' => 'Lena Kohler',
            'count' => 6,
            'time' => 'Tue',
            'channel' => 'email',
            'state' => 'open',
            'customer' => ['where' => 'Kobe, JP', 'order' => 'NS-B39-0176', 'since' => 'bought Jan', 'spend' => '€389 + €0 repairs'],
            'messages' => [
                ['kind' => 'inbound', 'author' => 'Kenji Sato', 'time' => 'Tue 19:40', 'body' => ['It came back Friday, and by Sunday the grind is drifting to the same side again. This is the second repair.', 'I have been patient. I would rather not post it a third time.']],
                ['kind' => 'note', 'author' => 'Lena Kohler', 'role' => 'bench test', 'time' => 'Tue 21:05', 'body' => ['Both repairs used seats from the same shelf. If that shelf is the bad depth then everything we sent back is wrong. Pulling the batch numbers in the morning.']],
            ],
        ],
        [
            'ref' => 'NS-4447',
            'from' => 'Emre Yıldız',
            'company' => 'Café Bereket',
            'subject' => 'Quote for 12 units, Istanbul',
            'preview' => 'Four shops, three grinders each. What does that look like on dealer terms?',
            'tags' => [['label' => 'Dealer', 'tone' => 'dealer']],
            'minutes' => 300,
            'unread' => false,
            'assignee' => null,
            'count' => 1,
            'time' => 'Mon',
            'channel' => 'form',
            'state' => 'open',
            'customer' => ['where' => 'Istanbul, TR', 'order' => 'no account yet', 'since' => 'first contact', 'spend' => '—'],
            'messages' => [
                ['kind' => 'inbound', 'author' => 'Emre Yıldız', 'time' => 'Mon 13:15', 'body' => ['We run four shops and want three grinders in each. Do you sell on dealer terms at that size, and what is the lead time from order?']],
            ],
        ],
        [
            'ref' => 'NS-4444',
            'from' => 'Ida Sørensen',
            'company' => null,
            'subject' => 'Change the address before the Thursday van',
            'preview' => 'Moving on the 20th. Send it to the new place, not the old one.',
            'tags' => [['label' => 'Order', 'tone' => 'order']],
            'minutes' => null,
            'unread' => false,
            'assignee' => 'Hana Okabe',
            'count' => 2,
            'time' => 'Mon',
            'channel' => 'chat',
            'state' => 'snoozed',
            'customer' => ['where' => 'Aarhus, DK', 'order' => 'NS-B41-0061', 'since' => 'bought 14 Aug', 'spend' => '€389'],
            'messages' => [
                ['kind' => 'inbound', 'author' => 'Ida Sørensen', 'time' => 'Mon 10:22', 'body' => ['I move on the 20th. If it has not shipped yet, please send it to the new address.']],
                ['kind' => 'event', 'body' => ['Snoozed until Thursday, when the van is loaded'], 'time' => 'Mon 10:40'],
            ],
        ],
    ];

    $overdue = count(array_filter($threads, fn (array $thread): bool => $thread['minutes'] !== null && $thread['minutes'] < 0));
    $unassigned = count(array_filter($threads, fn (array $thread): bool => $thread['assignee'] === null));
    $total = count($threads);
@endphp

<x-templates.inbox.shell active="Inbox" folder="Unassigned" :padded="false">
    <x-slot:toolbar>
        <div data-inbox-filters class="flex flex-wrap items-center gap-x-4 gap-y-2.5">
            <label class="relative flex items-center">
                <svg class="pointer-events-none absolute left-2.5 size-3.5 text-zinc-600" viewBox="0 0 16 16" fill="none">
                    <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
                <input type="search" data-inbox-search placeholder="Search name, ref, subject"
                    class="w-56 rounded-lg border border-white/10 bg-ink-900 py-1.5 pr-3 pl-8 text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none">
                <span class="sr-only">Filter the inbox</span>
            </label>

            <div class="flex items-center gap-1">
                @foreach ([['all', 'All'], ['unassigned', 'Nobody has it'], ['mine', 'Mine'], ['overdue', 'Past the promise']] as [$value, $label])
                    <label @class([
                        'cursor-pointer rounded-lg border px-2.5 py-1.5 font-mono text-[11px] transition-colors duration-150',
                        'has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300',
                        'border-white/10 text-zinc-500 hover:text-cream',
                    ])>
                        <input type="radio" name="inbox-view" data-view-filter value="{{ $value }}" @checked($value === 'all') class="sr-only">
                        {{ $label }}
                    </label>
                @endforeach
            </div>

            <p class="ml-auto font-mono text-[10px] text-zinc-600">
                <span data-inbox-showing class="text-zinc-400">{{ $total }}</span> of {{ $total }} open ·
                {{ $unassigned }} unowned · <span class="text-red-300">{{ $overdue }} past the promise</span>
            </p>
        </div>
    </x-slot>

    <div data-inbox class="flex min-h-0 flex-1 overflow-hidden">
        <div class="flex w-full min-w-0 shrink-0 flex-col border-r border-white/5 md:w-[23rem] lg:w-[25rem]">
            <div data-thread-list class="min-h-0 flex-1 overflow-y-auto">
                @foreach ($threads as $thread)
                    <x-templates.inbox.thread
                        :ref="$thread['ref']"
                        :from="$thread['from']"
                        :company="$thread['company']"
                        :subject="$thread['subject']"
                        :preview="$thread['preview']"
                        :tags="$thread['tags']"
                        :minutes="$thread['minutes']"
                        :unread="$thread['unread']"
                        :assignee="$thread['assignee']"
                        :count="$thread['count']"
                        :time="$thread['time']"
                        :channel="$thread['channel']"
                        :state="$thread['state']"
                        :active="$loop->first" />
                @endforeach

                <p data-list-empty class="hidden px-4 py-10 text-center font-mono text-[11px] text-zinc-700">Nothing matches. The queue is not that big.</p>
            </div>

            <div class="shrink-0 border-t border-white/5 px-4 py-2 font-mono text-[10px] text-zinc-700">
                oldest unowned has been sitting {{ intdiv(300, 60) }}h · night shift picks up at 22:00
            </div>
        </div>

        <div class="hidden min-w-0 flex-1 flex-col md:flex">
            @foreach ($threads as $thread)
                <article data-thread-panel="{{ $thread['ref'] }}" @class(['flex min-h-0 flex-1 flex-col', 'hidden' => ! $loop->first])>

                    <header class="shrink-0 border-b border-white/5 px-5 py-3.5">
                        <div class="flex flex-wrap items-start gap-x-4 gap-y-2">
                            <div class="min-w-0 flex-1">
                                <h3 class="truncate text-[15px] font-medium text-cream">{{ $thread['subject'] }}</h3>
                                <div class="mt-1.5 flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-[10px] text-zinc-600">{{ $thread['ref'] }}</span>
                                    @foreach ($thread['tags'] as $tag)
                                        <x-templates.inbox.tag :label="$tag['label']" :tone="$tag['tone']" />
                                    @endforeach
                                    @if ($thread['minutes'] !== null)
                                        <x-templates.inbox.clock :minutes="$thread['minutes']" bar />
                                    @endif
                                </div>
                            </div>

                            <div class="flex shrink-0 items-center gap-1.5">
                                @foreach ([['Assign', 'M8 8.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5M3.5 13c.6-2 2.3-3 4.5-3s3.9 1 4.5 3'], ['Snooze', 'M8 4v4l2.5 1.5M8 2.5a5.5 5.5 0 1 1 0 11 5.5 5.5 0 0 1 0-11'], ['Close', 'm4 8.5 2.5 2.5L12 5.5']] as [$action, $path])
                                    <button type="button"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="{{ $path }}" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        {{ $action }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1.5 rounded-lg border border-white/8 bg-ink-900 px-3 py-2">
                            <span class="flex items-center gap-2">
                                <x-templates.inbox.avatar :name="$thread['from']" size="sm" kind="customer" />
                                <span class="text-[13px] text-zinc-300">{{ $thread['from'] }}</span>
                            </span>
                            @foreach (array_filter(['where' => $thread['customer']['where'] ?? null, 'order' => $thread['customer']['order'] ?? null, 'since' => $thread['customer']['since'] ?? null, 'spend' => $thread['customer']['spend'] ?? null]) as $fact)
                                <span class="font-mono text-[10px] text-zinc-600">{{ $fact }}</span>
                            @endforeach
                            <a href="{{ route('templates.screen', ['inbox', 'conversation']) }}" target="_top"
                                class="ml-auto font-mono text-[10px] text-jade-400 transition-colors duration-150 hover:text-jade-300">open the full thread →</a>
                        </div>
                    </header>

                    <div data-ui-scroll-region class="min-h-0 flex-1 space-y-4 overflow-y-auto px-5 py-5">
                        @foreach ($thread['messages'] as $message)
                            <x-templates.inbox.message
                                :kind="$message['kind']"
                                :author="$message['author'] ?? null"
                                :role="$message['role'] ?? null"
                                :time="$message['time'] ?? null"
                                :attachments="$message['attachments'] ?? []"
                                :seen="$message['seen'] ?? null">
                                @foreach ($message['body'] as $paragraph)
                                    @if ($message['kind'] === 'event')
                                        {{ $paragraph }}
                                    @else
                                        <p>{{ $paragraph }}</p>
                                    @endif
                                @endforeach
                            </x-templates.inbox.message>
                        @endforeach
                    </div>

                    <footer class="shrink-0 border-t border-white/5 px-5 py-3">
                        <div class="rounded-xl border border-white/10 bg-ink-900 focus-within:border-jade-500/50">
                            <textarea rows="2" placeholder="Reply to {{ Illuminate\Support\Str::before($thread['from'], ' ') }}, or press N for a note nobody outside sees"
                                class="w-full resize-none bg-transparent px-3.5 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:outline-none"></textarea>
                            <div class="flex flex-wrap items-center gap-2 border-t border-white/5 px-3 py-2">
                                <span class="font-mono text-[10px] text-zinc-600">macros</span>
                                @foreach (['warranty swap', 'return label', 'lead time'] as $macro)
                                    <button type="button"
                                        class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">{{ $macro }}</button>
                                @endforeach
                                <a href="{{ route('templates.screen', ['inbox', 'compose']) }}" target="_top"
                                    class="ml-auto inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">
                                    Write it properly
                                </a>
                            </div>
                        </div>
                    </footer>
                </article>
            @endforeach
        </div>
    </div>

    <script>
        (() => {
            const inbox = document.querySelector('[data-inbox]');
            const filters = document.querySelector('[data-inbox-filters]');

            if (!inbox || !filters) {
                return;
            }

            const rows = [...inbox.querySelectorAll('[data-thread]')];
            const panels = [...inbox.querySelectorAll('[data-thread-panel]')];
            const empty = inbox.querySelector('[data-list-empty]');
            const showing = filters.querySelector('[data-inbox-showing]');
            const search = filters.querySelector('[data-inbox-search]');

            const mine = 'Hana Okabe';

            const open = (row) => {
                rows.forEach((entry) => entry.toggleAttribute('data-active', entry === row));
                row.removeAttribute('data-unread');
                panels.forEach((panel) => panel.classList.toggle('hidden', panel.dataset.threadPanel !== row.dataset.ref));
            };

            const apply = () => {
                const view = filters.querySelector('[data-view-filter]:checked').value;
                const term = search.value.trim().toLowerCase();

                const visible = rows.filter((row) => {
                    const minutes = row.dataset.minutes === '' ? null : Number(row.dataset.minutes);

                    const passesView = view === 'all'
                        || (view === 'unassigned' && row.dataset.owner === 'unassigned')
                        || (view === 'mine' && row.dataset.owner === mine)
                        || (view === 'overdue' && minutes !== null && minutes < 0);

                    const match = passesView && (term === '' || row.dataset.search.includes(term));

                    row.classList.toggle('hidden', !match);

                    return match;
                });

                showing.textContent = visible.length;
                empty.classList.toggle('hidden', visible.length > 0);

                const active = visible.find((row) => row.hasAttribute('data-active'));

                if (!active && visible.length > 0) {
                    open(visible[0]);
                }
            };

            inbox.addEventListener('click', (event) => {
                const row = event.target.closest('[data-thread]');

                if (row) {
                    open(row);
                }
            });

            filters.addEventListener('input', apply);
            filters.addEventListener('change', apply);

            apply();
        })();
    </script>
</x-templates.inbox.shell>
