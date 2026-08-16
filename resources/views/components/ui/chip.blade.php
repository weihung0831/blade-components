@props([
    'label' => '',
    'avatar' => null,
    'removable' => false,
])

<span data-ui-chip {{ $attributes->class([
    'inline-flex items-center gap-1.5 rounded-full border border-white/10 bg-ink-800 py-1 text-xs',
    'pl-1' => $avatar !== null,
    'pl-2.5' => $avatar === null,
    'pr-1.5' => $removable,
    'pr-2.5' => ! $removable,
]) }}>
    @if ($avatar !== null)
        <span class="grid size-5 shrink-0 place-items-center rounded-full bg-jade-500 text-[9px] font-semibold text-ink-950">{{ $avatar }}</span>
    @endif
    <span class="text-zinc-300">{{ $label }}</span>
    @if ($removable)
        <button type="button" data-ui-chip-remove class="grid size-4 cursor-pointer place-items-center rounded-full text-zinc-600 transition-colors duration-150 hover:bg-white/10 hover:text-cream">
            <svg class="size-2.5" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
    @endif
</span>

@once
    <script>
        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-ui-chip-remove]');

            if (!button) {
                return;
            }

            button.closest('[data-ui-chip]').remove();
        });
    </script>
@endonce
