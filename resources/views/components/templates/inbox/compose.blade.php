@php
    $macros = [
        [
            'slug' => 'shim-kit',
            'name' => 'Shim kit — dispatch',
            'used' => '41 times this month',
            'body' => "Hi {{first_name}},\n\nThe kit goes out on today's van, so it should be with you inside {{eta}}. Two shims, a 3 mm hex, and a card with four photographs on it.\n\nNothing comes apart that you cannot put back. The hopper lifts off, three screws hold the top burr, the shims sit under the seat. Twenty minutes at the kitchen table and there is no torque figure to get wrong.\n\nIf you leave it as it is, nothing dramatic happens for a few weeks — it just takes the edge off the burrs eventually, which is why we would rather you did not.\n\n{{agent}}",
        ],
        [
            'slug' => 'warranty',
            'name' => 'Ours, no charge',
            'used' => '28 times',
            'body' => "Hi {{first_name}},\n\nThis one is ours. {{machine}} came out of a run where the burr seats were cut shallow, and the noise you are hearing is the top burr touching under load.\n\nThere is nothing to pay and nothing to prove. Tell me whether you would rather fix it in your kitchen or post it to us, and I will send whichever one you pick.\n\n{{agent}}",
        ],
        [
            'slug' => 'return-label',
            'name' => 'Return label',
            'used' => '19 times',
            'body' => "Hi {{first_name}},\n\nLabel attached — print it, tape it over the old one, and any drop-off point will take it. Postage is on us.\n\nOnce it reaches the workshop it is about {{eta}} on the bench, and we send it back on the same account. Serial on file is {{serial}}, so it will find its way to the right job card.\n\n{{agent}}",
        ],
        [
            'slug' => 'serial',
            'name' => 'Ask for the serial',
            'used' => '63 times',
            'body' => "Hi {{first_name}},\n\nBefore I guess: there is a plate on the underside with a code that starts NS-B. Could you read it to me?\n\nIt tells me which run your machine came from, and that usually tells me what the noise is without you having to describe it any further.\n\n{{agent}}",
        ],
        [
            'slug' => 'lead-time',
            'name' => 'Dealer lead time',
            'used' => '11 times',
            'body' => "Hi {{first_name}},\n\nWe build to order in batches of about sixty, and the current run is spoken for. Twelve units would go on the next one, which means {{eta}} from the day the order lands.\n\nDealer terms start at six units: 35% off list, 30 days, freight at cost. Happy to put that in writing if the number holds.\n\n{{agent}}",
        ],
    ];

    $variables = [
        ['token' => '{{first_name}}', 'value' => 'Tomás'],
        ['token' => '{{machine}}', 'value' => 'Your jade grinder'],
        ['token' => '{{serial}}', 'value' => 'NS-B40-0117'],
        ['token' => '{{eta}}', 'value' => '3 working days'],
        ['token' => '{{agent}}', 'value' => 'Lena'],
    ];
@endphp

<x-templates.inbox.shell active="Compose" :rail="false" :padded="false">
    <div data-composer class="flex min-h-0 flex-1 overflow-hidden">
        <div data-ui-scroll-region class="min-w-0 flex-1 overflow-y-auto px-5 py-5">

            <div class="flex flex-wrap items-center gap-x-3 gap-y-2">
                <h3 class="text-[15px] font-medium text-cream">Answering NS-4471</h3>
                <x-templates.inbox.clock :minutes="-40" bar />
                <a href="{{ route('templates.screen', ['inbox', 'conversation']) }}" target="_top"
                    class="ml-auto font-mono text-[10px] text-jade-400 transition-colors duration-150 hover:text-jade-300">back to the thread →</a>
            </div>

            <div data-compose-card class="mt-4 overflow-hidden rounded-xl border border-white/10 bg-ink-900 transition-colors duration-150 data-note:border-amber-400/40">
                <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
                    @foreach ([['reply', 'Reply'], ['note', 'Internal note'], ['forward', 'Forward']] as [$mode, $label])
                        <label class="cursor-pointer rounded-md px-2 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/8 has-[:checked]:text-cream">
                            <input type="radio" name="compose-mode" data-compose-mode value="{{ $mode }}" @checked($mode === 'reply') class="sr-only">
                            {{ $label }}
                        </label>
                    @endforeach

                    <span data-compose-note class="ml-auto hidden font-mono text-[10px] text-amber-300/80">nothing here leaves the building</span>
                </div>

                <div data-compose-recipients class="divide-y divide-white/5">
                    <label class="flex items-center gap-3 px-3.5 py-2.5">
                        <span class="w-12 shrink-0 font-mono text-[10px] text-zinc-600">To</span>
                        <span class="inline-flex items-center gap-1.5 rounded-md border border-white/10 bg-ink-950 px-2 py-1">
                            <x-templates.inbox.avatar name="Tomás Ferreira" size="xs" kind="customer" />
                            <span class="font-mono text-[11px] text-zinc-300">tomas.ferreira@…pt</span>
                        </span>
                        <span class="font-mono text-[10px] text-zinc-700">+ Cc</span>
                    </label>

                    <label class="flex items-center gap-3 px-3.5 py-2.5">
                        <span class="w-12 shrink-0 font-mono text-[10px] text-zinc-600">Subject</span>
                        <input type="text" value="Re: Grinder howls above 1800 rpm after three weeks"
                            class="min-w-0 flex-1 bg-transparent text-[13px] text-cream focus:outline-none">
                        <span class="shrink-0 font-mono text-[10px] text-zinc-700">NS-4471</span>
                    </label>
                </div>

                <div class="border-t border-white/5 px-3.5 py-2.5">
                    <p class="font-mono text-[10px] text-zinc-600">Canned replies — picking one fills the box and swaps every variable for what we know about him</p>
                    <div class="mt-2 flex flex-wrap gap-1.5">
                        @foreach ($macros as $macro)
                            <button type="button" data-macro="{{ $macro['slug'] }}"
                                class="group/macro rounded-lg border border-white/10 px-2.5 py-1.5 text-left transition-colors duration-150 outline-none hover:border-jade-500/50 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-picked:border-jade-500/60 data-picked:bg-jade-500/10">
                                <span class="block text-[12px] text-zinc-300 group-data-picked/macro:text-jade-300">{{ $macro['name'] }}</span>
                                <span class="mt-0.5 block font-mono text-[10px] text-zinc-700">{{ $macro['used'] }}</span>
                            </button>
                        @endforeach
                    </div>
                    @foreach ($macros as $macro)
                        <span class="hidden" data-macro-body="{{ $macro['slug'] }}" data-body="{{ $macro['body'] }}"></span>
                    @endforeach
                </div>

                <textarea rows="8" data-compose-body placeholder="Or just write it. Nobody is grading the prose."
                    class="w-full resize-none border-t border-white/5 bg-transparent px-3.5 py-3.5 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:outline-none"></textarea>

                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 border-t border-white/5 px-3.5 py-2.5">
                    <span class="font-mono text-[10px] text-zinc-600">Drop in</span>
                    @foreach ($variables as $variable)
                        <button type="button" data-variable="{{ $variable['token'] }}" title="fills as {{ $variable['value'] }}"
                            class="rounded-md border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">{{ $variable['token'] }}</button>
                    @endforeach
                    <span class="ml-auto font-mono text-[10px] text-zinc-700"><span data-compose-words>0</span> words · <span data-compose-read>0s</span> to read</span>
                </div>

                <div class="flex flex-wrap items-center gap-2 border-t border-white/5 px-3.5 py-2.5">
                    @foreach ([['seat-shim-instructions.pdf', '620 KB'], ['warranty-terms.pdf', '96 KB']] as [$file, $size])
                        <span class="inline-flex items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1 font-mono text-[10px] text-zinc-400">
                            <svg class="size-3 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none"><path d="M9 2.5H4.5v11h7V5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M9 2.5V5h2.5" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>
                            {{ $file }} <span class="text-zinc-700">{{ $size }}</span>
                        </span>
                    @endforeach
                    <button type="button" class="rounded-lg border border-dashed border-white/15 px-2 py-1 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:border-white/30 hover:text-cream">attach</button>
                </div>

                <div class="flex flex-wrap items-center gap-3 border-t border-white/5 bg-ink-950/40 px-3.5 py-3">
                    <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:text-jade-300">
                        <input type="checkbox" data-compose-hold class="sr-only">
                        hold until 08:00 in Porto — 3h 48m
                    </label>

                    <span class="font-mono text-[10px] text-zinc-700">signs off as Lena Kohler · bench test</span>

                    <button type="button" data-compose-send
                        class="ml-auto inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3.5 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        Send and close
                    </button>
                </div>
            </div>

            <p class="mt-3 font-mono text-[10px] text-zinc-700">
                Escape puts it in drafts. Nothing here is sent until you press the green one, including the scheduled version.
            </p>
        </div>

        <aside data-ui-scroll-region class="hidden w-80 shrink-0 overflow-y-auto border-l border-white/5 px-4 py-5 lg:block">
            <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What you are answering</p>

            <div class="mt-3 rounded-xl border border-white/8 bg-ink-900 p-3.5">
                <div class="flex items-center gap-2.5">
                    <x-templates.inbox.avatar name="Tomás Ferreira" size="sm" kind="customer" />
                    <span class="text-[13px] text-zinc-300">Tomás Ferreira</span>
                    <span class="ml-auto font-mono text-[10px] text-zinc-700">Tue 11:12</span>
                </div>
                <p class="mt-2.5 border-l-2 border-white/10 pl-3 text-[12px]/5 text-zinc-500">
                    Send the kit. I would rather spend twenty minutes than ten days without it. How long before the noise comes back if I leave it as it is?
                </p>
            </div>

            <div class="mt-5 rounded-xl border border-red-400/25 bg-red-500/5 p-3.5">
                <p class="font-mono text-[10px] tracking-wide text-red-300/90 uppercase">40 minutes past the promise</p>
                <p class="mt-1.5 text-[12px]/5 text-zinc-400">Four hours is what the site says under the contact form. This one has had four hours and forty minutes.</p>
            </div>

            <div class="mt-5">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Before you send</p>
                <ul class="mt-2.5 space-y-2">
                    @foreach ([
                        ['He asked a question you have not answered', 'how long the noise takes to do damage'],
                        ['The kit is on the shelf', '9 left after this one goes'],
                        ['His last two mails came in the evening', 'he is not reading this at 04:12'],
                    ] as [$point, $detail])
                        <li class="flex gap-2.5">
                            <span class="mt-1.5 size-1 shrink-0 rounded-full bg-zinc-600"></span>
                            <span class="min-w-0">
                                <span class="block text-[12px]/5 text-zinc-300">{{ $point }}</span>
                                <span class="mt-0.5 block font-mono text-[10px] text-zinc-600">{{ $detail }}</span>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-5 border-t border-white/5 pt-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Signature</p>
                <div class="mt-2.5 rounded-lg border border-white/8 bg-ink-900 p-3 font-mono text-[10px]/5 text-zinc-600">
                    Lena Kohler<br>
                    bench test · NOMAD Supply<br>
                    Taichung · we answer between 09:00 and 18:00, GMT+8
                </div>
            </div>
        </aside>
    </div>

    <script>
        (() => {
            const composer = document.querySelector('[data-composer]');

            if (!composer) {
                return;
            }

            const card = composer.querySelector('[data-compose-card]');
            const body = composer.querySelector('[data-compose-body]');
            const words = composer.querySelector('[data-compose-words]');
            const read = composer.querySelector('[data-compose-read]');
            const send = composer.querySelector('[data-compose-send]');
            const hold = composer.querySelector('[data-compose-hold]');
            const notice = composer.querySelector('[data-compose-note]');
            const recipients = composer.querySelector('[data-compose-recipients]');

            const values = {
                '@{{first_name}}': 'Tomás',
                '@{{machine}}': 'Your jade grinder',
                '@{{serial}}': 'NS-B40-0117',
                '@{{eta}}': '3 working days',
                '@{{agent}}': 'Lena',
            };

            const fill = (text) => Object.entries(values)
                .reduce((filled, [token, value]) => filled.split(token).join(value), text);

            const recount = () => {
                const count = body.value.trim() === '' ? 0 : body.value.trim().split(/\s+/).length;

                words.textContent = count;
                read.textContent = Math.max(1, Math.round(count / 200 * 60)) + 's';
            };

            const label = () => {
                const mode = composer.querySelector('[data-compose-mode]:checked').value;

                if (mode === 'note') {
                    send.textContent = 'Leave the note';

                    return;
                }

                send.textContent = hold.checked ? 'Schedule it for 08:00' : 'Send and close';
            };

            composer.querySelectorAll('[data-macro]').forEach((button) => {
                button.addEventListener('click', () => {
                    const source = composer.querySelector(`[data-macro-body="${button.dataset.macro}"]`);

                    composer.querySelectorAll('[data-macro]').forEach((entry) => entry.toggleAttribute('data-picked', entry === button));

                    body.value = fill(source.dataset.body);
                    body.focus();
                    recount();
                });
            });

            composer.querySelectorAll('[data-variable]').forEach((button) => {
                button.addEventListener('click', () => {
                    const at = body.selectionStart ?? body.value.length;
                    const token = values[button.dataset.variable];

                    body.value = body.value.slice(0, at) + token + body.value.slice(body.selectionEnd ?? at);
                    body.focus();
                    body.selectionStart = body.selectionEnd = at + token.length;
                    recount();
                });
            });

            card.addEventListener('change', (event) => {
                const mode = event.target.closest('[data-compose-mode]');

                if (mode) {
                    const internal = mode.value === 'note';

                    card.toggleAttribute('data-note', internal);
                    notice.classList.toggle('hidden', !internal);
                    recipients.classList.toggle('opacity-40', internal);
                }

                label();
            });

            body.addEventListener('input', recount);

            recount();
            label();
        })();
    </script>
</x-templates.inbox.shell>
