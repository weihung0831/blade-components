@php
    $bars = [
        ['w' => 'w-full', 'fill' => 'bg-white/20'],
        ['w' => 'w-4/5', 'fill' => 'bg-jade-500'],
        ['w' => 'w-2/5', 'fill' => 'bg-red-400/50'],
    ];
@endphp

<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-jade-500/15 bg-jade-500/6 px-2.5 py-1">
        <span class="size-1 rounded-full bg-jade-400"></span>
        <span class="block h-0.5 w-16 rounded bg-jade-500/30"></span>
    </div>

    <div class="flex items-center gap-1.5 border-b border-white/5 px-2.5 py-1.5">
        <span class="block size-2.5 rounded-full border border-jade-500/60"></span>
        <span class="flex gap-1">
            <span class="block h-1 w-5 rounded bg-white/12"></span>
            <span class="block h-1 w-7 rounded bg-white/12"></span>
            <span class="block h-1 w-4 rounded bg-white/12"></span>
        </span>
        <span class="ml-auto block h-2.5 w-8 rounded bg-jade-500"></span>
    </div>

    <div class="flex min-h-0 flex-1 gap-2 p-2.5">
        <span class="flex min-w-0 flex-1 flex-col gap-1">
            <span class="block h-0.5 w-6 rounded bg-jade-500/50"></span>
            <span class="block h-2 w-full rounded bg-cream/30"></span>
            <span class="block h-2 w-4/5 rounded bg-cream/25"></span>
            <span class="mt-0.5 block h-1 w-2/3 rounded bg-white/10"></span>

            <span class="mt-1.5 flex items-center gap-1">
                <span class="block h-3 w-9 rounded-md bg-jade-500"></span>
                <span class="block h-3 w-9 rounded-md border border-white/15"></span>
            </span>

            <span class="mt-auto grid grid-cols-4 gap-1 border-t border-white/8 pt-1.5">
                @foreach (range(1, 4) as $fact)
                    <span class="flex flex-col gap-0.5">
                        <span class="block h-0.5 w-full rounded bg-white/10"></span>
                        <span class="block h-1 w-3/4 rounded bg-cream/25"></span>
                    </span>
                @endforeach
            </span>
        </span>

        <span class="flex w-[38%] shrink-0 flex-col gap-1 rounded border border-white/8 bg-ink-900/70 p-1.5">
            <span class="block h-0.5 w-2/3 rounded bg-white/12"></span>

            <span class="my-auto flex flex-col items-center gap-0.5 py-1">
                <span class="block h-1 w-3 rounded-t bg-jade-400/70"></span>
                <span class="block h-2 w-5 bg-cream/25"></span>
                <span class="block h-1 w-4 bg-jade-500/60"></span>
                <span class="block h-4 w-4 bg-cream/20"></span>
            </span>

            <span class="mt-auto flex flex-col gap-1 border-t border-white/8 pt-1">
                @foreach ($bars as $bar)
                    <span class="block h-1 w-full overflow-hidden rounded-full bg-white/6">
                        <span class="block h-full {{ $bar['w'] }} rounded-full {{ $bar['fill'] }}"></span>
                    </span>
                @endforeach
            </span>
        </span>
    </div>
</div>
