@props([
    'label' => null,
    'vertical' => false,
])

@if ($vertical)
    <span {{ $attributes->class('inline-block w-px self-stretch bg-white/10') }}></span>
@elseif ($label !== null)
    <div {{ $attributes->class('flex w-full items-center gap-3') }}>
        <span class="h-px flex-1 bg-white/10"></span>
        <span class="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $label }}</span>
        <span class="h-px flex-1 bg-white/10"></span>
    </div>
@else
    <div {{ $attributes->class('h-px w-full bg-white/10') }}></div>
@endif
