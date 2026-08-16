import { useState } from 'react';

const thumbClasses =
    'absolute inset-0 w-full cursor-pointer appearance-none bg-transparent outline-none disabled:pointer-events-none [&::-moz-range-thumb]:size-3.5 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-jade-500 [&::-moz-range-thumb]:bg-cream [&::-webkit-slider-thumb]:size-3.5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-jade-500 [&::-webkit-slider-thumb]:bg-cream [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-150 [&::-webkit-slider-thumb]:ease-snap [&:active::-webkit-slider-thumb]:scale-110 [&:focus-visible::-webkit-slider-thumb]:ring-2 [&:focus-visible::-webkit-slider-thumb]:ring-jade-500/70';

export function UiSlider({
    label = null,
    min = 0,
    max = 100,
    step = 1,
    value = 50,
    disabled = false,
    onChange = null,
    className = '',
    ...props
}) {
    const [current, setCurrent] = useState(value);
    const percent = max > min ? ((current - min) / (max - min)) * 100 : 0;

    const handleChange = (event) => {
        const next = Number(event.target.value);

        setCurrent(next);
        onChange?.(next);
    };

    return (
        <div className={`w-56 ${className}`.trim()} style={{ '--ui-slider-fill': `${percent}%` }} {...props}>
            {label && (
                <div className="mb-2 flex items-center justify-between text-xs">
                    <span className="text-zinc-500">{label}</span>
                    <span className="font-mono text-jade-400">{current}</span>
                </div>
            )}
            <div className={`relative flex h-3.5 items-center ${disabled ? 'opacity-40' : ''}`.trim()}>
                <div className="h-1.5 w-full rounded-full bg-ink-800"></div>
                <div className="absolute h-1.5 rounded-full bg-jade-500" style={{ width: 'var(--ui-slider-fill)' }}></div>
                <input
                    type="range"
                    min={min}
                    max={max}
                    step={step}
                    value={current}
                    disabled={disabled}
                    aria-label={label ?? undefined}
                    onChange={handleChange}
                    className={thumbClasses}
                />
            </div>
        </div>
    );
}
