@php
    $releases = [
        [
            'tone' => 'live',
            'entries' => [['tag' => 'added', 'w' => 'w-4/5'], ['tag' => 'changed', 'w' => 'w-3/5']],
        ],
        [
            'tone' => 'pulled',
            'entries' => [['tag' => 'broke', 'w' => 'w-11/12']],
        ],
        [
            'tone' => 'old',
            'entries' => [['tag' => 'fixed', 'w' => 'w-2/3'], ['tag' => 'fixed', 'w' => 'w-1/2']],
        ],
    ];

    $tags = [
        'added' => 'border-jade-500/50',
        'changed' => 'border-white/20',
        'fixed' => 'border-white/12',
        'broke' => 'border-red-400/50',
    ];
@endphp

<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="flex h-2.5 w-1 flex-col items-center justify-between">
            <span class="size-1 rounded-full border border-jade-500/60"></span>
            <span class="size-1 rounded-full border border-jade-500/60"></span>
        </span>
        <span class="block h-1 w-10 rounded bg-white/15"></span>
        <span class="ml-auto block h-2 w-6 rounded border border-white/12"></span>
    </div>

    <div class="flex min-h-0 flex-1">
        <div class="hidden w-1/4 shrink-0 flex-col gap-1.5 border-r border-white/8 p-2 sm:flex">
            @foreach ([true, false, false, false] as $current)
                <span class="flex items-center gap-1">
                    <span @class([
                        'block h-1 flex-1 rounded',
                        'bg-cream/40' => $current,
                        'bg-white/8' => ! $current,
                    ])></span>
                    <span class="block h-0.5 w-1.5 rounded bg-white/10"></span>
                </span>
            @endforeach

            <span class="mt-auto block rounded border border-white/8 bg-ink-900 p-1">
                <span class="block h-0.5 w-2/3 rounded bg-red-400/50"></span>
                <span class="mt-1 block h-0.5 w-full rounded bg-white/8"></span>
            </span>
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-2 p-2.5">
            @foreach ($releases as $release)
                <span class="flex gap-1.5">
                    <span class="flex flex-col items-center pt-1">
                        <span @class([
                            'block size-1.5 shrink-0 rounded-full',
                            'bg-jade-500' => $release['tone'] === 'live',
                            'bg-red-400' => $release['tone'] === 'pulled',
                            'bg-white/20' => $release['tone'] === 'old',
                        ])></span>
                        @if (! $loop->last)
                            <span class="mt-0.5 block w-px flex-1 bg-white/8"></span>
                        @endif
                    </span>

                    <span @class([
                        'min-w-0 flex-1 rounded-md border p-1.5',
                        'border-red-400/30 bg-red-400/4' => $release['tone'] === 'pulled',
                        'border-white/8' => $release['tone'] !== 'pulled',
                    ])>
                        <span class="flex items-center gap-1">
                            <span @class([
                                'block h-1 w-5 rounded',
                                'bg-cream/50' => $release['tone'] === 'live',
                                'bg-red-400/60' => $release['tone'] === 'pulled',
                                'bg-white/20' => $release['tone'] === 'old',
                            ])></span>
                            <span class="block h-0.5 w-3 rounded bg-white/10"></span>
                            <span class="ml-auto block h-0.5 w-2 rounded bg-white/8"></span>
                        </span>

                        @foreach ($release['entries'] as $entry)
                            <span class="mt-1.5 flex items-center gap-1">
                                <span class="block h-1.5 w-5 shrink-0 rounded-sm border {{ $tags[$entry['tag']] }}"></span>
                                <span class="block h-0.5 {{ $entry['w'] }} rounded bg-white/12"></span>
                            </span>
                        @endforeach
                    </span>
                </span>
            @endforeach
        </div>
    </div>
</div>
