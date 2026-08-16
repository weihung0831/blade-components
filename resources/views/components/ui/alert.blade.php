@props([
    'variant' => 'info',
    'title' => null,
    'dismissible' => false,
])

@php
    $variants = [
        'info' => [
            'box' => 'border-white/10 bg-white/5',
            'icon' => 'text-zinc-400',
            'title' => 'text-zinc-200',
            'mark' => 'M8 7.4v3.4M8 5v.2',
        ],
        'success' => [
            'box' => 'border-jade-500/25 bg-jade-500/10',
            'icon' => 'text-jade-400',
            'title' => 'text-jade-300',
            'mark' => 'm5.4 8.3 1.8 1.8 3.4-4.2',
        ],
        'warning' => [
            'box' => 'border-amber-400/25 bg-amber-400/10',
            'icon' => 'text-amber-400',
            'title' => 'text-amber-300',
            'mark' => 'M8 5v3.4M8 11v.2',
        ],
        'danger' => [
            'box' => 'border-red-500/25 bg-red-500/10',
            'icon' => 'text-red-400',
            'title' => 'text-red-300',
            'mark' => 'm6.2 6.2 3.6 3.6M9.8 6.2 6.2 9.8',
        ],
    ];

    $style = $variants[$variant] ?? $variants['info'];
@endphp

<div role="alert" {{ $attributes->merge(['class' => 'flex gap-3 rounded-xl border px-4 py-3.5 transition-[opacity,transform] duration-200 ease-snap '.$style['box']]) }}>
    <svg class="mt-0.5 size-4 shrink-0 {{ $style['icon'] }}" viewBox="0 0 16 16" fill="none">
        <circle cx="8" cy="8" r="6.4" stroke="currentColor" stroke-width="1.4" />
        <path d="{{ $style['mark'] }}" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <div class="min-w-0 flex-1">
        @if ($title)
            <p class="text-sm font-medium {{ $style['title'] }}">{{ $title }}</p>
        @endif
        <div @class(['text-sm/6 text-zinc-400', 'mt-1' => $title])>{{ $slot }}</div>
        @isset($actions)
            <div class="mt-2.5 flex items-center gap-4">{{ $actions }}</div>
        @endisset
    </div>
    @if ($dismissible)
        <button type="button" data-ui-alert-dismiss aria-label="Dismiss" class="-mt-0.5 -mr-1 grid size-6 shrink-0 place-items-center rounded-md text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
            <svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3 3 9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" /></svg>
        </button>
    @endif
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-ui-alert-dismiss]');

            if (!button) {
                return;
            }

            const alert = button.closest('[role="alert"]');

            alert.style.opacity = '0';
            alert.style.transform = 'scale(0.97)';

            setTimeout(() => alert.remove(), 200);
        });
    </script>
@endonce
