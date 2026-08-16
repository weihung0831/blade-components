@props(['variant' => 'outline'])

@php
    $variants = [
        'outline' => 'border border-white/10 bg-ink-800',
        'elevated' => 'border border-white/5 bg-ink-800 shadow-lg shadow-black/40',
        'interactive' => 'cursor-pointer border border-white/10 bg-ink-800 transition duration-200 ease-snap hover:-translate-y-0.5 hover:border-white/25',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl '.($variants[$variant] ?? $variants['outline'])]) }}>
    @isset($header)
        <div class="border-b border-white/5 px-4 py-3">{{ $header }}</div>
    @endisset
    <div class="p-4">{{ $slot }}</div>
    @isset($footer)
        <div class="border-t border-white/5 px-4 py-3">{{ $footer }}</div>
    @endisset
</div>
