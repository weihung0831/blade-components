@php
    $contents = [
        ['id' => 'is-it', 'label' => 'Is it the batch, or the burrs bedding in?'],
        ['id' => 'serial', 'label' => 'Check your serial'],
        ['id' => 'fix', 'label' => 'The twenty-minute fix'],
        ['id' => 'instead', 'label' => 'If you would rather not'],
        ['id' => 'nearby', 'label' => 'People also opened'],
    ];

    $steps = [
        ['title' => 'Unplug it and empty the hopper', 'minutes' => '2 min', 'tools' => [], 'body' => 'Beans out, hopper off — a quarter turn anticlockwise and it lifts. Tip the last few beans out of the throat with the machine on its side.'],
        ['title' => 'Take the top burr out', 'minutes' => '4 min', 'tools' => ['3 mm hex'], 'body' => 'Four screws in the collar, all the same length. The burr carrier lifts straight up; it does not need levering, and if it fights you the collar is still holding a screw.'],
        ['title' => 'Drop the shims onto the seat', 'minutes' => '3 min', 'tools' => ['shim kit'], 'body' => 'Two shims, 0.08 mm each, stacked flat on the machined face. They will sit slightly proud of the lip. That is correct — the carrier squashes them home.'],
        ['title' => 'Refit and torque in a cross', 'minutes' => '6 min', 'tools' => ['3 mm hex'], 'body' => 'Narrow tab against the punch mark. Nip all four screws finger tight first, then go round in a cross until they stop turning easily. Do not lean on the key.'],
        ['title' => 'Grind 30 grams and listen', 'minutes' => '5 min', 'tools' => ['stale beans'], 'body' => 'Take it from 1 to 16 and back down. What you are listening for is a single even note the whole way — no swell around the middle. Then reset your dial, because the gap has moved.', 'last' => true],
    ];

    $nearby = [
        ['q' => 'Grounds cling to everything. Is the graphite finish static?', 'topic' => 'Noise and grind', 'helpful' => 89, 'votes' => 146, 'updated' => '2 weeks ago', 'a' => 'The finish has nothing to do with it — dry beans build a charge as they break. One drop of water stirred through the beans kills it.'],
        ['q' => 'I opened it myself before writing in. Have I voided anything?', 'topic' => 'Warranty', 'helpful' => 62, 'votes' => 91, 'updated' => '2 Mar', 'stale' => true, 'a' => 'No. Four hex screws and a service manual on this site — taking the top off is the machine working as intended. The sealed motor housing is the one exception.'],
        ['q' => 'Do I need the receipt to claim?', 'topic' => 'Warranty', 'helpful' => 93, 'votes' => 72, 'updated' => '9 Aug', 'a' => 'The serial is enough. It is on a plate under the base and tells us which run you have.'],
    ];

    $history = [
        ['when' => '14 Aug', 'who' => 'Lena Kohler', 'what' => 'Added the serial range once the second batch was confirmed'],
        ['when' => '2 Jul', 'who' => 'Lena Kohler', 'what' => 'Rewrote step 4 — people were over-torquing the collar'],
        ['when' => '9 May', 'who' => 'Hana Okabe', 'what' => 'First version, off the back of eleven letters in one week'],
    ];
@endphp

<x-templates.faq.shell active="Answers" topic="Noise and grind">
    <div data-answer-screen class="mx-auto flex max-w-5xl gap-10">

        <article class="min-w-0 flex-1">
            <nav class="flex items-center gap-1.5 font-mono text-[10px] text-zinc-700">
                <a href="{{ route('templates.screen', ['faq', 'questions']) }}" target="_top" class="transition-colors duration-150 hover:text-cream">Help centre</a>
                <span>/</span>
                <a href="{{ route('templates.screen', ['faq', 'questions']) }}" target="_top" class="transition-colors duration-150 hover:text-cream">Noise and grind</a>
            </nav>

            <h1 class="mt-3 max-w-2xl text-2xl/8 font-semibold tracking-tight text-cream">
                It howls above half the dial after three weeks. Is that normal?
            </h1>

            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2">
                <span class="flex items-center gap-2">
                    <span class="grid size-6 place-items-center rounded-full bg-jade-500/15 font-mono text-[10px] text-jade-300">LK</span>
                    <span class="text-[12px] text-zinc-400">Lena Kohler</span>
                    <span class="font-mono text-[10px] text-zinc-700">bench test</span>
                </span>
                <span class="font-mono text-[10px] text-zinc-700">edited 3 days ago</span>
                <span class="font-mono text-[10px] text-zinc-700">opened 1,840 times</span>
                <span class="font-mono text-[10px] text-jade-400">94% said it helped</span>
            </div>

            <div class="mt-8 max-w-2xl space-y-4 text-[13px]/6.5 text-zinc-400">
                <p class="text-[15px]/7 text-zinc-300">
                    No, and the shape of it tells you why. Burrs bedding in get quieter every week and never pick one spot on the dial to scream at.
                    A noise that starts around the middle and gets worse on lighter roasts is mechanical, not a running-in noise.
                </p>
                <p>
                    In March we shipped roughly 600 machines whose top burr seat came out 0.15 mm shallow. The burr sits proud, the two faces touch once the load comes on,
                    and what you hear is metal singing rather than coffee breaking. We found it because eleven people wrote to us in the same week and described it in almost the same words.
                </p>
            </div>

            <section id="is-it" class="mt-10 scroll-mt-6">
                <h2 class="text-base font-medium text-cream">Is it the batch, or the burrs bedding in?</h2>

                <div class="mt-4 grid max-w-2xl grid-cols-1 gap-3 sm:grid-cols-2">
                    <div class="rounded-xl border border-red-400/25 bg-red-500/6 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-red-300 uppercase">Batch 40</p>
                        <ul class="mt-2.5 space-y-1.5 text-[12px]/5 text-zinc-400">
                            <li>Starts near the middle of the dial</li>
                            <li>Louder on lighter roasts</li>
                            <li>Worse over three or four weeks</li>
                            <li>Rings even when empty and under load</li>
                        </ul>
                    </div>

                    <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">Bedding in</p>
                        <ul class="mt-2.5 space-y-1.5 text-[12px]/5 text-zinc-400">
                            <li>Even across the whole dial</li>
                            <li>Same on any roast</li>
                            <li>Quieter every week</li>
                            <li>Silent when the hopper is empty</li>
                        </ul>
                    </div>
                </div>

                <x-templates.faq.callout tone="tip" label="The one-minute test" class="mt-5 max-w-2xl">
                    <p>Run it empty from 1 to 16. If it is quiet empty and only sings with beans in it, the seat is proud and this page is about your machine.</p>
                </x-templates.faq.callout>
            </section>

            <section id="serial" class="mt-10 scroll-mt-6">
                <h2 class="text-base font-medium text-cream">Check your serial</h2>
                <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Plate under the base, six characters after the dash. Anything from 0100 to 0699 came off that run.
                </p>

                <div class="mt-4 max-w-md rounded-xl border border-white/8 bg-ink-900 p-4">
                    <label class="flex items-center gap-2.5">
                        <span class="font-mono text-[12px] text-zinc-600">NS-B</span>
                        <input type="text" data-serial value="40-0117" spellcheck="false" maxlength="7"
                            class="w-32 rounded-lg border border-white/10 bg-ink-950 px-2.5 py-1.5 font-mono text-[13px] text-cream focus:border-jade-500/60 focus:outline-none"
                            placeholder="40-0117">
                        <span class="sr-only">The six characters after the dash</span>
                    </label>

                    <p data-serial-verdict class="mt-3 text-[12px]/5"></p>

                    <div class="mt-3 flex flex-wrap gap-1.5">
                        @foreach (['40-0117', '40-0688', '22-0410', '41-0004'] as $sample)
                            <button type="button" data-sample="{{ $sample }}"
                                class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">{{ $sample }}</button>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="fix" class="mt-10 scroll-mt-6">
                <div class="flex flex-wrap items-baseline justify-between gap-3">
                    <h2 class="text-base font-medium text-cream">The twenty-minute fix</h2>
                    <span class="font-mono text-[10px] text-zinc-700">shim kit posts free · say the word</span>
                </div>

                <div class="mt-5 max-w-2xl">
                    @foreach ($steps as $step)
                        <x-templates.faq.step
                            :number="$loop->iteration"
                            :title="$step['title']"
                            :minutes="$step['minutes']"
                            :tools="$step['tools']"
                            :last="$step['last'] ?? false">
                            <p>{{ $step['body'] }}</p>
                        </x-templates.faq.step>
                    @endforeach
                </div>

                <x-templates.faq.callout tone="warn" label="The mistake everyone makes" class="max-w-2xl">
                    <p>Torquing the four collar screws in a circle rather than a cross pulls the carrier over by a hair and puts the noise back. Cross pattern, finger tight first, and stop when the key stops turning easily.</p>
                </x-templates.faq.callout>
            </section>

            <section id="instead" class="mt-10 scroll-mt-6">
                <h2 class="text-base font-medium text-cream">If you would rather not open it</h2>
                <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">Both of these are free, and neither of them counts against the warranty.</p>

                <div class="mt-4 grid max-w-2xl grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach ([
                        ['title' => 'Send it back to the bench', 'meta' => '5 working days, door to door', 'body' => 'We email you a label, you drop it at any 7-Eleven, and it comes back shimmed, cleaned and with the gap reset. The van collects from the shop on Wednesdays.'],
                        ['title' => 'Have someone come to you', 'meta' => 'Taipei and Taichung only', 'body' => 'Twenty minutes on your counter. Two Saturdays a month, and it is the same person who built it — there are only four of us.'],
                    ] as $route)
                        <div class="flex flex-col rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p class="text-[13px] font-medium text-cream">{{ $route['title'] }}</p>
                            <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $route['meta'] }}</p>
                            <p class="mt-2.5 flex-1 text-[12px]/5 text-zinc-500">{{ $route['body'] }}</p>
                            <a href="{{ route('templates.screen', ['faq', 'ask']) }}" target="_top"
                                class="mt-3.5 rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Arrange it</a>
                        </div>
                    @endforeach
                </div>
            </section>

            <x-templates.faq.helpful class="mt-10 max-w-2xl" name="answer-vote" :helpful="94" :votes="212" prompt="Did that fix it?" />

            <section id="nearby" class="mt-10 scroll-mt-6">
                <h2 class="text-base font-medium text-cream">People also opened</h2>

                <div class="mt-3 max-w-2xl overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    @foreach ($nearby as $entry)
                        <x-templates.faq.question
                            :question="$entry['q']"
                            :topic="$entry['topic']"
                            :helpful="$entry['helpful']"
                            :votes="$entry['votes']"
                            :updated="$entry['updated']"
                            :stale="$entry['stale'] ?? false"
                            class="last:border-b-0">
                            <p>{{ $entry['a'] }}</p>
                        </x-templates.faq.question>
                    @endforeach
                </div>
            </section>

            <section class="mt-10 max-w-2xl">
                <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">This page has been rewritten three times</h2>

                <div class="mt-3 space-y-2.5">
                    @foreach ($history as $entry)
                        <div class="flex gap-3">
                            <span class="w-12 shrink-0 font-mono text-[10px] text-zinc-700">{{ $entry['when'] }}</span>
                            <span class="text-[12px]/5 text-zinc-500">{{ $entry['what'] }} <span class="text-zinc-700">— {{ $entry['who'] }}</span></span>
                        </div>
                    @endforeach
                </div>
            </section>
        </article>

        <aside class="hidden w-52 shrink-0 xl:block">
            <div class="sticky top-0">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">On this page</p>
                <nav class="mt-2.5 space-y-1">
                    @foreach ($contents as $entry)
                        <a href="#{{ $entry['id'] }}" data-toc="{{ $entry['id'] }}"
                            class="block border-l border-white/8 py-1 pl-3 text-[12px]/5 text-zinc-600 transition-colors duration-150 hover:border-white/25 hover:text-zinc-300 data-active:border-jade-400 data-active:text-jade-300">{{ $entry['label'] }}</a>
                    @endforeach
                </nav>

                <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                    <p class="font-mono text-[10px] text-zinc-600">Affected serials</p>
                    <p class="mt-1.5 font-mono text-[13px] text-cream">NS-B40-0100 → 0699</p>
                    <p class="mt-1.5 text-[11px]/5 text-zinc-600">Built 3–19 March. 412 of the 600 have been fixed one way or another.</p>
                    <div class="mt-2.5 h-0.5 overflow-hidden rounded-full bg-white/10">
                        <span class="block h-full w-[69%] rounded-full bg-jade-500/70"></span>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <script>
        (() => {
            const screen = document.querySelector('[data-answer-screen]');

            if (!screen) {
                return;
            }

            const input = screen.querySelector('[data-serial]');
            const verdict = screen.querySelector('[data-serial-verdict]');

            const check = () => {
                const value = input.value.trim().toUpperCase();
                const match = value.match(/^(\d{2})-(\d{4})$/);

                if (!match) {
                    verdict.textContent = 'Six characters, like 40-0117.';
                    verdict.className = 'mt-3 text-[12px]/5 text-zinc-600';

                    return;
                }

                const [, run, unit] = match;
                const affected = run === '40' && Number(unit) >= 100 && Number(unit) <= 699;

                verdict.textContent = affected
                    ? 'That is one of them. The shim kit is free — say the word and it goes out on today’s van.'
                    : 'Not from that run. Which means the noise is something else, and we would like to hear it before you open anything.';

                verdict.className = affected
                    ? 'mt-3 text-[12px]/5 text-amber-300'
                    : 'mt-3 text-[12px]/5 text-jade-300';
            };

            screen.querySelectorAll('[data-sample]').forEach((button) => button.addEventListener('click', () => {
                input.value = button.dataset.sample;
                check();
            }));

            input.addEventListener('input', check);

            const sections = [...screen.querySelectorAll('section[id]')];
            const links = [...screen.querySelectorAll('[data-toc]')];
            const region = screen.closest('[data-ui-scroll-region]');

            const spy = () => {
                const top = region ? region.getBoundingClientRect().top : 0;

                const current = sections.filter((section) => section.getBoundingClientRect().top - top <= 24).pop() ?? sections[0];

                links.forEach((link) => link.toggleAttribute('data-active', link.dataset.toc === current.id));
            };

            (region ?? window).addEventListener('scroll', spy, { passive: true });

            check();
            spy();
        })();
    </script>
</x-templates.faq.shell>
