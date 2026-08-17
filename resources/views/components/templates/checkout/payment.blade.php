@php
    $lines = [
        ['sku' => 'EG83-GRA', 'name' => 'EG-83 grinder', 'option' => 'graphite', 'price' => 1180, 'qty' => 1],
        ['sku' => 'SHM-KIT', 'name' => 'Alignment shim kit', 'option' => '0.05 / 0.1 / 0.2 mm', 'price' => 28, 'qty' => 1],
        ['sku' => 'CUP-58', 'name' => 'Dosing cup, 58 mm', 'option' => 'stainless', 'price' => 36, 'qty' => 2],
    ];

    $methods = [
        ['value' => 'card', 'label' => 'Card, charged once', 'detail' => 'Visa, Mastercard, JCB. 3-D Secure runs in a sheet, not a new tab.', 'meta' => 'settles tonight', 'checked' => true],
        ['value' => 'instalment', 'label' => 'Six months at 0%', 'detail' => 'Through the issuing bank. Same card, the interest is on us.', 'meta' => '$192 a month'],
        ['value' => 'transfer', 'label' => 'ATM transfer', 'detail' => 'A virtual account number, good for 24 hours. The order holds until it clears.', 'meta' => 'no card needed'],
        ['value' => 'onsite', 'label' => 'Pay at the workshop', 'detail' => 'Card or cash on the counter when you collect it.', 'meta' => 'pickup orders only'],
    ];

    $invoices = [
        ['value' => 'mobile', 'label' => 'Carrier barcode', 'detail' => 'Goes to the phone, nothing printed.'],
        ['value' => 'company', 'label' => 'Company tax ID', 'detail' => 'Triplicate invoice for a company.'],
        ['value' => 'donate', 'label' => 'Donate it', 'detail' => 'Donation code, sent straight on.'],
        ['value' => 'paper', 'label' => 'Paper invoice', 'detail' => 'Printed and posted separately.'],
    ];
@endphp

<x-templates.checkout.shell active="Payment">
    <div data-checkout-payment class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
        <div class="flex flex-col gap-6">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-cream">The last screen before the money moves</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    Card details go straight to the processor — this page never sees the number. What we keep is the last four digits and the authorisation code.
                </p>
            </div>

            <section data-pay="card" class="group/pay overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                    <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">How you pay</h2>
                    <span class="font-mono text-[10px] text-zinc-600">TWD 36,173 will appear on the statement</span>
                </div>

                <div class="grid gap-3 p-5 sm:grid-cols-2">
                    @foreach ($methods as $method)
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-white/10 bg-ink-950 p-4 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
                            <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                                <input type="radio" name="pay" value="{{ $method['value'] }}" data-pay-set="{{ $method['value'] }}" @checked($method['checked'] ?? false)
                                    class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
                            </span>

                            <span class="flex min-w-0 flex-1 flex-col gap-1">
                                <span class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                                    <span class="text-[13px]/5 text-zinc-200">{{ $method['label'] }}</span>
                                    <span class="shrink-0 font-mono text-[10px] text-zinc-600">{{ $method['meta'] }}</span>
                                </span>
                                <span class="text-xs/5 text-zinc-500">{{ $method['detail'] }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-5 group-data-[pay=card]/pay:block group-data-[pay=instalment]/pay:block">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <x-templates.checkout.card-field value="4571 2000 1234 3092" hint="Test card. Nothing here reaches a real processor." />
                        </div>

                        <x-ui.input label="Expiry" value="09 / 28" autocomplete="cc-exp" class="font-mono" />
                        <x-ui.input label="Security code" value="•••" autocomplete="cc-csc" hint="Three digits on the back, four on the front for Amex." class="font-mono" />

                        <div class="sm:col-span-2">
                            <x-ui.input label="Name on the card" value="WEI HAN CHEN" autocomplete="cc-name" />
                        </div>
                    </div>

                    <div class="mt-4 hidden rounded-xl border border-jade-500/25 bg-jade-500/6 p-4 group-data-[pay=instalment]/pay:block">
                        <p class="text-[13px]/6 text-zinc-300">
                            Six payments of <span class="font-mono text-cream">$192</span>, first one tonight, the rest on the same date each month.
                            Your bank shows it as one transaction and splits it afterwards — cancelling the plan is between you and them.
                        </p>
                    </div>
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-5 group-data-[pay=transfer]/pay:block">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Virtual account, issued after you place the order</p>
                            <p class="mt-2 font-mono text-lg text-cream">808 · 2681 5573 0914</p>
                            <p class="mt-2 text-[13px]/6 text-zinc-500">
                                Good for 24 hours. We hold the grinder that long and not a minute more — it is the last one in graphite.
                            </p>
                        </div>
                        <span class="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[10px] text-zinc-500">E.SUN Bank 808</span>
                    </div>
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-5 group-data-[pay=onsite]/pay:block">
                    <p class="text-[13px]/6 text-zinc-400 group-data-[ship=pickup]/shell:hidden">
                        This one only works with workshop collection.
                        <a href="{{ route('templates.screen', ['checkout', 'delivery']) }}" target="_top" class="text-jade-400 transition-colors duration-150 hover:text-jade-300">Switch the delivery method →</a>
                    </p>
                    <p class="hidden text-[13px]/6 text-zinc-400 group-data-[ship=pickup]/shell:block">
                        Pay on the counter when you collect. Bring the order number; the invoice prints there.
                    </p>
                </div>
            </section>

            <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                <div class="group/bill">
                    <x-ui.checkbox checked label="Billing address is the delivery address"
                        description="Untick it if the card is registered somewhere else — the bank checks the postcode." />

                    <div class="mt-5 grid gap-4 sm:grid-cols-2 group-has-[:checked]/bill:hidden">
                        <x-ui.input label="Billing postcode" placeholder="106" inputmode="numeric" />
                        <x-ui.input label="City" placeholder="Taipei" />

                        <div class="sm:col-span-2">
                            <x-ui.input label="Billing street" placeholder="205 Dunhua S. Road, Section 1" />
                        </div>
                    </div>
                </div>
            </section>

            <section data-invoice="mobile" class="group/inv overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                    <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">E-invoice</h2>
                    <span class="font-mono text-[10px] text-zinc-600">issued the day it ships, not today</span>
                </div>

                <div class="grid gap-3 p-5 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($invoices as $invoice)
                        <label class="flex cursor-pointer items-start gap-2.5 rounded-xl border border-white/10 bg-ink-950 p-3.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5">
                            <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
                                <input type="radio" name="invoice" value="{{ $invoice['value'] }}" data-invoice-set="{{ $invoice['value'] }}" @checked($loop->first)
                                    class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                                <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
                            </span>

                            <span class="flex min-w-0 flex-col gap-0.5">
                                <span class="text-[13px]/5 text-zinc-200">{{ $invoice['label'] }}</span>
                                <span class="text-xs/5 text-zinc-500">{{ $invoice['detail'] }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-5 group-data-[invoice=mobile]/inv:block">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.input label="Carrier code" value="/ABC+123" class="font-mono" hint="Eight characters, starts with a slash." />
                        <div class="flex items-end">
                            <p class="pb-2.5 text-[13px]/6 text-zinc-500">The invoice lands in the carrier the night it ships. Nothing is printed and nothing is posted.</p>
                        </div>
                    </div>
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-5 group-data-[invoice=company]/inv:block">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.input label="Tax ID number" placeholder="24681357" inputmode="numeric" class="font-mono" />
                        <x-ui.input label="Company name" placeholder="Nomad Coffee Ltd" />
                    </div>
                    <p class="mt-3 font-mono text-[10px] text-zinc-600">A company invoice cannot be changed after it is issued — check the number twice.</p>
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-5 group-data-[invoice=donate]/inv:block">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-ui.input label="Donation code" value="25885" class="font-mono" hint="Default is the Genesis Foundation. Any registered code works." />
                        <div class="flex items-end">
                            <p class="pb-2.5 text-[13px]/6 text-zinc-500">Donated invoices are not returnable to you, so we keep a copy against the order in case of a refund.</p>
                        </div>
                    </div>
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-5 group-data-[invoice=paper]/inv:block">
                    <p class="text-[13px]/6 text-zinc-400">
                        Posted to the delivery address a few days behind the box, not inside it. Choose this only if an accountant insists.
                    </p>
                </div>
            </section>

            <div class="flex flex-wrap items-center gap-4">
                <x-ui.button variant="secondary" :href="route('templates.screen', ['checkout', 'delivery'])" target="_top">Back to delivery</x-ui.button>
                <x-ui.button :href="route('templates.screen', ['checkout', 'confirmation'])" target="_top">Place the order</x-ui.button>
                <span class="font-mono text-[10px] text-zinc-600">by placing it you accept the return terms below</span>
            </div>

            <p class="font-mono text-[10px]/5 text-zinc-600">
                We store the last four digits and the authorisation code for the warranty and for refunds. Card numbers never touch our servers — the field above talks to the processor directly.
            </p>
        </div>

        <div class="flex flex-col gap-4 lg:sticky lg:top-32">
            <x-templates.checkout.summary
                :discount="128"
                discount-label="BENCH10"
                cta="Place the order"
                :href="route('templates.screen', ['checkout', 'confirmation'])"
                note="Charged when the workshop marks it packed, usually the same evening.">
                @foreach ($lines as $line)
                    <x-templates.checkout.line-item
                        :sku="$line['sku']"
                        :name="$line['name']"
                        :option="$line['option']"
                        :price="$line['price']"
                        :qty="$line['qty']" />
                @endforeach
            </x-templates.checkout.summary>

            <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Delivering to</p>
                <p class="mt-2.5 text-[13px]/6 text-zinc-400">
                    Wei-Han Chen · +886 912 345 678<br>
                    2F, 227 Minsheng Road, West District, Taichung 403
                </p>
                <a href="{{ route('templates.screen', ['checkout', 'delivery']) }}" target="_top"
                    class="mt-3 inline-block font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Change it →</a>
            </div>

            <p class="px-1 font-mono text-[10px]/5 text-zinc-600">
                Refunds go back to the card that paid, five to ten working days depending on the bank. We cannot make that faster and nor can they.
            </p>
        </div>
    </div>

    @once
        <script>
            document.addEventListener('change', (event) => {
                const pay = event.target.closest('[data-pay-set]');

                if (pay) {
                    pay.closest('[data-pay]').dataset.pay = pay.dataset.paySet;

                    return;
                }

                const invoice = event.target.closest('[data-invoice-set]');

                if (invoice) {
                    invoice.closest('[data-invoice]').dataset.invoice = invoice.dataset.invoiceSet;
                }
            });
        </script>
    @endonce
</x-templates.checkout.shell>
