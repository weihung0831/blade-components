@props([
    'name',
    'handle',
    'icon' => 'mail',
    'note' => null,
    'volume' => null,
    'lag' => null,
    'on' => false,
])

@php
    $icons = [
        'mail' => [['d' => 'M3 6.5h14v11H3z'], ['d' => 'm3 7 7 5.5L17 7']],
        'rss' => [['d' => 'M5 15.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z', 'fill' => 'currentColor'], ['d' => 'M5 9.5a5.5 5.5 0 0 1 5.5 5.5'], ['d' => 'M5 5.5a9.5 9.5 0 0 1 9.5 9.5']],
        'hook' => [['d' => 'M7 5.5h6l3 4.5-3 4.5H7l-3-4.5z'], ['d' => 'M10 8.5v3']],
        'chat' => [['d' => 'M4 5.5h12v8H9l-4 3v-3H4z']],
    ];

    $paths = $icons[$icon] ?? $icons['mail'];
@endphp

<button type="button" data-channel="{{ $handle }}" @if ($on) data-on @endif
    {{ $attributes->class('group/channel flex w-full items-start gap-3 rounded-xl border border-white/8 bg-ink-950 p-3.5 text-left transition-colors duration-150 outline-none hover:border-white/15 focus-visible:ring-2 focus-visible:ring-jade-500/70 data-on:border-jade-500/40 data-on:bg-jade-500/5') }}>

    <span class="mt-0.5 grid size-8 shrink-0 place-items-center rounded-lg border border-white/8 text-zinc-500 transition-colors duration-150 group-data-on/channel:border-jade-500/40 group-data-on/channel:text-jade-300">
        <svg class="size-4.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
            @foreach ($paths as $path)
                <path d="{{ $path['d'] }}" @isset($path['fill']) fill="{{ $path['fill'] }}" @endisset />
            @endforeach
        </svg>
    </span>

    <span class="min-w-0 flex-1">
        <span class="flex flex-wrap items-baseline gap-x-2">
            <span class="text-[13px] text-cream">{{ $name }}</span>
            <span class="ml-auto shrink-0 font-mono text-[10px] text-zinc-600 group-data-on/channel:text-jade-400">{{ $on ? 'on' : 'off' }}</span>
        </span>

        <span class="mt-0.5 block truncate font-mono text-[11px] text-zinc-600">{{ $handle }}</span>

        @if ($note)
            <span class="mt-1.5 block text-[11px]/5 text-zinc-500">{{ $note }}</span>
        @endif

        @if ($volume || $lag)
            <span class="mt-2 flex flex-wrap items-baseline gap-x-3 font-mono text-[10px] text-zinc-700">
                @if ($volume)
                    <span data-channel-volume>{{ $volume }}</span>
                @endif
                @if ($lag)
                    <span>{{ $lag }}</span>
                @endif
            </span>
        @endif
    </span>
</button>
