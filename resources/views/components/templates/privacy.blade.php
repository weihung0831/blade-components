<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="size-2 rounded-full border border-jade-500/50"></span>
        <span class="block h-1 w-8 rounded bg-white/15"></span>
        <span class="ml-auto block h-1.5 w-8 rounded border border-white/12"></span>
    </div>

    <div class="flex min-h-0 flex-1">
        <div class="hidden w-1/4 shrink-0 flex-col gap-1.5 border-r border-white/8 p-2 sm:flex">
            @foreach ([true, false, false, false, false] as $lead)
                <span class="flex items-center gap-1">
                    <span @class(['block h-0.5 flex-1 rounded', 'bg-cream/40' => $lead, 'bg-white/8' => ! $lead])></span>
                    <span class="block size-0.5 rounded-full bg-white/15"></span>
                </span>
            @endforeach

            <span class="mt-1 block h-px w-full bg-white/5"></span>

            @foreach (range(1, 3) as $tick)
                <span class="block h-0.5 w-2/3 rounded bg-white/6"></span>
            @endforeach
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-1.5 p-2.5">
            @foreach ([['w' => 'w-1/3', 'fill' => 'w-2/3', 'tone' => 'bg-jade-500'], ['w' => 'w-2/5', 'fill' => 'w-1/4', 'tone' => 'bg-jade-500'], ['w' => 'w-1/4', 'fill' => 'w-full', 'tone' => 'bg-amber-400/70'], ['w' => 'w-1/3', 'fill' => 'w-1/2', 'tone' => 'bg-white/20']] as $row)
                <div class="flex items-start gap-2">
                    <span class="min-w-0 flex-1">
                        <span class="block h-1 {{ $row['w'] }} rounded bg-white/15"></span>
                        <span class="mt-1 block h-0.5 rounded bg-white/8"></span>
                    </span>
                    <span class="mt-0.5 block w-8 shrink-0 overflow-hidden rounded-full bg-white/8">
                        <span class="block h-1 {{ $row['fill'] }} rounded-full {{ $row['tone'] }}"></span>
                    </span>
                </div>
            @endforeach

            <div class="mt-auto flex items-center gap-1.5 rounded-md border border-white/10 bg-ink-800 px-1.5 py-1.5">
                <span class="block h-1 flex-1 rounded bg-white/12"></span>
                <span class="block h-2.5 w-6 rounded border border-white/20"></span>
                <span class="block h-2.5 w-6 rounded bg-jade-500"></span>
            </div>
        </div>
    </div>
</div>
