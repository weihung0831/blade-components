@props([
    'items' => [],
    'variant' => 'default',
])

<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>
    @foreach ($items as $item)
        @php $state = $item['state'] ?? 'done'; @endphp
        <div class="flex gap-3.5">
            <div class="flex flex-col items-center">
                @if ($variant === 'compact')
                    <span @class(['mt-1 size-2.5 shrink-0 rounded-full', 'bg-jade-500' => $state === 'done', 'border border-jade-500 bg-ink-950' => $state === 'current', 'border border-white/15 bg-ink-950' => $state === 'upcoming'])></span>
                @elseif ($state === 'done')
                    <span class="grid size-4 shrink-0 place-items-center rounded-full bg-jade-500">
                        <svg class="size-2.5 text-ink-950" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                @elseif ($state === 'current')
                    <span class="size-4 shrink-0 rounded-full border-2 border-jade-500 bg-ink-950"></span>
                @else
                    <span class="size-4 shrink-0 rounded-full border-2 border-white/15 bg-ink-950"></span>
                @endif
                @unless ($loop->last)
                    <span class="w-px flex-1 bg-white/15"></span>
                @endunless
            </div>
            @if ($variant === 'compact')
                <div @class(['flex min-w-0 flex-1 items-baseline justify-between gap-4', 'pb-4' => ! $loop->last])>
                    <p @class(['truncate text-[13px]', 'text-zinc-200' => $state !== 'upcoming', 'text-zinc-500' => $state === 'upcoming'])>{{ $item['title'] }}</p>
                    @if (isset($item['time']))
                        <span class="shrink-0 font-mono text-[11px] text-zinc-600">{{ $item['time'] }}</span>
                    @endif
                </div>
            @else
                <div @class(['min-w-0', 'pb-6' => ! $loop->last])>
                    <p @class(['text-sm', 'text-zinc-200' => $state !== 'upcoming', 'text-zinc-500' => $state === 'upcoming'])>{{ $item['title'] }}</p>
                    @if (isset($item['description']))
                        <p class="mt-0.5 text-xs/5 text-zinc-500">{{ $item['description'] }}</p>
                    @endif
                    @if (isset($item['time']))
                        <p class="mt-1 font-mono text-[11px] text-zinc-600">{{ $item['time'] }}</p>
                    @endif
                </div>
            @endif
        </div>
    @endforeach
</div>
