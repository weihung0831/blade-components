@props([
    'columns' => [],
    'rows' => [],
])

<div {{ $attributes->class('overflow-x-auto') }}>
    <table class="w-full min-w-2xl border-separate border-spacing-0 text-left">
        <thead>
            <tr>
                <th scope="col" class="sticky left-0 z-10 bg-ink-800 pb-2 pr-3 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Cohort</th>
                <th scope="col" class="pb-2 pr-3 text-right font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Users</th>
                @foreach ($columns as $column)
                    <th scope="col" class="pb-2 text-center font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $column }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <th scope="row" class="sticky left-0 z-10 bg-ink-800 py-0.5 pr-3 text-[13px] font-normal whitespace-nowrap text-zinc-300">{{ $row['label'] }}</th>
                    <td class="py-0.5 pr-3 text-right font-mono text-[11px] text-zinc-500">{{ $row['size'] }}</td>

                    @foreach ($row['values'] as $value)
                        <td class="p-0.5">
                            @if ($value === null)
                                <div class="h-9 rounded-md border border-dashed border-white/8"></div>
                            @else
                                <div class="relative grid h-9 place-items-center overflow-hidden rounded-md bg-ink-950">
                                    <span aria-hidden="true" class="absolute inset-0 bg-jade-500" style="opacity: {{ round(0.1 + ($value / 100) * 0.52, 3) }}"></span>
                                    <span class="relative font-mono text-[11px] text-cream">{{ $value }}%</span>
                                </div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
