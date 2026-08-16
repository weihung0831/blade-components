@props(['orientation' => 'vertical'])

@php
    $orientations = [
        'vertical' => 'overflow-y-auto',
        'horizontal' => 'overflow-x-auto',
        'both' => 'overflow-auto',
    ];

    $scrollbar = '[scrollbar-width:thin] [scrollbar-color:color-mix(in_oklab,var(--color-jade-500)_45%,transparent)_transparent] [&::-webkit-scrollbar]:size-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-jade-500/40 [&::-webkit-scrollbar-thumb:hover]:bg-jade-500/60';
@endphp

<div {{ $attributes->merge(['class' => ($orientations[$orientation] ?? $orientations['vertical']).' '.$scrollbar]) }}>
    {{ $slot }}
</div>
