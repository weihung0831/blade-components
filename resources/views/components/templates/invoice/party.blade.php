@props([
    'role' => 'to',
    'name',
    'taxId' => null,
    'lines' => [],
    'contact' => null,
    'note' => null,
])

@php
    $labels = [
        'to' => 'billed to',
        'ship' => 'shipped to',
        'from' => 'from',
    ];
@endphp

<div {{ $attributes->class('min-w-0') }}>
    <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ $labels[$role] ?? $role }}</p>

    <p class="mt-2 text-[14px] font-medium tracking-tight text-cream">{{ $name }}</p>

    @if ($taxId)
        <p class="mt-1 font-mono text-[10px] text-jade-300">統一編號 {{ $taxId }}</p>
    @endif

    @if ($lines !== [])
        <p class="mt-2 text-[11px]/5 text-zinc-500">
            @foreach ($lines as $line)
                {{ $line }}@if (! $loop->last)<br>@endif
            @endforeach
        </p>
    @endif

    @if ($contact)
        <p class="mt-2 font-mono text-[10px] text-zinc-600">{{ $contact }}</p>
    @endif

    @if ($note)
        <p class="mt-2 border-l border-white/10 pl-2.5 text-[11px]/5 text-zinc-600">{{ $note }}</p>
    @endif
</div>
