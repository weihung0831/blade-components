@props([
    'options' => [],
    'name' => 'listbox',
    'multiple' => false,
    'selected' => null,
])

<div role="listbox" @if ($multiple) aria-multiselectable="true" @endif {{ $attributes->merge(['class' => 'w-full rounded-lg border border-white/10 bg-ink-950 p-1']) }}>
    @foreach ($options as $option)
        <label class="flex cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream has-[:checked]:bg-jade-500/15 has-[:checked]:text-jade-300 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-40">
            {{ $option }}
            <input type="{{ $multiple ? 'checkbox' : 'radio' }}" name="{{ $name }}{{ $multiple ? '[]' : '' }}" value="{{ $option }}" @checked(in_array($option, (array) $selected)) class="peer sr-only">
            <svg class="size-3.5 shrink-0 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </label>
    @endforeach
</div>
