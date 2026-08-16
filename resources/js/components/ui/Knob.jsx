import { useState } from 'react';

const sizes = {
    sm: { knob: 'size-16', text: 'text-xs' },
    md: { knob: 'size-20', text: 'text-sm' },
    lg: { knob: 'size-24', text: 'text-base' },
};

export function UiKnob({
    label = null,
    min = 0,
    max = 100,
    step = 1,
    value = 50,
    size = 'md',
    readonly = false,
    onChange = null,
    className = '',
    ...props
}) {
    const [current, setCurrent] = useState(value);
    const style = sizes[size] ?? sizes.md;
    const angle = max > min ? ((current - min) / (max - min)) * 360 : 0;

    const set = (next) => {
        const clamped = parseFloat(Math.min(max, Math.max(min, Math.round(next / step) * step)).toFixed(10));

        setCurrent(clamped);
        onChange?.(clamped);
    };

    const handlePointerDown = (event) => {
        if (readonly) {
            return;
        }

        event.preventDefault();
        event.currentTarget.focus();

        const startY = event.clientY;
        const startValue = current;
        const range = max - min;

        const move = (moveEvent) => set(startValue + ((startY - moveEvent.clientY) / 150) * range);

        const stop = () => {
            document.removeEventListener('pointermove', move);
            document.removeEventListener('pointerup', stop);
        };

        document.addEventListener('pointermove', move);
        document.addEventListener('pointerup', stop);
    };

    const handleKeyDown = (event) => {
        if (readonly) {
            return;
        }

        const deltas = { ArrowUp: step, ArrowRight: step, ArrowDown: -step, ArrowLeft: -step };

        if (deltas[event.key] === undefined) {
            return;
        }

        event.preventDefault();
        set(current + deltas[event.key]);
    };

    return (
        <div className={`inline-flex flex-col items-center gap-2 ${className}`.trim()} {...props}>
            <div
                role="slider"
                aria-label={label ?? 'Value'}
                aria-valuemin={min}
                aria-valuemax={max}
                aria-valuenow={current}
                tabIndex={readonly ? undefined : 0}
                className={`grid touch-none place-items-center rounded-full outline-none select-none focus-visible:ring-2 focus-visible:ring-jade-500/70 ${style.knob} ${readonly ? '' : 'cursor-ns-resize'}`.trim()}
                style={{ background: `conic-gradient(var(--color-jade-500) ${angle}deg, var(--color-ink-800) 0)` }}
                onPointerDown={handlePointerDown}
                onKeyDown={handleKeyDown}
            >
                <div className="grid size-[calc(100%-14px)] place-items-center rounded-full bg-ink-950">
                    <span className={`font-mono text-cream ${style.text}`}>{current}</span>
                </div>
            </div>
            {label && <span className="text-xs text-zinc-500">{label}</span>}
        </div>
    );
}
