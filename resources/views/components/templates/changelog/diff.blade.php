@props([
    'state' => 'same',
    'text',
    'note' => null,
])

@php
    $marks = [
        'gone' => ['sign' => '-', 'class' => 'bg-red-400/6 text-red-400/90', 'sign_class' => 'text-red-400/70'],
        'new' => ['sign' => '+', 'class' => 'bg-jade-500/8 text-jade-300', 'sign_class' => 'text-jade-400/70'],
        'same' => ['sign' => ' ', 'class' => 'text-zinc-500', 'sign_class' => 'text-zinc-700'],
    ];

    $mark = $marks[$state] ?? $marks['same'];
@endphp

<div data-diff="{{ $state }}" {{ $attributes->class('flex items-baseline gap-2 px-3 py-1 '.$mark['class']) }}>
    <span class="w-2 shrink-0 font-mono text-[11px] {{ $mark['sign_class'] }}">{{ $mark['sign'] }}</span>
    <code class="min-w-0 flex-1 font-mono text-[11px]/5 break-all whitespace-pre-wrap">{{ $text }}</code>

    @if ($note)
        <span class="hidden shrink-0 font-mono text-[10px] text-zinc-700 sm:block">{{ $note }}</span>
    @endif
</div>
