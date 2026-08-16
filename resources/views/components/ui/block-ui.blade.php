@props([
    'blocked' => false,
    'label' => null,
])

<div {{ $attributes->class(['group/block relative']) }} data-ui-block @if ($blocked) data-blocked @endif>
    {{ $slot }}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 z-10 grid place-items-center rounded-[inherit] bg-ink-950/60 opacity-0 backdrop-blur-[2px] transition-opacity duration-300 group-data-[blocked]/block:pointer-events-auto group-data-[blocked]/block:opacity-100">
        <div class="flex flex-col items-center gap-2.5">
            <svg class="size-5 animate-spin text-jade-400" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-opacity="0.25" stroke-width="1.5" /><path d="M14.5 8a6.5 6.5 0 0 0-6.5-6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
            @if ($label)
                <p class="text-xs text-zinc-400">{{ $label }}</p>
            @endif
        </div>
    </div>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const trigger = event.target.closest('[data-ui-block-toggle]');

            if (!trigger) {
                return;
            }

            document.getElementById(trigger.dataset.uiBlockToggle).toggleAttribute('data-blocked');
        });
    </script>
@endonce
