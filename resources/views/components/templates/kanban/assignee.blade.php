@props([
    'name',
    'size' => 'sm',
    'station' => null,
])

@php
    $initials = Illuminate\Support\Str::of($name)
        ->explode(' ')
        ->take(2)
        ->map(fn (string $part): string => Illuminate\Support\Str::upper(Illuminate\Support\Str::substr($part, 0, 1)))
        ->implode('');

    $tones = [
        'border-jade-500/50 bg-jade-500/15 text-jade-300',
        'border-white/20 bg-white/10 text-cream',
        'border-white/10 bg-ink-800 text-zinc-400',
    ];

    $sizes = [
        'xs' => 'size-5 text-[9px]',
        'sm' => 'size-6 text-[10px]',
        'md' => 'size-8 text-[11px]',
        'lg' => 'size-11 text-sm',
    ];
@endphp

<span {{ $attributes->class([
    'grid shrink-0 place-items-center rounded-full border font-mono select-none',
    $tones[crc32($name) % 3],
    $sizes[$size] ?? $sizes['sm'],
]) }} title="{{ $name }}{{ $station ? ' · '.$station : '' }}">{{ $initials }}</span>
