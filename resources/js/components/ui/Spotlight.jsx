import { useRef, useState } from 'react';

const keyframes = `
@keyframes ui-spotlight-sweep { from { transform: translateX(-40%); } to { transform: translateX(160%); } }
@media (prefers-reduced-motion: reduce) { [class*='ui-spotlight-'] { animation: none; } }
`;

const tints = {
    cream: 'color-mix(in srgb, var(--color-white) 12%, transparent)',
    jade: 'color-mix(in srgb, var(--color-jade-500) 30%, transparent)',
};

export function UiSpotlight({ mode = 'pointer', size = 260, tone = 'cream', className = '', children, ...props }) {
    const root = useRef(null);
    const [point, setPoint] = useState({ x: '50%', y: '0%' });

    const tint = tints[tone] ?? tints.cream;

    const track = (event) => {
        if (mode !== 'pointer') {
            return;
        }

        const bounds = root.current.getBoundingClientRect();

        setPoint({ x: `${event.clientX - bounds.left}px`, y: `${event.clientY - bounds.top}px` });
    };

    return (
        <div
            ref={root}
            className={`group relative isolate overflow-hidden ${className}`}
            style={{ '--ui-spotlight-size': `${size}px` }}
            onPointerMove={track}
            {...props}
        >
            <style>{keyframes}</style>

            {mode === 'pointer' ? (
                <span
                    aria-hidden="true"
                    className="pointer-events-none absolute inset-0 -z-10 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                    style={{
                        background: `radial-gradient(var(--ui-spotlight-size) circle at ${point.x} ${point.y}, ${tint}, transparent 70%)`,
                    }}
                />
            ) : (
                <span
                    aria-hidden="true"
                    className="pointer-events-none absolute -top-1/2 left-0 -z-10 aspect-square blur-2xl animate-[ui-spotlight-sweep_5s_ease-in-out_infinite_alternate]"
                    style={{ width: 'var(--ui-spotlight-size)', background: `radial-gradient(circle, ${tint}, transparent 65%)` }}
                />
            )}

            {children}
        </div>
    );
}
