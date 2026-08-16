@props([
    'mask',
    'label' => null,
    'placeholder' => null,
    'value' => '',
])

<div {{ $attributes->merge(['class' => 'w-56']) }}>
    @if ($label)
        <label class="mb-1.5 block text-xs text-zinc-500">{{ $label }}</label>
    @endif
    <input type="text" data-ui-mask="{{ $mask }}" value="{{ $value }}" placeholder="{{ $placeholder ?? $mask }}"
        @if ($label) aria-label="{{ $label }}" @endif
        class="h-9 w-full rounded-lg border border-white/10 bg-ink-950 px-3 font-mono text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500">
</div>

@once
    <script>
        document.addEventListener('input', (event) => {
            const input = event.target.closest('[data-ui-mask]');

            if (!input) {
                return;
            }

            const pending = [...input.value].filter((char) => /[0-9a-z]/i.test(char));
            let output = '';

            for (const token of input.dataset.uiMask) {
                if (pending.length === 0) {
                    break;
                }

                if (token === '#' || token === 'a') {
                    const pattern = token === '#' ? /\d/ : /[a-z]/i;

                    while (pending.length > 0 && !pattern.test(pending[0])) {
                        pending.shift();
                    }

                    if (pending.length === 0) {
                        break;
                    }

                    output += pending.shift();
                } else {
                    output += token;
                }
            }

            input.value = output;
        });
    </script>
@endonce
