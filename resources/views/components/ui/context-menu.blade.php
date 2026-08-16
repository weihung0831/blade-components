@props(['items' => []])

@php
    $itemClasses = 'flex w-full items-center justify-between gap-8 rounded-md px-2.5 py-1.5 text-left text-sm transition-colors duration-150 outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70';
@endphp

<div data-ui-context-menu {{ $attributes }}>
    {{ $slot }}

    <div data-ui-context-menu-panel role="menu" popover="auto"
        class="fixed inset-auto m-0 scale-95 rounded-lg border border-white/10 bg-ink-900 p-1 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-150 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0">
        @foreach ($items as $entry)
            @if ($entry['separator'] ?? false)
                <hr class="my-1 border-white/5">
            @else
                @php
                    $tone = ($entry['danger'] ?? false)
                        ? 'text-red-400 hover:bg-red-500/10'
                        : 'text-zinc-300 hover:bg-white/5 hover:text-cream';
                @endphp
                <button type="button" role="menuitem" class="{{ $itemClasses }} {{ $tone }}">
                    <span>{{ $entry['label'] }}</span>
                    @isset($entry['shortcut'])
                        <span class="font-mono text-[11px] text-zinc-600">{{ $entry['shortcut'] }}</span>
                    @endisset
                </button>
            @endif
        @endforeach
    </div>
</div>

@once
    <script>
        const closeContextMenus = () => {
            document.querySelectorAll('[data-ui-context-menu-panel]:popover-open').forEach((panel) => panel.hidePopover());
        };

        document.addEventListener('contextmenu', (event) => {
            const root = event.target.closest('[data-ui-context-menu]');

            closeContextMenus();

            if (!root) {
                return;
            }

            event.preventDefault();

            const panel = root.querySelector('[data-ui-context-menu-panel]');

            panel.showPopover();

            const { width, height } = panel.getBoundingClientRect();

            panel.style.left = Math.min(event.clientX, window.innerWidth - width - 8) + 'px';
            panel.style.top = Math.min(event.clientY, window.innerHeight - height - 8) + 'px';
        });

        document.addEventListener('click', (event) => {
            if (event.target.closest('[data-ui-context-menu-panel]')) {
                closeContextMenus();
            }
        });

        document.addEventListener('scroll', closeContextMenus, { capture: true, passive: true });
    </script>
@endonce
