import { useState } from 'react';

const stepClasses =
    'grid w-9 shrink-0 place-items-center text-zinc-400 outline-none transition-colors duration-150 hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-jade-500/70 disabled:pointer-events-none disabled:opacity-30';

export function UiInputNumber({
    label = null,
    min = null,
    max = null,
    step = 1,
    value = 0,
    onChange = null,
    className = '',
    ...props
}) {
    const [current, setCurrent] = useState(value);
    const lower = min ?? -Infinity;
    const upper = max ?? Infinity;

    const set = (next) => {
        const clamped = parseFloat(Math.min(upper, Math.max(lower, next)).toFixed(10));

        setCurrent(clamped);
        onChange?.(clamped);
    };

    return (
        <div className={`w-40 ${className}`.trim()} {...props}>
            {label && <label className="mb-1.5 block text-xs text-zinc-500">{label}</label>}
            <div className="flex h-9 items-stretch overflow-hidden rounded-lg border border-white/10 bg-ink-950 transition-colors duration-150 focus-within:border-jade-500">
                <button type="button" aria-label="Decrease" disabled={current <= lower} className={stepClasses} onClick={() => set((current || 0) - step)}>
                    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M3.5 8h9" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round"/></svg>
                </button>
                <input
                    type="number"
                    inputMode="decimal"
                    min={min ?? undefined}
                    max={max ?? undefined}
                    step={step}
                    value={current}
                    aria-label={label ?? undefined}
                    onChange={(event) => set(Number(event.target.value) || 0)}
                    className="min-w-0 flex-1 border-x border-white/10 bg-transparent text-center font-mono text-sm text-zinc-300 outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                />
                <button type="button" aria-label="Increase" disabled={current >= upper} className={stepClasses} onClick={() => set((current || 0) + step)}>
                    <svg className="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M8 3.5v9M3.5 8h9" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round"/></svg>
                </button>
            </div>
        </div>
    );
}
