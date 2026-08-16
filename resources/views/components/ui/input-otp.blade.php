@props([
    'length' => 6,
    'label' => null,
    'masked' => false,
])

<div {{ $attributes }}>
    @if ($label)
        <label class="mb-1.5 block text-xs text-zinc-500">{{ $label }}</label>
    @endif
    <div data-ui-otp class="flex items-center gap-2">
        @foreach (range(1, $length) as $cell)
            <input type="{{ $masked ? 'password' : 'text' }}" inputmode="numeric" autocomplete="one-time-code"
                aria-label="{{ ($label ?? 'Code').' digit '.$cell }}"
                class="size-10 rounded-lg border border-white/10 bg-ink-950 text-center font-mono text-sm text-cream transition-colors duration-150 outline-none focus:border-jade-500 focus:ring-2 focus:ring-jade-500/20">
        @endforeach
    </div>
</div>

@once
    <script>
        document.addEventListener('input', (event) => {
            const group = event.target.closest('[data-ui-otp]');

            if (!group) {
                return;
            }

            const inputs = [...group.querySelectorAll('input')];
            const index = inputs.indexOf(event.target);
            const digits = event.target.value.replace(/\D/g, '').split('');

            if (digits.length === 0) {
                event.target.value = '';
                return;
            }

            inputs.slice(index, index + digits.length).forEach((cell, offset) => {
                cell.value = digits[offset];
            });

            const next = inputs[Math.min(index + digits.length, inputs.length - 1)];

            next.focus();
            next.select();
        });

        document.addEventListener('keydown', (event) => {
            const group = event.target.closest('[data-ui-otp]');

            if (!group) {
                return;
            }

            const inputs = [...group.querySelectorAll('input')];
            const index = inputs.indexOf(event.target);

            if (event.key === 'Backspace' && event.target.value === '' && index > 0) {
                event.preventDefault();
                inputs[index - 1].value = '';
                inputs[index - 1].focus();
            }

            if (event.key === 'ArrowLeft' && index > 0) {
                event.preventDefault();
                inputs[index - 1].focus();
            }

            if (event.key === 'ArrowRight' && index < inputs.length - 1) {
                event.preventDefault();
                inputs[index + 1].focus();
            }
        });

        document.addEventListener('focusin', (event) => {
            if (event.target.closest('[data-ui-otp]')) {
                event.target.select();
            }
        });
    </script>
@endonce
