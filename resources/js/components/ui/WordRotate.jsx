import { useEffect, useState } from 'react';

const keyframes = '@keyframes ui-word-rotate-in { from { opacity: 0; transform: translateY(65%); } }';

export function UiWordRotate({ words = [], interval = 2200, duration = 400, className = '', ...props }) {
    const [index, setIndex] = useState(0);

    useEffect(() => {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || words.length < 2) {
            return;
        }

        const timer = setInterval(() => setIndex((current) => (current + 1) % words.length), interval);

        return () => clearInterval(timer);
    }, [words, interval]);

    return (
        <>
            <style>{keyframes}</style>
            <span
                className={`inline-grid overflow-hidden align-bottom ${className}`}
                style={{ '--ui-word-rotate-duration': `${duration}ms` }}
                {...props}
            >
                <span
                    key={index}
                    className="col-start-1 row-start-1 whitespace-nowrap animate-[ui-word-rotate-in_var(--ui-word-rotate-duration)_var(--ease-snap)_both]"
                >
                    {words[index]}
                </span>
            </span>
        </>
    );
}
