@php
    $stations = [
        ['slug' => 'queued', 'name' => 'Queued', 'machine' => 'not on a machine yet', 'limit' => null],
        ['slug' => 'machining', 'name' => 'Machining', 'machine' => 'TM-1 · lathe 2 · mill', 'limit' => 3],
        ['slug' => 'assembly', 'name' => 'Assembly', 'machine' => 'benches 1–3', 'limit' => 4],
        ['slug' => 'bench-test', 'name' => 'Bench test', 'machine' => 'grind rig · sieve stack', 'limit' => 2],
        ['slug' => 'shipped', 'name' => 'Shipped', 'machine' => 'packing, Thursday van', 'limit' => null, 'terminal' => true],
    ];

    $jobs = [
        'queued' => [
            ['code' => 'NS-1102', 'title' => 'Shim 24 burr seats from the Tuesday batch', 'tags' => [['label' => 'Rework', 'tone' => 'alert'], ['label' => 'Batch 41', 'tone' => 'batch']], 'assignee' => 'Mei Tsai', 'done' => 0, 'steps' => 4, 'qty' => 24, 'days' => 1],
            ['code' => 'NS-1097', 'title' => 'Deepen the dosing cup lip by 0.4 mm', 'tags' => [['label' => 'ECR-19', 'tone' => 'batch']], 'assignee' => 'Piotr Adamek', 'done' => 0, 'steps' => 6, 'qty' => 60, 'days' => 2],
            ['code' => 'NS-1094', 'title' => 'Re-anodise the 12 handles that came back streaked', 'tags' => [['label' => 'Supplier', 'tone' => 'plain']], 'assignee' => 'Idris Bahar', 'done' => 0, 'steps' => 3, 'qty' => 12, 'days' => 4],
            ['code' => 'NS-1090', 'title' => 'Second-source the M4 grub screw', 'tags' => [['label' => 'Supply', 'tone' => 'plain'], ['label' => 'Held', 'tone' => 'hold']], 'assignee' => 'Idris Bahar', 'done' => 1, 'steps' => 5, 'days' => 3, 'blocked' => true],
            ['code' => 'NS-1086', 'title' => 'Write the bench card for the jade finish', 'tags' => [['label' => 'Docs', 'tone' => 'quiet']], 'assignee' => 'Lena Kohler', 'done' => 0, 'steps' => 2, 'days' => 6],
            ['code' => 'NS-1081', 'title' => 'Fixture for the 45° chamfer, so it stops being hand-held', 'tags' => [['label' => 'Tooling', 'tone' => 'plain']], 'assignee' => 'Piotr Adamek', 'done' => 2, 'steps' => 7, 'days' => 9],
        ],
        'machining' => [
            ['code' => 'NS-1076', 'title' => 'Turn 60 burr carriers, jade run', 'tags' => [['label' => 'Batch 41', 'tone' => 'batch']], 'assignee' => 'Piotr Adamek', 'station' => 'TM-1', 'done' => 3, 'steps' => 5, 'qty' => 60, 'days' => 2],
            ['code' => 'NS-1073', 'title' => 'Bore the motor mount 0.02 under', 'tags' => [['label' => 'ECR-18', 'tone' => 'batch']], 'assignee' => 'Piotr Adamek', 'station' => 'mill', 'done' => 4, 'steps' => 6, 'qty' => 60, 'days' => 3],
            ['code' => 'NS-1071', 'title' => 'Cut 40 collars, graphite', 'tags' => [['label' => 'Batch 41', 'tone' => 'batch']], 'assignee' => 'Mei Tsai', 'station' => 'lathe 2', 'done' => 1, 'steps' => 4, 'qty' => 40, 'days' => 1],
            ['code' => 'NS-1068', 'title' => 'Lathe 2 chatters above 1800 rpm', 'tags' => [['label' => 'Machine', 'tone' => 'alert']], 'assignee' => 'Piotr Adamek', 'station' => 'lathe 2', 'done' => 1, 'steps' => 3, 'days' => 5, 'blocked' => true],
        ],
        'assembly' => [
            ['code' => 'NS-1064', 'title' => 'Press burr sets into 40 carriers', 'tags' => [['label' => 'Batch 41', 'tone' => 'batch']], 'assignee' => 'Mei Tsai', 'station' => 'bench 1', 'done' => 2, 'steps' => 4, 'qty' => 40, 'days' => 2],
            ['code' => 'NS-1061', 'title' => 'Fit the shimmed seats, first 24', 'tags' => [['label' => 'Rework', 'tone' => 'alert'], ['label' => 'Batch 41', 'tone' => 'batch']], 'assignee' => 'Mei Tsai', 'station' => 'bench 1', 'done' => 3, 'steps' => 4, 'qty' => 24, 'days' => 1],
            ['code' => 'NS-1058', 'title' => 'Wire 40 motors on the new loom', 'tags' => [['label' => 'ECR-18', 'tone' => 'batch']], 'assignee' => 'Lena Kohler', 'station' => 'bench 2', 'done' => 2, 'steps' => 6, 'qty' => 40, 'days' => 3],
            ['code' => 'NS-1055', 'title' => 'Torque check every hopper thread', 'tags' => [['label' => 'QA', 'tone' => 'plain']], 'assignee' => 'Lena Kohler', 'station' => 'bench 3', 'done' => 5, 'steps' => 8, 'qty' => 40, 'days' => 4],
            ['code' => 'NS-1052', 'title' => 'Label and serialise the jade run', 'tags' => [['label' => 'Batch 41', 'tone' => 'batch']], 'assignee' => 'Idris Bahar', 'station' => 'bench 3', 'done' => 0, 'steps' => 3, 'qty' => 60, 'days' => 1],
        ],
        'bench-test' => [
            ['code' => 'NS-1047', 'title' => 'Grind 3 kg through each of the first eight', 'tags' => [['label' => 'QA', 'tone' => 'plain']], 'assignee' => 'Lena Kohler', 'station' => 'grind rig', 'done' => 6, 'steps' => 8, 'qty' => 8, 'days' => 2],
            ['code' => 'NS-1043', 'title' => 'Particle spread: shimmed seats against the old ones', 'tags' => [['label' => 'Rework', 'tone' => 'alert']], 'assignee' => 'Lena Kohler', 'station' => 'sieve stack', 'done' => 2, 'steps' => 5, 'qty' => 6, 'days' => 3],
        ],
        'shipped' => [
            ['code' => 'NS-1038', 'title' => 'Batch 40, 48 units to the Osaka distributor', 'tags' => [['label' => 'Shipped', 'tone' => 'quiet']], 'assignee' => 'Idris Bahar', 'done' => 4, 'steps' => 4, 'qty' => 48, 'days' => 7],
            ['code' => 'NS-1034', 'title' => 'Twelve warranty machines, seats swapped', 'tags' => [['label' => 'Rework', 'tone' => 'quiet']], 'assignee' => 'Mei Tsai', 'done' => 6, 'steps' => 6, 'qty' => 12, 'days' => 8],
            ['code' => 'NS-1029', 'title' => 'Six show units for the Taipei fair', 'tags' => [['label' => 'Shipped', 'tone' => 'quiet']], 'assignee' => 'Idris Bahar', 'done' => 3, 'steps' => 3, 'qty' => 6, 'days' => 11],
            ['code' => 'NS-1025', 'title' => 'Sample pair back to the burr supplier', 'tags' => [['label' => 'Supplier', 'tone' => 'quiet']], 'assignee' => 'Lena Kohler', 'done' => 2, 'steps' => 2, 'qty' => 2, 'days' => 14],
        ],
    ];

    $crew = ['Mei Tsai', 'Piotr Adamek', 'Lena Kohler', 'Idris Bahar'];

    $total = array_sum(array_map('count', $jobs));

    $blocked = count(array_filter(array_merge(...array_values($jobs)), fn (array $job): bool => $job['blocked'] ?? false));
@endphp

<x-templates.kanban.shell active="Board" :padded="false">
    <x-slot:toolbar>
        <div data-board-filters class="flex flex-wrap items-center gap-x-4 gap-y-2.5">
            <label class="relative flex items-center">
                <svg class="pointer-events-none absolute left-2.5 size-3.5 text-zinc-600" viewBox="0 0 16 16" fill="none">
                    <circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
                <input type="search" data-board-search placeholder="Find a job, a ref, a name"
                    class="w-56 rounded-lg border border-white/10 bg-ink-900 py-1.5 pr-3 pl-8 text-[13px] text-cream placeholder:text-zinc-600 focus:border-jade-500/60 focus:outline-none">
                <span class="sr-only">Filter the board</span>
            </label>

            <div class="flex items-center gap-1.5">
                @foreach ($crew as $person)
                    <label class="cursor-pointer rounded-full opacity-45 transition-opacity duration-150 has-[:checked]:opacity-100 has-[:checked]:ring-2 has-[:checked]:ring-jade-500/70">
                        <input type="checkbox" data-owner-filter value="{{ $person }}" class="sr-only">
                        <x-templates.kanban.assignee :name="$person" size="sm" />
                        <span class="sr-only">{{ $person }}</span>
                    </label>
                @endforeach
            </div>

            <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-white/10 px-2.5 py-1.5 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream has-[:checked]:border-red-400/50 has-[:checked]:text-red-300">
                <input type="checkbox" data-blocked-filter class="sr-only">
                <span class="size-1.5 rounded-full bg-red-400"></span>
                blocked only
            </label>

            <p class="ml-auto font-mono text-[10px] text-zinc-600">
                <span data-board-showing class="text-zinc-400">{{ $total }}</span> of {{ $total }} jobs · {{ $blocked }} blocked · drag one anywhere
            </p>
        </div>
    </x-slot>

    <div data-kanban-board class="flex min-h-0 flex-1 gap-4 overflow-x-auto px-4 py-4 sm:px-5">
        @foreach ($stations as $station)
            <x-templates.kanban.column
                :name="$station['name']"
                :slug="$station['slug']"
                :machine="$station['machine']"
                :limit="$station['limit']"
                :terminal="$station['terminal'] ?? false"
                :count="count($jobs[$station['slug']])">
                @foreach ($jobs[$station['slug']] as $job)
                    <x-templates.kanban.card
                        :code="$job['code']"
                        :title="$job['title']"
                        :tags="$job['tags']"
                        :assignee="$job['assignee']"
                        :station="$job['station'] ?? null"
                        :done="$job['done']"
                        :steps="$job['steps']"
                        :qty="$job['qty'] ?? null"
                        :days="$job['days']"
                        :blocked="$job['blocked'] ?? false" />
                @endforeach
            </x-templates.kanban.column>
        @endforeach
    </div>

    <footer class="flex shrink-0 flex-wrap items-center gap-x-5 gap-y-2 border-t border-white/5 px-4 py-2.5 font-mono text-[10px] text-zinc-600 sm:px-5">
        <span class="flex items-center gap-1.5"><span class="h-2.5 w-0.5 rounded-full bg-red-400"></span>blocked, someone else owns the next move</span>
        <span class="flex items-center gap-1.5"><span class="h-0.5 w-5 rounded-full bg-jade-500/70"></span>station load against its limit</span>
        <span class="hidden sm:inline">limits come off the roster, not a guess: two people on machining, four benches, one grind rig</span>
        <span class="ml-auto">board reads from the shop tablet · last move 6 min ago</span>
    </footer>

    <script>
        (() => {
            const board = document.querySelector('[data-kanban-board]');
            const filters = document.querySelector('[data-board-filters]');

            if (!board || !filters) {
                return;
            }

            const showing = filters.querySelector('[data-board-showing]');
            const search = filters.querySelector('[data-board-search]');
            const blockedOnly = filters.querySelector('[data-blocked-filter]');

            const recount = () => {
                let visibleTotal = 0;

                board.querySelectorAll('[data-column]').forEach((column) => {
                    const cards = [...column.querySelectorAll('[data-card]')];
                    const visible = cards.filter((card) => !card.classList.contains('hidden'));
                    const limit = Number(column.dataset.limit || 0);
                    const over = limit > 0 && cards.length > limit;

                    visibleTotal += visible.length;

                    column.toggleAttribute('data-over-limit', over);
                    column.querySelector('[data-column-count]').textContent = cards.length;

                    const tally = column.querySelector('[data-column-tally]');
                    tally.classList.toggle('text-red-300', over);
                    tally.classList.toggle('text-zinc-600', !over);

                    const fill = column.querySelector('[data-wip-fill]');

                    if (fill) {
                        fill.style.width = Math.min(100, (cards.length / limit) * 100) + '%';
                    }

                    const warning = column.querySelector('[data-column-warning]');

                    if (warning) {
                        warning.classList.toggle('hidden', !over);
                        warning.querySelector('[data-column-excess]').textContent = cards.length - limit;
                    }

                    column.querySelector('[data-column-empty]').classList.toggle('hidden', visible.length > 0);
                });

                showing.textContent = visibleTotal;
            };

            const apply = () => {
                const owners = [...filters.querySelectorAll('[data-owner-filter]:checked')].map((input) => input.value);
                const term = search.value.trim().toLowerCase();

                board.querySelectorAll('[data-card]').forEach((card) => {
                    const match = (owners.length === 0 || owners.includes(card.dataset.owner))
                        && (!blockedOnly.checked || card.hasAttribute('data-blocked'))
                        && (term === '' || card.dataset.search.includes(term));

                    card.classList.toggle('hidden', !match);
                });

                recount();
            };

            const dropAfter = (drop, y) => {
                const cards = [...drop.querySelectorAll('[data-card]:not([data-dragging])')];

                return cards.reduce((closest, card) => {
                    const box = card.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;

                    return offset < 0 && offset > closest.offset ? { offset, card } : closest;
                }, { offset: Number.NEGATIVE_INFINITY, card: null }).card;
            };

            let dragging = null;

            board.addEventListener('dragstart', (event) => {
                dragging = event.target.closest('[data-card]');

                if (!dragging) {
                    return;
                }

                event.dataTransfer.effectAllowed = 'move';
                event.dataTransfer.setData('text/plain', dragging.dataset.code);

                requestAnimationFrame(() => dragging.setAttribute('data-dragging', ''));
            });

            board.addEventListener('dragover', (event) => {
                const drop = event.target.closest('[data-drop]');

                if (!drop || !dragging) {
                    return;
                }

                event.preventDefault();
                event.dataTransfer.dropEffect = 'move';

                board.querySelectorAll('[data-drop]').forEach((zone) => zone.toggleAttribute('data-over', zone === drop));

                const before = dropAfter(drop, event.clientY) ?? drop.querySelector('[data-column-empty]');

                drop.insertBefore(dragging, before);
            });

            board.addEventListener('drop', (event) => {
                if (dragging) {
                    event.preventDefault();
                }
            });

            board.addEventListener('dragend', () => {
                board.querySelectorAll('[data-drop]').forEach((zone) => zone.removeAttribute('data-over'));

                if (dragging) {
                    dragging.removeAttribute('data-dragging');
                    dragging = null;
                }

                recount();
            });

            board.addEventListener('click', (event) => {
                const toggle = event.target.closest('[data-column-toggle]');

                if (toggle) {
                    toggle.closest('[data-column]').toggleAttribute('data-collapsed');
                }
            });

            filters.addEventListener('input', apply);
            filters.addEventListener('change', apply);

            recount();
        })();
    </script>
</x-templates.kanban.shell>
