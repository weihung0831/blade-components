<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="size-2 rounded-sm border border-jade-500/50"></span>
        <span class="block h-1 w-8 rounded bg-white/15"></span>
        <span class="ml-auto block h-1.5 w-7 rounded bg-jade-500/50"></span>
    </div>

    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="block h-1.5 w-6 rounded border border-amber-400/40 bg-amber-400/15"></span>
        <span class="relative block h-0.5 flex-1 rounded-full bg-white/8">
            <span class="absolute inset-y-0 left-[40%] w-[38%] rounded-full bg-white/20"></span>
            <span class="absolute -top-1 -bottom-1 left-[18%] w-px bg-cream"></span>
        </span>
    </div>

    <div class="flex flex-1 flex-col gap-1.5 p-2.5">
        <div class="grid grid-cols-2 gap-1.5">
            @foreach ([true, false, false, false] as $lead)
                <div @class([
                    'rounded border p-1.5',
                    'border-jade-500/50 bg-jade-500/8' => $lead,
                    'border-white/8 bg-ink-900' => ! $lead,
                ])>
                    <span class="flex items-center gap-1">
                        <span @class(['block h-1 flex-1 rounded', 'bg-jade-400/60' => $lead, 'bg-white/12' => ! $lead])></span>
                        <span @class(['block size-1 rounded-full', 'bg-jade-400' => $lead, 'bg-white/12' => ! $lead])></span>
                    </span>
                    <span class="mt-1 block h-0.5 rounded bg-white/6"></span>
                    <span class="mt-1.5 flex items-center gap-1">
                        <span class="block h-1.5 w-3 rounded bg-cream/35"></span>
                        <span class="ml-auto block h-0.5 w-4 rounded bg-white/8"></span>
                    </span>
                </div>
            @endforeach
        </div>

        <div class="mt-auto flex gap-1.5 rounded border border-white/8 bg-ink-900 p-1.5">
            <span class="block h-6 flex-1 rounded border border-white/10 bg-ink-950"></span>
            <span class="flex w-1/3 flex-col justify-end gap-1">
                <span class="block h-0.5 rounded bg-white/8"></span>
                <span class="block h-0.5 w-2/3 rounded bg-white/8"></span>
                <span class="block h-2 rounded bg-jade-500"></span>
            </span>
        </div>
    </div>
</div>
