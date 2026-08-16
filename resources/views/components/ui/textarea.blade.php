@props([
    'label' => null,
    'hint' => null,
    'error' => null,
    'state' => 'default',
    'autoResize' => false,
])

@php
    $id = $attributes->get('id') ?? uniqid('ui-textarea-');
    $state = $error !== null ? 'invalid' : $state;

    $states = [
        'default' => 'border-white/10 hover:border-white/20 focus:border-jade-500',
        'invalid' => 'border-red-400/50 hover:border-red-400/70 focus:border-red-400',
    ];

    $classes = 'block w-full rounded-lg border bg-ink-950 px-3 py-2 text-sm/6 text-zinc-200 placeholder:text-zinc-600 transition-colors duration-150 outline-none disabled:pointer-events-none disabled:opacity-40 '
        .($states[$state] ?? $states['default'])
        .($autoResize ? ' field-sizing-content resize-none' : ' resize-y');
@endphp

<div>
    @if ($label)
        <label for="{{ $id }}" class="mb-1.5 block text-[13px] text-zinc-400">{{ $label }}</label>
    @endif
    <textarea id="{{ $id }}" @if ($state === 'invalid') aria-invalid="true" @endif {{ $attributes->except('id')->merge(['rows' => 4, 'class' => $classes]) }}>{{ $slot }}</textarea>
    @if ($error)
        <p class="mt-1.5 text-xs text-red-400">{{ $error }}</p>
    @elseif ($hint)
        <p class="mt-1.5 text-xs text-zinc-500">{{ $hint }}</p>
    @endif
</div>
