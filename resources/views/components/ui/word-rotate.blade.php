@props([
    'words' => [],
    'interval' => 2200,
    'duration' => 400,
])

<span data-ui-word-rotate data-words="{{ json_encode(array_values($words)) }}" data-interval="{{ (int) $interval }}"
    {{ $attributes->class(['inline-grid overflow-hidden align-bottom']) }}
    style="--ui-word-rotate-duration: {{ (int) $duration }}ms">
    <span data-ui-word-rotate-word class="col-start-1 row-start-1 whitespace-nowrap animate-[ui-word-rotate-in_var(--ui-word-rotate-duration)_var(--ease-snap)_both]">{{ $words[0] ?? '' }}</span>
</span>

@once
    <style>
        @keyframes ui-word-rotate-in {
            from {
                opacity: 0;
                transform: translateY(65%);
            }
        }
    </style>

    <script>
        (() => {
            document.addEventListener('DOMContentLoaded', () => {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    return;
                }

                document.querySelectorAll('[data-ui-word-rotate]').forEach((root) => {
                    const words = JSON.parse(root.dataset.words);
                    const word = root.querySelector('[data-ui-word-rotate-word]');

                    if (words.length < 2) {
                        return;
                    }

                    let index = 0;

                    setInterval(() => {
                        index = (index + 1) % words.length;
                        word.textContent = words[index];
                        word.style.animation = 'none';
                        word.offsetHeight;
                        word.style.animation = '';
                    }, Number(root.dataset.interval));
                });
            });
        })();
    </script>
@endonce
