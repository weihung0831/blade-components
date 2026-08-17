@props([
    'title' => 'Order summary',
    'discount' => 0,
    'discountLabel' => null,
    'cta' => null,
    'href' => null,
    'note' => null,
    'locked' => false,
])

<aside data-summary data-discount="{{ $discount }}" {{ $attributes->class('overflow-hidden rounded-2xl border border-white/8 bg-ink-900') }}>
    <div class="flex items-baseline justify-between gap-4 border-b border-white/5 px-5 py-4">
        <h2 class="text-base font-medium text-cream">{{ $title }}</h2>
        <span data-summary-count class="font-mono text-[10px] text-zinc-600">3 items</span>
    </div>

    @if (trim($slot) !== '')
        <div class="flex flex-col divide-y divide-white/5 px-5">{{ $slot }}</div>
    @endif

    <dl class="flex flex-col gap-2.5 border-t border-white/5 px-5 py-4">
        <div class="flex items-baseline justify-between gap-4">
            <dt class="text-[13px] text-zinc-500">Subtotal</dt>
            <dd data-summary-subtotal class="font-mono text-[13px] text-zinc-300">$1,280</dd>
        </div>

        @if ($discount > 0)
            <div class="flex items-baseline justify-between gap-4">
                <dt class="text-[13px] text-zinc-500">
                    Discount
                    @if ($discountLabel)
                        <span class="ml-1 font-mono text-[10px] text-jade-400">{{ $discountLabel }}</span>
                    @endif
                </dt>
                <dd class="font-mono text-[13px] text-jade-400">−${{ number_format($discount) }}</dd>
            </div>
        @endif

        <div class="flex items-baseline justify-between gap-4">
            <dt class="text-[13px] text-zinc-500">Shipping</dt>
            <dd data-summary-shipping class="font-mono text-[13px] text-jade-400">free</dd>
        </div>

        <p data-summary-eta class="font-mono text-[10px] text-zinc-600">arrives Thu 20 – Mon 24 Aug</p>
    </dl>

    <div class="border-t border-white/8 bg-ink-950 px-5 py-4">
        <div class="flex items-baseline justify-between gap-4">
            <span class="text-[13px] text-cream">{{ $locked ? 'Paid' : 'Total' }}</span>
            <span data-summary-total class="font-mono text-2xl text-cream">$1,280</span>
        </div>
        <p class="mt-1 text-right font-mono text-[10px] text-zinc-600">
            includes <span data-summary-tax>$61</span> VAT · TWD charged at 31.4
        </p>

        @if ($cta)
            <x-ui.button class="mt-4 w-full" :href="$href" target="_top">{{ $cta }}</x-ui.button>
        @endif

        @if ($note)
            <p class="mt-3 text-center font-mono text-[10px]/4 text-zinc-600">{{ $note }}</p>
        @endif
    </div>
</aside>

@once
    <script>
        (() => {
            const SHIPPING = {
                standard: { cost: 0, label: 'free', eta: 'arrives Thu 20 – Mon 24 Aug' },
                express: { cost: 18, label: '$18', eta: 'arrives tomorrow, Tue 18 Aug' },
                pickup: { cost: 0, label: 'free', eta: 'ready today from 17:00, Taichung' },
                intl: { cost: 68, label: '$68', eta: 'DHL · 7–12 business days, duties on arrival' },
            };

            const money = (value) => '$' + value.toLocaleString('en-US');

            const render = (summary) => {
                const scope = summary.closest('[data-ship]') ?? summary;
                const items = [...scope.querySelectorAll('[data-line-item]')];
                const ship = SHIPPING[scope.dataset.ship] ?? SHIPPING.standard;

                const subtotal = items.reduce((sum, item) => sum + Number(item.dataset.price) * Number(item.dataset.qty), 0);
                const units = items.reduce((sum, item) => sum + Number(item.dataset.qty), 0);
                const total = subtotal - Number(summary.dataset.discount || 0) + ship.cost;

                summary.querySelector('[data-summary-count]').textContent = units + (units === 1 ? ' item' : ' items');
                summary.querySelector('[data-summary-subtotal]').textContent = money(subtotal);
                summary.querySelector('[data-summary-total]').textContent = money(total);
                summary.querySelector('[data-summary-tax]').textContent = money(Math.round(total / 21));

                const shipping = summary.querySelector('[data-summary-shipping]');
                shipping.textContent = ship.label;
                shipping.classList.toggle('text-jade-400', ship.cost === 0);
                shipping.classList.toggle('text-zinc-300', ship.cost > 0);

                summary.querySelector('[data-summary-eta]').textContent = ship.eta;
            };

            const renderAll = () => document.querySelectorAll('[data-summary]').forEach(render);

            document.addEventListener('change', (event) => {
                if (event.target.closest('[data-ship-set]')) {
                    requestAnimationFrame(renderAll);
                }
            });

            document.addEventListener('checkout:cart-changed', renderAll);
            document.addEventListener('DOMContentLoaded', renderAll);

            renderAll();
        })();
    </script>
@endonce
