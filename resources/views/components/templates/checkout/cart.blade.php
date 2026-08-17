@php
    $lines = [
        [
            'sku' => 'EG83-GRA',
            'name' => 'EG-83 grinder',
            'option' => 'graphite · single-dose hopper',
            'price' => 1180,
            'qty' => 1,
            'max' => 3,
            'meta' => 'Dialled in on the bench before it is boxed. One left in graphite at this price.',
        ],
        [
            'sku' => 'SHM-KIT',
            'name' => 'Alignment shim kit',
            'option' => '0.05 / 0.1 / 0.2 mm',
            'price' => 28,
            'qty' => 1,
            'max' => 4,
            'meta' => 'Ships in the same box, no extra weight charge.',
        ],
        [
            'sku' => 'CUP-58',
            'name' => 'Dosing cup, 58 mm',
            'option' => 'stainless, magnetic base',
            'price' => 36,
            'qty' => 2,
            'max' => 6,
            'meta' => 'In stock, Taichung.',
        ],
    ];

    $suggestions = [
        ['sku' => 'SPB-83', 'name' => 'Spare burr set, 83 mm', 'price' => 210, 'detail' => 'Worth having on the shelf past 8 kg a week.'],
        ['sku' => 'TAB-12', 'name' => 'Cleaning tablets, 12 pack', 'price' => 18, 'detail' => 'Grain based. No rinse cycle after.'],
    ];
@endphp

<x-templates.checkout.shell active="Cart">
    <div data-checkout-cart class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
        <div class="flex flex-col gap-6">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-cream">Three things, one box</h1>
                <p class="mt-2 max-w-xl text-sm/6 text-zinc-500">
                    Everything here ships together from the workshop. Change the quantities now — after payment it takes an email, and we would rather you did it here.
                </p>
            </div>

            <section class="overflow-hidden rounded-2xl border border-white/8 bg-ink-900">
                <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1 border-b border-white/5 px-5 py-3.5">
                    <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">In the box</h2>
                    <span class="font-mono text-[10px] text-zinc-600">reserved for 30 minutes</span>
                </div>

                <div data-cart-lines class="flex flex-col divide-y divide-white/5 px-5">
                    @foreach ($lines as $line)
                        <x-templates.checkout.line-item
                            :sku="$line['sku']"
                            :name="$line['name']"
                            :option="$line['option']"
                            :price="$line['price']"
                            :qty="$line['qty']"
                            :max="$line['max']"
                            :meta="$line['meta']"
                            editable />
                    @endforeach

                    @foreach ($suggestions as $suggestion)
                        <x-templates.checkout.line-item
                            class="hidden"
                            :sku="$suggestion['sku']"
                            :name="$suggestion['name']"
                            :price="$suggestion['price']"
                            :qty="0"
                            :max="4"
                            meta="Added from the shelf below."
                            editable />
                    @endforeach
                </div>

                <div data-cart-empty class="hidden px-5 py-10 text-center">
                    <p class="text-[13px] text-zinc-400">Nothing left in the cart.</p>
                    <p class="mt-1 font-mono text-[10px] text-zinc-600">The grinder goes back on the shelf in 30 minutes.</p>
                </div>
            </section>

            <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                    <h2 class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Bought with it, usually</h2>
                    <span class="font-mono text-[10px] text-zinc-600">no extra shipping</span>
                </div>

                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    @foreach ($suggestions as $suggestion)
                        <div class="flex items-start gap-3 rounded-xl border border-white/8 bg-ink-950 p-4">
                            <div class="dot-grid grid size-11 shrink-0 place-items-center rounded-lg border border-white/8">
                                <svg class="size-4 text-zinc-700" viewBox="0 0 24 24" fill="none">
                                    <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.3"/>
                                    <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="text-[13px] text-zinc-200">{{ $suggestion['name'] }}</p>
                                <p class="mt-0.5 text-xs/5 text-zinc-500">{{ $suggestion['detail'] }}</p>
                                <div class="mt-2.5 flex items-center gap-3">
                                    <span class="font-mono text-[13px] text-cream">${{ number_format($suggestion['price']) }}</span>
                                    <button type="button" data-cart-add="{{ $suggestion['sku'] }}"
                                        class="ml-auto rounded-lg border border-white/10 px-2.5 py-1 font-mono text-[11px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">Add</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-3">
                    <div class="flex items-center gap-2.5">
                        <span class="rounded-md border border-jade-500/40 bg-jade-500/10 px-2 py-1 font-mono text-[11px] tracking-wider text-jade-300 uppercase">BENCH10</span>
                        <span class="text-[13px] text-zinc-400">−$128 off the subtotal</span>
                    </div>
                    <button type="button" class="font-mono text-[11px] text-zinc-600 transition-colors duration-150 hover:text-red-400">Remove code</button>
                </div>

                <x-ui.separator class="my-4" />

                <form class="flex flex-wrap items-center gap-2.5" onsubmit="return false">
                    <input type="text" placeholder="Another code" aria-label="Discount code"
                        class="h-9 w-44 rounded-lg border border-white/10 bg-ink-950 px-3 font-mono text-[13px] tracking-wider text-zinc-200 uppercase transition-colors duration-150 outline-none placeholder:tracking-normal placeholder:text-zinc-600 placeholder:normal-case focus:border-jade-500">
                    <x-ui.button variant="secondary" size="sm" type="submit">Apply</x-ui.button>
                    <span class="font-mono text-[10px] text-zinc-600">codes do not stack, the larger one wins</span>
                </form>
            </section>

            <p class="font-mono text-[10px]/5 text-zinc-600">
                30-day returns, shipping paid both ways. Burrs are covered for five years, the motor for two — the warranty follows the serial, not the receipt.
            </p>
        </div>

        <div class="flex flex-col gap-4 lg:sticky lg:top-32">
            <x-templates.checkout.summary
                :discount="128"
                discount-label="BENCH10"
                cta="Continue to delivery"
                :href="route('templates.screen', ['checkout', 'delivery'])"
                note="No card charged yet. Shipping is chosen on the next screen." />

            <div class="rounded-2xl border border-white/8 bg-ink-900 p-5">
                <p class="font-mono text-[10px] tracking-wider text-jade-400 uppercase">Paying in instalments</p>
                <p class="mt-2.5 text-[13px]/6 text-zinc-400">
                    Six months at 0% through the card issuer, decided at the payment step. Nothing here changes if you take it.
                </p>
            </div>

            <p class="px-1 font-mono text-[10px]/5 text-zinc-600">
                Buying three or more grinders? Ask for a quote instead — net-30 terms and a spare burr set thrown in.
            </p>
        </div>
    </div>

    <script>
        (() => {
            const root = document.querySelector('[data-checkout-cart]');

            if (!root) {
                return;
            }

            const settle = () => {
                const lines = [...root.querySelectorAll('[data-line-item]')];
                const empty = lines.every((line) => Number(line.dataset.qty) === 0);

                root.querySelector('[data-cart-lines]').classList.toggle('hidden', empty);
                root.querySelector('[data-cart-empty]').classList.toggle('hidden', !empty);

                lines.forEach((line) => {
                    const card = root.querySelector('[data-cart-add="' + line.dataset.lineItem + '"]');

                    if (card) {
                        const held = Number(line.dataset.qty) > 0;

                        card.textContent = held ? 'In cart' : 'Add';
                        card.disabled = held;
                        card.classList.toggle('opacity-40', held);
                    }
                });
            };

            root.addEventListener('click', (event) => {
                const add = event.target.closest('[data-cart-add]');

                if (add) {
                    root.querySelector('[data-line-item="' + add.dataset.cartAdd + '"] [data-qty-step="1"]').click();
                }
            });

            document.addEventListener('checkout:cart-changed', settle);
            document.addEventListener('DOMContentLoaded', settle);

            settle();
        })();
    </script>
</x-templates.checkout.shell>
