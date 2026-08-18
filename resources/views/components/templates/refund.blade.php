<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="size-2 rounded-sm border border-jade-500/50"></span>
        <span class="block h-1 w-8 rounded bg-white/15"></span>
        <span class="ml-auto block h-1.5 w-9 rounded bg-jade-500/60"></span>
    </div>

    <div class="flex min-h-0 flex-1">
        <div class="hidden w-1/4 shrink-0 flex-col gap-1.5 border-r border-white/8 p-2 sm:flex">
            @foreach ([true, false, false, false] as $lead)
                <span class="flex items-center gap-1">
                    <span @class(['block h-0.5 flex-1 rounded', 'bg-cream/40' => $lead, 'bg-white/8' => ! $lead])></span>
                    <span class="block h-0.5 w-2 rounded bg-white/15"></span>
                </span>
            @endforeach

            <span class="mt-1 block h-px w-full bg-white/5"></span>

            @foreach (range(1, 3) as $tick)
                <span class="block h-0.5 w-2/3 rounded bg-white/6"></span>
            @endforeach
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-1.5 p-2.5">
            @foreach ([['w' => 'w-2/5', 'tone' => 'bg-jade-500'], ['w' => 'w-1/3', 'tone' => 'bg-jade-500'], ['w' => 'w-1/2', 'tone' => 'bg-white/25'], ['w' => 'w-1/4', 'tone' => 'bg-amber-400/70']] as $row)
                <div class="flex items-center gap-2">
                    <span class="min-w-0 flex-1">
                        <span class="block h-1 {{ $row['w'] }} rounded bg-white/15"></span>
                        <span class="mt-1 block h-0.5 rounded bg-white/8"></span>
                    </span>
                    <span class="flex shrink-0 items-center gap-1">
                        <span class="block size-1 rounded-full {{ $row['tone'] }}"></span>
                        <span class="block h-0.5 w-5 rounded bg-white/10"></span>
                    </span>
                </div>
            @endforeach

            <div class="mt-auto rounded-md border border-jade-500/25 bg-jade-500/8 p-1.5">
                <div class="flex items-center justify-between">
                    <span class="block h-1.5 w-12 rounded bg-jade-500/50"></span>
                    <span class="block h-1 w-6 rounded bg-white/12"></span>
                </div>
                <div class="mt-1.5 flex items-center gap-0.5">
                    @foreach ([true, true, true, false, false] as $done)
                        <span @class(['block size-1 shrink-0 rounded-full', 'bg-jade-500' => $done, 'bg-white/12' => ! $done])></span>
                        @if (! $loop->last)
                            <span @class(['block h-px flex-1', 'bg-jade-500/40' => $done, 'bg-white/8' => ! $done])></span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
