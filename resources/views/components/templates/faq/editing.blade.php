@php
    $queries = [
        ['term' => 'noise', 'hits' => 214, 'results' => 8, 'read' => 91, 'state' => 'answered'],
        ['term' => 'batch 40', 'hits' => 148, 'results' => 3, 'read' => 96, 'state' => 'answered'],
        ['term' => 'warranty', 'hits' => 96, 'results' => 5, 'read' => 74, 'state' => 'answered'],
        ['term' => 'grinder smells like burning', 'hits' => 61, 'results' => 0, 'read' => 0, 'state' => 'missing'],
        ['term' => 'static', 'hits' => 58, 'results' => 2, 'read' => 88, 'state' => 'answered'],
        ['term' => 'shipping to japan', 'hits' => 44, 'results' => 1, 'read' => 31, 'state' => 'thin'],
        ['term' => 'burr gap', 'hits' => 41, 'results' => 4, 'read' => 79, 'state' => 'answered'],
        ['term' => 'replacement burrs price', 'hits' => 37, 'results' => 0, 'read' => 0, 'state' => 'missing'],
        ['term' => 'refund', 'hits' => 33, 'results' => 3, 'read' => 62, 'state' => 'answered'],
        ['term' => 'motor warm to touch', 'hits' => 28, 'results' => 0, 'read' => 0, 'state' => 'missing'],
        ['term' => 'voided warranty', 'hits' => 26, 'results' => 1, 'read' => 44, 'state' => 'thin'],
        ['term' => 'dosing cup spare', 'hits' => 22, 'results' => 1, 'read' => 68, 'state' => 'answered'],
        ['term' => 'turkish grind', 'hits' => 19, 'results' => 1, 'read' => 84, 'state' => 'answered'],
        ['term' => '220v adapter', 'hits' => 17, 'results' => 0, 'read' => 0, 'state' => 'missing'],
        ['term' => 'left handed hopper', 'hits' => 11, 'results' => 0, 'read' => 0, 'state' => 'missing'],
    ];

    $failing = [
        ['q' => 'I opened it myself before writing in. Have I voided anything?', 'helpful' => 62, 'votes' => 91, 'quote' => 'It says no, then spends a paragraph on the motor housing. I still do not know if I am covered.', 'owner' => 'Lena', 'age' => 'untouched since March'],
        ['q' => 'Nine days and the tracking has not moved. Where is it?', 'helpful' => 71, 'votes' => 189, 'quote' => 'Fine, but what do I actually do on day ten? Who do I write to?', 'owner' => 'Hana', 'age' => 'rewritten 11 days ago'],
        ['q' => 'The dial crept two numbers coarser on its own. Loose?', 'helpful' => 78, 'votes' => 54, 'quote' => 'Where do I find the serial to know if mine is the old spring?', 'owner' => 'unclaimed', 'age' => 'untouched since June'],
    ];

    $fromDesk = [
        ['q' => 'Does the motor get warm on long grinds, and how warm is too warm?', 'asked' => 14, 'lane' => 'Noise and grind', 'note' => 'Idris answered this four times last month by hand'],
        ['q' => 'Can I buy burrs on their own, and what do they cost?', 'asked' => 9, 'lane' => 'Warranty', 'note' => 'Every answer so far has quoted a different price'],
        ['q' => 'Do you ship to Japan, and what does the duty come to?', 'asked' => 7, 'lane' => 'Orders and delivery', 'note' => 'The shipping page says sixteen countries and does not list them'],
    ];
@endphp

<x-templates.faq.shell active="Editing" :rail="false">
    <div data-editing-screen class="mx-auto max-w-5xl">

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-lg font-semibold tracking-tight text-cream">What the search box heard in July</h1>
                <p class="mt-1.5 max-w-xl text-[13px]/6 text-zinc-500">
                    A help centre is only as honest as the list of things it could not answer. This is that list,
                    and it is what decides what gets written next month.
                </p>
            </div>
            <span class="font-mono text-[10px] text-zinc-700">updated nightly · 03:00</span>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-3 lg:grid-cols-4">
            @foreach ([
                ['value' => '1,284', 'label' => 'searches', 'note' => 'up 8% on June', 'tone' => 'text-cream'],
                ['value' => '63%', 'label' => 'opened something', 'note' => 'the number we watch', 'tone' => 'text-jade-300'],
                ['value' => '9', 'label' => 'found nothing at all', 'note' => '184 searches between them', 'tone' => 'text-red-300'],
                ['value' => '3', 'label' => 'answers under 80%', 'note' => 'one has been that way since March', 'tone' => 'text-amber-300'],
            ] as $stat)
                <div class="rounded-xl border border-white/8 bg-ink-900 px-4 py-3.5">
                    <p class="font-mono text-2xl {{ $stat['tone'] }}">{{ $stat['value'] }}</p>
                    <p class="mt-1 text-[12px] text-zinc-400">{{ $stat['label'] }}</p>
                    <p class="mt-1.5 font-mono text-[10px] text-zinc-700">{{ $stat['note'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-5">

            <section class="xl:col-span-3">
                <div class="flex flex-wrap items-center gap-3">
                    <h2 class="text-base font-medium text-cream">Every term, by volume</h2>

                    <div class="ml-auto flex items-center gap-1">
                        @foreach ([['all', 'all 15'], ['missing', 'found nothing'], ['thin', 'looked and left']] as [$filter, $label])
                            <button type="button" data-filter="{{ $filter }}" @if ($loop->first) data-on @endif
                                class="rounded-lg px-2.5 py-1 font-mono text-[10px] text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream data-on:bg-jade-500/15 data-on:text-jade-300">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-3 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    <div class="flex items-center gap-3 border-b border-white/5 bg-white/2 py-2 pr-3 pl-4">
                        <span class="size-1.5 shrink-0"></span>
                        <span class="w-52 shrink-0 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">term</span>
                        <span class="ml-auto flex shrink-0 items-baseline gap-4 font-mono text-[10px] tracking-wider whitespace-nowrap text-zinc-700 uppercase">
                            <span class="hidden w-10 text-right md:block">opened</span>
                            <span class="w-16 text-right">results</span>
                            <span class="w-10 text-right">count</span>
                        </span>
                    </div>

                    @foreach ($queries as $entry)
                        <x-templates.faq.query
                            :term="$entry['term']"
                            :hits="$entry['hits']"
                            :peak="214"
                            :results="$entry['results']"
                            :read="$entry['read']"
                            :state="$entry['state']"
                            data-row="{{ $entry['state'] }}" />
                    @endforeach

                    <div class="flex items-center gap-3 px-4 py-2.5">
                        <p class="font-mono text-[10px] text-zinc-700">
                            <span data-row-count>15</span> terms · the tail below ten searches is 340 more
                        </p>
                        <a href="{{ route('templates.screen', ['faq', 'ask']) }}" target="_top"
                            class="ml-auto font-mono text-[10px] text-zinc-600 transition-colors duration-150 hover:text-cream">write one of these →</a>
                    </div>
                </div>

                <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Raised from the desk</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-500">Answered by hand more than three times last month. Whoever writes them can copy their own reply out of the thread.</p>

                    <div class="mt-3.5 space-y-3">
                        @foreach ($fromDesk as $entry)
                            <div class="flex items-start gap-3 border-t border-white/5 pt-3">
                                <span class="mt-0.5 shrink-0 rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500">{{ $entry['asked'] }}×</span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[13px]/5 text-zinc-300">{{ $entry['q'] }}</p>
                                    <p class="mt-1 flex flex-wrap items-center gap-2.5">
                                        <span class="font-mono text-[10px] text-zinc-700">{{ $entry['lane'] }}</span>
                                        <span class="text-[11px] text-zinc-600">{{ $entry['note'] }}</span>
                                    </p>
                                </div>
                                <button type="button" class="shrink-0 rounded-lg border border-white/10 px-2.5 py-1 text-[11px] text-zinc-400 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Claim it</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="xl:col-span-2">
                <h2 class="text-base font-medium text-cream">Written, but not working</h2>
                <p class="mt-1.5 text-[13px]/6 text-zinc-500">Every one of these has a real sentence under it from someone who voted no.</p>

                <div class="mt-3 space-y-3">
                    @foreach ($failing as $entry)
                        <div class="rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p class="text-[13px]/5 text-zinc-300">{{ $entry['q'] }}</p>

                            <div class="mt-2.5 flex items-center gap-2.5">
                                <span class="block h-1 flex-1 overflow-hidden rounded-full bg-white/8">
                                    <span class="block h-full rounded-full {{ $entry['helpful'] < 70 ? 'bg-red-400/60' : 'bg-amber-400/60' }}" style="width: {{ $entry['helpful'] }}%"></span>
                                </span>
                                <span class="shrink-0 font-mono text-[10px] {{ $entry['helpful'] < 70 ? 'text-red-300' : 'text-amber-300' }}">{{ $entry['helpful'] }}% of {{ $entry['votes'] }}</span>
                            </div>

                            <p class="mt-3 border-l border-white/10 pl-3 text-[12px]/5 text-zinc-500 italic">{{ $entry['quote'] }}</p>

                            <div class="mt-3 flex items-center gap-2.5">
                                <span class="font-mono text-[10px] text-zinc-700">{{ $entry['age'] }}</span>
                                <span @class([
                                    'ml-auto rounded-full px-2 py-0.5 font-mono text-[10px]',
                                    'bg-white/6 text-zinc-500' => $entry['owner'] !== 'unclaimed',
                                    'bg-amber-400/10 text-amber-300' => $entry['owner'] === 'unclaimed',
                                ])>{{ $entry['owner'] === 'unclaimed' ? 'nobody has it' : 'with '.$entry['owner'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 rounded-xl border border-dashed border-white/12 p-4">
                    <p class="text-[12px]/5 text-zinc-500">
                        The rule here is simple: anything under 80% gets rewritten or deleted within the month.
                        An answer nobody trusts is worse than an empty page, because the empty page sends them to a person.
                    </p>
                </div>
            </section>
        </div>
    </div>

    <script>
        (() => {
            const screen = document.querySelector('[data-editing-screen]');

            if (!screen) {
                return;
            }

            const rows = [...screen.querySelectorAll('[data-row]')];
            const counter = screen.querySelector('[data-row-count]');

            screen.querySelectorAll('[data-filter]').forEach((button) => button.addEventListener('click', () => {
                const filter = button.dataset.filter;

                screen.querySelectorAll('[data-filter]').forEach((entry) => entry.toggleAttribute('data-on', entry === button));

                const shown = rows.filter((row) => {
                    const match = filter === 'all' || row.dataset.row === filter;

                    row.classList.toggle('hidden', !match);

                    return match;
                });

                counter.textContent = shown.length;
            }));
        })();
    </script>
</x-templates.faq.shell>
