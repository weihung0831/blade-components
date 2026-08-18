@php
    $shut = [
        [
            'label' => 'Pick the region',
            'why' => 'Done on the second setup screen. It is on this list because it is the only setting that cannot be changed afterwards, so it gets said twice.',
            'cost' => '1 min',
            'done' => true,
            'required' => true,
        ],
        [
            'label' => 'A bank account for payouts',
            'why' => 'Orders can come in without it and the money sits with us. Nothing goes to a bank until this is here, and the first payout is seven days behind the first order anyway.',
            'cost' => '6 min',
            'done' => false,
            'required' => true,
        ],
        [
            'label' => 'An address customers can write to',
            'why' => 'Confirmed by clicking the link in the mail we sent to ana@kerouac.coffee. Without it, every order confirmation goes out from a no-reply nobody reads.',
            'cost' => 'done in 40 seconds',
            'done' => true,
            'required' => true,
        ],
    ];

    $rest = [
        [
            'label' => 'Bring the catalog over',
            'why' => '387 products in, 19 rows left behind with a reason against each. The photos finished about an hour after the rest.',
            'cost' => '19 min',
            'done' => true,
        ],
        [
            'label' => 'Price your own freight',
            'why' => 'Until you do, orders use our default table, which is about 12% over what the courier charges you. That difference is yours, not ours, so it is worth an evening.',
            'cost' => '25 min',
            'done' => false,
        ],
        [
            'label' => 'Point kerouac.coffee at the shop',
            'why' => 'Two DNS records and a wait. The kerouac.nomadsupply.cc address keeps working forever either way, and half of all shops never bother.',
            'cost' => '10 min, then a day of waiting',
            'done' => false,
        ],
        [
            'label' => 'Read the refund policy you are shipping',
            'why' => 'Ticked because you accepted ours. It is a reasonable policy and it is not yours — the returns window in it is 14 days, which is longer than the law asks and shorter than what most roasters offer.',
            'cost' => '4 min to read',
            'done' => true,
        ],
        [
            'label' => 'Put somebody else on the shop',
            'why' => 'Two seats are in the plan and one of them is empty. It matters the first week you are ill.',
            'cost' => '3 min',
            'done' => false,
            'moved' => 'was on the required list until March',
        ],
        [
            'label' => 'A photograph at the top of the shop',
            'why' => 'You uploaded the one of the roaster. Shops with a photo sell about a fifth more in their first month, which is a correlation we have never been able to untangle from simply caring.',
            'cost' => '2 min',
            'done' => true,
            'moved' => 'was on the required list until March',
        ],
    ];

    $filters = [
        ['key' => 'all-tasks', 'label' => 'All nine'],
        ['key' => 'yes', 'label' => 'Holds the shop shut'],
        ['key' => 'no', 'label' => 'Can wait'],
    ];
@endphp

<x-templates.onboarding.shell active="What is left" step="payouts" :skipped="['people']" interactive>
    <x-slot:toolbar>
        <div data-checklist-bar class="flex flex-wrap items-center gap-x-3 gap-y-2">
            @foreach ($filters as $filter)
                <button type="button" data-checklist-filter="{{ $filter['key'] }}"
                    @if ($loop->first) data-active @endif
                    class="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300">{{ $filter['label'] }}</button>
            @endforeach

            <span data-checklist-count class="ml-auto font-mono text-[10px] text-zinc-600">five of nine done</span>
        </div>
    </x-slot:toolbar>

    <div data-checklist class="mx-auto max-w-6xl">
        <h1 class="text-lg font-semibold tracking-tight text-cream">Nine things, and only three of them matter today</h1>
        <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
            Every onboarding checklist wants all nine ticked. This one sorts them by whether the shop can open without them,
            says what it costs you to leave one alone, and admits which two were on the wrong list until somebody looked.
        </p>

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
            <section>
                <div data-group="yes">
                    <div class="flex items-baseline justify-between gap-3">
                        <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Holds the shop shut</h2>
                        <span class="font-mono text-[10px] text-zinc-700">three</span>
                    </div>

                    <div class="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-amber-400/20 bg-ink-950">
                        @foreach ($shut as $task)
                            <x-templates.onboarding.task
                                :label="$task['label']"
                                :why="$task['why']"
                                :cost="$task['cost']"
                                :done="$task['done']"
                                :required="$task['required']" />
                        @endforeach
                    </div>
                </div>

                <div data-group="no" class="mt-7">
                    <div class="flex items-baseline justify-between gap-3">
                        <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Everything else</h2>
                        <span class="font-mono text-[10px] text-zinc-700">six</span>
                    </div>

                    <div class="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                        @foreach ($rest as $task)
                            <x-templates.onboarding.task
                                :label="$task['label']"
                                :why="$task['why']"
                                :cost="$task['cost']"
                                :done="$task['done']"
                                :moved="$task['moved'] ?? null" />
                        @endforeach
                    </div>
                </div>

                <p data-checklist-empty class="mt-3 hidden rounded-xl border border-white/8 bg-ink-900 px-3.5 py-6 text-center text-[12px] text-zinc-600">
                    Nothing under that heading.
                </p>
            </section>

            <aside>
                <div data-gate class="rounded-xl border border-amber-400/25 bg-amber-400/5 p-4">
                    <p data-gate-title class="text-[13px] text-amber-300">One thing still holds it shut</p>
                    <p data-gate-note class="mt-1.5 text-[12px]/5 text-zinc-400">
                        The bank account. Tick it above and the shop can open — everything else on the list can happen with
                        customers already in the door.
                    </p>

                    <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-white/8">
                        <div data-gate-bar class="h-full rounded-full bg-amber-400/70 transition-[width] duration-300" style="width: 67%"></div>
                    </div>
                    <p data-gate-meter class="mt-1.5 font-mono text-[10px] text-zinc-600">2 of the 3 required · 5 of 9 altogether</p>

                    <button type="button" data-gate-open disabled
                        class="mt-3 w-full rounded-lg bg-jade-500 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70 disabled:cursor-not-allowed disabled:bg-white/8 disabled:text-zinc-600">
                        Open the shop
                    </button>
                </div>

                <div class="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    <p class="border-b border-white/5 px-4 py-2.5 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What a customer sees right now</p>

                    <div class="p-4">
                        <div class="rounded-lg border border-white/8 bg-ink-950 p-3">
                            <div class="flex items-center gap-2">
                                <span class="size-5 rounded bg-jade-500/20"></span>
                                <span class="text-[12px] text-cream">Kerouac Coffee</span>
                                <span class="ml-auto font-mono text-[9px] text-zinc-700">kerouac.nomadsupply.cc</span>
                            </div>

                            <div class="mt-2.5 h-12 rounded bg-white/6"></div>

                            <div class="mt-2 grid grid-cols-3 gap-1.5">
                                @foreach (range(1, 3) as $tile)
                                    <div class="rounded bg-white/4 p-1.5">
                                        <span class="block h-6 rounded bg-white/6"></span>
                                        <span class="mt-1 block h-1 w-2/3 rounded bg-white/10"></span>
                                        <span class="mt-1 block h-1 w-1/3 rounded bg-jade-500/40"></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <p class="mt-3 text-[11px]/5 text-zinc-600">
                            387 products, a photo, and a checkout that works. The freight line at the till still says our
                            default rate, which is the one unticked thing a customer would actually notice.
                        </p>
                    </div>
                </div>

                <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Two things moved off the top list</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        Inviting somebody and uploading a photo used to hold the shop shut. In March we looked at 400 shops
                        that opened without either and could not find anything worse about them, so both moved down here.
                        The list got shorter rather than longer, which is the rarer direction.
                    </p>
                    <a href="{{ route('templates.screen', ['onboarding', 'dropout']) }}" target="_top"
                        class="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">What that changed</a>
                </div>
            </aside>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-checklist]');
            const bar = document.querySelector('[data-checklist-bar]');

            if (!root || !bar) {
                return;
            }

            const tasks = [...root.querySelectorAll('[data-task]')];
            const groups = [...root.querySelectorAll('[data-group]')];
            const buttons = [...bar.querySelectorAll('[data-checklist-filter]')];
            const empty = root.querySelector('[data-checklist-empty]');
            const count = bar.querySelector('[data-checklist-count]');

            const gate = {
                title: root.querySelector('[data-gate-title]'),
                note: root.querySelector('[data-gate-note]'),
                bar: root.querySelector('[data-gate-bar]'),
                meter: root.querySelector('[data-gate-meter]'),
                open: root.querySelector('[data-gate-open]'),
                box: root.querySelector('[data-gate]'),
            };

            const spell = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

            const tally = () => {
                const required = tasks.filter((task) => task.dataset.required === 'yes');
                const requiredDone = required.filter((task) => task.hasAttribute('data-done')).length;
                const done = tasks.filter((task) => task.hasAttribute('data-done')).length;
                const left = required.length - requiredDone;
                const shut = left > 0;

                gate.title.textContent = shut
                    ? `${spell[left]} thing${left === 1 ? '' : 's'} still hold${left === 1 ? 's' : ''} it shut`
                    : 'Nothing is holding it shut';

                gate.note.textContent = shut
                    ? 'Everything else on the list can happen with customers already in the door.'
                    : 'The rest of the list can wait until the shop is busy enough to make it worth doing.';

                gate.bar.style.width = `${Math.round((requiredDone / required.length) * 100)}%`;
                gate.bar.classList.toggle('bg-amber-400/70', shut);
                gate.bar.classList.toggle('bg-jade-500', !shut);
                gate.box.classList.toggle('border-amber-400/25', shut);
                gate.box.classList.toggle('bg-amber-400/5', shut);
                gate.box.classList.toggle('border-jade-500/25', !shut);
                gate.box.classList.toggle('bg-jade-500/5', !shut);
                gate.title.classList.toggle('text-amber-300', shut);
                gate.title.classList.toggle('text-jade-300', !shut);
                gate.meter.textContent = `${requiredDone} of the ${required.length} required · ${done} of ${tasks.length} altogether`;
                gate.open.disabled = shut;
                count.textContent = `${spell[done]} of nine done`;
            };

            const apply = (key) => {
                let shown = 0;

                tasks.forEach((task) => {
                    const keep = key === 'all-tasks' || task.dataset.required === key;

                    task.classList.toggle('hidden', !keep);
                    shown += keep ? 1 : 0;
                });

                groups.forEach((group) => group.classList.toggle('hidden', key !== 'all-tasks' && group.dataset.group !== key));
                buttons.forEach((button) => button.toggleAttribute('data-active', button.dataset.checklistFilter === key));
                empty.classList.toggle('hidden', shown > 0);
            };

            tasks.forEach((task) => {
                task.addEventListener('click', () => {
                    task.toggleAttribute('data-done');
                    tally();
                });
            });

            buttons.forEach((button) => button.addEventListener('click', () => apply(button.dataset.checklistFilter)));

            tally();
        })();
    </script>
</x-templates.onboarding.shell>
