@props([
    'words' => [],
    'speed' => 70,
    'pause' => 1600,
    'loop' => true,
    'cursor' => true,
])

<span data-ui-typewriter data-words="{{ json_encode(array_values($words)) }}" data-speed="{{ (int) $speed }}"
    data-pause="{{ (int) $pause }}" data-loop="{{ $loop ? 'true' : 'false' }}"
    {{ $attributes->class(['inline-flex items-center']) }}>
    <span data-ui-typewriter-text>{{ $words[0] ?? '' }}</span>
    @if ($cursor)
        <span aria-hidden="true" class="ml-0.5 inline-block h-[1em] w-0.5 shrink-0 bg-jade-400 animate-[ui-typewriter-blink_1s_step-end_infinite]"></span>
    @endif
</span>

@once
    <style>
        @keyframes ui-typewriter-blink {
            50% {
                opacity: 0;
            }
        }
    </style>

    <script>
        (() => {
            const run = (root) => {
                const words = JSON.parse(root.dataset.words);
                const out = root.querySelector('[data-ui-typewriter-text]');
                const speed = Number(root.dataset.speed);
                const pause = Number(root.dataset.pause);
                const loop = root.dataset.loop === 'true';

                if (words.length < 2 && !loop) {
                    return;
                }

                let index = 0;
                let length = words[0].length;
                let deleting = true;

                const step = () => {
                    const word = words[index];

                    length += deleting ? -1 : 1;
                    out.textContent = word.slice(0, length);

                    if (!deleting && length === word.length) {
                        if (!loop && index === words.length - 1) {
                            return;
                        }

                        deleting = true;

                        return setTimeout(step, pause);
                    }

                    if (deleting && length === 0) {
                        deleting = false;
                        index = (index + 1) % words.length;
                    }

                    setTimeout(step, deleting ? speed / 2 : speed);
                };

                setTimeout(step, pause);
            };

            document.addEventListener('DOMContentLoaded', () => {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    return;
                }

                document.querySelectorAll('[data-ui-typewriter]').forEach(run);
            });
        })();
    </script>
@endonce
