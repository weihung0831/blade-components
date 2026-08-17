@props([
    'name',
    'size' => 'sm',
    'kind' => 'agent',
    'meta' => null,
])

@php
    $initials = Illuminate\Support\Str::of($name)
        ->explode(' ')
        ->take(2)
        ->map(fn (string $part): string => Illuminate\Support\Str::upper(Illuminate\Support\Str::substr($part, 0, 1)))
        ->implode('');

    $crew = [
        'border-jade-500/50 bg-jade-500/15 text-jade-300',
        'border-white/20 bg-white/10 text-cream',
        'border-white/12 bg-ink-800 text-zinc-300',
    ];

    $sizes = [
        'xs' => 'size-5 text-[9px]',
        'sm' => 'size-6 text-[10px]',
        'md' => 'size-8 text-[11px]',
        'lg' => 'size-10 text-[13px]',
    ];

    $shape = $kind === 'customer' ? 'rounded-lg' : 'rounded-full';

    $tone = $kind === 'customer'
        ? 'border-dashed border-white/15 bg-ink-950 text-zinc-500'
        : $crew[crc32($name) % 3];
@endphp

<span {{ $attributes->class([
    'grid shrink-0 place-items-center border font-mono select-none',
    $shape,
    $tone,
    $sizes[$size] ?? $sizes['sm'],
]) }} title="{{ $name }}{{ $meta ? ' · '.$meta : '' }}">{{ $initials }}</span>
