@props([
    'tone' => 'tip',
    'label' => null,
])

@php
    $tones = [
        'tip' => ['line' => 'bg-jade-500/60', 'label' => 'text-jade-300', 'default' => 'Worth knowing'],
        'warn' => ['line' => 'bg-amber-400/60', 'label' => 'text-amber-300', 'default' => 'Careful here'],
        'stop' => ['line' => 'bg-red-400/60', 'label' => 'text-red-300', 'default' => 'Do not'],
        'quiet' => ['line' => 'bg-white/15', 'label' => 'text-zinc-500', 'default' => 'Aside'],
    ];

    $style = $tones[$tone] ?? $tones['tip'];
@endphp

<div {{ $attributes->class('relative py-1 pl-4') }}>
    <span aria-hidden="true" class="absolute inset-y-0 left-0 w-0.5 rounded-full {{ $style['line'] }}"></span>

    <p class="font-mono text-[10px] tracking-wider uppercase {{ $style['label'] }}">{{ $label ?? $style['default'] }}</p>
    <div class="mt-1.5 space-y-2 text-[13px]/6 text-zinc-400">{{ $slot }}</div>
</div>
