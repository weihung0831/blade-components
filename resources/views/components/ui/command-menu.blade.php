@props([
    'id' => 'command-menu',
    'placeholder' => 'Search commands…',
    'shortcut' => 'k',
    'groups' => [],
])

<dialog id="{{ $id }}" data-ui-command data-shortcut="{{ $shortcut }}"
    {{ $attributes->merge(['class' => 'mx-auto mt-[12vh] mb-0 w-[calc(100%-2.5rem)] max-w-lg scale-95 overflow-hidden rounded-xl border border-white/10 bg-ink-900 p-0 opacity-0 shadow-xl shadow-black/50 transition-[opacity,scale,display,overlay] transition-discrete duration-200 ease-snap outline-none open:scale-100 open:opacity-100 starting:open:scale-95 starting:open:opacity-0 backdrop:bg-ink-950/70 backdrop:opacity-0 backdrop:transition-[opacity,display,overlay] backdrop:transition-discrete backdrop:duration-200 open:backdrop:opacity-100 starting:open:backdrop:opacity-0']) }}>

    <div class="flex items-center gap-2.5 border-b border-white/5 px-4 py-3">
        <svg class="size-4 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="4.5" stroke="currentColor" stroke-width="1.4"/><path d="m10.5 10.5 3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        <input type="text" data-ui-command-input autocomplete="off" placeholder="{{ $placeholder }}"
            class="w-full bg-transparent text-sm text-cream outline-none placeholder:text-zinc-600">
        <span class="shrink-0 rounded border border-white/10 px-1.5 py-0.5 font-mono text-[10px] text-zinc-600">ESC</span>
    </div>

    <div class="max-h-72 overflow-y-auto p-1.5">
        @foreach ($groups as $group)
            <div data-ui-command-group class="data-hidden:hidden">
                @isset($group['label'])
                    <p class="px-2.5 pt-2 pb-1 font-mono text-[10px] tracking-wider text-zinc-600 uppercase">{{ $group['label'] }}</p>
                @endisset
                @foreach ($group['items'] ?? [] as $entry)
                    <button type="button" data-ui-command-item
                        class="flex w-full items-center justify-between gap-4 rounded-md px-2.5 py-2 text-left text-sm text-zinc-300 outline-none data-active:bg-white/5 data-active:text-cream data-hidden:hidden">
                        <span>{{ $entry['label'] }}</span>
                        @isset($entry['shortcut'])
                            <span class="shrink-0 font-mono text-[11px] text-zinc-600">{{ $entry['shortcut'] }}</span>
                        @endisset
                    </button>
                @endforeach
            </div>
        @endforeach

        <p data-ui-command-empty class="hidden px-2.5 py-8 text-center text-sm text-zinc-600 data-visible:block">Nothing matches that.</p>
    </div>

    <div class="flex items-center gap-4 border-t border-white/5 px-4 py-2.5 font-mono text-[10px] text-zinc-600">
        <span>↑↓ move</span>
        <span>↵ run</span>
    </div>
</dialog>

@once
    <script>
        const commandItems = (menu) => [...menu.querySelectorAll('[data-ui-command-item]')].filter((item) => !item.hasAttribute('data-hidden'));

        const activateCommand = (menu, item) => {
            commandItems(menu).forEach((entry) => entry.toggleAttribute('data-active', entry === item));
            item?.scrollIntoView({ block: 'nearest' });
        };

        const filterCommands = (menu) => {
            const query = menu.querySelector('[data-ui-command-input]').value.trim().toLowerCase();

            menu.querySelectorAll('[data-ui-command-item]').forEach((item) => {
                item.toggleAttribute('data-hidden', query !== '' && !item.textContent.toLowerCase().includes(query));
            });

            menu.querySelectorAll('[data-ui-command-group]').forEach((group) => {
                group.toggleAttribute('data-hidden', commandItems(group).length === 0);
            });

            const visible = commandItems(menu);

            menu.querySelector('[data-ui-command-empty]').toggleAttribute('data-visible', visible.length === 0);
            activateCommand(menu, visible[0]);
        };

        const openCommandMenu = (menu) => {
            menu.querySelector('[data-ui-command-input]').value = '';
            filterCommands(menu);
            menu.showModal();
        };

        document.addEventListener('click', (event) => {
            const trigger = event.target.closest('[data-ui-command-target]');

            if (trigger) {
                return openCommandMenu(document.getElementById(trigger.dataset.uiCommandTarget));
            }

            const item = event.target.closest('[data-ui-command-item]');

            if (item) {
                return item.closest('[data-ui-command]').close();
            }

            if (event.target.matches('[data-ui-command]')) {
                event.target.close();
            }
        });

        document.addEventListener('input', (event) => {
            if (event.target.matches('[data-ui-command-input]')) {
                filterCommands(event.target.closest('[data-ui-command]'));
            }
        });

        document.addEventListener('keydown', (event) => {
            const menu = document.querySelector('[data-ui-command][open]');

            if (!menu) {
                if (!event.metaKey && !event.ctrlKey) {
                    return;
                }

                const target = [...document.querySelectorAll('[data-ui-command]')].find((el) => el.dataset.shortcut === event.key.toLowerCase());

                if (target) {
                    event.preventDefault();
                    openCommandMenu(target);
                }

                return;
            }

            if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
                event.preventDefault();

                const items = commandItems(menu);
                const index = items.findIndex((item) => item.hasAttribute('data-active'));
                const step = event.key === 'ArrowDown' ? 1 : items.length - 1;

                activateCommand(menu, items[(index + step) % items.length]);
            }

            if (event.key === 'Enter') {
                event.preventDefault();
                menu.querySelector('[data-ui-command-item][data-active]')?.click();
            }
        });
    </script>
@endonce
