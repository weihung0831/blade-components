<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="size-2 rounded-sm border border-jade-500/50"></span>
        <span class="block h-1 w-10 rounded bg-white/15"></span>
        <span class="ml-auto block h-1.5 w-8 rounded bg-jade-500/50"></span>
    </div>

    <div class="flex flex-1 flex-col p-2.5">
        <div class="flex items-center gap-1.5 rounded border border-white/10 bg-ink-900 px-1.5 py-1">
            <span class="size-1.5 rounded-full border border-zinc-600"></span>
            <span class="block h-1 w-2/5 rounded bg-white/10"></span>
        </div>

        <div class="mt-2 grid grid-cols-3 gap-1">
            @foreach ([true, false, false] as $lead)
                <div @class([
                    'rounded border p-1',
                    'border-jade-500/50 bg-jade-500/8' => $lead,
                    'border-white/8 bg-ink-900' => ! $lead,
                ])>
                    <span class="flex items-center gap-1">
                        <span @class(['block h-1 flex-1 rounded', 'bg-jade-400/60' => $lead, 'bg-white/12' => ! $lead])></span>
                        <span class="block h-1 w-1.5 rounded bg-white/8"></span>
                    </span>
                    <span class="mt-1 block h-0.5 rounded bg-white/6"></span>
                    <span class="mt-1 block h-0.5 w-2/3 rounded bg-white/6"></span>
                </div>
            @endforeach
        </div>

        <div class="mt-2 flex-1">
            <div class="relative border-b border-white/8 py-1.5 pl-2">
                <span class="absolute inset-y-0 left-0 w-0.5 rounded-full bg-jade-400"></span>
                <div class="flex items-center gap-1.5">
                    <span class="block h-1.5 flex-1 rounded bg-cream/40"></span>
                    <span class="block size-1.5 rotate-45 rounded-[1px] border border-jade-400"></span>
                </div>
                <span class="mt-1.5 block h-1 rounded bg-white/8"></span>
                <span class="mt-1 block h-1 w-5/6 rounded bg-white/8"></span>
                <span class="mt-1 block h-1 w-1/3 rounded bg-white/8"></span>
            </div>

            @foreach ([0.55, 0.7] as $width)
                <div class="flex items-center gap-1.5 border-b border-white/8 py-1.5 pl-2">
                    <span class="block h-1.5 rounded bg-white/12" style="width: {{ $width * 100 }}%"></span>
                    <span class="ml-auto block h-1.5 w-1.5 rounded-full bg-white/10"></span>
                </div>
            @endforeach
        </div>
    </div>
</div>
