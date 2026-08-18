@props([
    'name',
    'role',
    'country',
    'basis',
    'control' => 'required',
    'gets' => [],
    'note' => null,
    'since' => null,
])

@php
    $controls = [
        'required' => ['label' => 'cannot be switched off', 'class' => 'border-amber-400/25 bg-amber-400/8 text-amber-300/90'],
        'partly' => ['label' => 'avoidable', 'class' => 'border-white/12 bg-white/5 text-zinc-400'],
        'optional' => ['label' => 'off unless you say yes', 'class' => 'border-jade-500/30 bg-jade-500/8 text-jade-300'],
    ];

    $tag = $controls[$control] ?? $controls['required'];
@endphp

<article data-holder
    data-control="{{ $control }}"
    {{ $attributes->class('flex flex-col gap-3 rounded-xl border border-white/8 bg-ink-900 p-4 sm:flex-row sm:gap-5') }}>

    <div class="w-full shrink-0 sm:w-52">
        <p class="text-[13px] text-cream">{{ $name }}</p>
        <p class="mt-0.5 text-[11px]/5 text-zinc-500">{{ $role }}</p>
        <p class="mt-1.5 flex items-center gap-1.5 font-mono text-[10px] text-zinc-600">
            <span class="size-1 rounded-full bg-zinc-700"></span>
            {{ $country }}
        </p>
    </div>

    <div class="min-w-0 flex-1">
        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Handed over</p>
        <div class="mt-1.5 flex flex-wrap gap-1">
            @foreach ($gets as $item)
                <span class="rounded border border-white/8 px-1.5 py-0.5 font-mono text-[10px] text-zinc-400">{{ $item }}</span>
            @endforeach
        </div>

        @if ($note)
            <p class="mt-2.5 text-[11px]/5 text-zinc-500">{{ $note }}</p>
        @endif
    </div>

    <div class="flex shrink-0 flex-row items-center gap-3 sm:w-40 sm:flex-col sm:items-end sm:gap-2">
        <span class="rounded border px-1.5 py-0.5 text-center font-mono text-[10px] {{ $tag['class'] }}">{{ $tag['label'] }}</span>
        <span class="font-mono text-[10px] text-zinc-600">{{ $basis }}</span>
        @if ($since)
            <span class="font-mono text-[10px] text-zinc-700">since {{ $since }}</span>
        @endif
    </div>
</article>
