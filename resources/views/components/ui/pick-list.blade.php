@props([
    'available' => [],
    'selected' => [],
    'availableLabel' => null,
    'selectedLabel' => null,
    'all' => false,
])

@php
    $control = 'grid size-6 cursor-pointer place-items-center rounded-md border border-white/10 text-zinc-400 transition-colors duration-150 hover:border-white/25 hover:text-cream';
    $item = 'block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left text-zinc-400 transition-colors duration-150 hover:text-cream';
@endphp

<div data-ui-pick-list {{ $attributes->class(['flex items-center gap-2 text-[13px]']) }}>
    <div class="flex flex-col gap-1.5">
        @if ($availableLabel !== null)
            <span class="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{{ $availableLabel }}</span>
        @endif
        <div data-ui-pick-source class="min-h-24 w-36 rounded-lg border border-white/10 bg-ink-950 p-1">
            @foreach ($available as $entry)
                <button type="button" data-ui-pick-item class="{{ $item }}">{{ $entry }}</button>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col gap-1.5 text-zinc-400">
        <button type="button" data-ui-pick-add class="{{ $control }}">
            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button type="button" data-ui-pick-remove class="{{ $control }}">
            <svg class="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        @if ($all)
            <button type="button" data-ui-pick-add-all class="{{ $control }}">
                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M2.5 3 5.5 6l-3 3M6.5 3 9.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" data-ui-pick-remove-all class="{{ $control }}">
                <svg class="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M2.5 3 5.5 6l-3 3M6.5 3 9.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        @endif
    </div>
    <div class="flex flex-col gap-1.5">
        @if ($selectedLabel !== null)
            <span class="font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{{ $selectedLabel }}</span>
        @endif
        <div data-ui-pick-target class="min-h-24 w-36 rounded-lg border border-white/10 bg-ink-950 p-1">
            @foreach ($selected as $entry)
                <button type="button" data-ui-pick-item class="{{ $item }}">{{ $entry }}</button>
            @endforeach
        </div>
    </div>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const root = event.target.closest('[data-ui-pick-list]');

            if (!root) {
                return;
            }

            const item = event.target.closest('[data-ui-pick-item]');

            if (item) {
                const active = item.classList.contains('text-jade-300');

                item.classList.remove('bg-jade-500/15', 'text-jade-300', 'text-zinc-400', 'hover:text-cream');
                item.classList.add(...(active ? ['text-zinc-400', 'hover:text-cream'] : ['bg-jade-500/15', 'text-jade-300']));

                return;
            }

            const move = (from, to, onlySelected) => {
                const target = root.querySelector(`[data-ui-pick-${to}]`);

                root.querySelectorAll(`[data-ui-pick-${from}] [data-ui-pick-item]`).forEach((row) => {
                    if (onlySelected && !row.classList.contains('text-jade-300')) {
                        return;
                    }

                    row.classList.remove('bg-jade-500/15', 'text-jade-300');
                    row.classList.add('text-zinc-400', 'hover:text-cream');
                    target.append(row);
                });
            };

            if (event.target.closest('[data-ui-pick-add]')) {
                move('source', 'target', true);
            } else if (event.target.closest('[data-ui-pick-remove]')) {
                move('target', 'source', true);
            } else if (event.target.closest('[data-ui-pick-add-all]')) {
                move('source', 'target', false);
            } else if (event.target.closest('[data-ui-pick-remove-all]')) {
                move('target', 'source', false);
            }
        });
    </script>
@endonce
