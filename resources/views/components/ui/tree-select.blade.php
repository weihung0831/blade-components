@props([
    'options' => [],
    'name' => 'tree-select',
    'value' => null,
    'placeholder' => 'Select…',
    'expanded' => [],
    'disabled' => false,
])

<details data-ui-tree-select {{ $attributes->class(['group/tree relative block', 'pointer-events-none opacity-40' => $disabled]) }}>
    <summary class="flex h-10 w-full cursor-pointer list-none items-center justify-between gap-6 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm transition-colors duration-150 outline-none hover:border-white/25 focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/tree:border-jade-500 group-open/tree:before:fixed group-open/tree:before:inset-0 group-open/tree:before:z-10 group-open/tree:before:cursor-default group-open/tree:before:content-['']">
        <span data-ui-tree-value class="{{ $value !== null ? 'text-zinc-300' : 'text-zinc-600' }}">{{ $value ?? $placeholder }}</span>
        <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap group-open/tree:rotate-180" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </summary>
    <div class="absolute top-full left-0 z-20 mt-2 w-full min-w-44 rounded-lg border border-white/10 bg-ink-900 py-1.5 shadow-lg shadow-black/40">
        @foreach ($options as $branch => $leaves)
            <details class="group/branch" @if (in_array($branch, $expanded)) open @endif>
                <summary class="flex cursor-pointer list-none items-center gap-1.5 px-2.5 py-1 text-sm text-zinc-300 transition-colors duration-150 hover:text-cream [&::-webkit-details-marker]:hidden">
                    <svg class="size-3 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap group-open/branch:rotate-90" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    {{ $branch }}
                </summary>
                @foreach ($leaves as $leaf)
                    @php $leafValue = $branch.' / '.$leaf; @endphp
                    <label class="flex cursor-pointer items-center py-1 pr-2.5 pl-7 text-sm text-zinc-400 transition-colors duration-150 hover:text-cream has-[:checked]:text-jade-300">
                        <input type="radio" name="{{ $name }}" value="{{ $leafValue }}" @checked($leafValue === $value) class="sr-only">
                        {{ $leaf }}
                    </label>
                @endforeach
            </details>
        @endforeach
    </div>
</details>

@once
    <script>
        document.addEventListener('change', (event) => {
            const root = event.target.closest('[data-ui-tree-select]');

            if (!root || !event.target.matches('input[type="radio"]')) {
                return;
            }

            const value = root.querySelector('[data-ui-tree-value]');

            value.textContent = event.target.value;
            value.classList.remove('text-zinc-600');
            value.classList.add('text-zinc-300');

            root.removeAttribute('open');
        });
    </script>
@endonce
