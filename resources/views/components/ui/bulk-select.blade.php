@props([
    'items' => [],
    'label' => 'Name',
    'selected' => [],
    'actions' => [],
])

@php
    $normalized = collect($items)->map(fn ($item) => is_array($item) ? $item : ['label' => $item]);
    $checked = $normalized->filter(fn ($item) => in_array($item['label'], $selected, true))->count();
@endphp

<div data-ui-bulk-select {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-white/10 bg-ink-950']) }}>
    <div data-ui-bulk-bar @class(['flex items-center justify-between bg-jade-500/10 px-4 py-2 text-[13px]', 'hidden' => $checked === 0])>
        <span data-ui-bulk-count class="text-jade-300">{{ $checked }} selected</span>
        <span class="flex gap-3 font-medium">
            @foreach ($actions as $action)
                <button type="button" @class(['cursor-pointer transition-colors duration-150', 'text-red-400 hover:text-red-300' => $action['danger'] ?? false, 'text-zinc-400 hover:text-cream' => ! ($action['danger'] ?? false)])>{{ $action['label'] }}</button>
            @endforeach
        </span>
    </div>
    <label class="flex cursor-pointer items-center gap-3 bg-ink-800 px-4 py-2.5">
        <span class="relative grid size-4 shrink-0 place-items-center">
            <input data-ui-bulk-all type="checkbox" @checked($checked > 0 && $checked === $normalized->count())
                class="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 indeterminate:border-jade-500 indeterminate:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
            <svg class="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <svg class="pointer-events-none absolute size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-indeterminate:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M3 6h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        </span>
        <span class="font-mono text-[11px] tracking-wider text-zinc-500 uppercase">{{ $label }}</span>
    </label>
    @foreach ($normalized as $item)
        <label class="flex cursor-pointer items-center gap-3 border-t border-white/5 px-4 py-2.5 text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/3 has-[:checked]:bg-jade-500/8 has-[:checked]:text-zinc-200">
            <span class="relative grid size-4 shrink-0 place-items-center">
                <input data-ui-bulk-row type="checkbox" value="{{ $item['label'] }}" @checked(in_array($item['label'], $selected, true))
                    class="peer absolute inset-0 cursor-pointer appearance-none rounded border border-white/15 bg-ink-950 transition-colors duration-200 ease-snap outline-none checked:border-jade-500 checked:bg-jade-500 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                <svg class="pointer-events-none relative size-2.5 text-ink-950 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <span class="flex-1 truncate">{{ $item['label'] }}</span>
            @if (isset($item['meta']))
                <span class="font-mono text-xs text-zinc-600">{{ $item['meta'] }}</span>
            @endif
        </label>
    @endforeach
</div>

@once
    <script>
        (() => {
            const sync = (root) => {
                const all = root.querySelector('[data-ui-bulk-all]');
                const rows = [...root.querySelectorAll('[data-ui-bulk-row]')];
                const count = rows.filter((row) => row.checked).length;

                all.checked = count > 0 && count === rows.length;
                all.indeterminate = count > 0 && count < rows.length;
                root.querySelector('[data-ui-bulk-bar]').classList.toggle('hidden', count === 0);
                root.querySelector('[data-ui-bulk-count]').textContent = `${count} selected`;
            };

            document.addEventListener('change', (event) => {
                const root = event.target.closest('[data-ui-bulk-select]');

                if (!root || !event.target.matches('input[type="checkbox"]')) {
                    return;
                }

                if (event.target.matches('[data-ui-bulk-all]')) {
                    root.querySelectorAll('[data-ui-bulk-row]').forEach((row) => (row.checked = event.target.checked));
                }

                sync(root);
            });

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('[data-ui-bulk-select]').forEach(sync);
            });
        })();
    </script>
@endonce
