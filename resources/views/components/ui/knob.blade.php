@props([
    'label' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => 50,
    'size' => 'md',
    'readonly' => false,
])

@php
    $sizes = [
        'sm' => ['knob' => 'size-16', 'text' => 'text-xs'],
        'md' => ['knob' => 'size-20', 'text' => 'text-sm'],
        'lg' => ['knob' => 'size-24', 'text' => 'text-base'],
    ];

    $style = $sizes[$size] ?? $sizes['md'];
    $angle = $max > $min ? (($value - $min) / ($max - $min)) * 360 : 0;
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex flex-col items-center gap-2']) }}>
    <div data-ui-knob role="slider" aria-label="{{ $label ?? 'Value' }}" aria-valuemin="{{ $min }}" aria-valuemax="{{ $max }}" aria-valuenow="{{ $value }}"
        data-min="{{ $min }}" data-max="{{ $max }}" data-step="{{ $step }}" data-value="{{ $value }}"
        @unless ($readonly) tabindex="0" @else data-readonly @endunless
        @class(['grid touch-none place-items-center rounded-full outline-none select-none focus-visible:ring-2 focus-visible:ring-jade-500/70', $style['knob'], 'cursor-ns-resize' => ! $readonly])
        style="--ui-knob-angle: {{ $angle }}deg; background: conic-gradient(var(--color-jade-500) var(--ui-knob-angle), var(--color-ink-800) 0)">
        <div class="grid size-[calc(100%-14px)] place-items-center rounded-full bg-ink-950">
            <span data-ui-knob-value class="font-mono {{ $style['text'] }} text-cream">{{ $value }}</span>
        </div>
    </div>
    @if ($label)
        <span class="text-xs text-zinc-500">{{ $label }}</span>
    @endif
</div>

@once
    <script>
        const uiKnobSet = (knob, next) => {
            const min = Number(knob.dataset.min);
            const max = Number(knob.dataset.max);
            const step = Number(knob.dataset.step);
            const value = parseFloat(Math.min(max, Math.max(min, Math.round(next / step) * step)).toFixed(10));

            knob.dataset.value = value;
            knob.setAttribute('aria-valuenow', value);
            knob.style.setProperty('--ui-knob-angle', ((value - min) / (max - min)) * 360 + 'deg');
            knob.querySelector('[data-ui-knob-value]').textContent = value;
        };

        document.addEventListener('pointerdown', (event) => {
            const knob = event.target.closest('[data-ui-knob]');

            if (!knob || knob.hasAttribute('data-readonly')) {
                return;
            }

            event.preventDefault();
            knob.focus();

            const startY = event.clientY;
            const startValue = Number(knob.dataset.value);
            const range = Number(knob.dataset.max) - Number(knob.dataset.min);

            const move = (moveEvent) => uiKnobSet(knob, startValue + ((startY - moveEvent.clientY) / 150) * range);

            const stop = () => {
                document.removeEventListener('pointermove', move);
                document.removeEventListener('pointerup', stop);
            };

            document.addEventListener('pointermove', move);
            document.addEventListener('pointerup', stop);
        });

        document.addEventListener('keydown', (event) => {
            const knob = event.target.closest('[data-ui-knob]');

            if (!knob || knob.hasAttribute('data-readonly')) {
                return;
            }

            const step = Number(knob.dataset.step);
            const deltas = { ArrowUp: step, ArrowRight: step, ArrowDown: -step, ArrowLeft: -step };

            if (deltas[event.key] === undefined) {
                return;
            }

            event.preventDefault();
            uiKnobSet(knob, Number(knob.dataset.value) + deltas[event.key]);
        });

        document.addEventListener('wheel', (event) => {
            const knob = event.target.closest('[data-ui-knob]');

            if (!knob || knob.hasAttribute('data-readonly')) {
                return;
            }

            event.preventDefault();

            const step = Number(knob.dataset.step);

            uiKnobSet(knob, Number(knob.dataset.value) + (event.deltaY < 0 ? step : -step));
        }, { passive: false });
    </script>
@endonce
