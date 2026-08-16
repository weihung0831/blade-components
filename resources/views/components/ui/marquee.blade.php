@props([
    'speed' => 20,
    'reverse' => false,
    'vertical' => false,
    'gap' => 'gap-3',
    'pauseOnHover' => true,
    'fade' => true,
])

@php
    $track = $vertical
        ? 'flex-col h-max animate-[ui-marquee-y_var(--ui-marquee-speed)_linear_infinite]'
        : 'w-max animate-[ui-marquee-x_var(--ui-marquee-speed)_linear_infinite]';

    $mask = $vertical
        ? '[mask-image:linear-gradient(to_bottom,transparent,black_12%,black_88%,transparent)]'
        : '[mask-image:linear-gradient(to_right,transparent,black_12%,black_88%,transparent)]';

    $group = 'flex shrink-0 '.($vertical ? 'flex-col ' : '').$gap.' '.($vertical ? 'pb-3' : 'pr-3');
@endphp

<div {{ $attributes->class(['group relative overflow-hidden', $mask => $fade, 'flex' => $vertical]) }}
    style="--ui-marquee-speed: {{ max(1, (int) $speed) }}s">
    <div @class([
        'flex',
        $track,
        '[animation-direction:reverse]' => $reverse,
        'group-hover:[animation-play-state:paused]' => $pauseOnHover,
    ])>
        <div class="{{ $group }}">{{ $slot }}</div>
        <div class="{{ $group }}" aria-hidden="true">{{ $slot }}</div>
    </div>
</div>

@once
    <style>
        @keyframes ui-marquee-x {
            to {
                transform: translateX(-50%);
            }
        }

        @keyframes ui-marquee-y {
            to {
                transform: translateY(-50%);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [class*='ui-marquee-'] {
                animation: none;
            }
        }
    </style>
@endonce
