@php
    $reasons = [
        ['key' => 'warranty', 'label' => 'Something is wrong with the machine', 'person' => 'Ines Marto', 'initials' => 'IM', 'reply' => '47 min', 'window' => '09:30–18:30 Mon–Fri', 'note' => 'She built about a third of the machines in the field. Noise questions usually come back in one line.'],
        ['key' => 'order', 'label' => 'An order or a parcel', 'person' => 'Ping Hsu', 'initials' => 'PH', 'reply' => '2 h', 'window' => '09:00–18:00 Mon–Sat', 'note' => 'He can move an address up to the moment the label prints, which is 16:00 the day before it ships.'],
        ['key' => 'dealer', 'label' => 'I sell coffee gear', 'person' => 'Ines Marto', 'initials' => 'IM', 'reply' => '1 day', 'window' => 'Tue and Thu', 'note' => 'Dealer terms start at six machines a month. Under that she will tell you to buy at retail and keep the margin.'],
        ['key' => 'press', 'label' => 'Press, or none of the above', 'person' => 'Sofia Reis', 'initials' => 'SR', 'reply' => '3 days', 'window' => 'Mon Wed Fri', 'note' => 'Two loan machines exist. If your deadline is inside a fortnight, say so in the first line.'],
    ];

    $after = [
        ['when' => 'Straight away', 'what' => 'A reference lands in your mail. It is the same one on our side, so quoting it means something.'],
        ['when' => 'When the bench opens', 'what' => 'A person reads it. Not a triage bot deciding which queue you belong in.'],
        ['when' => 'Same day, usually', 'what' => 'If it needs a part, the part goes on the van before anyone asks you to prove anything.'],
        ['when' => 'After it closes', 'what' => 'If the answer was worth keeping, it turns up in the help centre with your wording in it.'],
    ];
@endphp

<x-templates.contact.shell active="Write in" :rail="false">
    <div data-write-screen class="mx-auto flex max-w-5xl gap-10">

        <div class="min-w-0 flex-1">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Say it the way you would say it out loud</h1>
            <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                The first question tells us whose desk this belongs on. Everything after it changes with your answer, so
                you are never typing a serial number into a form about wholesale pricing.
            </p>

            <fieldset class="mt-6">
                <legend class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What is this about</legend>
                <div class="mt-2.5 flex flex-wrap gap-1.5">
                    @foreach ($reasons as $reason)
                        <label class="cursor-pointer rounded-lg border border-white/10 px-3 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                            <input type="radio" name="reason" value="{{ $reason['key'] }}" data-reason @checked($loop->first) class="sr-only">
                            {{ $reason['label'] }}
                        </label>
                    @endforeach
                </div>
            </fieldset>

            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <x-templates.contact.field label="Your name" name="name" value="Tomás Ferreira" />
                <x-templates.contact.field label="Where to write back" name="email" type="email" value="tomas@ferreira.pt" />
            </div>

            <div data-when="warranty" class="mt-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-templates.contact.field
                        label="Serial"
                        name="serial"
                        placeholder="NS-B40-0117"
                        mono
                        hint="Plate under the base, six digits after NS-B. It tells us the batch and the burr set." />

                    <div>
                        <span class="text-[12px] text-zinc-400">How long have you had it</span>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            @foreach (['Under a month', '1 to 12 months', 'Over a year', 'Bought used'] as $age)
                                <label class="cursor-pointer rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                                    <input type="radio" name="age" value="{{ $age }}" @checked($loop->index === 1) class="sr-only">
                                    {{ $age }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <label class="mt-4 flex cursor-pointer items-center gap-2.5 rounded-lg border border-dashed border-white/12 px-3 py-2.5 text-[12px] text-zinc-500 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream">
                    <svg class="size-3.5 shrink-0" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    Attach a clip of the noise
                    <span class="ml-auto font-mono text-[10px] text-zinc-700">ten seconds, dial 1 to 16, no beans</span>
                    <input type="file" class="sr-only">
                </label>
            </div>

            <div data-when="order" class="mt-4 hidden">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-templates.contact.field
                        label="Order number"
                        name="order"
                        placeholder="NS-2026-0117"
                        mono
                        hint="On the confirmation mail. Without it we are searching by surname, and there are four of you." />

                    <div>
                        <span class="text-[12px] text-zinc-400">What has happened</span>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            @foreach (['It has not arrived', 'Wrong item', 'Arrived damaged', 'Change the address'] as $trouble)
                                <label class="cursor-pointer rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                                    <input type="radio" name="trouble" value="{{ $trouble }}" @checked($loop->first) class="sr-only">
                                    {{ $trouble }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <p class="mt-3 text-[12px]/5 text-zinc-600">
                    Tracking that has not moved for nine days is almost always customs, not the courier. Ping can see the
                    declaration and will tell you which of the two it is before you spend an afternoon on the phone.
                </p>
            </div>

            <div data-when="dealer" class="mt-4 hidden">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-templates.contact.field label="Shop" name="shop" placeholder="Rua da Prata Coffee" />
                    <x-templates.contact.field label="City" name="city" placeholder="Lisbon" />
                </div>

                <div class="mt-4">
                    <span class="text-[12px] text-zinc-400">Machines a month, honestly</span>
                    <div class="mt-2 flex flex-wrap gap-1.5">
                        @foreach (['1 to 5', '6 to 15', '16 to 40', 'More than 40'] as $volume)
                            <label class="cursor-pointer rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                                <input type="radio" name="volume" value="{{ $volume }}" @checked($loop->index === 1) class="sr-only">
                                {{ $volume }}
                            </label>
                        @endforeach
                    </div>
                    <p class="mt-2.5 text-[12px]/5 text-zinc-600">
                        Under six a month the dealer price is worse for you than the retail one, once the stock you have to
                        hold is counted. We would rather say that now than in the third mail.
                    </p>
                </div>
            </div>

            <div data-when="press" class="mt-4 hidden">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-templates.contact.field label="Where it runs" name="outlet" placeholder="Standart, issue 24" />
                    <x-templates.contact.field label="Your deadline" name="deadline" type="date" value="2026-09-04" mono />
                </div>

                <div class="mt-4">
                    <span class="text-[12px] text-zinc-400">What you need</span>
                    <div class="mt-2 flex flex-wrap gap-1.5">
                        @foreach (['Photographs', 'A machine on loan', 'Twenty minutes on a call', 'Specifications'] as $need)
                            <label class="cursor-pointer rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/50 hover:text-cream has-[:checked]:border-jade-500/60 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                                <input type="checkbox" name="need[]" value="{{ $need }}" @checked($loop->first) class="sr-only">
                                {{ $need }}
                            </label>
                        @endforeach
                    </div>
                    <p class="mt-2.5 text-[12px]/5 text-zinc-600">Two loan machines exist and they are usually out. Six weeks of notice gets you one; two does not.</p>
                </div>
            </div>

            <div class="mt-5">
                <x-templates.contact.field label="What happened" hint="Plain sentences beat a bullet list. Whoever reads it has taken one of these apart, so you can be blunt about it.">
                    <textarea data-message rows="5" spellcheck="false"
                        placeholder="Three weeks old. Quiet at first, and since the weekend it screams anywhere past halfway on the dial…"
                        class="w-full resize-none rounded-lg border border-white/10 bg-ink-900 px-3 py-2.5 text-[13px]/6 text-cream placeholder:text-zinc-600 transition-colors duration-150 focus:border-jade-500/60 focus:outline-none"></textarea>
                </x-templates.contact.field>

                <div class="mt-2.5 flex flex-wrap gap-x-5 gap-y-2">
                    @foreach ([
                        ['key' => 'when', 'label' => 'when it started'],
                        ['key' => 'what', 'label' => 'what it does'],
                        ['key' => 'tried', 'label' => 'what you already tried'],
                    ] as $check)
                        <span data-check="{{ $check['key'] }}" class="group/check flex items-center gap-1.5">
                            <span class="flex size-3.5 items-center justify-center rounded-full border border-white/12 group-data-done/check:border-jade-500/60 group-data-done/check:bg-jade-500/15">
                                <svg class="size-2 text-zinc-700 group-data-done/check:text-jade-400" viewBox="0 0 12 12" fill="none"><path d="M2 6.5 4.5 9 10 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span class="font-mono text-[10px] text-zinc-700 group-data-done/check:text-jade-400/90">{{ $check['label'] }}</span>
                        </span>
                    @endforeach

                    <span class="ml-auto font-mono text-[10px] text-zinc-700"><span data-words>0</span> words · three lines is plenty</span>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-4 border-t border-white/5 pt-5">
                <a href="{{ route('templates.screen', ['contact', 'sent']) }}" target="_top"
                    class="rounded-lg bg-jade-500 px-4 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Send it</a>

                <p class="text-[12px]/5 text-zinc-500">
                    It is <span class="font-mono text-zinc-300">04:12</span> at the bench and nobody is up.
                    <span class="block text-zinc-600">First reply usually lands by <span class="font-mono">10:20</span>, and it will be a person.</span>
                </p>
            </div>
        </div>

        <aside class="hidden w-60 shrink-0 lg:block">
            <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where this lands</p>

            <div class="mt-3 rounded-xl border border-jade-500/25 bg-jade-500/5 p-3.5">
                <div class="flex items-center gap-3">
                    <span data-lands-initials class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-jade-500/40 bg-jade-500/10 font-mono text-[11px] text-jade-300">{{ $reasons[0]['initials'] }}</span>
                    <span class="min-w-0">
                        <span data-lands-name class="block truncate text-[13px] text-cream">{{ $reasons[0]['person'] }}</span>
                        <span class="mt-0.5 block font-mono text-[10px] text-zinc-600">reads this one</span>
                    </span>
                </div>

                <p data-lands-note class="mt-3 text-[12px]/5 text-zinc-500">{{ $reasons[0]['note'] }}</p>

                <div class="mt-3.5 border-t border-white/8 pt-3">
                    <p class="flex items-baseline gap-2">
                        <span data-lands-reply class="font-mono text-base text-cream">{{ $reasons[0]['reply'] }}</span>
                        <span class="font-mono text-[10px] text-zinc-700">median first reply</span>
                    </p>
                    <p data-lands-window class="mt-1 font-mono text-[10px] text-zinc-600">{{ $reasons[0]['window'] }}</p>
                </div>
            </div>

            <p class="mt-6 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What happens next</p>
            <div class="mt-3 space-y-3.5">
                @foreach ($after as $entry)
                    <div class="border-l border-white/8 pl-3">
                        <p class="font-mono text-[10px] text-jade-400/80">{{ $entry['when'] }}</p>
                        <p class="mt-1 text-[12px]/5 text-zinc-500">{{ $entry['what'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-3">
                <p class="font-mono text-[10px] text-zinc-600">What does not happen</p>
                <ul class="mt-2 space-y-1.5 text-[11px]/5 text-zinc-500">
                    <li>No account to create</li>
                    <li>No chatbot in between</li>
                    <li>Nothing sold to you afterwards</li>
                    <li>Your address goes to the courier and nowhere else</li>
                </ul>
            </div>
        </aside>
    </div>

    <script>
        (() => {
            const screen = document.querySelector('[data-write-screen]');

            if (!screen) {
                return;
            }

            const desks = @json(collect($reasons)->keyBy('key'));

            const groups = [...screen.querySelectorAll('[data-when]')];
            const message = screen.querySelector('[data-message]');
            const words = screen.querySelector('[data-words]');
            const checks = [...screen.querySelectorAll('[data-check]')];

            const tests = {
                when: /\b(week|weeks|month|months|day|days|since|after|yesterday|new|arrived|first)\b/i,
                what: (text) => text.trim().length > 40,
                tried: /\b(tried|already|swapped|cleaned|reset|checked|took|opened|ran)\b/i,
            };

            const route = (key) => {
                const desk = desks[key];

                groups.forEach((group) => group.classList.toggle('hidden', group.dataset.when !== key));

                screen.querySelector('[data-lands-initials]').textContent = desk.initials;
                screen.querySelector('[data-lands-name]').textContent = desk.person;
                screen.querySelector('[data-lands-note]').textContent = desk.note;
                screen.querySelector('[data-lands-reply]').textContent = desk.reply;
                screen.querySelector('[data-lands-window]').textContent = desk.window;
            };

            const grade = () => {
                const text = message.value;

                words.textContent = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;

                checks.forEach((check) => {
                    const test = tests[check.dataset.check];
                    const done = typeof test === 'function' ? test(text) : test.test(text);

                    check.toggleAttribute('data-done', done);
                });
            };

            screen.querySelectorAll('[data-reason]').forEach((radio) => radio.addEventListener('change', () => route(radio.value)));

            message.addEventListener('input', grade);

            grade();
        })();
    </script>
</x-templates.contact.shell>
