@php
    $windows = [
        ['key' => '1', 'label' => 'first year'],
        ['key' => '5', 'label' => 'five years'],
        ['key' => '10', 'label' => 'ten years'],
    ];

    $machines = [
        [
            'label' => 'The Mk3, this one',
            'tone' => 'ours',
            'costs' => ['1' => 4200, '5' => 5160, '10' => 6120],
            'note' => 'One burr set at year four, two collars along the way. Nothing else has ever been asked for.',
        ],
        [
            'label' => 'The NT$1,450 aluminium one',
            'tone' => 'bad',
            'costs' => ['1' => 1450, '5' => 4350, '10' => 8700],
            'note' => 'Burrs go dull around month fourteen and no one sells replacements, so the whole machine is the spare part.',
        ],
        [
            'label' => 'A NT$12,000 electric',
            'tone' => 'quiet',
            'costs' => ['1' => 12000, '5' => 12900, '10' => 14600],
            'note' => 'Faster every morning, and worth it if you grind for four people. For one cup it is a large object on a small counter.',
        ],
        [
            'label' => 'The Mk2 already in your drawer',
            'tone' => 'warn',
            'costs' => ['1' => 180, '5' => 960, '10' => 1920],
            'note' => 'The cheapest machine on this page is the one you own. Burrs, collar, seal — we still sell all three.',
        ],
    ];

    $features = [
        [
            'mark' => '38 mm',
            'title' => 'Burrs that three companies still make',
            'body' => 'The Mk2 died because one supplier stopped making its burr set. The Mk3 takes a size three of them make, and we hold 900 sets in the room behind the bench.',
            'meta' => 'stocked to 2030, NT$780 a set',
            'tone' => 'primary',
        ],
        [
            'mark' => '620 g',
            'title' => 'Heavy enough to sit still, light enough to pack',
            'body' => 'Steel shaft, aluminium body. It does not walk across the counter while you crank, and it goes in a pannier without being the reason the bag is full.',
            'meta' => '142 mm tall with the crank off',
        ],
        [
            'mark' => '2 min',
            'title' => 'The collar works loose. You fix it yourself.',
            'body' => 'On roughly one machine in nine, the crank collar backs off within the first year. It is two minutes with the 2 mm key in the box, and we would rather say so here than in a support thread.',
            'meta' => '681 of 6,142 have reported it',
            'tone' => 'caveat',
        ],
        [
            'mark' => '60 days',
            'title' => 'Send it back after you have used it',
            'body' => 'Grind through a couple of kilos first. A machine that comes back inside sixty days gets a full refund and goes to the seconds shelf, not back in a box as new.',
            'meta' => '214 have come back since 2019',
        ],
    ];

    $quotes = [
        [
            'body' => 'I bought it because the burr page listed the suppliers by name. Four years on I have replaced the burrs once and the collar twice, and both times the part was in stock the same afternoon.',
            'name' => 'Lin Wei-chen',
            'role' => 'Ships two bags a week from a stall in Yonghe',
            'machine' => 'Mk2, then Mk3',
            'since' => 'since Mar 2021',
        ],
        [
            'body' => 'The honest bit sold it. Every other shop told me their grinder was perfect and this one told me the collar comes loose. Mine did, in week six, and the video was already on the site.',
            'name' => 'Anders Holm',
            'role' => 'Grinds for one, badly, most mornings',
            'machine' => 'Mk3 graphite',
            'since' => 'since Nov 2024',
        ],
        [
            'body' => 'It is slower than the electric it replaced. That is the trade and they say it on the page rather than after the money has gone. Ninety seconds a cup, and I get the ninety seconds back in not listening to a motor at six in the morning.',
            'name' => 'Priya Raman',
            'role' => 'Was very attached to that motor',
            'machine' => 'Mk3 cream',
            'since' => 'since Jan 2026',
        ],
    ];
@endphp

<x-templates.landing.shell active="The pitch">
    <div class="mx-auto max-w-5xl">

        <x-templates.landing.hero
            eyebrow="one machine, made since 2019"
            headline="A hand grinder we have only changed twice, because the parts have to outlive the sales page."
            sentence="Nomad Supply makes one thing. The Mk3 grinds 25 g of filter in about ninety seconds, weighs 620 g, and every part that wears is on the shelf at a price printed next to it. What follows is what we measured, not what the copywriter felt."
            price="NT$4,200"
            price-note="incl. tax, ships from Taipei"
            action="Join batch 41"
            second="Read the measurements first"
            action-note="46 of 180 unspoken for · nothing charged until the batch is cut"
            :facts="[
                ['label' => 'out there', 'value' => '6,142', 'note' => 'since March 2019'],
                ['label' => 'came back', 'value' => '214', 'note' => '3.5%, every reason listed'],
                ['label' => 'burr supply', 'value' => 'to 2030', 'note' => 'three makers, 38 mm'],
                ['label' => 'per batch', 'value' => '180', 'note' => 'four people, six weeks'],
            ]">

            <div class="flex h-full flex-col rounded-2xl border border-white/8 bg-ink-900/70 p-4">
                <div class="flex items-baseline justify-between">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Mk3, graphite</p>
                    <p class="font-mono text-[10px] text-zinc-700">photography goes here</p>
                </div>

                <div class="dot-grid relative mt-4 flex min-h-52 flex-1 overflow-hidden rounded-xl border border-white/8 bg-ink-950 p-4">
                    <span aria-hidden="true" class="pointer-events-none absolute -top-16 left-1/2 size-64 -translate-x-1/2 rounded-full bg-jade-500/8 blur-3xl"></span>

                    <div class="relative flex flex-1 flex-col items-center justify-center gap-2.5 rounded-lg border border-dashed border-white/12">
                        <svg class="size-8 text-zinc-700" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.3"/>
                            <circle cx="8.5" cy="10" r="1.5" stroke="currentColor" stroke-width="1.3"/>
                            <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <p class="font-mono text-[11px] text-zinc-500">the machine, front on</p>
                        <p class="font-mono text-[10px] text-zinc-700">1200 × 1600 · webp</p>
                    </div>
                </div>

                <dl class="mt-3 grid grid-cols-2 gap-x-4 gap-y-2 border-t border-white/6 pt-3">
                    @foreach ([['25 g of filter', '90 seconds'], ['18 g of espresso', '75 seconds'], ['clicks on the dial', '36, 22 usable'], ['what is in the box', 'brush, 2 mm key'], ] as $row)
                        <div class="flex items-baseline justify-between gap-2">
                            <dt class="truncate text-[11px] text-zinc-600">{{ $row[0] }}</dt>
                            <dd class="shrink-0 font-mono text-[11px] text-zinc-400">{{ $row[1] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </x-templates.landing.hero>

        <section class="mt-14">
            <div class="flex items-baseline gap-3">
                <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">Four things worth knowing before the money</h2>
                <span class="h-px min-w-0 flex-1 bg-white/6"></span>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($features as $feature)
                    <x-templates.landing.feature
                        :mark="$feature['mark']"
                        :title="$feature['title']"
                        :body="$feature['body']"
                        :meta="$feature['meta']"
                        :tone="$feature['tone'] ?? 'quiet'" />
                @endforeach
            </div>
        </section>

        <section data-cost class="mt-12 rounded-2xl border border-white/8 bg-ink-900/50 p-5">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">What it costs to keep grinding, not what it costs to buy</h2>
                    <p class="mt-1.5 max-w-lg text-[12px]/5 text-zinc-500">
                        Purchase price plus every part that wears out in the window, at today's shelf prices. The fourth row
                        is the one we lose money on and it is still here.
                    </p>
                </div>

                <div class="flex shrink-0 items-center gap-1 rounded-xl border border-white/8 bg-ink-950 p-1">
                    @foreach ($windows as $window)
                        <button type="button" data-cost-window="{{ $window['key'] }}"
                            @class([
                                'rounded-lg px-2.5 py-1 text-[12px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                'bg-jade-500/15 text-jade-300' => $window['key'] === '5',
                                'text-zinc-500 hover:text-cream' => $window['key'] !== '5',
                            ])>{{ $window['label'] }}</button>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-5">
                @foreach ($machines as $machine)
                    <x-templates.landing.bar
                        data-cost-row
                        data-costs="{{ json_encode($machine['costs']) }}"
                        :label="$machine['label']"
                        :value="$machine['costs']['5']"
                        :max="14600"
                        :display="'NT$'.number_format($machine['costs']['5'])"
                        :note="$machine['note']"
                        :tone="$machine['tone']" />
                @endforeach
            </div>

            <p class="mt-5 border-t border-white/5 pt-3 font-mono text-[10px] text-zinc-700">
                bars share one scale, ten-year electric at the far end · replacement prices from the parts shelf, 18 Aug 2026
            </p>
        </section>

        <section class="mt-12">
            <div class="flex items-baseline gap-3">
                <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">Three people who have had one a while</h2>
                <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                <span class="shrink-0 font-mono text-[10px] text-zinc-700">unedited, names with permission</span>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-3 lg:grid-cols-3">
                @foreach ($quotes as $quote)
                    <x-templates.landing.quote
                        :body="$quote['body']"
                        :name="$quote['name']"
                        :role="$quote['role']"
                        :machine="$quote['machine']"
                        :since="$quote['since']" />
                @endforeach
            </div>
        </section>

        <section class="mt-12 overflow-hidden rounded-2xl border border-jade-500/25 bg-jade-500/5">
            <div class="flex flex-col gap-6 p-6 sm:flex-row sm:items-center">
                <div class="min-w-0 flex-1">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Batch 41, cut on 2 September</p>
                    <h2 class="mt-2 text-xl font-semibold tracking-tight text-balance text-cream">180 machines, and the four of us have six weeks to make them.</h2>
                    <p class="mt-2 max-w-lg text-[12px]/5 text-zinc-400">
                        A place on the list costs nothing and holds until the batch is cut. Batch 39 ran eleven weeks late and
                        everybody on it could walk away with their money at any point. That stays true here.
                    </p>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <a href="{{ route('templates.screen', ['landing', 'batch']) }}" target="_top"
                            class="inline-flex items-center gap-2 rounded-xl bg-jade-500 px-4 py-2.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Take a place</a>
                        <a href="{{ route('templates.screen', ['landing', 'objections']) }}" target="_top"
                            class="inline-flex items-center gap-2 rounded-xl border border-white/10 px-4 py-2.5 text-[13px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">First, five reasons not to</a>
                    </div>
                </div>

                <div class="w-full shrink-0 rounded-xl border border-white/8 bg-ink-950/60 p-4 sm:w-64">
                    <x-templates.landing.bar
                        label="Spoken for"
                        :value="134"
                        :max="180"
                        display="134 / 180"
                        tone="ours"
                        note="46 left, and the list has run over on the last two batches." />

                    <dl class="mt-4 flex flex-col gap-2 border-t border-white/6 pt-3">
                        @foreach ([['opens', '2 Sep 2026'], ['ships', 'w/c 12 Oct'], ['finishes', 'graphite, cream, jade']] as $row)
                            <div class="flex items-baseline justify-between gap-2">
                                <dt class="text-[11px] text-zinc-600">{{ $row[0] }}</dt>
                                <dd class="font-mono text-[11px] text-zinc-400">{{ $row[1] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </section>
    </div>

    <script>
        (() => {
            const panel = document.querySelector('[data-cost]');

            if (!panel) {
                return;
            }

            const buttons = [...panel.querySelectorAll('[data-cost-window]')];
            const rows = [...panel.querySelectorAll('[data-cost-row]')];
            const max = 14600;

            const apply = (key) => {
                buttons.forEach((button) => {
                    const on = button.dataset.costWindow === key;

                    button.classList.toggle('bg-jade-500/15', on);
                    button.classList.toggle('text-jade-300', on);
                    button.classList.toggle('text-zinc-500', !on);
                    button.classList.toggle('hover:text-cream', !on);
                });

                rows.forEach((row) => {
                    const cost = JSON.parse(row.dataset.costs)[key];

                    row.querySelector('[data-bar-fill]').style.width = `${Math.min(100, (cost / max) * 100)}%`;
                    row.querySelector('[data-bar-display]').textContent = `NT$${cost.toLocaleString('en-US')}`;
                });
            };

            buttons.forEach((button) => button.addEventListener('click', () => apply(button.dataset.costWindow)));
            apply('5');
        })();
    </script>
</x-templates.landing.shell>
