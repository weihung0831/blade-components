@php
    $lines = [
        ['description' => 'Mk3 hand grinder, graphite', 'note' => 'Batch 40. Alignment sheet in each box, signed.', 'code' => 'MK3-GR', 'qty' => '40', 'unit' => 'ea', 'price' => '2,940', 'amount' => '117,600'],
        ['description' => 'Mk3 hand grinder, cream', 'note' => 'Batch 40, the last twelve of that colour run.', 'code' => 'MK3-CR', 'qty' => '12', 'unit' => 'ea', 'price' => '2,940', 'amount' => '35,280'],
        ['description' => 'Mk3 hand grinder, jade', 'code' => 'MK3-JD', 'qty' => '8', 'unit' => 'ea', 'price' => '3,080', 'amount' => '24,640'],
        ['description' => '38 mm burr set, spare', 'note' => 'Held against the 6,000 machines already out there.', 'code' => 'BUR-38', 'qty' => '60', 'unit' => 'set', 'price' => '520', 'amount' => '31,200'],
        ['description' => 'Crank assembly, Mk3', 'code' => 'CRK-M3', 'qty' => '24', 'unit' => 'ea', 'price' => '340', 'amount' => '8,160'],
        ['description' => 'Collar, with the 2 mm key', 'note' => 'The part that works loose on one machine in nine.', 'code' => 'COL-02', 'qty' => '100', 'unit' => 'ea', 'price' => '45', 'amount' => '4,500'],
        ['description' => 'Seconds shelf, cosmetic dents', 'note' => 'Sold as seen, listed as seconds, no warranty shortened.', 'code' => 'MK3-SC', 'qty' => '6', 'unit' => 'ea', 'price' => '1,900', 'amount' => '11,400'],
        ['description' => 'Retail display stand, unpainted ash', 'code' => 'DSP-04', 'qty' => '4', 'unit' => 'ea', 'price' => '1,250', 'amount' => '5,000'],
        ['description' => 'Freight, Taipei to Kaohsiung, two pallets', 'note' => 'At cost. The quote is attached to the email this came with.', 'code' => 'FRT-KH', 'qty' => '1', 'unit' => 'job', 'price' => '3,800', 'amount' => '3,800'],
    ];

    $totals = [
        ['label' => 'Subtotal', 'value' => 'NT$241,580', 'strong' => true],
        ['label' => 'Trade discount', 'note' => '3%, over 50 machines', 'value' => '−NT$7,247'],
        ['label' => 'Taxable amount', 'value' => 'NT$234,333'],
        ['label' => 'Business tax', 'note' => '5%, rounded to the dollar', 'value' => 'NT$11,717'],
    ];

    $bank = [
        ['label' => 'bank', 'value' => 'Bank of Taipei, Bade Rd branch'],
        ['label' => 'account', 'value' => '0421-1793-0055-8'],
        ['label' => 'in the name of', 'value' => 'Nomad Supply Ltd'],
        ['label' => 'swift', 'value' => 'BOTPTWTP'],
        ['label' => 'reference', 'value' => 'INV-2026-0207'],
    ];
@endphp

<x-templates.invoice.shell active="The invoice">
    <x-slot:toolbar>
        <div class="mx-auto flex max-w-4xl flex-wrap items-center gap-2">
            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M4.5 6V2.5h7V6M4.5 11.5h7v2h-7z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><path d="M4.5 6h-2v5h2m7-5h2v5h-2" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
                Print
            </button>

            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                Download the PDF
                <span class="font-mono text-[10px] text-zinc-600">84 kB</span>
            </button>

            <button type="button" data-tax-toggle
                class="inline-flex items-center gap-2 rounded-lg border border-jade-500/40 bg-jade-500/8 px-2.5 py-1.5 text-[12px] text-jade-300 transition-colors duration-150 outline-none hover:border-jade-500/70 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                <span data-tax-label>Hide the tax column</span>
            </button>

            <span class="ml-auto font-mono text-[10px] text-zinc-700">A4 · one page · issued 12 Aug 2026, 09:14</span>
        </div>
    </x-slot:toolbar>

    <div class="mx-auto max-w-4xl">
        <x-templates.invoice.paper
            number="INV-2026-0207"
            issued="12 August 2026"
            due="11 September 2026"
            terms="Net 30"
            reference="PO-4471">

            <div class="flex flex-col gap-6 border-b border-white/8 p-6 sm:flex-row sm:items-start sm:justify-between sm:p-8">
                <div class="grid min-w-0 flex-1 grid-cols-1 gap-6 sm:grid-cols-2">
                    <x-templates.invoice.party
                        role="to"
                        name="Formosa Coffee Works Ltd"
                        tax-id="24681357"
                        :lines="['3F, No. 88, Zhongshan 2nd Rd', 'Xinxing District, Kaohsiung 800']"
                        contact="accounts@formosacoffee.tw · Ms Hsu" />

                    <x-templates.invoice.party
                        role="ship"
                        name="Formosa Coffee Works — warehouse"
                        :lines="['No. 5, Ln. 210, Fuxing 3rd Rd', 'Qianzhen District, Kaohsiung 806']"
                        contact="deliveries taken 09:00–16:00, weekdays"
                        note="Two pallets. The dock has no forklift, so the driver brings a tail lift." />
                </div>

                <x-templates.invoice.stamp
                    label="Issued"
                    tone="issued"
                    note="due in 30 days"
                    class="shrink-0" />
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-2xl border-collapse text-left">
                    <thead>
                        <tr>
                            <th class="py-2.5 pr-3 pl-6 font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase sm:pl-8">what it is</th>
                            <th class="px-3 py-2.5 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">qty</th>
                            <th class="px-3 py-2.5 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">unit</th>
                            <th data-tax-col class="px-3 py-2.5 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase">tax</th>
                            <th class="py-2.5 pr-6 pl-3 text-right font-mono text-[10px] font-normal tracking-wider text-zinc-700 uppercase sm:pr-8">amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lines as $line)
                            <x-templates.invoice.line
                                :code="$line['code']"
                                :description="$line['description']"
                                :note="$line['note'] ?? null"
                                :qty="$line['qty']"
                                :unit="$line['unit']"
                                :price="$line['price']"
                                :amount="$line['amount']"
                                :show-tax="true" />
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col gap-8 border-t border-white/8 p-6 sm:flex-row sm:justify-between sm:p-8">
                <div class="min-w-0 flex-1">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Where the money goes</p>

                    <dl class="mt-3 grid max-w-sm grid-cols-[auto_minmax(0,1fr)] gap-x-4 gap-y-1.5">
                        @foreach ($bank as $row)
                            <dt class="font-mono text-[10px] text-zinc-700">{{ $row['label'] }}</dt>
                            <dd class="font-mono text-[11px] text-zinc-400">{{ $row['value'] }}</dd>
                        @endforeach
                    </dl>

                    <p class="mt-4 max-w-sm text-[11px]/5 text-zinc-600">
                        Put the invoice number in the reference field. Three payments last year arrived without one and the
                        longest took eleven days to match to an account.
                    </p>
                </div>

                <div class="w-full shrink-0 sm:w-72">
                    <x-templates.invoice.totals
                        :rows="$totals"
                        total="NT$246,050"
                        total-label="Total due"
                        tone="due"
                        words="Two hundred and forty-six thousand and fifty New Taiwan dollars."
                        note="one payment, no instalments on this account" />
                </div>
            </div>

            <div class="border-t border-white/8 bg-ink-950/40 p-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                    <div>
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">The tax document</p>
                        <p class="mt-2 text-[11px]/5 text-zinc-500">
                            Triplicate e-invoice AB-27461930 was filed with the Ministry of Finance the morning this went out.
                            That is the document your accountant needs. This page is the working copy.
                        </p>
                    </div>

                    <div>
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">If it is late</p>
                        <p class="mt-2 text-[11px]/5 text-zinc-500">
                            1% a month, which we have charged twice in seven years and waived both times it was asked about.
                            What actually happens at 60 days is that the next order does not ship.
                        </p>
                    </div>

                    <div>
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Who wrote this</p>
                        <p class="mt-2 text-[11px]/5 text-zinc-500">
                            Ana Lu, Tuesday morning, from the bench. Anything wrong on it is hers to fix and she would rather
                            hear about it before the payment run than after.
                        </p>
                        <p class="mt-2 font-mono text-[10px] text-zinc-700">ana@nomadsupply.tw</p>
                    </div>
                </div>
            </div>
        </x-templates.invoice.paper>

        <p class="mt-4 text-center font-mono text-[10px] text-zinc-700">
            page 1 of 1 · INV-2026-0207 · Nomad Supply Ltd, 統一編號 54318207
        </p>
    </div>

    <script>
        (() => {
            const toggle = document.querySelector('[data-tax-toggle]');

            if (!toggle) {
                return;
            }

            const label = toggle.querySelector('[data-tax-label]');
            const cells = [...document.querySelectorAll('[data-tax-col]')];
            let shown = true;

            toggle.addEventListener('click', () => {
                shown = !shown;

                cells.forEach((cell) => cell.classList.toggle('hidden', !shown));
                label.textContent = shown ? 'Hide the tax column' : 'Show the tax column';
                toggle.classList.toggle('border-jade-500/40', shown);
                toggle.classList.toggle('bg-jade-500/8', shown);
                toggle.classList.toggle('text-jade-300', shown);
                toggle.classList.toggle('border-white/10', !shown);
                toggle.classList.toggle('text-zinc-300', !shown);
            });
        })();
    </script>
</x-templates.invoice.shell>
