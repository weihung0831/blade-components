@props([
    'label',
    'description' => null,
    'align' => 'start',
])

<div {{ $attributes->class([
    'flex flex-col gap-2.5 py-4 sm:flex-row sm:gap-6',
    'sm:items-start' => $align === 'start',
    'sm:items-center' => $align === 'center',
]) }}>
    <div class="sm:w-48 sm:shrink-0">
        <p class="text-[13px] text-zinc-300">{{ $label }}</p>
        @if ($description)
            <p class="mt-1 text-[11px]/5 text-zinc-600">{{ $description }}</p>
        @endif
    </div>

    <div class="min-w-0 flex-1">{{ $slot }}</div>
</div>
