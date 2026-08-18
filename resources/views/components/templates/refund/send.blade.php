@php
    $reasons = [
        [
            'key' => 'mind',
            'label' => 'I have changed my mind',
            'lead' => 'Boxed, under a kilo of coffee through it, inside thirty days.',
            'freight' => 'You book it, $18 off the refund',
            'back' => '$1,180 back',
            'days' => '6 days',
            'box' => 'The grinder, the burr tool, the cable. Keep the hopper if you want it — we do not sell them separately and it is no use to us.',
            'picked' => true,
        ],
        [
            'key' => 'broken',
            'label' => 'It arrived damaged',
            'lead' => 'Send the photograph before you send the machine.',
            'freight' => 'We book the courier',
            'back' => '$1,180 back, or a new one tomorrow',
            'days' => '2 days',
            'box' => 'Everything, in the packaging it came in. The courier claim wants the box more than we do.',
        ],
        [
            'key' => 'wrong',
            'label' => 'The wrong thing turned up',
            'lead' => 'Tell us what is actually in the box.',
            'freight' => 'We book it, and the right one leaves first',
            'back' => 'The difference, or all of it',
            'days' => '1 day',
            'box' => 'Whatever arrived, sealed if it still is. Do not open it to check — the label photograph is enough.',
        ],
        [
            'key' => 'fault',
            'label' => 'It has stopped working',
            'lead' => 'Inside two years this is a repair first, and usually only a repair.',
            'freight' => 'We pay both directions',
            'back' => 'Fixed in 9 days, or your money on the third try',
            'days' => '9 days',
            'box' => 'The machine and the cable. Leave the burrs in — Wei wants to see them exactly as they came off your counter.',
        ],
        [
            'key' => 'noise',
            'label' => 'It sounds wrong',
            'lead' => 'Do not send this one yet. Read the next paragraph first.',
            'freight' => 'Nothing to send',
            'back' => 'Probably $0, and twenty minutes',
            'days' => '0 days',
            'box' => 'Nothing. A third of the machines returned for noise were burrs bedding in, and every one of them went home unchanged with the customer out an afternoon at the courier office.',
        ],
    ];

    $steps = [
        ['title' => 'You tell us', 'body' => 'This form, or a reply to any mail we have ever sent you. No form number, no ticket, no portal password.'],
        ['title' => 'A label arrives', 'body' => 'Within the hour during working hours. Print it or show the QR at any 7-11 counter — they scan it off a phone.'],
        ['title' => 'Wei opens it', 'body' => 'Usually the morning it lands. He photographs the burrs before touching anything, and you get those photographs whatever the outcome.'],
        ['title' => 'The money moves', 'body' => 'Back to the card that paid, the same day the bench signs it off. What happens after that belongs to your bank.'],
    ];
@endphp

<x-templates.refund.shell active="Send it back">
    <x-slot:toolbar>
        <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span class="font-mono text-[10px] text-zinc-500">order NS-2608-1174 · EG-83 in graphite · delivered 26 Jul</span>
            <span class="hidden font-mono text-[10px] text-zinc-700 sm:inline">day 23 of 30</span>
            <a href="{{ route('templates.screen', ['refund', 'policy']) }}" target="_top"
                class="ml-auto rounded-lg px-2.5 py-1 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:bg-white/5 hover:text-jade-300">check the rule first →</a>
        </div>
    </x-slot:toolbar>

    <div data-send class="mx-auto max-w-6xl">

        <h1 class="text-lg font-semibold tracking-tight text-cream">Pick the reason and the page does the arithmetic</h1>
        <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
            Who pays the courier, what lands back on the card, and how long it takes all fall out of one choice, so the choice
            comes first and the form comes after. One of the five reasons tells you not to send anything, which is the honest
            answer often enough that it earned a place in the list.
        </p>

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1fr_1.3fr]">
            <section>
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Why is it coming back</p>
                <div class="mt-3 flex flex-col gap-2.5">
                    @foreach ($reasons as $reason)
                        <x-templates.refund.reason
                            :key="$reason['key']"
                            :label="$reason['label']"
                            :lead="$reason['lead']"
                            :freight="$reason['freight']"
                            :back="$reason['back']"
                            :days="$reason['days']"
                            :picked="$reason['picked'] ?? false"
                            :data-box="$reason['box']" />
                    @endforeach
                </div>

                <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we will not ask for</p>
                    <ul class="mt-2.5 space-y-2">
                        @foreach ([
                            'The original box. Any box that survives the trip is fine, and the courier has never once complained.',
                            'A reason, if you picked the first option. Thirty days means thirty days.',
                            'The receipt. The serial tells us when it left here and who it went to.',
                            'A restocking fee, a handling charge, or anything else with a name invented to keep 15%.',
                        ] as $line)
                            <li class="flex gap-2.5 text-[12px]/5 text-zinc-400">
                                <span class="mt-1.5 size-1 shrink-0 rounded-full bg-zinc-700"></span>
                                <span>{{ $line }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            <section>
                <div data-send-summary class="rounded-xl border border-jade-500/25 bg-jade-500/5 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400/70 uppercase">If you send it for that reason</p>
                    <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-3">
                        <div>
                            <p class="font-mono text-[10px] text-zinc-600">Freight</p>
                            <p data-send-freight class="mt-1 text-[13px]/5 text-cream">You book it, $18 off the refund</p>
                        </div>
                        <div>
                            <p class="font-mono text-[10px] text-zinc-600">What lands back</p>
                            <p data-send-back class="mt-1 text-[13px]/5 text-cream">$1,180 back</p>
                        </div>
                        <div>
                            <p class="font-mono text-[10px] text-zinc-600">Median, start to bank</p>
                            <p data-send-days class="mt-1 text-[13px]/5 text-cream">6 days</p>
                        </div>
                    </div>
                    <p data-send-box class="mt-3.5 border-t border-jade-500/15 pt-3 text-[12px]/5 text-zinc-400">
                        The grinder, the burr tool, the cable. Keep the hopper if you want it — we do not sell them separately and it is no use to us.
                    </p>
                </div>

                <form class="mt-5 flex flex-col gap-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Order number</span>
                            <input type="text" value="NS-2608-1174" readonly
                                class="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 font-mono text-[12px] text-zinc-400 outline-none" />
                        </label>
                        <label class="block">
                            <span class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Serial, under the base</span>
                            <input type="text" placeholder="NS-4471"
                                class="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 font-mono text-[12px] text-zinc-200 outline-none transition-colors duration-150 placeholder:text-zinc-700 focus:border-jade-500/60 focus-visible:ring-2 focus-visible:ring-jade-500/40" />
                        </label>
                    </div>

                    <label class="block">
                        <span class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">What happened</span>
                        <textarea rows="4" placeholder="A sentence is plenty. Wei reads these before he opens the box, and what you write here is what he goes looking for."
                            class="mt-1.5 w-full resize-none rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px]/6 text-zinc-200 outline-none transition-colors duration-150 placeholder:text-zinc-700 focus:border-jade-500/60 focus-visible:ring-2 focus-visible:ring-jade-500/40"></textarea>
                    </label>

                    <label class="block">
                        <span class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Where the courier collects</span>
                        <input type="text" value="台中市西區民生路 227 巷 3 號"
                            class="mt-1.5 w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px] text-zinc-200 outline-none transition-colors duration-150 focus:border-jade-500/60 focus-visible:ring-2 focus-visible:ring-jade-500/40" />
                        <span class="mt-1.5 block text-[11px]/5 text-zinc-600">Or drop it at any 7-11 with the QR on your phone. Most people do that and it saves a day.</span>
                    </label>

                    <div class="flex flex-col gap-3 rounded-xl border border-white/8 bg-ink-900 p-4 sm:flex-row sm:items-center sm:gap-5">
                        <p class="min-w-0 flex-1 text-[12px]/5 text-zinc-500">
                            Nothing is charged and nothing is final. The label sits unused for a fortnight if you change your
                            mind about changing your mind, and plenty of people do.
                        </p>
                        <div class="flex shrink-0 gap-2">
                            <button type="button" class="rounded-lg border border-white/15 px-3.5 py-1.5 text-[13px] text-zinc-200 transition-colors duration-150 outline-none hover:border-white/30 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Ask first</button>
                            <button type="button" class="rounded-lg bg-jade-500 px-3.5 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Send me a label</button>
                        </div>
                    </div>
                </form>

                <h2 class="mt-8 text-[15px] font-medium tracking-tight text-cream">The four things that happen next</h2>
                <ol class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    @foreach ($steps as $index => $step)
                        <li class="flex gap-3.5 px-3.5 py-3">
                            <span class="mt-0.5 shrink-0 font-mono text-[11px] text-jade-400">{{ sprintf('%02d', $index + 1) }}</span>
                            <span class="min-w-0 flex-1">
                                <span class="block text-[13px] text-cream">{{ $step['title'] }}</span>
                                <span class="mt-1 block text-[12px]/5 text-zinc-500">{{ $step['body'] }}</span>
                            </span>
                        </li>
                    @endforeach
                </ol>
            </section>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-send]');

            if (!root) {
                return;
            }

            const options = [...root.querySelectorAll('[data-reason]')];
            const freight = root.querySelector('[data-send-freight]');
            const back = root.querySelector('[data-send-back]');
            const days = root.querySelector('[data-send-days]');
            const box = root.querySelector('[data-send-box]');

            const apply = (option) => {
                options.forEach((other) => other.toggleAttribute('data-active', other === option));

                freight.textContent = option.dataset.freight;
                back.textContent = option.dataset.back;
                days.textContent = option.dataset.days;
                box.textContent = option.dataset.box;
            };

            options.forEach((option) => option.addEventListener('click', () => apply(option)));
        })();
    </script>
</x-templates.refund.shell>
