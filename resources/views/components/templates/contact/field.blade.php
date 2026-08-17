@props([
    'label',
    'name' => null,
    'type' => 'text',
    'hint' => null,
    'note' => null,
    'placeholder' => null,
    'value' => null,
    'mono' => false,
    'rows' => 4,
    'optional' => false,
])

@php
    $control = 'w-full rounded-lg border border-white/10 bg-ink-900 px-3 py-2 text-[13px] text-cream placeholder:text-zinc-600 transition-colors duration-150 focus:border-jade-500/60 focus:outline-none'
        .($mono ? ' font-mono' : '');
@endphp

<label {{ $attributes->class('block') }}>
    <span class="flex items-baseline gap-2">
        <span class="text-[12px] text-zinc-400">{{ $label }}</span>
        @if ($optional)
            <span class="font-mono text-[10px] text-zinc-700">optional</span>
        @endif
        @if ($note)
            <span class="ml-auto font-mono text-[10px] text-zinc-700">{{ $note }}</span>
        @endif
    </span>

    <span class="mt-1.5 block">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @elseif ($type === 'textarea')
            <textarea name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}" spellcheck="false"
                class="{{ $control }} resize-none leading-6">{{ $value }}</textarea>
        @else
            <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
                @if ($mono) spellcheck="false" @endif
                class="{{ $control }}">
        @endif
    </span>

    @if ($hint)
        <span class="mt-1.5 block text-[11px]/5 text-zinc-600">{{ $hint }}</span>
    @endif
</label>
