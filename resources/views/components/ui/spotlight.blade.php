@props([
    'mode' => 'pointer',
    'size' => 260,
    'tone' => 'cream',
])

@php
    $tints = [
        'cream' => 'color-mix(in srgb, var(--color-white) 12%, transparent)',
        'jade' => 'color-mix(in srgb, var(--color-jade-500) 30%, transparent)',
    ];

    $tint = $tints[$tone] ?? $tints['cream'];
@endphp

<div @if ($mode === 'pointer') data-ui-spotlight @endif
    {{ $attributes->class(['group relative isolate overflow-hidden']) }}
    style="--ui-spotlight-size: {{ (int) $size }}px; --ui-spotlight-x: 50%; --ui-spotlight-y: 0%">
    @if ($mode === 'pointer')
        <span aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
            style="background: radial-gradient(var(--ui-spotlight-size) circle at var(--ui-spotlight-x) var(--ui-spotlight-y), {{ $tint }}, transparent 70%)"></span>
    @else
        <span aria-hidden="true" class="pointer-events-none absolute -top-1/2 left-0 -z-10 aspect-square blur-2xl animate-[ui-spotlight-sweep_5s_ease-in-out_infinite_alternate]"
            style="width: var(--ui-spotlight-size); background: radial-gradient(circle, {{ $tint }}, transparent 65%)"></span>
    @endif

    {{ $slot }}
</div>

@once
    <style>
        @keyframes ui-spotlight-sweep {
            from {
                transform: translateX(-40%);
            }

            to {
                transform: translateX(160%);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-spotlight-'] {
                animation: none;
            }
        }
    </style>

    <script>
        document.addEventListener('pointermove', (event) => {
            const root = event.target.closest('[data-ui-spotlight]');

            if (!root) {
                return;
            }

            const bounds = root.getBoundingClientRect();

            root.style.setProperty('--ui-spotlight-x', `${event.clientX - bounds.left}px`);
            root.style.setProperty('--ui-spotlight-y', `${event.clientY - bounds.top}px`);
        });
    </script>
@endonce
