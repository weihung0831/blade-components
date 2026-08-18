@php
    $steps = [
        ['label' => 'You told us', 'at' => '26 Aug, 09:40'],
        ['label' => 'Label used', 'at' => '26 Aug, 18:12'],
        ['label' => 'Opened at the bench', 'at' => '28 Aug, 11:02'],
        ['label' => 'Sent to your card', 'at' => null],
        ['label' => 'In your account', 'at' => null],
    ];

    $paid = [
        ['name' => 'EG-83 grinder, graphite', 'note' => 'coming back', 'amount' => '$1,180', 'tone' => 'back'],
        ['name' => 'Alignment shim kit', 'note' => 'you are keeping it', 'amount' => '$28', 'tone' => 'kept'],
        ['name' => 'Dosing cup, 58 mm × 2', 'note' => 'you are keeping them', 'amount' => '$72', 'tone' => 'kept'],
        ['name' => 'Shipping to Taichung', 'note' => 'free at the time and stays free', 'amount' => '$0', 'tone' => 'kept'],
    ];

    $sums = [
        ['label' => 'The grinder', 'amount' => '$1,180', 'tone' => 'plain'],
        ['label' => 'Return freight, because this one is a change of mind', 'amount' => '−$18', 'tone' => 'minus'],
        ['label' => 'Burr set — waived, 0.6 kg is under the kilo', 'amount' => '−$0', 'tone' => 'waived'],
        ['label' => 'Lands on the card ending 4471', 'amount' => '$1,162', 'tone' => 'total'],
    ];

    $found = [
        ['title' => 'Burrs', 'body' => '0.6 kg through them, measured off the counter reading rather than guessed. Edges clean, no chips. They go back on the shelf as new.', 'meta' => 'photographed 28 Aug, 11:06'],
        ['title' => 'Body', 'body' => 'One mark on the underside, about 4 mm, from the rubber feet. Everything gets that in a week. Not a deduction and never has been.', 'meta' => 'photographed 28 Aug, 11:09'],
        ['title' => 'What was in the box', 'body' => 'Grinder, burr tool, cable, and the hopper you were told to keep. Nothing missing, which is worth saying because a missing cable is the one thing that slows this down.', 'meta' => 'checked 28 Aug, 11:14'],
    ];

    $history = [
        ['when' => 'Mar 2026', 'what' => 'Dosing cup, wrong colour', 'amount' => '$36', 'took' => '4 days'],
        ['when' => 'Nov 2025', 'what' => 'Cleaning tablets, sealed', 'amount' => '$18', 'took' => '5 days'],
    ];
@endphp

<x-templates.refund.shell active="Where yours is">
    <x-slot:toolbar>
        <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
            <span class="font-mono text-[10px] text-zinc-500">RF-2608-0093 · opened at the bench, waiting to be signed off</span>
            <span class="hidden font-mono text-[10px] text-zinc-700 sm:inline">day 3 · median is 6</span>
            <a href="{{ route('templates.screen', ['refund', 'ledger']) }}" target="_top"
                class="ml-auto rounded-lg px-2.5 py-1 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:bg-white/5 hover:text-jade-300">how long these usually take →</a>
        </div>
    </x-slot:toolbar>

    <div class="mx-auto max-w-6xl">

        <h1 class="text-lg font-semibold tracking-tight text-cream">One refund, mid-flight</h1>
        <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
            Five steps, and only three of them are ours. The bench signs off on the fourth, and the fifth belongs to a bank
            that will take three to five working days no matter what anybody here does — so it is drawn as a separate hop
            rather than folded into a promise we cannot keep.
        </p>

        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
            <section>
                <x-templates.refund.stage
                    reference="RF-2608-0093"
                    order="NS-2608-1174"
                    amount="$1,162"
                    lands="expected 2 Sep"
                    :steps="$steps"
                    :stage="2"
                    note="Wei has looked at it and it passed. The sign-off is a person clicking a button on a Thursday, and Thursdays are the day the bench catches up on paperwork." />

                <h2 class="mt-8 text-[15px] font-medium tracking-tight text-cream">The arithmetic</h2>
                <p class="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                    Four lines, all of them shown, including the deduction we chose not to make. A refund figure with no
                    working underneath it is how people end up mailing the support desk to ask where their $40 went.
                </p>

                <div class="mt-3 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    <div class="divide-y divide-white/5">
                        @foreach ($paid as $line)
                            <div class="flex items-baseline gap-4 px-3.5 py-2.5">
                                <p class="min-w-0 flex-1 text-[13px] {{ $line['tone'] === 'back' ? 'text-cream' : 'text-zinc-500' }}">{{ $line['name'] }}</p>
                                <p class="shrink-0 font-mono text-[10px] text-zinc-600">{{ $line['note'] }}</p>
                                <p class="w-16 shrink-0 text-right font-mono text-[12px] {{ $line['tone'] === 'back' ? 'text-zinc-300' : 'text-zinc-600' }}">{{ $line['amount'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="divide-y divide-white/5 border-t border-white/8 bg-ink-950">
                        @foreach ($sums as $row)
                            <div @class([
                                'flex items-baseline gap-4 px-3.5 py-2.5',
                                'bg-jade-500/5' => $row['tone'] === 'total',
                            ])>
                                <p @class([
                                    'min-w-0 flex-1 text-[12px]/5',
                                    'text-cream' => $row['tone'] === 'total',
                                    'text-zinc-500' => $row['tone'] !== 'total',
                                ])>{{ $row['label'] }}</p>
                                <p @class([
                                    'w-20 shrink-0 text-right font-mono text-[13px]',
                                    'text-jade-300' => $row['tone'] === 'total',
                                    'text-amber-300/80' => $row['tone'] === 'minus',
                                    'text-zinc-600' => $row['tone'] === 'waived',
                                    'text-zinc-300' => $row['tone'] === 'plain',
                                ])>{{ $row['amount'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <h2 class="mt-8 text-[15px] font-medium tracking-tight text-cream">What the bench found when it opened the box</h2>
                <p class="mt-1 max-w-2xl text-[12px]/5 text-zinc-500">
                    Written by Wei on the morning, in the order he did it, and sent to you whether or not the outcome depends
                    on any of it. The photographs come with the mail.
                </p>

                <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    @foreach ($found as $note)
                        <div class="rounded-xl border border-white/8 bg-ink-900 p-3.5">
                            <p class="text-[13px] text-cream">{{ $note['title'] }}</p>
                            <p class="mt-1.5 text-[12px]/5 text-zinc-400">{{ $note['body'] }}</p>
                            <p class="mt-2.5 font-mono text-[10px] text-zinc-700">{{ $note['meta'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <aside>
                <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The hop that is not ours</h2>

                <div class="mt-3 rounded-xl border border-amber-400/20 bg-amber-400/5 p-4">
                    <p class="text-[13px] text-cream">Three to five working days at the bank</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        A card refund is not a transfer — it is a reversal that has to clear the same rails the payment came
                        down, and 玉山 posts them on a batch that runs overnight. If you paid by ATM transfer instead, the money
                        goes out as a transfer and lands the next working morning.
                    </p>
                    <div class="mt-3 grid grid-cols-2 gap-2.5">
                        @foreach ([['Card', '3–5 working days'], ['ATM transfer', 'next morning'], ['Pay on collection', 'transfer, 1 day'], ['Instalments', 'next statement']] as [$how, $lag])
                            <div class="rounded-lg border border-white/8 px-2.5 py-2">
                                <p class="font-mono text-[10px] text-zinc-600">{{ $how }}</p>
                                <p class="mt-1 font-mono text-[11px] text-zinc-300">{{ $lag }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If it has been longer</p>
                    <p class="mt-2 text-[12px]/5 text-zinc-400">
                        Past nine days from the sign-off, something has gone wrong and it is worth telling us rather than
                        waiting politely. Twice it has been a card that expired between the order and the refund, which the
                        bank does not tell either of us about.
                    </p>
                    <a href="{{ route('templates.screen', ['contact', 'write']) }}" target="_top"
                        class="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream">Chase it</a>
                </div>

                <h2 class="mt-7 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Your other two</h2>
                <ul class="mt-3 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                    @foreach ($history as $row)
                        <li class="flex items-baseline gap-3 px-3.5 py-3">
                            <span class="w-16 shrink-0 font-mono text-[10px] text-zinc-600">{{ $row['when'] }}</span>
                            <span class="min-w-0 flex-1 text-[12px] text-zinc-400">{{ $row['what'] }}</span>
                            <span class="shrink-0 font-mono text-[11px] text-zinc-300">{{ $row['amount'] }}</span>
                            <span class="w-12 shrink-0 text-right font-mono text-[10px] text-zinc-700">{{ $row['took'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-3 text-[11px]/5 text-zinc-600">
                    Neither of those was argued about and neither is held against you. We have never once looked at a return
                    history and decided somebody was returning too much.
                </p>
            </aside>
        </div>
    </div>
</x-templates.refund.shell>
