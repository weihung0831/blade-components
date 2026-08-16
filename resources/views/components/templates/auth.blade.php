<div class="flex h-full w-full overflow-hidden rounded-lg border border-white/10 bg-ink-900 shadow-xl shadow-black/40">
    <div class="dot-grid relative flex w-2/5 flex-col justify-between border-r border-white/5 bg-ink-950 p-2.5">
        <span class="absolute -top-6 -left-4 size-16 rounded-full bg-jade-500/15 blur-2xl"></span>
        <span class="relative block size-3 rounded bg-jade-500"></span>
        <div class="relative space-y-1.5">
            <span class="block h-1.5 w-5/6 rounded bg-white/15"></span>
            <span class="block h-1.5 w-3/5 rounded bg-white/10"></span>
        </div>
        <div class="relative flex h-3 items-end gap-[2px]">
            @foreach (range(0, 13) as $tick)
                <span @class(['h-full flex-1 rounded-[1px]', 'bg-amber-400' => $tick === 9, 'bg-jade-500/35' => $tick !== 9])></span>
            @endforeach
        </div>
    </div>

    <div class="flex flex-1 flex-col justify-center p-3">
        <span class="block h-1.5 w-1/2 rounded bg-white/15"></span>
        <div class="mt-2.5 grid grid-cols-2 gap-1.5">
            <span class="h-4 rounded-md border border-white/10 bg-ink-950"></span>
            <span class="h-4 rounded-md border border-white/10 bg-ink-950"></span>
        </div>
        <div class="mt-2.5 flex items-center gap-1.5">
            <span class="h-px flex-1 bg-white/10"></span>
            <span class="h-1 w-3 rounded bg-white/10"></span>
            <span class="h-px flex-1 bg-white/10"></span>
        </div>
        <span class="mt-2.5 block h-5 rounded-md border border-white/10 bg-ink-950"></span>
        <span class="mt-1.5 block h-5 rounded-md border border-white/10 bg-ink-950"></span>
        <span class="mt-2.5 block h-5 rounded-md bg-jade-500"></span>
        <span class="mt-2.5 block h-1 w-2/3 rounded bg-white/8"></span>
    </div>
</div>
