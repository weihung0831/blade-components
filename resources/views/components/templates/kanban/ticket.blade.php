@php
    $stations = ['Queued', 'Machining', 'Assembly', 'Bench test', 'Shipped'];

    $checklist = [
        ['group' => 'Before anything is touched', 'items' => [
            ['label' => 'Pull the 24 serials off the Tuesday build sheet', 'done' => true],
            ['label' => 'Measure seat height on all 24, log to the sheet', 'done' => true],
            ['label' => 'Confirm the 0.05 shim stock covers 24 units', 'done' => true],
            ['label' => 'Park the four that are already at a customer', 'done' => false],
        ]],
        ['group' => 'On the bench', 'items' => [
            ['label' => 'Strip carrier, keep the burr set paired to its serial', 'done' => true],
            ['label' => 'Clean the seat face — no shim goes on swarf', 'done' => true],
            ['label' => 'Fit shim, torque to 4.2 Nm', 'done' => false],
            ['label' => 'Re-measure seat height, target 18.40 ±0.02', 'done' => false],
            ['label' => 'Grind 500 g, check for wander', 'done' => false],
            ['label' => 'Stamp the serial card, note the shim', 'done' => false],
            ['label' => 'Hand to Lena for the particle run', 'done' => false],
        ]],
    ];

    $items = array_merge(...array_column($checklist, 'items'));
    $done = count(array_filter($items, fn (array $item): bool => $item['done']));

    $measurements = [
        ['serial' => 'NS-41-004', 'before' => '18.31', 'after' => '18.40', 'state' => 'done'],
        ['serial' => 'NS-41-007', 'before' => '18.29', 'after' => '18.41', 'state' => 'done'],
        ['serial' => 'NS-41-011', 'before' => '18.34', 'after' => '18.39', 'state' => 'done'],
        ['serial' => 'NS-41-012', 'before' => '18.27', 'after' => '—', 'state' => 'open'],
        ['serial' => 'NS-41-018', 'before' => '18.30', 'after' => '—', 'state' => 'open'],
    ];

    $activity = [
        ['who' => 'Mei Tsai', 'when' => '2 days ago', 'body' => 'Opened off the fourth warranty call this month. All four machines were built the same Tuesday, all four wander after about a week.'],
        ['who' => 'Lena Kohler', 'when' => '2 days ago', 'body' => 'Measured six of them cold. Seat sits 0.09 low on average against the drawing. The burrs are fine — I ran them in a known-good carrier and the spread was normal.'],
        ['who' => 'Piotr Adamek', 'when' => 'yesterday', 'body' => 'The seat op was run on lathe 2 that week. Same lathe that is chattering now. I would hold NS-1068 open until this one closes, they are the same root cause.'],
        ['who' => 'Mei Tsai', 'when' => '4 hours ago', 'body' => 'Shim stock arrived. Doing the first three on bench 1 this afternoon and measuring each one before it goes back together.'],
    ];

    $facts = [
        ['label' => 'Batch', 'value' => 'Batch 41 · 24 units'],
        ['label' => 'Opened', 'value' => '14 Aug 2026 by Mei Tsai'],
        ['label' => 'Due', 'value' => 'Thursday van, 20 Aug'],
        ['label' => 'Est. bench time', 'value' => '6 h · 1.5 h logged'],
    ];

    $parts = [
        ['code' => 'BS-041', 'name' => 'Burr seat, jade run', 'note' => 'the part that moves'],
        ['code' => 'SH-005', 'name' => 'Shim, 0.05 mm steel', 'note' => 'new, 40 in stock'],
        ['code' => 'CR-118', 'name' => 'Carrier, 83 mm', 'note' => 'unchanged, strip only'],
    ];
@endphp

<x-templates.kanban.shell active="Board">
    <div data-kanban-ticket class="mx-auto w-full max-w-5xl">

        <nav class="flex flex-wrap items-center gap-2 font-mono text-[11px] text-zinc-600">
            <a href="{{ route('templates.screen', ['kanban', 'board']) }}" target="_top" class="transition-colors duration-150 hover:text-cream">Shop floor</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('templates.screen', ['kanban', 'board']) }}" target="_top" class="transition-colors duration-150 hover:text-cream">Queued</a>
            <span aria-hidden="true">/</span>
            <span class="text-zinc-400">NS-1102</span>
        </nav>

        <div class="mt-4 flex flex-wrap items-start justify-between gap-x-6 gap-y-4">
            <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-2">
                    <x-templates.kanban.tag label="Rework" tone="alert" />
                    <x-templates.kanban.tag label="Batch 41" tone="batch" />
                    <span class="font-mono text-[10px] text-zinc-600">opened 2 days ago · 4 people watching</span>
                </div>
                <h1 class="mt-2.5 text-2xl/8 font-semibold tracking-tight text-cream">Shim 24 burr seats from the Tuesday batch</h1>
            </div>

            <div class="flex shrink-0 items-center gap-2">
                <button type="button" class="rounded-lg border border-white/10 px-3 py-1.5 text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Watch</button>
                <button type="button" data-ticket-advance
                    class="inline-flex items-center gap-1.5 rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    Move to <span data-ticket-next>Machining</span>
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>

        <div class="mt-6 grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_19rem]">
            <div class="flex flex-col gap-5">

                <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Why this is open</p>
                    <div class="mt-3 flex flex-col gap-3 text-[13px]/6 text-zinc-400">
                        <p>Four warranty calls in three weeks, all saying the same thing: the grind wanders about a week in. Every one of the four was built on the same Tuesday.</p>
                        <p>The seat sits 0.09 mm low against the drawing, so the burr set has room to settle. A 0.05 shim brings it inside tolerance without touching the carrier or the burrs. Twenty-four machines came off that build sheet; four of them are already with customers and stay parked until the other twenty are proven.</p>
                    </div>
                </section>

                <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Checklist</p>
                        <div class="flex items-center gap-2.5">
                            <span class="block h-1 w-24 overflow-hidden rounded-full bg-white/10">
                                <span data-check-bar class="block h-full rounded-full bg-jade-500 transition-[width] duration-300 ease-snap" style="width: {{ round($done / count($items) * 100) }}%"></span>
                            </span>
                            <span class="font-mono text-[11px] text-zinc-500"><span data-check-done>{{ $done }}</span>/{{ count($items) }}</span>
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col gap-5">
                        @foreach ($checklist as $group)
                            <div>
                                <p class="font-mono text-[10px] text-zinc-600">{{ $group['group'] }}</p>
                                <ul class="mt-2 flex flex-col">
                                    @foreach ($group['items'] as $item)
                                        <li>
                                            <label class="group/check flex cursor-pointer items-start gap-2.5 rounded-lg px-2 py-1.5 transition-colors duration-150 hover:bg-white/5">
                                                <input type="checkbox" data-check @checked($item['done']) class="peer sr-only">
                                                <span class="mt-px grid size-4 shrink-0 place-items-center rounded border border-white/15 text-transparent transition-colors duration-150 peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-checked:text-ink-950 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70">
                                                    <svg class="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m2.5 6.5 2.5 2.5 4.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                </span>
                                                <span class="text-[13px]/5 text-zinc-300 transition-colors duration-150 peer-checked:text-zinc-600 peer-checked:line-through">{{ $item['label'] }}</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-white/5 px-5 py-4">
                        <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Seat height, mm</p>
                        <p class="font-mono text-[10px] text-zinc-600">target 18.40 ±0.02 · 3 of 24 done</p>
                    </div>
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-white/5 font-mono text-[10px] text-zinc-600">
                                <th scope="col" class="px-5 py-2 font-normal">Serial</th>
                                <th scope="col" class="px-5 py-2 font-normal">Before</th>
                                <th scope="col" class="px-5 py-2 font-normal">After</th>
                                <th scope="col" class="px-5 py-2 text-right font-normal">State</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($measurements as $row)
                                <tr class="font-mono text-[11px]">
                                    <td class="px-5 py-2.5 text-zinc-400">{{ $row['serial'] }}</td>
                                    <td class="px-5 py-2.5 text-red-300">{{ $row['before'] }}</td>
                                    <td class="px-5 py-2.5 {{ $row['state'] === 'done' ? 'text-jade-300' : 'text-zinc-700' }}">{{ $row['after'] }}</td>
                                    <td class="px-5 py-2.5 text-right text-zinc-600">{{ $row['state'] === 'done' ? 'shimmed' : 'waiting' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="border-t border-white/5 px-5 py-3 font-mono text-[10px] text-zinc-700">19 more rows once the bench gets to them</p>
                </section>

                <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Activity</p>

                    <ol data-activity class="mt-4 flex flex-col gap-4 border-l border-white/8 pl-5">
                        @foreach ($activity as $entry)
                            <li class="relative">
                                <span aria-hidden="true" class="absolute top-2 -left-[1.4rem] size-1.5 rounded-full bg-white/20"></span>
                                <div class="flex items-center gap-2">
                                    <x-templates.kanban.assignee :name="$entry['who']" size="xs" />
                                    <span class="text-[13px] text-zinc-300">{{ $entry['who'] }}</span>
                                    <span class="font-mono text-[10px] text-zinc-600">{{ $entry['when'] }}</span>
                                </div>
                                <p class="mt-1.5 text-[13px]/6 text-zinc-500">{{ $entry['body'] }}</p>
                            </li>
                        @endforeach
                    </ol>

                    <form data-comment-form class="mt-5 flex flex-col gap-2.5 border-t border-white/5 pt-5">
                        <label for="ticket-comment" class="sr-only">Add a note</label>
                        <textarea id="ticket-comment" data-comment-field rows="2" placeholder="What did the bench find?"
                            class="w-full resize-none rounded-xl border border-white/10 bg-ink-950 px-3.5 py-3 text-[13px]/6 text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none"></textarea>
                        <div class="flex items-center gap-3">
                            <p class="font-mono text-[10px] text-zinc-600">Notes go on the serial card too</p>
                            <button type="submit"
                                class="ml-auto rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Post note</button>
                        </div>
                    </form>
                </section>
            </div>

            <aside class="flex flex-col gap-4 lg:sticky lg:top-4">
                <section class="rounded-2xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Station</p>
                    <div class="mt-2.5 flex flex-col gap-1">
                        @foreach ($stations as $station)
                            <label class="flex cursor-pointer items-center gap-2.5 rounded-lg px-2 py-1.5 text-[13px] transition-colors duration-150 hover:bg-white/5 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                                <input type="radio" name="ticket-station" value="{{ $station }}" data-station-set @checked($loop->first) class="peer sr-only">
                                <span class="size-1.5 rounded-full bg-white/20 peer-checked:bg-jade-400"></span>
                                <span class="text-zinc-400 peer-checked:text-jade-300">{{ $station }}</span>
                                @if ($loop->first)
                                    <span class="ml-auto font-mono text-[10px] text-zinc-600">since Friday</span>
                                @endif
                            </label>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-2xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">On it</p>
                    <div class="mt-3 flex items-center gap-2.5">
                        <x-templates.kanban.assignee name="Mei Tsai" size="md" />
                        <div class="min-w-0">
                            <p class="text-[13px] text-cream">Mei Tsai</p>
                            <p class="font-mono text-[10px] text-zinc-600">workshop lead · bench 1</p>
                        </div>
                    </div>

                    <dl class="mt-4 flex flex-col gap-2.5 border-t border-white/5 pt-4">
                        @foreach ($facts as $fact)
                            <div class="flex items-baseline gap-3">
                                <dt class="w-24 shrink-0 font-mono text-[10px] text-zinc-600">{{ $fact['label'] }}</dt>
                                <dd class="font-mono text-[11px] text-zinc-400">{{ $fact['value'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </section>

                <section class="rounded-2xl border border-red-400/25 bg-red-500/5 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-red-300 uppercase">Waiting on</p>
                    <a href="{{ route('templates.screen', ['kanban', 'board']) }}" target="_top" class="mt-2.5 block">
                        <span class="font-mono text-[10px] text-zinc-500">NS-1068</span>
                        <p class="mt-0.5 text-[13px]/5 text-zinc-300 transition-colors duration-150 hover:text-cream">Lathe 2 chatters above 1800 rpm</p>
                    </a>
                    <p class="mt-2 font-mono text-[10px]/4 text-zinc-600">Same lathe cut these seats. Shimming closes the twenty-four; it does not stop the next batch going the same way.</p>
                </section>

                <section class="rounded-2xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Parts touched</p>
                    <ul class="mt-3 flex flex-col divide-y divide-white/5">
                        @foreach ($parts as $part)
                            <li class="flex items-baseline gap-2.5 py-2.5 first:pt-0 last:pb-0">
                                <span class="font-mono text-[10px] text-zinc-600">{{ $part['code'] }}</span>
                                <div class="min-w-0">
                                    <p class="text-[13px]/5 text-zinc-300">{{ $part['name'] }}</p>
                                    <p class="font-mono text-[10px] text-zinc-700">{{ $part['note'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </aside>
        </div>
    </div>

    <script>
        (() => {
            const ticket = document.querySelector('[data-kanban-ticket]');

            if (!ticket) {
                return;
            }

            const checks = [...ticket.querySelectorAll('[data-check]')];
            const bar = ticket.querySelector('[data-check-bar]');
            const doneCount = ticket.querySelector('[data-check-done]');

            const paint = () => {
                const done = checks.filter((check) => check.checked).length;

                doneCount.textContent = done;
                bar.style.width = (done / checks.length) * 100 + '%';
            };

            ticket.addEventListener('change', (event) => {
                if (event.target.matches('[data-check]')) {
                    paint();
                }

                const station = event.target.closest('[data-station-set]');

                if (station) {
                    const stations = [...ticket.querySelectorAll('[data-station-set]')].map((input) => input.value);
                    const next = stations[Math.min(stations.length - 1, stations.indexOf(station.value) + 1)];

                    ticket.querySelector('[data-ticket-next]').textContent = next;
                }
            });

            ticket.querySelector('[data-ticket-advance]').addEventListener('click', () => {
                const inputs = [...ticket.querySelectorAll('[data-station-set]')];
                const current = inputs.findIndex((input) => input.checked);
                const next = inputs[Math.min(inputs.length - 1, current + 1)];

                next.checked = true;
                next.dispatchEvent(new Event('change', { bubbles: true }));
            });

            ticket.querySelector('[data-comment-form]').addEventListener('submit', (event) => {
                event.preventDefault();

                const field = ticket.querySelector('[data-comment-field]');
                const body = field.value.trim();

                if (body === '') {
                    return;
                }

                const entry = document.createElement('li');
                entry.className = 'relative';
                entry.innerHTML = '<span aria-hidden="true" class="absolute top-2 -left-[1.4rem] size-1.5 rounded-full bg-jade-400"></span>'
                    + '<div class="flex items-center gap-2"><span class="grid size-5 shrink-0 place-items-center rounded-full border border-jade-500/50 bg-jade-500/15 font-mono text-[9px] text-jade-300">MT</span>'
                    + '<span class="text-[13px] text-zinc-300">Mei Tsai</span><span class="font-mono text-[10px] text-zinc-600">just now</span></div>'
                    + '<p class="mt-1.5 text-[13px]/6 text-zinc-500" data-comment-body></p>';

                entry.querySelector('[data-comment-body]').textContent = body;

                ticket.querySelector('[data-activity]').append(entry);

                field.value = '';
            });

            paint();
        })();
    </script>
</x-templates.kanban.shell>
