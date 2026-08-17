@props([
    'clause',
    'title' => null,
    'lines' => [],
    'why' => null,
    'verdict' => null,
])

@php
    $tint = [
        '-' => ['row' => 'bg-red-400/6', 'mark' => 'text-red-400/80', 'text' => 'text-zinc-500'],
        '+' => ['row' => 'bg-jade-500/8', 'mark' => 'text-jade-400', 'text' => 'text-zinc-300'],
    ];

    $added = count(array_filter($lines, fn (array $line): bool => $line['mark'] === '+'));
    $removed = count(array_filter($lines, fn (array $line): bool => $line['mark'] === '-'));
@endphp

<div {{ $attributes->class('overflow-hidden rounded-xl border border-white/8 bg-ink-900') }}>

    <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1 border-b border-white/5 px-3.5 py-2.5">
        <span class="font-mono text-[11px] text-zinc-700">{{ $clause }}</span>
        @if ($title)
            <span class="text-[13px] text-zinc-300">{{ $title }}</span>
        @endif

        <span class="ml-auto flex shrink-0 items-center gap-2 font-mono text-[10px]">
            <span class="text-red-400/80">−{{ $removed }}</span>
            <span class="text-jade-400">+{{ $added }}</span>
        </span>
    </div>

    <div class="divide-y divide-white/4">
        @foreach ($lines as $line)
            @php $skin = $tint[$line['mark']] ?? ['row' => '', 'mark' => 'text-zinc-700', 'text' => 'text-zinc-500']; @endphp

            <p class="flex gap-3 px-3.5 py-2 {{ $skin['row'] }}">
                <span class="w-2 shrink-0 font-mono text-[11px] {{ $skin['mark'] }}">{{ $line['mark'] === ' ' ? '' : $line['mark'] }}</span>
                <span class="font-mono text-[11px]/5 {{ $skin['text'] }}">{{ $line['text'] }}</span>
            </p>
        @endforeach
    </div>

    @if ($why || $verdict)
        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1.5 border-t border-white/5 px-3.5 py-2.5">
            @if ($why)
                <span class="min-w-0 flex-1 text-[12px]/5 text-zinc-500">{{ $why }}</span>
            @endif

            @if ($verdict)
                <span @class([
                    'shrink-0 rounded border px-1.5 py-0.5 font-mono text-[10px]',
                    'border-jade-500/40 bg-jade-500/10 text-jade-300' => $verdict === 'better for you',
                    'border-amber-400/30 bg-amber-400/8 text-amber-300/90' => $verdict === 'better for us',
                    'border-white/10 text-zinc-600' => ! in_array($verdict, ['better for you', 'better for us'], true),
                ])>{{ $verdict }}</span>
            @endif
        </div>
    @endif
</div>
