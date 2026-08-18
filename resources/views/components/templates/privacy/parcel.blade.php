@props([
    'reference',
    'kind' => 'A copy of everything',
    'asked',
    'due',
    'steps' => [],
    'stage' => 0,
    'note' => null,
])

<article {{ $attributes->class('overflow-hidden rounded-xl border border-jade-500/25 bg-jade-500/5') }}>
    <div class="flex flex-wrap items-baseline gap-x-5 gap-y-2 border-b border-jade-500/15 px-4 py-3">
        <div class="min-w-0 flex-1">
            <p class="text-[13px] text-cream">{{ $kind }}</p>
            <p class="mt-0.5 font-mono text-[10px] text-zinc-500">{{ $reference }}</p>
        </div>

        <div class="text-right">
            <p class="font-mono text-[11px] text-jade-300">{{ $due }}</p>
            <p class="mt-0.5 font-mono text-[10px] text-zinc-600">asked {{ $asked }}</p>
        </div>
    </div>

    <ol class="flex flex-col gap-0 px-4 py-3.5 sm:flex-row sm:gap-1">
        @foreach ($steps as $index => $step)
            <li class="flex flex-1 gap-2.5 sm:block">
                <span class="flex shrink-0 flex-col items-center sm:w-full sm:flex-row sm:gap-1.5">
                    <span @class([
                        'block size-2 shrink-0 rounded-full',
                        'bg-jade-500' => $index <= $stage,
                        'border border-white/15' => $index > $stage,
                    ])></span>
                    @if (! $loop->last)
                        <span @class([
                            'block w-px flex-1 sm:h-px sm:w-auto sm:flex-1',
                            'bg-jade-500/40' => $index < $stage,
                            'bg-white/10' => $index >= $stage,
                        ])></span>
                    @endif
                </span>

                <span class="block pb-3 sm:pt-2 sm:pb-0">
                    <span @class([
                        'block text-[12px]',
                        'text-cream' => $index === $stage,
                        'text-zinc-400' => $index < $stage,
                        'text-zinc-600' => $index > $stage,
                    ])>{{ $step['label'] }}</span>
                    <span class="mt-0.5 block font-mono text-[10px] text-zinc-700">{{ $step['at'] ?? 'not yet' }}</span>
                </span>
            </li>
        @endforeach
    </ol>

    @if ($note)
        <p class="border-t border-jade-500/15 px-4 py-2.5 text-[11px]/5 text-zinc-500">{{ $note }}</p>
    @endif
</article>
