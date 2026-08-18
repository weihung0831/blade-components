@php
    $promises = [
        ['thing' => 'Webhooks for every order event', 'announced' => '3 May 26', 'shipped' => '14 Jul 26', 'slip' => 10, 'state' => 'shipped', 'version' => '4.1.0', 'note' => 'The delivery log was not in the announcement and turned out to be the half people wanted.'],
        ['thing' => 'Freight zones you draw rather than list', 'announced' => '8 Feb 26', 'shipped' => '17 Aug 26', 'slip' => 27, 'state' => 'late', 'version' => '4.2.0', 'note' => 'Announced as "spring". Two rewrites, and the second one is the reason the field changed shape.'],
        ['thing' => 'Draft orders as a payment link', 'announced' => '22 Mar 26', 'shipped' => '16 Jun 26', 'slip' => 12, 'state' => 'shipped', 'version' => '4.0.6'],
        ['thing' => 'API keys shown once and then hashed', 'announced' => '14 Jun 26', 'shipped' => '14 Jul 26', 'slip' => 4, 'state' => 'shipped', 'version' => '4.1.0', 'note' => 'Fast because it was small and because nobody argues about this one.'],
        ['thing' => 'Stock movements with a reason against them', 'announced' => '14 Jun 26', 'shipped' => '11 Aug 26', 'slip' => 8, 'state' => 'shipped', 'version' => '4.1.4', 'note' => 'Shipped twice. The first attempt is the four-hour release below.'],
        ['thing' => 'A carrier quote at the till', 'announced' => '22 Mar 26', 'shipped' => '17 Aug 26', 'slip' => 21, 'state' => 'late', 'version' => '4.2.0', 'note' => 'Four months of it were spent waiting on one carrier to give us a test account.'],
        ['thing' => 'Search that matches part of a word', 'announced' => '21 Jun 26', 'shipped' => '28 Jul 26', 'slip' => 5, 'state' => 'shipped', 'version' => '4.1.2'],
        ['thing' => 'The dashboard under a second and a half', 'announced' => '17 May 26', 'shipped' => '30 Jun 26', 'slip' => 6, 'state' => 'shipped', 'version' => '4.0.7', 'note' => '1.1s in the end, which is the only time this list has beaten its own claim.'],
        ['thing' => 'Order search across all your shops', 'announced' => '28 Jun 26', 'shipped' => '11 Aug 26', 'slip' => 6, 'state' => 'shipped', 'version' => '4.1.4'],
        ['thing' => 'Bundled products', 'announced' => '15 Mar 26', 'shipped' => null, 'slip' => null, 'state' => 'open', 'note' => 'Twenty-two weeks in, and the honest position is that we have not started. It stays on the list until it ships or it moves to the row below.'],
        ['thing' => 'Two people to approve a refund over a limit', 'announced' => '12 Jul 26', 'shipped' => null, 'slip' => null, 'state' => 'open', 'note' => 'Started. Due in the autumn, and that is a guess rather than a date.'],
        ['thing' => 'A rewritten CSV export', 'announced' => 'Sep 25', 'shipped' => null, 'slip' => null, 'state' => 'dropped', 'note' => 'Dropped in April. We fixed the four things people actually complained about instead, and the rewrite stopped having a reason to exist.'],
        ['thing' => 'Prices in more than one currency', 'announced' => 'Jan 26', 'shipped' => null, 'slip' => null, 'state' => 'dropped', 'note' => 'Dropped in July after eleven weeks of work. Doing it properly means holding a rate at the moment of sale and again at the refund, and we could not make the refund side honest.'],
        ['thing' => 'A phone app', 'announced' => 'Nov 24', 'shipped' => null, 'slip' => null, 'state' => 'dropped', 'note' => 'Announced at a conference by somebody who no longer works here. Never started. It sat on the roadmap for fourteen months before anybody took it off.'],
    ];

    $pulled = [
        [
            'version' => '4.1.3',
            'date' => '4 Aug 2026',
            'lived' => 'four hours',
            'what' => 'Returned stock counted twice, so anything sent back read as two back on the shelf.',
            'found' => 'A shop with three grinders in stock, reading five. They wrote in at 13:40 and we had it off by 14:20.',
            'after' => 'The nightly rebuild now runs against a copy first and refuses to write if the count moves by more than 2%.',
            'reach' => '96 shops',
        ],
        [
            'version' => '3.9.2',
            'date' => '19 Nov 2025',
            'lived' => 'forty minutes',
            'what' => 'Invoice PDFs came out white on white for anybody whose shop was set to the light theme.',
            'found' => 'Our own bookkeeper, printing an invoice.',
            'after' => 'PDFs are rendered from a fixed palette that has nothing to do with the shop theme. It should never have been reading it.',
            'reach' => 'about 400 shops, though only 30 printed anything in the window',
        ],
        [
            'version' => '3.4.0',
            'date' => '11 Feb 2025',
            'lived' => 'three days',
            'what' => 'The search index fell behind by a few minutes at first, then by hours. New products stopped being findable in their own shop.',
            'found' => 'Nobody reported it for two days. We found it on the third by looking at a graph for a different reason, which is the part of this that still bothers us.',
            'after' => 'The index has its own lag alarm at five minutes, and the search page says how old its answers are when the lag is over a minute.',
            'reach' => 'every shop, quietly',
        ],
    ];

    $filters = [
        ['key' => 'all-promises', 'label' => 'All fourteen'],
        ['key' => 'late', 'label' => 'Late'],
        ['key' => 'open', 'label' => 'Still open'],
        ['key' => 'dropped', 'label' => 'Dropped'],
    ];

    $tiles = [
        ['figure' => '14', 'label' => 'announced', 'note' => 'on the roadmap since it started'],
        ['figure' => '9', 'label' => 'shipped', 'note' => 'two of them later than we said'],
        ['figure' => '3', 'label' => 'dropped', 'note' => 'one never started at all'],
        ['figure' => '11', 'label' => 'weeks, on average', 'note' => 'between announcing and shipping'],
    ];
@endphp

<x-templates.changelog.shell active="The record">
    <x-slot:toolbar>
        <div data-record-bar class="flex flex-wrap items-center gap-x-2 gap-y-2">
            @foreach ($filters as $filter)
                <button type="button" data-record-filter="{{ $filter['key'] }}"
                    @if ($loop->first) data-active @endif
                    class="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300">{{ $filter['label'] }}</button>
            @endforeach

            <span data-record-count class="ml-auto font-mono text-[10px] text-zinc-600">fourteen things, nine of them out</span>
        </div>
    </x-slot:toolbar>

    <div data-record class="mx-auto max-w-5xl">
        <h1 class="text-lg font-semibold tracking-tight text-cream">What we said we would do, against what went out</h1>
        <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
            A changelog only tells you what shipped. This page keeps the other half — the fourteen things announced on the
            roadmap, the eleven-week average between saying and doing, the three we dropped with the reason written out, and
            the three releases that came back off within days.
        </p>

        <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach ($tiles as $tile)
                <div class="rounded-xl border border-white/8 bg-ink-950 p-3.5">
                    <p class="font-mono text-2xl tracking-tight text-cream">{{ $tile['figure'] }}</p>
                    <p class="mt-0.5 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $tile['label'] }}</p>
                    <p class="mt-1.5 text-[11px]/5 text-zinc-600">{{ $tile['note'] }}</p>
                </div>
            @endforeach
        </div>

        <section class="mt-8">
            <div class="flex items-baseline justify-between gap-3">
                <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Announced, and then</h2>
                <span class="font-mono text-[10px] text-zinc-700">the bar is the wait</span>
            </div>

            <div class="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                @foreach ($promises as $promise)
                    <x-templates.changelog.promise
                        :thing="$promise['thing']"
                        :announced="$promise['announced']"
                        :shipped="$promise['shipped']"
                        :slip="$promise['slip']"
                        :state="$promise['state']"
                        :version="$promise['version'] ?? null"
                        :note="$promise['note'] ?? null" />
                @endforeach
            </div>

            <p data-record-empty class="mt-3 hidden rounded-xl border border-white/8 bg-ink-900 px-3.5 py-6 text-center text-[12px] text-zinc-600">
                None under that heading, which is the one direction this page is glad to be empty in.
            </p>
        </section>

        <section class="mt-9">
            <div class="flex items-baseline justify-between gap-3">
                <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Three releases that came back off</h2>
                <span class="font-mono text-[10px] text-zinc-700">out of 41</span>
            </div>

            <div class="mt-2.5 flex flex-col gap-3">
                @foreach ($pulled as $incident)
                    <article class="overflow-hidden rounded-xl border border-red-400/20 bg-ink-950">
                        <div class="border-b border-red-400/12 bg-red-400/4 px-3.5 py-3">
                            <x-templates.changelog.stamp
                                :version="$incident['version']"
                                :date="$incident['date']"
                                state="pulled"
                                :lived="'up for '.$incident['lived']"
                                :note="$incident['what']" />
                        </div>

                        <dl class="grid grid-cols-1 divide-y divide-white/5 sm:grid-cols-3 sm:divide-x sm:divide-y-0">
                            <div class="px-3.5 py-3">
                                <dt class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Who saw it</dt>
                                <dd class="mt-1.5 text-[12px]/5 text-zinc-400">{{ $incident['reach'] }}</dd>
                            </div>

                            <div class="px-3.5 py-3">
                                <dt class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">How we found out</dt>
                                <dd class="mt-1.5 text-[12px]/5 text-zinc-400">{{ $incident['found'] }}</dd>
                            </div>

                            <div class="px-3.5 py-3">
                                <dt class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What changed after</dt>
                                <dd class="mt-1.5 text-[12px]/5 text-zinc-400">{{ $incident['after'] }}</dd>
                            </div>
                        </dl>
                    </article>
                @endforeach
            </div>
        </section>

        <div class="mt-9 grid grid-cols-1 gap-3 sm:grid-cols-2">
            <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">How the eleven weeks is worked out</p>
                <p class="mt-2 text-[12px]/5 text-zinc-400">
                    From the day a thing appears on the public roadmap to the day it reaches the last region. Not from when
                    work started, which would flatter us, and not to the first region, which would flatter us more. Dropped
                    and open things are left out of the average — put them in and it is not an average of anything.
                </p>
            </div>

            <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why this page exists</p>
                <p class="mt-2 text-[12px]/5 text-zinc-400">
                    A roadmap with nothing behind it costs nothing to write. Since this page went up in 2024 we have
                    announced less and shipped a larger share of it, which was the point, though it also means the roadmap
                    is now duller to read than it used to be.
                </p>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-record]');
            const bar = document.querySelector('[data-record-bar]');

            if (!root || !bar) {
                return;
            }

            const rows = [...root.querySelectorAll('[data-promise]')];
            const buttons = [...bar.querySelectorAll('[data-record-filter]')];
            const count = bar.querySelector('[data-record-count]');
            const empty = root.querySelector('[data-record-empty]');

            const spell = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen'];

            const apply = (key) => {
                let shown = 0;

                rows.forEach((row) => {
                    const keep = key === 'all-promises' || row.dataset.promise === key;

                    row.classList.toggle('hidden', !keep);
                    shown += keep ? 1 : 0;
                });

                buttons.forEach((button) => button.toggleAttribute('data-active', button.dataset.recordFilter === key));
                empty.classList.toggle('hidden', shown > 0);

                count.textContent = key === 'all-promises'
                    ? 'fourteen things, nine of them out'
                    : `${spell[shown]} of the fourteen`;
            };

            buttons.forEach((button) => button.addEventListener('click', () => apply(button.dataset.recordFilter)));
        })();
    </script>
</x-templates.changelog.shell>
