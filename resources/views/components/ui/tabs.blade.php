@props([
    'items' => [],
    'active' => null,
    'variant' => 'line',
])

@php
    $current = $active ?? ($items[0]['value'] ?? null);

    $lists = [
        'line' => 'flex items-center gap-6 border-b border-white/8',
        'pill' => 'inline-flex items-center gap-1 rounded-lg border border-white/10 bg-ink-950 p-1',
    ];

    $tabs = [
        'line' => '-mb-px border-b-2 border-transparent pb-2.5 text-zinc-500 hover:text-zinc-300 data-active:border-jade-500 data-active:text-cream',
        'pill' => 'rounded-md px-3 py-1.5 text-zinc-500 hover:text-zinc-300 data-active:bg-white/10 data-active:text-cream',
    ];
@endphp

<div data-ui-tabs {{ $attributes->class(['[&_[data-ui-tab-panel]]:hidden [&_[data-ui-tab-panel][data-active]]:block']) }}>
    <div role="tablist" class="{{ $lists[$variant] ?? $lists['line'] }}">
        @foreach ($items as $item)
            <button type="button" role="tab" data-ui-tab="{{ $item['value'] }}"
                aria-selected="{{ $item['value'] === $current ? 'true' : 'false' }}"
                @if ($item['value'] === $current) data-active @endif
                class="inline-flex cursor-pointer items-center gap-2 text-sm font-medium transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 {{ $tabs[$variant] ?? $tabs['line'] }}">
                {{ $item['label'] }}
                @isset($item['badge'])
                    <span class="rounded-full bg-white/8 px-1.5 font-mono text-[10px] text-zinc-400">{{ $item['badge'] }}</span>
                @endisset
            </button>
        @endforeach
    </div>
    {{ $slot }}
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const tab = event.target.closest('[data-ui-tab]');

            if (!tab) {
                return;
            }

            const root = tab.closest('[data-ui-tabs]');

            root.querySelectorAll('[data-ui-tab]').forEach((button) => {
                button.toggleAttribute('data-active', button === tab);
                button.setAttribute('aria-selected', button === tab);
            });

            root.querySelectorAll('[data-ui-tab-panel]').forEach((panel) => {
                panel.toggleAttribute('data-active', panel.dataset.uiTabPanel === tab.dataset.uiTab);
            });
        });
    </script>
@endonce
