@props([
    'id',
    'title',
    'description' => null,
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-xl',
    ];
@endphp

<dialog id="{{ $id }}" data-ui-modal
    {{ $attributes->merge(['class' => 'm-auto w-[calc(100%-2.5rem)] scale-95 rounded-2xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-300 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/70 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-300 open:backdrop:opacity-100 starting:open:backdrop:opacity-0 '.($sizes[$size] ?? $sizes['md'])]) }}>
    <div class="p-5">
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
                <h2 class="text-base font-semibold tracking-tight text-cream">{{ $title }}</h2>
                @if ($description)
                    <p class="mt-1 text-sm/6 text-zinc-500">{{ $description }}</p>
                @endif
            </div>
            <button type="button" data-ui-modal-close aria-label="Close" class="grid size-6 shrink-0 place-items-center rounded-md text-zinc-600 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
                <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" /></svg>
            </button>
        </div>
        @if ($slot->isNotEmpty())
            <div class="mt-4 text-sm/6 text-zinc-400">{{ $slot }}</div>
        @endif
    </div>
    @isset($footer)
        <div class="flex justify-end gap-2 border-t border-white/5 px-5 py-4">{{ $footer }}</div>
    @endisset
</dialog>

@once
    <script>
        document.addEventListener('click', (event) => {
            const trigger = event.target.closest('[data-ui-modal-target]');

            if (trigger) {
                return document.getElementById(trigger.dataset.uiModalTarget).showModal();
            }

            const close = event.target.closest('[data-ui-modal-close]');

            if (close) {
                return close.closest('dialog').close();
            }

            if (event.target.matches('[data-ui-modal]')) {
                event.target.close();
            }
        });
    </script>
@endonce
