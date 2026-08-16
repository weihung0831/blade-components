@props([
    'field',
    'label',
    'hint' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => 50,
    'format' => 'number',
    'display' => null,
])

@php
    $percent = $max > $min ? (($value - $min) / ($max - $min)) * 100 : 0;
@endphp

<div {{ $attributes }} data-calc-field="{{ $field }}" data-calc-format="{{ $format }}" style="--ui-slider-fill: {{ $percent }}%">
    <div class="flex items-baseline justify-between gap-3">
        <label for="calc-{{ $field }}" class="text-[13px] text-zinc-300">{{ $label }}</label>
        <output data-calc-output class="font-mono text-sm text-jade-400">{{ $display ?? $value }}</output>
    </div>

    <div class="relative mt-3 flex h-3.5 items-center">
        <div class="h-1.5 w-full rounded-full bg-ink-800"></div>
        <div class="absolute h-1.5 rounded-full bg-jade-500" style="width: var(--ui-slider-fill)"></div>
        <input id="calc-{{ $field }}" type="range" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" value="{{ $value }}"
            class="absolute inset-0 w-full cursor-pointer appearance-none bg-transparent outline-none [&::-moz-range-thumb]:size-3.5 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-jade-500 [&::-moz-range-thumb]:bg-cream [&::-webkit-slider-thumb]:size-3.5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-jade-500 [&::-webkit-slider-thumb]:bg-cream [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-150 [&::-webkit-slider-thumb]:ease-snap [&:active::-webkit-slider-thumb]:scale-110 [&:focus-visible::-webkit-slider-thumb]:ring-2 [&:focus-visible::-webkit-slider-thumb]:ring-jade-500/70">
    </div>

    @if ($hint)
        <p class="mt-2 font-mono text-[10px] text-zinc-600">{{ $hint }}</p>
    @endif
</div>

@once
    <script>
        (() => {
            const trim = (value) => Number(value.toFixed(1)).toLocaleString('en-US');

            const formats = {
                number: (value) => value.toLocaleString('en-US'),
                calls: (value) => value >= 1000 ? trim(value / 1000) + 'M' : value + 'k',
                bytes: (value) => value >= 1024 ? trim(value / 1024) + ' TB' : value + ' GB',
            };

            document.addEventListener('input', (event) => {
                const dial = event.target.closest('[data-calc-field]');

                if (!dial || event.target.type !== 'range') {
                    return;
                }

                const input = event.target;
                const format = formats[dial.dataset.calcFormat] ?? formats.number;

                dial.style.setProperty('--ui-slider-fill', ((input.value - input.min) / (input.max - input.min)) * 100 + '%');
                dial.querySelector('[data-calc-output]').textContent = format(Number(input.value));
            });
        })();
    </script>
@endonce
