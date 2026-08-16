@props([
    'trigger' => 'hover',
    'axis' => 'y',
])

@php
    $axes = [
        'y' => [
            'face' => '[transform:rotateY(180deg)]',
            'hover' => 'group-hover:[transform:rotateY(180deg)]',
            'flipped' => 'group-data-flipped:[transform:rotateY(180deg)]',
        ],
        'x' => [
            'face' => '[transform:rotateX(180deg)]',
            'hover' => 'group-hover:[transform:rotateX(180deg)]',
            'flipped' => 'group-data-flipped:[transform:rotateX(180deg)]',
        ],
    ];

    $turn = $axes[$axis] ?? $axes['y'];
    $interactive = $trigger === 'click';
    $tag = $interactive ? 'button' : 'div';
    $face = 'absolute inset-0 overflow-hidden backface-hidden';
@endphp

<{{ $tag }} @if ($interactive) type="button" data-ui-flip-card aria-pressed="false" @endif
    {{ $attributes->class(['group relative block [perspective:1000px]', 'cursor-pointer text-left outline-none' => $interactive]) }}>
    <div @class([
        'relative size-full transform-3d transition-transform duration-700 ease-snap',
        $turn['hover'] => ! $interactive,
        $turn['flipped'] => $interactive,
    ])>
        <div class="{{ $face }}">{{ $front }}</div>
        <div class="{{ $face }} {{ $turn['face'] }}">{{ $back }}</div>
    </div>
</{{ $tag }}>

@once
    <script>
        document.addEventListener('click', (event) => {
            const card = event.target.closest('[data-ui-flip-card]');

            if (!card) {
                return;
            }

            card.setAttribute('aria-pressed', card.toggleAttribute('data-flipped') ? 'true' : 'false');
        });
    </script>
@endonce
