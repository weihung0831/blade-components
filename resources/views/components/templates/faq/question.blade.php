@props([
    'number' => null,
    'question',
    'topic' => null,
    'helpful' => null,
    'votes' => 0,
    'updated' => null,
    'opens' => 0,
    'open' => false,
    'tags' => [],
    'stale' => false,
])

@php
    $verdict = match (true) {
        $helpful === null => null,
        $helpful >= 85 => 'good',
        $helpful >= 65 => 'fair',
        default => 'poor',
    };

    $tone = match ($verdict) {
        'good' => 'text-jade-300',
        'fair' => 'text-amber-300',
        'poor' => 'text-red-300',
        default => 'text-zinc-600',
    };
@endphp

<details
    data-question
    data-topic="{{ Illuminate\Support\Str::lower($topic) }}"
    data-helpful="{{ $helpful ?? '' }}"
    data-opens="{{ $opens }}"
    data-search="{{ Illuminate\Support\Str::lower($question.' '.$topic.' '.implode(' ', $tags)) }}"
    @if ($stale) data-stale @endif
    @if ($open) open @endif
    {{ $attributes->class('group/question relative border-b border-white/5') }}>

    <span aria-hidden="true"
        class="absolute inset-y-0 left-0 w-0.5 bg-jade-400 opacity-0 transition-opacity duration-150 group-open/question:opacity-100"></span>

    <summary class="flex cursor-pointer list-none items-baseline gap-3 py-3.5 pr-4 pl-4 outline-none transition-colors duration-150 hover:bg-white/4 focus-visible:bg-white/4 [&::-webkit-details-marker]:hidden">
        @if ($number !== null)
            <span class="w-6 shrink-0 font-mono text-[11px] text-zinc-700 group-open/question:text-jade-400">{{ sprintf('%02d', $number) }}</span>
        @endif

        <span class="min-w-0 flex-1">
            <span class="block text-[13px]/5 text-zinc-300 group-open/question:text-cream">{{ $question }}</span>

            <span class="mt-1.5 flex flex-wrap items-center gap-x-2.5 gap-y-1">
                @if ($topic)
                    <span class="font-mono text-[10px] text-zinc-700">{{ $topic }}</span>
                @endif

                @if ($helpful !== null)
                    <span class="font-mono text-[10px] {{ $tone }}">{{ $helpful }}% said this helped</span>
                    <span class="font-mono text-[10px] text-zinc-700">of {{ $votes }}</span>
                @endif

                @if ($stale)
                    <span class="rounded border border-amber-400/30 px-1 font-mono text-[9px] text-amber-300/80">needs a rewrite</span>
                @endif
            </span>
        </span>

        <span class="flex shrink-0 items-center gap-3">
            @if ($updated)
                <span class="hidden font-mono text-[10px] text-zinc-700 sm:block">{{ $updated }}</span>
            @endif

            <svg class="size-3.5 shrink-0 text-zinc-600 transition-transform duration-200 group-open/question:rotate-45 group-open/question:text-jade-400" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <path d="M8 3.5v9M3.5 8h9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
            </svg>
        </span>
    </summary>

    <div @class(['pt-0.5 pr-4 pb-5 pl-4', 'sm:pl-13' => $number !== null])>
        <div class="max-w-2xl space-y-3 text-[13px]/6 text-zinc-400">{{ $slot }}</div>

        @if (isset($footer))
            <div class="mt-4 max-w-2xl">{{ $footer }}</div>
        @endif
    </div>
</details>
