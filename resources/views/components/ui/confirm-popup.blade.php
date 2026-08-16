@props([
    'title',
    'description' => null,
    'confirm' => 'Confirm',
    'cancel' => 'Cancel',
    'variant' => 'danger',
    'position' => 'bottom',
])

@php
    $variants = [
        'danger' => [
            'chip' => 'bg-red-500/15 text-red-400',
            'button' => 'border border-red-500/20 bg-red-500/10 text-red-400 hover:bg-red-500/20',
        ],
        'primary' => [
            'chip' => 'bg-jade-500/15 text-jade-400',
            'button' => 'bg-jade-500 text-ink-950 hover:bg-jade-400',
        ],
    ];

    $positions = [
        'bottom' => 'top-full left-0 mt-2',
        'bottom-end' => 'top-full right-0 mt-2',
        'top' => 'bottom-full left-0 mb-2',
    ];

    $style = $variants[$variant] ?? $variants['danger'];
@endphp

<details {{ $attributes->class(['group/confirm relative inline-block']) }} name="ui-confirm-popup">
    <summary class="inline-block cursor-pointer list-none rounded-lg outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/confirm:before:fixed group-open/confirm:before:inset-0 group-open/confirm:before:cursor-default group-open/confirm:before:content-['']">{{ $trigger }}</summary>
    <div role="alertdialog" class="absolute z-10 w-64 rounded-xl border border-white/10 bg-ink-900 p-3.5 shadow-lg shadow-black/40 {{ $positions[$position] ?? $positions['bottom'] }}">
        <div class="flex items-start gap-2.5">
            <span class="grid size-5 shrink-0 place-items-center rounded-full {{ $style['chip'] }}">
                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="M6 2.8v3.9M6 9.2v.2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
            </span>
            <div class="min-w-0">
                <p class="text-sm font-medium text-zinc-200">{{ $title }}</p>
                @if ($description)
                    <p class="mt-0.5 text-xs/5 text-zinc-500">{{ $description }}</p>
                @endif
            </div>
        </div>
        <div class="mt-3 flex justify-end gap-2">
            <button type="button" data-ui-confirm-cancel class="h-7 rounded-md px-2.5 text-xs font-medium text-zinc-400 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">{{ $cancel }}</button>
            <button type="button" data-ui-confirm-accept class="h-7 rounded-md px-2.5 text-xs font-medium transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 {{ $style['button'] }}">{{ $confirm }}</button>
        </div>
    </div>
</details>

@once
    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-ui-confirm-cancel], [data-ui-confirm-accept]');

            if (!button) {
                return;
            }

            const popup = button.closest('details');
            popup.removeAttribute('open');

            if (button.matches('[data-ui-confirm-accept]')) {
                popup.dispatchEvent(new CustomEvent('ui-confirm', { bubbles: true }));
            }
        });
    </script>
@endonce
