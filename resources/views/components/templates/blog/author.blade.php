@php
    $writers = [
        [
            'key' => 'mei',
            'panel' => 'group-data-[author=mei]/auth:block',
            'mail' => 'mei@nomad.supply',
            'name' => 'Mei Tsai',
            'role' => 'workshop lead',
            'initials' => 'MT',
            'bio' => 'Runs the bench in Taichung and signs the card that ships in every box. Fourteen years on machine tools before this, which is why the tables here always have a median in them.',
            'since' => 'Nov 2023',
            'notes' => 9,
            'longest' => '15 min',
            'beat' => 'Machines, repairs, the ledger',
            'posts' => [
                ['title' => 'What 412 returned grinders told us about alignment', 'meta' => '12 Aug 2026 · 14 min'],
                ['title' => 'The 0.05 mm shim that closed a five-year complaint', 'meta' => '15 Jul 2026 · 9 min'],
                ['title' => 'We priced a repair at cost for a year. Here is the ledger.', 'meta' => '12 Aug 2025 · 10 min'],
            ],
        ],
        [
            'key' => 'idris',
            'panel' => 'group-data-[author=idris]/auth:block',
            'mail' => 'idris@nomad.supply',
            'name' => 'Idris Bahar',
            'role' => 'sourcing',
            'initials' => 'IB',
            'bio' => 'Buys the metal, argues with the anodisers, and keeps the spreadsheet that decides whether a part is worth making here. Writes when a supplier does something worth telling people about.',
            'since' => 'Feb 2024',
            'notes' => 7,
            'longest' => '11 min',
            'beat' => 'Suppliers, freight, lead times',
            'posts' => [
                ['title' => 'Lead time doubled in March. Here is the whole chain.', 'meta' => '1 Jul 2026 · 11 min'],
                ['title' => 'Anodising in Taichung: three shops, one finish, three prices', 'meta' => '6 May 2026 · 8 min'],
                ['title' => 'Sourcing 83 mm blanks when nobody wants to cut fifty', 'meta' => '8 Feb 2024 · 10 min'],
            ],
        ],
        [
            'key' => 'lena',
            'panel' => 'group-data-[author=lena]/auth:block',
            'mail' => 'lena@nomad.supply',
            'name' => 'Lena Kohler',
            'role' => 'method and testing',
            'initials' => 'LK',
            'bio' => 'Owns the sieve stack and the grinder that has done 340 kg without a clean. Came from a café that ran 14 kg a week, so the thresholds on this site are mostly hers.',
            'since' => 'Jul 2024',
            'notes' => 6,
            'longest' => '15 min',
            'beat' => 'Grind data, brew tests',
            'posts' => [
                ['title' => 'Burr seasoning is mostly folklore, and here is 40 kg of it', 'meta' => '17 Jun 2026 · 13 min'],
                ['title' => 'A bench test you can run with a phone and a spirit level', 'meta' => '3 Jun 2026 · 5 min'],
                ['title' => 'Grinding at 1400 rpm against 900: what the sieve says', 'meta' => '9 Sep 2025 · 15 min'],
            ],
        ],
    ];

    $rules = [
        ['title' => 'Measure before you write', 'detail' => 'If there is no number in the draft, it goes back. A guess can be published as long as it says it is one.'],
        ['title' => 'Show the ledger', 'detail' => 'What a thing cost us goes in, including the times we lost money on it.'],
        ['title' => 'Corrections stay at the top', 'detail' => 'Dated, with the old line struck through. Eleven so far, and the count is on the archive.'],
    ];
@endphp

<x-templates.blog.shell active="Author">
    <div data-blog-authors data-author="mei" class="group/auth">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-cream">Three people, one bench</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    Nobody here writes full time. The notes come out of whatever the workshop was doing that fortnight, which is why they arrive in clusters and then go quiet for a month.
                </p>
            </div>
            <span class="font-mono text-[10px] text-zinc-600">22 notes since Nov 2023</span>
        </div>

        <div class="mt-8 flex flex-wrap gap-2.5">
            @foreach ($writers as $writer)
                <label class="group/writer flex cursor-pointer items-center gap-3 rounded-xl border border-white/10 bg-ink-900 px-4 py-3 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
                    <input type="radio" name="writer" value="{{ $writer['key'] }}" data-author-set="{{ $writer['key'] }}" @checked($loop->first) class="peer sr-only">

                    <span class="grid size-9 shrink-0 place-items-center rounded-full border border-white/10 bg-ink-950 font-mono text-[11px] text-zinc-500 uppercase group-has-[:checked]/writer:border-jade-500/40 group-has-[:checked]/writer:bg-jade-500/10 group-has-[:checked]/writer:text-jade-300">{{ $writer['initials'] }}</span>

                    <span class="flex flex-col">
                        <span class="text-[13px] text-zinc-300 group-has-[:checked]/writer:text-cream">{{ $writer['name'] }}</span>
                        <span class="font-mono text-[10px] text-zinc-600">{{ $writer['notes'] }} notes · {{ $writer['role'] }}</span>
                    </span>
                </label>
            @endforeach
        </div>

        @foreach ($writers as $writer)
            <div class="mt-8 hidden {{ $writer['panel'] }}">
                <div class="grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_18rem]">
                    <div class="flex flex-col gap-6">
                        <div class="rounded-2xl border border-white/8 bg-ink-900 p-6">
                            <x-templates.blog.byline
                                size="lg"
                                :name="$writer['name']"
                                :role="$writer['role']"
                                :initials="$writer['initials']"
                                :bio="$writer['bio']" />

                            <dl class="mt-6 grid grid-cols-2 gap-px overflow-hidden rounded-xl border border-white/8 bg-white/8 sm:grid-cols-4">
                                @foreach ([
                                    ['Notes', $writer['notes']],
                                    ['Writing since', $writer['since']],
                                    ['Longest', $writer['longest']],
                                    ['Beat', $writer['beat']],
                                ] as [$label, $value])
                                    <div class="bg-ink-950 px-4 py-3.5">
                                        <dt class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $label }}</dt>
                                        <dd class="mt-1.5 text-[13px]/5 text-zinc-300">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>

                        <section>
                            <div class="flex items-baseline justify-between gap-4">
                                <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Worth starting with</h2>
                                <a href="{{ route('templates.screen', ['blog', 'archive']) }}" target="_top"
                                    class="font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">All {{ $writer['notes'] }}</a>
                            </div>

                            <ol class="mt-3 flex flex-col divide-y divide-white/5 overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                                @foreach ($writer['posts'] as $post)
                                    <li>
                                        <a href="{{ route('templates.screen', ['blog', 'article']) }}" target="_top"
                                            class="group/row flex items-baseline gap-4 px-5 py-4 transition-colors duration-150 outline-none hover:bg-white/5 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                            <span class="font-mono text-[11px] text-zinc-700">{{ sprintf('%02d', $loop->iteration) }}</span>
                                            <span class="min-w-0 flex-1">
                                                <span class="block text-[14px]/6 text-zinc-300 transition-colors duration-150 group-hover/row:text-jade-300">{{ $post['title'] }}</span>
                                                <span class="mt-1 block font-mono text-[10px] text-zinc-600">{{ $post['meta'] }}</span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        </section>
                    </div>

                    <aside class="flex flex-col gap-4 lg:sticky lg:top-20">
                        <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                            <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Reach {{ Illuminate\Support\Str::before($writer['name'], ' ') }}</p>
                            <p class="mt-2.5 text-[13px]/6 text-zinc-400">
                                Mail goes to the workshop and gets read on Fridays. Include the serial if it is about a machine.
                            </p>
                            <p class="mt-3 font-mono text-[11px] text-jade-300">{{ $writer['mail'] }}</p>
                        </section>

                        <p class="px-1 font-mono text-[10px]/5 text-zinc-600">
                            No guest posts, no sponsored notes, and nothing written by anyone who has not held the part.
                        </p>
                    </aside>
                </div>
            </div>
        @endforeach

        <section class="mt-12 border-t border-white/5 pt-8">
            <h2 class="text-lg font-semibold tracking-tight text-cream">How these get written</h2>

            <div class="mt-5 grid gap-4 sm:grid-cols-3">
                @foreach ($rules as $rule)
                    <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                        <span class="font-mono text-[11px] text-jade-400">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <p class="mt-2.5 text-[14px]/6 text-cream">{{ $rule['title'] }}</p>
                        <p class="mt-2 text-[13px]/6 text-zinc-500">{{ $rule['detail'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <x-templates.blog.subscribe
            class="mt-8"
            title="Pick how often you hear from the bench"
            note="Same writing either way. The digest just holds it until the first Tuesday of the month." />
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-blog-authors]');

            if (!root) {
                return;
            }

            root.addEventListener('change', (event) => {
                const writer = event.target.closest('[data-author-set]');

                if (writer) {
                    root.dataset.author = writer.dataset.authorSet;
                }
            });
        })();
    </script>
</x-templates.blog.shell>
