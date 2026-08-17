@props([
    'sku',
    'name',
    'option' => null,
    'price',
    'qty' => 1,
    'meta' => null,
    'editable' => false,
    'max' => 6,
])

<div data-line-item="{{ $sku }}" data-price="{{ $price }}" data-qty="{{ $qty }}" data-max="{{ $max }}"
    {{ $attributes->class(['flex gap-4', 'py-5' => $editable, 'py-4' => ! $editable]) }}>
    <div @class([
        'dot-grid grid shrink-0 place-items-center rounded-xl border border-white/8 bg-ink-950',
        'size-16 sm:size-20' => $editable,
        'size-12' => ! $editable,
    ])>
        <svg @class(['text-zinc-700', 'size-6' => $editable, 'size-5' => ! $editable]) viewBox="0 0 24 24" fill="none">
            <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.3"/>
            <circle cx="8.5" cy="10" r="1.5" stroke="currentColor" stroke-width="1.3"/>
            <path d="m5 16 4.5-4.5 3 3L16 11l3 3.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <div class="flex min-w-0 flex-1 flex-col">
        <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
            <p @class(['text-cream', 'text-[15px]' => $editable, 'text-[13px]' => ! $editable])>{{ $name }}</p>
            <p @class(['shrink-0 font-mono text-cream', 'text-[15px]' => $editable, 'text-[13px]' => ! $editable]) data-line-total>${{ number_format($price * $qty) }}</p>
        </div>

        <p class="mt-1 font-mono text-[11px] text-zinc-600">
            {{ $sku }}@if ($option) · {{ $option }} @endif
        </p>

        @if ($meta)
            <p class="mt-1.5 text-[13px] text-zinc-500">{{ $meta }}</p>
        @endif

        @if ($editable)
            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2">
                <div class="inline-flex items-center rounded-lg border border-white/10 bg-ink-950">
                    <button type="button" data-qty-step="-1" aria-label="One fewer {{ $name }}"
                        class="grid size-8 place-items-center rounded-l-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 6h7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </button>
                    <span data-qty-value class="w-8 text-center font-mono text-[13px] text-zinc-200">{{ $qty }}</span>
                    <button type="button" data-qty-step="1" aria-label="One more {{ $name }}"
                        class="grid size-8 place-items-center rounded-r-lg text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                        <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M6 2.5v7M2.5 6h7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </button>
                </div>

                <span data-unit-price @class(['font-mono text-[11px] text-zinc-600', 'invisible' => $qty < 2])>${{ number_format($price) }} each</span>

                <button type="button" data-line-remove
                    class="ml-auto font-mono text-[11px] text-zinc-600 transition-colors duration-150 outline-none hover:text-red-400 focus-visible:ring-2 focus-visible:ring-jade-500/70">Remove</button>
            </div>
        @else
            <p class="mt-1.5 font-mono text-[11px] text-zinc-600">× {{ $qty }}@if ($qty > 1) · ${{ number_format($price) }} each @endif</p>
        @endif
    </div>
</div>

@once
    <script>
        (() => {
            const paint = (line) => {
                const qty = Number(line.dataset.qty);
                const price = Number(line.dataset.price);
                const counter = line.querySelector('[data-qty-value]');
                const unit = line.querySelector('[data-unit-price]');

                line.classList.toggle('hidden', qty === 0);
                line.classList.toggle('flex', qty > 0);
                line.querySelector('[data-line-total]').textContent = '$' + (price * qty).toLocaleString('en-US');

                if (counter) {
                    counter.textContent = qty;
                }

                if (unit) {
                    unit.classList.toggle('invisible', qty < 2);
                }
            };

            const setQty = (line, qty) => {
                line.dataset.qty = Math.max(0, Math.min(Number(line.dataset.max), qty));
                paint(line);
                document.dispatchEvent(new CustomEvent('checkout:cart-changed'));
            };

            document.addEventListener('click', (event) => {
                const step = event.target.closest('[data-qty-step]');

                if (step) {
                    const line = step.closest('[data-line-item]');
                    setQty(line, Number(line.dataset.qty) + Number(step.dataset.qtyStep));

                    return;
                }

                const remove = event.target.closest('[data-line-remove]');

                if (remove) {
                    setQty(remove.closest('[data-line-item]'), 0);
                }
            });

            const paintAll = () => document.querySelectorAll('[data-line-item]').forEach(paint);

            document.addEventListener('DOMContentLoaded', paintAll);

            paintAll();
        })();
    </script>
@endonce
