@php
    $rules = [
        [
            'reason' => 'You changed your mind',
            'window' => 'within 30 days',
            'condition' => 'Back in any box that will survive the trip, with the burr tool and the cable. No more than a kilo of coffee through it.',
            'freight' => 'you',
            'back' => 'all',
            'note' => 'The law here gives you seven days to change your mind on something bought online. We give thirty, and the four extra weeks are the reason a third of these come back in the last ten days.',
        ],
        [
            'reason' => 'It arrived broken',
            'window' => 'within 30 days',
            'condition' => 'A photograph of the damage and the box it came in. Keep the packaging until we have seen the picture — the courier claim needs it, not us.',
            'freight' => 'us',
            'back' => 'all',
            'note' => 'A replacement leaves the bench the same afternoon if you want one instead. Nine people out of ten do.',
        ],
        [
            'reason' => 'The wrong thing arrived',
            'window' => 'no window',
            'condition' => 'Tell us what is in the box. The right one goes out before yours comes back, and the courier collects the wrong one on the way through.',
            'freight' => 'us',
            'back' => 'all',
            'note' => 'Seven of these in seven years, and every one of them was a picking mistake at this end.',
        ],
        [
            'reason' => 'You cancelled before it shipped',
            'window' => 'any time before dispatch',
            'condition' => 'Nothing to send back. Say the word and the charge is reversed the same day.',
            'freight' => 'none',
            'back' => 'all',
            'note' => 'Jade bodies are anodised in batches, so an order can sit unshipped for three weeks. That whole time this row applies.',
        ],
        [
            'reason' => 'It stopped working',
            'window' => 'within 2 years',
            'condition' => 'We repair it first — that is what a warranty is. A refund happens when the same fault comes back a third time, and it has twice.',
            'freight' => 'us',
            'back' => 'part',
            'note' => 'Full price back in the first year. After that we take off a twelfth of the price for every month you had it working, which on a machine at 18 months is about $170.',
        ],
        [
            'reason' => 'It has ground more than a kilo',
            'window' => 'within 30 days',
            'condition' => 'Still comes back. Burrs that have been through more than a kilo cannot be sold as new, so a fresh set goes in before it does.',
            'freight' => 'you',
            'back' => 'part',
            'note' => '$40 comes off, which is what the burr set costs us. It is the only deduction on this page and we waive it when the reason you are sending it back is our fault.',
        ],
        [
            'reason' => 'Anodised in a colour we do not stock',
            'window' => 'no window',
            'condition' => 'Jade, Rust and the two bar colours are run to order in batches of sixty. A returned one sits on the shelf until somebody wants that exact colour, and mostly nobody does.',
            'freight' => 'none',
            'back' => 'none',
            'note' => 'Faulty is a different row — this one is only about changing your mind. It is said before you pay, on the configure screen, in the same size as the price.',
        ],
        [
            'reason' => 'Cleaning tablets, opened',
            'window' => 'no window',
            'condition' => 'Sealed packs come back like anything else. Once the foil is off we cannot put them on the shelf again.',
            'freight' => 'none',
            'back' => 'none',
            'note' => 'Eighteen dollars. We have argued about this internally more than it is worth.',
        ],
    ];

    $filters = [
        ['key' => 'all-rules', 'label' => 'All eight'],
        ['key' => 'all', 'label' => 'Every cent back'],
        ['key' => 'part', 'label' => 'Most of it'],
        ['key' => 'none', 'label' => 'Nothing'],
    ];
@endphp

<x-templates.refund.shell active="The policy">
    <x-slot:toolbar>
        <div data-policy-bar class="flex flex-wrap items-center gap-x-2 gap-y-2">
            @foreach ($filters as $filter)
                <button type="button" data-policy-filter="{{ $filter['key'] }}"
                    @if ($loop->first) data-active @endif
                    class="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300">{{ $filter['label'] }}</button>
            @endforeach

            <span data-policy-count class="ml-auto font-mono text-[10px] text-zinc-600">showing all eight</span>
        </div>
    </x-slot:toolbar>

    <div data-policy class="mx-auto max-w-6xl">

        <h1 class="text-lg font-semibold tracking-tight text-cream">Eight ways a grinder comes back</h1>
        <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
            A refund policy is only readable if it says how much money follows the machine, so that is the right-hand column
            on every row. Four of these give you everything, two give you most of it, and two are a no — printed in the same
            size as the rest rather than three paragraphs down.
        </p>

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
            <section>
                <div class="divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                    @foreach ($rules as $rule)
                        <x-templates.refund.rule
                            :reason="$rule['reason']"
                            :window="$rule['window']"
                            :condition="$rule['condition']"
                            :freight="$rule['freight']"
                            :back="$rule['back']"
                            :note="$rule['note']" />
                    @endforeach
                </div>

                <p data-policy-empty class="mt-3 hidden rounded-xl border border-white/8 bg-ink-900 px-3.5 py-6 text-center text-[12px] text-zinc-600">
                    Nothing under that heading, which is the answer you wanted.
                </p>

                <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The one deduction, worked out</p>
                    <p class="mt-2 max-w-2xl text-[12px]/5 text-zinc-400">
                        A machine that has ground more than a kilo gets a new burr set before it is sold again, and $40 is what
                        that set costs us from the grinder house in Nagano. We do not round it up, we do not call it a
                        restocking fee, and it does not apply when the machine is coming back because of something we did.
                    </p>
                    <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4">
                        @foreach ([['Burr set, 83 mm', '$40'], ['Our labour', '$0'], ['Restocking', '$0'], ['Inspection', '$0']] as [$label, $value])
                            <div class="rounded-lg border border-white/8 px-2.5 py-2">
                                <p class="font-mono text-[10px] text-zinc-600">{{ $label }}</p>
                                <p class="mt-1 font-mono text-[13px] text-cream">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <aside>
                <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The clocks, if you bought on 26 July</h2>
                <p class="mt-2 text-[12px]/5 text-zinc-500">
                    Dated from the day the courier says it reached you, not the day you paid. Three weeks waiting on a Jade
                    body has never counted against anybody.
                </p>

                <div class="mt-3 flex flex-col gap-3">
                    <x-templates.refund.window id="window-mind" label="Changed your mind" :span="30" unit="days" :used="23" then="after that it is the warranty or nothing" />
                    <x-templates.refund.window id="window-broken" label="Arrived broken" :span="30" unit="days" :used="23" then="tell us on day one and the clock stops" />
                    <x-templates.refund.window id="window-fault" label="Stopped working" :span="24" unit="months" :used="1" then="repair, repair, then your money" />
                    <x-templates.refund.window id="window-parts" label="Parts on the shelf" :span="10" unit="years" :used="0" then="burrs, boards, knobs, the lot" closed />
                </div>

                <div class="mt-7 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where the seven days comes from</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        消費者保護法 §19 gives you seven days from delivery to send back anything bought at a distance, no reason
                        required. Nothing on this page can take that away, and everything above it is us going further than the
                        law asks — which is worth saying plainly, because a policy that quietly restates the statute and calls
                        it generosity is the oldest trick on the internet.
                    </p>
                </div>

                <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Before you box it</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        A third of the machines that come back for noise are burrs bedding in, and they go home again unchanged.
                        Twenty minutes with the help centre is worth trying before you spend an afternoon at the courier office.
                    </p>
                    <a href="{{ route('templates.screen', ['faq', 'answer']) }}" target="_top"
                        class="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Read the noise answer first</a>
                </div>
            </aside>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-policy]');
            const bar = document.querySelector('[data-policy-bar]');

            if (!root || !bar) {
                return;
            }

            const rows = [...root.querySelectorAll('[data-rule]')];
            const empty = root.querySelector('[data-policy-empty]');
            const count = bar.querySelector('[data-policy-count]');
            const buttons = [...bar.querySelectorAll('[data-policy-filter]')];

            const spell = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];

            const apply = (key) => {
                let shown = 0;

                rows.forEach((row) => {
                    const keep = key === 'all-rules' || row.dataset.back === key;

                    row.classList.toggle('hidden', !keep);
                    shown += keep ? 1 : 0;
                });

                buttons.forEach((button) => button.toggleAttribute('data-active', button.dataset.policyFilter === key));
                empty.classList.toggle('hidden', shown > 0);
                count.textContent = key === 'all-rules' ? 'showing all eight' : `showing ${spell[shown]} of eight`;
            };

            buttons.forEach((button) => button.addEventListener('click', () => apply(button.dataset.policyFilter)));
        })();
    </script>
</x-templates.refund.shell>
