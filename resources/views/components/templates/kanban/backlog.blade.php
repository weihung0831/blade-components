@php
    $rows = [
        ['code' => 'NS-1108', 'title' => 'Cut a go/no-go gauge for seat height', 'type' => 'Tooling', 'tone' => 'plain', 'hours' => 6, 'qty' => null, 'raiser' => 'Lena Kohler', 'age' => 3, 'note' => 'ends the calipers argument'],
        ['code' => 'NS-1107', 'title' => 'Deburr the hopper threads on the graphite run', 'type' => 'Rework', 'tone' => 'alert', 'hours' => 4, 'qty' => 40, 'raiser' => 'Mei Tsai', 'age' => 4, 'note' => 'caught at torque check'],
        ['code' => 'NS-1105', 'title' => 'Swap the motor loom to the keyed connector', 'type' => 'ECR-20', 'tone' => 'batch', 'hours' => 9, 'qty' => null, 'raiser' => 'Piotr Adamek', 'age' => 5, 'note' => 'two came back wired backwards'],
        ['code' => 'NS-1101', 'title' => 'Quote a second anodiser in Taichung', 'type' => 'Supply', 'tone' => 'plain', 'hours' => 3, 'qty' => null, 'raiser' => 'Idris Bahar', 'age' => 6, 'note' => 'one shop, one holiday, eleven days lost'],
        ['code' => 'NS-1099', 'title' => 'Retest the 1800 rpm chatter with the short holder', 'type' => 'Machine', 'tone' => 'alert', 'hours' => 5, 'qty' => null, 'raiser' => 'Piotr Adamek', 'age' => 8, 'note' => 'root cause behind NS-1102'],
        ['code' => 'NS-1096', 'title' => 'Photograph the shim procedure for the service manual', 'type' => 'Docs', 'tone' => 'quiet', 'hours' => 2, 'qty' => null, 'raiser' => 'Lena Kohler', 'age' => 9, 'note' => 'while the bench is set up for it'],
        ['code' => 'NS-1093', 'title' => 'Cut 20 spare carriers so assembly stops waiting', 'type' => 'Tooling', 'tone' => 'plain', 'hours' => 7, 'qty' => 20, 'raiser' => 'Piotr Adamek', 'age' => 11, 'note' => 'bench sat idle 3 h last Tuesday'],
        ['code' => 'NS-1089', 'title' => 'Stamp the serial before assembly, not after', 'type' => 'ECR-21', 'tone' => 'batch', 'hours' => 4, 'qty' => null, 'raiser' => 'Mei Tsai', 'age' => 13, 'note' => 'stops the unstamped-return problem'],
        ['code' => 'NS-1084', 'title' => 'Ask the burr supplier for a flatness certificate', 'type' => 'Supply', 'tone' => 'plain', 'hours' => 1, 'qty' => null, 'raiser' => 'Idris Bahar', 'age' => 15, 'note' => 'they have offered twice'],
        ['code' => 'NS-1079', 'title' => 'Sort the returns shelf — 19 machines with no card', 'type' => 'Rework', 'tone' => 'alert', 'hours' => 8, 'qty' => 19, 'raiser' => 'Mei Tsai', 'age' => 18, 'note' => 'moved four times, done zero times'],
        ['code' => 'NS-1072', 'title' => 'Put the packing check on the shipping card', 'type' => 'Docs', 'tone' => 'quiet', 'hours' => 2, 'qty' => null, 'raiser' => 'Idris Bahar', 'age' => 21, 'note' => 'one box went out without the tool'],
        ['code' => 'NS-1066', 'title' => 'Build the jig for the 45° chamfer', 'type' => 'Tooling', 'tone' => 'plain', 'hours' => 12, 'qty' => null, 'raiser' => 'Piotr Adamek', 'age' => 26, 'note' => 'hand-held every batch since March'],
    ];

    $hours = array_sum(array_column($rows, 'hours'));

    $types = ['Rework', 'ECR', 'Tooling', 'Supply', 'Docs', 'Machine'];
@endphp

<x-templates.kanban.shell active="Backlog">
    <div data-kanban-backlog class="mx-auto w-full max-w-5xl">

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold tracking-tight text-cream">Not scheduled yet</h1>
                <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                    Twelve jobs, {{ $hours }} bench hours between them. The week has 46 hours left once batch 41 is out, so roughly half of this list is a lie until something moves.
                </p>
            </div>
            <div class="flex items-baseline gap-2 font-mono text-[11px] text-zinc-600">
                <span data-selected-hours class="text-zinc-400">0</span> h picked
                <span aria-hidden="true" class="text-zinc-700">/</span>
                <span>46 h free</span>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap items-center gap-x-4 gap-y-3">
            <div class="flex flex-wrap items-center gap-1.5">
                <label class="cursor-pointer rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                    <input type="radio" name="backlog-type" value="all" data-type-set checked class="sr-only">
                    everything
                </label>
                @foreach ($types as $type)
                    <label class="cursor-pointer rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/10 has-[:checked]:text-jade-300">
                        <input type="radio" name="backlog-type" value="{{ Illuminate\Support\Str::lower($type) }}" data-type-set class="sr-only">
                        {{ Illuminate\Support\Str::lower($type) }}
                    </label>
                @endforeach
            </div>

            <div class="ml-auto flex items-center gap-1 rounded-lg bg-ink-900 p-0.5">
                @foreach ([['rank', 'Priority'], ['age', 'Oldest'], ['hours', 'Longest']] as [$value, $label])
                    <label class="cursor-pointer rounded-md px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/10 has-[:checked]:text-cream">
                        <input type="radio" name="backlog-sort" value="{{ $value }}" data-sort-set @checked($loop->first) class="sr-only">
                        {{ $label }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mt-4 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
            <div class="flex items-center gap-3 border-b border-white/5 px-4 py-2.5">
                <label class="flex cursor-pointer items-center gap-2.5">
                    <input type="checkbox" data-select-all class="peer sr-only">
                    <span class="grid size-4 place-items-center rounded border border-white/15 text-transparent transition-colors duration-150 peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-checked:text-ink-950 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70">
                        <svg class="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m2.5 6.5 2.5 2.5 4.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <span class="font-mono text-[10px] text-zinc-600">select the lot</span>
                </label>
                <p class="ml-auto font-mono text-[10px] text-zinc-600"><span data-row-count class="text-zinc-400">{{ count($rows) }}</span> jobs listed</p>
            </div>

            <ul data-backlog-list class="flex flex-col divide-y divide-white/5">
                @foreach ($rows as $row)
                    <li data-row
                        data-type="{{ Illuminate\Support\Str::lower(Illuminate\Support\Str::before($row['type'], '-')) }}"
                        data-rank="{{ $loop->iteration }}"
                        data-age="{{ $row['age'] }}"
                        data-hours="{{ $row['hours'] }}"
                        class="group/row transition-colors duration-150 hover:bg-white/5 has-[:checked]:bg-jade-500/5">
                        <label class="flex cursor-pointer items-start gap-3 px-4 py-3">
                            <input type="checkbox" data-row-pick class="peer sr-only">
                            <span class="mt-0.5 grid size-4 shrink-0 place-items-center rounded border border-white/15 text-transparent transition-colors duration-150 peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-checked:text-ink-950 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70">
                                <svg class="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m2.5 6.5 2.5 2.5 4.5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>

                            <span class="w-6 shrink-0 pt-px font-mono text-[11px] text-zinc-700">{{ sprintf('%02d', $loop->iteration) }}</span>

                            <span class="min-w-0 flex-1">
                                <span class="flex flex-wrap items-center gap-x-2.5 gap-y-1">
                                    <span class="font-mono text-[10px] text-zinc-600">{{ $row['code'] }}</span>
                                    <span class="text-[13px]/5 text-cream">{{ $row['title'] }}</span>
                                </span>
                                <span class="mt-1 flex flex-wrap items-center gap-x-2.5 gap-y-1">
                                    <x-templates.kanban.tag :label="$row['type']" :tone="$row['tone']" />
                                    <span class="font-mono text-[10px] text-zinc-700">{{ $row['note'] }}</span>
                                </span>
                            </span>

                            <span class="hidden shrink-0 flex-col items-end gap-1 sm:flex">
                                <span class="font-mono text-[11px] text-zinc-400">{{ $row['hours'] }} h{{ $row['qty'] ? ' · ×'.$row['qty'] : '' }}</span>
                                <span class="font-mono text-[10px] {{ $row['age'] >= 14 ? 'text-amber-300' : 'text-zinc-700' }}">{{ $row['age'] }} days old</span>
                            </span>

                            <x-templates.kanban.assignee :name="$row['raiser']" size="xs" class="mt-0.5 hidden shrink-0 sm:grid" />
                        </label>
                    </li>
                @endforeach
            </ul>

            <p data-backlog-empty class="hidden px-4 py-10 text-center font-mono text-[11px] text-zinc-700">Nothing of that kind is waiting.</p>
        </div>

        <div data-bulk-bar class="pointer-events-none sticky bottom-4 z-20 mt-4 flex translate-y-2 justify-center opacity-0 transition-[opacity,transform] duration-200 ease-snap data-live:pointer-events-auto data-live:translate-y-0 data-live:opacity-100">
            <div class="flex flex-wrap items-center gap-3 rounded-2xl border border-white/10 bg-ink-800 px-4 py-3 shadow-xl shadow-black/40">
                <p class="font-mono text-[11px] text-zinc-400">
                    <span data-bulk-count class="text-cream">0</span> picked · <span data-bulk-hours class="text-cream">0</span> h
                </p>
                <span aria-hidden="true" class="h-4 w-px bg-white/10"></span>
                <p data-bulk-warning class="hidden font-mono text-[11px] text-red-300">past what the week holds</p>
                <button type="button"
                    class="rounded-lg border border-white/10 px-3 py-1.5 text-[13px] text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Assign</button>
                <button type="button"
                    class="rounded-lg bg-jade-500 px-3 py-1.5 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Send to Queued</button>
            </div>
        </div>

        <p class="mt-6 max-w-xl font-mono text-[10px]/5 text-zinc-700">
            Anything past 14 days turns amber. Three of these are older than the machine problem that caused half of them, which is its own kind of answer.
        </p>
    </div>

    <script>
        (() => {
            const backlog = document.querySelector('[data-kanban-backlog]');

            if (!backlog) {
                return;
            }

            const list = backlog.querySelector('[data-backlog-list]');
            const rows = [...list.querySelectorAll('[data-row]')];
            const empty = backlog.querySelector('[data-backlog-empty]');
            const bar = backlog.querySelector('[data-bulk-bar]');
            const capacity = 46;

            const paint = () => {
                const type = backlog.querySelector('[data-type-set]:checked').value;
                const sort = backlog.querySelector('[data-sort-set]:checked').value;

                const shown = rows.filter((row) => {
                    const match = type === 'all' || row.dataset.type === type;

                    row.classList.toggle('hidden', !match);

                    return match;
                });

                [...rows]
                    .sort((a, b) => sort === 'rank'
                        ? Number(a.dataset.rank) - Number(b.dataset.rank)
                        : Number(b.dataset[sort]) - Number(a.dataset[sort]))
                    .forEach((row) => list.append(row));

                const picked = shown.filter((row) => row.querySelector('[data-row-pick]').checked);
                const hours = picked.reduce((total, row) => total + Number(row.dataset.hours), 0);

                backlog.querySelector('[data-row-count]').textContent = shown.length;
                backlog.querySelector('[data-bulk-count]').textContent = picked.length;
                backlog.querySelector('[data-bulk-hours]').textContent = hours;
                backlog.querySelector('[data-selected-hours]').textContent = hours;
                backlog.querySelector('[data-bulk-warning]').classList.toggle('hidden', hours <= capacity);

                empty.classList.toggle('hidden', shown.length > 0);
                bar.toggleAttribute('data-live', picked.length > 0);
            };

            backlog.addEventListener('change', (event) => {
                if (event.target.matches('[data-select-all]')) {
                    rows
                        .filter((row) => !row.classList.contains('hidden'))
                        .forEach((row) => row.querySelector('[data-row-pick]').checked = event.target.checked);
                }

                paint();
            });

            paint();
        })();
    </script>
</x-templates.kanban.shell>
