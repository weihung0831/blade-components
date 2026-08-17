@props([
    'minutes' => 0,
    'target' => 240,
    'bar' => false,
    'label' => null,
    'compact' => false,
])

@php
    $late = $minutes < 0;
    $span = abs($minutes);
    $hours = intdiv($span, 60);
    $rest = $span % 60;

    $clock = $hours > 0 ? $hours.'h'.($rest > 0 ? ' '.$rest.'m' : '') : $rest.'m';

    $tone = match (true) {
        $late => 'text-red-300',
        $minutes <= 60 => 'text-amber-300',
        default => 'text-zinc-500',
    };

    $fillTone = match (true) {
        $late => 'bg-red-400',
        $minutes <= 60 => 'bg-amber-400',
        default => 'bg-jade-500/70',
    };

    $burned = $target > 0 ? min(100, max(0, round(($target - $minutes) / $target * 100))) : 100;

    $words = $label ?? ($late ? 'overdue' : 'to first reply');
@endphp

<span {{ $attributes->class(['inline-flex items-center gap-1.5 font-mono text-[10px] whitespace-nowrap', $tone]) }}
    title="{{ $late ? 'First reply is '.$clock.' past the promise' : $clock.' left on the reply promise' }}">

    @if ($late)
        <svg class="size-3 shrink-0" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <circle cx="8" cy="8" r="5.5" stroke="currentColor" stroke-width="1.3"/><path d="M8 5.2v3.4M8 10.6v.6" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
        </svg>
    @else
        <svg class="size-3 shrink-0" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <circle cx="8" cy="8" r="5.5" stroke="currentColor" stroke-width="1.3"/><path d="M8 5v3.2l2.2 1.3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    @endif

    @if ($late)
        <span>{{ $compact ? $clock : $words.' '.$clock }}</span>
    @else
        <span>{{ $compact ? $clock : $clock.' '.$words }}</span>
    @endif

    @if ($bar)
        <span class="ml-0.5 block h-0.5 w-12 overflow-hidden rounded-full bg-white/10">
            <span class="block h-full rounded-full {{ $fillTone }}" style="width: {{ $burned }}%"></span>
        </span>
    @endif
</span>
