@props([
    'number',
    'title',
    'minutes' => null,
    'tools' => [],
    'last' => false,
])

<div {{ $attributes->class('relative flex gap-4 pb-6') }}>
    @unless ($last)
        <span aria-hidden="true" class="absolute top-8 bottom-0 left-3.5 w-px bg-white/8"></span>
    @endunless

    <span class="relative z-10 grid size-7 shrink-0 place-items-center rounded-full border border-jade-500/40 bg-ink-950 font-mono text-[11px] text-jade-300">{{ $number }}</span>

    <div class="min-w-0 flex-1">
        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
            <h4 class="text-[13px] font-medium text-cream">{{ $title }}</h4>
            @if ($minutes)
                <span class="font-mono text-[10px] text-zinc-600">{{ $minutes }}</span>
            @endif
        </div>

        <div class="mt-1.5 space-y-2 text-[13px]/6 text-zinc-400">{{ $slot }}</div>

        @if ($tools !== [])
            <div class="mt-2.5 flex flex-wrap items-center gap-1.5">
                <span class="font-mono text-[10px] text-zinc-700">needs</span>
                @foreach ($tools as $tool)
                    <span class="rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-500">{{ $tool }}</span>
                @endforeach
            </div>
        @endif
    </div>
</div>
