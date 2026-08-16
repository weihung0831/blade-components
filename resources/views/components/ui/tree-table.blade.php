@props([
    'columns' => [],
    'rows' => [],
    'depth' => 0,
])

@if ($depth === 0)
    <div {{ $attributes->class(['w-full overflow-hidden rounded-lg border border-white/10 bg-ink-950 text-[13px]']) }}>
        <div class="flex items-center gap-4 bg-ink-800 px-3 py-1.5 font-mono text-[10px] tracking-wider text-zinc-500 uppercase">
            @foreach ($columns as $column)
                <span @class(['flex-1' => $loop->first, 'w-20 text-right' => ! $loop->first])>{{ $column }}</span>
            @endforeach
        </div>
        <x-ui.tree-table :rows="$rows" :depth="1" />
    </div>
@else
    @foreach ($rows as $row)
        @if (! empty($row['children']))
            <details @if (! empty($row['open'])) open @endif class="[&[open]>summary_svg]:rotate-90">
                <summary class="flex cursor-pointer list-none items-center gap-4 border-t border-white/5 px-3 py-1.5 transition-colors duration-150 hover:bg-white/5 [&::-webkit-details-marker]:hidden">
                    <span class="flex flex-1 items-center gap-1.5 text-zinc-300" style="padding-left: {{ ($depth - 1) * 16 }}px">
                        <svg class="size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ $row['cells'][0] }}
                    </span>
                    @foreach (array_slice($row['cells'], 1) as $cell)
                        <span class="w-20 text-right font-mono text-[10px] text-zinc-500">{{ $cell }}</span>
                    @endforeach
                </summary>
                <x-ui.tree-table :rows="$row['children']" :depth="$depth + 1" />
            </details>
        @else
            <div class="flex items-center gap-4 border-t border-white/5 px-3 py-1.5">
                <span class="flex-1 text-zinc-400" style="padding-left: {{ ($depth - 1) * 16 }}px">{{ $row['cells'][0] }}</span>
                @foreach (array_slice($row['cells'], 1) as $cell)
                    <span class="w-20 text-right font-mono text-[10px] text-zinc-500">{{ $cell }}</span>
                @endforeach
            </div>
        @endif
    @endforeach
@endif
