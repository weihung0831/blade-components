@php
    $lines = [
        ['sku' => 'EG83-GRA', 'name' => 'EG-83 grinder', 'option' => 'graphite', 'price' => 1180, 'qty' => 1],
        ['sku' => 'SHM-KIT', 'name' => 'Alignment shim kit', 'option' => '0.05 / 0.1 / 0.2 mm', 'price' => 28, 'qty' => 1],
        ['sku' => 'CUP-58', 'name' => 'Dosing cup, 58 mm', 'option' => 'stainless', 'price' => 36, 'qty' => 2],
    ];

    $options = [
        [
            'value' => 'standard',
            'label' => 'Home delivery, T-Cat',
            'detail' => 'Signature on the door. One redelivery attempt, then it waits at the depot for five days.',
            'price' => 0,
            'eta' => 'arrives Thu 20 – Mon 24 Aug',
            'checked' => true,
        ],
        [
            'value' => 'express',
            'label' => 'Next day, before noon',
            'detail' => 'Booked on tonight\'s run if the order is in before 15:00. Taiwan main island only.',
            'price' => 18,
            'eta' => 'arrives tomorrow, Tue 18 Aug',
        ],
        [
            'value' => 'pickup',
            'label' => 'Collect at the workshop',
            'detail' => 'We dial it in with you on your beans before you carry it out. Takes about twenty minutes.',
            'price' => 0,
            'eta' => 'ready today from 17:00, Taichung West District',
        ],
        [
            'value' => 'intl',
            'label' => 'International, DHL',
            'detail' => 'Voltage is set to your region before it ships. Plug type is chosen from the address.',
            'price' => 68,
            'eta' => 'DHL · 7–12 business days',
            'note' => 'duties and local VAT are collected on arrival, not here',
        ],
    ];

    $cities = ['Taichung', 'Taipei', 'New Taipei', 'Taoyuan', 'Tainan', 'Kaohsiung'];
    $districts = ['West District', 'North District', 'Central District', 'Nantun', 'Xitun'];
@endphp

<x-templates.checkout.shell active="Delivery">
    <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
        <div class="flex flex-col gap-6">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-cream">Where it goes, and how fast</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    Pick the method first — it changes the price, the date, and whether we need a phone number that answers.
                </p>
            </div>

            <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                    <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">How it travels</h2>
                    <span class="font-mono text-[10px] text-zinc-600">packed 34 × 24 × 41 cm · 8.6 kg</span>
                </div>

                <div class="grid gap-3 p-5 sm:grid-cols-2">
                    @foreach ($options as $option)
                        <x-templates.checkout.ship-option
                            :value="$option['value']"
                            :label="$option['label']"
                            :detail="$option['detail']"
                            :price="$option['price']"
                            :eta="$option['eta']"
                            :note="$option['note'] ?? null"
                            :checked="$option['checked'] ?? false" />
                    @endforeach
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-4 group-data-[ship=pickup]/shell:block">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-[13px] text-cream">NOMAD workshop · 2F, 227 Minsheng Road, West District, Taichung</p>
                            <p class="mt-1.5 text-[13px]/6 text-zinc-500">
                                Ring the bell marked 2F. Weekdays 11:00–19:00, Saturday 12:00–17:00, closed Sunday.
                                Bring 200 g of the beans you actually drink.
                            </p>
                        </div>
                        <span class="rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[10px] text-zinc-500">MRT City Hall · 12 min walk</span>
                    </div>
                </div>

                <div class="hidden border-t border-white/5 bg-ink-950 px-5 py-4 group-data-[ship=intl]/shell:block">
                    <p class="text-[13px]/6 text-zinc-400">
                        We declare the full value — no undervalued invoices, no exceptions. Expect your country's import VAT plus a DHL handling fee before it is released.
                        Returns from outside Taiwan are on you for the freight.
                    </p>
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                    <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Who signs for it</h2>
                    <span class="font-mono text-[10px] text-zinc-600">the courier calls before the van turns in</span>
                </div>

                <form class="grid gap-4 p-5 sm:grid-cols-2" onsubmit="return false">
                    <x-ui.input label="Recipient" value="Wei-Han Chen" autocomplete="name" />
                    <x-ui.input label="Phone" type="tel" value="+886 912 345 678" autocomplete="tel"
                        hint="A mobile that answers. The driver calls, not texts." />

                    <div class="sm:col-span-2">
                        <x-ui.input label="Email for the receipt" type="email" value="wei@nomadsupply.tw" autocomplete="email" />
                    </div>

                    <div>
                        <p class="mb-1.5 text-[13px] text-zinc-400">City</p>
                        <x-ui.select :options="$cities" name="city" value="Taichung" />
                    </div>

                    <div>
                        <p class="mb-1.5 text-[13px] text-zinc-400">District</p>
                        <x-ui.select :options="$districts" name="district" value="West District" />
                    </div>

                    <x-ui.input label="Postcode" value="403" inputmode="numeric" />
                    <x-ui.input label="Street and number" value="227 Minsheng Road" />

                    <div class="sm:col-span-2">
                        <x-ui.input label="Floor, unit, or landmark" placeholder="5F-2, the door beside the laundry"
                            hint="Optional, but it is the line that saves a redelivery." />
                    </div>

                    <div class="sm:col-span-2">
                        <x-ui.textarea label="Note for the driver" rows="2" auto-resize
                            placeholder="Leave with the shop downstairs if nobody answers." />
                    </div>

                    <div class="flex flex-col gap-3 sm:col-span-2">
                        <x-ui.checkbox checked label="Save this address to the account" description="Used for the warranty record too, so the serial stays attached to a real address." />
                        <x-ui.checkbox label="Wrap it as a gift" description="Kraft paper, no prices on the packing slip, and a card written by whoever packs it." />
                    </div>
                </form>
            </section>

            <div class="flex flex-wrap items-center gap-4">
                <x-ui.button variant="secondary" :href="route('templates.screen', ['checkout', 'cart'])" target="_top">Back to cart</x-ui.button>
                <x-ui.button :href="route('templates.screen', ['checkout', 'payment'])" target="_top">Continue to payment</x-ui.button>
                <span class="font-mono text-[10px] text-zinc-600">nothing is charged until the last screen</span>
            </div>
        </div>

        <div class="flex flex-col gap-4 lg:sticky lg:top-32">
            <x-templates.checkout.summary
                :discount="128"
                discount-label="BENCH10"
                note="Shipping updates the moment you pick a method.">
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
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">If nobody is home</p>
                <p class="mt-2.5 text-[13px]/6 text-zinc-400">
                    T-Cat tries once more the next working day, then holds it at the depot for five days. After that it comes back to us and we refund the freight, not the order.
                </p>
            </div>

            <p class="px-1 font-mono text-[10px]/5 text-zinc-600">
                Address changes are possible until the label prints, usually around 16:00 the day it ships.
            </p>
        </div>
    </div>
</x-templates.checkout.shell>
