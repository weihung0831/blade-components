@props([
    'label' => null,
    'size' => 'md',
])

@php
    $tracks = [
        'sm' => 'h-5 w-9 after:size-3 peer-checked:after:translate-x-4',
        'md' => 'h-6 w-11 after:size-4 peer-checked:after:translate-x-5',
    ];
@endphp

<label {{ $attributes->only('class')->merge(['class' => 'inline-flex cursor-pointer items-center gap-3 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40']) }}>
    @if ($label !== null)
        <span class="text-[13px] text-zinc-400">{{ $label }}</span>
    @endif
    <input type="checkbox" role="switch" {{ $attributes->except('class') }} class="peer sr-only">
    <span class="relative rounded-full border border-white/10 bg-ink-800 transition-colors duration-200 ease-snap peer-checked:border-jade-500 peer-checked:bg-jade-500 peer-focus-visible:ring-2 peer-focus-visible:ring-jade-500/70 after:absolute after:top-1 after:left-1 after:rounded-full after:bg-zinc-400 after:transition-[translate,background-color] after:duration-200 after:ease-snap peer-checked:after:bg-ink-950 {{ $tracks[$size] ?? $tracks['md'] }}"></span>
</label>
