@props([
    'label' => null,
    'name' => null,
    'value' => '#4ea396',
    'swatches' => [],
])

<div {{ $attributes->merge(['class' => 'w-56']) }} data-color-picker>
    @if ($label)
        <label class="mb-1.5 block text-xs text-zinc-500">{{ $label }}</label>
    @endif
    @if (count($swatches) > 0)
        <div class="mb-2 flex gap-1.5">
            @foreach ($swatches as $swatch)
                <button type="button" data-color-swatch="{{ $swatch }}" aria-label="Use {{ $swatch }}" style="background: {{ $swatch }}"
                    class="size-6 rounded-md border border-white/10 transition-transform duration-150 ease-snap outline-none hover:scale-110 focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-95"></button>
            @endforeach
        </div>
    @endif
    <label class="flex h-10 cursor-pointer items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-2 transition-colors duration-150 focus-within:border-jade-500">
        <input type="color" value="{{ $value }}" @if ($name) name="{{ $name }}" @endif
            class="size-6 shrink-0 cursor-pointer appearance-none rounded-md border-none bg-transparent p-0 outline-none [&::-moz-color-swatch]:rounded-md [&::-moz-color-swatch]:border-none [&::-webkit-color-swatch]:rounded-md [&::-webkit-color-swatch]:border-none [&::-webkit-color-swatch-wrapper]:p-0">
        <span class="font-mono text-xs tracking-wide text-zinc-300 uppercase" data-color-value>{{ $value }}</span>
    </label>
</div>

@once
    <script>
        document.addEventListener('input', (event) => {
            const root = event.target.closest('[data-color-picker]');

            if (!root || event.target.type !== 'color') {
                return;
            }

            root.querySelector('[data-color-value]').textContent = event.target.value;
        });

        document.addEventListener('click', (event) => {
            const swatch = event.target.closest('[data-color-swatch]');

            if (!swatch) {
                return;
            }

            const input = swatch.closest('[data-color-picker]').querySelector('input[type="color"]');

            input.value = swatch.dataset.colorSwatch;
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });
    </script>
@endonce
