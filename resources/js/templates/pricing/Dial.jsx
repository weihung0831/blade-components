import { useId } from 'react';

const thumbClasses =
    'absolute inset-0 w-full cursor-pointer appearance-none bg-transparent outline-none [&::-moz-range-thumb]:size-3.5 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-jade-500 [&::-moz-range-thumb]:bg-cream [&::-webkit-slider-thumb]:size-3.5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-jade-500 [&::-webkit-slider-thumb]:bg-cream [&::-webkit-slider-thumb]:transition-transform [&::-webkit-slider-thumb]:duration-150 [&::-webkit-slider-thumb]:ease-snap [&:active::-webkit-slider-thumb]:scale-110 [&:focus-visible::-webkit-slider-thumb]:ring-2 [&:focus-visible::-webkit-slider-thumb]:ring-jade-500/70';

export function PricingDial({ label, hint = null, min = 0, max = 100, step = 1, value = 50, format = (input) => String(input), onChange }) {
    const id = useId();
    const percent = max > min ? ((value - min) / (max - min)) * 100 : 0;

    return (
        <div style={{ '--ui-slider-fill': `${percent}%` }}>
            <div className="flex items-baseline justify-between gap-3">
                <label htmlFor={id} className="text-[13px] text-zinc-300">{label}</label>
                <output className="font-mono text-sm text-jade-400">{format(value)}</output>
            </div>

            <div className="relative mt-3 flex h-3.5 items-center">
                <div className="h-1.5 w-full rounded-full bg-ink-800"></div>
                <div className="absolute h-1.5 rounded-full bg-jade-500" style={{ width: 'var(--ui-slider-fill)' }}></div>
                <input
                    id={id}
                    type="range"
                    min={min}
                    max={max}
                    step={step}
                    value={value}
                    onChange={(event) => onChange(Number(event.target.value))}
                    className={thumbClasses}
                />
            </div>

            {hint && <p className="mt-2 font-mono text-[10px] text-zinc-600">{hint}</p>}
        </div>
    );
}
