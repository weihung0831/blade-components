@props([
    'value',
    'name' => null,
    'mono' => false,
])

<div {{ $attributes->merge(['class' => 'inline-flex']) }} data-inplace>
    <button type="button" data-inplace-open
        class="group flex items-center gap-2 text-[13px] outline-none focus-visible:ring-2 focus-visible:ring-jade-500/70 {{ $mono ? 'font-mono' : '' }}">
        <span class="border-b border-dashed border-white/25 pb-0.5 text-zinc-300 transition-colors duration-150 group-hover:border-jade-400/60 group-hover:text-cream" data-inplace-label>{{ $value }}</span>
        <svg class="size-3.5 text-zinc-600 transition-colors duration-150 group-hover:text-jade-400" viewBox="0 0 16 16" fill="none"><path d="M11.3 2.7l2 2L6 12l-2.7.7.7-2.7 7.3-7.3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
    </button>
    <input type="text" value="{{ $value }}" @if ($name) name="{{ $name }}" @endif
        class="hidden h-8 w-48 rounded-lg border border-white/10 bg-ink-950 px-2.5 text-[13px] text-zinc-300 outline-none focus:border-jade-500 {{ $mono ? 'font-mono' : '' }}" data-inplace-input>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const open = event.target.closest('[data-inplace-open]');

            if (!open) {
                return;
            }

            const input = open.closest('[data-inplace]').querySelector('[data-inplace-input]');

            open.classList.add('hidden');
            input.classList.remove('hidden');
            input.focus();
            input.select();
        });

        const closeInplace = (input, commit) => {
            const root = input.closest('[data-inplace]');
            const open = root.querySelector('[data-inplace-open]');
            const label = root.querySelector('[data-inplace-label]');

            if (commit && input.value.trim() !== '') {
                label.textContent = input.value.trim();
            } else {
                input.value = label.textContent;
            }

            input.classList.add('hidden');
            open.classList.remove('hidden');
        };

        document.addEventListener('keydown', (event) => {
            if (!event.target.matches('[data-inplace-input]')) {
                return;
            }

            if (event.key === 'Enter' || event.key === 'Escape') {
                event.preventDefault();
                closeInplace(event.target, event.key === 'Enter');
            }
        });

        document.addEventListener('focusout', (event) => {
            if (event.target.matches?.('[data-inplace-input]') && !event.target.classList.contains('hidden')) {
                closeInplace(event.target, true);
            }
        });
    </script>
@endonce
