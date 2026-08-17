@php
    $days = ['Mon 17', 'Tue 18', 'Wed 19', 'Thu 20', 'Fri 21'];
    $nextDays = ['Mon 24', 'Tue 25', 'Wed 26', 'Thu 27', 'Fri 28'];

    $weeks = [
        [
            'slug' => '33',
            'label' => 'Week 33',
            'range' => '17–21 Aug · batch 41 ships Thursday',
            'days' => $days,
            'note' => 'Everyone wants the van on Thursday, so everyone booked Thursday. The board says the same thing from the other end: bench test is at its limit and assembly is over it.',
            'crew' => [
                ['name' => 'Mei Tsai', 'role' => 'assembly · bench 1', 'capacity' => 8, 'hours' => [7, 8, 6, 10, 5]],
                ['name' => 'Piotr Adamek', 'role' => 'machining · TM-1, lathe 2', 'capacity' => 8, 'hours' => [8, 9, 8, 11, 4]],
                ['name' => 'Lena Kohler', 'role' => 'test · grind rig', 'capacity' => 8, 'hours' => [4, 6, 7, 9, 8]],
                ['name' => 'Idris Bahar', 'role' => 'supply · packing', 'capacity' => 6, 'hours' => [3, 4, 5, 8, 6]],
            ],
            'machines' => [
                ['name' => 'TM-1', 'note' => 'carriers, jade run', 'booked' => 22, 'available' => 40],
                ['name' => 'Lathe 2', 'note' => 'chatters above 1800 rpm', 'booked' => 31, 'available' => 40, 'flag' => true],
                ['name' => 'Mill', 'note' => 'motor mounts', 'booked' => 18, 'available' => 40],
                ['name' => 'Grind rig', 'note' => 'bench test, 3 kg a machine', 'booked' => 27, 'available' => 40],
                ['name' => 'Benches 1–3', 'note' => 'assembly and rework', 'booked' => 96, 'available' => 120],
            ],
        ],
        [
            'slug' => '34',
            'label' => 'Week 34',
            'range' => '24–28 Aug · lathe 2 down Monday and Tuesday',
            'days' => $nextDays,
            'note' => 'Looks like room, is not. Batch 42 has not been scheduled yet and the backlog is holding 63 hours, most of which wants a lathe that is in pieces until Wednesday.',
            'crew' => [
                ['name' => 'Mei Tsai', 'role' => 'assembly · bench 1', 'capacity' => 8, 'hours' => [6, 5, 7, 6, 4]],
                ['name' => 'Piotr Adamek', 'role' => 'machining · TM-1, lathe 2', 'capacity' => 8, 'hours' => [7, 8, 6, 5, 3]],
                ['name' => 'Lena Kohler', 'role' => 'test · grind rig', 'capacity' => 8, 'hours' => [5, 5, 4, 6, 5]],
                ['name' => 'Idris Bahar', 'role' => 'supply · packing', 'capacity' => 6, 'hours' => [4, 3, 4, 5, 3]],
            ],
            'machines' => [
                ['name' => 'TM-1', 'note' => 'spare carriers', 'booked' => 14, 'available' => 40],
                ['name' => 'Lathe 2', 'note' => 'tool holder swap, 16 h down', 'booked' => 8, 'available' => 24, 'flag' => true],
                ['name' => 'Mill', 'note' => 'keyed loom bracket', 'booked' => 21, 'available' => 40],
                ['name' => 'Grind rig', 'note' => 'particle runs', 'booked' => 19, 'available' => 40],
                ['name' => 'Benches 1–3', 'note' => 'assembly', 'booked' => 72, 'available' => 120],
            ],
        ],
    ];
@endphp

<x-templates.kanban.shell active="Workload">
    <div data-kanban-workload class="mx-auto w-full max-w-5xl">

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold tracking-tight text-cream">Who is carrying what</h1>
                <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                    Hours already promised, against the hours the roster actually has. Anything over the day's capacity is somebody staying late or a job slipping — the board finds out on Thursday either way.
                </p>
            </div>

            <div class="flex items-center gap-1 rounded-lg bg-ink-900 p-0.5">
                @foreach ($weeks as $week)
                    <label class="cursor-pointer rounded-md px-3 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:bg-white/10 has-[:checked]:text-cream">
                        <input type="radio" name="workload-week" value="{{ $week['slug'] }}" data-week-set @checked($loop->first) class="sr-only">
                        {{ $week['label'] }}
                    </label>
                @endforeach
            </div>
        </div>

        @foreach ($weeks as $week)
            @php
                $booked = array_sum(array_map(fn (array $person): int => array_sum($person['hours']), $week['crew']));
                $roster = array_sum(array_map(fn (array $person): int => $person['capacity'] * 5, $week['crew']));
                $overs = [];

                foreach ($week['days'] as $index => $label) {
                    $excess = array_sum(array_map(
                        fn (array $person): int => max(0, $person['hours'][$index] - $person['capacity']),
                        $week['crew'],
                    ));

                    if ($excess > 0) {
                        $overs[] = Illuminate\Support\Str::before($label, ' ').' over by '.$excess.' h';
                    }
                }
            @endphp

            <div data-week="{{ $week['slug'] }}" class="{{ $loop->first ? '' : 'hidden' }} mt-6">
                <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1 font-mono text-[11px] text-zinc-600">
                    <span class="text-zinc-400">{{ $week['range'] }}</span>
                    <span>{{ $booked }} h booked of {{ $roster }} h on the roster</span>
                    @if ($overs !== [])
                        <span class="text-red-300">{{ implode(' · ', $overs) }}</span>
                    @endif
                </div>

                <div class="mt-4 overflow-x-auto rounded-2xl border border-white/8 bg-ink-900 p-3">
                    <div class="min-w-[48rem]">
                        <div class="grid grid-cols-[12.5rem_repeat(5,minmax(0,1fr))_6rem] items-center gap-2 px-1 pb-2 font-mono text-[10px] text-zinc-600">
                            <span>on the roster</span>
                            @foreach ($week['days'] as $label)
                                <span class="text-center">{{ $label }}</span>
                            @endforeach
                            <span class="text-right">week</span>
                        </div>

                        <div class="flex flex-col gap-2">
                            @foreach ($week['crew'] as $person)
                                @php
                                    $total = array_sum($person['hours']);
                                    $limit = $person['capacity'] * 5;
                                @endphp

                                <div data-person-row data-person="{{ $person['name'] }}"
                                    class="grid grid-cols-[12.5rem_repeat(5,minmax(0,1fr))_6rem] items-stretch gap-2 rounded-xl p-1 transition-opacity duration-200 data-dimmed:opacity-30">
                                    <button type="button" data-person-toggle
                                        class="flex items-center gap-2.5 rounded-lg px-2 py-1.5 text-left transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                        <x-templates.kanban.assignee :name="$person['name']" size="sm" />
                                        <span class="min-w-0">
                                            <span class="block truncate text-[13px] text-cream">{{ $person['name'] }}</span>
                                            <span class="block truncate font-mono text-[10px] text-zinc-600">{{ $person['role'] }}</span>
                                        </span>
                                    </button>

                                    @foreach ($person['hours'] as $index => $hours)
                                        @php
                                            $over = $hours > $person['capacity'];
                                            $fill = min(100, round($hours / $person['capacity'] * 100));
                                        @endphp

                                        <div title="{{ $person['name'] }} · {{ $week['days'][$index] }} · {{ $hours }} h against {{ $person['capacity'] }}"
                                            @class([
                                                'rounded-lg border px-2 py-1.5',
                                                'border-red-400/40 bg-red-500/10' => $over,
                                                'border-white/8 bg-ink-950' => ! $over,
                                            ])>
                                            <span class="font-mono text-[11px] {{ $over ? 'text-red-300' : 'text-zinc-300' }}">{{ $hours }} h</span>
                                            <span class="mt-1.5 block h-0.5 overflow-hidden rounded-full bg-white/10">
                                                <span class="block h-full rounded-full {{ $over ? 'bg-red-400' : 'bg-jade-500/70' }}" style="width: {{ $fill }}%"></span>
                                            </span>
                                            <span class="mt-1.5 block font-mono text-[10px] {{ $over ? 'text-red-300/80' : 'text-zinc-700' }}">
                                                {{ $over ? '+'.($hours - $person['capacity']).' over' : $person['capacity'] - $hours.' free' }}
                                            </span>
                                        </div>
                                    @endforeach

                                    <div class="flex flex-col items-end justify-center gap-1.5 px-1">
                                        <span class="font-mono text-[11px] {{ $total > $limit ? 'text-red-300' : 'text-zinc-400' }}">{{ $total }}/{{ $limit }}</span>
                                        <span class="block h-0.5 w-full overflow-hidden rounded-full bg-white/10">
                                            <span class="block h-full rounded-full {{ $total > $limit ? 'bg-red-400' : 'bg-jade-500/70' }}" style="width: {{ min(100, round($total / $limit * 100)) }}%"></span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-5 grid gap-4 lg:grid-cols-[minmax(0,1fr)_18rem]">
                    <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Machines</p>
                        <ul class="mt-4 flex flex-col gap-3.5">
                            @foreach ($week['machines'] as $machine)
                                @php
                                    $share = min(100, round($machine['booked'] / $machine['available'] * 100));
                                    $tight = $share >= 75;
                                @endphp

                                <li>
                                    <div class="flex items-baseline gap-2.5">
                                        <span class="text-[13px] text-zinc-300">{{ $machine['name'] }}</span>
                                        <span class="font-mono text-[10px] {{ ($machine['flag'] ?? false) ? 'text-red-300' : 'text-zinc-700' }}">{{ $machine['note'] }}</span>
                                        <span class="ml-auto font-mono text-[11px] {{ $tight ? 'text-amber-300' : 'text-zinc-500' }}">{{ $machine['booked'] }}/{{ $machine['available'] }} h</span>
                                    </div>
                                    <span class="mt-2 block h-1 overflow-hidden rounded-full bg-white/8">
                                        <span class="block h-full rounded-full {{ $tight ? 'bg-amber-400' : 'bg-jade-500/70' }}" style="width: {{ $share }}%"></span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <section class="flex flex-col gap-4">
                        <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">What this says</p>
                            <p class="mt-2.5 text-[13px]/6 text-zinc-400">{{ $week['note'] }}</p>
                        </div>

                        <a href="{{ route('templates.screen', ['kanban', 'backlog']) }}" target="_top"
                            class="group/link flex items-center gap-3 rounded-2xl border border-white/8 bg-ink-900 p-5 transition-colors duration-150 hover:border-jade-500/50">
                            <span>
                                <span class="block text-[13px] text-cream">Move something out</span>
                                <span class="mt-1 block font-mono text-[10px] text-zinc-600">the backlog holds 63 h more</span>
                            </span>
                            <svg class="ml-auto size-4 text-zinc-600 transition-transform duration-200 ease-snap group-hover/link:translate-x-0.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </section>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        (() => {
            const workload = document.querySelector('[data-kanban-workload]');

            if (!workload) {
                return;
            }

            let focused = null;

            const paint = () => {
                workload.querySelectorAll('[data-person-row]').forEach((row) => {
                    row.toggleAttribute('data-dimmed', focused !== null && row.dataset.person !== focused);
                });
            };

            workload.addEventListener('change', (event) => {
                const week = event.target.closest('[data-week-set]');

                if (!week) {
                    return;
                }

                workload.querySelectorAll('[data-week]').forEach((panel) => {
                    panel.classList.toggle('hidden', panel.dataset.week !== week.value);
                });

                paint();
            });

            workload.addEventListener('click', (event) => {
                const toggle = event.target.closest('[data-person-toggle]');

                if (!toggle) {
                    return;
                }

                const person = toggle.closest('[data-person-row]').dataset.person;

                focused = focused === person ? null : person;

                paint();
            });
        })();
    </script>
</x-templates.kanban.shell>
