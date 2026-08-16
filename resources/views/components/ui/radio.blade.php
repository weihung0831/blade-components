@props([
    'label' => null,
    'description' => null,
    'variant' => 'default',
])

@php
    $wrappers = [
        'default' => 'inline-flex cursor-pointer items-start gap-2.5 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40',
        'card' => 'flex cursor-pointer items-start gap-3 rounded-xl border border-white/10 bg-ink-950 p-4 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/5 has-[:checked]:hover:border-jade-500/50 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40',
    ];
@endphp

<label {{ $attributes->only('class')->merge(['class' => $wrappers[$variant] ?? $wrappers['default']]) }}>
    <span class="relative mt-0.5 grid size-4 shrink-0 place-items-center">
        <input type="radio" {{ $attributes->except('class') }}
            class="peer absolute inset-0 cursor-pointer appearance-none rounded-full border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
        <span class="pointer-events-none relative size-2 scale-0 rounded-full bg-jade-500 transition-transform duration-200 ease-snap peer-checked:scale-100"></span>
    </span>
    @if ($label !== null || $description !== null)
        <span class="flex flex-col gap-0.5">
            @if ($label !== null)
                <span class="text-[13px]/5 text-zinc-300">{{ $label }}</span>
            @endif
            @if ($description !== null)
                <span class="text-xs/5 text-zinc-500">{{ $description }}</span>
            @endif
        </span>
    @endif
</label>
