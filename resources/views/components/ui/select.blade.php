@props([
    'options' => [],
    'name' => 'select',
    'value' => null,
    'placeholder' => 'Select…',
    'variant' => 'outline',
    'size' => 'md',
    'disabled' => false,
])

@php
    $triggers = [
        'outline' => 'border border-white/10 bg-ink-950 hover:border-white/25 group-open/select:border-jade-500',
        'filled' => 'border border-transparent bg-ink-800 hover:bg-white/5 group-open/select:border-jade-500',
        'invalid' => 'border border-red-400/60 bg-ink-950 group-open/select:border-red-400',
    ];

    $sizes = [
        'sm' => 'h-8 px-2.5 text-xs',
        'md' => 'h-10 px-3 text-sm',
    ];

    $trigger = ($triggers[$variant] ?? $triggers['outline']).' '.($sizes[$size] ?? $sizes['md']);
@endphp

<details data-ui-select {{ $attributes->class(['group/select relative block', 'pointer-events-none opacity-40' => $disabled]) }}>
    <summary class="flex w-full cursor-pointer list-none items-center justify-between gap-6 rounded-lg transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/select:before:fixed group-open/select:before:inset-0 group-open/select:before:z-10 group-open/select:before:cursor-default group-open/select:before:content-[''] {{ $trigger }}">
        <span data-ui-select-value class="truncate {{ $value !== null ? 'text-zinc-300' : 'text-zinc-600' }}">{{ $value ?? $placeholder }}</span>
        <svg class="size-3.5 shrink-0 text-zinc-500 transition-transform duration-150 ease-snap group-open/select:rotate-180" viewBox="0 0 16 16" fill="none"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </summary>
    <div class="absolute top-full left-0 z-20 mt-2 w-full min-w-max rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40 group-data-[drop=up]/select:top-auto group-data-[drop=up]/select:bottom-full group-data-[drop=up]/select:mt-0 group-data-[drop=up]/select:mb-2">
        @foreach ($options as $option)
            <label class="flex cursor-pointer items-center justify-between gap-6 rounded-md px-2.5 py-1.5 text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream has-[:checked]:bg-jade-500/15 has-[:checked]:text-jade-300">
                {{ $option }}
                <input type="radio" name="{{ $name }}" value="{{ $option }}" @checked($option === $value) class="peer sr-only">
                <svg class="size-3 shrink-0 opacity-0 transition-opacity duration-150 peer-checked:opacity-100" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.5 5 9l4.5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </label>
        @endforeach
    </div>
</details>

@once
    <script>
        const selectClipper = (element) => {
            let parent = element.parentElement;

            while (parent && parent !== document.body) {
                if (/(auto|scroll|hidden)/.test(getComputedStyle(parent).overflowY)) {
                    return parent;
                }

                parent = parent.parentElement;
            }

            return null;
        };

        document.addEventListener('toggle', (event) => {
            const root = event.target;

            if (!(root instanceof HTMLElement) || !root.matches('[data-ui-select]')) {
                return;
            }

            if (!root.open) {
                delete root.dataset.drop;

                return;
            }

            const clipper = selectClipper(root);
            const bounds = clipper ? clipper.getBoundingClientRect() : { top: 0, bottom: window.innerHeight };
            const trigger = root.getBoundingClientRect();
            const needed = root.lastElementChild.offsetHeight + 8;

            if (bounds.bottom - trigger.bottom < needed && trigger.top - bounds.top > needed) {
                root.dataset.drop = 'up';
            } else {
                delete root.dataset.drop;
            }
        }, true);

        document.addEventListener('change', (event) => {
            const root = event.target.closest('[data-ui-select]');

            if (!root || !event.target.matches('input[type="radio"]')) {
                return;
            }

            const value = root.querySelector('[data-ui-select-value]');

            value.textContent = event.target.value;
            value.classList.remove('text-zinc-600');
            value.classList.add('text-zinc-300');

            root.removeAttribute('open');
        });
    </script>
@endonce
