@props([
    'options' => [],
    'variant' => 'outline',
])

@php
    $variants = [
        'outline' => 'border border-white/10 bg-ink-950 hover:border-white/25 focus:border-jade-500',
        'filled' => 'border border-transparent bg-ink-800 hover:bg-white/5 focus:border-jade-500',
    ];

    $classes = 'h-10 w-full rounded-lg px-3 text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 disabled:pointer-events-none disabled:opacity-40 '.($variants[$variant] ?? $variants['outline']);
@endphp

<div data-ui-autocomplete class="relative block">
    <input type="text" autocomplete="off" {{ $attributes->merge(['class' => $classes]) }}>
    <div data-ui-autocomplete-panel class="absolute top-full left-0 z-20 mt-2 hidden w-full min-w-max rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
        @foreach ($options as $option)
            <button type="button" data-ui-autocomplete-option class="block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream">{{ $option }}</button>
        @endforeach
    </div>
</div>

@once
    <script>
        const uiAutocompleteFilter = (root) => {
            const query = root.querySelector('input').value.trim().toLowerCase();
            const panel = root.querySelector('[data-ui-autocomplete-panel]');
            let visible = 0;

            panel.querySelectorAll('[data-ui-autocomplete-option]').forEach((option) => {
                const match = option.textContent.trim().toLowerCase().includes(query);

                option.classList.toggle('hidden', !match);

                if (match) {
                    visible++;
                }
            });

            panel.classList.toggle('hidden', visible === 0);
        };

        const uiAutocompleteCloseAll = (except = null) => {
            document.querySelectorAll('[data-ui-autocomplete]').forEach((root) => {
                if (root !== except) {
                    root.querySelector('[data-ui-autocomplete-panel]').classList.add('hidden');
                }
            });
        };

        document.addEventListener('input', (event) => {
            const root = event.target.closest('[data-ui-autocomplete]');

            if (root && event.target.matches('input')) {
                uiAutocompleteFilter(root);
            }
        });

        document.addEventListener('focusin', (event) => {
            const root = event.target.closest('[data-ui-autocomplete]');

            if (root && event.target.matches('input')) {
                uiAutocompleteCloseAll(root);
                uiAutocompleteFilter(root);
            }
        });

        document.addEventListener('click', (event) => {
            const option = event.target.closest('[data-ui-autocomplete-option]');

            if (option) {
                const root = option.closest('[data-ui-autocomplete]');
                const input = root.querySelector('input');

                input.value = option.textContent.trim();
                root.querySelector('[data-ui-autocomplete-panel]').classList.add('hidden');
                input.dispatchEvent(new Event('change', { bubbles: true }));

                return;
            }

            uiAutocompleteCloseAll(event.target.closest('[data-ui-autocomplete]'));
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                uiAutocompleteCloseAll();
            }
        });
    </script>
@endonce
