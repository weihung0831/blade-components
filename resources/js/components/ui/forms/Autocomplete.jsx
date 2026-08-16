import { useState } from 'react';

const variants = {
    outline: 'border border-white/10 bg-ink-950 hover:border-white/25 focus:border-jade-500',
    filled: 'border border-transparent bg-ink-800 hover:bg-white/5 focus:border-jade-500',
};

export function UiAutocomplete({
    options = [],
    value = '',
    onChange = () => {},
    placeholder = '',
    variant = 'outline',
    className = '',
    ...props
}) {
    const [open, setOpen] = useState(false);

    const inputClasses = [
        'h-10 w-full rounded-lg px-3 text-sm text-zinc-300 transition-colors duration-150 outline-none placeholder:text-zinc-600 disabled:pointer-events-none disabled:opacity-40',
        variants[variant] ?? variants.outline,
    ].join(' ');

    const query = value.trim().toLowerCase();
    const filtered = options.filter((option) => option.toLowerCase().includes(query));

    const select = (option) => {
        onChange(option);
        setOpen(false);
    };

    return (
        <div className={['relative block', className].filter(Boolean).join(' ')} {...props}>
            <input
                type="text"
                autoComplete="off"
                value={value}
                placeholder={placeholder}
                className={inputClasses}
                onFocus={() => setOpen(true)}
                onChange={(event) => {
                    onChange(event.target.value);
                    setOpen(true);
                }}
                onBlur={() => setOpen(false)}
                onKeyDown={(event) => event.key === 'Escape' && setOpen(false)}
            />
            {open && filtered.length > 0 && (
                <div className="absolute top-full left-0 z-20 mt-2 w-full min-w-max rounded-lg border border-white/10 bg-ink-900 p-1 shadow-lg shadow-black/40">
                    {filtered.map((option) => (
                        <button
                            key={option}
                            type="button"
                            onMouseDown={(event) => {
                                event.preventDefault();
                                select(option);
                            }}
                            className="block w-full cursor-pointer rounded-md px-2.5 py-1.5 text-left text-sm text-zinc-400 transition-colors duration-150 hover:bg-white/5 hover:text-cream"
                        >
                            {option}
                        </button>
                    ))}
                </div>
            )}
        </div>
    );
}
