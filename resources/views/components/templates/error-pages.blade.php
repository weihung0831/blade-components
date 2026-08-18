@php
    $rows = [
        ['dot' => 'bg-red-400', 'w' => 'w-4/5'],
        ['dot' => 'bg-amber-400', 'w' => 'w-3/5'],
        ['dot' => 'bg-jade-500', 'w' => 'w-2/3'],
    ];
@endphp

<div class="flex h-full w-full flex-col overflow-hidden rounded-lg border border-white/10 bg-ink-950 shadow-xl shadow-black/40">
    <div class="flex items-center gap-1.5 border-b border-white/8 px-2.5 py-1.5">
        <span class="block size-2 rotate-45 border border-jade-500/60"></span>
        <span class="block h-1 w-8 rounded bg-white/15"></span>
        <span class="ml-auto flex items-center gap-1">
            <span class="size-1 rounded-full bg-red-400"></span>
            <span class="block h-1 w-6 rounded bg-white/10"></span>
        </span>
    </div>

    <div class="flex min-h-0 flex-1 gap-2.5 p-2.5">
        <span class="flex shrink-0 flex-col items-center">
            <span class="font-mono text-[26px] leading-none font-bold tracking-tighter text-white/12">404</span>
            <span class="mt-1.5 block w-px flex-1 bg-white/10"></span>
        </span>

        <span class="flex min-w-0 flex-1 flex-col gap-1.5">
            <span class="block h-0.5 w-8 rounded bg-jade-500/50"></span>
            <span class="block h-1.5 w-full rounded bg-cream/30"></span>
            <span class="block h-1.5 w-2/3 rounded bg-cream/20"></span>

            <span class="mt-1 flex flex-col gap-1 border-l border-white/10 pl-1.5">
                @foreach (['w-2/3', 'w-1/2', 'w-3/5'] as $line)
                    <span class="block h-0.5 {{ $line }} rounded bg-white/12"></span>
                @endforeach
            </span>

            <span class="mt-auto flex flex-col gap-1 rounded border border-white/8 p-1.5">
                @foreach ($rows as $row)
                    <span class="flex items-center gap-1">
                        <span class="block size-1 shrink-0 rounded-full {{ $row['dot'] }}"></span>
                        <span class="block h-0.5 {{ $row['w'] }} rounded bg-white/12"></span>
                    </span>
                @endforeach
            </span>
        </span>
    </div>
</div>
