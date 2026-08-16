@props([
    'label' => null,
    'min' => null,
    'max' => null,
    'step' => 1,
    'value' => 0,
])

<div {{ $attributes->merge(['class' => 'w-40']) }}>
    @if ($label)
        <label class="mb-1.5 block text-xs text-zinc-500">{{ $label }}</label>
    @endif
    <div data-ui-number class="flex h-9 items-stretch overflow-hidden rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500">
        <button type="button" data-ui-number-step="-1" aria-label="Decrease" @disabled($min !== null && $value <= $min)
            class="grid w-9 shrink-0 place-items-center text-zinc-400 outline-none transition-colors duration-150 hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70 disabled:pointer-events-none disabled:opacity-30">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
        <input type="number" inputmode="decimal" value="{{ $value }}" step="{{ $step }}"
            @if ($min !== null) min="{{ $min }}" @endif
            @if ($max !== null) max="{{ $max }}" @endif
            @if ($label) aria-label="{{ $label }}" @endif
            class="min-w-0 flex-1 border-x border-white/10 bg-transparent text-center font-mono text-sm text-zinc-300 outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
        <button type="button" data-ui-number-step="1" aria-label="Increase" @disabled($max !== null && $value >= $max)
            class="grid w-9 shrink-0 place-items-center text-zinc-400 outline-none transition-colors duration-150 hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70 disabled:pointer-events-none disabled:opacity-30">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
    </div>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-ui-number-step]');

            if (!button) {
                return;
            }

            const input = button.closest('[data-ui-number]').querySelector('input');
            const step = Number(input.step) || 1;
            const min = input.min === '' ? -Infinity : Number(input.min);
            const max = input.max === '' ? Infinity : Number(input.max);
            const next = Math.min(max, Math.max(min, (Number(input.value) || 0) + step * Number(button.dataset.uiNumberStep)));

            input.value = parseFloat(next.toFixed(10));
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });

        document.addEventListener('input', (event) => {
            const group = event.target.closest('[data-ui-number]');

            if (!group || !event.target.matches('input')) {
                return;
            }

            const value = Number(event.target.value) || 0;
            const min = event.target.min === '' ? -Infinity : Number(event.target.min);
            const max = event.target.max === '' ? Infinity : Number(event.target.max);

            group.querySelectorAll('[data-ui-number-step]').forEach((control) => {
                control.disabled = Number(control.dataset.uiNumberStep) < 0 ? value <= min : value >= max;
            });
        });
    </script>
@endonce
