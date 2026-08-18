@php
    $buckets = [
        ['key' => 'all', 'label' => 'Everything out', 'count' => 42, 'amount' => 'NT$1,943,600', 'value' => 1943600, 'tone' => 'quiet', 'note' => 'Across 19 accounts, two of which are half of it.'],
        ['key' => 'open', 'label' => 'Not due yet', 'count' => 18, 'amount' => 'NT$742,300', 'value' => 742300, 'tone' => 'ok', 'note' => 'Nothing to do. Two of these were paid before the invoice arrived.'],
        ['key' => 'd30', 'label' => '1 – 30 days late', 'count' => 12, 'amount' => 'NT$486,200', 'value' => 486200, 'tone' => 'warn', 'note' => 'Mostly people who pay on the second run of the month.'],
        ['key' => 'd60', 'label' => '31 – 60 days', 'count' => 7, 'amount' => 'NT$328,400', 'value' => 328400, 'tone' => 'warn', 'note' => 'Where a polite email stops working and somebody has to ring.'],
        ['key' => 'd90', 'label' => 'Over 60 days', 'count' => 5, 'amount' => 'NT$386,700', 'value' => 386700, 'tone' => 'bad', 'note' => 'A fifth of the money, and the accounts are on shipping hold.'],
    ];

    $rows = [
        ['number' => 'INV-2026-0207', 'customer' => 'Formosa Coffee Works', 'issued' => '12 Aug', 'due' => '11 Sep', 'amount' => 'NT$246,050', 'age' => 'not due', 'bucket' => 'open', 'state' => 'Issued three days ago. They pay on the Wednesday run and have never missed one.', 'tone' => 'ok'],
        ['number' => 'INV-2026-0205', 'customer' => 'Kuro Roasters KK', 'issued' => '08 Aug', 'due' => '07 Sep', 'amount' => 'NT$412,000', 'age' => 'not due', 'bucket' => 'open', 'state' => 'The biggest invoice on the book and the one we worry about least.', 'tone' => 'ok'],
        ['number' => 'INV-2026-0201', 'customer' => 'Bean & Bell', 'issued' => '28 Jul', 'due' => '27 Aug', 'amount' => 'NT$84,150', 'age' => 'not due', 'bucket' => 'open', 'state' => 'New account, second order, paying in advance until March.', 'tone' => 'ok'],
        ['number' => 'INV-2026-0196', 'customer' => 'Tamsui Roastery', 'issued' => '14 Jul', 'due' => '13 Aug', 'amount' => 'NT$52,400', 'age' => '6 days', 'bucket' => 'd30', 'state' => 'Six days. Nobody has written to them and nobody is going to this week.', 'tone' => 'quiet'],
        ['number' => 'INV-2026-0192', 'customer' => 'Green Island Coffee', 'issued' => '02 Jul', 'due' => '01 Aug', 'amount' => 'NT$118,900', 'age' => '18 days', 'bucket' => 'd30', 'state' => 'Reminded once, on the 10th. They replied the same afternoon asking for the PDF again.', 'tone' => 'quiet'],
        ['number' => 'INV-2026-0190', 'customer' => 'Taichung Beans', 'issued' => '25 Jun', 'due' => '25 Jul', 'amount' => 'NT$74,200', 'age' => '25 days', 'bucket' => 'd30', 'state' => 'Promised for this Friday, by the owner, on the phone. That has been true three times before.', 'tone' => 'warn'],
        ['number' => 'INV-2026-0188', 'customer' => 'Hsinchu Supply Co', 'issued' => '12 Jun', 'due' => '12 Jul', 'amount' => 'NT$96,300', 'age' => '38 days', 'bucket' => 'd60', 'state' => 'Their finance person left in July and the mailbox went with her. We are writing to the shop instead.', 'tone' => 'warn'],
        ['number' => 'INV-2026-0186', 'customer' => 'Chiayi Roasters', 'issued' => '29 May', 'due' => '28 Jun', 'amount' => 'NT$58,900', 'age' => '52 days', 'bucket' => 'd60', 'state' => 'Part paid, NT$20,000 of it, with no reference. Took eleven days to work out whose it was.', 'tone' => 'warn'],
        ['number' => 'INV-2026-0184', 'customer' => 'Nanfang Trading', 'issued' => '07 May', 'due' => '06 Jun', 'amount' => 'NT$186,900', 'age' => '74 days', 'bucket' => 'd90', 'state' => 'Four letters, one phone call, one part payment. The whole thing is written out on the next screen.', 'tone' => 'bad'],
        ['number' => 'INV-2026-0179', 'customer' => 'Yilan Coffee House', 'issued' => '22 Apr', 'due' => '22 May', 'amount' => 'NT$64,800', 'age' => '89 days', 'bucket' => 'd90', 'state' => 'The shop closed in June. We are behind two banks and a landlord, and we will not see this.', 'tone' => 'bad'],
        ['number' => 'INV-2026-0175', 'customer' => 'Kaohsiung Kiosk', 'issued' => '15 May', 'due' => '14 Jun', 'amount' => 'NT$38,400', 'age' => '66 days', 'bucket' => 'd90', 'state' => 'On hold since July. They keep ordering and we keep saying no, which is the only thing that has ever worked.', 'tone' => 'bad'],
    ];
@endphp

<x-templates.invoice.shell active="What is owed">
    <x-slot:toolbar>
        <div class="mx-auto flex max-w-5xl flex-wrap items-center gap-3">
            <span class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Receivables</span>
            <span data-ledger-count class="font-mono text-[11px] text-zinc-500"></span>

            <span class="ml-auto flex items-center gap-2">
                <button type="button"
                    class="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Export the lot as CSV</button>
                <span class="font-mono text-[10px] text-zinc-700">as at 19 Aug 2026, 08:00</span>
            </span>
        </div>
    </x-slot:toolbar>

    <div data-ledger class="mx-auto max-w-5xl">

        <header class="flex flex-wrap items-end justify-between gap-4">
            <div class="max-w-xl">
                <h1 class="text-2xl font-semibold tracking-tight text-balance text-cream">NT$1,943,600 is out there, and a fifth of it is older than sixty days.</h1>
                <p class="mt-3 text-[13px]/6 text-zinc-400">
                    Sorted by how late rather than how large. The largest invoice on the book is not due until September and
                    has never once been paid late; the one that keeps four people awake is NT$186,900 from a company that
                    has stopped answering.
                </p>
            </div>

            <div class="text-right">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Average days to pay</p>
                <p class="mt-1 font-mono text-2xl tabular-nums text-cream">34</p>
                <p class="mt-0.5 font-mono text-[10px] text-zinc-600">terms say 30 · was 41 in 2024</p>
            </div>
        </header>

        <section class="mt-8 grid grid-cols-1 gap-2.5 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ($buckets as $bucket)
                <button type="button" data-bucket="{{ $bucket['key'] }}" class="text-left outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    <x-templates.invoice.aging
                        data-aging
                        :label="$bucket['label']"
                        :count="$bucket['count']"
                        :amount="$bucket['amount']"
                        :value="$bucket['value']"
                        :max="1943600"
                        :tone="$bucket['tone']"
                        :note="$bucket['note']"
                        :active="$loop->first" />
                </button>
            @endforeach
        </section>

        <section class="mt-8">
            <div class="flex items-baseline gap-3">
                <h2 class="font-mono text-[11px] tracking-wider text-zinc-600 uppercase">The eleven worth looking at</h2>
                <span class="h-px min-w-0 flex-1 bg-white/6"></span>
                <span class="shrink-0 font-mono text-[10px] text-zinc-700">the other 31 are under NT$20,000 each</span>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-white/8 bg-ink-950">
                <table class="w-full min-w-3xl border-collapse text-left">
                    <thead>
                        <tr class="border-b border-white/8">
                            @foreach (['invoice', 'who', 'issued', 'due', 'amount', 'late by'] as $head)
                                <th class="px-4 py-2.5 font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">{{ $head }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr data-row data-bucket="{{ $row['bucket'] }}" @class(['align-top', 'border-t border-white/5' => ! $loop->first])>
                                <td class="px-4 py-3 font-mono text-[12px] whitespace-nowrap text-cream">{{ $row['number'] }}</td>

                                <td class="px-4 py-3">
                                    <span class="block text-[13px]/5 text-zinc-200">{{ $row['customer'] }}</span>
                                    <span class="mt-1 block max-w-md text-[11px]/5 text-zinc-600">{{ $row['state'] }}</span>
                                </td>

                                <td class="px-4 py-3 font-mono text-[11px] whitespace-nowrap text-zinc-500">{{ $row['issued'] }}</td>
                                <td class="px-4 py-3 font-mono text-[11px] whitespace-nowrap text-zinc-400">{{ $row['due'] }}</td>
                                <td class="px-4 py-3 text-right font-mono text-[12px] tabular-nums whitespace-nowrap text-zinc-200">{{ $row['amount'] }}</td>

                                <td class="px-4 py-3">
                                    <span @class([
                                        'inline-flex items-center rounded-lg border px-2 py-0.5 font-mono text-[10px] whitespace-nowrap',
                                        'border-jade-500/30 text-jade-300' => $row['tone'] === 'ok',
                                        'border-white/10 text-zinc-500' => $row['tone'] === 'quiet',
                                        'border-amber-400/30 text-amber-300' => $row['tone'] === 'warn',
                                        'border-red-400/30 text-red-400' => $row['tone'] === 'bad',
                                    ])>{{ $row['age'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p data-ledger-empty class="mt-3 hidden rounded-2xl border border-white/8 bg-ink-900 px-4 py-8 text-center text-[12px] text-zinc-600">
                Nothing in that bucket is over NT$20,000, so none of it is on this list.
            </p>
        </section>

        <section class="mt-10 grid grid-cols-1 gap-3 lg:grid-cols-3">
            <div class="rounded-2xl border border-jade-500/25 bg-jade-500/5 p-5">
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">The big one is not the problem</p>
                <p class="mt-2 text-[12px]/5 text-zinc-400">
                    NT$412,000 to Osaka, due 7 September, and Kuro have paid inside 21 days every time since 2023. Size and
                    risk are different columns and a ledger sorted by amount hides that.
                </p>
            </div>

            <div class="rounded-2xl border border-white/8 bg-ink-900/50 p-5">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we stopped doing</p>
                <p class="mt-2 text-[12px]/5 text-zinc-500">
                    Automatic reminders at 7, 14 and 21 days. They went to a mailbox nobody read and made the first real
                    conversation harder. Now one person rings at day 20. Average days to pay went from 41 to 34.
                </p>
            </div>

            <div class="rounded-2xl border border-red-400/20 bg-red-400/4 p-5">
                <p class="font-mono text-[10px] tracking-wider text-red-400 uppercase">Written off this year</p>
                <p class="mt-2 text-[12px]/5 text-zinc-400">
                    NT$64,800, one shop, closed in June. We took it off the book in July rather than leaving it on to make
                    the total look better. Two more will follow it if nothing changes by October.
                </p>
            </div>
        </section>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-ledger]');

            if (!root) {
                return;
            }

            const buttons = [...root.querySelectorAll('[data-bucket]')].filter((node) => node.tagName === 'BUTTON');
            const rows = [...root.querySelectorAll('[data-row]')];
            const count = document.querySelector('[data-ledger-count]');
            const empty = root.querySelector('[data-ledger-empty]');

            const apply = (key) => {
                buttons.forEach((button) => {
                    const card = button.querySelector('[data-aging]');
                    const on = button.dataset.bucket === key;

                    card.classList.toggle('border-jade-500/50', on);
                    card.classList.toggle('bg-jade-500/6', on);
                    card.classList.toggle('border-white/8', !on);
                    card.classList.toggle('bg-ink-950', !on);
                    card.classList.toggle('hover:border-white/20', !on);
                });

                let shown = 0;

                rows.forEach((row) => {
                    const on = key === 'all' || row.dataset.bucket === key;

                    row.classList.toggle('hidden', !on);
                    shown += on ? 1 : 0;
                });

                empty.classList.toggle('hidden', shown > 0);

                if (count) {
                    count.textContent = `${shown} of 42 invoices shown`;
                }
            };

            buttons.forEach((button) => button.addEventListener('click', () => apply(button.dataset.bucket)));
            apply('all');
        })();
    </script>
</x-templates.invoice.shell>
