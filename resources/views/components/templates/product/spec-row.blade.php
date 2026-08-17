@props([
    'label',
    'value',
    'note' => null,
])

<div {{ $attributes->class('flex flex-wrap items-baseline gap-x-4 gap-y-1 px-5 py-3') }}>
    <span class="w-40 shrink-0 text-[13px] text-zinc-500">{{ $label }}</span>
    <span class="font-mono text-[13px] text-zinc-200">{{ $value }}</span>
    @if ($note)
        <span class="ml-auto hidden font-mono text-[10px] text-zinc-600 sm:block">{{ $note }}</span>
    @endif
</div>
