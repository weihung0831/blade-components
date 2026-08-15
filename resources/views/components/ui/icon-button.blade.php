@props([
    'variant' => 'secondary',
    'size' => 'md',
    'href' => null,
])

@php
    $base = 'grid shrink-0 place-items-center rounded-lg transition-[transform,background-color,border-color,color] duration-150 ease-snap outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-[0.94] disabled:pointer-events-none disabled:opacity-40';

    $variants = [
        'primary' => 'bg-jade-500 text-ink-950 hover:bg-jade-400',
        'secondary' => 'border border-white/10 text-zinc-400 hover:border-white/25 hover:text-cream',
        'danger' => 'border border-red-500/20 bg-red-500/10 text-red-400 hover:bg-red-500/20',
    ];

    $sizes = [
        'sm' => 'size-8 [&_svg]:size-3.5',
        'md' => 'size-10 [&_svg]:size-4.5',
        'lg' => 'size-11 [&_svg]:size-5',
    ];

    $classes = $base.' '.($variants[$variant] ?? $variants['secondary']).' '.($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'class' => $classes]) }}>{{ $slot }}</button>
@endif
