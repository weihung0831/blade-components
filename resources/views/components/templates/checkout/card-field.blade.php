@props([
    'value' => '',
    'label' => 'Card number',
    'hint' => null,
])

<div data-card-field {{ $attributes->class('') }}>
    <label class="mb-1.5 block text-[13px] text-zinc-400">{{ $label }}</label>

    <div class="relative">
        <input data-card-number type="text" inputmode="numeric" autocomplete="cc-number" value="{{ $value }}"
            placeholder="4571 0000 0000 0000" maxlength="23" aria-label="{{ $label }}"
            class="block h-10 w-full rounded-lg border border-white/10 bg-ink-950 pr-20 pl-3 font-mono text-sm tracking-wider text-zinc-200 transition-colors duration-150 outline-none placeholder:tracking-wider placeholder:text-zinc-700 hover:border-white/20 focus:border-jade-500">

        <span data-card-brand class="absolute top-1/2 right-3 -translate-y-1/2 rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] tracking-wider text-zinc-500 uppercase">card</span>
    </div>

    @if ($hint)
        <p class="mt-1.5 text-xs text-zinc-500">{{ $hint }}</p>
    @endif
</div>

@once
    <script>
        (() => {
            const BRANDS = [
                { name: 'visa', test: /^4/ },
                { name: 'mastercard', test: /^5[1-5]/ },
                { name: 'jcb', test: /^35/ },
                { name: 'amex', test: /^3[47]/ },
                { name: 'unionpay', test: /^62/ },
            ];

            const paint = (field) => {
                const input = field.querySelector('[data-card-number]');
                const digits = input.value.replace(/\D/g, '').slice(0, 19);
                const brand = BRANDS.find((candidate) => candidate.test.test(digits));

                input.value = digits.replace(/(.{4})/g, '$1 ').trim();

                const badge = field.querySelector('[data-card-brand]');
                badge.textContent = brand ? brand.name : 'card';
                badge.classList.toggle('text-jade-400', Boolean(brand));
                badge.classList.toggle('border-jade-500/40', Boolean(brand));
                badge.classList.toggle('text-zinc-500', !brand);
            };

            document.addEventListener('input', (event) => {
                const input = event.target.closest('[data-card-number]');

                if (input) {
                    paint(input.closest('[data-card-field]'));
                }
            });

            const paintAll = () => document.querySelectorAll('[data-card-field]').forEach(paint);

            document.addEventListener('DOMContentLoaded', paintAll);

            paintAll();
        })();
    </script>
@endonce
