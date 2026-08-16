@props([
    'before',
    'after',
    'beforeAlt' => '',
    'afterAlt' => '',
    'beforeLabel' => 'Before',
    'afterLabel' => 'After',
    'position' => 50,
    'orientation' => 'horizontal',
    'ratio' => 'aspect-video',
])

@php
    $horizontal = $orientation !== 'vertical';
    $value = max(0, min((int) $position, 100));

    $clip = $horizontal
        ? '[clip-path:inset(0_0_0_var(--ui-compare))]'
        : '[clip-path:inset(var(--ui-compare)_0_0_0)]';

    $line = $horizontal
        ? 'inset-y-0 left-[var(--ui-compare)] w-px -translate-x-1/2 cursor-col-resize'
        : 'inset-x-0 top-[var(--ui-compare)] h-px -translate-y-1/2 cursor-row-resize';

    $label = 'absolute rounded-md border border-white/10 bg-ink-950/70 px-2 py-1 font-mono text-[10px] tracking-wider uppercase backdrop-blur-sm';
@endphp

<div data-ui-image-compare data-orientation="{{ $horizontal ? 'horizontal' : 'vertical' }}" data-position="{{ $value }}"
    style="--ui-compare: {{ $value }}%"
    {{ $attributes->class('relative touch-none overflow-hidden rounded-xl border border-white/10 bg-ink-900 select-none '.$ratio) }}>
    <img src="{{ $before }}" alt="{{ $beforeAlt }}" class="pointer-events-none absolute inset-0 size-full object-cover">
    <img src="{{ $after }}" alt="{{ $afterAlt }}" class="pointer-events-none absolute inset-0 size-full object-cover {{ $clip }}">

    <span class="{{ $label }} top-3 left-3 text-zinc-400">{{ $beforeLabel }}</span>
    <span class="{{ $label }} right-3 bottom-3 text-jade-300">{{ $afterLabel }}</span>

    <div data-ui-compare-handle role="slider" tabindex="0" aria-label="Comparison position"
        aria-orientation="{{ $horizontal ? 'horizontal' : 'vertical' }}"
        aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $value }}"
        class="group absolute bg-cream/70 outline-none {{ $line }}">
        <span class="absolute top-1/2 left-1/2 grid size-8 -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full border border-white/20 bg-ink-950/80 text-cream shadow-lg shadow-black/40 backdrop-blur-sm transition-colors duration-150 group-hover:border-jade-500/70 group-focus-visible:ring-2 group-focus-visible:ring-jade-500/70 group-active:border-jade-400">
            <svg class="size-3.5 {{ $horizontal ? '' : 'rotate-90' }}" viewBox="0 0 16 16" fill="none">
                <path d="M6 4.5 2.5 8 6 11.5M10 4.5 13.5 8 10 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </div>
</div>

@once
    <script>
        (() => {
            const set = (root, percent) => {
                const value = Math.round(Math.min(100, Math.max(0, percent)));

                root.style.setProperty('--ui-compare', value + '%');
                root.dataset.position = value;
                root.querySelector('[data-ui-compare-handle]').setAttribute('aria-valuenow', value);
            };

            document.addEventListener('pointerdown', (event) => {
                const root = event.target.closest('[data-ui-image-compare]');

                if (!root) {
                    return;
                }

                const rect = root.getBoundingClientRect();
                const horizontal = root.dataset.orientation !== 'vertical';

                const drag = (pointer) => set(root, horizontal
                    ? ((pointer.clientX - rect.left) / rect.width) * 100
                    : ((pointer.clientY - rect.top) / rect.height) * 100);

                const stop = () => {
                    root.removeEventListener('pointermove', drag);
                    root.removeEventListener('pointerup', stop);
                };

                root.setPointerCapture(event.pointerId);
                root.addEventListener('pointermove', drag);
                root.addEventListener('pointerup', stop);
                root.querySelector('[data-ui-compare-handle]').focus();
                drag(event);
                event.preventDefault();
            });

            document.addEventListener('keydown', (event) => {
                const handle = event.target.closest('[data-ui-compare-handle]');
                const steps = { ArrowLeft: -2, ArrowUp: -2, ArrowRight: 2, ArrowDown: 2, Home: -100, End: 100 };

                if (!handle || !(event.key in steps)) {
                    return;
                }

                const root = handle.closest('[data-ui-image-compare]');

                set(root, Number(root.dataset.position) + steps[event.key]);
                event.preventDefault();
            });
        })();
    </script>
@endonce
