@php
    $distribution = [
        ['stars' => 5, 'count' => 241, 'percent' => 77],
        ['stars' => 4, 'count' => 48, 'percent' => 15],
        ['stars' => 3, 'count' => 14, 'percent' => 5],
        ['stars' => 2, 'count' => 6, 'percent' => 2],
        ['stars' => 1, 'count' => 3, 'percent' => 1],
    ];

    $traits = [
        ['label' => 'Grind consistency', 'score' => '4.9', 'percent' => 98],
        ['label' => 'Retention', 'score' => '4.8', 'percent' => 96],
        ['label' => 'Build', 'score' => '4.9', 'percent' => 98],
        ['label' => 'Noise', 'score' => '4.1', 'percent' => 82],
        ['label' => 'Cleaning', 'score' => '4.6', 'percent' => 92],
    ];

    $filters = [
        ['key' => 'all', 'label' => 'All 312', 'active' => true],
        ['key' => 'photos', 'label' => 'With photos'],
        ['key' => 'verified', 'label' => 'Verified buyers'],
    ];

    $reviews = [
        [
            'name' => 'Tsai Yi-chun',
            'initials' => 'TY',
            'stars' => 5,
            'date' => '11 Jan 2026',
            'setup' => 'Linea Mini · 3 kg a week',
            'title' => 'Two months on a bar, no drift',
            'body' => 'We swapped it in on a Tuesday and by Thursday nobody was touching the dial between the espresso and the batch brew. Step 14 in the morning, step 64 after lunch, and it comes back to the same shot both ways. The old grinder needed a nudge every service.',
            'photos' => true,
            'verified' => true,
            'helpful' => 42,
        ],
        [
            'name' => 'Marcus Feld',
            'initials' => 'MF',
            'stars' => 4,
            'date' => '2 Jan 2026',
            'setup' => 'Silvia Pro · home',
            'title' => 'Loud enough that I grind the night before',
            'body' => 'No complaints about the coffee. But the flat is small and the first shot is at 5:40, so I dose into the cup the night before and let it sit. Seven seconds of it is fine at nine in the morning, less fine before dawn. Knocking a star off for that alone.',
            'photos' => false,
            'verified' => true,
            'helpful' => 118,
            'reply' => 'That is the honest trade for an 83 mm burr at 1,400 rpm. The rubber feet in the accessory box take about 3 dB off if the counter is resonating — happy to send you a set.',
        ],
        [
            'name' => 'Priya Raman',
            'initials' => 'PR',
            'stars' => 5,
            'date' => '28 Dec 2025',
            'setup' => 'V60 and Aeropress',
            'title' => 'Light roasts finally taste like the bag says',
            'body' => 'I bought it for filter only, which everyone told me was overkill. The washed Ethiopians I was giving up on are the reason I kept it. Same beans, same recipe, and the cup is sweet instead of thin. Retention is genuinely under a tenth of a gram — I weighed in and out for a week to check.',
            'photos' => true,
            'verified' => true,
            'helpful' => 76,
        ],
        [
            'name' => 'Danny Okafor',
            'initials' => 'DO',
            'stars' => 3,
            'date' => '19 Dec 2025',
            'setup' => 'Two cafés · 11 kg a week',
            'title' => 'Great grinder, the chute needs a habit',
            'body' => 'Grind quality is not in question. But on a humid week the chute cakes up if nobody brushes it, and we lost a morning working out why doses were creeping light. It is a two-second job once it is on the opening list. Would be four stars if the anti-static ring handled that on its own.',
            'photos' => false,
            'verified' => true,
            'helpful' => 54,
        ],
        [
            'name' => 'Sofia Lindqvist',
            'initials' => 'SL',
            'stars' => 5,
            'date' => '6 Dec 2025',
            'setup' => 'Home · Jade finish',
            'title' => 'The Jade batch was worth the wait',
            'body' => 'Ordered in October, arrived in the second week of December, charged the day it shipped exactly as they said. The anodising is deeper than the photos manage and it has not marked at all next to a stainless kettle. Alignment sheet in the box was signed by a person, which I did not expect at this price.',
            'photos' => true,
            'verified' => true,
            'helpful' => 31,
        ],
        [
            'name' => 'Ben Whitfield',
            'initials' => 'BW',
            'stars' => 5,
            'date' => '30 Nov 2025',
            'setup' => 'Roastery QC bench',
            'title' => 'We use it to cup, which says enough',
            'body' => 'Cupping means the same grind on twenty samples in a row with nothing carried between them. Nothing under three thousand dollars did that in our tests. Burrs come out in a minute for a brush between tables, and the shim kit meant we could set the zero exactly where our old bench grinder had it.',
            'photos' => false,
            'verified' => true,
            'helpful' => 89,
        ],
    ];
@endphp

<x-templates.product.shell active="Reviews">
    <div data-reviews>
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-cream">312 people wrote about living with it</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    Only buyers can post, one review per order, and we do not take anything down for being unkind. The three-star ones are usually the most useful.
                </p>
            </div>
            <span class="font-mono text-[11px] text-zinc-600">96% would buy it again</span>
        </div>

        <div class="mt-8 grid items-start gap-6 lg:grid-cols-[20rem_minmax(0,1fr)]">
            <div class="flex flex-col gap-4 lg:sticky lg:top-32">
                <div class="rounded-2xl border border-white/8 bg-ink-900 p-6">
                    <div class="flex items-end gap-4">
                        <span class="text-5xl font-semibold tracking-tight text-cream">4.8</span>
                        <div class="pb-1">
                            <x-ui.rating :value="5" readonly class="[&>span:last-child]:hidden" />
                            <p class="mt-1 font-mono text-[10px] text-zinc-600">312 reviews · 298 verified</p>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-col gap-0.5">
                        @foreach ($distribution as $row)
                            <x-templates.product.review-bar :stars="$row['stars']" :count="$row['count']" :percent="$row['percent']" />
                        @endforeach
                    </div>

                    <div class="mt-5 border-t border-white/5 pt-5">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Rated on</p>
                        <div class="mt-3 flex flex-col gap-3">
                            @foreach ($traits as $trait)
                                <div>
                                    <div class="flex items-baseline justify-between gap-3">
                                        <span class="text-[12px] text-zinc-400">{{ $trait['label'] }}</span>
                                        <span class="font-mono text-[11px] text-zinc-500">{{ $trait['score'] }}</span>
                                    </div>
                                    <div class="mt-1.5 h-1 overflow-hidden rounded-full bg-ink-800">
                                        <span class="block h-full rounded-full bg-jade-500/70" style="width: {{ $trait['percent'] }}%"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <p class="text-[13px]/6 text-zinc-400">Bought one? Tell the next person what surprised you — good or bad. It takes about four minutes.</p>
                    <x-ui.button variant="secondary" size="sm" class="mt-4 w-full">Write a review</x-ui.button>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <div class="flex flex-wrap items-center gap-2 rounded-xl border border-white/8 bg-ink-900 px-4 py-3">
                    @foreach ($filters as $filter)
                        <button type="button" data-review-filter="{{ $filter['key'] }}" @if ($filter['active'] ?? false) data-active @endif
                            class="rounded-full border border-white/8 px-3 py-1.5 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:border-jade-500/50 data-active:bg-jade-500/10 data-active:text-jade-300">{{ $filter['label'] }}</button>
                    @endforeach

                    <span class="ml-auto font-mono text-[10px] text-zinc-600">
                        showing <span data-review-count>{{ count($reviews) }}</span> of {{ count($reviews) }} loaded
                    </span>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach ($reviews as $review)
                        <article data-review data-stars="{{ $review['stars'] }}" data-photos="{{ $review['photos'] ? 'true' : 'false' }}" data-verified="{{ $review['verified'] ? 'true' : 'false' }}"
                            class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="grid size-9 shrink-0 place-items-center rounded-full border border-white/10 bg-ink-950 font-mono text-[11px] text-zinc-400">{{ $review['initials'] }}</span>

                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-[13px] text-zinc-200">{{ $review['name'] }}</span>
                                        @if ($review['verified'])
                                            <span class="inline-flex items-center gap-1 font-mono text-[10px] text-jade-400">
                                                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                verified
                                            </span>
                                        @endif
                                    </div>
                                    <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $review['setup'] }}</p>
                                </div>

                                <div class="ml-auto flex shrink-0 items-center gap-3">
                                    <x-ui.rating :value="$review['stars']" readonly class="[&>span:last-child]:hidden [&_svg]:size-3.5!" />
                                    <span class="font-mono text-[10px] text-zinc-600">{{ $review['date'] }}</span>
                                </div>
                            </div>

                            <h2 class="mt-4 text-[15px] font-medium text-cream">{{ $review['title'] }}</h2>
                            <p class="mt-2 text-[13px]/6 text-zinc-400">{{ $review['body'] }}</p>

                            @if ($review['photos'])
                                <div class="mt-4 flex gap-2">
                                    @foreach (range(1, 3) as $photo)
                                        <span class="dot-grid grid size-16 place-items-center rounded-lg border border-white/8 bg-ink-950">
                                            <svg class="size-4 text-zinc-700" viewBox="0 0 16 16" fill="none"><rect x="2" y="3" width="12" height="10" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="m4 11 3-3 2.5 2.5L11 9l1.5 2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            @isset($review['reply'])
                                <div class="mt-4 rounded-xl border border-white/8 bg-ink-950 p-4">
                                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">NOMAD Supply replied</p>
                                    <p class="mt-2 text-[13px]/6 text-zinc-400">{{ $review['reply'] }}</p>
                                </div>
                            @endisset

                            <div class="mt-4 flex flex-wrap items-center gap-3 border-t border-white/5 pt-3.5">
                                <span class="font-mono text-[10px] text-zinc-600">{{ $review['helpful'] }} found this useful</span>
                                <div class="ml-auto flex items-center gap-1.5">
                                    <button type="button" class="rounded-lg border border-white/8 px-2.5 py-1 font-mono text-[10px] text-zinc-500 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Useful</button>
                                    <button type="button" class="rounded-lg px-2.5 py-1 font-mono text-[10px] text-zinc-600 transition-colors duration-150 outline-none hover:text-zinc-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Report</button>
                                </div>
                            </div>
                        </article>
                    @endforeach

                    <p data-review-empty class="hidden rounded-2xl border border-dashed border-white/10 px-5 py-10 text-center text-[13px] text-zinc-600">
                        Nothing loaded matches that filter yet. The next page might.
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-white/8 bg-ink-900 px-4 py-3">
                    <span class="font-mono text-[10px] text-zinc-600">6 of 312 · sorted by most useful</span>
                    <x-ui.button variant="secondary" size="sm">Load 20 more</x-ui.button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-reviews]');

            if (!root) {
                return;
            }

            const cards = root.querySelectorAll('[data-review]');
            const count = root.querySelector('[data-review-count]');
            const empty = root.querySelector('[data-review-empty]');

            const matches = (card, filter) => {
                if (filter === 'all') {
                    return true;
                }

                if (filter === 'photos' || filter === 'verified') {
                    return card.dataset[filter] === 'true';
                }

                return card.dataset.stars === filter;
            };

            root.addEventListener('click', (event) => {
                const button = event.target.closest('[data-review-filter]');

                if (!button) {
                    return;
                }

                const filter = button.dataset.reviewFilter;
                let shown = 0;

                root.querySelectorAll('[data-review-filter]').forEach((control) => {
                    control.toggleAttribute('data-active', control === button);
                });

                cards.forEach((card) => {
                    const visible = matches(card, filter);

                    card.classList.toggle('hidden', !visible);
                    shown += visible ? 1 : 0;
                });

                count.textContent = shown;
                empty.classList.toggle('hidden', shown > 0);
            });
        })();
    </script>
</x-templates.product.shell>
