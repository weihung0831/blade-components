@php
    $thread = [
        'ref' => 'NS-4471',
        'subject' => 'Grinder howls above 1800 rpm after three weeks',
        'minutes' => -40,
        'tags' => [['label' => 'Warranty', 'tone' => 'warranty'], ['label' => 'Batch 40', 'tone' => 'order'], ['label' => 'Escalated', 'tone' => 'escalated']],
    ];

    $messages = [
        ['kind' => 'event', 'internal' => true, 'time' => 'Tue 08:41', 'body' => ['Web form · picked the "something is wrong with it" box · routed to Unassigned']],
        [
            'kind' => 'inbound', 'author' => 'Tomás Ferreira', 'time' => 'Tue 08:41',
            'body' => [
                'Three weeks old and it has started screaming past halfway on the dial. Espresso settings are where it is worst — anything coarser than that and I barely hear it.',
                'I have recorded it. Is this the burrs bedding in, or is something actually wrong?',
            ],
            'attachments' => [['name' => 'grinder-1800rpm.m4a', 'size' => '1.2 MB'], ['name' => 'dial-position.jpg', 'size' => '1.8 MB']],
        ],
        ['kind' => 'event', 'internal' => true, 'time' => 'Tue 08:52', 'body' => ['Hana Okabe took the thread out of Unassigned']],
        [
            'kind' => 'outbound', 'author' => 'Hana Okabe', 'role' => 'front desk', 'time' => 'Tue 08:53', 'seen' => 'read Tue 09:18',
            'body' => [
                'That is not bedding in. Bedding in is a hiss that fades over a fortnight — what is on your clip is metal touching metal, and it should not.',
                'Two things and then I can tell you exactly what happened: the serial off the underside plate, and roughly where the dial sits when it starts.',
            ],
        ],
        [
            'kind' => 'inbound', 'author' => 'Tomás Ferreira', 'time' => 'Tue 09:20',
            'body' => ['NS-B40-0117, jade finish, bought straight from you on the 21st. It starts about a third of the way up and gets uglier from there.'],
        ],
        [
            'kind' => 'note', 'author' => 'Hana Okabe', 'role' => 'front desk', 'time' => 'Tue 09:24', 'internal' => true,
            'body' => ['@Lena — B40 is the run where the seats came back shallow, isn\'t it? This is the third one this week that starts at the same place on the dial.'],
        ],
        [
            'kind' => 'note', 'author' => 'Lena Kohler', 'role' => 'bench test', 'time' => 'Tue 09:41', 'internal' => true,
            'body' => [
                'Batch 40, yes. Seat depth is 0.15 shallow across the run, so the top burr sits proud and touches once the load comes on. It is not dangerous, it will eat the burr edge in a couple of months.',
                'Workshop job NS-1102 is shimming 24 of them. We have kits on the shelf — no need to make him post the machine anywhere.',
            ],
        ],
        ['kind' => 'event', 'internal' => true, 'time' => 'Tue 09:42', 'body' => ['Assigned to Lena Kohler · tagged Warranty · escalated']],
        [
            'kind' => 'outbound', 'author' => 'Lena Kohler', 'role' => 'bench test', 'time' => 'Tue 10:05', 'seen' => 'read Tue 10:44',
            'body' => [
                'It is ours, and we already know about it. Your machine is from a run where the burr seats were cut 0.15 mm shallow — the top burr sits a fraction proud and touches under load. That is the noise.',
                'You have two ways out and both are free. I post you a shim kit with a 3 mm hex and a card of instructions, twenty minutes at your kitchen table. Or you post the machine to us on our label and it comes back in about ten days.',
                'If you would rather not open it, say so and I will send the label instead — no argument from me either way.',
            ],
            'attachments' => [['name' => 'seat-shim-instructions.pdf', 'size' => '620 KB']],
        ],
        [
            'kind' => 'inbound', 'author' => 'Tomás Ferreira', 'time' => 'Tue 11:12',
            'body' => ['Send the kit. I would rather spend twenty minutes than ten days without it. How long before the noise comes back if I leave it as it is?'],
        ],
        ['kind' => 'event', 'internal' => true, 'time' => '40m ago', 'body' => ['Reply promise passed · 4h from Tue 11:12']],
    ];

    $related = [
        ['ref' => 'NS-4450', 'who' => 'Kenji Sato', 'note' => 'same batch, twice repaired'],
        ['ref' => 'NS-4402', 'who' => 'Julia Brandt', 'note' => 'same noise, took the shim kit'],
        ['ref' => 'NS-4388', 'who' => 'Owen Pryce', 'note' => 'same noise, sent it back'],
    ];
@endphp

<x-templates.inbox.shell active="Inbox" :rail="false" :padded="false">
    <div class="flex min-h-0 flex-1 overflow-hidden">
        <div class="flex min-w-0 flex-1 flex-col">

            <header class="shrink-0 border-b border-white/5 px-5 py-4">
                <a href="{{ route('templates.screen', ['inbox', 'threads']) }}" target="_top"
                    class="inline-flex items-center gap-1.5 font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">
                    <svg class="size-3" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Unassigned
                </a>

                <div class="mt-2 flex flex-wrap items-start gap-x-4 gap-y-3">
                    <div class="min-w-0 flex-1">
                        <h3 class="text-[17px] font-medium tracking-tight text-cream">{{ $thread['subject'] }}</h3>
                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <span class="font-mono text-[10px] text-zinc-600">{{ $thread['ref'] }}</span>
                            @foreach ($thread['tags'] as $tag)
                                <x-templates.inbox.tag :label="$tag['label']" :tone="$tag['tone']" />
                            @endforeach
                            <x-templates.inbox.clock :minutes="$thread['minutes']" bar />
                        </div>
                    </div>

                    <div class="flex shrink-0 flex-wrap items-center gap-1.5">
                        <button type="button"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                            <x-templates.inbox.avatar name="Lena Kohler" size="xs" />
                            Lena has it
                        </button>
                        @foreach (['Snooze', 'Merge', 'Close'] as $action)
                            <button type="button"
                                class="rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">{{ $action }}</button>
                        @endforeach
                    </div>
                </div>
            </header>

            <div data-transcript-filters class="flex shrink-0 flex-wrap items-center gap-2 border-b border-white/5 px-5 py-2.5">
                @foreach ([['everything', 'Everything', 11], ['sent', 'What they can see', 5]] as [$value, $label, $count])
                    <label class="cursor-pointer rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                        <input type="radio" name="transcript-view" data-transcript-filter value="{{ $value }}" @checked($value === 'everything') class="sr-only">
                        {{ $label }} <span class="text-zinc-700">{{ $count }}</span>
                    </label>
                @endforeach

                <p class="ml-auto font-mono text-[10px] text-zinc-700">two hands on this one · 2h 31m from first touch to a real answer</p>
            </div>

            <div data-transcript data-ui-scroll-region class="min-h-0 flex-1 space-y-4 overflow-y-auto px-5 py-6">
                @foreach ($messages as $message)
                    <x-templates.inbox.message
                        :kind="$message['kind']"
                        :author="$message['author'] ?? null"
                        :role="$message['role'] ?? null"
                        :time="$message['time'] ?? null"
                        :attachments="$message['attachments'] ?? []"
                        :seen="$message['seen'] ?? null"
                        :internal="$message['internal'] ?? false">
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

            <footer class="shrink-0 border-t border-white/5 px-5 py-3.5">
                <div data-reply-box class="rounded-xl border border-white/10 bg-ink-900 transition-colors duration-150 focus-within:border-jade-500/50 data-note:border-amber-400/40 data-note:bg-amber-400/5">
                    <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                        @foreach ([['reply', 'Reply'], ['note', 'Internal note'], ['forward', 'Forward']] as [$mode, $label])
                            <label class="cursor-pointer rounded-md px-2 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/8 has-[:checked]:text-cream">
                                <input type="radio" name="reply-mode" data-reply-mode value="{{ $mode }}" @checked($mode === 'reply') class="sr-only">
                                {{ $label }}
                            </label>
                        @endforeach

                        <span data-reply-hint class="ml-auto font-mono text-[10px] text-zinc-600">goes to tomas.ferreira@…pt · 04:12 where he is, so it will land with his morning</span>
                    </div>

                    <textarea rows="3" data-reply-body placeholder="Answer him — the kit is on the shelf and he has already said yes"
                        class="w-full resize-none bg-transparent px-3.5 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:outline-none"></textarea>

                    <div class="flex flex-wrap items-center gap-2 border-t border-white/5 px-3 py-2">
                        @foreach (['Shim kit — dispatch', 'Warranty, no charge', 'Ask for the serial'] as $macro)
                            <button type="button"
                                class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">{{ $macro }}</button>
                        @endforeach

                        <a href="{{ route('templates.screen', ['inbox', 'compose']) }}" target="_top"
                            class="ml-auto inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 hover:bg-jade-400">
                            Send and close
                        </a>
                    </div>
                </div>
            </footer>
        </div>

        <aside data-ui-scroll-region class="hidden w-72 shrink-0 overflow-y-auto border-l border-white/5 px-4 py-5 xl:block">
            <div class="flex items-center gap-3">
                <x-templates.inbox.avatar name="Tomás Ferreira" size="lg" kind="customer" />
                <div class="min-w-0">
                    <p class="truncate text-[13px] font-medium text-cream">Tomás Ferreira</p>
                    <p class="mt-0.5 font-mono text-[10px] text-zinc-600">Porto, PT · 04:12 there</p>
                </div>
            </div>

            <dl class="mt-5 space-y-2.5 border-t border-white/5 pt-4">
                @foreach ([
                    ['Machine', 'NS-B40-0117'],
                    ['Finish', 'Jade'],
                    ['Shipped', '21 Mar, direct'],
                    ['Warranty', 'runs to Mar 2028'],
                    ['Lifetime', '€389, one machine'],
                ] as [$term, $value])
                    <div class="flex items-baseline gap-3">
                        <dt class="font-mono text-[10px] text-zinc-700">{{ $term }}</dt>
                        <dd class="ml-auto text-right font-mono text-[11px] text-zinc-400">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>

            <div class="mt-5 rounded-xl border border-amber-400/25 bg-amber-400/5 p-3">
                <p class="font-mono text-[10px] tracking-wide text-amber-300/80 uppercase">Known fault</p>
                <p class="mt-1.5 text-[12px]/5 text-zinc-300">Batch 40 seats cut 0.15 mm shallow. 24 machines on the bench, kits in stock, no charge either way.</p>
                <a href="{{ route('templates.screen', ['kanban', 'ticket']) }}" target="_top"
                    class="mt-2.5 inline-flex items-center gap-1.5 font-mono text-[10px] text-amber-300 transition-colors duration-150 hover:text-amber-200">
                    workshop job NS-1102 →
                </a>
            </div>

            <div class="mt-5">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Same batch, same noise</p>
                <ul class="mt-2 space-y-1">
                    @foreach ($related as $entry)
                        <li>
                            <a href="{{ route('templates.screen', ['inbox', 'threads']) }}" target="_top"
                                class="block rounded-lg px-2 py-1.5 transition-colors duration-150 hover:bg-white/5">
                                <span class="flex items-baseline gap-2">
                                    <span class="shrink-0 font-mono text-[10px] text-jade-400">{{ $entry['ref'] }}</span>
                                    <span class="truncate text-[12px] text-zinc-400">{{ $entry['who'] }}</span>
                                </span>
                                <span class="mt-0.5 block truncate font-mono text-[10px] text-zinc-700">{{ $entry['note'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-5 border-t border-white/5 pt-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Before this</p>
                <p class="mt-2 text-[12px]/5 text-zinc-500">One thread, April, asking which basket fits a 58 mm portafilter. Answered in eleven minutes, closed happy.</p>
            </div>
        </aside>
    </div>

    <script>
        (() => {
            const transcript = document.querySelector('[data-transcript]');
            const filters = document.querySelector('[data-transcript-filters]');
            const box = document.querySelector('[data-reply-box]');

            if (!transcript || !filters || !box) {
                return;
            }

            const hint = box.querySelector('[data-reply-hint]');
            const body = box.querySelector('[data-reply-body]');

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

            filters.addEventListener('change', () => {
                const view = filters.querySelector('[data-transcript-filter]:checked').value;

                transcript.querySelectorAll('[data-internal]').forEach((entry) => entry.classList.toggle('hidden', view === 'sent'));
            });

            box.addEventListener('change', (event) => {
                const mode = event.target.closest('[data-reply-mode]');

                if (!mode) {
                    return;
                }

                box.toggleAttribute('data-note', mode.value === 'note');
                hint.textContent = hints[mode.value];
                body.placeholder = placeholders[mode.value];
            });
        })();
    </script>
</x-templates.inbox.shell>
