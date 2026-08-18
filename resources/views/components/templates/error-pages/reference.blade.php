@props([
    'id',
    'when',
    'region' => null,
    'build' => null,
    'note' => null,
    'tone' => 'quiet',
])

@php
    $rows = array_values(array_filter([
        ['label' => 'reference', 'value' => $id],
        ['label' => 'happened', 'value' => $when],
        $region ? ['label' => 'served from', 'value' => $region] : null,
        $build ? ['label' => 'running', 'value' => $build] : null,
    ]));

    $copy = implode('  ', array_map(fn (array $row): string => $row['label'].': '.$row['value'], $rows));
@endphp

<div data-reference {{ $attributes->class([
    'overflow-hidden rounded-xl border bg-ink-900',
    'border-red-400/25' => $tone === 'fault',
    'border-white/8' => $tone !== 'fault',
]) }}>
    <div class="flex items-center gap-3 border-b border-white/5 px-3.5 py-2">
        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What to quote</p>

        <button type="button" data-reference-copy data-copy="{{ $copy }}"
            class="ml-auto inline-flex items-center gap-1.5 rounded-lg border border-white/10 px-2 py-1 font-mono text-[10px] text-zinc-400 transition-colors duration-150 outline-none hover:border-jade-500/60 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
            <svg class="size-3" viewBox="0 0 16 16" fill="none"><rect x="5.5" y="5.5" width="8" height="8" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M10.5 5.5v-1a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h1" stroke="currentColor" stroke-width="1.3"/></svg>
            <span data-reference-label>copy all four</span>
        </button>
    </div>

    <dl class="divide-y divide-white/5">
        @foreach ($rows as $row)
            <div class="flex items-baseline gap-3 px-3.5 py-2">
                <dt class="w-24 shrink-0 font-mono text-[10px] text-zinc-700">{{ $row['label'] }}</dt>
                <dd class="min-w-0 flex-1 font-mono text-[11px] break-all text-zinc-300">{{ $row['value'] }}</dd>
            </div>
        @endforeach
    </dl>

    @if ($note)
        <p class="border-t border-white/5 px-3.5 py-2.5 text-[11px]/5 text-zinc-600">{{ $note }}</p>
    @endif
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-reference-copy]');

            if (!button) {
                return;
            }

            const label = button.querySelector('[data-reference-label]');
            const was = label.textContent;

            navigator.clipboard?.writeText(button.dataset.copy);
            label.textContent = 'on your clipboard';
            setTimeout(() => (label.textContent = was), 1600);
        });
    </script>
@endonce
