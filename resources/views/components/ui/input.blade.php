@props([
    'label' => null,
    'hint' => null,
    'error' => null,
    'state' => 'default',
    'size' => 'md',
])

@php
    $id = $attributes->get('id') ?? uniqid('ui-input-');
    $state = $error !== null ? 'invalid' : $state;

    $base = 'block w-full rounded-lg border bg-ink-950 text-zinc-200 placeholder:text-zinc-600 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40';

    $states = [
        'default' => 'border-white/10 hover:border-white/20 focus:border-jade-500',
        'invalid' => 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
        'success' => 'border-jade-500/60 hover:border-jade-500/80 focus:border-jade-400',
    ];

    $sizes = [
        'sm' => 'h-8 px-2.5 text-[13px]',
        'md' => 'h-10 px-3 text-sm',
        'lg' => 'h-11 px-3.5 text-[15px]',
    ];

    $classes = $base.' '.($states[$state] ?? $states['default']).' '.($sizes[$size] ?? $sizes['md']);
@endphp

<div>
    @if ($label)
        <label for="{{ $id }}" class="mb-1.5 block text-[13px] text-zinc-400">{{ $label }}</label>
    @endif
    <input id="{{ $id }}" @if ($state === 'invalid') aria-invalid="true" @endif {{ $attributes->except('id')->merge(['type' => 'text', 'class' => $classes]) }}>
    @if ($error)
        <p class="mt-1.5 text-xs text-red-400">{{ $error }}</p>
    @elseif ($hint)
        <p class="mt-1.5 text-xs text-zinc-500">{{ $hint }}</p>
    @endif
</div>
