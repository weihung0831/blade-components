<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="size-2 rounded-sm border border-jade-500/50"></span>
        <span class="block h-1 w-8 rounded bg-white/15"></span>
        <span class="ml-auto block h-1.5 w-6 rounded border border-amber-400/40 bg-amber-400/15"></span>
    </div>

    <div class="flex min-h-0 flex-1">
        <div class="hidden w-1/4 shrink-0 flex-col gap-1.5 border-r border-white/8 p-2 sm:flex">
            @foreach ([true, false, false, false, false] as $lead)
                <span class="flex items-center gap-1">
                    <span class="block h-0.5 w-1.5 rounded bg-white/12"></span>
                    <span @class(['block h-0.5 flex-1 rounded', 'bg-cream/40' => $lead, 'bg-white/8' => ! $lead])></span>
                </span>
            @endforeach
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-2 p-2.5">
            @foreach ([false, true, false] as $changed)
                <div class="flex gap-1.5">
                    <span class="mt-0.5 block h-1 w-1.5 shrink-0 rounded bg-white/12"></span>
                    <span class="min-w-0 flex-1">
                        <span class="flex items-center gap-1">
                            <span class="block h-1 w-1/2 rounded bg-white/15"></span>
                            @if ($changed)
                                <span class="block h-1 w-3 rounded bg-jade-500/50"></span>
                            @endif
                        </span>
                        <span class="mt-1 block h-0.5 rounded bg-white/8"></span>
                        <span class="mt-1 block h-0.5 w-4/5 rounded bg-white/8"></span>
                        <span class="mt-1 flex gap-1">
                            <span class="block w-px self-stretch bg-jade-500/50"></span>
                            <span class="block h-0.5 w-2/3 self-center rounded bg-white/8"></span>
                        </span>
                    </span>
                </div>
            @endforeach

            <div class="mt-auto overflow-hidden rounded border border-white/8">
                <span class="flex items-center gap-1 bg-red-400/8 px-1.5 py-1">
                    <span class="block h-0.5 w-1 rounded bg-red-400/70"></span>
                    <span class="block h-0.5 w-2/3 rounded bg-white/10"></span>
                </span>
                <span class="flex items-center gap-1 bg-jade-500/10 px-1.5 py-1">
                    <span class="block h-0.5 w-1 rounded bg-jade-400"></span>
                    <span class="block h-0.5 w-5/6 rounded bg-white/15"></span>
                </span>
            </div>
        </div>
    </div>
</div>
