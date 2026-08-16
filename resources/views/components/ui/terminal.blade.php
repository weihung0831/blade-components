@props([
    'lines' => [],
    'title' => null,
    'variant' => 'window',
    'cursor' => false,
])

@php
    $frames = [
        'window' => 'border border-white/10',
        'plain' => 'border border-white/5',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-lg bg-ink-950 font-mono text-xs/6 '.($frames[$variant] ?? $frames['window'])]) }}>
    @if ($variant === 'window')
        <div class="flex items-center gap-1.5 border-b border-white/5 px-3.5 py-2.5">
            <span class="size-2 rounded-full bg-white/10"></span>
            <span class="size-2 rounded-full bg-white/10"></span>
            <span class="size-2 rounded-full bg-white/10"></span>
            @if ($title !== null)
                <span class="ml-2 text-[11px] text-zinc-600">{{ $title }}</span>
            @endif
        </div>
    @endif
    <div class="p-3.5">
        @foreach ($lines as $line)
            @if (($line['type'] ?? 'output') === 'command')
                <p><span class="text-jade-400">$</span> <span class="text-zinc-300">{{ $line['text'] }}</span></p>
            @elseif (($line['type'] ?? 'output') === 'success')
                <p class="text-zinc-500">{{ $line['text'] }} <span class="text-jade-400">✓</span></p>
            @else
                <p class="text-zinc-500">{{ $line['text'] }}</p>
            @endif
        @endforeach
        @if ($cursor)
            <p><span class="text-jade-400">$</span> <span class="ml-0.5 inline-block h-3.5 w-2 animate-pulse bg-jade-400 align-middle"></span></p>
        @endif
    </div>
</div>
