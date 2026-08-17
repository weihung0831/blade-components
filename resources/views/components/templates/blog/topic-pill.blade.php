@props([
    'value',
    'label',
    'count' => null,
    'name' => 'topic',
    'checked' => false,
])

<label {{ $attributes->class('inline-flex cursor-pointer items-center gap-2 rounded-full border border-white/10 bg-ink-900 px-3 py-1.5 transition-colors duration-200 ease-snap hover:border-white/25 has-[:checked]:border-jade-500/50 has-[:checked]:bg-jade-500/10') }}>
    <input type="radio" name="{{ $name }}" value="{{ $value }}" data-topic-set="{{ $value }}" @checked($checked)
        class="peer sr-only">

    <span class="text-[13px] text-zinc-400 peer-checked:text-jade-300">{{ $label }}</span>

    @if ($count !== null)
        <span data-topic-count="{{ $value }}" class="font-mono text-[10px] text-zinc-600 peer-checked:text-jade-400/70">{{ $count }}</span>
    @endif
</label>
