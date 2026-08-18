<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="size-2 rounded-sm border border-jade-500/50"></span>
        <span class="block h-1 w-8 rounded bg-white/15"></span>
        <span class="ml-auto block h-1 w-6 rounded bg-white/8"></span>
    </div>

    <div class="h-0.5 w-full bg-white/5">
        <span class="block h-full w-2/5 bg-jade-500"></span>
    </div>

    <div class="flex min-h-0 flex-1">
        <div class="hidden w-2/5 shrink-0 flex-col gap-1.5 border-r border-white/8 p-2 sm:flex">
            @foreach ([['tone' => 'done'], ['tone' => 'current'], ['tone' => 'skipped'], ['tone' => 'todo'], ['tone' => 'todo']] as $step)
                <span class="flex items-start gap-1.5">
                    <span class="flex flex-col items-center pt-0.5">
                        <span @class([
                            'block size-1.5 shrink-0 rounded-full',
                            'bg-jade-500' => $step['tone'] === 'done',
                            'bg-jade-500 ring-2 ring-jade-500/25' => $step['tone'] === 'current',
                            'border border-dashed border-amber-400/60' => $step['tone'] === 'skipped',
                            'border border-white/15' => $step['tone'] === 'todo',
                        ])></span>
                        @if (! $loop->last)
                            <span @class([
                                'mt-0.5 block h-3 w-px',
                                'bg-jade-500/40' => $step['tone'] === 'done',
                                'bg-white/8' => $step['tone'] !== 'done',
                            ])></span>
                        @endif
                    </span>

                    <span class="min-w-0 flex-1">
                        <span @class([
                            'block h-1 rounded',
                            'w-2/3 bg-cream/40' => $step['tone'] === 'current',
                            'w-3/5 bg-white/20' => $step['tone'] === 'done',
                            'w-1/2 bg-amber-400/30' => $step['tone'] === 'skipped',
                            'w-1/2 bg-white/8' => $step['tone'] === 'todo',
                        ])></span>
                        <span class="mt-1 block h-0.5 w-4/5 rounded bg-white/6"></span>
                    </span>
                </span>
            @endforeach
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-2 p-2.5">
            <span class="block h-1.5 w-1/2 rounded bg-white/20"></span>

            @foreach ([true, false] as $filled)
                <span class="block">
                    <span class="block h-0.5 w-1/4 rounded bg-white/10"></span>
                    <span @class([
                        'mt-1 block h-3.5 rounded-md border bg-ink-950',
                        'border-jade-500/40' => $filled,
                        'border-white/10' => ! $filled,
                    ])></span>
                </span>
            @endforeach

            <div class="mt-auto flex items-center gap-1.5">
                <span class="block h-3 w-8 rounded-md border border-white/15"></span>
                <span class="block h-3 w-12 rounded-md bg-jade-500"></span>
                <span class="ml-auto block h-0.5 w-6 rounded bg-white/8"></span>
            </div>

            <div class="rounded-md border border-white/8 bg-ink-900 p-1.5">
                @foreach ([['w' => 'w-full', 'tone' => 'bg-jade-500'], ['w' => 'w-4/5', 'tone' => 'bg-jade-500'], ['w' => 'w-1/2', 'tone' => 'bg-amber-400/70']] as $row)
                    <span class="mt-0.5 flex items-center gap-1 first:mt-0">
                        <span class="h-0.5 flex-1 overflow-hidden rounded-full bg-white/6">
                            <span class="block h-full {{ $row['w'] }} rounded-full {{ $row['tone'] }}"></span>
                        </span>
                        <span class="block h-0.5 w-3 rounded bg-white/10"></span>
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
