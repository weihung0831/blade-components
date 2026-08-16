@props(['size' => 'md'])

@php
    $base = 'flex items-stretch overflow-hidden rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500'
        .' [&>input]:min-w-0 [&>input]:flex-1 [&>input]:bg-transparent [&>input]:text-zinc-200 [&>input]:outline-none [&>input::placeholder]:text-zinc-600'
        .' [&>button]:shrink-0 [&>button]:border-l [&>button]:border-white/10 [&>button]:bg-ink-800 [&>button]:font-medium [&>button]:text-zinc-300 [&>button]:transition-colors [&>button]:duration-150 [&>button]:outline-none [&>button:hover]:text-cream [&>button:focus-visible]:text-cream';

    $sizes = [
        'sm' => '[&>input]:h-8 [&>input]:px-2.5 [&>input]:text-[13px] [&>button]:px-2.5 [&>button]:text-[13px]',
        'md' => '[&>input]:h-10 [&>input]:px-3 [&>input]:text-sm [&>button]:px-3.5 [&>button]:text-sm',
    ];

    $addon = 'grid shrink-0 place-items-center bg-ink-800 px-3 font-mono text-zinc-500 [&_svg]:size-4 '
        .($size === 'sm' ? 'text-xs' : 'text-[13px]');
@endphp

<div {{ $attributes->merge(['class' => $base.' '.($sizes[$size] ?? $sizes['md'])]) }}>
    @isset($prefix)
        <span class="{{ $addon }} border-r border-white/10">{{ $prefix }}</span>
    @endisset
    {{ $slot }}
    @isset($suffix)
        <span class="{{ $addon }} border-l border-white/10">{{ $suffix }}</span>
    @endisset
</div>
