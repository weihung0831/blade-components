@props([
    'name',
    'tag' => null,
    'lines' => [],
    'hours' => [],
    'travel' => [],
    'note' => null,
    'map' => false,
    'mapLabel' => 'map of the lane',
])

<div {{ $attributes->class('overflow-hidden rounded-xl border border-white/8 bg-ink-900') }}>

    @if ($map)
        <div class="border-b border-white/5 bg-ink-950 p-3">
            <div class="flex aspect-2/1 items-center justify-center rounded-lg border border-dashed border-white/12">
                <span class="font-mono text-[10px] text-zinc-700">{{ $mapLabel }}</span>
            </div>
        </div>
    @endif

    <div class="p-4">
        <div class="flex items-baseline gap-2">
            <p class="text-[13px] font-medium text-cream">{{ $name }}</p>
            @if ($tag)
                <span class="ml-auto rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">{{ $tag }}</span>
            @endif
        </div>

        @if ($lines !== [])
            <p class="mt-2 text-[12px]/5 text-zinc-400">
                @foreach ($lines as $line)
                    {{ $line }}@if (! $loop->last)<br>@endif
                @endforeach
            </p>
        @endif

        @if ($hours !== [])
            <div class="mt-3.5 border-t border-white/5 pt-3">
                @foreach ($hours as $entry)
                    <div class="flex items-baseline gap-3 py-1">
                        <span class="w-20 shrink-0 font-mono text-[11px] text-zinc-500">{{ $entry['when'] }}</span>
                        <span class="text-[12px]/5 text-zinc-400">{{ $entry['what'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($travel !== [])
            <div class="mt-3.5 border-t border-white/5 pt-3">
                @foreach ($travel as $entry)
                    <div class="flex gap-3 py-1">
                        <span class="w-20 shrink-0 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{{ $entry['mode'] }}</span>
                        <span class="text-[12px]/5 text-zinc-500">{{ $entry['detail'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($note)
            <p class="mt-3.5 border-t border-white/5 pt-3 text-[12px]/5 text-zinc-500">{{ $note }}</p>
        @endif

        {{ $slot }}
    </div>
</div>
