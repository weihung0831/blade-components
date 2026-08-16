@props([
    'variant' => 'overlay',
    'label' => 'Loading',
    'fixed' => false,
    'autoHide' => false,
])

<div data-ui-page-loader @if ($autoHide) data-auto-hide @endif role="status" aria-live="polite"
    {{ $attributes->class([
        $fixed ? 'fixed' : 'absolute',
        'inset-0 z-50 overflow-hidden transition-opacity duration-300 data-hidden:pointer-events-none data-hidden:opacity-0',
        'grid place-items-center bg-ink-950/85 backdrop-blur-sm' => $variant === 'overlay',
        'pointer-events-none h-0.5' => $variant !== 'overlay',
    ]) }}>
    <span class="absolute top-0 left-0 h-0.5 w-2/5 rounded-full bg-jade-500 animate-[ui-page-loader-slide_1.6s_ease-in-out_infinite]"></span>

    @if ($variant === 'overlay')
        <div class="flex flex-col items-center gap-3">
            <svg class="size-6 animate-spin text-jade-500" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="2" class="opacity-20"/>
                <path d="M14.5 8A6.5 6.5 0 0 0 8 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="font-mono text-xs tracking-wider text-zinc-500 uppercase">{{ $label }}</span>
        </div>
    @else
        <span class="sr-only">{{ $label }}</span>
    @endif
</div>

@once
    <style>
        @keyframes ui-page-loader-slide {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(350%);
            }
        }
    </style>

    <script>
        window.addEventListener('load', () => {
            document.querySelectorAll('[data-ui-page-loader][data-auto-hide]').forEach((loader) => {
                loader.setAttribute('data-hidden', '');
                loader.addEventListener('transitionend', () => loader.remove(), { once: true });
            });
        });
    </script>
@endonce
