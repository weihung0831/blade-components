@props([
    'max' => 5,
    'value' => 0,
    'readonly' => false,
])

@if ($readonly)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5']) }}>
        @for ($i = 1; $i <= $max; $i++)
            <svg class="size-4.5 {{ $i <= $value ? 'text-jade-400' : 'text-white/15' }}" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1.5l1.9 3.9 4.3.6-3.1 3 .7 4.3L8 11.3l-3.8 2 .7-4.3-3.1-3 4.3-.6L8 1.5Z"/></svg>
        @endfor
        <span class="ml-1 font-mono text-xs text-zinc-500">{{ number_format($value, 1) }}</span>
    </span>
@else
    @php
        $name = $attributes->get('name', uniqid('ui-rating-'));
    @endphp

    <fieldset {{ $attributes->except('name')->merge(['class' => 'inline-flex flex-row-reverse items-center']) }}>
        @for ($i = $max; $i >= 1; $i--)
            <input type="radio" name="{{ $name }}" value="{{ $i }}" id="{{ $name }}-{{ $i }}" @checked($i === (int) $value) class="peer sr-only">
            <label for="{{ $name }}-{{ $i }}" aria-label="{{ $i }} of {{ $max }}" class="cursor-pointer px-0.5 text-white/15 transition-colors duration-150 peer-checked:text-jade-400 peer-focus-visible:text-jade-300 hover:text-jade-300 [&:hover~label]:text-jade-300">
                <svg class="size-4.5" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1.5l1.9 3.9 4.3.6-3.1 3 .7 4.3L8 11.3l-3.8 2 .7-4.3-3.1-3 4.3-.6L8 1.5Z"/></svg>
            </label>
        @endfor
    </fieldset>
@endif
