@php
    $customers = [
        [
            'key' => 'formosa',
            'name' => 'Formosa Coffee Works Ltd',
            'meta' => 'Kaohsiung · buying since 2021',
            'tax' => '統一編號 24681357',
            'rate' => 5,
            'rateLabel' => 'Business tax 5%',
            'note' => 'A company invoice. Once it is issued the tax number cannot be changed, only voided and reissued, so check it now rather than on Friday.',
        ],
        [
            'key' => 'kuro',
            'name' => 'Kuro Roasters KK',
            'meta' => 'Osaka · export, third order',
            'tax' => 'no Taiwan tax number',
            'rate' => 0,
            'rateLabel' => 'Zero-rated export',
            'note' => 'Zero-rated, which only holds if the bill of lading is filed with the return. Keep the forwarder receipt against this invoice number.',
        ],
        [
            'key' => 'walkin',
            'name' => 'A shop with no account yet',
            'meta' => 'first order · pays before it ships',
            'tax' => 'tax number to be confirmed',
            'rate' => 5,
            'rateLabel' => 'Business tax 5%',
            'note' => 'No credit on a first order. This one prints as a proforma and turns into an invoice the day the money lands.',
        ],
    ];

    $lines = [
        ['code' => 'MK3-GR', 'description' => 'Mk3 hand grinder, graphite', 'note' => 'Batch 40, ready now', 'price' => 2940, 'qty' => 40, 'step' => 4, 'unit' => 'ea', 'kind' => 'machine'],
        ['code' => 'BUR-38', 'description' => '38 mm burr set, spare', 'note' => 'Off the shelf behind the bench', 'price' => 520, 'qty' => 60, 'step' => 10, 'unit' => 'set', 'kind' => 'part'],
        ['code' => 'COL-02', 'description' => 'Collar, with the 2 mm key', 'note' => 'The part that works loose', 'price' => 45, 'qty' => 100, 'step' => 20, 'unit' => 'ea', 'kind' => 'part'],
        ['code' => 'FRT-KH', 'description' => 'Freight, two pallets', 'note' => 'At cost, quote attached', 'price' => 3800, 'qty' => 1, 'step' => 1, 'unit' => 'job', 'kind' => 'freight'],
    ];

    $terms = [
        ['key' => '14', 'label' => 'Net 14', 'due' => '2 September 2026', 'note' => 'A Wednesday. Most shops run payments on a Wednesday, so this one usually lands on the day.'],
        ['key' => '30', 'label' => 'Net 30', 'due' => '18 September 2026', 'note' => 'A Friday, which means the money moves that afternoon or on Monday. Assume Monday.'],
        ['key' => '60', 'label' => 'Net 60', 'due' => '19 October 2026', 'note' => '60 days lands on a Sunday, so the date on the invoice is the Monday. We give 60 days to four accounts and this is one of them.'],
    ];
@endphp

<x-templates.invoice.shell active="Writing one">
    <x-slot:toolbar>
        <div class="mx-auto flex max-w-5xl flex-wrap items-center gap-3">
            <x-templates.invoice.stamp label="Draft" tone="draft" tilt="none" class="scale-90" />

            <span class="font-mono text-[10px] text-zinc-600">INV-2026-0208 · saved 40 seconds ago</span>

            <span class="ml-auto flex items-center gap-2">
                <button type="button"
                    class="rounded-lg border border-white/10 px-2.5 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Save and come back</button>
                <button type="button"
                    class="rounded-lg bg-jade-500 px-3 py-1.5 text-[12px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Issue it</button>
            </span>
        </div>
    </x-slot:toolbar>

    <div data-compose class="mx-auto grid max-w-5xl grid-cols-1 gap-4 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)]">

        <div class="flex flex-col gap-4">
            <section class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                <div class="flex items-baseline justify-between gap-3">
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">Who it goes to</h2>
                    <span class="font-mono text-[10px] text-zinc-700">the tax treatment follows from this</span>
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    @foreach ($customers as $customer)
                        <button type="button" data-customer="{{ $customer['key'] }}"
                            data-payload="{{ json_encode($customer) }}"
                            @class([
                                'flex items-start gap-3 rounded-xl border px-3.5 py-3 text-left transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                'border-jade-500/50 bg-jade-500/8' => $loop->first,
                                'border-white/8 hover:border-white/20' => ! $loop->first,
                            ])>
                            <span data-customer-tick @class([
                                'mt-1 size-3.5 shrink-0 rounded-full border',
                                'border-jade-400 bg-jade-500' => $loop->first,
                                'border-white/15' => ! $loop->first,
                            ])></span>

                            <span class="min-w-0 flex-1">
                                <span class="flex flex-wrap items-baseline gap-x-2">
                                    <span class="text-[13px] text-cream">{{ $customer['name'] }}</span>
                                    <span class="font-mono text-[10px] text-zinc-600">{{ $customer['meta'] }}</span>
                                </span>
                                <span class="mt-1 block font-mono text-[10px] text-jade-300">{{ $customer['tax'] }}</span>
                            </span>

                            <span @class([
                                'shrink-0 rounded-lg border px-2 py-0.5 font-mono text-[10px]',
                                'border-amber-400/30 text-amber-300' => $customer['rate'] === 0,
                                'border-white/10 text-zinc-500' => $customer['rate'] !== 0,
                            ])>{{ $customer['rate'] }}%</span>
                        </button>
                    @endforeach
                </div>
            </section>

            <section class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                <div class="flex items-baseline justify-between gap-3">
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">What is on it</h2>
                    <span class="font-mono text-[10px] text-zinc-700">50 machines or more takes 3% off the machines</span>
                </div>

                <div class="mt-4 flex flex-col divide-y divide-white/5">
                    @foreach ($lines as $line)
                        <div data-line data-price="{{ $line['price'] }}" data-step="{{ $line['step'] }}" data-qty="{{ $line['qty'] }}" data-kind="{{ $line['kind'] }}"
                            class="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
                            <div class="min-w-0 flex-1">
                                <p class="text-[13px]/5 text-cream">{{ $line['description'] }}</p>
                                <p class="mt-0.5 text-[11px]/5 text-zinc-600">{{ $line['note'] }}</p>
                                <p class="mt-1 font-mono text-[10px] text-zinc-700">{{ $line['code'] }} · NT${{ number_format($line['price']) }} each</p>
                            </div>

                            <div class="flex shrink-0 items-center gap-1.5">
                                <button type="button" data-step-down aria-label="fewer"
                                    class="grid size-6 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">−</button>

                                <span class="w-14 text-center">
                                    <span data-qty-value class="block font-mono text-[13px] tabular-nums text-cream">{{ $line['qty'] }}</span>
                                    <span class="block font-mono text-[9px] text-zinc-700">{{ $line['unit'] }}</span>
                                </span>

                                <button type="button" data-step-up aria-label="more"
                                    class="grid size-6 place-items-center rounded-lg border border-white/10 text-zinc-400 transition-colors duration-150 outline-none hover:border-white/25 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">+</button>
                            </div>

                            <span data-line-amount class="w-24 shrink-0 text-right font-mono text-[12px] tabular-nums text-zinc-300"></span>
                        </div>
                    @endforeach
                </div>

                <button type="button"
                    class="mt-4 w-full rounded-xl border border-dashed border-white/12 px-3 py-2.5 text-[12px] text-zinc-500 transition-colors duration-150 outline-none hover:border-jade-500/50 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    Add a line · the last eleven invoices all used the same four
                </button>
            </section>

            <section class="rounded-2xl border border-white/8 bg-ink-950 p-5">
                <div class="flex items-baseline justify-between gap-3">
                    <h2 class="text-[15px] font-medium tracking-tight text-cream">When it is due</h2>
                    <span class="font-mono text-[10px] text-zinc-700">issued 19 August 2026</span>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($terms as $term)
                        <button type="button" data-terms="{{ $term['key'] }}" data-payload="{{ json_encode($term) }}"
                            @class([
                                'rounded-xl border px-3 py-2 text-[12px] transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70',
                                'border-jade-500/50 bg-jade-500/8 text-cream' => $term['key'] === '30',
                                'border-white/8 text-zinc-400 hover:border-white/20 hover:text-cream' => $term['key'] !== '30',
                            ])>{{ $term['label'] }}</button>
                    @endforeach
                </div>

                <p data-terms-note class="mt-3 text-[12px]/5 text-zinc-500"></p>
            </section>
        </div>

        <div class="flex flex-col gap-4">
            <section class="overflow-hidden rounded-2xl border border-white/10 bg-ink-900">
                <div class="flex items-baseline justify-between border-b border-white/8 px-5 py-3">
                    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What the customer will get</p>
                    <p class="font-mono text-[10px] text-zinc-700">INV-2026-0208</p>
                </div>

                <div class="px-5 py-4">
                    <p data-preview-name class="text-[14px] font-medium tracking-tight text-cream"></p>
                    <p data-preview-tax class="mt-1 font-mono text-[10px] text-jade-300"></p>

                    <dl class="mt-4 flex flex-col gap-2 border-t border-white/6 pt-3">
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="text-[12px] text-zinc-500">Subtotal</dt>
                            <dd data-sum-subtotal class="font-mono text-[12px] tabular-nums text-zinc-300"></dd>
                        </div>

                        <div data-discount-row class="flex items-baseline justify-between gap-4">
                            <dt class="text-[12px] text-zinc-500">Trade discount <span class="font-mono text-[10px] text-zinc-700">3%, machines</span></dt>
                            <dd data-sum-discount class="font-mono text-[12px] tabular-nums text-zinc-400"></dd>
                        </div>

                        <div class="flex items-baseline justify-between gap-4">
                            <dt data-tax-label class="text-[12px] text-zinc-500"></dt>
                            <dd data-sum-tax class="font-mono text-[12px] tabular-nums text-zinc-400"></dd>
                        </div>

                        <div class="flex items-baseline justify-between gap-4 border-t border-white/10 pt-3">
                            <dt class="text-[13px] text-zinc-300">Total</dt>
                            <dd data-sum-total class="font-mono text-lg font-semibold tracking-tight tabular-nums text-jade-300"></dd>
                        </div>
                    </dl>

                    <dl class="mt-4 flex flex-col gap-1.5 border-t border-white/6 pt-3">
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="font-mono text-[10px] text-zinc-700">terms</dt>
                            <dd data-preview-terms class="font-mono text-[11px] text-zinc-400"></dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="font-mono text-[10px] text-zinc-700">due</dt>
                            <dd data-preview-due class="font-mono text-[11px] text-zinc-300"></dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="font-mono text-[10px] text-zinc-700">machines</dt>
                            <dd data-preview-machines class="font-mono text-[11px] text-zinc-400"></dd>
                        </div>
                    </dl>
                </div>
            </section>

            <section class="rounded-2xl border border-amber-400/25 bg-amber-400/4 p-4">
                <p class="font-mono text-[10px] tracking-wider text-amber-300 uppercase">Before you press issue</p>
                <p data-customer-note class="mt-2 text-[12px]/5 text-zinc-400"></p>
            </section>

            <section class="rounded-2xl border border-white/8 bg-ink-900/50 p-4">
                <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What issuing actually does</p>
                <ul class="mt-2.5 flex flex-col gap-1.5">
                    @foreach ([
                        'Files the e-invoice with the Ministry of Finance, which is the part that cannot be taken back.',
                        'Emails the PDF to the address on the account, and nowhere else.',
                        'Puts the amount into the ledger as outstanding from that minute, not from when it is opened.',
                        'Books the stock out. If the pallet is still here on Friday, that is a separate problem.',
                    ] as $step)
                        <li class="flex gap-2 text-[11px]/5 text-zinc-500">
                            <span class="mt-1.5 size-1 shrink-0 rounded-full bg-zinc-700"></span>
                            {{ $step }}
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-compose]');

            if (!root) {
                return;
            }

            const money = (value) => `NT$${Math.round(value).toLocaleString('en-US')}`;

            const lines = [...root.querySelectorAll('[data-line]')];
            const customers = [...root.querySelectorAll('[data-customer]')];
            const terms = [...root.querySelectorAll('[data-terms]')];

            const out = {
                name: root.querySelector('[data-preview-name]'),
                tax: root.querySelector('[data-preview-tax]'),
                note: root.querySelector('[data-customer-note]'),
                subtotal: root.querySelector('[data-sum-subtotal]'),
                discountRow: root.querySelector('[data-discount-row]'),
                discount: root.querySelector('[data-sum-discount]'),
                taxLabel: root.querySelector('[data-tax-label]'),
                taxValue: root.querySelector('[data-sum-tax]'),
                total: root.querySelector('[data-sum-total]'),
                terms: root.querySelector('[data-preview-terms]'),
                due: root.querySelector('[data-preview-due]'),
                machines: root.querySelector('[data-preview-machines]'),
                termsNote: root.querySelector('[data-terms-note]'),
            };

            let customer = JSON.parse(customers[0].dataset.payload);
            let term = JSON.parse(terms.find((button) => button.dataset.terms === '30').dataset.payload);

            const render = () => {
                let subtotal = 0;
                let machineTotal = 0;
                let machines = 0;

                lines.forEach((line) => {
                    const qty = Number(line.dataset.qty);
                    const amount = qty * Number(line.dataset.price);

                    subtotal += amount;

                    if (line.dataset.kind === 'machine') {
                        machineTotal += amount;
                        machines += qty;
                    }

                    line.querySelector('[data-qty-value]').textContent = qty;
                    line.querySelector('[data-line-amount]').textContent = money(amount);
                });

                const discount = machines >= 50 ? Math.round(machineTotal * 0.03) : 0;
                const taxable = subtotal - discount;
                const tax = Math.round(taxable * customer.rate / 100);

                out.name.textContent = customer.name;
                out.tax.textContent = customer.tax;
                out.note.textContent = customer.note;
                out.subtotal.textContent = money(subtotal);
                out.discountRow.classList.toggle('hidden', discount === 0);
                out.discount.textContent = `−${money(discount)}`;
                out.taxLabel.textContent = customer.rateLabel;
                out.taxValue.textContent = money(tax);
                out.total.textContent = money(taxable + tax);
                out.terms.textContent = `Net ${term.key}`;
                out.due.textContent = term.due;
                out.termsNote.textContent = term.note;
                out.machines.textContent = machines >= 50 ? `${machines} · discount applies` : `${machines} · ${50 - machines} short of the discount`;
            };

            lines.forEach((line) => {
                const step = Number(line.dataset.step);

                line.querySelector('[data-step-down]').addEventListener('click', () => {
                    line.dataset.qty = Math.max(0, Number(line.dataset.qty) - step);
                    render();
                });

                line.querySelector('[data-step-up]').addEventListener('click', () => {
                    line.dataset.qty = Number(line.dataset.qty) + step;
                    render();
                });
            });

            customers.forEach((button) => {
                button.addEventListener('click', () => {
                    customer = JSON.parse(button.dataset.payload);

                    customers.forEach((other) => {
                        const on = other === button;
                        const tick = other.querySelector('[data-customer-tick]');

                        other.classList.toggle('border-jade-500/50', on);
                        other.classList.toggle('bg-jade-500/8', on);
                        other.classList.toggle('border-white/8', !on);
                        other.classList.toggle('hover:border-white/20', !on);
                        tick.classList.toggle('border-jade-400', on);
                        tick.classList.toggle('bg-jade-500', on);
                        tick.classList.toggle('border-white/15', !on);
                    });

                    render();
                });
            });

            terms.forEach((button) => {
                button.addEventListener('click', () => {
                    term = JSON.parse(button.dataset.payload);

                    terms.forEach((other) => {
                        const on = other === button;

                        other.classList.toggle('border-jade-500/50', on);
                        other.classList.toggle('bg-jade-500/8', on);
                        other.classList.toggle('text-cream', on);
                        other.classList.toggle('border-white/8', !on);
                        other.classList.toggle('text-zinc-400', !on);
                        other.classList.toggle('hover:border-white/20', !on);
                        other.classList.toggle('hover:text-cream', !on);
                    });

                    render();
                });
            });

            render();
        })();
    </script>
</x-templates.invoice.shell>
