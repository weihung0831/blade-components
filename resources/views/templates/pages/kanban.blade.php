@php
    $screens = App\Support\TemplateCatalog::screens($template['slug']);

    $sourcesFor = function (string $file): array {
        $studly = Illuminate\Support\Str::studly($file);

        $paths = [
            'blade' => ['label' => 'Blade', 'path' => 'resources/views/components/templates/kanban/'.$file.'.blade.php'],
            'vue' => ['label' => 'Vue', 'path' => 'resources/js/templates/kanban/'.$studly.'.vue'],
            'react' => ['label' => 'React', 'path' => 'resources/js/templates/kanban/'.$studly.'.jsx'],
        ];

        return array_map(
            fn (array $source): array => $source + ['code' => trim(Illuminate\Support\Facades\File::get(base_path($source['path'])))],
            $paths,
        );
    };

    $demoJob = [
        'code' => 'NS-1061',
        'title' => 'Fit the shimmed seats, first 24',
        'tags' => [['label' => 'Rework', 'tone' => 'alert'], ['label' => 'Batch 41', 'tone' => 'batch']],
        'assignee' => 'Mei Tsai',
        'station' => 'bench 1',
        'done' => 3,
        'steps' => 4,
        'qty' => 24,
        'days' => 1,
    ];

    $cardCode = <<<'BLADE'
    <x-templates.kanban.card
        code="NS-1061"
        title="Fit the shimmed seats, first 24"
        :tags="[['label' => 'Rework', 'tone' => 'alert'], ['label' => 'Batch 41', 'tone' => 'batch']]"
        assignee="Mei Tsai"
        station="bench 1"
        :done="3" :steps="4" :qty="24" :days="1" />

    <x-templates.kanban.card code="NS-1068" title="Lathe 2 chatters above 1800 rpm" :days="5" blocked />

    {{-- the card writes what the board filters, counts and drags on --}}
    <article draggable="true" data-card data-owner="Mei Tsai" data-days="1" data-blocked>
    BLADE;

    $cardVueCode = <<<'VUE'
    <KanbanCard :job="job" />

    <KanbanCard v-for="job in jobs" :key="job.code" :job="job" @pick="open" />
    VUE;

    $cardReactCode = <<<'REACT'
    <KanbanCard job={job} />

    {jobs.map((job) => <KanbanCard key={job.code} job={job} onPick={open} />)}
    REACT;

    $columnCode = <<<'BLADE'
    <x-templates.kanban.column
        name="Machining"
        slug="machining"
        machine="TM-1 · lathe 2 · mill"
        :limit="3"
        :count="4">
        <x-templates.kanban.card ... />
    </x-templates.kanban.column>

    {{-- one attribute on the section paints the whole header red --}}
    <section data-column data-limit="3" data-over-limit>
    BLADE;

    $columnVueCode = <<<'VUE'
    <KanbanColumn
        v-for="station in stations"
        :key="station.slug"
        :station="station"
        :jobs="grouped[station.slug]"
        @drop="move(station.slug, $event)" />

    const over = computed(() => station.limit > 0 && jobs.length > station.limit);
    VUE;

    $columnReactCode = <<<'REACT'
    {STATIONS.map((station) => (
        <KanbanColumn
            key={station.slug}
            station={station}
            jobs={grouped[station.slug]}
            onDrop={(code) => move(code, station.slug)} />
    ))}

    const over = station.limit > 0 && jobs.length > station.limit;
    REACT;

    $dragCode = <<<'BLADE'
    board.addEventListener('dragover', (event) => {
        const drop = event.target.closest('[data-drop]');

        if (!drop || !dragging) {
            return;
        }

        event.preventDefault();

        // the card follows the cursor into place, so there is no ghost outline to explain
        drop.insertBefore(dragging, dropAfter(drop, event.clientY));
    });

    const dropAfter = (drop, y) => [...drop.querySelectorAll('[data-card]:not([data-dragging])')]
        .reduce((closest, card) => {
            const box = card.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;

            return offset < 0 && offset > closest.offset ? { offset, card } : closest;
        }, { offset: Number.NEGATIVE_INFINITY, card: null }).card;
    BLADE;

    $dragVueCode = <<<'VUE'
    const move = (code, station) => {
        const job = jobs.value.find((entry) => entry.code === code);

        job.station = station;
        job.days = 0;
    };

    <div @dragover.prevent="over = true" @drop="move($event.dataTransfer.getData('text/plain'), station.slug)">
    VUE;

    $dragReactCode = <<<'REACT'
    const move = (code, station) =>
        setJobs((jobs) => jobs.map((job) => (job.code === code ? { ...job, station, days: 0 } : job)));

    <div
        onDragOver={(event) => { event.preventDefault(); setOver(true); }}
        onDrop={(event) => move(event.dataTransfer.getData('text/plain'), station.slug)} />
    REACT;

    $tagCode = <<<'BLADE'
    <x-templates.kanban.tag label="Rework" tone="alert" />
    <x-templates.kanban.tag label="Batch 41" tone="batch" />
    <x-templates.kanban.tag label="Held" tone="hold" />

    <x-templates.kanban.assignee name="Mei Tsai" size="md" station="bench 1" />
    BLADE;

    $tagVueCode = <<<'VUE'
    <KanbanTag label="Rework" tone="alert" />

    <KanbanAssignee name="Mei Tsai" size="md" station="bench 1" />
    VUE;

    $tagReactCode = <<<'REACT'
    <KanbanTag label="Rework" tone="alert" />

    <KanbanAssignee name="Mei Tsai" size="md" station="bench 1" />
    REACT;

    $meterCode = <<<'BLADE'
    <span class="block h-0.5 w-full overflow-hidden rounded-full bg-white/8">
        <span data-wip-fill class="block h-full rounded-full bg-jade-500/70 group-data-over-limit/col:bg-red-400"
            style="width: {{ $fill }}%"></span>
    </span>

    {{-- the column sets one attribute; the fill, the tally and the warning all read it --}}
    <section data-column data-over-limit>
    BLADE;

    $meterVueCode = <<<'VUE'
    const fill = computed(() => Math.min(100, (booked.value / capacity) * 100));

    <span class="block h-full rounded-full" :class="over ? 'bg-red-400' : 'bg-jade-500/70'" :style="{ width: `${fill}%` }" />
    VUE;

    $meterReactCode = <<<'REACT'
    const fill = Math.min(100, (booked / capacity) * 100);

    <span className={`block h-full rounded-full ${over ? 'bg-red-400' : 'bg-jade-500/70'}`} style={{ width: `${fill}%` }} />
    REACT;
@endphp

<x-layout title="Kanban board template — BLADE-COMPONENTS">
    <div class="mx-auto max-w-6xl px-6 py-16 pb-28">

        <a href="{{ route('templates') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Templates
        </a>

        <div class="rise mt-5 flex flex-wrap items-end justify-between gap-4" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">Template</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $template['name'] }}</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    The shop floor behind the grinder in the <span class="text-zinc-300">Product page</span> template. Columns are stations, not moods —
                    each one holds as much as the roster can actually run, and says so the moment it holds more.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $template['pages']) }} screens</span>
        </div>

        <nav class="rise sticky top-14 z-30 -mx-6 mt-8 border-y border-white/5 bg-ink-950/85 px-6 py-2.5 backdrop-blur" style="animation-delay: 120ms">
            <ul class="flex flex-wrap items-center gap-1 text-sm">
                @foreach ($screens as $screen)
                    <li>
                        <a href="#{{ $screen['slug'] }}" data-spy-link
                            class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">{{ $screen['name'] }}</a>
                    </li>
                @endforeach
                <li class="ml-auto flex items-center gap-1">
                    <a href="#blocks" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Blocks</a>
                    <a href="#install" data-spy-link
                        class="rounded-md px-2.5 py-1 text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-active:bg-jade-500/15 data-active:text-jade-300">Installation</a>
                </li>
            </ul>
        </nav>

        <section class="mt-10">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Screens</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Drag a card between stations and watch the limits argue back. Filter by a face, tick a checklist, pick half the backlog and see the week run out.</p>

            <div class="mt-6 flex flex-col gap-10">
                @foreach ($screens as $screen)
                    <x-screen-preview
                        :id="$screen['slug']"
                        data-spy-section
                        class="scroll-mt-32"
                        :title="$screen['name']"
                        :description="$screen['description']"
                        :href="route('templates.screen', [$template['slug'], $screen['slug']])"
                        :panels="$sourcesFor($screen['slug'])">
                        <x-dynamic-component :component="'templates.'.$template['slug'].'.'.$screen['slug']" />
                    </x-screen-preview>
                @endforeach
            </div>
        </section>

        <section id="blocks" data-spy-section class="mt-16 scroll-mt-32">
            <h2 class="text-lg font-semibold tracking-tight text-cream">Blocks</h2>
            <p class="mt-1 max-w-xl text-sm/6 text-zinc-500">Five parts hold all four screens up. The same meter draws a column's limit, a person's day, and a machine's week.</p>

            <div class="mt-6 flex flex-col gap-12">

                <x-demo title="Job card" padding="p-8"
                    description="Ref, age, checklist, batch size, whoever has it. Every one of those is also a data attribute, which is how the board filters and counts without a second source of truth."
                    :code="$cardCode" :vue-code="$cardVueCode" :react-code="$cardReactCode">
                    <div class="grid w-full max-w-2xl gap-3 sm:grid-cols-2">
                        <x-templates.kanban.card
                            :code="$demoJob['code']"
                            :title="$demoJob['title']"
                            :tags="$demoJob['tags']"
                            :assignee="$demoJob['assignee']"
                            :station="$demoJob['station']"
                            :done="$demoJob['done']"
                            :steps="$demoJob['steps']"
                            :qty="$demoJob['qty']"
                            :days="$demoJob['days']" />

                        <x-templates.kanban.card
                            code="NS-1068"
                            title="Lathe 2 chatters above 1800 rpm"
                            :tags="[['label' => 'Machine', 'tone' => 'alert']]"
                            assignee="Piotr Adamek"
                            station="lathe 2"
                            :done="1" :steps="3" :days="5" blocked />
                    </div>
                </x-demo>

                <x-demo title="Station column" padding="p-8"
                    description="The limit is not a suggestion pulled out of the air — two people work machining, there are three benches, there is one grind rig. Hold more than that and the header goes red before the schedule does."
                    :code="$columnCode" :vue-code="$columnVueCode" :react-code="$columnReactCode">
                    <div class="flex h-[27rem] w-full max-w-3xl gap-4 overflow-x-auto">
                        <x-templates.kanban.column name="Assembly" slug="demo-assembly" machine="benches 1–3" :limit="4" :count="2">
                            <x-templates.kanban.card code="NS-1064" title="Press burr sets into 40 carriers" :tags="[['label' => 'Batch 41', 'tone' => 'batch']]" assignee="Mei Tsai" :done="2" :steps="4" :qty="40" :days="2" />
                            <x-templates.kanban.card code="NS-1052" title="Label and serialise the jade run" assignee="Idris Bahar" :done="0" :steps="3" :qty="60" :days="1" />
                        </x-templates.kanban.column>

                        <x-templates.kanban.column name="Bench test" slug="demo-test" machine="grind rig · sieve stack" :limit="2" :count="3">
                            <x-templates.kanban.card code="NS-1047" title="Grind 3 kg through each of the first eight" assignee="Lena Kohler" :done="6" :steps="8" :qty="8" :days="2" />
                            <x-templates.kanban.card code="NS-1043" title="Particle spread against the old seats" :tags="[['label' => 'Rework', 'tone' => 'alert']]" assignee="Lena Kohler" :done="2" :steps="5" :days="3" />
                            <x-templates.kanban.card code="NS-1039" title="Noise check, six units" assignee="Lena Kohler" :done="0" :steps="2" :days="4" />
                        </x-templates.kanban.column>
                    </div>
                </x-demo>

                <x-demo title="Drag and drop" padding="p-8"
                    description="Twelve lines of HTML5, no library. The card moves into position while you are still holding it, so there is nothing to interpret when you let go — and the count reruns on drop, not on a timer."
                    :code="$dragCode" :vue-code="$dragVueCode" :react-code="$dragReactCode">
                    <div data-mini-board class="flex w-full max-w-xl gap-3">
                        @foreach ([
                            ['Queued', [['NS-1097', 'Deepen the dosing cup lip'], ['NS-1094', 'Re-anodise 12 streaked handles']]],
                            ['Machining', [['NS-1076', 'Turn 60 burr carriers']]],
                        ] as [$name, $jobs])
                            <div class="flex-1">
                                <p class="px-1 font-mono text-[10px] text-zinc-600">{{ Illuminate\Support\Str::lower($name) }}</p>
                                <div data-drop class="mt-2 flex min-h-40 flex-col gap-2 rounded-xl border border-dashed border-white/10 p-2 transition-colors duration-150 data-over:border-jade-500/60 data-over:bg-jade-500/5">
                                    @foreach ($jobs as $job)
                                        <article draggable="true" data-card
                                            class="cursor-grab rounded-lg border border-white/10 bg-ink-950 px-3 py-2.5 transition-[transform,opacity] duration-200 ease-snap select-none active:cursor-grabbing data-dragging:rotate-1 data-dragging:opacity-40">
                                            <p class="font-mono text-[10px] text-zinc-600">{{ $job[0] }}</p>
                                            <p class="mt-1 text-[13px]/5 text-cream">{{ $job[1] }}</p>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <script>
                        (() => {
                            const mini = document.querySelector('[data-mini-board]');

                            if (!mini) {
                                return;
                            }

                            const dropAfter = (drop, y) => [...drop.querySelectorAll('[data-card]:not([data-dragging])')]
                                .reduce((closest, card) => {
                                    const box = card.getBoundingClientRect();
                                    const offset = y - box.top - box.height / 2;

                                    return offset < 0 && offset > closest.offset ? { offset, card } : closest;
                                }, { offset: Number.NEGATIVE_INFINITY, card: null }).card;

                            let dragging = null;

                            mini.addEventListener('dragstart', (event) => {
                                dragging = event.target.closest('[data-card]');

                                if (dragging) {
                                    event.dataTransfer.effectAllowed = 'move';
                                    requestAnimationFrame(() => dragging.setAttribute('data-dragging', ''));
                                }
                            });

                            mini.addEventListener('dragover', (event) => {
                                const drop = event.target.closest('[data-drop]');

                                if (!drop || !dragging) {
                                    return;
                                }

                                event.preventDefault();

                                mini.querySelectorAll('[data-drop]').forEach((zone) => zone.toggleAttribute('data-over', zone === drop));

                                drop.insertBefore(dragging, dropAfter(drop, event.clientY));
                            });

                            mini.addEventListener('drop', (event) => event.preventDefault());

                            mini.addEventListener('dragend', () => {
                                mini.querySelectorAll('[data-drop]').forEach((zone) => zone.removeAttribute('data-over'));

                                if (dragging) {
                                    dragging.removeAttribute('data-dragging');
                                    dragging = null;
                                }
                            });
                        })();
                    </script>
                </x-demo>

                <x-demo title="Tags and people" padding="p-8"
                    description="Five tones, and initials instead of photographs because a four-person workshop does not have headshots. The ring colour comes off the name, so the same person is the same colour on every screen."
                    :code="$tagCode" :vue-code="$tagVueCode" :react-code="$tagReactCode">
                    <div class="flex w-full max-w-xl flex-col gap-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <x-templates.kanban.tag label="Rework" tone="alert" />
                            <x-templates.kanban.tag label="Batch 41" tone="batch" />
                            <x-templates.kanban.tag label="Held" tone="hold" />
                            <x-templates.kanban.tag label="Tooling" tone="plain" />
                            <x-templates.kanban.tag label="Shipped" tone="quiet" />
                        </div>

                        <div class="flex flex-wrap items-center gap-5">
                            @foreach (['Mei Tsai', 'Piotr Adamek', 'Lena Kohler', 'Idris Bahar'] as $person)
                                <div class="flex items-center gap-2.5">
                                    <x-templates.kanban.assignee :name="$person" size="md" />
                                    <span class="font-mono text-[11px] text-zinc-600">{{ $person }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-end gap-3">
                            @foreach (['xs', 'sm', 'md', 'lg'] as $size)
                                <div class="flex flex-col items-center gap-1.5">
                                    <x-templates.kanban.assignee name="Lena Kohler" :size="$size" />
                                    <span class="font-mono text-[10px] text-zinc-700">{{ $size }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-demo>

                <x-demo title="Capacity meter" padding="p-8"
                    description="One bar, three jobs: how full a station is, how booked a person's Thursday is, how much of the week a machine has left. Under the limit it is jade, over it is red, and nothing in between needs explaining."
                    :code="$meterCode" :vue-code="$meterVueCode" :react-code="$meterReactCode">
                    <div class="flex w-full max-w-xl flex-col gap-4">
                        @foreach ([['Machining', 4, 3, 'jobs'], ['Thursday · Piotr', 11, 8, 'hours'], ['Lathe 2', 31, 40, 'hours booked']] as [$label, $value, $limit, $unit])
                            @php $over = $value > $limit; @endphp
                            <div class="rounded-xl border border-white/8 bg-ink-950 p-4">
                                <div class="flex items-baseline gap-3">
                                    <span class="text-[13px] text-zinc-300">{{ $label }}</span>
                                    <span class="ml-auto font-mono text-[11px] {{ $over ? 'text-red-300' : 'text-zinc-500' }}">{{ $value }}/{{ $limit }} {{ $unit }}</span>
                                </div>
                                <span class="mt-2.5 block h-0.5 w-full overflow-hidden rounded-full bg-white/10">
                                    <span class="block h-full rounded-full {{ $over ? 'bg-red-400' : 'bg-jade-500/70' }}" style="width: {{ min(100, round($value / $limit * 100)) }}%"></span>
                                </span>
                                @if ($over)
                                    <p class="mt-2 font-mono text-[10px] text-red-300">over by {{ $value - $limit }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </x-demo>

            </div>
        </section>

        <x-template-install
            id="install"
            data-spy-section
            class="mt-16 scroll-mt-32"
            :slug="$template['slug']"
            :files="[
                ['slug' => 'shell', 'name' => 'Board shell'],
                ['slug' => 'card', 'name' => 'Job card'],
                ['slug' => 'column', 'name' => 'Station column'],
                ['slug' => 'tag', 'name' => 'Tag'],
                ['slug' => 'assignee', 'name' => 'Assignee'],
            ]"
            description="Each screen ships its own source under its preview. These five are what all four share. The drag handling lives in the board screen, not in the card, so a card stays a card wherever you paste it."
            :components="['button', 'checkbox', 'progress']" />
    </div>
</x-layout>
