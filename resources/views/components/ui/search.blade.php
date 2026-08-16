@props([
    'placeholder' => 'Search…',
    'shortcut' => null,
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'h-8 px-2.5',
        'md' => 'h-10 px-3',
    ];

    $classes = 'flex w-full items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500 '
        .($sizes[$size] ?? $sizes['md']);
@endphp

<label {{ $attributes->only('class')->merge(['class' => $classes]) }}>
    <svg class="size-4 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.3"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
    <input {{ $attributes->except('class')->merge(['type' => 'search', 'placeholder' => $placeholder]) }}
        class="h-full min-w-0 flex-1 bg-transparent {{ $size === 'sm' ? 'text-[13px]' : 'text-sm' }} text-zinc-200 outline-none placeholder:text-zinc-600 [&::-webkit-search-cancel-button]:hidden">
    @if ($shortcut)
        <span class="flex shrink-0 gap-1">
            @foreach (explode(' ', $shortcut) as $key)
                <span class="grid h-5 min-w-5 place-items-center rounded border border-white/10 border-b-white/20 bg-ink-800 px-1 font-mono text-[10px] text-zinc-400">{{ $key }}</span>
            @endforeach
        </span>
    @endif
</label>
