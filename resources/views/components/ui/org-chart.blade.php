@props([
    'node' => [],
    'depth' => 0,
])

@php
    $tone = $node['tone'] ?? ($depth === 0 ? 'jade' : 'default');

    $boxes = [
        'default' => 'border-white/10 bg-ink-800 text-zinc-300',
        'jade' => 'border-jade-500/40 bg-jade-500/15 text-jade-300',
    ];
@endphp

<div {{ $attributes->class([
    'inline-flex flex-col items-center text-xs' => $depth === 0,
    'relative flex flex-col items-center px-2 before:absolute before:top-0 before:left-0 before:h-px before:w-full before:bg-white/15 first:before:left-1/2 first:before:w-1/2 last:before:left-0 last:before:w-1/2 only:before:hidden' => $depth > 0,
]) }}>
    @if ($depth > 0)
        <span class="h-3 w-px bg-white/15"></span>
    @endif
    <span class="flex flex-col items-center whitespace-nowrap rounded-md border px-3 py-1 {{ $boxes[$tone] ?? $boxes['default'] }}">
        {{ $node['label'] }}
        @if (! empty($node['meta']))
            <span class="font-mono text-[10px] {{ $tone === 'jade' ? 'text-jade-400' : 'text-zinc-500' }}">{{ $node['meta'] }}</span>
        @endif
    </span>
    @if (! empty($node['children']))
        <span class="h-3 w-px bg-white/15"></span>
        <div class="grid auto-cols-fr grid-flow-col items-start">
            @foreach ($node['children'] as $child)
                <x-ui.org-chart :node="$child" :depth="$depth + 1" />
            @endforeach
        </div>
    @endif
</div>
