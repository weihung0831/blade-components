@php
    $objections = [
        [
            'who' => 'You pull espresso every morning',
            'body' => 'Ninety seconds of cranking at a fine setting is work, and you will do it before you are properly awake. Three of our 214 returns were espresso drinkers who lasted under a month, and all three had read this paragraph first.',
            'instead' => 'The NT$12,000 electric we lose to',
            'instead-price' => 'named on the measurements page',
            'tone' => 'hard',
            'heard' => 96,
            'cost' => 4200,
        ],
        [
            'who' => 'You grind more than 30 g at a go',
            'body' => 'The catch holds 40 g and the machine is built around one or two cups. A cafe trialled six of these in 2023 and came back inside the sixty days, politely, with the burr wear to show for it.',
            'instead' => 'A second-hand batch grinder',
            'instead-price' => 'around NT$18,000, and worth every bit',
            'tone' => 'hard',
            'heard' => 41,
            'cost' => 4200,
        ],
        [
            'who' => 'You already own a Mk2 that still turns',
            'body' => 'The Mk3 is four points better on spread and takes the same crank. Four points is not NT$4,200. Put a fresh burr set in the machine you have and spend the difference on coffee that deserves it.',
            'instead' => 'A 38 mm burr set for the Mk2',
            'instead-price' => 'NT$780, in stock, fits in four minutes',
            'tone' => 'hard',
            'heard' => 88,
            'cost' => 3420,
        ],
        [
            'who' => 'You are buying it as a present for someone who does not make coffee yet',
            'body' => 'It arrives, it is beautiful, and it sits in a cupboard because they have no grinder habit to hang it on. We have watched this happen 31 times and it is the returns reason that makes everybody feel worst.',
            'instead' => 'Beans and a NT$450 dripper first',
            'instead-price' => 'come back in a year if it took',
            'tone' => 'soft',
            'heard' => 31,
            'cost' => 3750,
        ],
        [
            'who' => 'You want something that looks unlike anything else on the counter',
            'body' => 'It is a black aluminium tube with a crank on top. The cream one is a slightly warmer tube. There are grinders made of walnut and brass that will do more for a kitchen than this ever will, and they grind perfectly well.',
            'instead' => 'Any of the wood-bodied Japanese ones',
            'instead-price' => 'NT$5,000 up, and they are lovely',
            'tone' => 'soft',
            'heard' => 17,
            'cost' => 4200,
        ],
        [
            'who' => 'You grind one filter cup a day and would rather not hear a motor at six in the morning',
            'body' => 'Then this is the machine, and everything else on this site is us trying to talk you out of a purchase you should probably make. 62% in the window, parts to 2030, sixty days to change your mind after using it.',
            'instead' => 'The Mk3, batch 41',
            'instead-price' => 'NT$4,200, 46 places left',
            'tone' => 'fine',
            'heard' => 0,
            'cost' => 0,
        ],
    ];

    usort($objections, fn (array $a, array $b): int => $b['heard'] <=> $a['heard']);

    $beaten = [
        [
            'mark' => 'beats us',
            'title' => 'The NT$12,000 electric, on grind and on speed',
            'body' => 'Nine points better in the window and it does the work for you. If you grind daily for more than one person, the arithmetic is not close and we are not going to pretend otherwise.',
            'meta' => 'we bought one at retail to test against',
        ],
        [
            'mark' => 'beats us',
            'title' => 'The wood-bodied Japanese ones, on wanting to look at it',
            'body' => 'Two points behind us on spread, and nobody who owns one cares. A grinder you like the look of gets used, and a grinder that gets used beats a better grinder in a cupboard.',
            'meta' => 'the one on our own bench is a Kalita',
        ],
    ];

    $returns = [
        ['label' => 'Slower than they had pictured', 'value' => 78, 'display' => '78', 'tone' => 'warn', 'note' => 'The number that made us write this page. Every one of them is a person we could have warned in advance and did not.'],
        ['label' => 'Bought it for espresso', 'value' => 52, 'display' => '52', 'tone' => 'bad', 'note' => 'It will grind espresso. Doing it at 6 a.m. every day is the part nobody enjoys.'],
        ['label' => 'A present that missed', 'value' => 31, 'display' => '31', 'tone' => 'warn', 'note' => 'Usually returned by the person who was given it, apologising, which is not how any of this should go.'],
        ['label' => 'Collar came loose and that was that', 'value' => 24, 'display' => '24', 'tone' => 'bad', 'note' => 'Fair. A two-minute fix is still a fix you did not sign up for on a new machine.'],
        ['label' => 'Arrived damaged', 'value' => 18, 'display' => '18', 'tone' => 'quiet', 'note' => 'Fourteen of them in one autumn, one courier, since replaced.'],
        ['label' => 'No reason given', 'value' => 11, 'display' => '11', 'tone' => 'quiet', 'note' => 'The box comes back, the money goes out, we do not chase it.'],
    ];
@endphp

<x-templates.landing.shell active="Not for you" ribbon="This page exists because 78 machines came back from people who thought it would be faster.">
    <div class="mx-auto max-w-5xl">

        <header class="max-w-2xl">
            <p class="flex items-center gap-2 font-mono text-[11px] tracking-wider text-jade-400 uppercase">
                <span class="h-px w-6 bg-jade-500/50"></span>
                the talking-out-of-it page
            </p>
            <h1 class="mt-4 text-3xl leading-[1.15] font-semibold tracking-tight text-balance text-cream">Five people who should buy something else, and what they should buy.</h1>
            <p class="mt-4 text-[14px]/7 text-zinc-400">
                A refund costs us about NT$900 by the time the courier and the seconds shelf are paid for, so this page is
                partly self-interest. It is still the page we would want to read. Where a competitor is the right answer,
                it is named.
            </p>
        </header>

        <section data-objections class="mt-10">
            <div class="flex flex-wrap items-baseline justify-between gap-3">
                <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">Sorted by how often we hear it</h2>

                <div class="flex shrink-0 items-center gap-1 rounded-xl border border-white/8 bg-ink-900/60 p-1">
                    <button type="button" data-objection-sort="heard"
                        class="rounded-lg bg-white/8 px-2.5 py-1 text-[12px] text-cream transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70">how often</button>
                    <button type="button" data-objection-sort="cost"
                        class="rounded-lg px-2.5 py-1 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">what walking away saves you</button>
                </div>
            </div>

            <div data-objection-list class="mt-4 divide-y divide-white/5 overflow-hidden rounded-2xl border border-white/8 bg-ink-950">
                @foreach ($objections as $objection)
                    <x-templates.landing.objection
                        :data-heard="$objection['heard']"
                        :data-cost="$objection['cost']"
                        :who="$objection['who']"
                        :body="$objection['body']"
                        :instead="$objection['instead']"
                        :instead-price="$objection['instead-price']"
                        :tone="$objection['tone']"
                        href="#" />
                @endforeach
            </div>

            <p class="mt-3 font-mono text-[10px] text-zinc-700">counts are people who told us at the desk or in the returns note, Mar 2019 to Jul 2026</p>
        </section>

        <section class="mt-14">
            <div class="flex items-baseline gap-3">
                <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">Two machines that beat this one</h2>
                <span class="h-px min-w-0 flex-1 bg-white/6"></span>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach ($beaten as $machine)
                    <x-templates.landing.feature
                        :mark="$machine['mark']"
                        :title="$machine['title']"
                        :body="$machine['body']"
                        :meta="$machine['meta']"
                        tone="caveat" />
                @endforeach
            </div>
        </section>

        <section class="mt-12 rounded-2xl border border-white/8 bg-ink-900/50 p-5">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <div class="max-w-lg">
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">The 214 that came back, and what they said on the way out</h2>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-500">
                        3.5% of everything we have shipped. The top three reasons are all things a page could have told
                        somebody before they paid, which is why you are reading this one.
                    </p>
                </div>
                <span class="shrink-0 font-mono text-[10px] text-zinc-700">returns, Mar 2019 – Jul 2026</span>
            </div>

            <div class="mt-6 flex flex-col gap-5">
                @foreach ($returns as $row)
                    <x-templates.landing.bar
                        :label="$row['label']"
                        :value="$row['value']"
                        :max="78"
                        :display="$row['display']"
                        :note="$row['note']"
                        :tone="$row['tone']" />
                @endforeach
            </div>
        </section>

        <section class="mt-12 grid grid-cols-1 gap-3 lg:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]">
            <x-templates.landing.quote
                body="I sent it back in week three and told them it was too slow for how I drink coffee. They refunded it in two days and asked whether I wanted the espresso grinder they recommend, which is not theirs. I bought that instead and I still read their changelog."
                name="Marc Oliveira"
                role="Four espressos a day, no patience"
                machine="returned Mk3"
                since="returned Apr 2025" />

            <div class="flex flex-col justify-center rounded-2xl border border-jade-500/25 bg-jade-500/5 p-5">
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Still here after all that</p>
                <h2 class="mt-2 text-lg font-semibold tracking-tight text-balance text-cream">Then you are the person it was made for.</h2>
                <p class="mt-2 text-[12px]/5 text-zinc-400">
                    Batch 41 is 180 machines and 46 places are open. Nothing is charged until the batch is cut on 2 September,
                    and you can leave the list with one click until then.
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <a href="{{ route('templates.screen', ['landing', 'batch']) }}" target="_top"
                        class="inline-flex items-center gap-2 rounded-xl bg-jade-500 px-4 py-2.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Take a place in batch 41</a>
                    <span class="font-mono text-[10px] text-zinc-600">46 left</span>
                </div>
            </div>
        </section>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-objections]');

            if (!root) {
                return;
            }

            const list = root.querySelector('[data-objection-list]');
            const buttons = [...root.querySelectorAll('[data-objection-sort]')];
            const heading = root.querySelector('h2');
            const rows = [...list.children];

            const headings = {
                heard: 'Sorted by how often we hear it',
                cost: 'Sorted by what walking away saves you',
            };

            const apply = (key) => {
                buttons.forEach((button) => {
                    const on = button.dataset.objectionSort === key;

                    button.classList.toggle('bg-white/8', on);
                    button.classList.toggle('text-cream', on);
                    button.classList.toggle('text-zinc-500', !on);
                    button.classList.toggle('hover:text-cream', !on);
                });

                heading.textContent = headings[key];

                [...rows]
                    .sort((a, b) => Number(b.dataset[key]) - Number(a.dataset[key]))
                    .forEach((row) => list.appendChild(row));
            };

            buttons.forEach((button) => button.addEventListener('click', () => apply(button.dataset.objectionSort)));
        })();
    </script>
</x-templates.landing.shell>
