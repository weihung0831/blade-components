@props([
    'label' => null,
    'name' => null,
    'value' => null,
    'min' => null,
    'max' => null,
    'placeholder' => 'Pick a date',
])

<div {{ $attributes->merge(['class' => 'w-56']) }}>
    @if ($label)
        <label class="mb-1.5 block text-xs text-zinc-500">{{ $label }}</label>
    @endif
    <details data-ui-date-picker data-placeholder="{{ $placeholder }}"
        @if ($value) data-value="{{ $value }}" @endif
        @if ($min) data-min="{{ $min }}" @endif
        @if ($max) data-max="{{ $max }}" @endif
        class="group/date relative block">
        <summary class="flex h-10 w-full cursor-pointer list-none items-center justify-between gap-3 rounded-lg border border-white/10 bg-ink-950 px-3 font-mono text-xs transition-colors duration-150 outline-none hover:border-white/25 focus-visible:ring-2 focus-visible:ring-jade-500/70 [&::-webkit-details-marker]:hidden group-open/date:border-jade-500 group-open/date:before:fixed group-open/date:before:inset-0 group-open/date:before:z-10 group-open/date:before:cursor-default group-open/date:before:content-['']">
            <span data-ui-date-value class="{{ $value !== null ? 'text-zinc-300' : 'text-zinc-600' }}">{{ $value ?? $placeholder }}</span>
            <svg class="size-3.5 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><rect x="2.5" y="3.5" width="11" height="10" rx="1.5" stroke="currentColor" stroke-width="1.3"/><path d="M2.5 6.5h11M5.5 2v2.5M10.5 2v2.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
        </summary>
        <div class="absolute top-full left-0 z-20 mt-2 w-max rounded-lg border border-white/10 bg-ink-900 p-3 shadow-lg shadow-black/40">
            <div class="flex items-center justify-between">
                <button type="button" data-ui-date-prev aria-label="Previous month" class="grid size-7 cursor-pointer place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <span data-ui-date-title class="font-mono text-xs text-zinc-300"></span>
                <button type="button" data-ui-date-next aria-label="Next month" class="grid size-7 cursor-pointer place-items-center rounded-md text-zinc-500 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="m6.5 4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
            <div class="mt-2 grid grid-cols-7">
                @foreach (['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'] as $weekday)
                    <span class="grid size-8 place-items-center font-mono text-[10px] text-zinc-600">{{ $weekday }}</span>
                @endforeach
            </div>
            <div data-ui-date-grid class="grid grid-cols-7 gap-y-0.5"></div>
            <div class="mt-2 flex items-center justify-between border-t border-white/5 pt-2">
                <button type="button" data-ui-date-clear class="cursor-pointer rounded px-1.5 py-0.5 text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">Clear</button>
                <button type="button" data-ui-date-today class="cursor-pointer rounded px-1.5 py-0.5 text-xs text-jade-400 transition-colors duration-150 hover:text-jade-300">Today</button>
            </div>
        </div>
        @if ($name)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endif
    </details>
</div>

@once
    <script>
        const uiDateIso = (date) => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;

        const uiDateState = (root) => {
            if (!root.uiDatePickerState) {
                const base = root.dataset.value ? new Date(`${root.dataset.value}T00:00:00`) : new Date();

                root.uiDatePickerState = { year: base.getFullYear(), month: base.getMonth() };
            }

            return root.uiDatePickerState;
        };

        const uiDateRender = (root) => {
            const state = uiDateState(root);
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            root.querySelector('[data-ui-date-title]').textContent = `${months[state.month]} ${state.year}`;

            const first = new Date(state.year, state.month, 1);
            const start = new Date(state.year, state.month, 1 - first.getDay());
            const today = uiDateIso(new Date());
            const grid = root.querySelector('[data-ui-date-grid]');

            grid.innerHTML = '';

            for (let i = 0; i < 42; i++) {
                const day = new Date(start.getFullYear(), start.getMonth(), start.getDate() + i);
                const iso = uiDateIso(day);
                const outOfBounds = (root.dataset.min && iso < root.dataset.min) || (root.dataset.max && iso > root.dataset.max);
                const button = document.createElement('button');

                button.type = 'button';
                button.disabled = outOfBounds;
                button.dataset.uiDateDay = iso;
                button.textContent = day.getDate();
                button.className = [
                    'grid size-8 cursor-pointer place-items-center rounded-md font-mono text-xs transition-colors duration-150 disabled:pointer-events-none',
                    iso === root.dataset.value
                        ? 'bg-jade-500 text-ink-950'
                        : outOfBounds
                            ? 'text-zinc-700'
                            : day.getMonth() === state.month
                                ? 'text-zinc-300 hover:bg-white/5 hover:text-cream'
                                : 'text-zinc-600 hover:bg-white/5 hover:text-cream',
                    iso === today && iso !== root.dataset.value ? 'border border-jade-500/40' : '',
                ].filter(Boolean).join(' ');

                grid.appendChild(button);
            }
        };

        const uiDateSelect = (root, iso, close) => {
            const state = uiDateState(root);
            const display = root.querySelector('[data-ui-date-value]');
            const hidden = root.querySelector('input[type="hidden"]');

            if (iso) {
                root.dataset.value = iso;

                const date = new Date(`${iso}T00:00:00`);

                state.year = date.getFullYear();
                state.month = date.getMonth();
            } else {
                delete root.dataset.value;
            }

            display.textContent = iso ?? root.dataset.placeholder;
            display.classList.toggle('text-zinc-300', iso !== null);
            display.classList.toggle('text-zinc-600', iso === null);

            if (hidden) {
                hidden.value = iso ?? '';
                hidden.dispatchEvent(new Event('change', { bubbles: true }));
            }

            uiDateRender(root);

            if (close) {
                root.removeAttribute('open');
            }
        };

        document.addEventListener('toggle', (event) => {
            if (event.target.matches?.('[data-ui-date-picker]') && event.target.open) {
                uiDateRender(event.target);
            }
        }, true);

        document.addEventListener('click', (event) => {
            const root = event.target.closest('[data-ui-date-picker]');

            if (!root) {
                return;
            }

            const state = uiDateState(root);

            if (event.target.closest('[data-ui-date-prev]')) {
                state.month--;

                if (state.month < 0) {
                    state.month = 11;
                    state.year--;
                }

                uiDateRender(root);
            } else if (event.target.closest('[data-ui-date-next]')) {
                state.month++;

                if (state.month > 11) {
                    state.month = 0;
                    state.year++;
                }

                uiDateRender(root);
            } else if (event.target.closest('[data-ui-date-day]')) {
                uiDateSelect(root, event.target.closest('[data-ui-date-day]').dataset.uiDateDay, true);
            } else if (event.target.closest('[data-ui-date-clear]')) {
                uiDateSelect(root, null, false);
            } else if (event.target.closest('[data-ui-date-today]')) {
                uiDateSelect(root, uiDateIso(new Date()), true);
            }
        });
    </script>
@endonce
