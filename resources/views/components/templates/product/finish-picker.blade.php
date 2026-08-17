@props([
    'detailed' => false,
])

@php
    $finishes = [
        [
            'key' => 'graphite',
            'label' => 'Graphite',
            'swatch' => 'bg-finish-graphite',
            'note' => '12 left',
            'dot' => 'group-data-[finish=graphite]/shell:ring-jade-400',
            'card' => 'group-data-[finish=graphite]/shell:border-jade-500/50 group-data-[finish=graphite]/shell:bg-jade-500/6',
        ],
        [
            'key' => 'cream',
            'label' => 'Cream',
            'swatch' => 'bg-finish-cream',
            'note' => '4 left',
            'dot' => 'group-data-[finish=cream]/shell:ring-jade-400',
            'card' => 'group-data-[finish=cream]/shell:border-jade-500/50 group-data-[finish=cream]/shell:bg-jade-500/6',
        ],
        [
            'key' => 'jade',
            'label' => 'Jade',
            'swatch' => 'bg-finish-jade',
            'note' => '+$120',
            'dot' => 'group-data-[finish=jade]/shell:ring-jade-400',
            'card' => 'group-data-[finish=jade]/shell:border-jade-500/50 group-data-[finish=jade]/shell:bg-jade-500/6',
        ],
    ];
@endphp

@if ($detailed)
    <div {{ $attributes->class('grid gap-2 sm:grid-cols-3') }} role="group" aria-label="Finish">
        @foreach ($finishes as $finish)
            <button type="button" data-finish-set="{{ $finish['key'] }}"
                class="flex items-center gap-2.5 rounded-xl border border-white/8 bg-ink-900 px-3 py-2.5 text-left transition-colors duration-150 outline-none hover:border-white/20 focus-visible:ring-2 focus-visible:ring-jade-500/70 {{ $finish['card'] }}">
                <span class="size-5 shrink-0 rounded-full ring-1 ring-white/15 {{ $finish['swatch'] }}"></span>
                <span class="min-w-0">
                    <span class="block truncate text-[13px] text-zinc-300">{{ $finish['label'] }}</span>
                    <span class="block truncate font-mono text-[10px] text-zinc-600">{{ $finish['note'] }}</span>
                </span>
            </button>
        @endforeach
    </div>
@else
    <div {{ $attributes->class('flex items-center gap-1.5') }} role="group" aria-label="Finish">
        @foreach ($finishes as $finish)
            <button type="button" data-finish-set="{{ $finish['key'] }}" aria-label="{{ $finish['label'] }}"
                class="rounded-full p-0.5 ring-1 ring-white/12 transition-colors duration-150 outline-none hover:ring-white/35 focus-visible:ring-2 focus-visible:ring-jade-500/70 {{ $finish['dot'] }}">
                <span class="block size-4 rounded-full {{ $finish['swatch'] }}"></span>
            </button>
        @endforeach
    </div>
@endif
