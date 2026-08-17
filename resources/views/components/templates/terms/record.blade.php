@php
    $accepted = [
        ['label' => 'When', 'value' => '12 March 2026, 09:41 Taipei time', 'mono' => true],
        ['label' => 'Who', 'value' => 'tomas@ferreira.pt', 'mono' => true],
        ['label' => 'How', 'value' => 'Ticked at checkout, on the order below. Not a banner, and not by continuing to browse.'],
        ['label' => 'From', 'value' => '85.240.14.0/24 · Lisbon, Portugal', 'mono' => true],
        ['label' => 'Order', 'value' => 'NS-2026-0114', 'mono' => true],
    ];

    $orders = [
        ['ref' => 'NS-2026-0114', 'placed' => '12 Mar 2026', 'what' => 'NS-B grinder, graphite', 'version' => '4.1', 'state' => 'current'],
        ['ref' => 'NS-2025-0871', 'placed' => '18 Nov 2025', 'what' => 'Burr set and anti-static collar', 'version' => '4.0', 'state' => 'frozen'],
        ['ref' => 'NS-2024-0330', 'placed' => '2 Sep 2024', 'what' => 'NS-B grinder, cream', 'version' => '3.1', 'state' => 'frozen'],
    ];

    $history = [
        ['version' => '4.1', 'span' => 'since 12 Mar 2026', 'hash' => '8f2c41ab', 'yours' => true],
        ['version' => '4.0', 'span' => 'Nov 2025 – Mar 2026', 'hash' => 'd704e19c', 'yours' => true],
        ['version' => '3.1', 'span' => 'Aug 2024 – Nov 2025', 'hash' => '5b93aa07', 'yours' => true],
        ['version' => '3.0', 'span' => 'Feb 2023 – Aug 2024', 'hash' => 'c118d5e2', 'yours' => false],
        ['version' => '2.0', 'span' => 'Jun 2021 – Feb 2023', 'hash' => '9ae60f44', 'yours' => false],
        ['version' => '1.0', 'span' => 'Apr 2019 – Jun 2021', 'hash' => '2d5c8b31', 'yours' => false],
    ];

    $kept = [
        ['what' => 'The version and the timestamp', 'detail' => 'To the second, in Taipei time, because that is what decides which document your order sits under.'],
        ['what' => 'The first three octets of the address', 'detail' => 'Enough to say the click came from Portugal and not from us. The last one is thrown away on write.'],
        ['what' => 'Nothing about the browser', 'detail' => 'No user agent, no fingerprint, no session replay. A tick and a clock is the whole record.'],
    ];
@endphp

<x-templates.terms.shell active="Your copy" :rail="false">
    <x-slot:toolbar>
        <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span class="flex items-baseline gap-2">
                <span class="font-mono text-[13px] text-cream">4.1</span>
                <span class="font-mono text-[10px] text-zinc-600">accepted 12 Mar 2026</span>
            </span>
            <span class="font-mono text-[10px] text-zinc-700">tomas@ferreira.pt</span>
            <a href="{{ route('templates.screen', ['terms', 'changes']) }}" target="_top"
                class="ml-auto font-mono text-[11px] text-amber-300/90 transition-colors duration-150 hover:text-amber-300">4.2 lands in 28 days →</a>
        </div>
    </x-slot:toolbar>

    <div data-record class="mx-auto max-w-5xl">

        <h1 class="text-lg font-semibold tracking-tight text-cream">What you agreed to, and when you did it</h1>
        <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
            Not the current terms — yours. Three orders sitting under three different versions, the oldest of which is
            still binding on us and will be until the machine dies. A terms page that only ever shows today's text is
            hiding the only version that matters to you.
        </p>

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.5fr_1fr]">
            <section class="flex flex-col gap-6">

                <x-templates.terms.stamp
                    version="4.1"
                    state="accepted"
                    when="in force for you"
                    :rows="$accepted"
                    hash="8f2c41ab6e3d0917c2f4a58b7d1e6033b9c04af281e5d7620b3a9c1f4e8d5720"
                    note="This is the text as it stood that morning, not the text as it stands now. If 4.1 is ever amended, this copy does not move with it.">
                    <x-slot:actions>
                        <a href="{{ route('templates.screen', ['terms', 'document']) }}" target="_top"
                            class="rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Read the copy you accepted</a>

                        <button type="button" data-copy-hash
                            class="rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                            <span data-copy-idle>Copy the hash</span>
                            <span data-copy-done class="hidden text-jade-400">Copied</span>
                        </button>
                    </x-slot>
                </x-templates.terms.stamp>

                <div data-pending>
                    <x-templates.terms.notice
                        version="4.2"
                        effective="15 September 2026"
                        announced="1 Aug 2026"
                        :days="28"
                        :window="45"
                        :elapsed="17"
                        lead="Nothing is being taken away from you, so we are telling you rather than asking. You can take it early if you would rather not run two versions across two open orders."
                        promise="Order NS-2026-0114 stays on 4.1 whatever you do here. Accepting early moves the next order, not the last one.">
                        <x-slot:actions>
                            <button type="button" data-accept
                                class="rounded-lg bg-jade-500 px-3 py-1.5 text-[12px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Take 4.2 now</button>

                            <a href="{{ route('templates.screen', ['terms', 'changes']) }}" target="_top"
                                class="rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Read the four diffs first</a>
                        </x-slot>
                    </x-templates.terms.notice>
                </div>

                <div data-accepted-early class="hidden">
                    <x-templates.terms.stamp
                        version="4.2"
                        state="accepted"
                        when="taken early, today"
                        :rows="[
                            ['label' => 'When', 'value' => 'Today, from this page', 'mono' => true],
                            ['label' => 'Who', 'value' => 'tomas@ferreira.pt', 'mono' => true],
                            ['label' => 'Covers', 'value' => 'Orders placed from now on. NS-2026-0114 stays on 4.1.'],
                        ]"
                        note="It would have reached you on 15 September anyway. Taking it early only means the next order does not have to think about which version it is under." />
                </div>

                <section>
                    <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Your orders, and the version each one is stuck to</h2>
                    <p class="mt-2 max-w-xl text-[12px]/5 text-zinc-500">
                        Three orders, three versions. The 2024 one is under terms that gave you seven days rather than
                        fourteen — we are not going to hold you to that, but it is what the paper says and pretending
                        otherwise would make the whole record worthless.
                    </p>

                    <div class="mt-3.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                        @foreach ($orders as $order)
                            <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1 px-3.5 py-3">
                                <span class="font-mono text-[12px] text-zinc-300">{{ $order['ref'] }}</span>
                                <span class="font-mono text-[10px] text-zinc-700">{{ $order['placed'] }}</span>
                                <span class="min-w-0 flex-1 truncate text-[12px] text-zinc-500">{{ $order['what'] }}</span>
                                <span @class([
                                    'shrink-0 rounded border px-1.5 py-0.5 font-mono text-[10px]',
                                    'border-jade-500/40 bg-jade-500/10 text-jade-300' => $order['state'] === 'current',
                                    'border-white/10 text-zinc-600' => $order['state'] !== 'current',
                                ])>under {{ $order['version'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>
            </section>

            <aside>
                <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Every version, kept</h2>
                <p class="mt-2 text-[12px]/5 text-zinc-500">Marked ones are versions you have personally been under.</p>

                <div class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    @foreach ($history as $entry)
                        <div class="flex items-baseline gap-3 px-3 py-2.5">
                            <span @class([
                                'font-mono text-[12px]',
                                'text-cream' => $entry['yours'],
                                'text-zinc-600' => ! $entry['yours'],
                            ])>{{ $entry['version'] }}</span>

                            @if ($entry['yours'])
                                <span class="size-1.5 shrink-0 rounded-full bg-jade-400"></span>
                            @endif

                            <span class="min-w-0 flex-1 truncate font-mono text-[10px] text-zinc-700">{{ $entry['span'] }}</span>
                            <span class="shrink-0 font-mono text-[10px] text-zinc-700">{{ $entry['hash'] }}</span>
                        </div>
                    @endforeach
                </div>

                <h2 class="mt-7 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What the record holds</h2>
                <div class="mt-3 space-y-3.5">
                    @foreach ($kept as $entry)
                        <div class="border-l border-white/8 pl-3">
                            <p class="text-[12px] text-zinc-300">{{ $entry['what'] }}</p>
                            <p class="mt-1 text-[11px]/5 text-zinc-500">{{ $entry['detail'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] text-zinc-600">Nobody here can edit this</p>
                    <p class="mt-1.5 text-[12px]/5 text-zinc-400">
                        Acceptances are written once and never updated. If we ever need to correct one, the correction goes
                        in as a second row with a reason on it and both stay visible — to you and to us.
                    </p>
                    <a href="{{ route('templates.screen', ['contact', 'write']) }}" target="_top"
                        class="mt-2.5 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Query a row</a>
                </div>
            </aside>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-record]');

            if (!root) {
                return;
            }

            const copy = root.querySelector('[data-copy-hash]');
            const idle = root.querySelector('[data-copy-idle]');
            const done = root.querySelector('[data-copy-done]');
            const accept = root.querySelector('[data-accept]');
            const pending = root.querySelector('[data-pending]');
            const early = root.querySelector('[data-accepted-early]');

            let reset;

            copy.addEventListener('click', () => {
                navigator.clipboard?.writeText('8f2c41ab6e3d0917c2f4a58b7d1e6033b9c04af281e5d7620b3a9c1f4e8d5720');

                idle.classList.add('hidden');
                done.classList.remove('hidden');

                clearTimeout(reset);
                reset = setTimeout(() => {
                    idle.classList.remove('hidden');
                    done.classList.add('hidden');
                }, 1600);
            });

            accept.addEventListener('click', () => {
                pending.classList.add('hidden');
                early.classList.remove('hidden');
            });
        })();
    </script>
</x-templates.terms.shell>
