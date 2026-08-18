@props([
    'who',
    'body' => null,
    'instead' => null,
    'insteadPrice' => null,
    'tone' => 'hard',
    'href' => null,
])

@php
    $marks = [
        'hard' => ['dot' => 'bg-red-400', 'label' => 'buy something else'],
        'soft' => ['dot' => 'bg-amber-400', 'label' => 'probably not'],
        'fine' => ['dot' => 'bg-jade-500', 'label' => 'this one is fine'],
    ];

    $mark = $marks[$tone] ?? $marks['hard'];
@endphp

<div {{ $attributes->class('flex flex-col gap-3 px-4 py-3.5 sm:flex-row sm:items-start sm:gap-5') }}>
    <div class="min-w-0 flex-1">
        <p class="flex items-center gap-2">
            <span class="size-1.5 shrink-0 rounded-full {{ $mark['dot'] }}"></span>
            <span class="text-[13px]/5 text-cream">{{ $who }}</span>
        </p>

        @if ($body)
            <p class="mt-1.5 text-[12px]/5 text-zinc-500">{{ $body }}</p>
        @endif
    </div>

    <div class="shrink-0 sm:w-56">
        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ $mark['label'] }}</p>

        @if ($instead)
            @if ($href)
                <a href="{{ $href }}" target="_top" class="mt-1 block text-[12px] text-jade-300 transition-colors duration-150 hover:text-jade-400">{{ $instead }}</a>
            @else
                <p class="mt-1 text-[12px] text-zinc-400">{{ $instead }}</p>
            @endif
        @endif

        @if ($insteadPrice)
            <p class="mt-0.5 font-mono text-[10px] text-zinc-600">{{ $insteadPrice }}</p>
        @endif
    </div>
</div>
