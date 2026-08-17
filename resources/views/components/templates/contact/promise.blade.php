@props([
    'sent' => '02:41',
    'due' => '10:20',
    'shut' => 409,
    'worked' => 0,
    'left' => 47,
    'lead' => null,
])

@php
    $total = max(1, $shut + $worked + $left);

    $span = fn (int $minutes): string => round($minutes / $total * 100, 3).'%';

    $spell = function (int $minutes): string {
        $hours = intdiv($minutes, 60);
        $rest = $minutes % 60;

        return ($hours > 0 ? $hours.' h ' : '').$rest.' m';
    };
@endphp

<div {{ $attributes->class('rounded-xl border border-white/8 bg-ink-900 p-4') }}>

    <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
        <span class="font-mono text-xl text-cream">{{ $due }}</span>
        <span class="text-[13px] text-zinc-400">{{ $lead ?? 'is when a person should have got to it' }}</span>
        <span class="ml-auto font-mono text-[11px] text-zinc-700">sent {{ $sent }}</span>
    </div>

    <div class="mt-3.5 flex h-1.5 overflow-hidden rounded-full bg-white/6">
        <span class="shrink-0 bg-white/5 bg-[repeating-linear-gradient(90deg,currentColor_0_1px,transparent_1px_5px)] text-white/18"
            style="width: {{ $span($shut) }}"></span>

        @if ($worked > 0)
            <span class="shrink-0 bg-jade-500/60" style="width: {{ $span($worked) }}"></span>
        @endif
    </div>

    <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2">
        <span class="flex items-center gap-2">
            <span class="h-1.5 w-5 rounded-full bg-white/5 bg-[repeating-linear-gradient(90deg,currentColor_0_1px,transparent_1px_5px)] text-white/18"></span>
            <span class="font-mono text-[10px] text-zinc-600">{{ $spell($shut) }} of it, the bench is shut</span>
        </span>

        <span class="flex items-center gap-2">
            <span class="h-1.5 w-5 rounded-full bg-jade-500/60"></span>
            <span class="font-mono text-[10px] text-zinc-600">{{ $spell($worked) }} worked</span>
        </span>

        <span class="flex items-center gap-2">
            <span class="h-1.5 w-5 rounded-full bg-white/10"></span>
            <span class="font-mono text-[10px] text-zinc-600">{{ $spell($left) }} still owed to you</span>
        </span>
    </div>
</div>
