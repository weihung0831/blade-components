@props([
    'label' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => 50,
    'disabled' => false,
])

@php
    $percent = $max > $min ? (($value - $min) / ($max - $min)) * 100 : 0;
@endphp

<div {{ $attributes->merge(['class' => 'w-56']) }} data-ui-slider style="--ui-slider-fill: {{ $percent }}%">
    @if ($label)
        <div class="mb-2 flex items-center justify-between text-xs">
            <span class="text-zinc-500">{{ $label }}</span>
            <span data-ui-slider-value class="font-mono text-jade-400">{{ $value }}</span>
        </div>
    @endif
    <div @class(['relative flex h-3.5 items-center', 'opacity-40' => $disabled])>
        <div class="h-1.5 w-full rounded-full bg-ink-800"></div>
        <div class="absolute h-1.5 rounded-full bg-jade-500" style="width: var(--ui-slider-fill)"></div>
        <input type="range" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" value="{{ $value }}" @disabled($disabled)
            @if ($label) aria-label="{{ $label }}" @endif
            class="absolute inset-0 w-full cursor-pointer appearance-none bg-transparent outline-none disabled:pointer-events-none [&::-moz-range-thumb]:size-3.5 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-jade-500 [&::-moz-range-thumb]:bg-cream [&::-webkit-slider-thumb]:size-3.5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-jade-500 [&::-webkit-slider-thumb]:bg-cream [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-150 [&::-webkit-slider-thumb]:ease-snap [&:active::-webkit-slider-thumb]:scale-110 [&:focus-visible::-webkit-slider-thumb]:ring-2 [&:focus-visible::-webkit-slider-thumb]:ring-jade-500/70">
    </div>
</div>

@once
    <script>
        document.addEventListener('input', (event) => {
            const root = event.target.closest('[data-ui-slider]');

            if (!root || event.target.type !== 'range') {
                return;
            }

            const input = event.target;
            const percent = ((input.value - input.min) / (input.max - input.min)) * 100;

            root.style.setProperty('--ui-slider-fill', percent + '%');

            const output = root.querySelector('[data-ui-slider-value]');

            if (output) {
                output.textContent = input.value;
            }
        });
    </script>
@endonce
