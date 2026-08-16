@props([
    'options' => [],
    'name' => 'cascade-select',
    'value' => null,
    'placeholder' => 'Select…',
    'disabled' => false,
])

<details data-ui-cascade-select {{ $attributes->class(['group/cascade relative block', 'pointer-events-none opacity-40' => $disabled]) }}>
    <summary class="flex h-10 w-full cursor-pointer list-none items-center justify-between gap-6 rounded-lg border border-white/10 bg-ink-950 px-3 text-sm transition-colors duration-150 outline-none hover:border-white/25 focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/cascade:border-jade-500 group-open/cascade:before:fixed group-open/cascade:before:inset-0 group-open/cascade:before:z-10 group-open/cascade:before:cursor-default group-open/cascade:before:content-['']">
        <span data-ui-cascade-value class="{{ $value !== null ? 'text-zinc-300' : 'text-zinc-600' }}">{{ $value ?? $placeholder }}</span>
        <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap group-open/cascade:rotate-180" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </summary>
    <div class="absolute top-full left-0 z-20 mt-2 min-w-44 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
        @foreach ($options as $group => $items)
            <details class="group/branch relative" name="{{ $name }}-branch">
                <summary class="flex cursor-pointer list-none items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm text-zinc-300 transition-colors duration-150 hover:bg-white/5 hover:text-cream [&::-webkit-details-marker]:hidden group-open/branch:bg-white/5 group-open/branch:text-cream">
                    {{ $group }}
                    <svg class="size-3 shrink-0 text-zinc-500" viewBox="0 0 12 12" fill="none"><path d="M4.5 3 7.5 6l-3 3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </summary>
                <div class="absolute top-0 left-full z-30 ml-1 min-w-36 rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
                    @foreach ($items as $item)
                        <label class="flex cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream has-[:checked]:bg-jade-500/15 has-[:checked]:text-jade-300">
                            {{ $item }}
                            <input type="radio" name="{{ $name }}" value="{{ $item }}" @checked($item === $value) class="peer sr-only">
                            <svg class="size-3 shrink-0 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </label>
                    @endforeach
                </div>
            </details>
        @endforeach
    </div>
</details>

@once
    <script>
        document.addEventListener('change', (event) => {
            const root = event.target.closest('[data-ui-cascade-select]');

            if (!root || !event.target.matches('input[type="radio"]')) {
                return;
            }

            const value = root.querySelector('[data-ui-cascade-value]');

            value.textContent = event.target.value;
            value.classList.remove('text-zinc-600');
            value.classList.add('text-zinc-300');

            root.querySelectorAll('details[open]').forEach((details) => details.removeAttribute('open'));
        });
    </script>
@endonce
