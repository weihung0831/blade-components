import { useState } from 'react';

export function UiColorPicker({ label = null, defaultValue = '#4ea396', swatches = [], onChange = null, className = '', ...props }) {
    const [value, setValue] = useState(defaultValue);

    const update = (next) => {
        setValue(next);
        onChange?.(next);
    };

    return (
        <div className={`w-56 ${className}`.trim()} {...props}>
            {label && <label className="mb-1.5 block text-xs text-zinc-500">{label}</label>}
            {swatches.length > 0 && (
                <div className="mb-2 flex gap-1.5">
                    {swatches.map((swatch) => (
                        <button
                            key={swatch}
                            type="button"
                            aria-label={`Use ${swatch}`}
                            style={{ background: swatch }}
                            onClick={() => update(swatch)}
                            className="size-6 rounded-md border border-white/10 transition-transform duration-150 ease-snap outline-none hover:scale-110 focus-visible:ring-2 focus-visible:ring-jade-500/70 active:scale-95"
                        />
                    ))}
                </div>
            )}
            <label className="flex h-10 cursor-pointer items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-2 transition-colors duration-150 focus-within:border-jade-500">
                <input
                    type="color"
                    value={value}
                    onChange={(event) => update(event.target.value)}
                    className="size-6 shrink-0 cursor-pointer appearance-none rounded-md border-none bg-transparent p-0 outline-none [&::-moz-color-swatch]:rounded-md [&::-moz-color-swatch]:border-none [&::-webkit-color-swatch]:rounded-md [&::-webkit-color-swatch]:border-none [&::-webkit-color-swatch-wrapper]:p-0"
                />
                <span className="font-mono text-xs tracking-wide text-zinc-300 uppercase">{value}</span>
            </label>
        </div>
    );
}
