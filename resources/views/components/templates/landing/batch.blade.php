@php
    $finishes = [
        [
            'key' => 'graphite',
            'name' => 'Graphite',
            'swatch' => 'bg-finish-graphite',
            'left' => 28,
            'ships' => 'w/c 12 Oct',
            'note' => 'The anodised black. Nine in ten machines we have ever made, and the one that hides a dropped-on-tile dent best.',
        ],
        [
            'key' => 'cream',
            'name' => 'Cream',
            'swatch' => 'bg-finish-cream',
            'left' => 11,
            'ships' => 'w/c 19 Oct',
            'note' => 'A week behind the others because the coating shop runs light colours last. Shows coffee oil at the catch thread until you learn to wipe it.',
        ],
        [
            'key' => 'jade',
            'name' => 'Jade',
            'swatch' => 'bg-finish-jade',
            'left' => 7,
            'ships' => 'w/c 26 Oct',
            'note' => 'Thirty machines a batch, seven left, and the only one that has ever sold out before the batch was cut. It is the same machine underneath.',
        ],
    ];

    $steps = [
        ['when' => '2 Sep', 'title' => 'The list closes and the batch is cut', 'body' => 'Cards are charged that morning. Anyone who has changed their mind before then pays nothing and does not have to say why.', 'state' => 'next'],
        ['when' => '8 Sep', 'title' => 'Castings land from Taichung', 'body' => '190 bodies for 180 machines. The ten spare are the margin the last four batches say we need.', 'state' => 'later'],
        ['when' => '15 Sep – 3 Oct', 'title' => 'Anodising, in three colour runs', 'body' => 'The coating shop takes graphite first and cream last. This is where batch 39 lost eight of its eleven weeks.', 'state' => 'later'],
        ['when' => '6 – 9 Oct', 'title' => 'Assembly, four of us at the bench', 'body' => 'About 45 machines a day. Every one is ground with 25 g of the house filter roast before it is boxed, and the sheet goes in the box.', 'state' => 'later'],
        ['when' => 'w/c 12 Oct', 'title' => 'Boxes leave, graphite first', 'body' => 'Taiwan next day, everywhere else four to nine days. Tracking goes out the afternoon the box is picked up.', 'state' => 'later'],
    ];

    $history = [
        ['batch' => '40', 'cut' => 'Mar 2026', 'made' => 180, 'promised' => 'w/c 20 Apr', 'shipped' => 'w/c 20 Apr', 'slip' => 'on the day', 'tone' => 'ok'],
        ['batch' => '39', 'cut' => 'Oct 2025', 'made' => 180, 'promised' => 'w/c 24 Nov', 'shipped' => 'w/c 9 Feb', 'slip' => '11 weeks late', 'tone' => 'bad'],
        ['batch' => '38', 'cut' => 'Jun 2025', 'made' => 150, 'promised' => 'w/c 21 Jul', 'shipped' => 'w/c 28 Jul', 'slip' => '1 week late', 'tone' => 'warn'],
        ['batch' => '37', 'cut' => 'Feb 2025', 'made' => 150, 'promised' => 'w/c 24 Mar', 'shipped' => 'w/c 24 Mar', 'slip' => 'on the day', 'tone' => 'ok'],
        ['batch' => '36', 'cut' => 'Oct 2024', 'made' => 150, 'promised' => 'w/c 25 Nov', 'shipped' => 'w/c 2 Dec', 'slip' => '1 week late', 'tone' => 'warn'],
    ];
@endphp

<x-templates.landing.shell active="The next batch" ribbon="Batch 41 closes on 2 September. Nothing is charged before that morning.">
    <div class="mx-auto max-w-5xl">

        <header class="flex flex-wrap items-end justify-between gap-6">
            <div class="max-w-xl">
                <p class="flex items-center gap-2 font-mono text-[11px] tracking-wider text-jade-400 uppercase">
                    <span class="h-px w-6 bg-jade-500/50"></span>
                    batch 41 of 41
                </p>
                <h1 class="mt-4 text-3xl leading-[1.15] font-semibold tracking-tight text-balance text-cream">180 machines, 46 places, and the eleven weeks we ran late last autumn.</h1>
                <p class="mt-4 text-[14px]/7 text-zinc-400">
                    We make grinders in batches because four people and one anodising shop cannot do it any other way. The
                    dates below are what we believe. The table at the bottom is what actually happened the last five times
                    we believed something.
                </p>
            </div>

            <div class="w-full shrink-0 rounded-2xl border border-white/8 bg-ink-900/60 p-4 sm:w-72">
                <x-templates.landing.bar
                    label="Spoken for"
                    :value="134"
                    :max="180"
                    display="134 / 180"
                    tone="ours"
                    note="Batch 40 filled with nine days to spare. Batch 39 filled in four." />

                <dl class="mt-4 flex flex-col gap-2 border-t border-white/6 pt-3">
                    @foreach ([['list closes', '2 Sep 2026'], ['charged', 'that morning'], ['price', 'NT$4,200']] as $row)
                        <div class="flex items-baseline justify-between gap-2">
                            <dt class="text-[11px] text-zinc-600">{{ $row[0] }}</dt>
                            <dd class="font-mono text-[11px] text-zinc-400">{{ $row[1] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </header>

        <section data-batch class="mt-12 grid grid-cols-1 gap-3 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,1fr)]">
            <div class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                <h2 class="text-[15px] font-medium tracking-tight text-cream">Pick a finish, then leave an address</h2>
                <p class="mt-1.5 text-[12px]/5 text-zinc-500">The finish decides which week your box goes out, because the coating shop runs one colour at a time.</p>

                <div class="mt-5 flex flex-col gap-2">
                    @foreach ($finishes as $finish)
                        <button type="button" data-finish="{{ $finish['key'] }}"
                            data-payload="{{ json_encode(['name' => $finish['name'], 'left' => $finish['left'], 'ships' => $finish['ships'], 'note' => $finish['note']]) }}"
                            @class([
                                'flex items-center gap-3 rounded-xl border px-3.5 py-3 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                'border-jade-500/50 bg-jade-500/8' => $loop->first,
                                'border-white/8 hover:border-white/20' => ! $loop->first,
                            ])>
                            <span class="size-6 shrink-0 rounded-full border border-white/15 {{ $finish['swatch'] }}"></span>

                            <span class="min-w-0 flex-1">
                                <span class="flex items-baseline gap-2">
                                    <span class="text-[13px] text-cream">{{ $finish['name'] }}</span>
                                    <span class="font-mono text-[10px] text-zinc-600">{{ $finish['left'] }} left</span>
                                </span>
                                <span class="mt-0.5 block text-[11px]/5 text-zinc-500">ships {{ $finish['ships'] }}</span>
                            </span>

                            <span @class([
                                'size-4 shrink-0 rounded-full border',
                                'border-jade-400 bg-jade-500' => $loop->first,
                                'border-white/15' => ! $loop->first,
                            ]) data-finish-tick></span>
                        </button>
                    @endforeach
                </div>

                <div class="mt-5 flex flex-col gap-2.5 border-t border-white/6 pt-5">
                    <label class="flex flex-col gap-1.5">
                        <span class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where the mail goes</span>
                        <input type="email" placeholder="you@example.com"
                            class="rounded-xl border border-white/10 bg-ink-900 px-3 py-2.5 text-[13px] text-cream outline-none transition-colors duration-150 placeholder:text-zinc-700 focus:border-jade-500/60">
                    </label>

                    <label class="flex items-start gap-2.5 py-1">
                        <input type="checkbox" checked class="mt-0.5 size-3.5 shrink-0 accent-jade-500">
                        <span class="text-[11px]/5 text-zinc-500">Tell me if the dates move. Two mails last batch, both of them bad news, both sent the day we knew.</span>
                    </label>

                    <button type="button"
                        class="mt-1 inline-flex items-center justify-center gap-2 rounded-xl bg-jade-500 px-4 py-2.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        Hold a <span data-finish-name>Graphite</span> in batch 41
                    </button>

                    <p class="font-mono text-[10px] text-zinc-700">no card taken now · leave the list any time before 2 Sep</p>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <div class="rounded-2xl border border-jade-500/25 bg-jade-500/5 p-5">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">What you would be holding</p>

                    <dl class="mt-3 flex flex-col gap-2.5">
                        <div class="flex items-baseline justify-between gap-3 border-b border-white/6 pb-2.5">
                            <dt class="text-[12px] text-zinc-500">finish</dt>
                            <dd data-finish-name class="font-mono text-[12px] text-cream"></dd>
                        </div>

                        <div class="flex items-baseline justify-between gap-3 border-b border-white/6 pb-2.5">
                            <dt class="text-[12px] text-zinc-500">ships</dt>
                            <dd data-finish-ships class="font-mono text-[12px] text-cream"></dd>
                        </div>

                        <div class="flex items-baseline justify-between gap-3 border-b border-white/6 pb-2.5">
                            <dt class="text-[12px] text-zinc-500">left in that colour</dt>
                            <dd data-finish-left class="font-mono text-[12px] text-cream"></dd>
                        </div>

                        <div class="flex items-baseline justify-between gap-3">
                            <dt class="text-[12px] text-zinc-500">price</dt>
                            <dd class="font-mono text-[12px] text-cream">NT$4,200</dd>
                        </div>
                    </dl>

                    <p data-finish-note class="mt-4 border-t border-white/6 pt-3 text-[12px]/5 text-zinc-400"></p>
                </div>

                <div class="rounded-2xl border border-white/8 bg-ink-900/50 p-5">
                    <h3 class="text-[13px] font-medium tracking-tight text-cream">If the jade runs out while you are reading this</h3>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-500">
                        The page will say so and your place moves to graphite unless you tell us otherwise. We do not hold
                        colours back to make a number look small — the seven are seven.
                    </p>
                </div>
            </div>
        </section>

        <section class="mt-14">
            <div class="flex items-baseline gap-3">
                <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">What happens between the money and the box</h2>
                <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                <span class="shrink-0 font-mono text-[10px] text-zinc-700">six weeks, if nothing goes wrong</span>
            </div>

            <ol class="mt-5 flex flex-col">
                @foreach ($steps as $step)
                    <li class="flex gap-4">
                        <div class="flex shrink-0 flex-col items-center">
                            <span @class([
                                'mt-1 size-2.5 rounded-full border',
                                'border-jade-400 bg-jade-500' => $step['state'] === 'next',
                                'border-white/20 bg-ink-900' => $step['state'] !== 'next',
                            ])></span>
                            @unless ($loop->last)
                                <span class="w-px flex-1 bg-white/8"></span>
                            @endunless
                        </div>

                        <div @class(['min-w-0 flex-1', 'pb-6' => ! $loop->last])>
                            <div class="flex flex-wrap items-baseline gap-x-3">
                                <span class="font-mono text-[11px] text-jade-300">{{ $step['when'] }}</span>
                                <h3 class="text-[13px]/5 text-cream">{{ $step['title'] }}</h3>
                            </div>
                            <p class="mt-1.5 max-w-2xl text-[12px]/5 text-zinc-500">{{ $step['body'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </section>

        <section class="mt-12">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <div class="max-w-lg">
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">The last five times we gave a date</h2>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-500">
                        Two on the day, two a week out, and one that went eleven weeks over because the anodising shop lost a
                        line for a month and we did not have a second one. We do now.
                    </p>
                </div>
                <span class="shrink-0 font-mono text-[10px] text-zinc-700">batches 36 – 40</span>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-white/8 bg-ink-950">
                <table class="w-full min-w-lg border-collapse text-left">
                    <thead>
                        <tr class="border-b border-white/8">
                            @foreach (['batch', 'cut', 'machines', 'promised', 'shipped', ''] as $head)
                                <th class="px-4 py-2.5 font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">{{ $head }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $row)
                            <tr @class(['border-t border-white/5' => ! $loop->first])>
                                <td class="px-4 py-3 font-mono text-[12px] text-cream">{{ $row['batch'] }}</td>
                                <td class="px-4 py-3 text-[12px] text-zinc-500">{{ $row['cut'] }}</td>
                                <td class="px-4 py-3 font-mono text-[12px] tabular-nums text-zinc-400">{{ $row['made'] }}</td>
                                <td class="px-4 py-3 font-mono text-[12px] text-zinc-500">{{ $row['promised'] }}</td>
                                <td class="px-4 py-3 font-mono text-[12px] text-zinc-300">{{ $row['shipped'] }}</td>
                                <td class="px-4 py-3">
                                    <span @class([
                                        'inline-flex items-center rounded-lg border px-2 py-0.5 font-mono text-[10px]',
                                        'border-jade-500/30 text-jade-300' => $row['tone'] === 'ok',
                                        'border-amber-400/30 text-amber-300' => $row['tone'] === 'warn',
                                        'border-red-400/30 text-red-400' => $row['tone'] === 'bad',
                                    ])>{{ $row['slip'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="mt-3 font-mono text-[10px] text-zinc-700">everybody on batch 39 was offered their money back at week four, week seven and week ten · 14 of 180 took it</p>
        </section>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-batch]');

            if (!root) {
                return;
            }

            const buttons = [...root.querySelectorAll('[data-finish]')];
            const names = [...root.querySelectorAll('[data-finish-name]')];
            const ships = root.querySelector('[data-finish-ships]');
            const left = root.querySelector('[data-finish-left]');
            const note = root.querySelector('[data-finish-note]');

            const apply = (key) => {
                buttons.forEach((button) => {
                    const on = button.dataset.finish === key;
                    const tick = button.querySelector('[data-finish-tick]');

                    button.classList.toggle('border-jade-500/50', on);
                    button.classList.toggle('bg-jade-500/8', on);
                    button.classList.toggle('border-white/8', !on);
                    button.classList.toggle('hover:border-white/20', !on);

                    tick.classList.toggle('border-jade-400', on);
                    tick.classList.toggle('bg-jade-500', on);
                    tick.classList.toggle('border-white/15', !on);
                });

                const chosen = JSON.parse(buttons.find((button) => button.dataset.finish === key).dataset.payload);

                names.forEach((slot) => { slot.textContent = chosen.name; });
                ships.textContent = chosen.ships;
                left.textContent = `${chosen.left} of 180`;
                note.textContent = chosen.note;
            };

            buttons.forEach((button) => button.addEventListener('click', () => apply(button.dataset.finish)));
            apply('graphite');
        })();
    </script>
</x-templates.landing.shell>
