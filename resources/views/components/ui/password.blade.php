@props([
    'label' => null,
    'placeholder' => '••••••••',
    'meter' => false,
])

<div {{ $attributes->merge(['class' => 'w-56']) }} data-password>
    @if ($label)
        <label class="mb-1.5 block text-xs text-zinc-500">{{ $label }}</label>
    @endif
    <div class="relative">
        <input type="password" placeholder="{{ $placeholder }}"
            class="h-10 w-full rounded-lg border border-white/10 bg-ink-950 pr-10 pl-3 text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 focus:border-jade-500">
        <button type="button" data-password-toggle aria-label="Show password"
            class="absolute top-1/2 right-1.5 grid size-7 -translate-y-1/2 place-items-center rounded-md text-zinc-500 transition-colors duration-150 outline-none hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70">
            <svg data-password-show class="size-4" viewBox="0 0 16 16" fill="none"><path d="M1.5 8s2.5-4.5 6.5-4.5S14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8Z" stroke="currentColor" stroke-width="1.3"/><circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.3"/></svg>
            <svg data-password-hide class="hidden size-4" viewBox="0 0 16 16" fill="none"><path d="M1.5 8s2.5-4.5 6.5-4.5S14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8Z" stroke="currentColor" stroke-width="1.3"/><path d="m3 13 10-10" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
        </button>
    </div>
    @if ($meter)
        <div class="mt-2 flex gap-1" data-password-meter>
            <span class="h-1 flex-1 rounded-full bg-white/10 transition-colors duration-200"></span>
            <span class="h-1 flex-1 rounded-full bg-white/10 transition-colors duration-200"></span>
            <span class="h-1 flex-1 rounded-full bg-white/10 transition-colors duration-200"></span>
            <span class="h-1 flex-1 rounded-full bg-white/10 transition-colors duration-200"></span>
        </div>
        <p class="mt-1.5 text-xs text-zinc-500" data-password-hint>Use 8+ characters</p>
    @endif
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const toggle = event.target.closest('[data-password-toggle]');

            if (!toggle) {
                return;
            }

            const input = toggle.closest('[data-password]').querySelector('input');
            const revealed = input.type === 'password';

            input.type = revealed ? 'text' : 'password';
            toggle.setAttribute('aria-label', revealed ? 'Hide password' : 'Show password');
            toggle.querySelector('[data-password-show]').classList.toggle('hidden', revealed);
            toggle.querySelector('[data-password-hide]').classList.toggle('hidden', !revealed);
        });

        document.addEventListener('input', (event) => {
            const root = event.target.closest('[data-password]');
            const meter = root?.querySelector('[data-password-meter]');

            if (!meter) {
                return;
            }

            const value = event.target.value;
            const score = [value.length >= 8, /[a-z]/.test(value) && /[A-Z]/.test(value), /\d/.test(value), /[^a-zA-Z0-9]/.test(value)].filter(Boolean).length;
            const hints = ['Use 8+ characters', 'Weak — keep going', 'Okay — mix cases', 'Good — add a symbol', 'Strong password'];

            meter.querySelectorAll('span').forEach((bar, index) => {
                bar.classList.toggle('bg-jade-500', index < score);
                bar.classList.toggle('bg-white/10', index >= score);
            });

            root.querySelector('[data-password-hint]').textContent = hints[score];
        });
    </script>
@endonce
