@props([
    'items' => [],
    'selected' => 0,
    'extremes' => false,
])

@php
    $control = 'grid size-6 cursor-pointer place-items-center rounded-md border border-white/10 text-zinc-400 transition-colors duration-150 hover:border-white/25 hover:text-cream';
@endphp

<div data-ui-order-list {{ $attributes->class(['flex items-center gap-2 text-[13px]']) }}>
    <div class="w-40 rounded-lg border border-white/10 bg-ink-950 p-1">
        @foreach ($items as $index => $item)
            <button type="button" data-ui-order-item @class([
                'block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left transition-colors duration-150',
                'bg-jade-500/15 text-jade-300' => $index === $selected,
                'text-zinc-400 hover:text-cream' => $index !== $selected,
            ])>{{ $item }}</button>
        @endforeach
    </div>
    <div class="flex flex-col gap-1.5">
        @if ($extremes)
            <button type="button" data-ui-order-top class="{{ $control }}">
                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M3 6 6 3l3 3M3 9.5 6 6.5l3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        @endif
        <button type="button" data-ui-order-up class="{{ $control }}">
            <svg class="size-3 -rotate-90" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <button type="button" data-ui-order-down class="{{ $control }}">
            <svg class="size-3 rotate-90" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        @if ($extremes)
            <button type="button" data-ui-order-bottom class="{{ $control }}">
                <svg class="size-3 rotate-180" viewBox="0 0 12 12" fill="none"><path d="M3 6 6 3l3 3M3 9.5 6 6.5l3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        @endif
    </div>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const root = event.target.closest('[data-ui-order-list]');

            if (!root) {
                return;
            }

            const item = event.target.closest('[data-ui-order-item]');

            if (item) {
                root.querySelectorAll('[data-ui-order-item]').forEach((row) => {
                    row.classList.remove('bg-jade-500/15', 'text-jade-300');
                    row.classList.add('text-zinc-400', 'hover:text-cream');
                });

                item.classList.add('bg-jade-500/15', 'text-jade-300');
                item.classList.remove('text-zinc-400', 'hover:text-cream');

                return;
            }

            const selected = root.querySelector('[data-ui-order-item].text-jade-300');

            if (!selected) {
                return;
            }

            if (event.target.closest('[data-ui-order-top]')) {
                selected.parentElement.prepend(selected);
            } else if (event.target.closest('[data-ui-order-up]')) {
                selected.previousElementSibling?.before(selected);
            } else if (event.target.closest('[data-ui-order-down]')) {
                selected.nextElementSibling?.after(selected);
            } else if (event.target.closest('[data-ui-order-bottom]')) {
                selected.parentElement.append(selected);
            }
        });
    </script>
@endonce
