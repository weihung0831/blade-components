@props([
    'type' => 'checkbox',
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'h-8 px-3.5 text-[13px]',
        'md' => 'h-10 px-4 text-sm',
    ];
@endphp

<label {{ $attributes->only('class')->merge(['class' => 'inline-flex has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40']) }}>
    <input type="{{ $type }}" {{ $attributes->except('class') }} class="peer sr-only">
    <span class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-white/10 font-medium text-zinc-400 transition-[transform,background-color,border-color,color] duration-150 ease-snap select-none peer-checked:border-jade-500/40 peer-checked:bg-jade-500/15 peer-checked:text-jade-300 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70 hover:border-white/25 active:scale-[0.97] {{ $sizes[$size] ?? $sizes['md'] }}">{{ $slot }}</span>
</label>
