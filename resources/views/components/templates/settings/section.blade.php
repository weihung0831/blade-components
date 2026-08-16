@props([
    'heading',
    'description' => null,
    'flush' => false,
    'tone' => 'default',
])

@php
    $tones = [
        'default' => 'border-white/10 bg-ink-800',
        'danger' => 'border-red-400/25 bg-ink-800',
    ];
@endphp

<section {{ $attributes->class(['overflow-hidden rounded-xl border', $tones[$tone] ?? $tones['default']]) }}>
    <div class="flex flex-wrap items-start justify-between gap-3 border-b border-white/5 px-5 py-3.5">
        <div>
            <h2 @class(['text-sm font-medium', 'text-cream' => $tone !== 'danger', 'text-red-400' => $tone === 'danger'])>{{ $heading }}</h2>
            @if ($description)
                <p class="mt-1 max-w-md text-xs/5 text-zinc-500">{{ $description }}</p>
            @endif
        </div>
        @isset($actions)
            <div class="flex shrink-0 items-center gap-2">{{ $actions }}</div>
        @endisset
    </div>

    @if ($flush)
        {{ $slot }}
    @else
        <div class="divide-y divide-white/5 px-5">{{ $slot }}</div>
    @endif

    @isset($footer)
        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-white/5 bg-ink-950/40 px-5 py-3">{{ $footer }}</div>
    @endisset
</section>
