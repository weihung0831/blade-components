@props(['orientation' => 'horizontal', 'size' => 50, 'min' => 20])

@php
    $horizontal = $orientation !== 'vertical';
@endphp

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-white/10 bg-ink-800 '.($horizontal ? 'flex' : 'flex flex-col')]) }}
    data-ui-splitter data-orientation="{{ $horizontal ? 'horizontal' : 'vertical' }}" data-min="{{ $min }}">
    <div class="min-h-0 min-w-0 shrink-0 grow-0 overflow-auto" style="flex-basis: {{ $size }}%">{{ $first }}</div>
    <div data-ui-splitter-gutter class="group grid shrink-0 touch-none place-items-center bg-ink-950 {{ $horizontal ? 'w-2 cursor-col-resize border-x border-white/10' : 'h-2 cursor-row-resize border-y border-white/10' }}">
        <span class="rounded-full bg-white/20 transition-colors duration-150 group-hover:bg-jade-500/70 group-active:bg-jade-400 {{ $horizontal ? 'h-6 w-0.5' : 'h-0.5 w-6' }}"></span>
    </div>
    <div class="min-h-0 min-w-0 flex-1 overflow-auto">{{ $second }}</div>
</div>

@once
    <script>
        document.addEventListener('pointerdown', (event) => {
            const gutter = event.target.closest('[data-ui-splitter-gutter]');

            if (!gutter) {
                return;
            }

            const root = gutter.closest('[data-ui-splitter]');
            const panel = gutter.previousElementSibling;
            const horizontal = root.dataset.orientation !== 'vertical';
            const min = Number(root.dataset.min || 20);
            const rect = root.getBoundingClientRect();

            gutter.setPointerCapture(event.pointerId);

            const resize = (move) => {
                const position = horizontal
                    ? ((move.clientX - rect.left) / rect.width) * 100
                    : ((move.clientY - rect.top) / rect.height) * 100;

                panel.style.flexBasis = Math.min(100 - min, Math.max(min, position)) + '%';
            };

            const stop = () => {
                gutter.removeEventListener('pointermove', resize);
                gutter.removeEventListener('pointerup', stop);
            };

            gutter.addEventListener('pointermove', resize);
            gutter.addEventListener('pointerup', stop);
            event.preventDefault();
        });
    </script>
@endonce
