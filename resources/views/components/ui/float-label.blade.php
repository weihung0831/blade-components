@props([
    'label',
    'state' => 'default',
])

@php
    $states = [
        'default' => 'border-white/10 hover:border-white/20 focus:border-jade-500',
        'invalid' => 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
    ];

    $inputClasses = 'peer block h-10 w-full rounded-lg border bg-ink-950 px-3 text-sm text-zinc-200 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40 '
        .($states[$state] ?? $states['default']);

    $accent = $state === 'invalid' ? 'peer-focus:text-red-400' : 'peer-focus:text-jade-400';
@endphp

<label class="relative block {{ $attributes->get('class') }}">
    <input placeholder=" " {{ $attributes->except(['class', 'placeholder'])->merge(['type' => 'text', 'class' => $inputClasses]) }}>
    <span class="pointer-events-none absolute top-1/2 left-2.5 -translate-y-1/2 bg-ink-900 px-1 text-sm text-zinc-600 transition-all duration-150 ease-snap peer-[:not(:placeholder-shown)]:top-0 peer-[:not(:placeholder-shown)]:text-[11px] peer-[:not(:placeholder-shown)]:text-zinc-500 peer-focus:top-0 peer-focus:text-[11px] {{ $accent }}">{{ $label }}</span>
</label>
