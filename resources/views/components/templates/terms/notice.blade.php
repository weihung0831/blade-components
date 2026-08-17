@props([
    'version',
    'effective',
    'announced' => null,
    'days' => 28,
    'window' => 45,
    'elapsed' => 17,
    'lead' => null,
    'promise' => null,
])

@php
    $ratio = max(0, min(100, round($elapsed / max(1, $window) * 100, 3)));
@endphp

<div {{ $attributes->class('rounded-xl border border-amber-400/25 bg-amber-400/5 p-4') }}>

    <div class="flex flex-wrap items-start gap-x-6 gap-y-3">
        <div class="min-w-0 flex-1">
            <p class="flex flex-wrap items-baseline gap-x-2.5 gap-y-1">
                <span class="font-mono text-[13px] text-amber-300">{{ $version }}</span>
                <span class="text-[13px] text-cream">takes effect on {{ $effective }}</span>
            </p>

            @if ($lead)
                <p class="mt-1.5 max-w-xl text-[12px]/5 text-zinc-500">{{ $lead }}</p>
            @endif
        </div>

        <div class="flex shrink-0 items-baseline gap-2">
            <span class="font-mono text-2xl text-cream">{{ $days }}</span>
            <span class="font-mono text-[10px] text-zinc-600">days from today</span>
        </div>
    </div>

    <div class="mt-4">
        <div class="relative h-1.5 overflow-hidden rounded-full bg-white/6">
            <span class="absolute inset-y-0 left-0 rounded-full bg-amber-400/50" style="width: {{ $ratio }}%"></span>
            <span class="absolute -top-1 -bottom-1 w-px bg-cream" style="left: {{ $ratio }}%"></span>
        </div>

        <div class="mt-2 flex flex-wrap items-baseline gap-x-4 gap-y-1 font-mono text-[10px] text-zinc-700">
            @if ($announced)
                <span>announced {{ $announced }}</span>
            @endif
            <span>{{ $window }} days of notice, {{ $elapsed }} of them gone</span>
            <span class="ml-auto">{{ $effective }}</span>
        </div>
    </div>

    @if ($promise)
        <p class="mt-3 border-t border-amber-400/15 pt-3 text-[11px]/5 text-zinc-500">{{ $promise }}</p>
    @endif

    @if (isset($actions))
        <div class="mt-3.5 flex flex-wrap gap-2">{{ $actions }}</div>
    @endif
</div>
