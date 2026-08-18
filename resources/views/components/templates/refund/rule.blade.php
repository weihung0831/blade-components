@props([
    'reason',
    'window',
    'condition',
    'freight' => 'you',
    'back' => 'all',
    'note' => null,
])

@php
    $freights = [
        'you' => ['label' => 'you pay $18', 'class' => 'text-zinc-500'],
        'us' => ['label' => 'we book the courier', 'class' => 'text-jade-400/90'],
        'none' => ['label' => 'nothing to send', 'class' => 'text-zinc-600'],
    ];

    $outcomes = [
        'all' => ['label' => 'every cent back', 'dot' => 'bg-jade-500', 'class' => 'text-jade-400/90'],
        'part' => ['label' => 'most of it back', 'dot' => 'bg-white/25', 'class' => 'text-zinc-500'],
        'none' => ['label' => 'nothing back', 'dot' => 'bg-amber-400/70', 'class' => 'text-amber-300/80'],
    ];

    $carrier = $freights[$freight] ?? $freights['you'];
    $outcome = $outcomes[$back] ?? $outcomes['all'];
@endphp

<div data-rule
    data-back="{{ $back }}"
    data-freight="{{ $freight }}"
    {{ $attributes->class('flex flex-col gap-2 px-3.5 py-3 sm:flex-row sm:gap-5') }}>

    <div class="w-full shrink-0 sm:w-52">
        <p class="text-[13px] text-cream">{{ $reason }}</p>
        <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $window }}</p>
    </div>

    <div class="min-w-0 flex-1">
        <p class="text-[12px]/5 text-zinc-400">{{ $condition }}</p>
        @if ($note)
            <p class="mt-1.5 text-[11px]/5 text-zinc-600">{{ $note }}</p>
        @endif
    </div>

    <div class="flex shrink-0 items-baseline gap-4 sm:w-44 sm:flex-col sm:items-end sm:gap-1.5">
        <p class="font-mono text-[11px] {{ $carrier['class'] }}">{{ $carrier['label'] }}</p>
        <p class="flex items-center gap-1.5 font-mono text-[10px] {{ $outcome['class'] }}">
            <span class="size-1.5 rounded-full {{ $outcome['dot'] }}"></span>
            {{ $outcome['label'] }}
        </p>
    </div>
</div>
