import { useEffect, useState } from 'react';

const keyframes = '@keyframes ui-typewriter-blink { 50% { opacity: 0; } }';

export function UiTypewriter({
    words = [],
    speed = 70,
    pause = 1600,
    loop = true,
    cursor = true,
    className = '',
    ...props
}) {
    const [text, setText] = useState(words[0] ?? '');

    useEffect(() => {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || (words.length < 2 && !loop)) {
            return;
        }

        let timer = null;
        let index = 0;
        let length = (words[0] ?? '').length;
        let deleting = true;

        const step = () => {
            const word = words[index];

            length += deleting ? -1 : 1;
            setText(word.slice(0, length));

            if (!deleting && length === word.length) {
                if (!loop && index === words.length - 1) {
                    return;
                }

                deleting = true;
                timer = setTimeout(step, pause);

                return;
            }

            if (deleting && length === 0) {
                deleting = false;
                index = (index + 1) % words.length;
            }

            timer = setTimeout(step, deleting ? speed / 2 : speed);
        };

        timer = setTimeout(step, pause);

        return () => clearTimeout(timer);
    }, [words, speed, pause, loop]);

    return (
        <>
            <style>{keyframes}</style>
            <span className={`inline-flex items-center ${className}`} {...props}>
                <span>{text}</span>
                {cursor && (
                    <span
                        aria-hidden="true"
                        className="ml-0.5 inline-block h-[1em] w-0.5 shrink-0 bg-jade-400 animate-[ui-typewriter-blink_1s_step-end_infinite]"
                    />
                )}
            </span>
        </>
    );
}
