@props([
    'value' => 0,
    'from' => 0,
    'decimals' => 0,
    'duration' => 1600,
    'prefix' => null,
    'suffix' => null,
    'locale' => 'en-US',
])

<span data-ui-number-ticker data-value="{{ $value }}" data-from="{{ $from }}" data-decimals="{{ (int) $decimals }}"
    data-duration="{{ (int) $duration }}" data-locale="{{ $locale }}"
    {{ $attributes->class(['inline-flex items-baseline tabular-nums']) }}>
    @if ($prefix)
        <span class="text-jade-400">{{ $prefix }}</span>
    @endif
    <span data-ui-number-ticker-value>{{ number_format((float) $value, (int) $decimals) }}</span>
    @if ($suffix)
        <span class="text-zinc-500">{{ $suffix }}</span>
    @endif
</span>

@once
    <script>
        (() => {
            const count = (root) => {
                const target = Number(root.dataset.value);
                const start = Number(root.dataset.from);
                const duration = Number(root.dataset.duration);
                const decimals = Number(root.dataset.decimals);
                const out = root.querySelector('[data-ui-number-ticker-value]');
                const format = new Intl.NumberFormat(root.dataset.locale, {
                    minimumFractionDigits: decimals,
                    maximumFractionDigits: decimals,
                });

                let began = null;

                const frame = (now) => {
                    began ??= now;

                    const progress = Math.min(1, (now - began) / duration);
                    const eased = 1 - Math.pow(1 - progress, 3);

                    out.textContent = format.format(start + (target - start) * eased);

                    if (progress < 1) {
                        requestAnimationFrame(frame);
                    }
                };

                requestAnimationFrame(frame);
            };

            document.addEventListener('DOMContentLoaded', () => {
                const tickers = document.querySelectorAll('[data-ui-number-ticker]');

                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    return;
                }

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) {
                            return;
                        }

                        observer.unobserve(entry.target);
                        count(entry.target);
                    });
                }, { threshold: 0.5 });

                tickers.forEach((root) => observer.observe(root));
            });
        })();
    </script>
@endonce
