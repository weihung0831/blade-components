@props([
    'id',
    'variant' => 'success',
    'title',
    'description' => null,
    'duration' => 4000,
    'position' => 'bottom-right',
])

@php
    $variants = [
        'success' => [
            'chip' => 'bg-jade-500/15 text-jade-400',
            'mark' => 'M2.5 6.5 5 9l4.5-6',
        ],
        'danger' => [
            'chip' => 'bg-red-500/15 text-red-400',
            'mark' => 'm3.5 3.5 5 5M8.5 3.5l-5 5',
        ],
        'warning' => [
            'chip' => 'bg-amber-400/15 text-amber-400',
            'mark' => 'M6 2.8v3.9M6 9.2v.2',
        ],
        'neutral' => [
            'chip' => 'bg-white/10 text-zinc-300',
            'mark' => 'M6 5.4v3.8M6 3v.2',
        ],
    ];

    $positions = [
        'bottom-right' => 'right-5 bottom-5 translate-y-2 data-[open]:translate-y-0',
        'bottom-left' => 'left-5 bottom-5 translate-y-2 data-[open]:translate-y-0',
        'top-right' => 'top-5 right-5 -translate-y-2 data-[open]:translate-y-0',
        'top-center' => 'top-5 left-1/2 -translate-x-1/2 -translate-y-2 data-[open]:translate-y-0',
    ];

    $style = $variants[$variant] ?? $variants['success'];
@endphp

<div id="{{ $id }}" data-ui-toast data-duration="{{ $duration }}" role="status"
    {{ $attributes->merge(['class' => 'pointer-events-none fixed z-50 flex w-80 items-start gap-3 rounded-xl border border-white/10 bg-ink-800 p-3.5 opacity-0 shadow-lg shadow-black/40 transition-[opacity,translate] duration-300 ease-snap data-[open]:pointer-events-auto data-[open]:opacity-100 '.($positions[$position] ?? $positions['bottom-right'])]) }}>
    <span class="grid size-5 shrink-0 place-items-center rounded-full {{ $style['chip'] }}">
        <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="{{ $style['mark'] }}" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
    </span>
    <div class="min-w-0 flex-1">
        <p class="text-sm font-medium text-zinc-200">{{ $title }}</p>
        @if ($description)
            <p class="mt-0.5 text-xs/5 text-zinc-500">{{ $description }}</p>
        @endif
        @isset($action)
            <div class="mt-2">{{ $action }}</div>
        @endisset
    </div>
    <button type="button" data-ui-toast-close aria-label="Dismiss" class="grid size-5 shrink-0 place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
        <svg class="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" /></svg>
    </button>
</div>

@once
    <script>
        const uiToastTimers = new Map();

        const uiToastHide = (toast) => {
            toast.removeAttribute('data-open');
            clearTimeout(uiToastTimers.get(toast));
        };

        document.addEventListener('click', (event) => {
            const close = event.target.closest('[data-ui-toast-close]');

            if (close) {
                return uiToastHide(close.closest('[data-ui-toast]'));
            }

            const trigger = event.target.closest('[data-ui-toast-target]');

            if (!trigger) {
                return;
            }

            const toast = document.getElementById(trigger.dataset.uiToastTarget);
            const duration = Number(toast.dataset.duration);

            toast.setAttribute('data-open', '');
            clearTimeout(uiToastTimers.get(toast));

            if (duration > 0) {
                uiToastTimers.set(toast, setTimeout(() => toast.removeAttribute('data-open'), duration));
            }
        });
    </script>
@endonce
